<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $fillable = ['clinic', 'image'];

    public function subCategory() {
        return $this->belongsTo(SubCategory::class);
    }
}
