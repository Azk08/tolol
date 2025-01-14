<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class cart extends Model
{
    protected $fillable = [
        'user_id', 
        'product_id', 
        'quantity'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(user::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class);
    }
}
