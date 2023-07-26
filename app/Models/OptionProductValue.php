<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionProductValue extends Model
{
    use HasFactory;
    protected $fillable = [
        'option_id',
        'product_id',
        'option_value_id',
        'price',
        'quantity',
        'point',
        'price_prefix',
        'point_prefix',
    ];
}
