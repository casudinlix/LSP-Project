<?php

namespace Modules\Dashboard\Http\Controllers\Admin;
/**
 * A class to get information of UserController
 * @author Casudin (com.casudin@gmail.com)
 * @version 1.0
 * @since Wednesday, January 15th, 2020
 */
 use Illuminate\Http\Request;
 use Illuminate\Http\Response;
 //use Illuminate\Routing\Controller;
 use Nwidart\Modules\Routing\Controller;
 use DataTables;
 use DB;
 use Carbon\Carbon;
 use Auth;
 use App\User;
 use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('dashboard::admin.user.index');
    }
    function list()
    {
      return datatables(User::all())
      ->addIndexColumn()
      ->escapeColumns([])
      ->editColumn('status', function ($data) {
         if ($data->status==1) {
           return '<span class="label label-sm label-success arrowed-in label-success">Active</span>';
         } else {
           return '<span class="label label-sm label-danger arrowed-in">Suspend</span>';
         }

      })
      ->addColumn('action', function ($data) {
        if ($data->id==1) {
          return '';
        } else {
          return '
          <div class="hidden-sm hidden-xs action-buttons">
            <a class="blue" data-rel="tooltip" title="Change Role" href="'.route('edit.role.user',[$data->id]).'" data-toggle="modal" data-target="#myModal">
              <i class="ace-icon fa fa-unlock bigger-130"></i>
            </a>

            <a class="green" data-rel="tooltip" title="Edit" href="'.route('user.edit',[$data->id]).'" data-toggle="modal" data-target="#myModal">
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
                  <a href="'.route('edit.role.user',[$data->id]).'" data-toggle="modal" data-target="#myModal"" class="tooltip-info" data-rel="tooltip" title="View">
                    <span class="blue">
                      <i class="ace-icon fa fa-unlock bigger-120"></i>
                    </span>
                  </a>
                </li>

                <li>
                  <a href="'.route('user.edit',[$data->id]).'" data-toggle="modal" data-target="#myModal" class="tooltip-success" data-rel="tooltip" title="Edit">
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
      // ->addColumn('action', function ($data) {
      //   if ($data->id==1) {
      //     return '';
      //   } else {
      //     return '
      //     <div class="btn-group">
      //     <a href="#"  class="btn btn-sm btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="btnGroupDrop1"><i class="fa fa-bars"></i>Option</a>
      //     <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      //       <a href="'.route('user.edit',[$data->id]).'" data-toggle="modal" data-target="#myModal" class="dropdown-item" href="javascript:void(0)">
      //       <i class="fa fa-fw fa-pencil mr-5"></i>Edit</a>
      //       <a href="'.route('edit.role.user',[$data->id]).'" data-toggle="modal" data-target="#myModal" class="dropdown-item" href="javascript:void(0)">
      //       <i class="fa fa-fw fa-lock mr-5"></i>Change Role</a>
      //       <a class="dropdown-item" href="javascript:void(0)" onclick="hapus('."'$data->id'".')">
      //       <i class="fa fa-fw fa-trash mr-5"></i>Hapus</a>
      //
      //         </div>';
      //   }
      // })
      ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
      $role=DB::table('roles')->where('name','!=','Super Admin')->get();
        return view('dashboard::admin.user.create',compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $req)
    {

      DB::beginTransaction();

          try {
              DB::commit();
              // all good
              $this->validate($req, [
                  'name' => 'required|string|max:100',
                  'email' => 'required|email|unique:users',
                  'password' => 'required|min:6',
                  'role' => 'required|string|exists:roles,name'
              ]);
              $user = User::firstOrCreate([
            'email' => $req->email
              ], [
                  'name' => $req->name,
                  'password' => bcrypt($req->password),
                  'status' => true
              ]);
              $user->assignRole($req->role);

              //toastr()->success('Sukses', 'Sukses!');

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
      $user=User::find($id);
      // $role=Role::where('name','!=','Super Admin')->get();
        return view('dashboard::admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
      $validator=$this->validate($request, [
          'name' => 'required|string|max:100',
          //'email' => 'required|email|exists:users,email',
          'password' => 'nullable|min:6',
      ]);
      $user = User::findOrFail($id);
       $password = !empty($request->password) ? bcrypt($request->password):$user->password;
       $user->update([
           'name' => $request->name,
           'password' => $password,
           'email'=>$request->email,
           'status'=>$request->status
       ]);
       return response()->json(['status'=>'success']);


    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
      $user = User::findOrFail($id);
     $user->delete();

     return response()->json(['status'=>'success']);

    }
    public function roles(Request $request, $id)
    {
        $user = User::find($id);
        $roles = Role::where('name','!=','Super Admin')->pluck('name');
        return view('dashboard::admin.user.roles',compact('user','roles'));

    }
    public function setRole(Request $request, $id)
  {
    $this->validate($request, [
       'role' => 'required'
   ]);
   $user = User::findOrFail($id);
   $user->syncRoles($request->role);

   return response()->json(['status'=>'success']);

  }

}
