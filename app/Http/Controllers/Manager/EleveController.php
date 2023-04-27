<?php

namespace App\Http\Controllers\Manager;

use App\Models\User;
use App\Models\Classe;
use App\Models\Cycle;
use App\Models\Matiere;
use App\Models\Section;
use App\Models\Enseignement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Eleve;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Nous recuperons id de de l'etablissement de l'utilisateur connecté
        $etablissement_id=auth()->user()->etablissement_id;

        // Nous allons dans la table sections recupéré toutes les sections de l'etablissement de l'utilisateur connecté sous forme de tableau 
        $section_id = Section::where('etablissement_id',$etablissement_id)->pluck('id')->toArray();

        // Pareillement au niveau de la table cycles où Nous recuperons l'id des cycles correspondant aux sections de l'etablissement sous forme de tableau 
        $cycle_id = Cycle::whereIn('section_id',$section_id)->pluck('id')->toArray();

        // Enfin nous avons la liste de toutes les classes de l'etablissement de l'utilisateur connecté
        $classes = Classe::whereIn('cycle_id', $cycle_id)->get();

        return view('admin_manager.eleves.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Nous recuperons id de de l'etablissement de l'utilisateur connecté
        $etablissement_id=auth()->user()->etablissement_id;

        // Nous allons dans la table sections recupéré toutes les sections de l'etablissement de l'utilisateur connecté sous forme de tableau 
        $section_id = Section::where('etablissement_id',$etablissement_id)->pluck('id')->toArray();

        // Pareillement au niveau de la table cycles où Nous recuperons l'id des cycles correspondant aux sections de l'etablissement sous forme de tableau 
        $cycle_id = Cycle::whereIn('section_id',$section_id)->pluck('id')->toArray();

        // Enfin nous avons la liste de toutes les classes de l'etablissement de l'utilisateur connecté
        $classes = Classe::whereIn('cycle_id', $cycle_id)->get();

        return view('admin_manager.eleves.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'prename' => ['required', 'string', 'max:255'],
            'date_naissance' => ['required', 'string', 'max:255'],
            'sexe' => ['required', 'string', 'max:255'],
            'matricule' => ['required', 'string', 'max:255'],
            'classe_id' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'localisation' => ['required', 'string', 'max:255'],
            'avatar' => ['image', 'mimes:jpg,png,svg,gif', 'max:2048'],            
        ]);

        if(isset($request->email) && isset($request->password))
        {
            $request->validate([
                'email' => ['email', 'unique:eleves'],
                'password' => ['confirmed', 'min:6'],
            ]);
        }

        $eleve = Eleve::create([
            'name' => $request->name,
            'prename' => $request->prename,
            'classe_id' => $request->classe_id,
            'date_naissance' => $request->date_naissance,
            'sexe' => $request->sexe,    
            'matricule' => $request->matricule,            
            'telephone' => $request->telephone,
            'localisation' => $request->localisation,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (isset($request->avatar)){
            
            $filename_chemin= 'elevesAvatar/'.$eleve->id.'.'.$request->avatar->getClientOriginalExtension();
            
            $filename= $eleve->id.'.'.$request->avatar->getClientOriginalExtension();
    
            $eleve->avatar = $filename_chemin;
            $eleve->save();
    
            $request->file('avatar')->storeAs('elevesAvatar', $filename, 'public');    

        }

        return redirect()->route('dashboard_manage.class.show', $eleve->classe_id)->with ('success', "$eleve->name $eleve->prename a bien été ajouté dans la classe ");

    }

    /**
     * Display the specified resource.
     */
    public function show(Eleve $eleve)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Eleve $eleve)
    {
        // Nous recuperons id de de l'etablissement de l'utilisateur connecté
        $etablissement_id=auth()->user()->etablissement_id;

        // Nous allons dans la table sections recupéré toutes les sections de l'etablissement de l'utilisateur connecté sous forme de tableau 
        $section_id = Section::where('etablissement_id',$etablissement_id)->pluck('id')->toArray();

        // Pareillement au niveau de la table cycles où Nous recuperons l'id des cycles correspondant aux sections de l'etablissement sous forme de tableau 
        $cycle_id = Cycle::whereIn('section_id',$section_id)->pluck('id')->toArray();

        // Enfin nous avons la liste de toutes les classes de l'etablissement de l'utilisateur connecté
        $classes = Classe::whereIn('cycle_id', $cycle_id)->get();
        
        return view('admin_manager.eleves.edit', compact('eleve', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Eleve $eleve)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'prename' => ['required', 'string', 'max:255'],
            'date_naissance' => ['required', 'string', 'max:255'],
            'sexe' => ['required', 'string', 'max:255'],
            'matricule' => ['required', 'string', 'max:255'],
            'classe_id' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
            'localisation' => ['required', 'string', 'max:255'],
            'avatar' => ['image', 'mimes:jpg,png,svg,gif', 'max:2048'],            
        ]);

        if(isset($request->email) && isset($request->password))
        {
            $request->validate([
                'email' => ['email', 'unique:eleves'],
                'password' => ['confirmed', 'min:6'],
            ]);
        }

        $etablissement_id = auth()->user()->etablissement_id;

        $eleve->update([
            'name' => $request->name,
            'prename' => $request->prename,
            'classe_id' => $request->classe_id,
            'date_naissance' => $request->date_naissance,
            'sexe' => $request->sexe, 
            'matricule' => $request->matricule,            
            'telephone' => $request->telephone,
            'localisation' => $request->localisation,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if(isset($request->avatar)){

            !is_null($eleve->avatar) && Storage::disk('public')->delete($eleve->avatar);

            $filename_chemin= 'usersAvatar/'.$eleve->id.'.'.$request->avatar->getClientOriginalExtension();
            
            $filename= $eleve->id.'.'.$request->avatar->getClientOriginalExtension();
    
            $eleve->avatar = $filename_chemin;
            $eleve->save();
    
            $request->file('avatar')->storeAs('usersAvatar', $filename, 'public');

        }

        return redirect()->route('dashboard_manage.class.show', $eleve->classe_id)->with ('success', " L'élève $eleve->name $eleve->prename a bien été modifié ");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Eleve $eleve)
    {
        $eleve->delete();

        return redirect()->route('dashboard_manage.class.show', $eleve->classe_id)->with ('success', "$eleve->name $eleve->prename a bien été supprimé !");
    }
}
