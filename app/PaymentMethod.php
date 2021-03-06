<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'payment_method','image'
    ];
    public function getImageAttribute($value)
    {
        return url($value);
    }
}
