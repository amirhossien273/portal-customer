<?php

namespace App\Models\Crm;

class Payment extends CrmModel
{
    protected $guarded = [];

    protected $casts = [
        'amount' => 'decimal:0',
        'is_paid' => 'boolean',
        'paid_at' => 'datetime',
    ];
}
