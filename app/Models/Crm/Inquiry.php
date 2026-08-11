<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inquiry extends CrmModel
{
    use SoftDeletes;

    protected $table = 'transactions';

    protected $guarded = [];

    protected $casts = [
        'routes' => 'array',
        'cargo_items' => 'array',
        'stackable' => 'boolean',
        'need_warehousing' => 'boolean',
        'need_clearance' => 'boolean',
        'amount' => 'decimal:2',
        'approximate_amount' => 'decimal:2',
        'weight' => 'decimal:2',
        'total_volume' => 'decimal:2',
    ];

    public function booking(): HasOne
    {
        return $this->hasOne(Booking::class, 'transaction_id');
    }
}
