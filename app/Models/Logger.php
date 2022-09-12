<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logger extends Model
{
    use HasFactory;

    protected $table = 'logs';

    protected $fillable = [
        'activity', 'url', 'method', 'ip', 'agent', 'user_id', 'role'
    ];
}
