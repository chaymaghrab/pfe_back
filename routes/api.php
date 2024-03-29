<?php

use App\Http\Controllers\etudiantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

        Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
            return $request->user();
        });


                 /*******************  local route   **************************/

        Route::get('locals',[\App\Http\Controllers\localController::class,'index']);
        Route::get('local/{id}/find',[\App\Http\Controllers\localController::class,'show']);
        Route::post('local/add',[\App\Http\Controllers\localController::class,'store']);
        Route::put('local/{id}/update',[\App\Http\Controllers\localController::class,'update']);
        Route::delete('local/{id}/delete',[\App\Http\Controllers\localController::class,'destroy']);
        Route::post('local/import',[\App\Http\Controllers\localController::class,'import']);
        Route::get('local/{type}/type',[\App\Http\Controllers\localController::class,'get_loc_bytype']);
        Route::get('local/{type}/{l}/type_langue',[\App\Http\Controllers\localController::class,'getloc_langue_type']);

                /***************  groupe certifications route   **************************/

        Route::get('groupe_certifs',[\App\Http\Controllers\groupe_certificationController::class,'index']);
        Route::get('groupe_certif/{id}/find',[\App\Http\Controllers\groupe_certificationController::class,'show']);
        Route::post('groupe_certif/add',[\App\Http\Controllers\groupe_certificationController::class,'store']);
        Route::put('groupe_certif/{id}/update',[\App\Http\Controllers\groupe_certificationController::class,'update']);
        Route::delete('groupe_certif/{id}/delete',[\App\Http\Controllers\groupe_certificationController::class,'destroy']);
        Route::get('groupe_certif/filtre',[\App\Http\Controllers\groupe_certificationController::class,'get_grp_certif_filtre']);
        Route::get('groupe_certif/{id}/etudiant',[\App\Http\Controllers\groupe_certificationController::class,'get_etudinat']);
        Route::get('groupe_certif/{id}/bylocal',[\App\Http\Controllers\groupe_certificationController::class,'get_certif_bylocal']);
        Route::get('groupe_certif/{id}/bysurveillant',[\App\Http\Controllers\groupe_certificationController::class,'get_certif_byfsurv']);


                  /******************  groupe formation route   **************************/

        Route::get('groupe_formas',[\App\Http\Controllers\groupe_formationController::class,'index']);
        Route::get('groupe_forma/{id}/find',[\App\Http\Controllers\groupe_formationController::class,'show']);
        Route::post('groupe_forma/add',[\App\Http\Controllers\groupe_formationController::class,'store']);
        Route::put('groupe_forma/{id}/update',[\App\Http\Controllers\groupe_formationController::class,'update']);
        Route::delete('groupe_forma/{id}/delete',[\App\Http\Controllers\groupe_formationController::class,'destroy']);
        Route::get('groupe_forma/grp_classe',[\App\Http\Controllers\groupe_formationController::class,'recherche_grp_classe']);
        Route::get('groupe_forma/{id}/etudiant',[\App\Http\Controllers\groupe_formationController::class,'get_etudinat']);
        Route::get('groupe_forma/{id}/get_sous_groupe',[\App\Http\Controllers\groupe_formationController::class,'get_sous_groupe']);
        Route::get('groupe_forma/filtre',[\App\Http\Controllers\groupe_formationController::class,'get_grp_forma_filtre']);
        Route::get('groupe_forma/{id}/bylocal',[\App\Http\Controllers\groupe_formationController::class,'get_forma_bylocal']);
        Route::get('groupe_forma/{id}/byformateur',[\App\Http\Controllers\groupe_formationController::class,'get_forma_byformateur']);
        Route::get('groupe_forma/grp_classe_certif',[\App\Http\Controllers\groupe_formationController::class,'recherche_grp_classe_certif']);


                /*******************  certification route   **************************/

        Route::get('certifs',[\App\Http\Controllers\certificationController::class,'index']);
        Route::get('certif/{id}/find',[\App\Http\Controllers\certificationController::class,'show']);
        Route::put('certif/{id}/update',[\App\Http\Controllers\certificationController::class,'update']);
        Route::post('certif/add',[\App\Http\Controllers\certificationController::class,'store']);
        Route::delete('certif/{id}/delete',[\App\Http\Controllers\certificationController::class,'destroy']);
        Route::post('certif/import',[\App\Http\Controllers\certificationController::class,'import']);
        Route::get('certifs_bytype',[\App\Http\Controllers\certificationController::class,'get_certif_bytype']);



                        /******************  conseiller route   **************************/

       Route::get('conseillers',[\App\Http\Controllers\conseillerController::class,'index']);
       Route::get('conseiller/{id}/find',[\App\Http\Controllers\conseillerController::class,'show']);
       Route::post('conseiller/add',[\App\Http\Controllers\conseillerController::class,'store']);
       Route::put('conseiller/{id}/update',[\App\Http\Controllers\conseillerController::class,'update']);
       Route::delete('conseiller/{id}/delete',[\App\Http\Controllers\conseillerController::class,'destroy']);

                    /******************  etudiant_groupe_certification route   **************************/

        Route::get('etud_grp_certifs',[\App\Http\Controllers\etud_grp_certifController::class,'index']);
        Route::get('etud_grp_certif/{id}/find',[\App\Http\Controllers\etud_grp_certifController::class,'show']);
        Route::post('etud_grp_certif/add',[\App\Http\Controllers\etud_grp_certifController::class,'store']);
        Route::put('etud_grp_certif/{id}/update',[\App\Http\Controllers\etud_grp_certifController::class,'update']);
        Route::delete('etud_grp_certif/{id}/delete',[\App\Http\Controllers\etud_grp_certifController::class,'destroy']);


                    /******************  etudiant_ groupe_formation route   **************************/

        Route::get('etud_grp_formas',[\App\Http\Controllers\etud_grp_formaController::class,'index']);
        Route::get('etud_grp_forma/{id}/find',[\App\Http\Controllers\etud_grp_formaController::class,'show']);
        Route::post('etud_grp_forma/add',[\App\Http\Controllers\etud_grp_formaController::class,'store']);
        Route::post('etud_grp_forma/tp/add',[\App\Http\Controllers\etud_grp_formaController::class,'strore_tp_grp']);
        Route::put('etud_grp_forma/{id}/update',[\App\Http\Controllers\etud_grp_formaController::class,'update']);
        Route::delete('etud_grp_forma/{id}/delete',[\App\Http\Controllers\etud_grp_formaController::class,'destroy']);

                /******************  etudiant route   **************************/

        Route::get('etudiants',[\App\Http\Controllers\etudiantController::class,'index']);
        Route::get('etudiant/{id}/find',[\App\Http\Controllers\etudiantController::class,'show']);
        Route::post('etudiant/add',[\App\Http\Controllers\etudiantController::class,'store']);
        Route::put('etudiant/{id}/update',[\App\Http\Controllers\etudiantController::class,'update']);
        Route::delete('etudiant/{id}/delete',[\App\Http\Controllers\etudiantController::class,'destroy']);
        Route::post('etudiant/import',[etudiantController::class,'import']);


                    /******************  formateur route   **************************/

        Route::get('formateurs',[\App\Http\Controllers\formateurController::class,'index']);
        Route::get('formateur/{id}/find',[\App\Http\Controllers\formateurController::class,'show']);
        Route::post('formateur/add',[\App\Http\Controllers\formateurController::class,'store']);
        Route::put('formateur/{id}/update',[\App\Http\Controllers\formateurController::class,'update']);
        Route::delete('formateur/{id}/delete',[\App\Http\Controllers\formateurController::class,'destroy']);

                    /******************  groupe classe route   **************************/

        Route::get('grp_classes',[\App\Http\Controllers\groupe_classeController::class,'index']);
        Route::get('grp_classe/{id}/find',[\App\Http\Controllers\groupe_classeController::class,'show']);
      //  Route::get('grp_classes/find',[\App\Http\Controllers\groupe_classeController::class,'shows']);
        Route::post('grp_classe/add',[\App\Http\Controllers\groupe_classeController::class,'store']);
        Route::put('grp_classe/{id}/update',[\App\Http\Controllers\groupe_classeController::class,'update']);
        Route::delete('grp_classe/{id}/delete',[\App\Http\Controllers\groupe_classeController::class,'destroy']);
        Route::get('grp_classe/cours',[\App\Http\Controllers\groupe_classeController::class,'get_type_cours']);
        Route::get('grp_classe/ecoles',[\App\Http\Controllers\groupe_classeController::class,'get_ecole']);
        Route::get('grp_classe/bydepartement',[\App\Http\Controllers\groupe_classeController::class,'get_grp_bydepartement']);
        Route::get('grp_classe/{dep}/bydepartement_niveau',[\App\Http\Controllers\groupe_classeController::class,'get_niveau_department']);
        Route::get('grp_classe/{dep}/{niv}/getecole',[\App\Http\Controllers\groupe_classeController::class,'get_grp_byecole']);
        Route::get('grp_classe/get_grp_filtre',[\App\Http\Controllers\groupe_classeController::class,'get_grp_by_dep_niv_ecole']);
        Route::get('grp_classe/get_grp_distinct',[\App\Http\Controllers\groupe_classeController::class,'getdisctinct']);
        Route::get('grp_classe/{certif_id}/get_grpaff_distinct',[\App\Http\Controllers\groupe_classeController::class,'get_grpaff_disctinct']);


/******************  groupe classe_certification route   **************************/

        Route::get('grp_classe_cetifs',[\App\Http\Controllers\grp_classe_certifController::class,'index']);
        Route::get('grp_classe_cetif/{id}/find',[\App\Http\Controllers\grp_classe_certifController::class,'show']);
        Route::post('grp_classe_cetif/add',[\App\Http\Controllers\grp_classe_certifController::class,'store']);
        Route::put('grp_classe_cetif/{id}/update',[\App\Http\Controllers\grp_classe_certifController::class,'update']);
        Route::delete('grp_classe_cetif/{id}/delete',[\App\Http\Controllers\grp_classe_certifController::class,'destroy']);
        Route::get('grp_classe_cetif/{id_groupe}/{id_certif}/isaffected',[\App\Http\Controllers\grp_classe_certifController::class,'get_all_certifs']);
        Route::post('grp_classe_cetif/{id_groupe}/{id_certif}/affecter/',[\App\Http\Controllers\grp_classe_certifController::class,'affecter_certif']);
        Route::get('grp_classe_cetif/{certifid}/getgrp_certif',[\App\Http\Controllers\grp_classe_certifController::class,'getgrp_bycertif_id']);
        Route::get('grp_classe_cetif/get_grp_certif_distinct',[\App\Http\Controllers\grp_classe_certifController::class,'get_grp_certif_distinct']);
        Route::post('grp_classe_cetif/import',[\App\Http\Controllers\grp_classe_certifController::class,'import']);
                        /******************  seance route   **************************/

        Route::get('seances',[\App\Http\Controllers\seanceController::class,'index']);
        Route::get('seance/{id}/find',[\App\Http\Controllers\seanceController::class,'show']);
        Route::post('seance/add',[\App\Http\Controllers\seanceController::class,'store']);
        Route::put('seance/{id}/update',[\App\Http\Controllers\seanceController::class,'update']);
        Route::delete('seance/{id}/delete',[\App\Http\Controllers\seanceController::class,'destroy']);
        Route::get('seance/{id}/find_bygrp_forma',[\App\Http\Controllers\seanceController::class,'find_bygrp_forma']);
        Route::get('seance/find_bylist_grp_forma',[\App\Http\Controllers\seanceController::class,'find_list_bygrp_forma']);
        Route::get('seance/find_bylist_formateur_forma',[\App\Http\Controllers\seanceController::class,'find_list_by_formateur']);


                        /******************  surveillant route   **************************/


        Route::get('surveillants',[\App\Http\Controllers\surveillantController::class,'index']);
        Route::get('surveillant/{id}/find',[\App\Http\Controllers\surveillantController::class,'show']);
        Route::post('surveillant/add',[\App\Http\Controllers\surveillantController::class,'store']);
        Route::put('surveillant/{id}/update',[\App\Http\Controllers\surveillantController::class,'update']);
        Route::delete('surveillant/{id}/delete',[\App\Http\Controllers\surveillantController::class,'destroy']);


   /******************  etudiant certif route   **************************/


   Route::get('etud_certifs',[\App\Http\Controllers\etud_certifController::class,'index']);



