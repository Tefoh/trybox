<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'lat',
        'long',
        'address',
        'zip_code',
        'city',
        'state'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
