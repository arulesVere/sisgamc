<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="prestamo";
    protected $primaryKey="idprestamo";
    protected $fillable = [
        'codigo',
        'fechaprestamo',
        'fechadevolucion',
        'motivo',
        'aquien',
        'idfolder',
    ];
}

