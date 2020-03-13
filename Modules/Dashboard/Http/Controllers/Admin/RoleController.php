<?php

namespace Modules\Dashboard\Http\Controllers\Admin;
/**
 * A class to get information of RoleController
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
 use Spatie\Permission\Models\Role;
 use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('dashboard::admin.role.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
     function list()
     {
       return datatables(Role::all())
       ->addIndexColumn()
       ->escapeColumns([])
       // ->editColumn('status', function ($data) {
       //    if ($data->status==1) {
       //      return '<span class="badge badge-success">Active</span>';
       //    } else {
       //      return '<span class="badge badge-danger">Non Active</span>';
       //    }
       //
       // })
       ->addColumn('action', function ($data) {
         if ($data->id==0) {
           return '';
         } else {
           return '
           <div class="hidden-sm hidden-xs action-buttons">


             <a class="green" data-rel="tooltip" title="Edit" href="'.route('role.edit',[$data->id]).'" data-toggle="modal" data-target="#myModal">
               <i class="ace-icon fa fa-pencil bigger-130"></i>
             </a>
             <a class="red" data-rel="tooltip" title="Assign Permission" href="'.route('rolePermission',[$data->name]).'" data-toggle="modal" data-target="#myModal">
               <i class="ace-icon fa fa-unlock bigger-130"></i>
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
                   <a href="'.route('rolePermission',[$data->name]).'" data-toggle="modal" data-target="#myModal" class="tooltip-success" data-rel="tooltip" title="Assign Permission">
                     <span class="red">
                       <i class="ace-icon fa fa-unlock bigger-120"></i>
                     </span>
                   </a>
                 </li>
                 <li>
                   <a href="'.route('role.edit',[$data->id]).'" data-toggle="modal" data-target="#myModal" class="tooltip-success" data-rel="tooltip" title="Edit">
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
    public function create()
    {
        return view('dashboard::admin.role.create');
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
                  $role = Role::firstOrCreate(['name' => $request->name]);

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
      $role=Role::find($id);
        return view('dashboard::admin.role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
      $role = Role::findOrFail($id);
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
      $role = Role::findOrFail($id);
      $role->delete();

      return response()->json(['status'=>'success']);

    }
    function rolePermission(Request $request)
    {
      $role = $request->segment(4);
      $permissions = null;
      $hasPermission = null;

      $roles = Role::all()->pluck('name');
      if (!empty($role)) {
          //select role berdasarkan namenya, ini sejenis dengan method find()
          $getRole = Role::findByName($role);

          //Query untuk mengambil permission yang telah dimiliki oleh role terkait
          $hasPermission = DB::table('role_has_permissions')
              ->select('permissions.name')
              ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
              ->where('role_id', $getRole->id)->get()->pluck('name')->all();

          //Mengambil data permission
          $permissions = Permission::all()->pluck('name');
      }
//      return view('users.role_permission', compact('roles', 'permissions', 'hasPermission'));
      return view('dashboard::admin.user.role_permission',compact('roles', 'permissions', 'hasPermission'));

    }
    public function addPermission(Request $request,$role)
  {
    $role = Role::findByName($role);

    $role->syncPermissions($request->permission);
    return response()->json(['status'=>'success']);

  }
}
