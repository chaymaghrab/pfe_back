<?php

namespace App\Imports;

use App\Models\certification;
use Maatwebsite\Excel\Concerns\ToModel;

class certificationImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new certification([
            'nom_formation'    => $row[0],
            'nbheure'    => $row[1],
            'score_de_passage'    => $row[2],
            'nbquestion'    => $row[3],
            'type_examan'    => $row[4],
            'duree'    => $row[5],
        ]);
    }
}
