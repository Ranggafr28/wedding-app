<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedbackTransactions extends Model
{
    protected $table = 'feedback_transactions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'no_trans',
        'stars',
        'feedback',
        'feedback_detail',
        'created_at',
        'updated_at',
    ];
}
