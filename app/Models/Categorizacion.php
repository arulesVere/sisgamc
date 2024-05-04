<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorizacion extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="categorizacion";
    protected $primaryKey="idfolder";
    protected $fillable = [
        'nrocertificacion',
        'nroplaca',
        'tramitador',
        'carnet',
    ];
}
