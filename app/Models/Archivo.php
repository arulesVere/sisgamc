<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="archivo";
    protected $primaryKey="idarchivo";
    protected $fillable = [
        'nombre',
        'peso',
        'tipo',
        'estado',
        'fecharegistro',
    ];
}
