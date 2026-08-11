<?php

return [
    /*
    | CRM is intentionally a named connection so the public portal can be
    | deployed separately while still reading the authoritative CRM data.
    */
    'connection' => env('CUSTOMER_PORTAL_DB_CONNECTION', 'crm'),

    /*
    | Tables read by the customer portal from Sepand CRM. These are checked by
    | `php artisan portal:check-databases` without running CRM migrations here.
    */
    'site_required_tables' => [
        'migrations',
        'activity_log',
        'consultation_requests',
    ],

    'crm_required_tables' => [
        'tenants',
        'customers',
        'customer_personal',
        'transactions',
        'bookings',
        'operation_jobs',
        'operation_shipments',
        'booking_trackings',
        'invoices',
        'receipts',
    ],

    'tenant_id' => env(
        'CUSTOMER_PORTAL_TENANT_ID',
        env('TENANCY_DEFAULT_ID', '00000000-0000-0000-0000-000000000001')
    ),

    'otp' => [
        'length' => 6,
        'expires_in_seconds' => (int) env('CUSTOMER_PORTAL_OTP_EXPIRES', 120),
        'resend_after_seconds' => (int) env('CUSTOMER_PORTAL_OTP_RESEND_AFTER', 45),
        'max_attempts' => (int) env('CUSTOMER_PORTAL_OTP_MAX_ATTEMPTS', 5),
        'max_requests' => (int) env('CUSTOMER_PORTAL_OTP_MAX_REQUESTS', 5),
        'request_decay_seconds' => (int) env('CUSTOMER_PORTAL_OTP_REQUEST_DECAY', 600),

        // Temporary delivery channel requested for the first portal release.
        'preview' => filter_var(env('CUSTOMER_PORTAL_PREVIEW_OTP', true), FILTER_VALIDATE_BOOL),
    ],

    'support_phone' => env('CUSTOMER_PORTAL_SUPPORT_PHONE', '۰۲۱-۹۱۰۹۹۹۹۹'),
    'support_hours' => env('CUSTOMER_PORTAL_SUPPORT_HOURS', 'شنبه تا چهارشنبه، ۸:۳۰ تا ۱۷'),
];
