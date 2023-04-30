<?php

namespace App\Http\Controllers\Manager;

use App\Models\Absence;
use App\Models\Note;
use App\Models\Matiere;
use App\Models\Classe;
use App\Models\User;
use App\Models\Section;
use App\Models\Cycle;
use App\Models\Eleve;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use App\Models\Typedecour;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Evaluation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AbsenceController extends Controller
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

    public function data_prev(Request $request)
    {
        $request->validate([
            'classe' => ['bail', 'required'],
            'matiere' => ['bail', 'required'],
            'typedecour' => ['required'],
        ]);

        $request->session()->put('classe',$request->classe);
        $request->session()->put('matiere',$request->matiere);
        $request->session()->put('typedecour',$request->typedecour);


        return redirect()->route('dashboard_manage.absences.create');
    }

    /**
     * Fonction create
    */
    public function create()
    {
        $classe = Classe::findOrFail(session()->get('classe'));
        $matiere = Matiere::findOrFail(session()->get('matiere'));
        $typedecour = Typedecour::findOrFail(session()->get('typedecour'));

        $eleves = Eleve::where('classe_id', session()->get('classe'))->orderBy('name', 'asc')->get();

        return view('admin_manager.absences.create', compact('eleves', 'classe', 'matiere', 'typedecour'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'absence.*' => ['bail', 'required'],
            'eleve_id.*' => ['bail', 'required'],
        ]);

        $classe = Classe::findOrFail(session()->get('classe'));
        $matiere = Matiere::findOrFail(session()->get('matiere'));
        $typedecour = Typedecour::findOrFail(session()->get('typedecour'));

        $now = CarbonImmutable::now();

        $eleves = $request->eleve_id;
        $absences = $request->absence;
        $nbre_de_valeurs_entrante = count($eleves);

        for ( $i=0 ; $i < $nbre_de_valeurs_entrante ; $i++ )
        {
            if(Arr::exists($absences, $eleves[$i]))
            {
                $b = 0;
            }else
            {
                Absence::create([
                    "matiere_id" => $matiere->id,
                    "eleve_id" => $eleves[$i],
                    "date_seance" => $now,
                    "typedecour_id" => $typedecour->id,
                ]);
            }
        }

        // Destruction des variables de session
        $request->session()->forget('typedecour');
        $request->session()->forget('classe');
        $request->session()->forget('matiere');

        return redirect()->route('dashboard')->with('success', "L'appel a bien été effectué");
    }

    /**
     * Display the specified resource.
     */
    public function show(Absence $absence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Absence $absence)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Absence $absence)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Absence $absence)
    {
        //
    }
}
