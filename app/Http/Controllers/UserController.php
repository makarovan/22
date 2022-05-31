<?php
/**
 * User Controller - CRUD: list, add, edit, delete.
 * 
 * Action array users - table user
 * Models Users
 * 
 * @version 1.0
 * @author JKTV20 Makarova 2022
 * @copyright Copyright 2022
 */
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Hash;

class UserController extends Controller
{
    /**
     * Display a list of users.
     *
     * @return array $roles all user roles
     * @return array $users all users
     */
    public function index()
    {
        $roles =array('admin', 'manager', 'user');
        $users = User::orderBy('name', 'asc')->get();
        return view('users.index', compact('users', 'roles'));
    }

    /**
     * Show a list of users with a certain role.
     * 
     * Sort users by roles
     * 
     * @param \Illuminate\Http\Request  $request
     * @param array $data all request data
     * @return array $roles all user roles
     * @return string $selectedRole role that was selected for sorting
     * @return array $users all users with the role
     */
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
     * Show the form for creating a new user.
     *
     * @return array $roles all user roles
     */
    public function create()
    {
        $roles = array('admin', 'manager', 'user');
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created model user in table.
     * 
     * Validates fields and creates model user
     *
     * @param  \Illuminate\Http\Request  $request user's input
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
     * Show a form for registration.
     */
    public function formRegister()
    {
        return view('users.registration');
    }

    /**
     * Store a newly created model user in table.
     * 
     * Store a model user with role 'user' and returns guest to a register page with a message
     * 
     * @param  \Illuminate\Http\Request  $request user's input
     */
    public function storeRegister(Request $request)
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
            'role'=>'user',
        ]);

        return redirect('/register')->with('message', 'Вы успешно зарегистрировались!');
    }

    /**
     * Show the form for editing the user.
     *
     * @param  \App\Models\User  $user user we need to edit
     * @return array $roles all user roles
     */
    public function edit(User $user)
    {
        $roles = array('admin', 'manager', 'user');
        return view('users.edit', compact('user','roles'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request data about the user needed to update
     * @param  \App\Models\User  $user user we update
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required|string|max:255'
        ]);
        if(!isset($request->role)) $request->role=Auth::user()->role;
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
}
