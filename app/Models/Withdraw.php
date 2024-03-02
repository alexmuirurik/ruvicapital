<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Withdraw extends Model
{
    use HasFactory;
    use HasUuids;

    protected $primaryKey = 'uwithdraw_id';
    public $incrementing = false;

    protected $fillable = [
        'earning_id',
        'user_id',
        'username',
        'names',
        'email',
        'amount',
        'contact_number',
        'status'
    ];

    public function uniqueIds(): array{
        return ['uwithdraw_id'];
    }
}
