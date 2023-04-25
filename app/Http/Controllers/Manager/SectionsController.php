<?php

namespace App\Http\Controllers\Manager;

use App\Models\Section;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\nom_unique_section;
use Illuminate\Support\Facades\DB;


class SectionsController extends Controller
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

        return view('admin_manager.Sections_Cycles.Sections.index' , compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $teachers= DB::table('model_has_roles')->select('model_id')->where('role_id',3)->get();
        $parents= DB::table('model_has_roles')->select('model_id')->where('role_id',3)->get();
      //  $users = User::permission('teachers')->get();
     // $users = User::role('teachers')->get();
        return view('admin_manager.index', [
            'users' => $users,
            'teachers'=>$teachers
            
        ]);
        
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
            'name' => ['required', 'string', 'max:255', new nom_unique_section],
        ]);  
        $manager_id=auth()->user()->etablissement_id;
        $section = Section::create([
            'name'=> $request->name,
         ]);

         $section->update([
            'etablissement_id'=>$manager_id,
         ]);

         return redirect()->route('dashboard_manage.Sections.index')->with('success', "la section $section->name a bien été crée" );
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
        $section = Section::findOrFail($id);
        $etablissement_id=auth()->user()->etablissement_id;
        $sections = Section::where('etablissement_id',$etablissement_id)->get();

       

        return view('admin_manager.Sections_Cycles.Sections.edit', compact(['section', 'sections']));
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
        $request->validate([
            'name' => ['required', 'string', 'max:255', new nom_unique_section],
        ]);
        $request->validate([
            'name'=>['required', new nom_unique_section],
        ]);
        $section = Section::findOrFail($id);
        $section->update([
            'name'=>$request->name,
        ]);
        $etablissement_id=auth()->user()->etablissement_id;
        $sections = Section::where('etablissement_id',$etablissement_id)->get();

        return view('admin_manager.Sections_Cycles.Sections.index', ['sections'=>$sections])->with('success', "la section $section->name a bien été mise à jour");
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
          $section = Section::findOrFail($id);
          $section->delete();
          return redirect()->route('dashboard_manage.Sections.index')->with('success', "la section a bien été supprimée"); 
    }
}
