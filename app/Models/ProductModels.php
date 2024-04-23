<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModels extends Model
{
    protected $table = 'master_product';
    protected $primaryKey = 'id';

    protected $fillable = [
        'code_product',
        'vendor_id',
        'product',
        'price',
        'category',
        'type',
        'picture',
        'remark',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
