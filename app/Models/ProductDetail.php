<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    //
    protected $table = 'products_details';

    protected $fillable = [
        'product_name',
        'produce_type',
        'quantity',
        'price',
        'quality_grade',
        'available_dates_from',
        'available_dates_to',
        'image_url',
        'additional_notes',
        'seller_id',
    ];
}
