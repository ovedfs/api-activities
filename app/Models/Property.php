<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function contract()
    // {
    //     return $this->belongsTo(Contract::class);
    // }

    public function contract()
    {
        return $this->hasOne(Contract::class);
    }
}
