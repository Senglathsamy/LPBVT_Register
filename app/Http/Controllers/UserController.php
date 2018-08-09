<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use App\Role;
use App\User;
use Auth;
use DB;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     *
     **/
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $users = User::query()->where('id', '!=', Auth::user()->id)->get();
        $users = User::query()->get();
        return view('users.index', compact('users'))->with('i', 0);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users,username',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
            ],
            [
                'username.unique' => 'ຊື່ຜູ້ໃຊ້ນີ້ມີແລ້ວ',
                'password.same' => 'ລະຫັດຜ່ານບໍ່ຄືກັນ',
            ]
        );

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);
//        $user->attachRole($request->input('roles'));

        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }

        return redirect()->route('users.index')
            ->with('status','User Add Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('display_name','id');
        $userRole = $user->roles->pluck('id','id')->toArray();
        return view('users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'username' => 'required|unique:users,username,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
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
//        $user->attachRole($request->input('roles'));
        foreach ($request->input('roles') as $key => $value) {
            $user->attachRole($value);
        }

        return redirect()->route('users.index')
            ->with('status','ແກ້ໄຂຂໍ້ມູນສໍາເລັດ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return back();
    }
}
