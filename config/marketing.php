<?php

$marketing = [
    'site_url' => rtrim(env('MARKETING_SITE_URL', 'https://sepandcrm.ir'), '/'),
    'content_last_modified' => '2026-09-06',
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
            'مقایسه انواع نرم افزار حمل و نقل',
            'تفاوت TMS و CRM و حسابداری حمل',
            'مقایسه سیستم یکپارچه و نرم افزار جزیره ای حمل',
        ],
        'compare_index' => [
            'مرکز مقایسه نرم افزار حمل و نقل',
            'صفحات مقایسه نرم افزارهای حمل و نقل',
        ],
        'sepand_vs_royan' => [
            'مقایسه سپند و رویان',
            'نرم افزار سپند یا رویان',
        ],
        'sepand_vs_saba' => [
            'مقایسه سپند و سبا سیستم',
            'نرم افزار سپند یا سبا',
        ],
        'best_transport_software' => [
            'بهترین نرم افزار حمل و نقل بین المللی',
            'انتخاب نرم افزار حمل و نقل بین المللی',
        ],
        'best_freight_forwarding_software' => [
            'بهترین نرم افزار فورواردری',
            'نرم افزار شرکت فورواردری',
            'انتخاب نرم افزار فورواردری',
        ],
        'best_crm_for_transport_companies' => [
            'بهترین CRM برای شرکت حمل و نقل',
            'انتخاب CRM حمل و نقل',
            'مقایسه CRM های حمل و نقل',
        ],
        'best_transport_accounting_software' => [
            'بهترین نرم افزار حسابداری حمل و نقل',
            'انتخاب حسابداری فورواردری',
            'مقایسه نرم افزار حسابداری حمل و نقل',
        ],
        'solution_nvocc' => ['نرم افزار NVOCC', 'نرم افزار مدیریت NVOCC'],
        'solution_container_management' => ['نرم افزار مدیریت کانتینر', 'مدیریت کانتینر حمل دریایی'],
        'solution_on_premise' => ['نرم افزار حمل و نقل On-Premise', 'استقرار داخلی نرم افزار حمل و نقل'],
        'solution_bill_of_lading' => ['نرم افزار مدیریت بارنامه', 'مدیریت HBL و MBL'],
        'solution_freight_sales_automation' => ['اتوماسیون فروش شرکت حمل و نقل', 'اتوماسیون فروش فورواردری'],
        'pricing' => [
            'قیمت نرم افزار حمل و نقل بین المللی',
        ],
        'consultation' => [
            'درخواست دمو نرم افزار حمل و نقل',
            'مشاوره خرید نرم افزار حمل و نقل',
            'دمو نرم افزار حمل و نقل بین المللی',
            'درخواست دمو نرم افزار فورواردری',
            'مشاوره نرم افزار حمل و نقل بین المللی',
            'خرید نرم افزار حمل و نقل',
            'دموی نرم افزار CRM حمل و نقل',
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

$operational = require __DIR__.'/site_operational_solutions.php';
$marketing['page_keywords'] = array_merge($marketing['page_keywords'], $operational['keywords']);

return $marketing;
