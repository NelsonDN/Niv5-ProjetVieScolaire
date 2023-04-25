<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Matiere;
use App\Models\Section;
use App\Models\Classe;
use App\Models\Enseignement;
use App\Rules\nom_unique_subject;
use Illuminate\Support\Facades\DB;
class subjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etablissement_id=auth()->user()->etablissement_id;
        $section_id = Section::where('etablissement_id',$etablissement_id)->pluck('id')->toArray();
        $enseignements = Enseignement::whereIn('section_id', $section_id)->get();
        if ($enseignements->isEmpty()) {
            return redirect()->route('dashboard_manage.Enseignement.index')
            ->with('error' , 'Veuillez tout d\'abord créer un ou plusieurs enseignements');
        }else{
            $enseignement_id = Enseignement::whereIn('section_id', $section_id)->pluck('id')->toArray();
        
            $matieres = Matiere::whereIn('enseignement_id', $enseignement_id)->get();
    
            return view('admin_manager.subject.index', compact(['matieres', 'enseignements']));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    
        $request->validate([
            'name.*'=>['bail', 'required', 'string', new nom_unique_subject],
            'enseignement.*'=>'bail|required|numeric'
        ]);

        $matiere = $request->name;
        $enseignement = $request->enseignement;
        $nbre_de_valeurs_entrante = count($matiere);

        $la_matiere = $matiere[0];
        if ($nbre_de_valeurs_entrante>1){
            $info = "Vos matières ont étés ajoutées "; 
        }else{      
            $info = "La matière $la_matiere a bien été ajoutée ";
        }  
        
        for($i = 0 ; $i < $nbre_de_valeurs_entrante ; $i++) {
            
            Matiere::create([
                'nom'=>$matiere[$i],
                'enseignement_id'=>$enseignement[$i],
            ]);
        
        }
        
        return redirect()->route('dashboard_manage.subject.index')->with('info', $info);
        

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
        //
        $matiere = Matiere::findOrFail($id);
        $etablissement_id=auth()->user()->etablissement_id;
        $section_id = Section::where('etablissement_id',$etablissement_id)->pluck('id')->toArray();
        $enseignement_id = Enseignement::whereIn('section_id', $section_id)->pluck('id')->toArray();
        $enseignements = Enseignement::whereIn('section_id', $section_id)->get();
        $matieres = Matiere::whereIn('enseignement_id', $enseignement_id)->get();

        return view('admin_manager/subject/edit', compact('matiere', 'enseignements', 'matieres'));

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
        //
        $request->validate([
            'name'=>['bail', 'required', new nom_unique_subject],
            'enseignement'=>'bail|required'
        ]);
        
        $subject = Matiere::findOrFail($id);
        
        $subject->update([
            'nom'=>$request->name,
            'enseignement_id'=>$request->enseignement,
        ]);

        $etablissement_id=auth()->user()->etablissement_id;
        $section_id = Section::where('etablissement_id',$etablissement_id)->pluck('id')->toArray();
        $enseignement_id = Enseignement::whereIn('section_id', $section_id)->pluck('id')->toArray();
        $enseignements = Enseignement::whereIn('section_id', $section_id)->get();
        $matieres = Matiere::whereIn('enseignement_id', $enseignement_id)->get();
   
        return view('admin_manager.subject.index', compact('subject','enseignements', 'matieres'))->with('success', "La matière $subject->nom a été mise a jour ");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Matiere::findOrFail($id);
        $classe_lies_a_cette_matiere = DB::table('classe_matiere')->select('classe_id')->where('matiere_id', $subject->id)->pluck('classe_id')->toArray();
        
        $nbre_de_classes = count($classe_lies_a_cette_matiere);

        for ($i = 0; $i < $nbre_de_classes; $i++){
            $les_autres_matieres_des_classes = DB::table('classe_matiere')->where('classe_id',$classe_lies_a_cette_matiere[$i])->count();
            if ($les_autres_matieres_des_classes === 1 ){
                $classe = Classe::findOrFail($classe_lies_a_cette_matiere[$i]);
                return redirect()->back()->with('warning', "Vous ne pouvez pas supprimé cette matière, car elle est lié à la classe $classe->nom qui ne possède que cette unique matière. Bien vouloir ajouter d'autres matières a la classe $classe->nom avant de supprimer la matière $subject->nom");
            }
        }
        $subject->classes()->detach($subject->id);
        $subject->delete();
        
        return redirect()->route('dashboard_manage.subject.index')->with('success', "la matière a bien été supprimée");
    }
}
