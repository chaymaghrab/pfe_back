<?php

namespace App\Http\Controllers;

use App\Models\etud_grp_certif;
use App\Models\etudiant;
use App\Models\groupe_certification;
use App\Models\groupe_formation;
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
            'nom_groupe_certif'=>'required',
            'certification_id'=>'required',
            'langue'=>'required',
            'cours'=>'required',
            'effectif'=>'required',

        ]);
        $c=groupe_certification::create($request->all());
        return response()->json($c);

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

    
   public function get_grp_certif_filtre(Request $request)
   {
       $g=groupe_certification::where('certification_id',$request['certification_id'])
                                       ->where('langue',$request['langue'])
                                       ->where('cours',$request['cours'])->get();
       return response()->json($g);

   }
   
   public function get_etudinat($id)
   {
       $e=etud_grp_certif::select('etudiant_id')
           ->where('grp_certif_id',$id)->get();

       $etudiant=etudiant::whereIn('id',  $e)->get();

       return   ($etudiant);
   }
   public function get_certif_bylocal($local_id)
   {
       $g_certif=groupe_certification::where('local_id',$local_id)->get();
       return response()->json($g_certif);
   }
   public function get_certif_byfsurv($surv1)
   {
    $g_certif=groupe_certification::where('surv1_id',$surv1)->get();
    return response()->json($g_certif);
   }

}

