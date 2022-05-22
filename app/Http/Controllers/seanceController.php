<?php

namespace App\Http\Controllers;

use App\Models\local;
use App\Models\seance;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class seanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seance= local::all();
        return response()->json($seance);

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
            'date'=>'required',
            'heuredeb'=>'required',
            'heurefin '=>'required',
            'type '=>'required',

        ]);
        seance::create($request->all());
        return response()->json('ok');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\seance  $seance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $seance= seance::findOrFail($id);
            return response()->json($seance);

        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\seance  $seance
     * @return \Illuminate\Http\Response
     */
    public function edit(seance $seance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\seance  $seance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        try {
            $seance= seance::findOrFail($id);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        $seance->update($request->all());
        return response()->json($seance);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\seance  $seance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $seance= seance::findOrFail($id);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        $seance->delete();
        return response()->json('ok');
    }
}
