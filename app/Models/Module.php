<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
     use HasFactory;

    
    protected $fillable = [
        'codigo',
        'nombre'
    ];

     public function Teacher()
    {
        return $this->belongsToMany('App\Models\Teacher','module_teachers','module_id','teacher_id');
    }

    public function Estudent()
    {
        return $this->belongsToMany('App\Models\Estudent','estudent_module','module_id','estudent_id');
    }
}
