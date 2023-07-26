<?php

namespace App\Models;

use App\Models\Product;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetMarket extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'approve_customer',
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

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

}
