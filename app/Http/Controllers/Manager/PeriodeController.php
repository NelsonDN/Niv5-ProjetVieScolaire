<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Periode;
use App\Rules\jour_unique_periode;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use App\Models\Jour;
use App\Models\Groupeperiode;
use App\Models\Pause;

class PeriodeController extends Controller
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
        $groupeperiodes = Groupeperiode::where('etablissement_id', $etablissement_id)->get();
        $periodes = Periode::whereIn('groupeperiode_id', $groupeperiode_id)->get();

        return view('admin_manager.periodes.index', compact('groupeperiodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $etablissement_id = auth()->user()->etablissement_id;
        $jours = Jour::where('etablissement_id', $etablissement_id)->where('groupeperiode_id', null)->get();
        return view('admin_manager.periodes.firstcreate', compact('jours'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function demi_store(Request $request){
        $request->validate([
            'jour.*' => ['bail', 'required', ],
            'starttime' => ['bail', 'required', ''],
            'endtime' => ['bail', 'required', ''],
            'duree_period' => ['bail', 'required'],
            'nbre_pause' => ['bail', 'required']
        ]);

        $jour = $request->jour;
        $heure_debut = $request->starttime;
        $heure_fin = $request->endtime;
        $duree_period = $request->duree_period;
        $nbre_pause = $request->nbre_pause;

        $request->session()->put('jour',$jour);
        $request->session()->put('heure_debut',$heure_debut);
        $request->session()->put('heure_fin',$heure_fin);
        $request->session()->put('duree_period',$duree_period);
        $request->session()->put('nbre_pause',$nbre_pause);

        return view('admin_manager.periodes.secondcreate');

    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'nbre_periodb.*' => ['bail', 'required', 'numeric','distinct'],
            'break_time.*' => ['bail', 'required']
        ]);

        $nbre_period_avant_la_pause = $request->nbre_periodb;
        $break_time = $request->break_time;

        $jours = session()->get('jour');
        $heure_debut = session()->get('heure_debut');
        $heure_fin = session()->get('heure_fin');
        $duree_period = session()->get('duree_period');
        $nbre_pause = session()->get('nbre_pause');
        $etablissement_id = auth()->user()->etablissement_id;

        $heure_debut = CarbonImmutable::parse($heure_debut);
        $heure_fin = CarbonImmutable::parse($heure_fin);
        
        $groupeperiode = Groupeperiode::create([
            'heure_debut' =>$heure_debut,
            'heure_fin' => $heure_fin,
            'duree_periode' =>$duree_period,
            'nbre_pause' => $nbre_pause,
            'etablissement_id' =>$etablissement_id,
        ]);
    
        for($i=0; $i < $nbre_pause; $i++)
        {
            $pause = Pause::create([
                'nbre_periode_avant' =>$nbre_period_avant_la_pause[$i],
                'duree_pause' =>$break_time[$i],
                'groupeperiode_id'=> $groupeperiode->id
            ]);
        }

        $nbre_jours = count($jours);

        for($ij = 0; $ij < $nbre_jours; $ij++){
            $jour = Jour::findOrFail($jours[$ij]);
            $jour->groupeperiode_id = $groupeperiode->id;
            $jour->save();
        }

        
        $tab = array();
        $nbre_periode = 0;

        // Tant que l'heure de debut est inferieur a l'heure de fin
        while($heure_debut < $heure_fin){

            /*Ici je transforme la variable de duree d'une periode en type CarbonImmutable c-a-d
            une variable initiale ne prendra pas la valeur de nouvelle variable 
            */
            $duree_period = CarbonImmutable::parse($duree_period);
            //Je récupère l'heure dans la variable pareil  que les minutes et la seondes
            $hours = $duree_period->format('H');
            $minutes = $duree_period->format('i');
            $seconds = $duree_period->format('s');
            // Je convertis ensuite la duree_period en secondes
            $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

            /* Ici je vais gerer les periodes qui sont des pauses ou non
            Car ayant incrementer une variable 'nbre_periode' qui nous donne le nombre de periodes de la journée
            alors je n'ai qu'a venir dans la variable d'entree qui contient pour la position d'une pause le nombre de periodes qui viennent avant celle-ci
            du coup JE VERIFIE si la periode où nosus sommes deja est contenu dans la liste des nbres de periodes avant une pause 
            SI OUI il s'agit d'une pause SI NON il s'agit d'une periode quelconque(une heure de cours mdrr :))) 
            */
            if (in_array($nbre_periode,$nbre_period_avant_la_pause)){

                /*Là nous sommes dans UNE PERIODE DE PAUSE maintenant je cherche a connaitre la duree de cette pause 
                car au niveau de la vue nous avons des couples (nbre_de_periodes_avant_la pause , duree_de_la_pause) dans un Array donc la duree d'une pause a la meme CLE que le nombres de periodes avant cette pause dans l'ARRAY
                ce qui veut dire que si je déjà connais le nombre de periodes avant la pause grâce a ma variable '$nbre_periode' je peux facilement connaitre SA position dans l'array ( Sa cle) 
                Et donc je peux réutiliser cette meme CLE pour avoir la valeur de la duree de cette pause dans son array
                */
                $position = array_search($nbre_periode,$nbre_period_avant_la_pause);
                $duree_pause = $break_time[$position];

                // conversion de la duree de la pause en secondes
                $duree_pause = CarbonImmutable::parse($duree_pause);
                $hours_pause = $duree_pause->format('H');
                $minutes_pause = $duree_pause->format('i');
                $seconds_pause = $duree_pause->format('s');
                $time_seconds_pause = $hours_pause * 3600 + $minutes_pause * 60 + $seconds_pause;

                $heure_debut1 = $heure_debut;
                $heure_fin1 = $heure_debut->addSeconds($time_seconds_pause);

                // Si l'heure de fin d'une periode est superieure a l'heure de fin de la journéé
                // Je donne directement a la variable heure de fin de periode la valeur de l'heure de fin de la journée
                if($heure_fin1 > $heure_fin){
                    $heure_fin1 = $heure_fin;
                }                
                $heure_debutString = $heure_debut1;
                $heure_finString = $heure_fin1;
                
                /*Enregistrement dans la table 'periodes' d'une pause */
                $periode = Periode::create([
                    'heure_debut' => $heure_debut1,
                    'heure_fin'=>$heure_fin1,
                    'groupeperiode_id'=>$groupeperiode->id
                ]);

                //liaison entre le jour et la periode qui est une pause dans la table pivot 
                for($ij = 0; $ij < $nbre_jours; $ij++){
                    $periode->jours()->attach($jours[$ij],['isbreak'=>1]);
                }

                $h = [$heure_debutString->toTimeString(), $heure_finString->toTimeString(),'pause'];
                array_push($tab,$h );
            
            }else{

                $heure_debut1 = $heure_debut;
                $heure_fin1 = $heure_debut->addSeconds($time_seconds);
                if($heure_fin1 > $heure_fin){
                    $heure_fin1 = $heure_fin;
                }
                $heure_debutString = $heure_debut1;
                $heure_finString = $heure_fin1;
                
                /*Enregistrement dans la table 'periodes' d'une periode normale */
                $periode = Periode::create([
                    'heure_debut' => $heure_debut1,
                    'heure_fin'=>$heure_fin1,
                    'groupeperiode_id'=>$groupeperiode->id
                ]);

                // Liaison entre le jour et la periode dans la table pivot
                for($ij = 0; $ij < $nbre_jours; $ij++){
                    $periode->jours()->attach($jours[$ij]);
                }
                $h = [$heure_debutString->toTimeString(), $heure_finString->toTimeString()];
                array_push($tab,$h );
            
            }
            $heure_debut = $heure_fin1;
            $nbre_periode++;
        }
        // Destruction des variables de session
        $request->session()->forget('jour');
        $request->session()->forget('heure_debut');
        $request->session()->forget('heure_fin');
        $request->session()->forget('duree_period');
        $request->session()->forget('nbre_pause');

        return redirect()->route('dashboard_manage.period.index')->with('success', 'Vos différentes périodes ont bien été ajoutées' );
        
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
        $groupeperiode = Groupeperiode::findOrFail($id);
        
        $periodes = Periode::where('groupeperiode_id', $groupeperiode->id)->get();

        return view('admin_manager.periodes.show', compact('periodes'));
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
        $groupeperiode = Groupeperiode::findOrFail($id);
        $etablissement_id = auth()->user()->etablissement_id;
        $jours = Jour::where('etablissement_id', $etablissement_id)->get();

        return view('admin_manager.periodes.firstedit', compact('groupeperiode','jours'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function demi_update(Request $request, $id)
    {
        $request->validate([
            'jour.*' => ['bail', 'required', ],
            'starttime' => ['bail', 'required', ''],
            'endtime' => ['bail', 'required', ''],
            'duree_period' => ['bail', 'required'],
            'nbre_pause' => ['bail', 'required']
        ]);

        $jour = $request->jour;
        $heure_debut = $request->starttime;
        $heure_fin = $request->endtime;
        $duree_period = $request->duree_period;
        $nbre_pause = $request->nbre_pause;

        $groupeperiode = Groupeperiode::findOrFail($id);

        $request->session()->put('groupeperiode_id',$groupeperiode->id);
        $request->session()->put('jour',$jour);
        $request->session()->put('heure_debut',$heure_debut);
        $request->session()->put('heure_fin',$heure_fin);
        $request->session()->put('duree_period',$duree_period);
        $request->session()->put('nbre_pause',$nbre_pause);

        $pauses = Pause::where('groupeperiode_id', $groupeperiode->id)->get();

        return view('admin_manager.periodes.secondedit',compact('groupeperiode','pauses'));
    }




    public function update(Request $request, $id)
    {
        //
     
        $request->validate([
            'nbre_periodb.*' => ['bail', 'required', 'numeric','distinct'],
            'break_time.*' => ['bail', 'required']
        ]);
        /*Suppresion de tous enregistrements relies a ce groupe de periode*/
        $groupeperiode = Groupeperiode::findOrFail($id);

        $deleteperiode = Periode::where('groupeperiode_id', $groupeperiode->id)->delete();
        $deletepause = Pause::where('groupeperiode_id', $groupeperiode->id)->delete();

        $updatejour = Jour::where('groupeperiode_id', $groupeperiode->id)->update(['groupeperiode_id'=>null]);

        /* Recreation du groupe periode avec les priodes et les pausess */
        $nbre_period_avant_la_pause = $request->nbre_periodb;
        $break_time = $request->break_time;

        $jours = session()->get('jour');
        $heure_debut = session()->get('heure_debut');
        $heure_fin = session()->get('heure_fin');
        $duree_period = session()->get('duree_period');
        $nbre_pause = session()->get('nbre_pause');
        $etablissement_id = auth()->user()->etablissement_id;

        $heure_debut = CarbonImmutable::parse($heure_debut);
        $heure_fin = CarbonImmutable::parse($heure_fin);
        
        
        $groupeperiode->update([
            'heure_debut' =>$heure_debut,
            'heure_fin' => $heure_fin,
            'duree_periode' =>$duree_period,
            'nbre_pause' => $nbre_pause,
            'etablissement_id' =>$etablissement_id,
        ]);
    
        for($i=0; $i < $nbre_pause; $i++)
        {
            $pause = Pause::create([
                'nbre_periode_avant' =>$nbre_period_avant_la_pause[$i],
                'duree_pause' =>$break_time[$i],
                'groupeperiode_id'=> $groupeperiode->id
            ]);
        }

        $nbre_jours = count($jours);

        for($ij = 0; $ij < $nbre_jours; $ij++){
            $jour = Jour::findOrFail($jours[$ij]);
            $jour->groupeperiode_id = $groupeperiode->id;
            $jour->save();
        }

        
        $tab = array();
        $nbre_periode = 0;

        while($heure_debut < $heure_fin){

            $duree_period = CarbonImmutable::parse($duree_period);
            $hours = $duree_period->format('H');
            $minutes = $duree_period->format('i');
            $seconds = $duree_period->format('s');

            $time_seconds = $hours * 3600 + $minutes * 60 + $seconds;

            if (in_array($nbre_periode,$nbre_period_avant_la_pause)){

                $position = array_search($nbre_periode,$nbre_period_avant_la_pause);
                $duree_pause = $break_time[$position];

                // converion de la duree d'une pause en secondes
                $duree_pause = CarbonImmutable::parse($duree_pause);
                $hours_pause = $duree_pause->format('H');
                $minutes_pause = $duree_pause->format('i');
                $seconds_pause = $duree_pause->format('s');
                $time_seconds_pause = $hours_pause * 3600 + $minutes_pause * 60 + $seconds_pause;

                $heure_debut1 = $heure_debut;
                $heure_fin1 = $heure_debut->addSeconds($time_seconds_pause);
                if($heure_fin1 > $heure_fin){
                    $heure_fin1 = $heure_fin;
                }                
                $heure_debutString = $heure_debut1;
                $heure_finString = $heure_fin1;
                
                /*Enregistrement dans la table 'periodes' d'une pause */
                $periode = Periode::create([
                    'heure_debut' => $heure_debut1,
                    'heure_fin'=>$heure_fin1,
                    'groupeperiode_id'=>$groupeperiode->id
                ]);

                //liaison entre le jour et la periode qui est une pause dans la table pivot 
                for($ij = 0; $ij < $nbre_jours; $ij++){
                    $periode->jours()->attach($jours[$ij],['isbreak'=>1]);
                }

                $h = [$heure_debutString->toTimeString(), $heure_finString->toTimeString(),'pause'];
                array_push($tab,$h );
            
            }else{

                $heure_debut1 = $heure_debut;
                $heure_fin1 = $heure_debut->addSeconds($time_seconds);
                if($heure_fin1 > $heure_fin){
                    $heure_fin1 = $heure_fin;
                }
                $heure_debutString = $heure_debut1;
                $heure_finString = $heure_fin1;
                
                /*Enregistrement dans la table 'periodes' d'une periode normale */
                $periode = Periode::create([
                    'heure_debut' => $heure_debut1,
                    'heure_fin'=>$heure_fin1,
                    'groupeperiode_id'=>$groupeperiode->id
                ]);

                // Liaison entre le jour et la periode dans la table pivot
                for($ij = 0; $ij < $nbre_jours; $ij++){
                    $periode->jours()->attach($jours[$ij]);
                }
                $h = [$heure_debutString->toTimeString(), $heure_finString->toTimeString()];
                array_push($tab,$h );
            
            }
            $heure_debut = $heure_fin1;
            $nbre_periode++;
        }

        // Destruction des variables de session
        $request->session()->forget('groupeperiode_id');
        $request->session()->forget('jour');
        $request->session()->forget('heure_debut');
        $request->session()->forget('heure_fin');
        $request->session()->forget('duree_period');
        $request->session()->forget('nbre_pause');

        return redirect()->route('dashboard_manage.period.index')->with('success', "Le groupe de  periode a bien été mise a jour ");
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
        $deleteperiode = Periode::where('groupeperiode_id', $groupeperiode->id)->delete();
        $deletepause = Pause::where('groupeperiode_id', $groupeperiode->id)->delete();

        $updatejour = Jour::where('groupeperiode_id', $groupeperiode->id)->update(['groupeperiode_id'=>null]);
        
        $groupeperiode = Groupeperiode::findOrFail($id);
        $groupeperiode->delete();

        return redirect()->route('dashboard_manage.period.index');
    }
}
