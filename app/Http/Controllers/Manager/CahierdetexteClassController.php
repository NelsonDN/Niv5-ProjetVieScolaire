<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Matiere;
use App\Models\User;
use Carbon\CarbonImmutable;
use App\Models\Typedecour;
use App\Models\Cahierdetexte;
use App\Models\Exercice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CahierdetexteClassController extends Controller
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
    public function create(Request $request)
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
        $classe = Classe::findOrFail($id);
        
        $classe_matieres = DB::table('classe_matiere')->where('classe_id',$classe->id)->whereNotNull('user_id')->get();

        return view('admin_manager.cahier_de_texte.classe.show', compact('classe','classe_matieres') );
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
    }

    public function downloadattachment($attachment_name)
    {
        $myFile = public_path('storage/Piecejointe_cahier_de_texte/'.$attachment_name);

        $headers = ['Content-Type: application/pdf'];

        return response()->download($myFile, 'Piece_jointe.pdf', $headers);
    }

}
