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

class CahierdetexteTeacherController extends Controller
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
        
        $classes_id = DB::table('classe_matiere')->select('classe_id')->where('user_id', auth()->user()->id)->pluck('classe_id')->toArray();

        $classes = Classe::whereIn('id', $classes_id)->get();


        return view('admin_manager.cahier_de_texte.teacher.index', compact('classes'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $request->validate([
            'classe_id' => ['bail','required','numeric'],
            'matiere_id' => ['bail', 'required','numeric'],
            'periode'  => ['bail', 'required']
        ]);

       
        $periode = $request->periode;

        $classe_id = $request->classe_id;
        $matiere_id = $request->matiere_id; 

        $request->session()->put('classe_id', $classe_id);
        $request->session()->put('matiere_id', $matiere_id);

        $classe_matiere_id = DB::table('classe_matiere')->select('id')->where('classe_id', $classe_id)->where('matiere_id', $matiere_id)->first(); 
        $cahier_de_texte_Exist = Cahierdetexte::where('classe_matiere_id', $classe_matiere_id->id)->whereDate('created_at', CarbonImmutable::now()->format('Y-m-d'))->get();
        
        
        // if($cahier_de_texte_Exist->isEmpty()){            
            $classe = Classe::findOrFail($classe_id);
            $matiere = Matiere::findOrFail($matiere_id);
            $etablissement_id = auth()->user()->etablissement_id;
            $types = Typedecour::where('etablissement_id', $etablissement_id)->get();

            return view('admin_manager.cahier_de_texte.teacher.create', compact('classe','matiere','types'));
        
        // }else {
        //     return back()->with('warning','Le cahier de texte de ce jour a déjà été remplie');
        // }

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
            'typedecour' => ['bail', 'required' ],
            'titrecour' => ['bail', 'required'],
            'piece_jointecour' => ['bail','mimes:csv,txt,xlx,xls,pdf,jpg,png,bmp'],
            'contenucour' => ['bail', 'required']
        ]);

        $classe_id = session()->get('classe_id');
        $matiere_id = session()->get('matiere_id');

        if( isset($request->titre_exercice) || isset($request->date_de_correction) || isset($request->contenu_exercice) || isset($request->piece_jointeexercice) ){
            
            
            $request->validate([
                'titre_exercice' => ['bail', 'required' ],
                'date_de_correction' => ['bail', 'required'],
                'piece_jointeexercice' => ['bail', 'mimes:csv,txt,xlx,xls,pdf,jpg,png,bmp'],
                'contenu_exercice' => ['bail', 'required']
            ]);


            // données cahier de texte
            $typedecour_id = $request->typedecour;
            $titrecour = $request->titrecour;
            $piece_jointecour = $request->piece_jointecour;
            $contenucour = $request->contenucour;

            // donnnées exercice
            $titre_exercice = $request->titre_exercice;
            $date_de_correction = $request->date_de_correction;
            $piece_jointeexercice = $request->piece_jointeexercice;
            $contenu_exercice = $request->contenu_exercice;
            $classe_matiere_id = DB::table('classe_matiere')->select('id')->where('classe_id',$classe_id)->where('matiere_id',$matiere_id)->first();
           
            // dd(session()->all(), $classe_matiere_id, $request->all());
            $cahierdetexte = Cahierdetexte::create([
                'titre' => $titrecour,
                'contenu' =>$contenucour,
                'typedecour_id' => $typedecour_id,
                'classe_matiere_id' =>$classe_matiere_id->id 
            ]);

                if(isset($request->piece_jointecour)){
                    
                    $filename_chemin= 'Piecejointe_cahier_de_texte/'.$cahierdetexte->id.'.'.$request->piece_jointecour->getClientOriginalExtension();
            
                    $filename= $cahierdetexte->id.'.'.$request->piece_jointecour->getClientOriginalExtension();

                    $cahierdetexte->piece_jointe = $filename_chemin;
                    $cahierdetexte->save();

                    $request->file('piece_jointecour')->storeAs('Piecejointe_cahier_de_texte', $filename, 'public');
                }
            
            $exercice = Exercice::create([
                'titre' =>$titre_exercice,
                'date_de_correction' =>$date_de_correction,
                'contenu' =>$contenu_exercice,
                'cahierdetexte_id' => $cahierdetexte->id,
            ]);

                if(isset($request->piece_jointeexercice)){
                    $filename_chemin= 'Piecejointe_exercices/'.$exercice->id.'.'.$request->piece_jointeexercice->getClientOriginalExtension();
            
                    $filename= $exercice->id.'.'.$request->piece_jointeexercice->getClientOriginalExtension();

                    $exercice->piece_jointe = $filename_chemin;
                    $exercice->save();

                    $request->file('piece_jointeexercice')->storeAs('Piecejointe_exercices', $filename, 'public');
                }

            session()->forget('classe_id');
            session()->forget('matiere_id');

            return redirect()->route('dashboard_manage.textbookTeacher.index')->with('success', 'Le cahier de texte a bien été enregistré');

        }else{

            $typedecour_id = $request->typedecour;
            $titrecour = $request->titrecour;
            $piece_jointecour = $request->piece_jointecour;
            $contenucour = $request->contenucour;
            $classe_matiere_id = DB::table('classe_matiere')->select('id')->where('classe_id',$classe_id)->where('matiere_id',$matiere_id)->first();
            
            $cahierdetexte = Cahierdetexte::create([
                'titre' => $titrecour,
                'contenu' =>$contenucour,
                'typedecour_id' => $typedecour_id,
                'classe_matiere_id' =>$classe_matiere_id->id 
            ]);

                if(isset($request->piece_jointecour)){

                    $filename_chemin= 'Piecejointe_cahier_de_texte/'.$cahierdetexte->id.'.'.$request->piece_jointecour->getClientOriginalExtension();
            
                    $filename= $cahierdetexte->id.'.'.$request->piece_jointecour->getClientOriginalExtension();

                    $cahierdetexte->piece_jointe = $filename_chemin;
                    $cahierdetexte->save();

                    $request->file('piece_jointecour')->storeAs('Piecejointe_cahier_de_texte', $filename, 'public');
                    
                }

            session()->forget('classe_id');
            session()->forget('matiere_id');

            return redirect()->route('dashboard_manage.textbookTeacher.index')->with('success', 'Le cahier de texte a bien été enregistré');
        }

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

        $classe_matieres = DB::table('classe_matiere')->where('classe_id', $classe->id)->where('user_id', auth()->user()->id)->get();

        return view('admin_manager.cahier_de_texte.teacher.show', compact('classe_matieres'));
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
        $cahier_de_texte = Cahierdetexte::findOrFail($id);

        $etablissement_id = auth()->user()->etablissement_id;
        $types = Typedecour::where('etablissement_id', $etablissement_id)->get();
       
        $exercice = Exercice::where('cahierdetexte_id', $cahier_de_texte->id)->first();
        
        $a = explode('/', $cahier_de_texte->piece_jointe);
        $extension = explode('.', $a[1]);
        $extension = $extension[1];

        return view('admin_manager.cahier_de_texte.teacher.edit', compact('cahier_de_texte', 'types','exercice', 'extension'));

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
            'typedecour' => ['bail', 'required' ],
            'titrecour' => ['bail', 'required'],
            'piece_jointecour' => ['bail','mimes:csv,txt,xlx,xls,pdf,jpg,png,bmp'],
            'contenucour' => ['bail', 'required']
        ]);


        if( isset($request->titre_exercice) || isset($request->date_de_correction) || isset($request->contenu_exercice) || isset($request->piece_jointeexercice) ){
        
            $request->validate([
                'titre_exercice' => ['bail', 'required' ],
                'date_de_correction' => ['bail', 'required'],
                'piece_jointeexercice' => ['bail', 'mimes:csv,txt,xlx,xls,pdf,jpg,png,bmp'],
                'contenu_exercice' => ['bail', 'required']
            ]);

            // données cahier de texte
            $typedecour_id = $request->typedecour;
            $titrecour = $request->titrecour;
            $piece_jointecour = $request->piece_jointecour;
            $contenucour = $request->contenucour;

            // donnnées exercice
            $titre_exercice = $request->titre_exercice;
            $date_de_correction = $request->date_de_correction;
            $piece_jointeexercice = $request->piece_jointeexercice;
            $contenu_exercice = $request->contenu_exercice;
           
            // dd(session()->all(), $classe_matiere_id, $request->all());

            $cahierdetexte = Cahierdetexte::findOrFail($id);

            $cahierdetexte->update([
                'titre' => $titrecour,
                'contenu' =>$contenucour,
                'typedecour_id' => $typedecour_id,
            ]);

                if(isset($request->piece_jointecour)){
                    

                    $piece_jointe = $cahierdetexte->piece_jointe;
                    $a = Storage::disk('public')->exists($piece_jointe);

                    if ($a){
                        Storage::disk('public')->delete($piece_jointe);
                    }
                    
                    $filename_chemin= 'Piecejointe_cahier_de_texte/'.$cahierdetexte->id.'.'.$request->piece_jointecour->getClientOriginalExtension();
            
                    $filename= $cahierdetexte->id.'.'.$request->piece_jointecour->getClientOriginalExtension();

                    $cahierdetexte->piece_jointe = $filename_chemin;
                    $cahierdetexte->save();

                    $request->file('piece_jointecour')->storeAs('Piecejointe_cahier_de_texte', $filename, 'public');
                }

                
                $exercice = Exercice::where('cahierdetexte_id', $cahierdetexte->id)->first();
                $exercice->update([
                'titre' =>$titre_exercice,
                'date_de_correction' =>$date_de_correction,
                'contenu' =>$contenu_exercice,
                ]);

                if(isset($request->piece_jointeexercice)){
                    
                    $piece_jointe_exercice = $exercice->piece_jointe;
                    $a = Storage::disk('public')->exists($piece_jointe_exercice);

                    if($a){
                        Storage::disk('public')->delete($piece_jointe_exercice);
                    }

                    $filename_chemin= 'Piecejointe_exercices/'.$exercice->id.'.'.$request->piece_jointeexercice->getClientOriginalExtension();
            
                    $filename= $exercice->id.'.'.$request->piece_jointeexercice->getClientOriginalExtension();

                    $exercice->piece_jointe = $filename_chemin;
                    $exercice->save();

                    $request->file('piece_jointeexercice')->storeAs('Piecejointe_exercices', $filename, 'public');
                }

            return redirect()->route('dashboard_manage.textbookTeacher.index')->with('success', 'Le cahier de texte a bien été mis à jour');

        }else{
            
            dd($request->all(), 2);

            $typedecour_id = $request->typedecour;
            $titrecour = $request->titrecour;
            $piece_jointecour = $request->piece_jointecour;
            $contenucour = $request->contenucour;
            
            $cahierdetexte = Cahierdetexte::findOrFail($id);

            $cahierdetexte->update([
                'titre' => $titrecour,
                'contenu' =>$contenucour,
                'typedecour_id' => $typedecour_id,
            ]);

                if(isset($request->piece_jointecour)){

                    $piece_jointe = $cahierdetexte->piece_jointe;
                    $a = Storage::disk('public')->exists($piece_jointe);

                    if ($a){
                        Storage::disk('public')->delete($piece_jointe);
                    }

                    $filename_chemin= 'Piecejointe_cahier_de_texte/'.$cahierdetexte->id.'.'.$request->piece_jointecour->getClientOriginalExtension();
            
                    $filename= $cahierdetexte->id.'.'.$request->piece_jointecour->getClientOriginalExtension();

                    $cahierdetexte->piece_jointe = $filename_chemin;
                    $cahierdetexte->save();

                    $request->file('piece_jointecour')->storeAs('Piecejointe_cahier_de_texte', $filename, 'public');
                    
                }

            return redirect()->route('dashboard_manage.textbookTeacher.index')->with('success', 'Le cahier de texte a bien été mis à jour');
        }
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
        $cahierdetexte = Cahierdetexte::findOrFail($id);
        $cahierdetexte->delete();

        return redirect()->route('dashboard_manage.textbookTeacher.index')->with('success', 'Le cahier de texte a bien ete supprimé');
    }
}
