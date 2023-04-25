<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Typedecour;

class TypedecoursController extends Controller
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
        $types = Typedecour::where('etablissement_id', $etablissement_id)->get();

        return view('admin_manager.typedecours.index', compact('types'));
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
        $etablissement_id = auth()->user()->etablissement_id;

        $request->validate([
            'name.*' => ['bail', 'required']
        ]);

        $typedecours = $request->name;
        $nbre_de_valeurs_entrante = count($typedecours);

        $le_typedecours = $typedecours[0];
        if ($nbre_de_valeurs_entrante>1){
            $info = "Vos types de cours ont bien ete ajoutés "; 
        }else{      
            $info = "Le type de cours $le_typedecours a bien été ajouté ";
        }  
        
        for($i = 0 ; $i < $nbre_de_valeurs_entrante ; $i++) {
            
            Typedecour::create([
                'nom'=>$typedecours[$i],
                'etablissement_id'=>$etablissement_id,
            ]);
        
        }

        return redirect()->route('dashboard_manage.type_of_lesson.index')->with('success',$info);
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
        $typedecour = Typedecour::findOrFail($id);
        $etablissement_id = auth()->user()->etablissement_id;
        $types = Typedecour::where('etablissement_id', $etablissement_id)->get();

        return view('admin_manager.typedecours.edit', compact('typedecour','types'));
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
            'name'=>['bail', 'required'],
        ]);
        
        $etablissement_id = auth()->user()->etablissement_id;
        $typedecour = Typedecour::findOrFail($id);
        
        $typedecour->update([
            'nom'=>$request->name,
            'etablissement_id'=>$etablissement_id,
        ]);

        return redirect()->route('dashboard_manage.type_of_lesson.index')->with('success','le type de cours a bien été édité');

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
