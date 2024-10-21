<?php

namespace App\Exports;

use App\Models\PortCharge;
use Maatwebsite\Excel\Concerns\FromCollection;

class PortChargesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PortCharge::all();
    }
}
