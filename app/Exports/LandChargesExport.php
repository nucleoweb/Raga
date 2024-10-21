<?php

namespace App\Exports;

use App\Models\LandCharge;
use Maatwebsite\Excel\Concerns\FromCollection;

class LandChargesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LandCharge::all();
    }
}
