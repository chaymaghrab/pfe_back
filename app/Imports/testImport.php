<?php

namespace App\Imports;

use App\Models\etudiant;
use App\Models\local;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class testImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $etud = etudiant::create([
                'matricule'    => $row[0],
                'cin'    => $row[1],
            ]);

            local::create([
                'nom'     => $etud->id,
                'capacite'    => $row[3],
                'type'    => $row[4],
            ]);
        }

    }

}
