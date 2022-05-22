<?php

namespace App\Http\Controllers;

use App\Models\conseiller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class conseillerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conseiller= conseiller::all();
        return response()->json($conseiller);

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
            'parcours'=>'required',

        ]);

        try {

            $user=new User($request->all());
            $user_edentique=User::where('email', $user->email)->first();
            if($user_edentique==null)
            {
                $conseiller=conseiller::create($request->all());

                $conseiller->User()->save($user);
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
     * @param  \App\Models\conseiller  $conseiller
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $conseiller= conseiller::findOrFail($id);
            $conseiller->user->first();
            return response()->json($conseiller);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\conseiller  $conseiller
     * @return \Illuminate\Http\Response
     */
    public function edit(conseiller $conseiller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\conseiller  $conseiller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        try {
            $conseiller = conseiller::findOrFail($id);
            $user_edentique=User::where('email', $request->email)->first();
            if($user_edentique==null or $conseiller->user[0]->email==$request->email) {
                $conseiller->update($request->all());
                $user=$conseiller->user->first();
                $user->update($request->all());
                return response()->json($conseiller);
            }
            else{
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
     * @param  \App\Models\conseiller  $conseiller
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $conseiller = conseiller::findOrFail($id);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        $conseiller->user->first()->delete();
        $conseiller->delete();
        return response()->json('ok');
    }
}
