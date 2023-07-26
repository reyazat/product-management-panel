<?php

namespace App\Models;

use App\Models\Product;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = [
        'name',
        'slug',
        'image',
        'status',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
