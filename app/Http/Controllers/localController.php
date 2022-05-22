<?php

namespace App\Http\Controllers;

use App\Imports\localImport;
use App\Models\local;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class localController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $local= local::all();
        return response()->json($local);

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
            'capacite'=>'required',
            'type'=>'required',

        ]);
        $local_identique=local::where('nom', $request->nom)->first();
        if($local_identique==null)
        {
            local::create($request->all());
            return response()->json("ok");
        }
        else
        {
            return response()->json('no');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\local  $local
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $local= local::findOrFail($id);
            return response()->json($local);

        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\local  $local
     * @return \Illuminate\Http\Response
     */
    public function edit(local $local)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\local  $local
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        try {
            $local = local::findOrFail($id);
            $local_identique=local::where('nom', $request->nom)->first();
            if($local_identique==null or $local->nom==$request->nom)
            {
                $local->update($request->all());
                return response()->json($local);
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
     * @param  \App\Models\local  $local
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $local = local::findOrFail($id);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        $local->delete();
        return response()->json('ok');
    }

    public function import()
    {
        try{
            Excel::import(new localImport(),  request()->file('file'));
            return response()->json('ok');
        }
       catch (QueryException $e)
       {
           return $e->getMessage();
       }


    }
}
