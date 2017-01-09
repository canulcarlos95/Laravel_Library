<?php

namespace Library\Models;

use Illuminate\Database\Eloquent\Model;
use Library\Models\Libro;
class Autor extends Model
{
    protected $fillable = ['name','country','edit_id','email'];//

    public function book() {
        return $this->belongsToMany('Library\Models\Libro','book_authors','book_id','author_id')->withTimestamps();
    }
    public function editorial() {
    	return $this->hasOne("Library\Models\Editorial", "id", "edit_id");
    }
    public function scopeSearch($query, $name){
    	return $query->where('name','LIKE',"%$name%");
    }
}
