<?php

namespace App\Imports;

use App\Models\etudiant;
use App\Models\groupe_classe;
use App\Models\groupe_formation;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class etudiantImport implements ToCollection
{

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    { //$user_type='etudiant';
       /* $e=etudiant::first();
        $f=groupe_formation::first();
        $e->groupe_formations()->attach($f);*/

        foreach ($collection as $row) {
            $grp_classe= new groupe_classe([
                'ecole'    => $row[6],
                'departement'    => $row[7],
                'niveau'    => $row[8],
                'parcours'    => $row[9],
                'nom_groupe'    => $row[10],
                'code_groupe'    => $row[11],
                'cours'    => $row[13],
                'langue'    => $row[12],

            ]);

            $etud = new etudiant([
                'matricule'    => $row[4],
                'cin'    => $row[5],
              'grp_classe_id'=> $grp_classe->id,

            ]);
            $id_grp_classe=$grp_classe->id;
            $test=groupe_classe::where('code_groupe', $grp_classe->code_groupe)->first();
            $etud->save();
            $etud->fresh();

            if($test==null) {
                $grp_classe->save();
                $grp_classe->fresh();
                $grp_classe->etudiants()->save($etud);
            }
            else{
                $test->etudiants()->save($etud);
            }



           $user= new User([
                'nom'     => $row[0],
                'prenom'    => $row[1],
                'email'    => $row[2],
                'password'     => $row[3],
            ]);
            $etud->User()->save($user);


          /*$etud->User()->create([
              'nom'     => $row[0],
              'prenom'    => $row[1],
              'email'    => $row[2],
              'password'     => $row[3],
          ]);*/
        }

    }
}
