<?php

namespace App\Imports;

use App\Models\local;
use Maatwebsite\Excel\Concerns\ToModel;

class localImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new local([
            'nom'    => $row[0],
            'capacite'    => $row[1],
            'type'    => $row[2],
        ]);
    }
}
