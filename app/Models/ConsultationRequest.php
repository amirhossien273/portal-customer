<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company',
        'mobile',
        'email',
        'company_type',
        'message',
        'source_page',
    ];
}
