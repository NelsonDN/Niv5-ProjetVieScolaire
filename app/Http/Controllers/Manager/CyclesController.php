<?php

namespace App\Http\Controllers\Manager;

use App\Models\Cycle;
use App\Models\Section;
use App\Rules\nom_unique_cycle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CyclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etablissement_id=auth()->user()->etablissement_id;
        $sections = Section::where('etablissement_id',$etablissement_id)->get();
        
        if ($sections->isEmpty()) {   
            return redirect()->route('dashboard_manage.Sections.index')
            ->with('error' , 'Veuillez tout d\'abord créer une ou plusieurs sections');
        }else{
            $section_id= Section::where('etablissement_id',$etablissement_id)->pluck('id')->toArray();
            
            $cycles = Cycle::whereIn('section_id',$section_id)->get();

            return view('admin_manager.Sections_Cycles.Cycles.index' , compact('cycles','sections'));
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
        $request->validate([
            'name' => ['required', 'string', 'max:255', new nom_unique_cycle],
            'section'=>['required', 'exists:sections,id'],
        ]);  

        // die($section_id['etablissement_id']);
        
        $cycle = Cycle::create([
            'name'=> $request->name,
            'section_id'=>$request->section,
        ]);
        
        return back()->with('info', "le cycle $cycle->name a ete ajouté");
       
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
        $cycle=Cycle::findOrFail($id);
        $etablissement_id=auth()->user()->etablissement_id;
        $sections = Section::where('etablissement_id',$etablissement_id)->get();
        $section_id= Section::where('etablissement_id',$etablissement_id)->pluck('id')->toArray();
        
        $cycles = Cycle::whereIn('section_id',$section_id)->get();

        return view('admin_manager.Sections_Cycles.Cycles.edit', compact(['cycle', 'cycles','sections']));
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
            'name'=>['required', 'string', new nom_unique_cycle, 'max:255'], 
            'section'=>['required'],
        ]);

        $cycle = Cycle::findOrFail($id);
        $cycle->update([
            'name'=>$request->name,
            'section_id'=>$request->section,
        ]);
        $etablissement_id=auth()->user()->etablissement_id;
        $sections = Section::where('etablissement_id',$etablissement_id)->get();
        $section_id= Section::where('etablissement_id',$etablissement_id)->pluck('id')->toArray();
        
        $cycles = Cycle::whereIn('section_id',$section_id)->get();

        return redirect()->route('dashboard_manage.Cycles.index')->with('success', "Le cycle $cycle->name a bien été mis a jour") ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cycle = Cycle::findOrFail($id);
        $cycle->delete();
        return redirect()->route('dashboard_manage.Cycles.index')->with('success', "Le cycle a bien été supprimé");
    }
}
