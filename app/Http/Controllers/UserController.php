<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles =array('admin', 'manager', 'user');
        $users = User::orderBy('name', 'asc')->get();
        return view('users.index', compact('users', 'roles'));
    }

    public function userByrole(Request $request){
        $roles = array('admin', 'manager', 'user');
        $data = $request->all();
        $selectRole=$data['role'];
        if($data['role']=="0"){
            return redirect('/users');
        }else{
            $users = User::where('role', 'LIKE', $data['role'])->get();
            return view('users.index', compact('users', 'roles', 'selectRole'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = array('admin', 'manager', 'user');
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=>'required|string|min:6|confirmed',
            'password_confirmation'=>'required',
        ]);

        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>$request->role,
        ]);
        return redirect('users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = array('admin', 'manager', 'user');
        return view('users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required|string|max:255'
        ]);
        if($request->password){
            $request->validate([
                'password'=> 'required|string|min:6|confirmed',
                'password_confirmation'=>'required',
            ]);
            $user->update([
                'name'=>$request->name,
                'password'=>Hash::make($request->password),
                'role'=>$request->role
            ]);
        }else{
            $user->update([
                'name'=>$request->name,
                'role'=>$request->role
            ]);
        }
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
