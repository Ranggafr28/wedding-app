<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryModels extends Model
{
    protected $table = 'master_category';
    protected $primaryKey = 'id';

    protected $fillable = [
        'category',
        'remark',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];
}
