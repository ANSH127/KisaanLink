<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'orders';
    protected $fillable = [
        'offer_price',
        'counter_offer_price',
        'quantity',
        'status',
        'product_id',
        'buyer_id',
        'seller_id',
        'payment_method',
        'delivery_address',
        'delivery_date',
        'delivery_status',
        'payment_status',
        'razorpay_payment_id'
    ];
    public function product()
    {
        return $this->belongsTo(ProductDetail::class, 'product_id');
    }
    public function buyer()
    {
        return $this->belongsTo(UserDetail::class, 'buyer_id');
    }
    public function seller()
    {
        return $this->belongsTo(UserDetail::class, 'seller_id');
    }

}
