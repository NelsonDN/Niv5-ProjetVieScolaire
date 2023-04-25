<?php

namespace App\Http\Controllers\Calendrier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jour;
use App\Models\Periode;
use App\Models\User;
use App\Models\Groupeperiode;
use Illuminate\Support\Facades\DB;
use Carbon\CarbonImmutable;
use Carbon\Carbon;

class EmploidetempsteacherController extends Controller
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
        $groupeperiode_id = Groupeperiode::where('etablissement_id', $etablissement_id)->pluck('id')->toArray();
        $jours = Jour::whereIn('groupeperiode_id', $groupeperiode_id)->get();
        $periodes = Periode::whereIn('groupeperiode_id', $groupeperiode_id)->get();
        $now = CarbonImmutable::now();
        
        if($periodes->isEmpty()){
            
            return redirect()->route('dashboard_manage.period.create')
            ->with('error' , 'Veuillez tout d\'abord créer une ou plusieurs periodes');
        }else{
            return view("admin_manager.emploidetemps.teachers.index", compact('jours','periodes','now'));
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
        $teacher = User::findOrFail($id);
        $groupeperiode_id = Groupeperiode::where('etablissement_id', $etablissement_id)->pluck('id')->toArray();
        $jours = Jour::whereIn('groupeperiode_id', $groupeperiode_id)->get();
        $periodes = Periode::whereIn('groupeperiode_id', $groupeperiode_id)->get();

        return view("admin_manager.emploidetemps.teachers.show", compact('jours','periodes','teacher'));
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
