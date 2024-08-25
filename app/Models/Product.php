<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'title',
        'slug',
        'photo',
        'sub_photos',
        'category',
        'rating',
        'description',
        'additional_info',
        'care_instruction',
        'status',
        'is_daily_staples',
        'deal_of_the_day',
        'vender',
        'theme'
    ];

    public function getProductPriceAttribute()
    {
        return $this->productPrice->price ?? null;
    }

    public function getProductQuantityAttribute()
    {
        return $this->productPrice->quantity ?? null;
    }

    public function productPrice()
    {
        return $this->hasOne(ProductPrice::class);
    }
    
}
