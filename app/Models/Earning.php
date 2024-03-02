<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'username',
        'names',
        'deposit_id',
        'slug',
        'working_capital',
        'month', 
        'status'
    ];
}
