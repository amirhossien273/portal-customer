<?php

namespace App\Models\Crm;

class Receipt extends CrmModel
{
    protected $guarded = [];

    protected $casts = [
        'amount' => 'decimal:0',
        'reviewed_at' => 'datetime',
    ];
}
