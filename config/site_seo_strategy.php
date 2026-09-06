<?php

return [
    'updated_at' => '2026-09-06',

    /*
     * Consolidated URLs must not remain in any indexable collection. These
     * mappings are registered before the generic module/solution routes.
     */
    'redirects' => [
        '/modules/operational-control-center' => '/solutions/operation-exception-management',
        '/modules/enterprise-command-center' => '/solutions/transport-governance',
        '/modules/document-checklists' => '/solutions/document-readiness',
        '/solutions/container-nvocc' => '/solutions/container-management',
    ],

    /*
     * One primary query per indexable URL. This registry is deliberately
     * explicit so a future page cannot silently take ownership of an existing
     * money query.
     */
    'clusters' => [
        'operations' => [
            'priority' => 'P0',
            'pillar' => '/modules/transport-operations',
            'pages' => [
                '/modules/transport-operations' => ['query' => 'نرم افزار مدیریت عملیات حمل و نقل', 'intent' => 'پرونده و اجرای انتهابه‌انتهای عملیات حمل', 'audience' => 'مدیر و کارشناس عملیات', 'outcome' => 'پرونده عملیاتی واحد'],
                '/modules/operations-control-tower' => ['query' => 'برج کنترل عملیات حمل', 'intent' => 'پایش لحظه‌ای، اولویت‌بندی و تصمیم شیفت', 'audience' => 'سرپرست شیفت و مدیر عملیات', 'outcome' => 'صف پایش و تصمیم'],
                '/solutions/operations-automation' => ['query' => 'اتوماسیون عملیات حمل و نقل', 'intent' => 'قواعد چندمرحله‌ای، Trigger، Escalation و اقدام', 'audience' => 'مالک فرایند و مدیر عملیات', 'outcome' => 'Rule تا اقدام'],
                '/solutions/shipment-visibility' => ['query' => 'دیدپذیری وضعیت محموله', 'intent' => 'وضعیت، Milestone و تازگی داده در نمای داخلی', 'audience' => 'تیم داخلی عملیات', 'outcome' => 'وضعیت معتبر محموله'],
                '/solutions/operation-exception-management' => ['query' => 'مدیریت استثناهای عملیات حمل', 'intent' => 'رسیدگی، مالکیت و بستن Exception', 'audience' => 'کارشناس رسیدگی و سرپرست عملیات', 'outcome' => 'Exception حل‌شده و قابل ممیزی'],
                '/solutions/transport-governance' => ['query' => 'حاکمیت عملیاتی شرکت حمل و نقل', 'intent' => 'سیاست، اختیار و تصمیم بین‌واحدی', 'audience' => 'مدیر ارشد و مالک سیاست', 'outcome' => 'تصمیم سازمانی قابل ممیزی'],
            ],
        ],
        'documents' => [
            'priority' => 'P0',
            'pillar' => '/modules/document-management',
            'pages' => [
                '/modules/document-management' => ['query' => 'نرم افزار مدیریت اسناد حمل و نقل', 'intent' => 'قابلیت محصول برای مدیریت، نسخه و آرشیو سند', 'audience' => 'تیم اسناد و عملیات', 'outcome' => 'مرجع واحد اسناد'],
                '/solutions/document-management' => ['query' => 'گردش تایید اسناد حمل', 'intent' => 'چرخه عمر، Approval و کنترل نسخه', 'audience' => 'مالک فرایند سند', 'outcome' => 'تأیید کنترل‌شده سند'],
                '/solutions/document-readiness' => ['query' => 'آمادگی اسناد حمل', 'intent' => 'چک‌لیست و معیار عبور پرونده کامل', 'audience' => 'کارشناس کنترل مدارک', 'outcome' => 'پرونده آماده مرحله بعد'],
                '/solutions/bill-of-lading-management' => ['query' => 'نرم افزار مدیریت بارنامه HBL و MBL', 'intent' => 'پیش‌نویس، اصلاح، تأیید و آرشیو بارنامه', 'audience' => 'تیم اسناد دریایی', 'outcome' => 'بارنامه نهایی بدون نسخه مبهم'],
            ],
        ],
        'container_nvocc' => [
            'priority' => 'P0',
            'pillar' => '/solutions/nvocc',
            'pages' => [
                '/solutions/nvocc' => ['query' => 'نرم افزار NVOCC', 'intent' => 'مدل کسب‌وکار NVOCC از Booking تا مالی', 'audience' => 'شرکت NVOCC و نماینده خط', 'outcome' => 'پرونده یکپارچه NVOCC'],
                '/solutions/container-management' => ['query' => 'نرم افزار مدیریت کانتینر', 'intent' => 'Container Master، Depot، Lease و Utilization', 'audience' => 'مدیر تجهیزات و دپو', 'outcome' => 'چرخه قابل ردیابی کانتینر'],
                '/transport-modes/sea' => ['query' => 'نرم افزار حمل دریایی', 'intent' => 'فرایند تخصصی روش حمل دریایی', 'audience' => 'تیم عملیات دریایی', 'outcome' => 'اجرای پرونده دریایی'],
            ],
        ],
        'fleet' => [
            'priority' => 'P1',
            'pillar' => '/solutions/fleet-management',
            'pages' => [
                '/solutions/fleet-management' => ['query' => 'نرم افزار مدیریت ناوگان حمل و نقل', 'intent' => 'دارایی، راننده، نگهداری، Compliance و Availability', 'audience' => 'مدیر ناوگان', 'outcome' => 'منبع آماده و منطبق'],
                '/modules/fleet-dispatch' => ['query' => 'دیسپچ اجرایی ناوگان', 'intent' => 'تخصیص نهایی و کنترل اجرای مأموریت جاری', 'audience' => 'دیسپچر شیفت', 'outcome' => 'مأموریت تخصیص‌یافته و قابل کنترل'],
                '/solutions/fleet-dispatch-planning' => ['query' => 'برنامه ریزی اعزام ناوگان', 'intent' => 'برنامه‌ریزی پیش از اجرا برای ظرفیت، بازه و Assignment', 'audience' => 'برنامه‌ریز ظرفیت', 'outcome' => 'برنامه بدون تداخل پیش از اعزام'],
            ],
        ],
        'finance' => [
            'priority' => 'P1',
            'pillar' => '/modules/finance-accounting',
            'pages' => [
                '/modules/finance-accounting' => ['query' => 'نرم افزار حسابداری حمل و نقل بین المللی', 'intent' => 'قابلیت محصول مالی و حسابداری چندارزی', 'audience' => 'کاربر و مدیر مالی', 'outcome' => 'ثبت مالی متصل به عملیات'],
                '/solutions/freight-finance' => ['query' => 'مدیریت مالی حمل و نقل', 'intent' => 'کنترل Accrual، Variance و Margin پرونده', 'audience' => 'مدیر مالی و کنترل مدیریت', 'outcome' => 'سود واقعی قابل اتکا'],
                '/solutions/payment-workflow' => ['query' => 'گردش کار درخواست پرداخت', 'intent' => 'درخواست، تأیید و اجرای پرداختنی', 'audience' => 'درخواست‌کننده، تأییدکننده و خزانه', 'outcome' => 'پرداخت تأییدشده با مرجع بانکی'],
                '/compare/best-transport-accounting-software' => ['query' => 'بهترین نرم افزار حسابداری حمل و نقل', 'intent' => 'مقایسه و انتخاب راهکار مالی', 'audience' => 'خریدار و مدیر مالی', 'outcome' => 'Shortlist و سناریوی دمو'],
            ],
        ],
        'crm_sales' => [
            'priority' => 'P1',
            'pillar' => '/modules/crm',
            'pages' => [
                '/modules/crm' => ['query' => 'نرم افزار CRM حمل و نقل', 'intent' => 'رابطه مشتری، Lead، Opportunity و Pipeline', 'audience' => 'مدیر فروش و کارشناس CRM', 'outcome' => 'رابطه و قیف فروش قابل پیگیری'],
                '/modules/pricing-sales' => ['query' => 'نرم افزار قیمت گذاری فروش حمل', 'intent' => 'فرایند محصول از Inquiry تا Quotation', 'audience' => 'کارشناس Pricing و فروش', 'outcome' => 'پیشنهاد معتبر و قابل ارسال'],
                '/solutions/rate-management' => ['query' => 'مدیریت نرخ و تعرفه حمل و نقل', 'intent' => 'Rate Repository، اعتبار و منطق محاسبه', 'audience' => 'مالک Rate Master', 'outcome' => 'نرخ معتبر و قابل استفاده مجدد'],
                '/solutions/freight-sales-automation' => ['query' => 'اتوماسیون پیگیری فروش حمل و نقل', 'intent' => 'Follow-up رویدادمحور، SLA و Handoff', 'audience' => 'مدیر فروش و RevOps', 'outcome' => 'فرصت بدون اقدام کمتر'],
                '/compare/best-crm-for-transport-companies' => ['query' => 'بهترین CRM برای شرکت حمل و نقل', 'intent' => 'مقایسه و انتخاب CRM', 'audience' => 'خریدار و مدیر فروش', 'outcome' => 'Shortlist و چک‌لیست خرید'],
            ],
        ],
        'visibility_portal' => [
            'priority' => 'P1',
            'pillar' => '/modules/customer-portal-tracking',
            'pages' => [
                '/modules/customer-portal-tracking' => ['query' => 'پرتال مشتریان حمل و نقل', 'intent' => 'سلف‌سرویس بیرونی پس از OTP', 'audience' => 'مشتری نهایی شرکت حمل', 'outcome' => 'رهگیری و صورتحساب بدون تماس'],
                '/solutions/shipment-visibility' => ['query' => 'دیدپذیری وضعیت محموله', 'intent' => 'Milestone و وضعیت داخلی', 'audience' => 'تیم داخلی عملیات', 'outcome' => 'وضعیت معتبر برای اقدام'],
                '/modules/operations-control-tower' => ['query' => 'برج کنترل عملیات حمل', 'intent' => 'پایش و تصمیم شیفت', 'audience' => 'سرپرست شیفت عملیات', 'outcome' => 'اولویت‌بندی پرونده‌های نیازمند توجه'],
            ],
        ],
        'automation' => [
            'priority' => 'P1',
            'pillar' => '/modules/workflow-tasks',
            'pages' => [
                '/modules/workflow-tasks' => ['query' => 'مدیریت گردش کار و وظایف حمل و نقل', 'intent' => 'فرایند و Task انسانی', 'audience' => 'مدیر تیم و کاربران مسئول اقدام', 'outcome' => 'وظیفه انسانی با مالک و مهلت'],
                '/modules/automatic-tasks' => ['query' => 'ساخت خودکار تسک CRM', 'intent' => 'یک Trigger رویدادی برای ساخت Task', 'audience' => 'مدیر فروش و CRM', 'outcome' => 'پیگیری خودکار رویداد فروش'],
                '/solutions/operations-automation' => ['query' => 'اتوماسیون عملیات حمل و نقل', 'intent' => 'Rule چندمرحله‌ای تا Exception و Escalation', 'audience' => 'مالک فرایند عملیات', 'outcome' => 'کنترل عملیاتی خودکار'],
            ],
        ],
        'compare' => [
            'priority' => 'P1',
            'pillar' => '/compare',
            'pages' => [
                '/compare' => ['query' => 'مرکز مقایسه نرم افزار حمل و نقل', 'intent' => 'هاب و مسیریابی بین مقایسه‌ها', 'audience' => 'بازدیدکننده در مرحله بررسی', 'outcome' => 'انتخاب صفحه مقایسه مناسب'],
                '/compare/sepand-vs-other-transport-software' => ['query' => 'مقایسه انواع نرم افزار حمل و نقل', 'intent' => 'مقایسه دسته‌ها و معماری‌های نرم‌افزار', 'audience' => 'تیم ارزیابی راهکار', 'outcome' => 'شناخت Trade-off دسته‌ها'],
                '/compare/best-transport-software' => ['query' => 'بهترین نرم افزار حمل و نقل بین المللی', 'intent' => 'چارچوب انتخاب عمومی', 'audience' => 'کمیته خرید نرم‌افزار', 'outcome' => 'امتیازدهی و Shortlist'],
                '/compare/best-freight-forwarding-software' => ['query' => 'بهترین نرم افزار فورواردری', 'intent' => 'چارچوب انتخاب تخصصی Freight Forwarder', 'audience' => 'مدیر شرکت فورواردری', 'outcome' => 'Shortlist عمودی و سناریوی دمو'],
            ],
        ],
    ],
];
