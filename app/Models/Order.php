<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    // Laravel'in toplu veri yazmasına izin verdiğimiz alanlar
    protected $fillable = ['user_id', 'total_amount', 'status'];

    // Her sipariş bir kullanıcıya aittir
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
