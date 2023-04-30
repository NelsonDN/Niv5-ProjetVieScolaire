<?php

namespace App\Http\Controllers\Manager;

use App\Models\Evaluation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\evaluation_unique;


class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etablissement_id = auth()->user()->etablissement_id;

        $evaluations = Evaluation::where('etablissement_id', $etablissement_id)->get();
        
        return view('admin_manager.evaluations.index', compact('evaluations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $etablissement_id = auth()->user()->etablissement_id;

        $evaluations = Evaluation::where('etablissement_id', $etablissement_id)->get();
        
        return view('admin_manager.evaluations.index', compact('evaluations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name.*'=>['required'],
        ]);

        $names = $request->name;
        $etablissement_id = auth()->user()->etablissement_id;

        $nbre_de_valeurs_entrante = count($names);

        $name = $names[0];
        if ($nbre_de_valeurs_entrante>1){
            $info = "Vos évaluations ont bien étés enregistrés "; 
        }else{      
            $info = "L'evaluations $name a bien été ajouté ";
        }  

        for ($i=0; $i<$nbre_de_valeurs_entrante; $i++){
            Evaluation::create([
                'name'=>$names[$i],
                'etablissement_id'=>$etablissement_id,
            ]);
        }
        return redirect()->route('dashboard_manage.evaluations.index')->with('success', $info);


    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluation $evaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $evaluation)
    {
        $etablissement_id = auth()->user()->etablissement_id;

        $evaluations = Evaluation::where('etablissement_id', $etablissement_id)->get();
        
        return view('admin_manager.evaluations.edit', compact('evaluations', 'evaluation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        $request->validate([
            'name'=>['required']
        ]);

        $etablissement_id = auth()->user()->etablissement_id;

        $evaluation->update([
            'name'=>$request->name,
            'etablissement_id'=>$etablissement_id
        ]);

        return redirect()->route('dashboard_manage.evaluations.index')->with('success', "l'évaluation $evaluation->name a bien été modifiée !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete();

        return redirect()->route('dashboard_manage.evaluations.index')->with('success', "l'évaluation a bien été supprimée !");
    }
}
