<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $primaryKey = "id_product";

    protected $fillable = [
        "name_product",
        "category_product",
        "sub_category_product",
        "price",
        "stock",
        "is_active",
        "image_product",
        "product_gallery",
    ];

    protected $casts = [
        'product_gallery' => 'array',
    ];
}
