<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    protected $fillable = [
        'customer_id',
        'receiver_id',
        'country',
        'state',
        'city',
        'street_address',
        'postal_code',
        'box_number',
        'sending_date',
        'weight',
        'description',
        'estimated_delivery_date',
        'dimensions',
        'package_type',
        'declared_value_rate',
        'shipping_charge',
        'extra_charge',
        'documents',
        'tracking_number',
        'status',
        'notes',
    ];

    protected $casts = [
        'sending_date' => 'date',
        'estimated_delivery_date' => 'date',
        'weight' => 'decimal:2',
        'declared_value_rate' => 'decimal:2',
        'shipping_charge' => 'decimal:2',
        'extra_charge' => 'decimal:2',
        'documents' => 'array',
    ];

    /**
     * Get the customer (sender) that owns the item.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the receiver that owns the item.
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(Receiver::class);
    }

    /**
     * Calculate total charge
     */
    public function getTotalChargeAttribute(): float
    {
        return ($this->shipping_charge ?? 0) + ($this->extra_charge ?? 0);
    }
}
