<?php

declare(strict_types=1);

$target = static fn (
    string $path,
    string $route,
    array $parameters,
    string $context,
    array $anchors,
): array => compact('path', 'route', 'parameters', 'context', 'anchors');

$module = static fn (string $slug, string $context, array $anchors): array => $target(
    '/modules/'.$slug,
    'site.modules.show',
    ['module' => $slug],
    $context,
    $anchors,
);

$mode = static fn (string $slug, string $context, array $anchors): array => $target(
    '/transport-modes/'.$slug,
    'site.transport-modes.show',
    ['mode' => $slug],
    $context,
    $anchors,
);

$platform = static fn (string $slug, string $context, array $anchors): array => $target(
    '/solutions/'.$slug,
    'solutions.platform.show',
    ['solution' => $slug],
    $context,
    $anchors,
);

$targets = [
    'home' => $target('/', 'home', [], 'شناخت نمای کلی سامانه و جایگاه هر فرایند', ['سامانه یکپارچه سپند', 'نرم‌افزار حمل‌ونقل سپند', 'نمای کلی محصول سپند', 'پلتفرم سپند برای فورواردری', 'راهکار یکپارچه مدیریت حمل', 'صفحه اصلی نرم‌افزار سپند', 'سامانه مدیریت شرکت‌های حمل']),
    'product' => $target('/product', 'product', [], 'دیدن ارتباط ماژول‌ها در معماری محصول', ['معرفی کامل محصول سپند', 'معماری یکپارچه نرم‌افزار', 'نمای عملی نرم‌افزار سپند', 'قابلیت‌های یکپارچه سپند', 'نقشه محصول سپند', 'معرفی نرم‌افزار مدیریت حمل', 'جریان کامل محصول سپند']),
    'why' => $target('/why-sepand', 'why-sepand', [], 'ارزیابی منطق انتخاب و تمایزهای محصول', ['چرا سپند', 'دلایل انتخاب سپند', 'ارزیابی تناسب سپند']),
    'faq' => $target('/faq', 'faq', [], 'پاسخ به پرسش‌های عمومی پیش از ارزیابی', ['پرسش‌های متداول سپند', 'پاسخ‌های پیش از خرید', 'راهنمای پرسش‌های نرم‌افزار']),
    'modules' => $target('/modules', 'modules', [], 'مرور دامنه تمام ماژول‌های اصلی', ['هاب ماژول‌های سپند', 'فهرست ماژول‌های نرم‌افزار', 'مرور ماژول‌های عملیاتی']),
    'solutions' => $target('/solutions', 'solutions.index', [], 'انتخاب مسیر بر اساس مسئله سازمان', ['هاب راهکارهای سپند', 'نقشه راهکارهای تخصصی', 'مرکز انتخاب راهکار']),
    'compare' => $target('/compare', 'compare.index', [], 'مقایسه گزینه‌ها با معیارهای یکسان', ['مرکز مقایسه نرم‌افزارها', 'هاب راهنماهای مقایسه', 'چارچوب‌های مقایسه نرم‌افزار']),
    'pricing' => $target('/pricing', 'pricing', [], 'بررسی مدل قیمت‌گذاری و دامنه استقرار', ['تعرفه نرم‌افزار سپند', 'مدل قیمت‌گذاری سپند', 'بررسی هزینه استقرار', 'هزینه و پلن‌های سپند']),
    'about' => $target('/about', 'about', [], 'آشنایی با تیم و نگاه محصول', ['درباره سپند', 'داستان شکل‌گیری سپند', 'تیم و رویکرد سپند']),
    'consultation' => $target('/consultation', 'consultation.create', [], 'اجرای سناریوی واقعی در جلسه ارزیابی', ['درخواست دمو و مشاوره', 'رزرو جلسه بررسی محصول', 'دموی سناریومحور سپند']),
    'case-study' => $target('/customers/case-studies/operational-control-snapshot', 'case-studies.show', ['caseStudy' => 'operational-control-snapshot'], 'دیدن نتیجه یک سناریوی عملیاتی واقعی', ['مطالعه موردی کنترل عملیات', 'نمونه واقعی استفاده از سپند', 'مطالعه موردی مشتری سپند']),

    'compare-royan' => $target('/compare/sepand-vs-royan', 'compare.sepand-vs-royan', [], 'مقایسه سپند و رویان بر اساس معیارهای عملیاتی', ['مقایسه سپند و رویان', 'راهنمای سپند در برابر رویان', 'ارزیابی سپند و رویان']),
    'compare-saba' => $target('/compare/sepand-vs-saba', 'compare.sepand-vs-saba', [], 'مقایسه سپند و سبا سیستم با معیارهای یکسان', ['مقایسه سپند و سبا سیستم', 'راهنمای سپند در برابر سبا', 'ارزیابی سپند و سبا سیستم']),
    'compare-other' => $target('/compare/sepand-vs-other-transport-software', 'compare.sepand-other-transport-software', [], 'شناخت دسته‌های مختلف نرم‌افزار حمل', ['مقایسه با سایر نرم‌افزارهای حمل', 'سپند در برابر راهکارهای دیگر', 'مقایسه دسته‌های نرم‌افزار حمل']),
    'best-transport' => $target('/compare/best-transport-software', 'compare.best-transport-software', [], 'انتخاب نرم‌افزار عمومی مدیریت حمل', ['راهنمای انتخاب نرم‌افزار حمل', 'بهترین نرم‌افزار مدیریت حمل', 'چارچوب انتخاب سامانه حمل']),
    'best-forwarding' => $target('/compare/best-freight-forwarding-software', 'compare.best-freight-forwarding-software', [], 'انتخاب سامانه متناسب با شرکت فورواردری', ['راهنمای انتخاب نرم‌افزار فورواردری', 'بهترین نرم‌افزار فورواردری', 'چارچوب ارزیابی سامانه فورواردری', 'چک‌لیست انتخاب سیستم فورواردری', 'ارزیابی نرم‌افزار Freight Forwarding', 'راهنمای خرید سامانه فورواردری']),
    'best-crm' => $target('/compare/best-crm-for-transport-companies', 'compare.best-crm-for-transport-companies', [], 'ارزیابی CRM تخصصی صنعت حمل', ['راهنمای انتخاب CRM حمل‌ونقل', 'بهترین CRM برای شرکت حمل', 'چک‌لیست CRM تخصصی فورواردری']),
    'best-accounting' => $target('/compare/best-transport-accounting-software', 'compare.best-transport-accounting-software', [], 'ارزیابی نرم‌افزار مالی متصل به عملیات حمل', ['راهنمای حسابداری حمل‌ونقل', 'بهترین نرم‌افزار حسابداری حمل', 'چک‌لیست سامانه مالی فورواردری']),

    'crm' => $module('crm', 'مدیریت رابطه، Lead و Follow-up مشتریان', ['CRM تخصصی فورواردری', 'مدیریت مشتریان شرکت حمل', 'مدیریت Lead و پیگیری فروش', 'سیستم CRM سپند', 'پرونده یکپارچه مشتری', 'CRM شرکت‌های لجستیکی', 'مدیریت فرصت فروش حمل']),
    'pricing-sales' => $module('pricing-sales', 'محاسبه نرخ و آماده‌سازی پیشنهاد فروش', ['مدیریت نرخ و Quotation', 'فرایند نرخ‌دهی و پیشنهاد حمل', 'قیمت‌گذاری و فروش حمل', 'ماژول Pricing & Sales', 'محاسبه پیشنهاد حمل', 'گردش استعلام تا Quotation', 'کنترل نرخ فروش']),
    'booking' => $module('booking', 'تبدیل پیشنهاد تأییدشده به پرونده رزرو', ['مدیریت Booking', 'رزرو و Booking حمل', 'فرایند ثبت بوکینگ', 'ماژول Booking سپند']),
    'transport-operations' => $module('transport-operations', 'اجرای انتهابه‌انتهای پرونده حمل', ['مدیریت عملیات حمل', 'پرونده عملیاتی محموله', 'نرم‌افزار عملیات حمل‌ونقل', 'اجرای عملیات Shipment', 'کنترل اجرای پرونده حمل', 'مدیریت رویدادهای محموله', 'عملیات یکپارچه فورواردری', 'چرخه اجرایی Shipment']),
    'documents' => $module('document-management', 'نگهداری و بازیابی فایل‌های پرونده حمل', ['مدیریت اسناد حمل', 'مخزن اسناد فورواردری', 'نرم‌افزار اسناد حمل‌ونقل', 'مدیریت فایل‌های Shipment']),
    'finance' => $module('finance-accounting', 'ثبت مالی چندارزی و کنترل نتیجه پرونده', ['حسابداری حمل‌ونقل', 'مالی چندارزی فورواردری', 'ماژول مالی و حسابداری', 'کنترل مالی پرونده حمل', 'ثبت مالی هر Shipment', 'حسابداری شرکت فورواردری', 'کنترل دریافت و پرداخت حمل']),
    'workflow' => $module('workflow-tasks', 'مدیریت وظایف انسانی، مسئول و مهلت', ['گردش کار و وظایف', 'مدیریت فرایند انسانی', 'وظایف زمان‌دار عملیات', 'Workflow تیم حمل']),
    'automatic-tasks' => $module('automatic-tasks', 'ساخت وظیفه پیگیری بر اساس رویداد CRM', ['تسک خودکار CRM', 'پیگیری خودکار فروش', 'وظایف رویدادمحور CRM', 'اتوماسیون Follow-up']),
    'portal' => $module('customer-portal-tracking', 'سلف‌سرویس مشتری برای رهگیری و صورتحساب', ['پرتال مشتریان و رهگیری', 'سلف‌سرویس مشتری حمل', 'رهگیری محموله در پرتال', 'پرتال OTP مشتریان']),
    'control-tower' => $module('operations-control-tower', 'پایش، اولویت‌بندی و تصمیم شیفت عملیات', ['برج کنترل عملیات حمل', 'پایش روزانه عملیات', 'مرکز تصمیم شیفت', 'Control Tower سپند']),
    'document-checklists' => $module('document-checklists', 'تعریف اقلام مدرک موردنیاز هر خدمت', ['چک لیست مدارک حمل', 'الگوی مدارک هر خدمت', 'Document Checklist عملیاتی', 'فهرست مدارک موردنیاز']),
    'fleet-dispatch' => $module('fleet-dispatch', 'اجرای تخصیص و اعزام مأموریت ناوگان', ['اجرای اعزام ناوگان', 'دیسپچ اجرایی خودرو', 'مدیریت مأموریت راننده', 'Fleet Dispatch سپند']),

    'air' => $mode('air', 'مدیریت فرایند تخصصی Air Freight', ['مدیریت عملیات حمل هوایی', 'نرم‌افزار Air Freight', 'پرونده حمل هوایی', 'عملیات هوایی سپند', 'کنترل Shipment هوایی', 'مدیریت MAWB و HAWB', 'فرایند Air Cargo']),
    'road' => $mode('road', 'مدیریت سفر جاده‌ای، مرز و تحویل', ['مدیریت حمل جاده‌ای', 'عملیات حمل زمینی', 'کنترل سفر و مرز', 'پرونده Road Freight', 'مدیریت مأموریت زمینی', 'کنترل حمل بین‌مرزی', 'اجرای سفر کامیون']),
    'sea' => $mode('sea', 'مدیریت جریان تخصصی حمل دریایی', ['مدیریت حمل دریایی', 'عملیات Sea Freight', 'پرونده حمل کانتینری', 'نرم‌افزار عملیات دریایی', 'کنترل Shipment دریایی', 'فرایند حمل کانتینری', 'مدیریت عملیات بندری']),
    'rail' => $mode('rail', 'مدیریت واگن و رویدادهای حمل ریلی', ['مدیریت حمل ریلی', 'عملیات واگن و قطار', 'پرونده Rail Freight', 'نرم‌افزار حمل ریلی']),

    'operations-automation' => $platform('operations-automation', 'تبدیل سیگنال عملیاتی به Rule، اقدام و Escalation', ['اتوماسیون عملیات حمل', 'Ruleهای چندمرحله‌ای عملیات', 'قواعد و Triggerهای عملیاتی', 'چرخه Rule تا اقدام']),
    'freight-finance' => $platform('freight-finance', 'کنترل Accrual، Variance و Margin واقعی', ['سود و زیان پرونده حمل', 'محاسبه سود واقعی Shipment', 'کنترل Margin هر Job', 'مدیریت مالی حمل']),
    'fleet-management' => $platform('fleet-management', 'مدیریت دارایی، راننده، ظرفیت و آمادگی', ['مدیریت ناوگان حمل‌ونقل', 'Vehicle و Driver Master', 'کنترل آمادگی ناوگان', 'مدیریت دارایی و راننده']),
    'document-approval' => $platform('document-management', 'کنترل Draft، Review، Revision و Approval سند', ['چرخه تأیید اسناد', 'بازبینی و Approval سند', 'گردش Draft تا نسخه نهایی', 'کنترل نسخه و تأیید سند']),
    'multimodal' => $platform('multimodal-transport', 'هماهنگی Legها و Handover در حمل چندوجهی', ['مدیریت حمل چندوجهی', 'کنترل Leg و Handover', 'Journey چندوجهی محموله', 'عملیات Multimodal']),
    'schedule' => $platform('schedule-management', 'کنترل Schedule مرجع، ETD و ETA', ['مدیریت برنامه حرکت', 'کنترل ETD و ETA', 'Schedule حمل‌ونقل', 'برنامه مرجع مسیر']),
    'rate' => $platform('rate-management', 'مدیریت Rate Master، شکست مقداری و Chargeها', ['مدیریت نرخ و تعرفه حمل', 'Rate Break و Minimum Charge', 'مخزن نرخ‌های حمل', 'کنترل Tariff و هزینه جانبی']),
    'security' => $platform('security-access-management', 'کنترل Workspace، Role، Permission و Audit', ['امنیت و مدیریت دسترسی', 'کنترل نقش‌ها و مجوزها', 'مدیریت دسترسی چندسازمانی', 'Role و Permission سپند']),
    'payment' => $platform('payment-workflow', 'مدیریت درخواست، تأیید و اجرای پرداخت', ['گردش درخواست تا پرداخت', 'فرایند تأیید پرداخت', 'Payment Workflow مالی', 'کنترل پرداختنی‌ها']),
    'booking-reconciliation' => $platform('booking-reconciliation', 'تخصیص دریافت و تطبیق مانده Booking', ['تطبیق مالی Booking', 'Receipt Allocation بوکینگ', 'کنترل دریافت و مانده رزرو', 'Reconciliation دریافت‌ها']),
    'supplier' => $platform('supplier-management', 'حفظ Supplier Master و مقایسه چندمعیاره', ['مدیریت تأمین‌کنندگان حمل', 'Supplier Master', 'مقایسه تأمین‌کنندگان', 'ارزیابی نرخ و عملکرد تأمین‌کننده']),

    'nvocc' => $target('/solutions/nvocc', 'solutions.nvocc', [], 'مدیریت عملیات تجاری و اجرایی NVOCC', ['راهکار NVOCC', 'مدیریت عملیات NVOCC', 'نرم‌افزار تخصصی NVOCC', 'فرایند NVOCC سپند']),
    'container' => $target('/solutions/container-management', 'solutions.container-management', [], 'ردیابی چرخه Gate-in تا Return کانتینر', ['مدیریت چرخه کانتینر', 'کنترل Container Master', 'عملیات Depot و Lease', 'مدیریت کانتینر سپند']),
    'on-premise' => $target('/solutions/on-premise', 'solutions.on-premise', [], 'بررسی الزامات استقرار داخل سازمان', ['استقرار On-Premise', 'راهکار نصب داخل سازمان', 'الزامات استقرار اختصاصی', 'مدل استقرار سازمانی']),
    'bill-of-lading' => $target('/solutions/bill-of-lading-management', 'solutions.bill-of-lading-management', [], 'کنترل HBL، MBL و رابطه House/Master', ['مدیریت HBL و MBL', 'کنترل بارنامه‌های حمل', 'مدیریت Draft بارنامه', 'راهکار Bill of Lading']),
    'sales-automation' => $target('/solutions/freight-sales-automation', 'solutions.freight-sales-automation', [], 'استانداردکردن Follow-up و Handoff فروش', ['اتوماسیون فروش حمل', 'پیگیری فروش فورواردری', 'Sales Automation سپند', 'کنترل SLA فروش']),
    'visibility' => $target('/solutions/shipment-visibility', 'solutions.shipment-visibility', [], 'مشاهده وضعیت و تازگی Milestoneهای محموله', ['دیدپذیری وضعیت محموله', 'کنترل Milestoneهای حمل', 'Shipment Visibility داخلی', 'وضعیت معتبر Shipment']),
    'exception' => $target('/solutions/operation-exception-management', 'solutions.operation-exception-management', [], 'مالکیت، رسیدگی و بستن انحراف عملیاتی', ['مدیریت Exceptionهای عملیاتی', 'رسیدگی به استثناهای حمل', 'فرایند حل انحراف عملیات', 'کنترل Exception محموله']),
    'governance' => $target('/solutions/transport-governance', 'solutions.transport-governance', [], 'تعریف سیاست و تصمیم قابل ممیزی بین واحدها', ['حاکمیت عملیات حمل', 'کنترل‌های مدیریتی حمل', 'Transport Governance', 'سیاست‌گذاری عملیات']),
    'document-readiness' => $target('/solutions/document-readiness', 'solutions.document-readiness', [], 'سنجش کامل‌بودن مدارک پیش از Gate عملیاتی', ['کنترل آماده بودن مدارک', 'Document Readiness حمل', 'کنترل کسری اسناد', 'آمادگی مدارک پیش از عملیات']),
    'dispatch-planning' => $target('/solutions/fleet-dispatch-planning', 'solutions.fleet-dispatch-planning', [], 'برنامه‌ریزی ظرفیت و تخصیص بدون تداخل', ['برنامه‌ریزی اعزام ناوگان', 'تخصیص بدون تداخل مأموریت', 'Dispatch Planning', 'برنامه ظرفیت خودرو و راننده']),
];

$page = static fn (int $tier, string $cluster, array $links): array => compact('tier', 'cluster', 'links');

return [
    'updated_at' => '2026-09-07',
    'targets' => $targets,
    'pages' => [
        '/' => $page(1, 'Core', ['product', 'crm', 'transport-operations', 'finance', 'best-forwarding', 'case-study']),
        '/product' => $page(1, 'Core', ['crm', 'pricing-sales', 'transport-operations', 'finance', 'portal', 'pricing']),
        '/why-sepand' => $page(2, 'Core', ['home', 'product', 'about', 'case-study']),
        '/faq' => $page(3, 'Core', ['product', 'modules', 'solutions']),
        '/modules' => $page(2, 'Core', ['crm', 'pricing-sales', 'transport-operations', 'finance']),
        '/solutions' => $page(2, 'Core', ['transport-operations', 'finance', 'crm', 'product']),
        '/compare' => $page(2, 'Compare', ['best-forwarding', 'best-transport', 'best-crm', 'best-accounting']),
        '/pricing' => $page(2, 'Core', ['product', 'consultation', 'compare', 'faq']),
        '/about' => $page(3, 'Core', ['home', 'why', 'case-study']),
        '/consultation' => $page(3, 'Core', ['product', 'faq', 'pricing']),
        '/customers/case-studies/operational-control-snapshot' => $page(2, 'Operations', ['transport-operations', 'control-tower', 'finance', 'product']),

        '/compare/sepand-vs-royan' => $page(3, 'Compare', ['compare', 'compare-saba', 'best-forwarding']),
        '/compare/sepand-vs-saba' => $page(3, 'Compare', ['compare', 'compare-royan', 'best-forwarding']),
        '/compare/sepand-vs-other-transport-software' => $page(3, 'Compare', ['compare', 'best-transport', 'product']),
        '/compare/best-transport-software' => $page(2, 'Compare', ['product', 'modules', 'compare-other', 'compare']),
        '/compare/best-freight-forwarding-software' => $page(1, 'Compare', ['product', 'crm', 'pricing-sales', 'transport-operations', 'finance', 'solutions']),
        '/compare/best-crm-for-transport-companies' => $page(3, 'Sales', ['crm', 'pricing-sales', 'compare']),
        '/compare/best-transport-accounting-software' => $page(3, 'Finance', ['finance', 'freight-finance', 'compare']),

        '/modules/crm' => $page(1, 'Sales', ['pricing-sales', 'sales-automation', 'booking', 'product', 'automatic-tasks']),
        '/modules/pricing-sales' => $page(1, 'Sales', ['crm', 'booking', 'rate', 'supplier', 'finance']),
        '/modules/booking' => $page(2, 'Sales', ['pricing-sales', 'transport-operations', 'documents', 'finance']),
        '/modules/transport-operations' => $page(1, 'Operations', ['visibility', 'control-tower', 'operations-automation', 'exception', 'finance', 'product']),
        '/modules/document-management' => $page(2, 'Documents', ['document-approval', 'document-readiness', 'bill-of-lading', 'document-checklists']),
        '/modules/finance-accounting' => $page(1, 'Finance', ['freight-finance', 'payment', 'booking-reconciliation', 'pricing-sales', 'transport-operations']),
        '/modules/workflow-tasks' => $page(3, 'Operations', ['automatic-tasks', 'operations-automation', 'transport-operations']),
        '/modules/automatic-tasks' => $page(3, 'Sales', ['crm', 'workflow', 'sales-automation']),
        '/modules/customer-portal-tracking' => $page(2, 'Core', ['visibility', 'booking', 'finance', 'product']),
        '/modules/operations-control-tower' => $page(3, 'Operations', ['transport-operations', 'visibility', 'exception']),
        '/modules/document-checklists' => $page(3, 'Documents', ['documents', 'document-readiness', 'document-approval']),
        '/modules/fleet-dispatch' => $page(3, 'Road / Fleet', ['road', 'dispatch-planning', 'fleet-management']),

        '/transport-modes/air' => $page(1, 'Air Freight', ['pricing-sales', 'booking', 'transport-operations', 'documents', 'finance']),
        '/transport-modes/road' => $page(1, 'Road / Fleet', ['fleet-management', 'dispatch-planning', 'fleet-dispatch', 'transport-operations', 'finance']),
        '/transport-modes/sea' => $page(1, 'Sea / NVOCC', ['nvocc', 'container', 'bill-of-lading', 'schedule', 'finance', 'transport-operations']),
        '/transport-modes/rail' => $page(3, 'Multimodal', ['multimodal', 'schedule', 'transport-operations']),

        '/solutions/operations-automation' => $page(2, 'Operations', ['transport-operations', 'control-tower', 'exception', 'workflow']),
        '/solutions/freight-finance' => $page(2, 'Finance', ['finance', 'payment', 'pricing-sales', 'transport-operations']),
        '/solutions/fleet-management' => $page(2, 'Road / Fleet', ['road', 'dispatch-planning', 'fleet-dispatch', 'transport-operations']),
        '/solutions/document-management' => $page(3, 'Documents', ['documents', 'document-readiness', 'bill-of-lading']),
        '/solutions/multimodal-transport' => $page(3, 'Multimodal', ['transport-operations', 'air', 'sea', 'rail']),
        '/solutions/schedule-management' => $page(2, 'Sea / NVOCC', ['sea', 'nvocc', 'transport-operations', 'multimodal']),
        '/solutions/rate-management' => $page(2, 'Sales', ['pricing-sales', 'supplier', 'crm', 'finance']),
        '/solutions/security-access-management' => $page(3, 'Core', ['product', 'on-premise', 'governance']),
        '/solutions/payment-workflow' => $page(3, 'Finance', ['finance', 'freight-finance', 'booking-reconciliation']),
        '/solutions/booking-reconciliation' => $page(3, 'Finance', ['finance', 'booking', 'freight-finance']),
        '/solutions/supplier-management' => $page(3, 'Sales', ['pricing-sales', 'rate', 'crm']),

        '/solutions/nvocc' => $page(2, 'Sea / NVOCC', ['sea', 'container', 'bill-of-lading', 'finance']),
        '/solutions/container-management' => $page(2, 'Sea / NVOCC', ['sea', 'nvocc', 'schedule', 'finance']),
        '/solutions/on-premise' => $page(3, 'Core', ['security', 'product', 'consultation']),
        '/solutions/bill-of-lading-management' => $page(2, 'Sea / NVOCC', ['sea', 'nvocc', 'documents', 'document-approval']),
        '/solutions/freight-sales-automation' => $page(2, 'Sales', ['crm', 'pricing-sales', 'booking', 'product']),
        '/solutions/shipment-visibility' => $page(3, 'Operations', ['transport-operations', 'control-tower', 'exception']),
        '/solutions/operation-exception-management' => $page(3, 'Operations', ['transport-operations', 'operations-automation', 'control-tower']),
        '/solutions/transport-governance' => $page(3, 'Operations', ['transport-operations', 'finance', 'security']),
        '/solutions/document-readiness' => $page(3, 'Documents', ['documents', 'document-checklists', 'document-approval']),
        '/solutions/fleet-dispatch-planning' => $page(3, 'Road / Fleet', ['road', 'fleet-management', 'fleet-dispatch']),
    ],
];
