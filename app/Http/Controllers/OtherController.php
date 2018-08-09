<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Role;
use App\Permission;
use DB;

class OtherController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function manage()
    {
        return view('manage.manage');
    }

    public function report()
    {
        return view('report.report');
    }

    public function profile($id)
    {
        $users = User::find($id);
        $roles = Role::pluck('display_name','id');
		$userRole = $users->roles->pluck('id','id');

        foreach ($users->roles as $r) {
            $role = Role::find($r->id);
            $rolePermissions = Permission::join("permission_role","permission_role.permission_id","=","permissions.id")
                ->where("permission_role.role_id",$r->id)
                ->get();
        }

        return view('profile',compact('users','roles','userRole', 'role', 'rolePermissions'));
    }

    public function editProfile(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required|unique:users,username,'.$id,
            'password' => 'same:confirm-password',
        ],
            [
                'username.unique' => 'ຊື່ຜູ້ໃຊ້ນີ້ມີແລ້ວ',
                'password.same' => 'ລະຫັດຜ່ານບໍ່ຄືກັນ',
            ]
        );

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = bcrypt($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('role_user')->where('user_id',$id)->delete();
        //$user->attachRole($request->input('roles'));
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }

        return back()->with('status','ແກ້ໄຂຂໍ້ມູນສໍາເລັດ!');
    }

    public function score()
    {
        if(empty(Auth::user()->te_id)) {
            return redirect()->action('HomeController@index');
        }else{
            return view('manage.score');
        }
    }


}//end Controller
