<?php

namespace App\Http\Controllers;

use App\Imports\etudiantImport;
use App\Models\etudiant;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class etudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $e= etudiant::with('User')->first();
        $etudiant= $e->all();
        return response()->json($etudiant);

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
           'nom'=>'required',
           'prenom'=>'required',
           'email'=>'required',
           'password'=>'required',
            'matricule'=>'required',
            'cin'=>'required',
        ]);
        $etud=etudiant::create($request->all());
        $user=User::create($request->all());
        $etud->User()->save($user);
        return response()->json('ok');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $etud= etudiant::findOrFail($id);
            $etud->user->first();
            return response()->json($etud);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function edit(etudiant $etudiant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        try {
            $etudiant = etudiant::findOrFail($id);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        $etudiant->update($request->all());
        $user=$etudiant->user->first();
        $user->update($request->all());
        return response()->json($etudiant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $etudiant = etudiant::findOrFail($id);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        $etudiant->user->first()->delete();
        $etudiant->delete();
        return response()->json('ok');
    }

    public function import()
    {
        try {
            Excel::import(new etudiantImport(),  request()->file('file'));
            return response()->json('ok');
        }
        catch (QueryException $e)
        {
            return $e->getMessage();
        }
    }
}

