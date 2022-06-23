<?php

namespace Store\Manager\Models\PreCheckout;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    //
    protected $table = "web_store_orders";

    protected $fillable = [ 
        'customer_id',
        'order_code',
        'barcode',
        'shipped_date',
        'pickup',
        'payment_option_id',
        'discount',
        'delivery_charge',
        'address_id',
        'comment',
        'order_source',
        'status',
        'cart_checkout'
    ];
}

            