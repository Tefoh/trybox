<?php

namespace App\Models;

use Core\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'customer_address_id',
        'product_id',
        'status'
    ];

    protected $casts = [
        'status' => OrderStatusEnum::class
    ];
}
