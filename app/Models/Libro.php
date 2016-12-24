<?php

namespace Library\Models;

use Illuminate\Database\Eloquent\Model;
use Library\Models\Autor;

class Libro extends Model
{
    protected $fillable = ['title','pages','price','author_id','edit_id'];//

    public function autor() {
    	return $this->hasOne("Library\Models\Autor", "id", "author_id");
    }
    public function editorial() {
    	return $this->hasOne("Library\Models\Editorial", "id", "edit_id");
    }
    public function scopeSearch($query, $title){
    	return $query->where('title','LIKE',"%$title%");
    }
}
