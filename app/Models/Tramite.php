<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="tramite";
    protected $primaryKey="idtramite";
    protected $fillable = [
        'nombre',
        'idoficina',
    ];
}
