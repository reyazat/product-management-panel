<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'related_product_id',
    ];

}
