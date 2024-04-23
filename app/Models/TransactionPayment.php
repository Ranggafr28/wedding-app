<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionPayment extends Model
{
    protected $table = 'transaction_payment';
    protected $primaryKey = 'id';

    protected $fillable = [
        'year',
        'no_trans',
        'trans_id',
        'order_id',
        'payment_name',
        'customer_id',
        'price',
        'payment_method',
        'status',
        'payment_date',
        'remark',
        'created_at',
        'updated_at',
    ];
}
