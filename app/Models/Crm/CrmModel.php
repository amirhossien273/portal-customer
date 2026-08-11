<?php

namespace App\Models\Crm;

use Illuminate\Database\Eloquent\Model;

abstract class CrmModel extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';

    public function getConnectionName()
    {
        return config('customer_portal.connection', 'crm');
    }
}
