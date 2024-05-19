<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasillo extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="pasillo";
    protected $primaryKey="idpasillo";
    protected $fillable = [
        'nombre',
        'detalle',
        'idoficina',
    ];
}
