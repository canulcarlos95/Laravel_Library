<?php

namespace Library\Models;

use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
	protected $fillable = ['id','name','email'];
	public function scopeSearch($query, $name){
		return $query->where('name','LIKE',"%$name%");
	}
	public function author() {
		return $this->hasMany("Library\Models\Autor", "edit_id", "id");
	}
	public function book() {
		return $this->hasMany("Library\Models\Libro", "edit_id", "id");
	}
}
