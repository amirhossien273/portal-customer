<?php

return [
    // Demo-only source. Road UI components read this structure so the same
    // presentation can later consume production Operations and Finance APIs.
    'shipment' => [
        'reference' => 'RD-2026-0148',
        'origin' => ['city' => 'Istanbul', 'country' => 'Turkey'],
        'border' => ['outbound' => 'Gürbulak', 'inbound' => 'Bazargan'],
        'destination' => ['city' => 'Tehran', 'country' => 'Iran'],
        'cargo' => 'Industrial Parts',
        'quantity' => '12 pallets',
        'gross_weight' => '18,400 kg',
        'required_vehicle' => 'Curtain-side Trailer',
        'planned_pickup' => '29 Aug 2026 · 08:30',
        'status' => 'در مسیر',
        'status_tone' => 'transit',
    ],

    'journey' => [
        ['number' => '01', 'title' => 'ایجاد پرونده حمل', 'text' => 'مبدأ، مقصد، محموله، وزن، تعداد، خودروی موردنیاز و زمان برنامه‌ریزی‌شده بارگیری ثبت می‌شوند.', 'scope' => 'context'],
        ['number' => '02', 'title' => 'تخصیص کامیون', 'text' => 'کشنده و تریلر با پلاک، نوع، ظرفیت، نوع ناوگان و وضعیت مستقل به سفر متصل می‌شوند.', 'scope' => 'priority'],
        ['number' => '03', 'title' => 'تخصیص راننده', 'text' => 'راننده، مدارک، شماره تماس نمونه، وضعیت و خودروی تخصیص‌یافته در همان سفر قرار می‌گیرند.', 'scope' => 'priority'],
        ['number' => '04', 'title' => 'بارگیری و شروع سفر', 'text' => 'بارگیری، تحویل‌گیری، حرکت و شروع مسیر به خط زمانی سفر اضافه می‌شوند.', 'scope' => 'core'],
        ['number' => '05', 'title' => 'ورود به مرز', 'text' => 'زمان ورود، وضعیت صف، زمان انتظار و وضعیت بررسی گمرکی به‌عنوان نقطه عطف مستقل ثبت می‌شوند.', 'scope' => 'priority'],
        ['number' => '06', 'title' => 'رویدادهای مرزی و گمرکی', 'text' => 'کنترل اسناد، بازرسی، انتظار، ترخیص و خروج از مرز با زمان و وضعیت جداگانه باقی می‌مانند.', 'scope' => 'exception'],
        ['number' => '07', 'title' => 'ادامه مسیر پس از مرز', 'text' => 'مسیر، ETA، وضعیت راننده و وضعیت خودرو پس از عبور به‌روزرسانی می‌شوند.', 'scope' => 'core'],
        ['number' => '08', 'title' => 'تحویل و POD', 'text' => 'ورود به مقصد، تخلیه، تأیید گیرنده و تأیید تحویل (POD) به همان سفر متصل می‌شوند.', 'scope' => 'priority'],
        ['number' => '09', 'title' => 'هزینه و تسویه سفر', 'text' => 'هزینه راننده، سوخت، عوارض، مرز، انتظار و سایر هزینه‌ها وارد پرونده مالی همان حمل می‌شوند.', 'scope' => 'priority'],
    ],

    'vehicle' => [
        'tractor_plate' => '34 ABC 789',
        'trailer_plate' => 'TR 45821',
        'type' => 'Curtain-side Trailer',
        'capacity' => '24 t',
        'fleet_type' => 'پیمانکاری',
        'status' => 'تخصیص‌یافته',
        'status_tone' => 'assigned',
    ],

    'driver' => [
        'name' => 'Mehmet Kaya',
        'mobile' => '+90 555 000 0148',
        'driver_id' => 'DRV-10458',
        'license' => 'TR-LIC-8452',
        'passport' => 'Demo Passport',
        'assigned_vehicle' => '34 ABC 789',
        'status' => 'در مسیر',
        'status_tone' => 'transit',
    ],

    'route' => [
        ['place' => 'Istanbul', 'role' => 'مبدأ', 'tone' => 'complete', 'events' => [['label' => 'بارگیری', 'time' => '29 Aug · 08:30'], ['label' => 'حرکت', 'time' => '29 Aug · 10:00']]],
        ['place' => 'Ankara', 'role' => 'توقف برنامه‌ریزی‌شده', 'tone' => 'complete', 'events' => [['label' => 'توقف', 'time' => '29 Aug · 17:40'], ['label' => 'حرکت', 'time' => '29 Aug · 18:20']]],
        ['place' => 'Gürbulak', 'role' => 'ورود به مرز', 'tone' => 'border', 'events' => [['label' => 'ورود واقعی', 'time' => '30 Aug · 06:30']]],
        ['place' => 'Bazargan', 'role' => 'خروج از مرز', 'tone' => 'border', 'events' => [['label' => 'عبور', 'time' => '30 Aug · 14:45']]],
        ['place' => 'Tehran', 'role' => 'مقصد', 'tone' => 'pending', 'events' => [['label' => 'ETA به‌روزشده', 'time' => '30 Aug · 22:30']]],
    ],

    'border' => [
        'name' => 'Gürbulak / Bazargan',
        'planned_arrival' => '30 Aug · 05:30',
        'actual_arrival' => '30 Aug · 06:30',
        'waiting_started' => '30 Aug · 06:40',
        'waiting_ended' => '30 Aug · 14:45',
        'waiting_time' => '8h 05m',
        'border_dwell_time' => '8h 15m',
        'queue_status' => 'عبور کرده',
        'customs_status' => 'ترخیص‌شده',
        'planned_exit' => '30 Aug · 11:30',
        'actual_exit' => '30 Aug · 14:45',
        'delay' => '+3h 15m',
        'delay_reason' => 'Customs Inspection',
        'original_eta' => '30 Aug · 19:15',
        'updated_eta' => '30 Aug · 22:30',
    ],

    'border_events' => [
        ['label' => 'ورود به مرز', 'value' => '06:30', 'detail' => 'یک ساعت بعد از برنامه', 'status' => 'با تأخیر', 'tone' => 'delayed'],
        ['label' => 'شروع انتظار', 'value' => '06:40', 'detail' => 'ورود به صف مرزی', 'status' => 'در انتظار', 'tone' => 'waiting'],
        ['label' => 'کنترل اسناد', 'value' => '08:15', 'detail' => 'اسناد بررسی شدند', 'status' => 'تأییدشده', 'tone' => 'confirmed'],
        ['label' => 'کنترل گمرکی', 'value' => '09:20', 'detail' => 'بازرسی آغاز شد', 'status' => 'در حال بررسی', 'tone' => 'inspection'],
        ['label' => 'ترخیص', 'value' => '13:50', 'detail' => 'مجوز خروج ثبت شد', 'status' => 'تأییدشده', 'tone' => 'confirmed'],
        ['label' => 'خروج از مرز', 'value' => '14:45', 'detail' => 'ورود به کشور مقصد', 'status' => 'عبور کرده', 'tone' => 'crossed'],
        ['label' => 'ادامه سفر', 'value' => '15:05', 'detail' => 'حرکت به‌سمت تهران', 'status' => 'در مسیر', 'tone' => 'transit'],
    ],

    'status_labels' => [
        'scheduled' => 'برنامه‌ریزی‌شده',
        'waiting' => 'در انتظار',
        'inspection' => 'در حال بررسی',
        'confirmed' => 'تأییدشده',
        'delayed' => 'با تأخیر',
        'crossed' => 'عبور کرده',
        'completed' => 'تکمیل‌شده',
    ],

    'exceptions' => [
        ['title' => 'تأخیر مرزی', 'detail' => '+3h 15m · Customs Inspection', 'tone' => 'danger'],
        ['title' => 'نگهداشت اسناد', 'detail' => 'ساختار آماده ثبت Document Hold', 'tone' => 'warning'],
        ['title' => 'تغییر مسیر', 'detail' => 'ساختار آماده ثبت Route Change', 'tone' => 'change'],
        ['title' => 'تأخیر تحویل', 'detail' => 'ساختار آماده ثبت Delivery Delay', 'tone' => 'warning'],
    ],

    'driver_change' => [
        ['label' => 'راننده A', 'value' => 'Mehmet Kaya', 'tone' => 'normal'],
        ['label' => 'رویداد استراحت', 'value' => 'Bazargan · 15:00', 'tone' => 'warning'],
        ['label' => 'تغییر راننده', 'value' => 'تاریخچه تغییر حفظ می‌شود', 'tone' => 'change'],
        ['label' => 'راننده B', 'value' => 'Ali Demir · Demo', 'tone' => 'success'],
        ['label' => 'ادامه سفر', 'value' => 'به‌سمت تهران', 'tone' => 'transit'],
    ],

    'vehicle_change' => [
        ['label' => 'خودرو 01', 'value' => '34 ABC 789', 'tone' => 'normal'],
        ['label' => 'رویداد عملیاتی', 'value' => 'Vehicle Check', 'tone' => 'warning'],
        ['label' => 'تغییر خودرو', 'value' => 'تاریخچه تغییر حفظ می‌شود', 'tone' => 'change'],
        ['label' => 'خودرو 02', 'value' => 'Demo Replacement', 'tone' => 'success'],
        ['label' => 'ادامه مسیر', 'value' => 'در همان Trip', 'tone' => 'transit'],
    ],

    'pod' => [
        'shipment' => 'RD-2026-0148',
        'destination' => 'Tehran',
        'delivered_at' => '30 Aug 2026 · 22:12',
        'received_by' => 'Demo Consignee',
        'delivery_status' => 'تحویل‌شده',
        'pod_status' => 'POD بارگذاری‌شده',
        'document_type' => 'Signed Delivery Receipt',
        'file_name' => 'POD-2026-0148.pdf',
        'uploaded_at' => '30 Aug 2026 · 22:25',
    ],

    'costs' => [
        'currency' => 'USD',
        'items' => [
            ['key' => 'driver', 'label' => 'کرایه راننده', 'amount' => 1850],
            ['key' => 'fuel', 'label' => 'سوخت', 'amount' => 620],
            ['key' => 'toll', 'label' => 'عوارض جاده‌ای', 'amount' => 145],
            ['key' => 'border', 'label' => 'هزینه مرزی', 'amount' => 210],
            ['key' => 'waiting', 'label' => 'پارکینگ / انتظار', 'amount' => 95],
            ['key' => 'other', 'label' => 'سایر هزینه‌ها', 'amount' => 80],
        ],
        'total' => 3000,
        'customer_revenue' => 4250,
        'gross_margin' => 1250,
        'available_categories' => ['Driver Cost', 'Fuel', 'Toll', 'Border Charge', 'Customs-related Operational Charge', 'Parking', 'Waiting Cost', 'Maintenance / Emergency', 'Other Cost'],
    ],

    'cost_route' => [
        ['place' => 'Istanbul', 'items' => [['label' => 'سوخت', 'amount' => '620 USD']]],
        ['place' => 'Ankara', 'items' => [['label' => 'عوارض', 'amount' => '70 USD']]],
        ['place' => 'Border', 'items' => [['label' => 'هزینه مرزی', 'amount' => '210 USD'], ['label' => 'هزینه انتظار', 'amount' => '95 USD']]],
        ['place' => 'Tehran', 'items' => [['label' => 'عوارض نهایی', 'amount' => '75 USD'], ['label' => 'کرایه راننده و سایر', 'amount' => '1,930 USD']]],
    ],
];
