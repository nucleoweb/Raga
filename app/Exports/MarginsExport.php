<?php

namespace App\Exports;

use App\Models\Margins;
use Maatwebsite\Excel\Concerns\FromCollection;

class MarginsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Margins::all();
    }
}
