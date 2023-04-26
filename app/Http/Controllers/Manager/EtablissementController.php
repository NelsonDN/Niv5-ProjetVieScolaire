<?php

namespace App\Http\Controllers\Manager;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;


class EtablissementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etablissements = Etablissement::all();
        $route = 'dashboard_manage.Establishment.create';
        $manager_id = DB::table('model_has_roles')->where('role_id', 2)->pluck('model_id')->toArray();
        $managers = User::whereIn('id', $manager_id)->get();

        return view('admin_manager.gestion_des_établissements.index', compact('etablissements' , 'route','managers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $etablissement = Etablissement::all();
        $manager_id = DB::table('model_has_roles')->where('role_id', 2)->pluck('model_id')->toArray();
        $users = User::whereIn('id', $manager_id)->where('etablissement_id', '=', null)->get();
        
        
        $route = 'Establishment.create';
        return view('admin_manager.gestion_des_établissements.create', compact(['users', 'route']));
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
            'nom' => ['required', 'string', 'max:255', 'unique:etablissements'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:etablissements'],
            'localisation' => ['required', 'string', 'max:255'],
            'bp' => ['required', 'string'],
            'telephone' => ['required', 'string'],
            'logo' => ['required'],
        ]);  
        
        $etablissement = Etablissement::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'localisation' => $request->localisation,
            'bp' => $request->bp,
            'telephone' => $request->telephone,
        ]);
        
        if (isset($request->logo)){
            
            $filename_chemin= 'logo_etablissements/'.$etablissement->id.'.'.$request->logo->getClientOriginalExtension();
            
            $filename= $etablissement->id.'.'.$request->logo->getClientOriginalExtension();
    
            $etablissement->logo = $filename_chemin;
            $etablissement->save();
    
            $request->file('logo')->storeAs('logo_etablissements', $filename, 'public');    

        }

        $manager_id = $request->manager_id;
        foreach($manager_id as $id){
           $manager =  User::findOrFail($id);
           $manager->etablissement_id = $etablissement->id;
           $manager->save();
        
        }

        return redirect()->route('dashboard_manage.etablissements.index')->with('success', "L'établissement $etablissement->nom a bien été crée");


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
        $etablissement = Etablissement::findOrFail($id);

        return view('admin_manager.gestion_des_établissements.show', compact('etablissement'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // if (! Gate::allows('users_manage')) {
        //     return abort(402);
        // }
        $route = 'dashboard_manage.Establishment.edit';
        $etablissement = Etablissement::findOrFail($id);
        $manager_id = DB::table('model_has_roles')->where('role_id', 2)->pluck('model_id')->toArray();
        $users = User::whereIn('id', $manager_id)->where('etablissement_id', null)->get();
        foreach($manager_id as $id){
            $manager_user = User::where('id', $id)->where('etablissement_id', $etablissement->id)->first();
            $manager_user_count = User::where('id', $id)->where('etablissement_id', $etablissement->id)->count();
            
            if($manager_user_count>0){
                $users->push($manager_user);
            }else{
                continue;
            }
        }

        return view('admin_manager.gestion_des_établissements.edit', compact(['users', 'etablissement','route']));
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
        // if (! Gate::allows('users_manage')) {
        //     return abort(402);
        // }
        $request->validate([
            'nom' => ['required', "unique:etablissements,nom,$id"],
            'email' => ['required','email'],
            'localisation' => ['required'],
            'bp' => ['required'],
            'telephone' => ['required'],
        ]);  
        $etablissement = Etablissement::where('id', $id)->first();
        $etablissement->nom = $request->nom;
        $etablissement->email = $request->email;
        $etablissement->localisation = $request->localisation;
        $etablissement->bp = $request->bp;
        $etablissement->telephone = $request->telephone;
        $etablissement->save();

        if(isset($request->logo)){
            !is_null($etablissement->logo) && Storage::disk('public')->delete($etablissement->logo);

            $filename_chemin= 'logo_etablissements/'.$etablissement->id.'.'.$request->logo->getClientOriginalExtension();
            
            $filename= $etablissement->id.'.'.$request->logo->getClientOriginalExtension();
    
            $etablissement->logo = $filename_chemin;
            $etablissement->save();
    
            $request->file('logo')->storeAs('logo_etablissements', $filename, 'public');
        }

        $manager_id = $request->manager_id;
        foreach($manager_id as $id){
           $manager =  User::find($id);
           $manager->etablissement_id = $etablissement->id;
           $manager->save();
        }
        return redirect()->route('dashboard_manage.etablissements.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // if (!Gate::allows('users_manage')) {
        //     return abort(402);
        // }
        
        $etablissement = Etablissement::where('id', $id)->first();
        $etablissement->delete();
        return back()->withSuccess(trans('app.success_destroy'));
    }
}
