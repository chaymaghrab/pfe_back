<?php

namespace App\Http\Controllers;

use App\Models\etud_certif;
use App\Models\etudiant;
use App\Models\groupe_classe;
use Illuminate\Http\Request;

class etud_certifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {$grp_ids=[];
        $e= etud_certif::select('etud_id')->where('certif_id',$request['certification_id'])
        ->where('langue_certif',$request['langue'])->get();
        $grp_classes_ids=groupe_classe::select('id')->where('cours',$request['cours'])->get(); 
       foreach($grp_classes_ids as $g)
       {
        array_push($grp_ids,$g->id);

       }
        $etfinal=etudiant::whereIn('grp_classe_id',$grp_ids)       
             ->whereIn('id',  $e)->get();

        return response()->json($etfinal);

    }

}
