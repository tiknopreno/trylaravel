<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entryproduct extends Model
{
    //
    protected $table = "entry_products";
    protected $primaryKey = "id_entry_product";
    protected $fillable = [
        "id_product",
        "qty",
        "total_price",
        "delivery_owner",
        "user_id",
        "user_accept",
        "status_entry",
        "status_payment",
        "code_bank",
        "number_card",
        "discount",
        "total_discount",
        "image_checking",
        "date_of_entry",
    ];

    public function product(): BelongsTo{
        return $this->belongsTo(Product::class , 'id_product');
    }
}
