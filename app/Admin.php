<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{protected $table = 'admins';

public function users(){
    return $this->belongsTo('App\User');
}
public function subcategory(){
    return $this->belongsTo('App\Subcategory');
}
public function category(){
    return $this->belongsTo('App\Category');
}
}
