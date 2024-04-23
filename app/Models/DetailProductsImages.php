<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailProductsImages extends Model
{
    protected $table = 'detail_product_images';
    protected $primaryKey = 'id';

    protected $fillable = [
        'code_product',
        'images',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
