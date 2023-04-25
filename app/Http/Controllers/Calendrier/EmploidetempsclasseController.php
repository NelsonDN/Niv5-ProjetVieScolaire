<?php

namespace App\Http\Controllers\Calendrier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Classe;
use App\Models\Matiere;
use App\Models\Periode;
use App\Models\Jour;
use App\Models\Groupeperiode;


class EmploidetempsclasseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $etablissement_id = auth()->user()->etablissement_id;
        $classe = Classe::findOrFail($id);
        $groupeperiode_id = Groupeperiode::where('etablissement_id', $etablissement_id)->pluck('id')->toArray();
        $jours = Jour::whereIn('groupeperiode_id', $groupeperiode_id)->get();
        $periodes = Periode::whereIn('groupeperiode_id', $groupeperiode_id)->get();


        return view('admin_manager.emploidetemps.classes.show',compact('jours','periodes','classe'));
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
    }
}
