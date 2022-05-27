<?php

namespace App\Http\Controllers;

use App\Models\etud_grp_forma;
use App\Models\etudiant;
use App\Models\groupe_classe;

use App\Models\groupe_formation;
use App\Models\grp_classe_certif;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class groupe_formationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groupe_formation= groupe_formation::all();
        return response()->json($groupe_formation);

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
            'nom_groupe_forma'=>'required',
            'certification_id'=>'required',
            'langue'=>'required',
            'cours'=>'required',
            'effectif'=>'required',

        ]);
        $f=groupe_formation::create($request->all());
        return response()->json($f);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\groupe_formation  $groupe_formation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $groupe_formation= groupe_formation::findOrFail($id);
            return response()->json($groupe_formation);

        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\groupe_formation  $groupe_formation
     * @return \Illuminate\Http\Response
     */
    public function edit(groupe_formation $groupe_formation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\groupe_formation  $groupe_formation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id )
    {
        try {
            $groupe_formation = groupe_formation::findOrFail($id);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        $groupe_formation->update($request->all());
        return response()->json($groupe_formation);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\groupe_formation  $groupe_formation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $groupe_formation = groupe_formation::findOrFail($id);
        }
        catch (ModelNotFoundException  $e) {
            return $e->getMessage();
        }
        $groupe_formation->delete();
        return response()->json('ok');
    }

    public function recherche_grp_classe(Request $request)
    {
       $grp_classes = new groupe_classeController();
        $grp_classes_ids=grp_classe_certif::select('grp_classe_id')
                                            ->where('certif_id',$request['certification_id'])->get();
$g=$grp_classes->shows($grp_classes_ids,$request['cours'],$request['langue'],$request['ecole']);

        return ($g);
    }



    public function get_sous_groupe($id)
    {
        $e=etud_grp_forma::select('etudiant_id')
                            ->where('grp_forma_id',$id)->get();

            $grp_class_id=etudiant::select('grp_classe_id')
                ->whereIn('id',  $e)->distinct()->get();

        return   (groupe_classe::find($grp_class_id)->all());


       // $grp_classes=groupe_classe::where('id',$grp_class_id)->get();
        //return $grp_class_id;
    }

    public function get_etudinat($id)
    {
        $e=etud_grp_forma::select('etudiant_id')
            ->where('grp_forma_id',$id)->get();

        $etudiant=etudiant::whereIn('id',  $e)->get();

        return   ($etudiant);


    }





   public function get_grp_forma_filtre(Request $request)
    {
        $g=groupe_formation::where('certification_id',$request['certification_id'])
                                        ->where('langue',$request['langue'])
                                        ->where('cours',$request['cours'])->get();
        return response()->json($g);

    }

    public function get_forma_bylocal($local_id)
    {
        $g_forma=groupe_formation::where('local_id',$local_id)->get();
        return response()->json($g_forma);
    }

    public function get_forma_byformateur($formateur_id)
    {
        $g_forma=groupe_formation::where('formateur_id',$formateur_id)->get();
        return response()->json($g_forma);
    }


}
