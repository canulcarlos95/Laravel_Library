<?php

namespace Library\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $fillable = ['name','country'];//

    public function scopeSearch($query, $name){
    	return $query->where('name','LIKE',"%$name%");
    }
}
