<?php

namespace App\Http\Controllers;

use App\Imports\certificationImport;
use App\Models\certification;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Maatwebsite\Excel\Facades\Excel;

class certificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certification= certification::all();
        return response()->json($certification);

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_formation' => 'required',
            'nbheure' => 'required',
            'score_de_passage' => 'required',
            'nbquestion' => 'required',
            'type_examan' => 'required',
            'duree' => 'required',
        ]);
        $certif_identique=certification::where('nom_formation', $request->nom_formation)->first();
        if($certif_identique==null)
        {
            certification::create($request->all());
            return response()->json('ok');
        }
        else
        {
            return response()->json('no');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\certification $certification
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $certification= certification::findOrFail($id);
            return response()->json($certification);

        } catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\certification $certification
     * @return \Illuminate\Http\Response
     */
    public function edit(certification $certification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\certification $certification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $certification = certification::findOrFail($id);
            $certif_identique=certification::where('nom_formation', $request->nom_formation)->first();
            if($certif_identique==null or $certification->nom_formation==$request->nom_formation)
            {
                $certification->update($request->all());

                return response()->json($certification);
            }
            else
            {
                return response()->json('no');
            }

        } catch (ModelNotFoundException  $e) {
            //  return  response()->json(['message'=>die($e->getMessage())],404);
            return $e->getMessage();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\certification $certification
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $certification = certification::findOrFail($id);
        } catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        $certification->delete();
        return response()->json('ok');

    }

    public function get_certif_bytype(Request $request)
    {
        $grp_classe= certification::where('type_examan',$request['type'])->get();

        return response()->json($grp_classe);

    }

    public function import()
    {
        try {
            Excel::import(new certificationImport(), request()->file('file'));
            return response()->json('ok');
        } catch (QueryException $e) {
            return $e->getMessage();
        }
    }



}
