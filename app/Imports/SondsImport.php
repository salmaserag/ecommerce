<?php

namespace App\Imports;

use App\Models\Song;
use Maatwebsite\Excel\Concerns\ToModel;



class SondsImport implements ToModel 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Song([
            'name' => $row[0],
            'singer' => $row[1],
            'year' => $row[2],
        ]);
    }
}
