<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['nombre', 'apellido', 'telefono', 'cedula'];

  public function Module()
    {
        return $this->belongsToMany('App\Models\Module', 'module_teachers','teacher_id','module_id');
    }
}

