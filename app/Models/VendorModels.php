<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorModels extends Model
{
    protected $table = 'master_vendor';
    protected $primaryKey = 'id';

    protected $fillable = [
        'vendor_id',
        'fullname',
        'phone',
        'address',
        'avatar',
        'created_at',
        'updated_at',
    ];
}
