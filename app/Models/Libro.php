<?php

namespace Library\Models;

use Illuminate\Database\Eloquent\Model;
use Library\Models\Autor;

class Libro extends Model
{
    protected $fillable = ['title','pages','price','edit_id'];//

    public function author() {
        return $this->belongsToMany('Library\Models\Autor','book_authors','book_id','author_id')->withTimestamps();
    }
    public function editorial() {
    	return $this->hasOne("Library\Models\Editorial", "id", "edit_id");
    }
    public function scopeSearch($query, $title){
    	return $query->where('title','LIKE',"%$title%");
    }
}
