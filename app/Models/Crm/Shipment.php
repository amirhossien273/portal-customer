<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Shipment extends CrmModel
{
    protected $table = 'operation_shipments';

    protected $guarded = [];

    protected $casts = [
        'departure_date' => 'date',
        'route_data' => 'array',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function job(): BelongsTo
    {
        return $this->belongsTo(OperationJob::class, 'operation_job_id');
    }

    public function visibleTrackings(): HasMany
    {
        return $this->hasMany(Tracking::class, 'shipment_id')
            ->where('is_customer_visible', true)
            ->orderBy('event_time')
            ->orderBy('created_at');
    }

    public function latestVisibleTracking(): HasOne
    {
        return $this->hasOne(Tracking::class, 'shipment_id')
            ->where('is_customer_visible', true)
            ->latestOfMany('event_time');
    }
}
