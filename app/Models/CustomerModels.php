<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerModels extends Model
{
    protected $table = 'master_customer';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'fullname',
        'phone',
        'address',
        'avatar',
        'created_at',
        'updated_at',
    ];
}
