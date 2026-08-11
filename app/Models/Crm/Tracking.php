<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tracking extends CrmModel
{
    use SoftDeletes;

    protected $table = 'booking_trackings';

    protected $guarded = [];

    protected $casts = [
        'event_time' => 'datetime',
        'expected_time' => 'datetime',
        'actual_time' => 'datetime',
        'is_customer_visible' => 'boolean',
        'delay_days' => 'integer',
    ];

    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class, 'shipment_id');
    }
}
