<?php

namespace App\Http\Controllers\Manager;

use App\Models\User;
use App\Models\Classe;
use App\Models\Matiere;
use App\Models\Section;
use App\Models\Enseignement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Rules\email_unique_user;
use App\Rules\teacher_cannot_have_a_subject_at_the_same_periode;

class teachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $etablissement_id=auth()->user()->etablissement_id;
        $enseignant_id = DB::table('model_has_roles')->where('role_id', 1)->pluck('model_id')->toArray();
        
        $teachers = User::where('etablissement_id', $etablissement_id)->whereIn('id', $enseignant_id)->get();


        return view('admin_manager.teachers.index', compact('teachers'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $etablissement_id=auth()->user()->etablissement_id;
        $section_id = Section::where('etablissement_id',$etablissement_id)->pluck('id')->toArray();
        $enseignement_id = Enseignement::whereIn('section_id', $section_id)->pluck('id')->toArray();
        $enseignements = Enseignement::whereIn('section_id', $section_id)->get();

        // 
        $matieres = Matiere::whereIn('enseignement_id', $enseignement_id)->pluck('id')->toArray();
        $matieres_v = Matiere::whereIn('enseignement_id', $enseignement_id)->get();
        $classe_matieres = DB::table('classe_matiere')->whereNull('user_id')->select(['matiere_id', 'classe_id'])->whereIn('matiere_id', $matieres)->where('user_id', null)->get();


        if ($matieres_v->isEmpty() ) {
            return redirect()->route('dashboard_manage.subject.index')
            ->with('error' , 'Veuillez d\'abord créer une ou plusieurs matieres');
        }elseif( $classe_matieres->isEmpty()) {
            return redirect()->route('dashboard_manage.class.create')
            ->with('error' , 'Veuillez d\'abord créer une ou plusieurs classes');
        }
        else{
            return view('admin_manager.teachers.create', compact('classe_matieres'));
        }
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
            'email' => ['required', 'email', new email_unique_user],
            'password' => ['required', 'confirmed', 'min:6'],
            'avatar' => ['image', 'mimes:jpg,png,svg,gif', 'max:2048'],
            'matiere.*' => ['required','distinct', new teacher_cannot_have_a_subject_at_the_same_periode($request->matiere)],
            
        ]);

        $etablissement_id = auth()->user()->etablissement_id;
        $nom_etablissement = auth()->user()->etablissement->nom;

        // $teacher = User::create($request->all());
        $teacher = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $teacher->etablissement_id = $etablissement_id;
        $teacher->save();


        $teacher->assignRole('teacher');

        foreach ($request->matiere as $value) { 
            $value =  explode(',', $value);
            DB::table('classe_matiere')
            ->where('matiere_id', $value[0])
            ->where('classe_id', $value[1])
            ->update(['user_id' => $teacher->id]);
        }

        return redirect()->route('dashboard_manage.teachers.index')->with ('success', "$teacher->name a bien été ajouté comme enseignant de l'etablissement $nom_etablissement ");
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
        $etablissement_id=auth()->user()->etablissement_id;
        $section_id = Section::where('etablissement_id',$etablissement_id)->pluck('id')->toArray();
        $enseignement_id = Enseignement::whereIn('section_id', $section_id)->pluck('id')->toArray();
        $enseignements = Enseignement::whereIn('section_id', $section_id)->get();
        // $matieres = Matiere::whereIn('enseignement_id', $enseignement_id)->get();
        $teacher = User::find($id);
        $matieres = Matiere::whereIn('enseignement_id', $enseignement_id)->pluck('id')->toArray();
        $classe_matieres = DB::table('classe_matiere')->select(['matiere_id', 'classe_id','user_id'])->whereIn('matiere_id', $matieres)->get();

        return view('admin_manager.teachers.edit', compact(['teacher', 'classe_matieres']));
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
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', "unique:users,email,$id"],
            'password' => $request->password ? ['sometimes', 'confirmed', 'min:6'] : '',
            'avatar' => [ 'image', 'mimes:jpg,png,svg,gif', 'max:2048'],
            'matiere' => ['required',new teacher_cannot_have_a_subject_at_the_same_periode($request->matiere)],
        ]);

        $teacher = User::findOrFail($id);
        $teacher->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // $teacher->update($request->all());
        
        // on supprime premierement l'id de cet enseignant de toutes les matieres dans chaque classe 
        DB::table('classe_matiere')->where('user_id', $teacher->id)->update(['user_id'=>null]);
        
        /*Maintenant nous pouvons parcourir le tableau de matiere d'une classe ,
        et bien choisir le couple (classe , matiere) correspondant dans la table pivot,
        et affecter l'enseignant a donne cette matiere dans cette classe
        */
        foreach ($request->matiere as $value) {
            DB::table('classe_matiere')
            ->where('matiere_id', substr($value, 0, 1))
            ->where('classe_id', substr($value, 2, 1))
            ->update(['user_id' => $teacher->id]);
        }

        return redirect()->route('dashboard_manage.teachers.index')->with('success', "l'enseignant $teacher->name a bien été mis a jour ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $teacher = User ::where('id', $id)->first();
        $teacher->delete();
        return back()->withSuccess(trans('app.success_destroy'));
    }
}
