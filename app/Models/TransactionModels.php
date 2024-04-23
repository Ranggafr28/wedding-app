<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionModels extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id';

    protected $fillable = [
        'year',
        'event_date',
        'event_address',
        'no_trans',
        'customer_id',
        'total_price',
        'status',
        'stars',
        'feedback',
        'feedback_detail',
        'review_date',
        'remark',
        'created_at',
        'updated_at',
    ];
}
