<?php

namespace Library\Models;

use Illuminate\Database\Eloquent\Model;
use Library\Models\Autor;

class Libro extends Model
{
    protected $fillable = ['title','pages','price','editorial','author_id'];//

    public function autor() {
    	return $this->hasOne("Library\Models\Autor", "id", "author_id");
    }
}
