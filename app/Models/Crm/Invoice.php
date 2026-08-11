<?php

namespace App\Models\Crm;

class Invoice extends CrmModel
{
    protected $guarded = [];

    protected $casts = [
        'proforma_at' => 'datetime',
        'payable_amount' => 'decimal:2',
        'total_items_amount' => 'decimal:2',
    ];
}
