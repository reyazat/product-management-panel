<?php

namespace App\Models;

use App\Models\OptionValue;
use App\Models\Product;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = [
        'name',
        'type',
        'sorted',
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function optionValues()
    {
        return $this->hasMany(OptionValue::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
