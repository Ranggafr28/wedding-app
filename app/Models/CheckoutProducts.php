<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutProducts extends Model
{
    protected $table = 'checkout_products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'no_trans',
        'code_product',
        'qty',
        'price',
        'product_note',
        'created_at',
        'updated_at',
    ];
}
