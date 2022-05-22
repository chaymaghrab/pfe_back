<?php

namespace App\Http\Controllers;

use App\Models\etud_grp_forma;
use App\Models\etudiant;
use App\Models\groupe_formation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class etud_grp_formaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etud_grp_forma= etud_grp_forma::all();
        return response()->json($etud_grp_forma);

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
            'grp_forma_id'=>'required',
            'grp_classe_id'=>'required',
        ]);
        $etud=etudiant::select('id')
            ->where('grp_classe_id',$request['grp_classe_id'])->get();
        $f=groupe_formation::where('id',$request['grp_forma_id'])->first();

       foreach($etud as $key => $value)
        {
            $value->groupe_formations()->attach($f);
        }
        return response()->json('ok');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\etud_grp_forma  $etud_grp_forma
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $etud_grp_forma= etud_grp_forma::findOrFail($id);
            return response()->json($etud_grp_forma);

        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\etud_grp_forma  $etud_grp_forma
     * @return \Illuminate\Http\Response
     */
    public function edit(etud_grp_forma $etud_grp_forma)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\etud_grp_forma  $etud_grp_forma
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        try {
            $etud_grp_forma = etud_grp_forma::findOrFail($id);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        $etud_grp_forma->update($request->all());
        return response()->json($etud_grp_forma);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\etud_grp_forma  $etud_grp_forma
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $etud_grp_forma = etud_grp_forma::findOrFail($id);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        $etud_grp_forma->delete();
        return response()->json('ok');
    }
}

