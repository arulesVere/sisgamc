<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preescripcion extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="preescripcion";
    protected $primaryKey="idfolder";
    protected $fillable = [
        'placa',
        'nrotramite',
        'nroregistro',
    ];
}
