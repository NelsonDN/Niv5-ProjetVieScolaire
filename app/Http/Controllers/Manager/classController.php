<?php

namespace App\Http\Controllers\Manager;
use App\Models\Classe;
use App\Models\Section;
use App\Models\Enseignement;
use App\Models\Matiere;
use App\Models\Eleve;
use App\Models\Cycle;
use App\Models\Periode;
use App\Models\Groupeperiode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Rules\nom_unique;
use App\Rules\periode_unique_pour_une_classematiere;

class classController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Nous recuperons id de de l'etablissement de l'utilisateur connecté
        $etablissement_id=auth()->user()->etablissement_id;

        // Nous allons dans la table sections recupéré toutes les sections de l'etablissement de l'utilisateur connecté sous forme de tableau 
        $section_id = Section::where('etablissement_id',$etablissement_id)->pluck('id')->toArray();

        // Pareillement au niveau de la table cycles où Nous recuperons l'id des cycles correspondant aux sections de l'etablissement sous forme de tableau 
        $cycle_id = Cycle::whereIn('section_id',$section_id)->pluck('id')->toArray();

        // Enfin nous avons la liste de toutes les classes de l'etablissement de l'utilisateur connecté
        $classes = Classe::whereIn('cycle_id', $cycle_id)->get();

        return view('admin_manager.class.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Nous recuperons id de de l'etablissement de l'utilisateur connecté
        $etablissement_id=auth()->user()->etablissement_id;

        // Nous allons dans la table sections recupéré toutes les sections de l'etablissement de l'utilisateur connecté sous forme de tableau 
        $section_id = Section::where('etablissement_id',$etablissement_id)->pluck('id')->toArray();

        // Pareillement au niveau de la table cycles où je recupère l'id des cycles correspondant aux sections de l'etablissement sous forme de tableau 
        $cycle_id = Cycle::whereIn('section_id',$section_id)->pluck('id')->toArray();
       
        /*Une classe appartient a une classe donc lors de la creation il nous faut avoir tous les cycles,
        de l'etablissement de l'auth-user (utilisateur connecté)
        */
        $cycles = Cycle::whereIn('section_id',$section_id)->get();
        
        // Pour creer une classe nous avons besoin des matieres alors il me faut premièrement avoir la liste des enseignements (id) de l'etablissement de l'auth-user
        $enseignement_id = Enseignement::whereIn('section_id', $section_id)->pluck('id')->toArray();
    
        // deuxièmement je compare l'id des enseignements pour avoir toutes les classes de l'etablissement de l'auth-user
        $matieres = Matiere::whereIn('enseignement_id', $enseignement_id)->get();

        //les periodes de la journée de l'etablissement
        $groupeperiodes = Groupeperiode::where('etablissement_id', $etablissement_id)->get();
        $groupeperiode_id = Groupeperiode::where('etablissement_id', $etablissement_id)->pluck('id')->toArray();
        $periode_id = Periode::whereIn('groupeperiode_id', $groupeperiode_id)->pluck('id')->toArray();

        $jour_periodes = DB::table('jour_periode')->select(['id','jour_id', 'periode_id'])->whereIn('periode_id',$periode_id)->where('isbreak', 0)->get();
        // Si l'etablissement ne dispose pas de cycles ou de matières déjà créées alors nous redirigeons le manager vers la vue creation d'un cycle
        if ($cycles->isEmpty() && $matieres->isEmpty()) {
            return redirect()->route('dashboard_manage.Cycles.index')
            ->with('error' , 'Veuillez tout d\'abord créer des cycles et des matieres');
        }elseif ($matieres->isEmpty()) {
            return redirect()->route('dashboard_manage.subject.index')
            ->with('error' , 'Veuillez tout d\'abord créer une matieres');
        }elseif ($cycles->isEmpty() ) {
            return redirect()->route('dashboard_manage.Cycles.index')
            ->with('error' , 'Veuillez tout d\'abord créer des cycles');
        }elseif($jour_periodes->isEmpty()) {
            return redirect()->route('dashboard_manage.periode.index')
            ->with('error' , 'Veuillez tout d\'abord créer des périodes');
        }else {
            return view('admin_manager.class.create', compact('matieres', 'cycles', 'groupeperiodes','jour_periodes'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // Premièrement nous procedons a la validation des données provenant de la requête du formulaire
        $request->validate([
            'nom' => ['required', new nom_unique],
            'limite'=>'bail|required',
            'cycle'=>'bail|required',
            'matiere.*'=>['required', 'distinct'],
            'coef.*'=>'bail|required',
            'periode.*'=>['required', new periode_unique_pour_une_classematiere($request->periode)],
        ]);
        
        //Création de la classe par un assignement de masse
        $classe = Classe::create([
            "nom" => $request->nom,
            "limite_eleve" => $request->limite,
            "cycle_id" => $request->cycle
        ]);

        $nom_de_la_classe = $request->nom;
        $matiere = $request->matiere;
        $coefficient = $request->coef;
        $periodes = $request->periode;
        
        
        /*Maintenant il nous faut assigner les matieres au classe au niveau de la table pivot (classe_matiere)
        Nous comptons d'abord le nombre de couple (matiere , coefficient) entrante,
        */
        $nbre_de_valeurs_entrante = count($matiere);
        
        for ( $i =0 ; $i < $nbre_de_valeurs_entrante ; $i++ ) {
            // ici nous attachons la classe crée plus haut aux differentes matières respectivement avec le coefficient
            $classe->matieres()->attach($matiere[$i], ['coefficient'=>$coefficient[$i]]);            
            
            /*Là j'ai besoin de recupérer l'id de l'enregistrement entre la classe crée et la matiere[i]
            Car  c'est cet id que je dois enregistrer dans la table pivot 'classmat_periode' au cote de toutes les periodes choisies
            pour cette matiere[i] dans cette classe
            */
            $classematiere_id = DB::table('classe_matiere')->select('id')->where('classe_id',$classe->id)->where('matiere_id',$matiere[$i])->first();
            
            // je compte le nombre de periodes envoyés dans le formulaire
            $nbre_de_valeurs_entrante_periodes = count($periodes);
   
            // ici je parcours je vais parcourir ce tableau de periodes
            for($Iperiode=0; $Iperiode<$nbre_de_valeurs_entrante_periodes; $Iperiode++){
                
                /*Pour la premiere periode je vais faire ce qu'on appelle un split en python
                donc diviser la valeur en deux parties en fonction du separateur qui ici est 'une virgule'
                Cette valeur a ete crée ainsi au niveau de la vue 
                */
                $periode = explode(',',$periodes[$Iperiode]);
        
                /*Si la premiere valeur[0] issu du explode des periodes correspond a l'initialisation i des matieres
                alors cela veut dire qu'il s'agit d'une des periodes de la classe et la matiere dans laquelle je me trouve
                du coup je dois proceder a l'insertion de cette periode avec l'id de l'enregistrement classe-matiere

                Tout ceci est a cause du select multiple periode dans les inputs multiple Add&Remove; ce select multiple renvoi une variable
                qui contient UN SEULE ARRAY contenant toutes les periodes choisies quelque soit l'input
                alors je devais faire correspondre au niveau des vues la periode dans cette ARRAY avec le numero de l'input 
                */

                if ($i == $periode[0]){
                    DB::table('classmat_jourperiode')->insert([
                        'classe_matiere_id'=> $classematiere_id->id,
                        'jour_periode_id' => $periode[1]
                    ]);
                }
            }
        }
        return redirect()->route('dashboard_manage.class.index')->with('success',"La classe $nom_de_la_classe a bien été créée " );
    }

    /**2
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Classe $class)
    {

        $eleves = Eleve::where('classe_id', $class->id)->get();

        return view('admin_manager.class.show', compact('eleves', 'class'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Recuperons l'instance de classe correspondante a l'id transmit
        $class=Classe::findOrFail($id);

        // Nous recuperons id de de l'etablissement de l'utilisateur connecté
        $etablissement_id=auth()->user()->etablissement_id;

        // Nous allons dans la table sections recupéré toutes les sections de l'etablissement de l'utilisateur connecté sous forme de tableau
        $section_id = Section::where('etablissement_id',$etablissement_id)->pluck('id')->toArray();
       
        // Pareillement au niveau de la table cycles où Nous recuperons l'id des cycles correspondant aux sections de l'etablissement sous forme de tableau 
        $cycle_id = Cycle::whereIn('section_id',$section_id)->pluck('id')->toArray();
        
        /*Une classe appartient a une classe donc lors de la creation il nous faut avoir tous les cycles,
        de l'etablissement de l'auth-user (utilisateur connecté)
        */
        $cycles = Cycle::whereIn('section_id',$section_id)->get();
        
        /* Pour modifier une classe c'est le même procédé que la creéation,
        nous avons besoin des matieres alors il me faut premièrement avoir la liste des enseignements (id) de l'etablissement de l'auth-user
        */
        $enseignement_id = Enseignement::whereIn('section_id', $section_id)->pluck('id')->toArray();

        // deuxièmement je compare l'id des enseignements pour avoir toutes les classes de l'etablissement de l'auth-user
        $matieres = Matiere::whereIn('enseignement_id', $enseignement_id)->get();

        /*Nous allons dans la table 'classe_matiere pour recuperer toutes les informations concernant la classe a editer
        En selectionnant biensur les elements de matiere_id et coefficient pour bien selected les matières de la classe  
        */
        $classe_matieres = DB::table('classe_matiere')->select(['id','matiere_id', 'classe_id','coefficient'])->where('classe_id', $class->id )->get();

        //les periodes de la journée de l'etablissement
        $groupeperiodes = Groupeperiode::where('etablissement_id', $etablissement_id)->get();
        $groupeperiode_id = Groupeperiode::where('etablissement_id', $etablissement_id)->pluck('id')->toArray();
        $periode_id = Periode::whereIn('groupeperiode_id', $groupeperiode_id)->pluck('id')->toArray();

        $jour_periodes = DB::table('jour_periode')->select(['id','jour_id', 'periode_id'])->whereIn('periode_id',$periode_id)->where('isbreak', 0)->get();

        return view('admin_manager/class/edit',compact('class','matieres','cycles', 'classe_matieres','jour_periodes', 'groupeperiodes' ));
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
        // Premièrement nous procedons a la validation des données provenant de la requête du formulaire
        $request->validate([
            'nom' => ['required'],
            'limite' => ['required'],
            'cycle' => ['required'],
            'matiere.*'=>'bail|required|distinct',
            'coef.*'=>'bail|required',
            'periode.*'=>['bail', 'required', new periode_unique_pour_une_classematiere($request->periode)],
        ]);  

        //Nous obtenons l'instance de la classe a mettre à jour 
        $class = Classe::findOrFail($id);
        $class->nom = $request->nom;
        $class->limite_eleve = $request->limite;
        $class->cycle_id = $request->cycle;
        $class->save();
     
        $nom_de_la_classe = $class->nom;

         /*Maintenant il nous faut assigner les matieres au classe au niveau de la table pivot (classe_matiere)
        Nous comptons d'abord le nombre de couple (matiere , coefficient) entrante,
        */
        $matiere = $request->matiere;
        $coefficient = $request->coef;
        $periodes = $request->periode;
        
        $nbre_de_valeurs_entrante = count($matiere);
        
        /*Ici il se passe quelque chose d'interessant car,
        on va aller dans la table pivot (classe_matiere) pour soit mettre a jour le coefficient d'une matière appartenant a cette classe,
        soit ajouter une nouvelle matière a cette classe, 
        */
        for ( $i =0; $i < $nbre_de_valeurs_entrante; $i++ ) {
            /*Pour cela on parcours la liste des matières entrantes venant de la requête,
            puis on verifie dans la table pivot si une matiere entrante appartient déjà a cette classe si oui on met a jour son coefficient,
            si non il s'agirait alors d'une nouvelle matiere donc on l'attache a la classe
            */
            $exist = DB::table('classe_matiere')
            ->where('classe_id',$class->id )
            ->where('matiere_id', $matiere[$i])
            ->count();
            if ($exist>0){
                $update =  DB::table('classe_matiere')->where('classe_id',$class->id)->where('matiere_id', $matiere[$i])->update(['coefficient'=>$coefficient[$i] ]);
                
                $classematiere_id = DB::table('classe_matiere')->select('id')->where('classe_id',$class->id)->where('matiere_id',$matiere[$i])->first();

                $supprimer = DB::table('classmat_jourperiode')->where('classe_matiere_id',$classematiere_id->id)->delete() ;
                
                $nbre_de_valeurs_entrante_periodes = count($periodes);
   
                for($Iperiode=0; $Iperiode<$nbre_de_valeurs_entrante_periodes; $Iperiode++){
                   
                    $periode = explode(',',$periodes[$Iperiode]);

                    if ($i == $periode[0]){
                        DB::table('classmat_jourperiode')->insert([
                            'classe_matiere_id'=> $classematiere_id->id,
                            'jour_periode_id' => $periode[1]
                        ]);  
                    }
                }
            }else{
                $class->matieres()->attach($matiere[$i], ['coefficient'=>$coefficient[$i] ]);
                
                $classematiere_id = DB::table('classe_matiere')->select('id')->where('classe_id',$class->id)->where('matiere_id',$matiere[$i])->first();
                
                $nbre_de_valeurs_entrante_periodes = count($periodes);
   
                for($Iperiode=0; $Iperiode<$nbre_de_valeurs_entrante_periodes; $Iperiode++){
                   
                    $periode = explode(',',$periodes[$Iperiode]);
                    
                    if ($i == $periode[0]){

                        DB::table('classmat_jourperiode')->insert([
                            'classe_matiere_id'=> $classematiere_id->id,
                            'jour_periode_id' => $periode[1] 
                        ]);
                    }
                }
            }
        }
        
        return redirect()->route('dashboard_manage.class.index')->with('success', "La classe $nom_de_la_classe a bien été mise a jour");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $classe=Classe::findOrFail($id);
        $classe->matieres()->detach($classe->id);
        $classe->delete();
        
        return redirect()->route('dashboard_manage.class.index')->with('success', "La classe a été suppriméée");
        
        
    }
}
