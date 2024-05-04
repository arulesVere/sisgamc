<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estante extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="estante";
    protected $primaryKey="idestante";
    protected $fillable = [
        'nombre',
        'fila',
        'idoficina',
    ];
}
