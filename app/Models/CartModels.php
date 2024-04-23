<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartModels extends Model
{
    protected $table = 'cart_products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'customer_id',
        'kode_produk',
        'qty',
        'remark',
        'created_at',
        'updated_at',
    ];
}
