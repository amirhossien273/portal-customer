<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends CrmModel
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'booking_date' => 'datetime',
        'transaction_data' => 'array',
        'offer_data' => 'array',
        'totals' => 'array',
    ];

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Inquiry::class, 'transaction_id');
    }

    public function shipments(): HasMany
    {
        return $this->hasMany(Shipment::class);
    }
}
