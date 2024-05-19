<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="vehiculo";
    protected $primaryKey="idempastado";
    protected $fillable = [
        'carpetas',
        'total',
        'certificaciones',
        'placas',
        'fechaingreso',
    ];
}
