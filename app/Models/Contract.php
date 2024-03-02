<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $primaryKey = 'udeposit_id';
    public $incrementing = false;

    protected $fillable = [
        'udeposit_id',
        'user_id',
        'username',
        'names',
        'email',
        'signature',
        'termination_date',
        'amount',
        'contact_number',
        'status'
    ];
}
