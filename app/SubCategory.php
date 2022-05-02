<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public function clinic(){
        return $this->hasMany(Clinic::class);
    }
}
