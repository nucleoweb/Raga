<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExceptionCost extends Model {
    use HasFactory;
    
    protected $fillable = [
	'exception_type',
	'value',
	'cost',
	'service_type',
	'effective_date',
	'expire_date',
	'notes'
    ];
}
