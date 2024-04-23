<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionApproval extends Model
{
  protected $table = 'transaction_approval';
  protected $primaryKey = 'id';

  protected $fillable = [
    'no_trans',
    'vendor_id',
    'approve',
    'created_at',
    'updated_at',
  ];
}
