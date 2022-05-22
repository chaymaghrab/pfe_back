<?php

namespace App\Http\Controllers;

use App\Models\etud_grp_certif;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class etud_grp_certifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etud_grp_certif= etud_grp_certif::all();
        return response()->json($etud_grp_certif);

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
            'etudiant_id'=>'required',
            'grp_certif_id'=>'required',
        ]);
        etud_grp_certif::create($request->all());
        return response()->json('ok');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\etud_grp_certif  $etud_grp_certif
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $etud_grp_certif= etud_grp_certif::findOrFail($id);
            return response()->json($etud_grp_certif);

        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\etud_grp_certif  $etud_grp_certif
     * @return \Illuminate\Http\Response
     */
    public function edit(etud_grp_certif $etud_grp_certif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\etud_grp_certif  $etud_grp_certif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        try {
            $etud_grp_certif = etud_grp_certif::findOrFail($id);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        $etud_grp_certif->update($request->all());
        return response()->json($etud_grp_certif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\etud_grp_certif  $etud_grp_certif
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $etud_grp_certif = etud_grp_certif::findOrFail($id);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        $etud_grp_certif->delete();
        return response()->json('ok');
    }




}
