<?php

namespace Modules\Dashboard\Http\Controllers\Admin;
/**
 * A class to get information of PermissionController
 * @author Casudin (com.casudin@gmail.com)
 * @version 1.0
 * @since Saturday, January 18th, 2020
 */
 use Illuminate\Http\Request;
 use Illuminate\Http\Response;
 //use Illuminate\Routing\Controller;
 use Nwidart\Modules\Routing\Controller;
 use DataTables;
 use DB;
 use Carbon\Carbon;
 use Auth;
 use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('dashboard::admin.permission.index');
    }
    function list()
    {
      return datatables(Permission::all())
      ->addIndexColumn()
      ->escapeColumns([])

      ->addColumn('action', function ($data) {
        if ($data->id==0) {
          return '';
        } else {
          return '
          <div class="hidden-sm hidden-xs action-buttons">


            <a class="green" data-rel="tooltip" title="Edit" href="'.route('permission.edit',[$data->id]).'" data-toggle="modal" data-target="#myModal">
              <i class="ace-icon fa fa-pencil bigger-130"></i>
            </a>

            <a class="red" href="javascript:void(0)" onclick="hapus('."'$data->id'".')">
              <i class="ace-icon fa fa-trash-o bigger-130"></i>
            </a>
          </div>

          <div class="hidden-md hidden-lg">
            <div class="inline pos-rel">
              <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
              </button>

              <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">


                <li>
                  <a href="'.route('permission.edit',[$data->id]).'" data-toggle="modal" data-target="#myModal" class="tooltip-success" data-rel="tooltip" title="Edit">
                    <span class="green">
                      <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                    </span>
                  </a>
                </li>

                <li>
                  <a href="javascript:void(0)" onclick="hapus('."'$data->id'".')" class="tooltip-error" data-rel="tooltip" title="Delete">
                    <span class="red">
                      <i class="ace-icon fa fa-trash-o bigger-120"></i>
                    </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>';
        }
      })
      ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('dashboard::admin.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
      DB::beginTransaction();

          try {
              DB::commit();
              // all good
              $this->validate($request, [
                  'name' => 'required|string|max:50'
                  ]);
                  $role = Permission::firstOrCreate(['name' => $request->name]);

                  return response()->json(['status'=>'success']);

          } catch (\Exception $e) {
              DB::rollback();
              return response()->json(['status'=>'error','msg'=>$e->getMessage()]);

          }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
      $permission=Permission::find($id);
        return view('dashboard::admin.permission.edit',compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
      $role = Permission::findOrFail($id);
      $role->update(['name'=>$request->name]);
      return response()->json(['status'=>'success']);

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
      $role = Permission::findOrFail($id);
      $role->delete();

      return response()->json(['status'=>'success']);
    }
}
