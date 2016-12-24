<?php

namespace Library\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $fillable = ['name','country','edit_id'];//

    public function editorial() {
    	return $this->hasOne("Library\Models\Editorial", "id", "edit_id");
    }
    public function scopeSearch($query, $name){
    	return $query->where('name','LIKE',"%$name%");
    }
}
