<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'street',
        'city',
        'state',
        'postal_code',
        'country',
    ];

    /**
     * Get the items for the customer.
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
