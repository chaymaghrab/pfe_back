<?php

namespace App\Http\Controllers;

use App\Models\groupe_certification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class groupe_certificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grp_certif= groupe_certification::all();
        return response()->json($grp_certif);

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
            'heurefin'=>'required',
            'certification_id'=>'required',
            'local_id '=>'required',
            'surv1_id'=>'required',

        ]);
        groupe_certification::create($request->all());
        return response()->json('ok');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\groupe_certification  $groupe_certification
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $grp_certif= groupe_certification::findOrFail($id);
            return response()->json($grp_certif);

        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\groupe_certification  $groupe_certification
     * @return \Illuminate\Http\Response
     */
    public function edit(groupe_certification $groupe_certification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\groupe_certification  $groupe_certification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        try {
            $groupe_certification = groupe_certification::findOrFail($id);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        $groupe_certification->update($request->all());
        return response()->json($groupe_certification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\groupe_certification  $groupe_certification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $groupe_certification = groupe_certification::findOrFail($id);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        $groupe_certification->delete();
        return response()->json('ok');
    }
}

