<?php

namespace App\Http\Controllers;

use App\Models\certification;
use App\Models\groupe_classe;
use App\Models\grp_classe_certif;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\PseudoTypes\List_;

class grp_classe_certifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grp_classe_certif= grp_classe_certif::all();
        return response()->json($grp_classe_certif);

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
            'nbheure'=>'required',
            'semestre'=>'required',
        ]);
        grp_classe_certif::create($request->all());
        return response()->json('ok');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\grp_classe_certif  $grp_classe_certif
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $grp_classe_certif= grp_classe_certif::findOrFail($id);
            return response()->json($grp_classe_certif);

        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\grp_classe_certif  $grp_classe_certif
     * @return \Illuminate\Http\Response
     */
    public function edit(grp_classe_certif $grp_classe_certif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\grp_classe_certif  $grp_classe_certif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        try {
            $grp_classe_certif = grp_classe_certif::findOrFail($id);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        $grp_classe_certif->update($request->all());
        return response()->json($grp_classe_certif);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\grp_classe_certif  $grp_classe_certif
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $grp_classe_certif = grp_classe_certif::findOrFail($id);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        $grp_classe_certif->delete();
        return response()->json('ok');
    }

    public function affecter_certif( $id_grp_classe , $id_certif , Request $data )
    {
        try {
            $grp_classeid_certifs=grp_classe_certif::select('certif_id')->where('grp_classe_id',$id_grp_classe)->get();

         foreach ($grp_classeid_certifs as $item)
            {
                if($item['certif_id']==$id_certif)
                {
                    return response()->json('no');
                }
            }
            $grp_classe=groupe_classe::where('id',$id_grp_classe)->first();
            $certif=certification::where('id',$id_certif)->first();
            $grp_classe->certifications()->attach($id_certif, ['semestre' => $data[0], 'nbheure' =>$data[1] ]);
            return response()->json('ok');
             }
        catch (ModelNotFoundException  $e){
            return $e->getMessage();
        }

    }

    public function get_all_certifs($grp_id)
    {
          return grp_classe_certif::where('grp_classe_id',$grp_id)->get();

    }


}
