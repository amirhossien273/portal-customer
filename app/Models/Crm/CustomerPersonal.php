<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomerPersonal extends CrmModel
{
    protected $table = 'customer_personal';

    protected $guarded = [];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function getFullNameAttribute(): string
    {
        return trim(collect([$this->first_name, $this->last_name])->filter()->join(' '));
    }
}
