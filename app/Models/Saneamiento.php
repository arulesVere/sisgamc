<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saneamiento extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="saneamiento";
    protected $primaryKey="idfolder";
    protected $fillable = [
        'fecharecepcion',
        'solicitud',
        'otb',
        'supervisor',
        'procedencia',
    ];
}

