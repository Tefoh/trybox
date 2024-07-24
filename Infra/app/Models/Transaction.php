<?php

namespace App\Models;

use Core\Enums\TransactionStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'price',
        'description',
        'status',
        'total',
        'transaction_number',
        'ip',
        'error'
    ];

    protected $casts = [
        'status' => TransactionStatusEnum::class
    ];
}
