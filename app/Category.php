<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category'
    ];
    public function subCategory(){
        return $this->hasMany(SubCategory::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

}
