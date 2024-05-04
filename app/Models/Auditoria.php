<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="auditoria";
    protected $primaryKey="idauditoria";
    protected $fillable = [
        'detalle',
        'fecharegistro',
    ];
}
