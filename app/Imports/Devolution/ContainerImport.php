<?php

namespace App\Imports\Devolution;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ContainerImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //
    }
}
