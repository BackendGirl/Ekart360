<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    use HasFactory;

    protected $table = 'product_price';

    protected $fillable = [
        'price',
        'mrp',
        'quantity',
        'product_id',
        'status',
        'theme'
    ];
    

}
