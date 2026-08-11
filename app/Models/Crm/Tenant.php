<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Tenant extends CrmModel
{
    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
    ];

    public function customerPersonals(): HasMany
    {
        return $this->hasMany(CustomerPersonal::class);
    }
}
