<?php

namespace App\Imports;

use App\Models\certification;
use App\Models\etud_certif;
use App\Models\etudiant;
use App\Models\local;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use function PHPUnit\Framework\throwException;

class testImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
           
            try {
                $c=certification::select('id')->where('nom_formation',  $row[1])->get();
                if(count($c)!=0)
                {
                $etud=etudiant::where('matricule',$row[0])->first();
                $etud_certif_acctuel=etud_certif::where('certif_id', $c[0]->id)
                ->where('etud_id', $etud->id)->get();
               // $etud->certif= $c[0]->id;
              // print(count($etud_certif_acctuel));
               if(count($etud_certif_acctuel)==0)
               {
                $etud_certif = new etud_certif([
                    'certif_id'    => $c[0]->id,
                    'etud_id'    => $etud->id,
                    'langue_certif'=> $row[2],
                ]);
                $etud_certif->save();
                $etud_certif->fresh();
                }
            }
                else{
                    $error = \Illuminate\Validation\ValidationException::withMessages([
                        'certif' => ['not found'],
                     ]);
                     throw $error;
                }
              //  print($etud->certif);
            }
            catch (ModelNotFoundException  $e) {
                return $e->getMessage();
            }
        }
    }

}
