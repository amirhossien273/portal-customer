<?php

return [
    'site_url' => rtrim(env('MARKETING_SITE_URL', 'https://sepandcrm.ir'), '/'),
    'content_last_modified' => '2026-08-11',
    'page_keywords' => [
        'home' => [
            'نرم افزار مدیریت حمل و نقل بین المللی',
            'نرم افزار حمل و نقل بین المللی',
            'نرم افزار فورواردری',
            'نرم افزار مدیریت شرکت فورواردری',
            'سامانه جامع حمل و نقل بین المللی',
            'نرم افزار لجستیک',
            'نرم افزار مدیریت شرکت لجستیک',
            'نرم افزار شرکت های حمل و نقل',
        ],
        'modules' => [
            'ماژول های نرم افزار حمل و نقل',
            'اجزای سیستم مدیریت حمل و نقل',
        ],
        'sepand_vs_other_transport_software' => [
            'مقایسه نرم افزارهای حمل و نقل',
            'نرم افزار سپند یا نرم افزارهای دیگر',
            'مقایسه نرم افزار فورواردری',
            'بهترین نرم افزار مدیریت حمل و نقل',
            'انتخاب نرم افزار فورواردری',
        ],
        'pricing' => [
            'قیمت نرم افزار حمل و نقل بین المللی',
        ],
        'consultation' => [
            'خرید نرم افزار حمل و نقل',
        ],
    ],
    'page_keyword_opportunities' => [
        'modules' => [
            [
                'keyword' => 'ERP حمل و نقل',
                'status' => 'intent_mismatch',
                'automatic_targeting' => false,
                'reason' => 'Intent این عبارت معمولاً ERP عمومی است؛ صفحه Modules صرفاً اجزای تخصصی سپند و یکپارچگی آن‌ها را معرفی می‌کند.',
            ],
        ],
    ],
    'planned_pages' => [
        'tms_transportation_management_system' => [
            'url' => '/guides/tms-transportation-management-system',
            'status' => 'planned_not_created',
            'primary_keyword' => 'سیستم TMS حمل و نقل',
        ],
    ],
];
