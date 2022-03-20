<?php

namespace Modules\Vendor\Http\Controllers;

use App\Models\Company;
use App\Models\Division;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Str;

class VendorController extends Controller
{
  public function dashboard() {
    return view('vendor::dashboard');
  }

  public function company(Request $request, Builder $builder) {
    // dd(Company::with('divisi')->where('id', 2)->first());
    if(request()->ajax()) {
      return DataTables::of(Company::query()->with('division')->where('vendor_id', Auth::user()->id))->addColumn('action', function ($row) {
        $actionBtn = '
          <button class="btn btn-sm btn-primary" onclick="setCompany('. $row->id .')" data-bs-toggle="modal" data-bs-target="#border-less">
            <span class="text-nowrap">Add Division</span>
          </button>
        ';
        return $actionBtn;
      })->addColumn('division', function($row) {
        $listDivision = '<ul class="list-group">';
        foreach ($row->division->sortByDesc('users') as $key => $value) {
          $listDivision .= '
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <span>'. $value->name .'</span>
              <span class="badge bg-success badge-pill badge-round ml-1">'. count($value->users) .'</span>
            </li>
          ';
        }
        return $listDivision . '</ul>';
      })->editColumn('name', function($row) {
        return '<div class="text-nowrap">'. $row->name .'</div>';
      })->rawColumns([
        'action', 'division', 'name'
      ])->addIndexColumn()->setTotalRecords(8)->toJson();
    }

    $html = $builder->columns([
      [
        'defaultContent' => '',
        'data'           => 'DT_RowIndex',
        'name'           => 'DT_RowIndex',
        'title'          => 'No.',
        'render'         => null,
        'orderable'      => false,
        'searchable'     => false,
        'exportable'     => false,
        'printable'      => true,
        'className'      => 'align-top',
      ],
      ['data' => 'name', 'name' => 'name', 'title' => 'Name', 'className' => 'align-top pe-3'],
      ['data' => 'division', 'name' => 'division', 'title' => 'Division', 'orderable' => false, 'searchable' => false, 'className' => 'w-100'],
      ['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable' => false, 'className' => 'align-top'],
    ])->parameters([
      'dom'   => 'Bfrtip',
    ]);

    return view('vendor::company.company-data', compact('html'));
  }

  public function companyCreate() {
    return view('vendor::company.company-create');
  }

  public function companyStore(Request $request) {
    $request->validate([
      'name' => 'required',
      'phone' => 'required',
    ]);
    DB::beginTransaction();
    try {
      $slug = Str::slug($request->name, '-');
      $hasReg = Company::where('vendor_id', Auth::user()->id)->where('slug', $slug)->first();
      if ($hasReg) throw new \Exception('Kamu sudah mendaftarkan perusahaan ini');

      $company = new Company();
      $company->name = $request->name;
      $company->slug = $slug;
      $company->phone = $request->phone;
      $company->vendor_id = Auth::user()->id;
      $company->address = $request->address ?? null;
      $company->save();
      DB::commit();

      return redirect()->route('vendor.company');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->route('vendor.company.create')->withErrors($e->getMessage());
    }
  }

  public function divisionStore(Request $request, $companyId) {
    $request->validate([
      'name' => 'required'
    ]);
    DB::beginTransaction();
    try {
      $dSlug = Str::slug($request->name, '-');
      $division = Division::where('company_id', $companyId)->where('slug', $dSlug)->first();
      if ($division) throw new \Exception('Kamu sudah membuat divisi ini sebelumnya');
      $dStore = new Division();
      $dStore->company_id = $companyId;
      $dStore->name = $request->name;
      $dStore->slug = $dSlug;
      $dStore->save();
      DB::commit();

      return redirect()->route('vendor.company');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->route('vendor.company')->withErrors($e->getMessage());
    }
  }

  public function employee(Request $request, Builder $builder) {
    if(request()->ajax()) {
      return DataTables::of(User::query()->with('division')->orderBy('name', 'asc'))->addColumn('action', function ($row) {
        $actionBtn = '
          <button class="btn btn-sm btn-primary" onclick="setCompany('. $row->id .')" data-bs-toggle="modal" data-bs-target="#border-less">
            <span class="text-nowrap">Update Data</span>
          </button>
        ';
        return $actionBtn;
      })->addColumn('company', function($row) {
        return $row->company->name;
      })->addColumn('division', function($row) {
        return $row->division->name;
      })->editColumn('name', function($row) {
        return '<div class="text-nowrap">'. $row->name .'</div>';
      })->rawColumns([
        'action', 'division', 'name'
      ])->addIndexColumn()->setTotalRecords(8)->toJson();
    }

    $html = $builder->columns([
      [
        'defaultContent' => '',
        'data'           => 'DT_RowIndex',
        'name'           => 'DT_RowIndex',
        'title'          => 'No.',
        'render'         => null,
        'orderable'      => false,
        'searchable'     => false,
        'exportable'     => false,
        'printable'      => true,
        'className'      => 'align-top',
      ],
      ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
      ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
      ['data' => 'company', 'name' => 'company', 'title' => 'Company'],
      ['data' => 'division', 'name' => 'division', 'title' => 'Division'],
      ['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable' => false, 'className' => 'align-top'],
    ])->parameters([
      'dom'   => 'Bfrtip',
    ]);

    $company = Company::where('vendor_id', Auth::user()->id)->orderBy('name', 'ASC')->get();

    return view('vendor::employee.employee-data', compact('html', 'company'));
  }

  public function employeeStore(Request $request) {
    $request->validate([
      'name' => 'required',
      'email' => 'required|unique:users,email',
      'company' => 'required',
      'division' => 'required',
      'password' => 'required'
    ]);
    DB::beginTransaction();
    try {
      $user = new User();
      $user->name = $request->name;
      $user->email = $request->email;
      $user->company_id = $request->company;
      $user->division_id = $request->division;
      $user->password = Hash::make($request->password);
      $user->save();
      DB::commit();

      return redirect()->route('vendor.employee');
    } catch (\Exception $e) {
      DB::rollBack();
      return redirect()->back()->withErrors($e->getMessage());
    }
  }

  public function task(Request $request, Builder $builder) {
    // $data = Company::with('division.task')->get();
    // dd($data);
    if(request()->ajax()) {
      return DataTables::of(Company::query()->with('division.task')->where('vendor_id', Auth::user()->id))->addColumn('division', function($row) {
        $listDivision = '<div>';
        foreach ($row->division->sortByDesc('task') as $key => $value) {
          $task = count($value->task);
          $todo = count($value->task->where('status', 1)) * $task / $task;
          $iceBox = count($value->task->where('status', 2)) * $task / $task;
          $backLog = count($value->task->where('status', 3)) * $task / $task;
          $onProgress = count($value->task->where('status', 4)) * $task / $task;
          $riview = count($value->task->where('status', 5)) * $task / $task;
          $complete = count($value->task->where('status', 6)) * $task / $task;
          $todoAnimateWidth = $todo < 3 ? 3 : $todo;
          $iceBoxAnimateWidth = $iceBox < 3 ? 3 : $iceBox;
          $backLogAnimateWidth = $backLog < 3 ? 3 : $backLog;
          $onProgressAnimateWidth = $onProgress < 3 ? 3 : $onProgress;
          $riviewAnimateWidth = $riview < 3 ? 3 : $riview;
          $completeAnimateWidth = $complete < 3 ? 3 : $complete;
          $listDivision .= '
            <div class="mt-1">
              <span class="btn btn-dark btn-sm position-relative">
                '. $value->name .' Division
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  '. $task .'
                  <span class="visually-hidden">unread messages</span>
                </span>
              </span>
            </div>
            <div class="">
              <div class="text-end">
                <span class="badge rounded-pill bg-primary" style="font-size: 10px">Todo</span>
              </div>
              <div class="progress mt-1">
                <div
                  class="progress-bar progress-bar-striped bg-info progress-bar-animated"
                  role="progressbar"
                  aria-valuenow="'. $todoAnimateWidth .'"
                  aria-valuemin="0"
                  aria-valuemax="100"
                  style="width: '. $todoAnimateWidth .'%; font-size: 10px"
                >
                  '. $todo .'%
                </div>
              </div>
            </div>
            <div class="">
              <div class="text-end">
                <span class="badge rounded-pill bg-primary" style="font-size: 10px">Icebox</span>
              </div>
              <div class="progress mt-1">
                <div
                  class="progress-bar progress-bar-striped bg-info progress-bar-animated"
                  role="progressbar"
                  aria-valuenow="'. $iceBoxAnimateWidth .'"
                  aria-valuemin="0"
                  aria-valuemax="100"
                  style="width: '. $iceBoxAnimateWidth .'%"
                >
                  '. $iceBox .'%
                </div>
              </div>
            </div>
            <div class="">
              <div class="text-end">
                <span class="badge rounded-pill bg-primary" style="font-size: 10px">Backlog</span>
              </div>
              <div class="progress mt-1">
                <div
                  class="progress-bar progress-bar-striped bg-info progress-bar-animated"
                  role="progressbar"
                  aria-valuenow="'. $backLogAnimateWidth .'"
                  aria-valuemin="0"
                  aria-valuemax="100"
                  style="width: '. $backLogAnimateWidth .'%"
                >
                  '. $backLog .'%
                </div>
              </div>
            </div>
            <div class="">
              <div class="text-end">
                <span class="badge rounded-pill bg-primary" style="font-size: 10px">On Progress</span>
              </div>
              <div class="progress mt-1">
                <div
                  class="progress-bar progress-bar-striped bg-info progress-bar-animated"
                  role="progressbar"
                  aria-valuenow="'. $onProgressAnimateWidth .'"
                  aria-valuemin="0"
                  aria-valuemax="100"
                  style="width: '. $onProgressAnimateWidth .'%"
                >
                  '. $onProgress .'%
                </div>
              </div>
            </div>
            <div class="">
              <div class="text-end">
                <span class="badge rounded-pill bg-primary" style="font-size: 10px">Riview</span>
              </div>
              <div class="progress mt-1">
                <div
                  class="progress-bar progress-bar-striped bg-info progress-bar-animated"
                  role="progressbar"
                  aria-valuenow="'. $riviewAnimateWidth .'"
                  aria-valuemin="0"
                  aria-valuemax="100"
                  style="width: '. $riviewAnimateWidth .'%"
                >
                  '. $riview .'%
                </div>
              </div>
            </div>
            <div class="">
              <div class="text-end">
                <span class="badge rounded-pill bg-primary" style="font-size: 10px">Complete</span>
              </div>
              <div class="progress mt-1">
                <div
                  class="progress-bar progress-bar-striped bg-info progress-bar-animated"
                  role="progressbar"
                  aria-valuenow="'. $completeAnimateWidth .'"
                  aria-valuemin="0"
                  aria-valuemax="100"
                  style="width: '. $completeAnimateWidth .'%"
                >
                  '. $complete .'%
                </div>
              </div>
            </div>
          ';
        }
        return $listDivision . '</div>';
        return 'ok';
      })->editColumn('name', function($row) {
        return '<div class="text-nowrap" style="width: 160px">'. $row->name .'</div>';
      })->rawColumns([
        'division', 'name'
      ])->addIndexColumn()->setTotalRecords(8)->toJson();
    }

    $html = $builder->columns([
      [
        'defaultContent' => '',
        'data'           => 'DT_RowIndex',
        'name'           => 'DT_RowIndex',
        'title'          => 'No.',
        'render'         => null,
        'orderable'      => false,
        'searchable'     => false,
        'exportable'     => false,
        'printable'      => true,
        'className'      => 'align-top',
      ],
      ['data' => 'name', 'name' => 'name', 'title' => 'Name', 'className' => 'align-top pe-3'],
      ['data' => 'division', 'name' => 'division', 'title' => 'Division', 'orderable' => false, 'searchable' => false, 'className' => 'w-100'],
    ])->parameters([
      'dom'   => 'Bfrtip',
    ]);

    return view('vendor::task.index', compact('html'));
  }
}
