<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'rate',
        'type',
        'status',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
