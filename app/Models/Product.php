<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\ProductImage;
use App\Models\TargetMarket;
use App\Models\TaxClass;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = [
        'name',
        'slug',
        'sku',
        'short_description',
        'description',
        'tags',
        'image',
        'price',
        'supplier_price',
        'weight',
        'length',
        'width',
        'height',
        'date_available',
        'quantity',
        'minimum',
        'tax_class_id',
        'manufacturer_id',
        'meta_title',
        'meta_description',
        'viewed',
        'sorted',
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


    public function relatedProducts()
    {
        return $this->belongsToMany(self::class, 'related_products', 'product_id', 'related_product_id');
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }


    public function taxClass()
    {
        return $this->belongsTo(TaxClass::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class)->with('optionValues')->orderBy('sorted')->withPivot('required', 'value');
    }

    public function optionValues()
    {
        return $this->belongsToMany(OptionValue::class,'option_product_value')->orderBy('sorted')->withPivot(
            'option_id',
            'price',
            'quantity',
            'point',
            'price_prefix',
            'point_prefix',
        );
    }

    public function customerGroups()
    {
        return $this->belongsToMany(TargetMarket::class)->withPivot('price', 'quantity');
    }
}
