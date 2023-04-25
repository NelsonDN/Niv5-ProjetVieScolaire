<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin_manager.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('admin_manager.users.create', compact('roles'));
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
            'avatar' => ['image', 'mimes:jpg,png,svg,gif', 'max:2048'],
            'active' => ['required'],
            'roles' => ['required']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => $request->active,
        ]);
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->assignRole($roles);

        if (isset($request->avatar)){
            
            $filename_chemin= 'usersAvatar/'.$user->id.'.'.$request->avatar->getClientOriginalExtension();
            
            $filename= $user->id.'.'.$request->avatar->getClientOriginalExtension();
    
            $user->avatar = $filename_chemin;
            $user->save();
    
            $request->file('avatar')->storeAs('usersAvatar', $filename, 'public');    

        }


        return redirect()->route('users.index')->with('success', "L'utilisateur $user->name a bien été enregistré :) ");

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
        $roles = Role::all();

        return view('admin_manager.users.edit', compact('user', 'roles'));
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', "unique:users,email,$user->id"],
            'password' => ['required', 'confirmed', 'min:6'],
            'avatar' => ['image', 'mimes:jpg,png,svg,gif', 'max:2048'],
            'active' => ['required'],
            'roles' => ['required']
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => $request->active,
        ]);
        $roles = $request->input('roles') ? $request->input('roles') : [];
        $user->syncRoles($roles);

        if(isset($request->avatar)){
            $avatar = $user->avatar;
            !is_null($user->avatar) && Storage::disk('public')->delete($user->avatar);

            // $ok = Storage::disk('public')->exists($avatar);
            // dd($ok);


            // if ($ok){
            //     Storage::disk('public')->delete($avatar);
            // }
            $filename_chemin= 'usersAvatar/'.$user->id.'.'.$request->avatar->getClientOriginalExtension();
            
            $filename= $user->id.'.'.$request->avatar->getClientOriginalExtension();
    
            $user->avatar = $filename_chemin;
            $user->save();
    
            $request->file('avatar')->storeAs('usersAvatar', $filename, 'public');

        }

        return redirect()->route('users.index')->with('success', "L'utilisateur $user->name a bien ete modifié");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', "L'utilisateur a bien ete supprime");
    }
}
