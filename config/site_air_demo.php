<?php

return [
    // Demo-only data source. Presentation components read this structure so it can
    // later be replaced with Air Operations API resources without rewriting the UI.
    'shipment' => [
        'reference' => 'AF-2026-0084',
        'origin' => ['code' => 'PVG', 'city' => 'شانگهای', 'role' => 'فرودگاه مبدأ'],
        'transit' => ['code' => 'DXB', 'city' => 'دبی', 'role' => 'فرودگاه ترانزیت'],
        'destination' => ['code' => 'IKA', 'city' => 'تهران', 'role' => 'فرودگاه مقصد'],
        'mawb' => '176-12345675',
        'hawb' => 'SPN-2408064',
        'pieces' => 3,
        'gross_weight' => '90 kg',
        'volumetric_weight' => '120 kg',
        'chargeable_weight' => '120 kg',
        'status' => 'در حال حمل',
        'status_tone' => 'transit',
    ],

    'weight' => [
        'cartons' => 3,
        'dimensions' => ['length' => 80, 'width' => 60, 'height' => 50, 'unit' => 'cm'],
        'actual_weight' => 90,
        'volumetric_weight' => 120,
        'chargeable_weight' => 120,
        'weight_unit' => 'kg',
        'divisor' => 6000,
        'available_divisors' => [6000, 5000],
        'divisor_mode' => 'configurable',
        'rating_basis' => 'Chargeable Weight',
    ],

    'status_labels' => [
        'scheduled' => 'برنامه‌ریزی‌شده',
        'confirmed' => 'تأییدشده',
        'departed' => 'حرکت‌کرده',
        'arrived' => 'رسیده',
        'delayed' => 'با تأخیر',
        'cancelled' => 'لغوشده',
        'connection' => 'اتصال',
        'completed' => 'تکمیل‌شده',
    ],

    'segments' => [
        [
            'number' => '01',
            'origin' => ['code' => 'PVG', 'city' => 'شانگهای'],
            'destination' => ['code' => 'DXB', 'city' => 'دبی'],
            'flight' => 'EK303',
            'airline' => 'Emirates',
            'departure_date' => '29 Aug 2026',
            'arrival_date' => '30 Aug 2026',
            'planned_etd' => '23:00',
            'updated_etd' => null,
            'planned_eta' => '04:40',
            'updated_eta' => null,
            'status' => 'رسیده',
            'status_key' => 'arrived',
        ],
        [
            'number' => '02',
            'origin' => ['code' => 'DXB', 'city' => 'دبی'],
            'destination' => ['code' => 'IKA', 'city' => 'تهران'],
            'flight' => 'EK971',
            'airline' => 'Emirates',
            'departure_date' => '30 Aug 2026',
            'arrival_date' => '30 Aug 2026',
            'planned_etd' => '07:45',
            'updated_etd' => '09:10',
            'planned_eta' => '09:30',
            'updated_eta' => '10:55',
            'delay' => '+1h 25m',
            'status' => 'با تأخیر',
            'status_key' => 'delayed',
        ],
    ],

    'transshipment' => [
        'airport' => 'DXB',
        'city' => 'دبی',
        'inbound_flight' => 'EK303',
        'outbound_flight' => 'EK971',
        'planned_connection_time' => '3h 05m',
        'updated_connection_time' => '4h 30m',
        'status' => 'اتصال تأییدشده',
        'status_key' => 'connection',
    ],

    'documents' => [
        'mawb' => ['number' => '176-12345675', 'airline_prefix' => '176', 'status' => 'تأییدشده'],
        'hawbs' => [
            ['number' => 'SPN-001', 'pieces' => 1, 'status' => 'آماده'],
            ['number' => 'SPN-002', 'pieces' => 1, 'status' => 'آماده'],
            ['number' => 'SPN-003', 'pieces' => 1, 'status' => 'آماده'],
        ],
    ],

    'uld' => [
        'type' => 'PMC',
        'number' => 'PMC12345EK',
        'pieces' => 14,
        'gross_weight' => '1,850 kg',
        'flight' => 'EK303',
        'status' => 'بارگیری‌شده',
        'status_key' => 'completed',
    ],

    'milestones' => [
        ['label' => 'دریافت محموله', 'airport' => 'PVG', 'time' => '29 Aug · 21:10', 'status' => 'تکمیل‌شده', 'tone' => 'completed'],
        ['label' => 'حرکت پرواز', 'airport' => 'PVG', 'time' => '29 Aug · 23:00', 'status' => 'حرکت‌کرده', 'tone' => 'departed'],
        ['label' => 'ورود به فرودگاه ترانزیت', 'airport' => 'DXB', 'time' => '30 Aug · 04:40', 'status' => 'رسیده', 'tone' => 'arrived'],
        ['label' => 'ترانشیپمنت', 'airport' => 'DXB', 'time' => '30 Aug · 05:20', 'status' => 'اتصال تأییدشده', 'tone' => 'connection'],
        ['label' => 'زمان حرکت به‌روزشده', 'airport' => 'DXB', 'time' => '30 Aug · 09:10', 'status' => 'تأخیر +1h 25m', 'tone' => 'delayed'],
        ['label' => 'ETA مقصد', 'airport' => 'IKA', 'time' => '30 Aug · 10:55', 'status' => 'برنامه‌ریزی‌شده', 'tone' => 'scheduled'],
    ],
];
