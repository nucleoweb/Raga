<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportRate extends Model
{
    use HasFactory;

    protected $table = 'transport_rates';

    protected $fillable = [
        'origen',
        'destino',
        'tipo_de_transporte',
        'tarifa_de_transporte_base',
        'tarifa_usd_kg',
        'margen_aplicado',
        'id_del_envio',
        'fecha_de_vigencia',
    ];
}
