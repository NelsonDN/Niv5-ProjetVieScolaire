<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jour;
use App\Rules\jour_unique_etablissement;

class JourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $etablissement_id = auth()->user()->etablissement_id;
        $jours = Jour::where('etablissement_id', $etablissement_id)->get();

        return view('admin_manager.jours.index', compact('jours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin_manager.jours.index');
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
            'jour.*'=>['required', new jour_unique_etablissement],
        ]);

        $jours = $request->jour;
        $etablissement_id = auth()->user()->etablissement_id;

        $nbre_de_valeurs_entrante =count($jours);

        $le_jour = $jours[0];
        if ($nbre_de_valeurs_entrante>1){
            $info = "Vos jours ont bien étés enregistrés "; 
        }else{      
            $info = "Le jour $le_jour a bien été ajouté ";
        }  

        for ($i=0; $i<$nbre_de_valeurs_entrante; $i++){
            Jour::create([
                'jour'=>$jours[$i],
                'etablissement_id'=>$etablissement_id,
            ]);
        }
        return redirect()->route('dashboard_manage.day.index')->with('success', $info);


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
        $jour = Jour::findOrFail($id);
        $etablissement_id = auth()->user()->etablissement_id;
        $jours = Jour::where('etablissement_id', $etablissement_id)->get();

        return view('admin_manager.jours.edit', compact('jour','jours'));
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
            'jour.*'=>['required',new jour_unique_etablissement]
        ]);

        $jours = $request->jour;
        $etablissement_id = auth()->user()->etablissement_id;

        $jour = Jour::findOrFail($id);
        $jour->update([
            'jour'=>$request->jour,
            'etablissement_id'=>$etablissement_id
        ]);

        return redirect()->route('dashboard_manage.day.index')->with('Le jour a bien été mis a jour');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $jour = Jour::findOrFail($id);
        $jour->delete();

        return redirect()->route('dashboard_manage.day.index')->with('Le jour a bien été supprimé');

    }
}
