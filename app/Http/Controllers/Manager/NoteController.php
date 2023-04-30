<?php

namespace App\Http\Controllers\Manager;

use App\Models\Note;
use App\Models\Matiere;
use App\Models\Classe;
use App\Models\User;
use App\Models\Section;
use App\Models\Cycle;
use App\Models\Eleve;
use Illuminate\Support\Facades\DB;
use App\Models\Evaluation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        // Liste des evaluations
        $evaluations = Evaluation::where('etablissement_id', auth()->user()->etablissement_id)->get();

        // Liste des classes
        $section_id = Section::where('etablissement_id',auth()->user()->etablissement_id)->pluck('id')->toArray();
        $cycle_id = Cycle::whereIn('section_id',$section_id)->pluck('id')->toArray();
        $classes = Classe::whereIn('cycle_id', $cycle_id)->get();

        // Liste des matieres 
        $teacher_matieres = DB::table('classe_matiere')->where('user_id', auth()->user()->id)->pluck('matiere_id')->toArray();
        $teacher_classes = DB::table('classe_matiere')->where('user_id', auth()->user()->id)->pluck('classe_id')->toArray();
        $classes = Classe::whereIn('id', $teacher_classes)->get();
        $matieres = Matiere::whereIn('id', $teacher_matieres)->get();
        $notes = Note::where('eleve_id', 0);

        //  $users = User::permission('teachers')->get();
        // $users = User::role('teachers')->get();
        return view('admin_manager.notes.index', [
            'evaluations' => $evaluations,
            'classes' => $classes,
            'matieres' => $matieres,
            'notes' => $notes,
            
        ]);
    }

    public function indexEleves(Request $request)
    {
        $request->validate([
            'evaluation' => ['required'],
            'classe' => ['required'],
            'matiere' => ['required']
        ]);

        // Liste des evaluations
        $evaluations = Evaluation::where('etablissement_id', auth()->user()->etablissement_id)->get();

        // Liste des classes
        $section_id = Section::where('etablissement_id',auth()->user()->etablissement_id)->pluck('id')->toArray();
        $cycle_id = Cycle::whereIn('section_id',$section_id)->pluck('id')->toArray();
        $classes = Classe::whereIn('cycle_id', $cycle_id)->get();

        // Liste des matieres 
        $teacher_matieres = DB::table('classe_matiere')->where('user_id', auth()->user()->id)->pluck('matiere_id')->toArray();
        $teacher_classes = DB::table('classe_matiere')->where('user_id', auth()->user()->id)->pluck('classe_id')->toArray();
        $classes = Classe::whereIn('id', $teacher_classes)->get();
        $matieres = Matiere::whereIn('id', $teacher_matieres)->get();
        $eleves = Eleve::where('classe_id', 1);

        $evaluation_ = Evaluation::findOrFail($request->evaluation);
        $classe_ = Classe::findOrFail($request->classe);
        $matiere_ = Matiere::findOrFail($request->matiere);

        $notes = Note::where('evaluation_id', $evaluation_->id)->where('matiere_id', $matiere_->id)->get();
        // dd($evaluation, $request->evaluation);

        return view("admin_manager.notes.eleves", compact('notes', 'evaluations', 'classes', 'matieres', 'evaluation_', 'matiere_', 'classe_'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function data_prev(Request $request)
    {
        $request->validate([
            'evaluation' => ['bail', 'required'],
            'classe' => ['bail', 'required'],
            'matiere' => ['bail', 'required']
        ]);

        $request->session()->put('evaluation',$request->evaluation);
        $request->session()->put('classe',$request->classe);
        $request->session()->put('matiere',$request->matiere);

        return redirect()->route('dashboard_manage.notes.create');
    }

    /**
     * Fonction create
     */

    public function create()
    {
        $evaluation = Evaluation::findOrFail(session()->get('evaluation'));
        $classe = Classe::findOrFail(session()->get('classe'));
        $matiere = Matiere::findOrFail(session()->get('matiere'));

        $eleves = Eleve::where('classe_id', session()->get('classe'))->orderBy('name', 'asc')->get();

        return view('admin_manager.notes.create', compact('eleves', 'evaluation', 'classe', 'matiere'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'note.*' => ['bail', 'required'],
            'eleve_id.*' => ['bail', 'required'],
        ]);

        $evaluation = Evaluation::findOrFail(session()->get('evaluation'));
        $classe = Classe::findOrFail(session()->get('classe'));
        $matiere = Matiere::findOrFail(session()->get('matiere'));

        $eleves = $request->eleve_id;
        $notes = $request->note;

        $nbre_de_valeurs_entrante = count($eleves);
        
        for ( $i=0 ; $i < $nbre_de_valeurs_entrante ; $i++ )
        {
            Note::create([
                "note" => $notes[$i],
                "eleve_id" => $eleves[$i],
                "evaluation_id" => $evaluation->id,
                "matiere_id" => $matiere->id,
            ]);
        }

        // Destruction des variables de session
        $request->session()->forget('evaluation');
        $request->session()->forget('classe');
        $request->session()->forget('matiere');

        return redirect()->route('dashboard')->with('success', "Les notes de $matiere->nom de la classe $classe->nom ont bien été enregistrés");
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'note.*' => ['bail', 'required'],
            'eleve_id.*' => ['bail', 'required'],
            'matiere_' => ['required'],
            'classe_' => ['required'],
            'evaluation_' => ['required'],
        ]);

        $evaluation_ = Evaluation::findOrFail($request->evaluation_);
        $classe_ = Classe::findOrFail($request->classe_);
        $matiere_ = Matiere::findOrFail($request->matiere_);

        $note_id = $request->note_id;
        $eleves = $request->eleve_id;
        $notes = $request->note;

        $nbre_de_valeurs_entrante = count($eleves);
        
        for ( $i=0 ; $i < $nbre_de_valeurs_entrante ; $i++ )
        {
            Note::findOrFail($note_id[$i])->update([
                "note" => $notes[$i],
                "eleve_id" => $eleves[$i],
                "evaluation_id" => $evaluation_->id,
                "matiere_id" => $matiere_->id,
            ]);
        }

        return redirect()->route('dashboard')->with('success', "Les notes de $matiere_->nom de la classe $classe_->nom ont bien été enregistrés");
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
    }
}
