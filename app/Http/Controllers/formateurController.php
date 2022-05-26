<?php

namespace App\Http\Controllers;

use App\Models\formateur;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class formateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $form= formateur::all();
        return response()->json($form);
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
            'statut'=>'required',
            'telephone'=>'required',

        ]);

        try {
            $user = new User($request->all());
            $user_edentique=User::where('email', $user->email)->first();
            if($user_edentique==null)
            {
                $forma = formateur::create($request->all());
                $forma->User()->save($user);
                return response()->json('ok');
            }
            else
            {
                return response()->json('no');
            }


        }
        catch(QueryException $e)
        {
            return  $e->getMessage();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\formateur  $formateur
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
             $formateur=formateur::findOrFail($id);
            $formateur->user->first();
            return response()->json($formateur);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\formateur  $formateur
     * @return \Illuminate\Http\Response
     */
    public function edit(formateur $formateur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\formateur  $formateur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        try {
            $formateur = formateur::findOrFail($id);
            $user_edentique=User::where('email', $request->email)->first();
            if($user_edentique==null or $formateur->user[0]->email==$request->email) {
                $formateur->update($request->all());
                $user = $formateur->user->first();
                $user->update($request->all());
                return response()->json($formateur);
            }
            else
            {
                return response()->json('no');
            }
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\formateur  $formateur
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
        $formateur = formateur::findOrFail($id);
    }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
    }
        $formateur->user->first()->delete();
        $formateur->delete();
        return response()->json('ok');
    }
}


