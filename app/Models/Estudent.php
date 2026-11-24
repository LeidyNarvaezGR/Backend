<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Estudent extends Model
{
     use HasFactory;
    protected $fillable = [
    'nombre',
    'apellidos',
    'fecha_nacimiento',
    'expediente',
    'foto'
];


     public function Module()
    {
        return $this->belongsToMany('App\Models\Module', 'estudent_module', 'estudent_id','module_id');
    }
    public function delegado()
{
    return $this->belongsTo(Estudent::class, 'delegado_id');
}

public function representados()
{
    return $this->hasMany(Estudent::class, 'delegado_id');
}
}