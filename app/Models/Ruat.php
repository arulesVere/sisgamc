<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruat extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table="ruat";
    protected $primaryKey="idfolder";
    protected $fillable = [
        'nrocert',
        'nroplaca',
        'tiposolicitante',
    ];
}