<?php

namespace App\Http\Controllers\Manager;

use App\Models\Father;
use App\Models\Eleve;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class FatherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['email', 'unique:fathers'],
            'password' => ['required', 'confirmed'],
            'eleve_id' => ['required', 'string', 'max:255'],
            'avatar' => ['image', 'mimes:jpg,png,svg,gif', 'max:2048'],            
        ]);

        $etablissement_id = Auth::user()->id;
        $father = User::create([
            'name' => $request->name,        
            'email' => $request->email,
            'etablissement_id' => $etablissement_id,
            'password' => Hash::make($request->password),
        ]);

        $father->eleves()->attach($request->eleve_id);  

        $father->assignRole('parent');
        
        if (isset($request->avatar))
        {
            $filename_chemin= 'fathersAvatar/'.$father->id.'.'.$request->avatar->getClientOriginalExtension();
            
            $filename= $father->id.'.'.$request->avatar->getClientOriginalExtension();
    
            $father->avatar = $filename_chemin;
            $father->save();
    
            $request->file('avatar')->storeAs('fathersAvatar', $filename, 'public');    
        }

        $eleve = Eleve::find($request->eleve_id);

        return redirect()->route('dashboard_manage.class.show', $eleve->classe_id)->with ('success', "a bien été ajouté");

    }

    /**
     * Display the specified resource.
     */
    public function show(Father $father)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Father $father)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Father $father)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Father $father)
    {
        //
    }
}
