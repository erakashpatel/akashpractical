<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function Books(){
    	return $this->belongsToMany(Book::class);
    }
}
