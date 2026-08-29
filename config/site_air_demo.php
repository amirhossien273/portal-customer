<?php

return [
    // Demo-only data source. Presentation components read this structure so it can
    // later be replaced with Air Operations API resources without rewriting the UI.
    'shipment' => [
        'reference' => 'AF-2026-0084',
        'origin' => ['code' => 'PVG', 'city' => 'Shanghai', 'role' => 'Origin Airport'],
        'transit' => ['code' => 'DXB', 'city' => 'Dubai', 'role' => 'Transit Airport'],
        'destination' => ['code' => 'IKA', 'city' => 'Tehran', 'role' => 'Destination Airport'],
        'mawb' => '176-12345675',
        'hawb' => 'SPN-2408064',
        'pieces' => 3,
        'gross_weight' => '90 kg',
        'volumetric_weight' => '120 kg',
        'chargeable_weight' => '120 kg',
        'status' => 'In Transit',
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
        'scheduled' => 'Scheduled',
        'confirmed' => 'Confirmed',
        'departed' => 'Departed',
        'arrived' => 'Arrived',
        'delayed' => 'Delayed',
        'cancelled' => 'Cancelled',
        'connection' => 'Connection',
        'completed' => 'Completed',
    ],

    'segments' => [
        [
            'number' => '01',
            'origin' => ['code' => 'PVG', 'city' => 'Shanghai'],
            'destination' => ['code' => 'DXB', 'city' => 'Dubai'],
            'flight' => 'EK303',
            'airline' => 'Emirates',
            'date' => '29 Aug 2026',
            'planned_etd' => '23:00',
            'updated_etd' => null,
            'planned_eta' => '04:40',
            'updated_eta' => null,
            'status' => 'Arrived',
            'status_key' => 'arrived',
        ],
        [
            'number' => '02',
            'origin' => ['code' => 'DXB', 'city' => 'Dubai'],
            'destination' => ['code' => 'IKA', 'city' => 'Tehran'],
            'flight' => 'EK971',
            'airline' => 'Emirates',
            'date' => '30 Aug 2026',
            'planned_etd' => '07:45',
            'updated_etd' => '09:10',
            'planned_eta' => '09:30',
            'updated_eta' => '10:55',
            'delay' => '+1h 25m',
            'status' => 'Delayed',
            'status_key' => 'delayed',
        ],
    ],

    'transshipment' => [
        'airport' => 'DXB',
        'city' => 'Dubai',
        'inbound_flight' => 'EK303',
        'outbound_flight' => 'EK971',
        'planned_connection_time' => '3h 05m',
        'updated_connection_time' => '4h 30m',
        'status' => 'Connection Confirmed',
        'status_key' => 'connection',
    ],

    'documents' => [
        'mawb' => ['number' => '176-12345675', 'airline_prefix' => '176', 'status' => 'Confirmed'],
        'hawbs' => [
            ['number' => 'SPN-001', 'pieces' => 1, 'status' => 'Ready'],
            ['number' => 'SPN-002', 'pieces' => 1, 'status' => 'Ready'],
            ['number' => 'SPN-003', 'pieces' => 1, 'status' => 'Ready'],
        ],
    ],

    'uld' => [
        'type' => 'PMC',
        'number' => 'PMC12345EK',
        'pieces' => 14,
        'gross_weight' => '1,850 kg',
        'flight' => 'EK303',
        'status' => 'Loaded',
        'status_key' => 'completed',
    ],

    'milestones' => [
        ['label' => 'Cargo Received', 'airport' => 'PVG', 'time' => '29 Aug · 21:10', 'status' => 'Completed', 'tone' => 'completed'],
        ['label' => 'Flight Departed', 'airport' => 'PVG', 'time' => '29 Aug · 23:00', 'status' => 'Departed', 'tone' => 'departed'],
        ['label' => 'Arrived at Hub', 'airport' => 'DXB', 'time' => '30 Aug · 04:40', 'status' => 'Arrived', 'tone' => 'arrived'],
        ['label' => 'Transshipment', 'airport' => 'DXB', 'time' => '30 Aug · 05:20', 'status' => 'Connection Confirmed', 'tone' => 'connection'],
        ['label' => 'Updated Departure', 'airport' => 'DXB', 'time' => '30 Aug · 09:10', 'status' => 'Delayed +1h 25m', 'tone' => 'delayed'],
        ['label' => 'Destination ETA', 'airport' => 'IKA', 'time' => '30 Aug · 10:55', 'status' => 'Scheduled', 'tone' => 'scheduled'],
    ],
];
