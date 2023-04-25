<?php

namespace App\Http\Controllers\Manager;

use App\Models\Enseignement;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use App\Models\Section;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use App\Rules\nom_unique_enseignement;


class EnseignementController extends Controller
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
            $section_id = Section::where('etablissement_id',$etablissement_id)->pluck('id')->toArray();
            $enseignements = Enseignement::whereIn('section_id', $section_id)->get();

            return view('admin_manager.Enseignements.index' , compact(['enseignements' ,'sections']));
        }
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
        $enseignements = Enseignement::whereIn('section_id', $section_id)->get();
        return view('admin_manager.Enseignements.index')->with('enseignements', $enseignements);
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
            'name.*' => ['required', 'string', 'max:255', new nom_unique_enseignement],
            'section.*'=>['required', 'exists:sections,id'],
        ]);
   
        $enseignements  = $request->name;

        $nbre_de_valeurs_entrantes = count($enseignements);

        $lenseignement = $enseignements[0];

        if ($nbre_de_valeurs_entrantes>1){
            $info = "Les enseignements ont bien étés ajoutés "; 
        }else{      
            $info = "L'enseignement $lenseignement a bien été ajouté ";
        } 
            
        $enseignements  = $request->name;
        // dd($enseignements);
        $sections  = $request->section;
        foreach ($enseignements as $key => $enseignement) {
            Enseignement::create([
                'name'=> $enseignement,
                'section_id' => $sections[$key],
            ]);
        }
        return redirect()->route('dashboard_manage.teaching.index')->with( ['enseignements', 'sections'] )->with('success', $info);

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
         $sections = Section::where('etablissement_id',$etablissement_id)->get();
         $enseignements = Enseignement::whereIn('section_id', $section_id)->get();

        $enseignement = Enseignement::find($id);

        return view('admin_manager.Enseignements.edit' , compact(['enseignements','enseignement' ,'sections']));
      
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
        Validator::make($request->all(),['name' => ['required', 'string', 'max:255', new nom_unique_enseignement], 'section' => ['required','exists:sections,id']]);
        $enseignement = Enseignement::findOrFail($id);
        $enseignement->update($request->all());
        
        return redirect()->route('dashboard_manage.teaching.index')->with('success', "L'enseignement $enseignement->name a bien été mis à jour");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enseignements = Enseignement::where('id', $id)->first();
    //    if (url()->current() == url('Enseignement/'.$id.'/edit')) {
    //        return back()->with('error', 'Frenkie');
    //    }
        $enseignements->delete();
        return redirect()->route('dashboard_manage.teaching.index')->with('success', "L'enseignement a bien été supprimé");
    }
}
