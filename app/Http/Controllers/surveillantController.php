<?php

namespace App\Http\Controllers;

use App\Models\surveillant;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class surveillantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surv= surveillant::all();
        return response()->json($surv);

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
                $surv=surveillant::create($request->all());
                $surv->User()->save($user);
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
     * @param  \App\Models\surveillant  $surveillant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $surv= surveillant::findOrFail($id);
            $surv->user->first();
            return response()->json($surv);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\surveillant  $surveillant
     * @return \Illuminate\Http\Response
     */
    public function edit(surveillant $surveillant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\surveillant  $surveillant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        try {
            $surveillant = surveillant::findOrFail($id);
            $user_edentique=User::where('email', $request->email)->first();
            if($user_edentique==null or $surveillant->user[0]->email==$request->email) {
                $surveillant->update($request->all());
                $user = $surveillant->user->first();
                $user->update($request->all());
                return response()->json($surveillant);
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
     * @param  \App\Models\surveillant  $surveillant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $surveillant = surveillant::findOrFail($id);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        $surveillant->user->first()->delete();
        $surveillant->delete();
        return response()->json('ok');
    }
}


