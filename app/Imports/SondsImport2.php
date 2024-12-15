<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

// use App\Models\Song;
// use Maatwebsite\Excel\Concerns\ToModel;

class SondsImport2 implements ToArray , WithHeadingRow 
{
   
    public function array(array $array){
        return $array;
    }
    
}
