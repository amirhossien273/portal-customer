<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends CrmModel
{
    use SoftDeletes;

    protected $guarded = [];

    public function personals(): HasMany
    {
        return $this->hasMany(CustomerPersonal::class)->oldest('created_at');
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class, 'customer_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
