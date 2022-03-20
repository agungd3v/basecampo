<?php

namespace Modules\V1\Http\Controllers;

use App\Models\Tag;
use App\Models\Task;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Traits\ResponseApi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\V1\Repository\GlobalRepository;

class TaskController extends Controller
{
  use ResponseApi;
  protected $repository;

  public function __construct(GlobalRepository $globalRepo) {
    $this->repository = $globalRepo;
  }

  public function getTask() {
    try {
      $this->setData(Task::with('assign', 'tags')->get());
      return $this->success();
    } catch (\Exception $e) {
      $this->setMessage($e->getMessage());
      return $this->error();
    }
  }

  public function storeTask(Request $request) {
    $request->validate(['title' => 'required']);
    DB::beginTransaction();
    try {
      $task = new Task();
      $task->title = $request->title;
      $task->created_by = Auth::user()->id;
      $task->division_id = Auth::user()->division->id;
      $task->from_date = $request->from_date ?? NULL;
      $task->to_date = $request->to_date ?? NULL;
      $task->description = $request->description ?? NULL;
      $task->save();

      if ($request->assign) {
        $task->assign()->attach($request->assign);
      }
      if ($request->tags) {
        $task->tags()->attach($request->tags);
      }

      DB::commit();
      $this->setData($task);
      return $this->success();
    } catch (\Exception $e) {
      DB::rollBack();
      $this->setMessage($e->getMessage());
      return $this->error();
    }
  }

  public function getUserDivision(Request $request) {
    $request->validate(['division_id' => 'required']);
    try {
      $data = $this->repository->getUserIsSameDivison($request->division_id);
      $this->setData($data);
      return $this->success();
    } catch (\Exception $e) {
      $this->setMessage($e->getMessage());
      return $this->error();
    }
  }

  public function getTags() {
    try {
      $tag = Tag::orderBy('name', 'asc')->get();
      $this->setData($tag);
      return $this->success();
    } catch (\Exception $e) {
      $this->setMessage($e->getMessage());
      return $this->error();
    }
  }

  public function changeTaskStatus(Request $request) {
    $request->validate([
      'task_id' => 'required',
      'status' => 'required'
    ]);
    DB::beginTransaction();
    try {
      $task = Task::findOrFail($request->task_id);
      $isAssign = $task->assign->where('id', Auth::user()->id)->first();
      $isCreator = $task->created_by == Auth::user()->id;

      if (!$isAssign && !$isCreator) {
        throw new \Exception('Kamu tidak berpartisipasi dalam task ini');
      }

      $task->status = $request->status;
      $task->save();

      DB::commit();
      $this->setData($task);
      return $this->success();
    } catch (\Exception $e) {
      DB::rollBack();
      $this->setMessage($e->getMessage());
      return $this->error();
    }
  }
}
