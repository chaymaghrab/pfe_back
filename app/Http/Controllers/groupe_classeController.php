<?php

namespace App\Http\Controllers;

use App\Models\certification;
use App\Models\groupe_classe;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
//use phpDocumentor\Reflection\Types\Collection;
use Illuminate\Support\Collection;

class groupe_classeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grp_classe= groupe_classe::all();

        return response()->json($grp_classe);

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
            'nom_groupe'=>'required',
            'niveau'=>'required',
            'code_groupe'=>'required',
            'ecole'=>'required',
            'departement '=>'required',
            'parcours'=>'required',
            'soir '=>'required',
            'langue'=>'required',

        ]);
        groupe_classe::create($request->all());
        return response()->json('ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\groupe_classe  $groupe_classe
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $grp_classe= groupe_classe::findOrFail($id);
            //$grp_classe->etudiants->first();
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        return $grp_classe;
    }






    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\groupe_classe  $groupe_classe
     * @return \Illuminate\Http\Response
     */
    public function edit(groupe_classe $groupe_classe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\groupe_classe  $groupe_classe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        try {
            $groupe_classe = groupe_classe::findOrFail($id);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        $groupe_classe->update($request->all());
        return response()->json($groupe_classe);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\groupe_classe  $groupe_classe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $groupe_classe = groupe_classe::findOrFail($id);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        $groupe_classe->delete();
        return response()->json('ok');
    }

public function get_type_cours()
{
    return groupe_classe::select('cours')->distinct()->get();
}


public function get_ecole()
{
    return groupe_classe::select('ecole')->distinct()->get();
}


    public function get_grp_bydepartement(Request $request)
    {
        return groupe_classe::select('departement')->distinct()->get();
    }

    public function get_niveau_department($depatement)
    {
        return groupe_classe::select('niveau')->where('departement',$depatement)->distinct()->get();
    }

    public function get_grp_byecole($depatement,$niveau)
    {
        return groupe_classe::select('ecole')->where('departement',$depatement)
                                ->where('niveau',$niveau)->distinct()->get();
    }


    //find groupe classe by id , cours and langue
    public function shows( Collection $id , $cours , $langue, $ecole)
    {
        if($ecole==='all')
        {
            $test=groupe_classe::Find($id)->where('cours',$cours)
                ->where('langue',$langue)->all();
        }
        else{
            $test=groupe_classe::Find($id)->where('cours',$cours)
                ->where('langue',$langue)
                ->where('ecole',$ecole)->all();
        }

        return response()->json(array_values($test));
    }

}
