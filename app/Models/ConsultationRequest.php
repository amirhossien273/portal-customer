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
        'approximate_users',
        'primary_need',
        'topic',
        'topic_label',
        'answers',
        'message',
        'source_page',
        'utm_parameters',
    ];

    protected $casts = [
        'answers' => 'array',
        'utm_parameters' => 'array',
    ];
}
