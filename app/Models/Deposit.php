<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Deposit extends Model
{
    use HasFactory;
    use HasUuids;

    protected $primaryKey = 'udeposit_id';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'username',
        'names',
        'email', 
        'amount',
        'increment',
        'contact_number', 
        'status',
    ];

    public function uniqueIds(): array
    {
        return ['udeposit_id'];
    }
}
