<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'name','type'
    ];

    public function getActivity()
    {
        return $this->type === 1 ? __('adjustable') : __('fixed');
    }
}
