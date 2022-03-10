<?php

namespace Modules\Vendor\Http\Controllers;

use App\Models\Division;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DivisionController extends Controller
{
  public function getDivision(Request $request) {
    $data = Division::where('company_id', $request->company)->get();
    return response()->json([
      'status' => $data ? true : false,
      'message' => $data
    ]);
  }
}
