<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
public function products(){
    return $this->hasMany('App\Admin');
}

public function subcategories(){
    return $this->hasMany('App\Subcategory');
}
}
