<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleModels extends Model
{
    protected $table = 'master_role';
    protected $primaryKey = 'id';

    protected $fillable = [
        'role',
        'created_at',
        'updated_at',
    ];
}
