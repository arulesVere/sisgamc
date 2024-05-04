<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bajadefinitiva extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="bajadefinitiva";
    protected $primaryKey="idfolder";
    protected $fillable = [
        'placa',
        'razon',
        'hr',
        'tramitador',
        'nomabogado',
        'carnetabogado',
    ];
}
