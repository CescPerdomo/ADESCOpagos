<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'receipt_id',
        'paypal_order_id',
        'paypal_payer_id',
        'amount',
        'status',
        'paypal_response',
        'paid_at'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paypal_response' => 'array',
        'paid_at' => 'datetime'
    ];

    public function receipt()
    {
        return $this->belongsTo(Receipt::class);
    }
}
