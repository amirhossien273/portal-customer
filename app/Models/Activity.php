<?php

namespace App\Models;

use App\Tenancy\TenantContext;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Models\Activity as SpatieActivity;

class Activity extends SpatieActivity
{
    use HasUuids;

    protected static function booted(): void
    {
        static::addGlobalScope('tenant', function (Builder $builder): void {
            $tenant = app(TenantContext::class)->current();

            if ($tenant) {
                $builder->where($builder->getModel()->qualifyColumn('tenant_id'), $tenant->getKey());
            }
        });

        static::creating(function (Activity $activity): void {
            $tenant = app(TenantContext::class)->current();

            if ($tenant) {
                $activity->tenant_id = $tenant->getKey();
            }
        });
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }
}
