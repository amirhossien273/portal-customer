<?php

$pages = [
    'operations-automation' => [
        'nav_title' => 'اتوماسیون عملیات',
        'nav_description' => 'Rule، هشدار، مسئول اقدام و Escalation',
        'eyebrow' => 'Operations Automation',
        'title' => 'اتوماسیون عملیات حمل‌ونقل با Rule و Exception | سپند',
        'description' => 'اتوماسیون عملیات حمل‌ونقل سپند برای تبدیل رخداد، تأخیر و کسری سند به هشدار دارای اولویت، مسئول، موعد، Escalation و ردپای رسیدگی.',
        'image' => 'modules/screenshots/automatic-task-rules.webp',
        'image_alt' => 'قواعد واقعی اتوماسیون عملیات و ساخت تسک در نرم‌افزار سپند',
        'h1' => 'اتوماسیون عملیات حمل‌ونقل؛ از سیگنال تا اقدام قابل پیگیری',
        'lead' => 'کنترل‌های پرتکرار عملیات را به Ruleهای روشن تبدیل کنید تا هر انحراف، به‌جای ماندن در پیام‌ها، مسئول، موعد و نتیجه قابل ممیزی داشته باشد.',
        'problem' => 'وقتی ETA، کسری سند، پایان Free Time یا نبود به‌روزرسانی با فایل و حافظه افراد کنترل شود، هشدار دیر دیده می‌شود و مالک اقدام روشن نیست.',
        'boundary' => 'این صفحه روی اجرای خودکار کنترل و اتصال هشدار به اقدام تمرکز دارد. «دیدپذیری حمل» فقط وضعیت را نشان می‌دهد و «مدیریت استثنا» چرخه تخصصی رسیدگی به Exception را توضیح می‌دهد.',
        'capabilities' => [
            ['title' => 'Rule قابل توضیح', 'text' => 'شرط، آستانه، شدت، مسئول، موعد و مسیر Escalation برای هر کنترل تعریف می‌شود.'],
            ['title' => 'صف اقدام اولویت‌دار', 'text' => 'هشدارهای واقعی بر اساس ریسک و زمان مرتب و مستقیماً به پرونده سازنده متصل می‌شوند.'],
            ['title' => 'یادگیری از نتیجه', 'text' => 'اقدام، علت بسته‌شدن و زمان پاسخ ثبت می‌شود تا Ruleهای پرنویز یا کم‌اثر اصلاح شوند.'],
        ],
        'evidence' => [
            ['title' => 'قواعد ساخت تسک', 'text' => 'نمونه واقعی فهرست Ruleهای فعال و غیرفعال با امکان کنترل اجرای هر قانون.', 'image' => 'modules/screenshots/automatic-task-rules.webp', 'alt' => 'فهرست واقعی قواعد تسک خودکار سپند', 'route' => 'site.modules.show', 'parameters' => ['module' => 'automatic-tasks'], 'cta' => 'مشاهده موتور تسک خودکار'],
            ['title' => 'صف حرکت و هشدار', 'text' => 'نمای فهرستی حرکت‌ها و موارد ناقص که ورودی تصمیم روزانه تیم عملیات است.', 'image' => 'modules/screenshots/operations-calendar-list.webp', 'alt' => 'نمای واقعی فهرست حرکت و هشدار عملیات سپند', 'route' => 'site.modules.show', 'parameters' => ['module' => 'operations-control-tower'], 'cta' => 'مشاهده برج کنترل عملیات'],
            ['title' => 'اعلان و یادآوری', 'text' => 'مرکز اعلان‌ها برای رساندن تسک ارجاع‌شده و یادآوری اقدام به کارشناس.', 'image' => 'modules/screenshots/workflow-notifications.webp', 'alt' => 'مرکز اعلان و یادآوری واقعی سپند', 'route' => 'site.modules.show', 'parameters' => ['module' => 'workflow-tasks'], 'cta' => 'مشاهده گردش کار و وظایف'],
        ],
        'workflow' => [
            ['title' => 'انتخاب سیگنال معتبر', 'text' => 'رخداد یا داده‌ای انتخاب می‌شود که واقعاً ریسک قابل اقدام را نشان دهد.'],
            ['title' => 'تنظیم آستانه', 'text' => 'دامنه، شدت و زمان انتظار با سابقه واقعی عملیات کالیبره می‌شوند.'],
            ['title' => 'تعیین مالک و موعد', 'text' => 'هشدار بدون مسئول ساخته نمی‌شود و مهلت بر اساس سطح ریسک تعیین می‌گردد.'],
            ['title' => 'رسیدگی و Escalation', 'text' => 'اقدام ثبت و در صورت عبور از SLA به نقش دارای اختیار ارجاع می‌شود.'],
            ['title' => 'بازبینی اثربخشی', 'text' => 'نرخ هشدار مفید، زمان پاسخ و موارد تکراری برای بهبود Rule سنجیده می‌شوند.'],
        ],
        'depth' => [
            ['title' => 'ورودی عملیاتی', 'text' => 'Tracking، Schedule، وضعیت Job، اسناد، هزینه و رویدادهای پرونده.'],
            ['title' => 'منطق تصمیم', 'text' => 'شرط، آستانه، Mode، Severity، Due و سیاست Escalation.'],
            ['title' => 'خروجی قابل اقدام', 'text' => 'تسک یا Exception یکتا با مالک، موعد و لینک مستقیم به منشأ.'],
            ['title' => 'ردپای ممیزی', 'text' => 'تغییر وضعیت، شرح اقدام، نتیجه، کاربر و زمان هر تصمیم.'],
        ],
        'controls' => ['Acknowledge به معنی رفع نیست و بستن هشدار باید نتیجه روشن داشته باشد.', 'Rule پرنویز پیش از حذف تحلیل می‌شود تا سابقه تصمیم از بین نرود.', 'برای هر کنترل، رخداد پایان و مالک کیفیت داده باید مشخص باشد.'],
        'metrics' => ['میانه زمان تشخیص تا اقدام', 'درصد هشدارهای بسته‌شده در SLA', 'نرخ هشدار کاذب یا بدون اقدام', 'تعداد Exception تکراری به تفکیک علت'],
        'roles' => ['مدیر عملیات برای سیاست Rule', 'سرپرست شیفت برای اولویت و Escalation', 'کارشناس پرونده برای اقدام و ثبت نتیجه'],
        'faqs' => [
            ['q' => 'اتوماسیون عملیات چه چیزی را خودکار می‌کند؟', 'a' => 'تشخیص شرط، ساخت هشدار، تعیین شدت و مسئول، محاسبه موعد و Escalation را ساختاریافته می‌کند؛ تصمیم تخصصی و ثبت نتیجه با کاربر مجاز باقی می‌ماند.'],
            ['q' => 'تفاوت Rule و Exception چیست؟', 'a' => 'Rule تعریف تکرارشونده کنترل است؛ Exception رخداد واقعی حاصل از انطباق داده یک پرونده با آن Rule است.'],
            ['q' => 'چطور از هشدار کاذب جلوگیری می‌شود؟', 'a' => 'با داده معتبر، دامنه محدود، آستانه متناسب، شرط توقف و بازبینی دوره‌ای نسبت هشدارهای مفید به کل هشدارها.'],
            ['q' => 'آیا اتوماسیون جایگزین کارشناس می‌شود؟', 'a' => 'خیر؛ سیستم مورد نیازمند توجه را زودتر پیدا و مسئول می‌کند، اما تحلیل علت، تصمیم و تأیید نتیجه همچنان انسانی است.'],
        ],
        'related' => ['schedule-management', 'document-management', 'freight-finance'],
        'existing_links' => [['route' => 'solutions.operation-exception-management', 'label' => 'مدیریت استثناهای عملیات'], ['route' => 'solutions.shipment-visibility', 'label' => 'دیدپذیری عملیات حمل']],
    ],

    'freight-finance' => [
        'nav_title' => 'مالی حمل‌ونقل', 'nav_description' => 'Accrual، FX، Reconciliation و Margin', 'eyebrow' => 'Freight Finance',
        'title' => 'مدیریت مالی حمل‌ونقل، Accrual و Margin | سپند',
        'description' => 'راهکار مالی حمل‌ونقل سپند برای کنترل نرخ ارز تاریخ‌دار، هزینه تعهدی، تطبیق مبلغ واقعی و تحلیل تغییر سود هر پرونده حمل.',
        'image' => 'modules/screenshots/finance-booking-reconciliation.webp', 'image_alt' => 'تطبیق مالی واقعی Booking در نرم‌افزار سپند',
        'h1' => 'مدیریت مالی حمل‌ونقل؛ از هزینه تعهدی تا سود واقعی پرونده',
        'lead' => 'هزینه برآوردی، تعهدشده و واقعی را با نرخ ارز مؤثر کنار هم ببینید تا سود موقت خوش‌بینانه نباشد و علت هر تغییر Margin قابل توضیح بماند.',
        'problem' => 'فاکتور، نرخ ارز و هزینه عملیاتی در زمان‌های متفاوت می‌رسند؛ بدون Accrual و تطبیق، پرونده سودآور دیده می‌شود درحالی‌که بخشی از تعهد هنوز ثبت نشده است.',
        'boundary' => 'نیت این صفحه «کنترل مالی انتهابه‌انتهای Job» است. صفحه ماژول مالی امکانات محصول را معرفی می‌کند و مدیریت نرخ، Rate Master و قیمت پیشنهادی را پوشش می‌دهد.',
        'capabilities' => [['title' => 'FX تاریخ‌دار', 'text' => 'جفت ارز، نرخ، تاریخ اثر و منبع برای بازسازی هر تبدیل ثبت می‌شود.'], ['title' => 'Accrual و Match Actual', 'text' => 'هزینه رخ‌داده پیش از فاکتور شناسایی و بعداً با سند واقعی تطبیق می‌شود.'], ['title' => 'Margin Bridge', 'text' => 'Estimated، Committed و Actual همراه Driverهای اختلاف کنار هم دیده می‌شوند.']],
        'evidence' => [
            ['title' => 'تطبیق مالی Booking', 'text' => 'نمای واقعی اتصال پرداخت‌ها، دریافت‌ها و نرخ تبدیل به همان Booking.', 'image' => 'modules/screenshots/finance-booking-reconciliation.webp', 'alt' => 'تطبیق مالی Booking در سپند', 'route' => 'site.modules.show', 'parameters' => ['module' => 'finance-accounting'], 'cta' => 'مشاهده مالی چندارزی'],
            ['title' => 'جزئیات درخواست پرداخت', 'text' => 'مرجع، تأییدکننده و اسناد مالی در یک پرونده قابل ردیابی قرار می‌گیرند.', 'image' => 'modules/screenshots/finance-payment-details.webp', 'alt' => 'جزئیات واقعی درخواست پرداخت سپند', 'route' => 'site.modules.show', 'parameters' => ['module' => 'finance-accounting'], 'cta' => 'بررسی کنترل پرداخت'],
            ['title' => 'سودآوری Booking', 'text' => 'مبلغ Offer، دریافت و پرداخت برای مشاهده نتیجه تجاری رزرو کنار هم قرار دارند.', 'image' => 'modules/screenshots/booking-profitability.webp', 'alt' => 'نمای واقعی سودآوری Booking سپند', 'route' => 'site.modules.show', 'parameters' => ['module' => 'booking'], 'cta' => 'مشاهده Booking و سودآوری'],
        ],
        'workflow' => [['title' => 'ثبت مبنای ارز', 'text' => 'نرخ معتبر با تاریخ اثر و منبع ثبت می‌شود.'], ['title' => 'شناسایی تعهد', 'text' => 'هزینه ایجادشده اما فاکتورنشده به Job متصل می‌شود.'], ['title' => 'محاسبه سود تعهدی', 'text' => 'تعهدها وارد Committed Margin می‌شوند.'], ['title' => 'تطبیق سند واقعی', 'text' => 'Accrual با مبلغ Actual و مرجع یکتا Match می‌شود.'], ['title' => 'تحلیل Variance', 'text' => 'عامل تغییر ارز، درآمد، هزینه یا توقف بررسی می‌شود.']],
        'depth' => [['title' => 'داده پایه', 'text' => 'درآمد، هزینه، ارز، تاریخ مؤثر، طرف حساب و Job.'], ['title' => 'لایه تعهد', 'text' => 'Accrualهای باز، سند مورد انتظار و وضعیت Match.'], ['title' => 'سه نمای Margin', 'text' => 'Estimated برای برنامه، Committed برای تعهد و Actual برای واقعیت.'], ['title' => 'قابلیت توضیح', 'text' => 'هر Variance تا سند، نرخ تبدیل و پرونده سازنده قابل Drill-down است.']],
        'controls' => ['مرجع فاکتور از شمارش دوباره هزینه جلوگیری می‌کند.', 'نرخ ارز بدون تاریخ و منبع برای مقایسه دوره‌ای معتبر نیست.', 'بستن مالی پرونده به کنترل Accrualهای باز وابسته است.'],
        'metrics' => ['حاشیه Estimated در برابر Actual', 'ارزش Accrualهای باز و سن آن‌ها', 'مغایرت ناشی از نرخ ارز', 'زمان فاکتور تا Reconciliation'],
        'roles' => ['مالی برای FX و تطبیق', 'عملیات برای شناسایی تعهد', 'مدیر تجاری برای تحلیل Margin'],
        'faqs' => [['q' => 'Accrual در حمل‌ونقل چیست؟', 'a' => 'هزینه‌ای است که عملیاتی رخ داده اما فاکتور نهایی آن هنوز نرسیده؛ ثبت آن از بیش‌برآورد سود جلوگیری می‌کند.'], ['q' => 'Committed و Actual Margin چه تفاوتی دارند؟', 'a' => 'Committed تعهدهای شناسایی‌شده را لحاظ می‌کند؛ Actual بر مبالغ واقعی و تطبیق‌شده تکیه دارد.'], ['q' => 'این صفحه جایگزین مدیریت تعرفه است؟', 'a' => 'خیر؛ تعرفه برای محاسبه نرخ پیشنهادی است و Freight Finance نتیجه مالی اجرای عملیات را کنترل می‌کند.'], ['q' => 'برای دموی مالی چه داده‌ای آماده کنیم؟', 'a' => 'یک Booking چندارزی با هزینه برآوردی، فاکتور واقعی، دریافت مرحله‌ای و یک مغایرت قابل توضیح انتخاب کنید.']],
        'related' => ['rate-management', 'container-nvocc', 'operations-automation'],
        'existing_links' => [['route' => 'site.modules.show', 'parameters' => ['module' => 'finance-accounting'], 'label' => 'ماژول مالی و حسابداری'], ['route' => 'compare.best-transport-accounting-software', 'label' => 'راهنمای انتخاب حسابداری حمل']],
    ],

    'container-nvocc' => [
        'nav_title' => 'کانتینر و NVOCC', 'nav_description' => 'دارایی، دپو، Lease و بهره‌برداری', 'eyebrow' => 'Container & NVOCC',
        'title' => 'نرم‌افزار مدیریت کانتینر و دارایی NVOCC | سپند',
        'description' => 'راهکار مدیریت دارایی کانتینری NVOCC؛ Container Master، دپو، رویداد، تخصیص، Lease، بازگشت، Utilization و اتصال هزینه به عملیات.',
        'image' => 'transport-modes/sea-hero.webp', 'image_alt' => 'مدیریت دارایی کانتینری و عملیات NVOCC در سپند',
        'h1' => 'مدیریت کانتینر NVOCC؛ کنترل دارایی، دپو و تعهد بازگشت',
        'lead' => 'برای هر کانتینر، یک تاریخچه پیوسته از مالکیت و موقعیت تا تخصیص، اجاره، بازگشت و اثر مالی بسازید؛ نه چند فهرست ناسازگار در واحدهای مختلف.',
        'problem' => 'شماره تکراری، موقعیت نامعلوم، تخصیص هم‌زمان و موعد بازگشت فراموش‌شده به خواب دارایی و هزینه پیش‌بینی‌نشده تبدیل می‌شوند.',
        'boundary' => 'این صفحه بر «اقتصاد و کنترل ناوگان کانتینری NVOCC» تمرکز دارد؛ راهکار NVOCC مدل کامل کسب‌وکار را پوشش می‌دهد و صفحه مدیریت کانتینر روی رویدادهای یک کانتینر در پرونده حمل متمرکز است.',
        'capabilities' => [['title' => 'Container & Depot Master', 'text' => 'شماره یکتا، نوع، مالکیت، وضعیت و موقعیت جاری دارایی نگهداری می‌شود.'], ['title' => 'Allocation و Lease', 'text' => 'تخصیص به Shipment، قرارداد اجاره و تعهد بازگشت در یک چرخه دیده می‌شوند.'], ['title' => 'Utilization و Cost', 'text' => 'روزهای Active و Idle، تعداد Trip و هزینه دارایی قابل تحلیل می‌شوند.']],
        'evidence' => [
            ['title' => 'پرونده عملیات متصل', 'text' => 'شاهد واقعی فهرست عملیات که اتصال دارایی به Shipment و رویداد را ممکن می‌کند.', 'image' => 'modules/screenshots/operations-calendar-list.webp', 'alt' => 'فهرست واقعی عملیات حمل سپند', 'route' => 'site.modules.show', 'parameters' => ['module' => 'transport-operations'], 'cta' => 'مشاهده عملیات حمل'],
            ['title' => 'مدارک مرتبط با دارایی', 'text' => 'فایل و عنوان سند مستقیماً در پرونده مربوط ثبت می‌شوند.', 'image' => 'modules/screenshots/document-attachment-upload.webp', 'alt' => 'بارگذاری واقعی سند پرونده در سپند', 'route' => 'site.modules.show', 'parameters' => ['module' => 'document-management'], 'cta' => 'مشاهده مدیریت اسناد'],
            ['title' => 'اثر مالی پرونده', 'text' => 'هزینه‌های تجهیز در تطبیق مالی Booking و سود واقعی دیده می‌شوند.', 'image' => 'modules/screenshots/finance-booking-reconciliation.webp', 'alt' => 'تطبیق مالی واقعی هزینه Booking', 'route' => 'site.modules.show', 'parameters' => ['module' => 'finance-accounting'], 'cta' => 'مشاهده نتیجه مالی'],
        ],
        'workflow' => [['title' => 'ساخت Master یکتا', 'text' => 'مشخصات مالکیت و نوع دارایی پاک‌سازی و ثبت می‌شوند.'], ['title' => 'ثبت رویداد دپو', 'text' => 'ورود، خروج و موقعیت جاری با زمان معتبر ثبت می‌شود.'], ['title' => 'تخصیص به Shipment', 'text' => 'Allocation فعال از استفاده هم‌زمان و مبهم جلوگیری می‌کند.'], ['title' => 'کنترل Lease و توقف', 'text' => 'موعد بازگشت، Free Time و هزینه پیش‌بینی می‌شوند.'], ['title' => 'بازگشت و تحلیل', 'text' => 'آزادسازی دارایی و نسبت Active به Idle سنجیده می‌شود.']],
        'depth' => [['title' => 'Master Data', 'text' => 'شماره، نوع، مالکیت، وضعیت و دپوی جاری.'], ['title' => 'چرخه رویداد', 'text' => 'ورود، خروج، تخصیص، آزادسازی و بازگشت.'], ['title' => 'تعهد قراردادی', 'text' => 'Lease، موعد بازگشت، Free Time و نرخ‌های هزینه.'], ['title' => 'اقتصاد دارایی', 'text' => 'روز فعال، Idle، تعداد Trip، درآمد و هزینه منتسب.']],
        'controls' => ['شماره کانتینر در سطح Master یکتا و نرمال‌سازی می‌شود.', 'Allocation فعال باید بازه و Shipment مرجع داشته باشد.', 'Return فقط با رویداد و موقعیت واقعی ثبت می‌شود.'],
        'metrics' => ['درصد Utilization ناوگان کانتینری', 'میانگین روز Idle به تفکیک دپو', 'تعداد تعهد بازگشت سررسیدشده', 'هزینه توقف و Lease برای هر Trip'],
        'roles' => ['مسئول تجهیزات برای Master و Depot', 'عملیات برای Allocation و Event', 'مالی برای Lease و هزینه توقف'],
        'faqs' => [['q' => 'این صفحه با راهکار NVOCC چه تفاوتی دارد؟', 'a' => 'راهکار NVOCC فروش، Booking، House/Master و مالی را پوشش می‌دهد؛ این صفحه فقط اقتصاد و کنترل دارایی کانتینری را عمیق می‌کند.'], ['q' => 'Utilization چگونه تعریف می‌شود؟', 'a' => 'نسبت زمان یا روزهای استفاده فعال دارایی به کل بازه قابل استفاده، با قواعدی که سازمان برای Active و Idle تعیین می‌کند.'], ['q' => 'آیا هزینه Demurrage خودکار قطعی است؟', 'a' => 'محاسبه به Policy، رویداد شروع و پایان، Free Time و نرخ صحیح وابسته است و پیش از ثبت مالی باید کنترل شود.'], ['q' => 'چه داده‌ای برای شروع لازم است؟', 'a' => 'فهرست یکتای کانتینرها، مالکیت، نوع، موقعیت جاری، قراردادهای باز و Allocationهای فعال.']],
        'related' => ['freight-finance', 'schedule-management', 'multimodal-transport'],
        'existing_links' => [['route' => 'solutions.nvocc', 'label' => 'راهکار کامل NVOCC'], ['route' => 'solutions.container-management', 'label' => 'چرخه عملیاتی کانتینر']],
    ],

    'fleet-management' => [
        'nav_title' => 'مدیریت ناوگان', 'nav_description' => 'خودرو، راننده، نگهداری و انطباق', 'eyebrow' => 'Fleet Management',
        'title' => 'نرم‌افزار مدیریت ناوگان حمل‌ونقل و رانندگان | سپند',
        'description' => 'مدیریت ناوگان سپند برای کنترل پروفایل خودرو و راننده، مدارک و انقضا، نگهداری، ظرفیت، هزینه، آمادگی و بهره‌برداری ناوگان.',
        'image' => 'transport-modes/road-hero.webp', 'image_alt' => 'راهکار مدیریت ناوگان جاده‌ای، خودرو و راننده سپند',
        'h1' => 'مدیریت ناوگان؛ آمادگی خودرو و راننده پیش از تصمیم اعزام',
        'lead' => 'داده فنی، مدارک، نگهداری، ظرفیت و هزینه را در پروفایل پیوسته هر خودرو و راننده نگه دارید تا گزینه «آزاد» الزاماً گزینه «آماده و مجاز» تلقی نشود.',
        'problem' => 'اگر وضعیت سرویس، اعتبار بیمه و گواهینامه، ظرفیت و مأموریت جاری در منابع جدا باشد، تصمیم اعزام با ریسک توقف، جریمه یا تغییر دیرهنگام روبه‌رو می‌شود.',
        'boundary' => 'این صفحه مالک Master Data، نگهداری، انطباق و اقتصاد ناوگان است؛ صفحه دیسپچ فقط انتخاب و تخصیص خودرو و راننده به Shipment را توضیح می‌دهد.',
        'capabilities' => [['title' => 'پروفایل خودرو و راننده', 'text' => 'ظرفیت، نوع بدنه، مالکیت، مهارت، مدارک و وضعیت جاری متمرکز می‌شوند.'], ['title' => 'نگهداری و انطباق', 'text' => 'سرویس دوره‌ای و انقضای اسناد پیش از اثرگذاری بر اعزام دیده می‌شوند.'], ['title' => 'هزینه و بهره‌برداری', 'text' => 'ماموریت، کیلومتر، توقف و هزینه برای تحلیل استفاده و TCO کنار هم قرار می‌گیرند.']],
        'evidence' => [
            ['title' => 'تقویم عملیاتی', 'text' => 'نمای واقعی زمان‌بندی حمل، بستر بررسی هم‌زمانی ماموریت و ظرفیت است.', 'image' => 'modules/screenshots/operations-calendar-month.webp', 'alt' => 'تقویم واقعی عملیات و مأموریت در سپند', 'route' => 'site.modules.show', 'parameters' => ['module' => 'fleet-dispatch'], 'cta' => 'مشاهده دیسپچ ناوگان'],
            ['title' => 'کنترل مدارک', 'text' => 'اسناد خودرو و راننده به‌صورت فایل مرتبط با سابقه قابل نگهداری‌اند.', 'image' => 'modules/screenshots/document-attachment-upload.webp', 'alt' => 'ثبت واقعی مدارک در سپند', 'route' => 'site.modules.show', 'parameters' => ['module' => 'document-checklists'], 'cta' => 'مشاهده چک‌لیست مدارک'],
            ['title' => 'هزینه مأموریت', 'text' => 'پرداخت و اسناد هزینه در جریان مالی پرونده قابل ردیابی می‌مانند.', 'image' => 'modules/screenshots/finance-payment-details.webp', 'alt' => 'جزئیات واقعی هزینه و پرداخت سپند', 'route' => 'site.modules.show', 'parameters' => ['module' => 'finance-accounting'], 'cta' => 'مشاهده کنترل هزینه'],
        ],
        'workflow' => [['title' => 'پاک‌سازی Master', 'text' => 'شناسه، مالکیت، مشخصات فنی و وابستگی راننده ثبت می‌شوند.'], ['title' => 'تعریف آمادگی', 'text' => 'شرایط فنی، مدرکی و زمانی وضعیت Ready را می‌سازند.'], ['title' => 'برنامه نگهداری', 'text' => 'سرویس بر اساس زمان یا کارکرد موعد می‌گیرد.'], ['title' => 'اتصال مأموریت', 'text' => 'اعزام و بازگشت به پروفایل دارایی متصل می‌شوند.'], ['title' => 'تحلیل TCO', 'text' => 'هزینه و بهره‌برداری برای تصمیم نگهداری یا جایگزینی مرور می‌شوند.']],
        'depth' => [['title' => 'Vehicle Master', 'text' => 'پلاک، نوع، ظرفیت، مالکیت، تجهیز و وضعیت.'], ['title' => 'Driver Profile', 'text' => 'گواهینامه، مهارت مسیر، مدارک و دسترس‌پذیری.'], ['title' => 'Maintenance', 'text' => 'سرویس برنامه‌ای، خرابی، توقف و قطعه یا هزینه.'], ['title' => 'Utilization & TCO', 'text' => 'ماموریت، کیلومتر، زمان Idle و هزینه کل مالکیت.']],
        'controls' => ['وضعیت Ready باید از چند کنترل واقعی ساخته شود، نه یک انتخاب دستی.', 'مدرک نزدیک انقضا پیش از Assignment هشدار می‌گیرد.', 'رویداد نگهداری، دارایی را تا پایان تأییدشده از دسترس خارج می‌کند.'],
        'metrics' => ['درصد آمادگی ناوگان', 'میانگین زمان توقف تعمیر', 'هزینه هر کیلومتر یا مأموریت', 'نرخ استفاده و Idle خودروها'],
        'roles' => ['مدیر ناوگان برای Master و نگهداری', 'مسئول HSE برای انطباق', 'دیسپچر برای استفاده از وضعیت آمادگی'],
        'faqs' => [['q' => 'مدیریت ناوگان با دیسپچ چه تفاوتی دارد؟', 'a' => 'مدیریت ناوگان آمادگی، نگهداری، مدارک و هزینه دارایی را اداره می‌کند؛ دیسپچ از همین داده برای تخصیص مأموریت استفاده می‌کند.'], ['q' => 'Ready بودن خودرو یعنی چه؟', 'a' => 'یعنی محدودیت فنی، مدرکی و زمانیِ تعریف‌شده را پاس کرده و مأموریت متداخل فعال ندارد.'], ['q' => 'مدارک راننده کجا کنترل می‌شوند؟', 'a' => 'در پروفایل راننده و چک‌لیست انطباق؛ نتیجه کنترل باید پیش از تخصیص در دسترس دیسپچر باشد.'], ['q' => 'TCO چه کمکی می‌کند؟', 'a' => 'هزینه نگهداری، توقف، ماموریت و مالکیت را برای مقایسه واقعی دارایی‌ها کنار هم قرار می‌دهد.']],
        'related' => ['operations-automation', 'multimodal-transport', 'freight-finance'],
        'existing_links' => [['route' => 'solutions.fleet-dispatch-planning', 'label' => 'برنامه‌ریزی دیسپچ ناوگان'], ['route' => 'site.modules.show', 'parameters' => ['module' => 'fleet-dispatch'], 'label' => 'ماژول دیسپچ و تخصیص']],
    ],

    'document-management' => [
        'nav_title' => 'مدیریت اسناد', 'nav_description' => 'نسخه، مهلت، تأیید و آمادگی پرونده', 'eyebrow' => 'Document Management',
        'title' => 'مدیریت اسناد حمل‌ونقل، نسخه و تأیید | سپند',
        'description' => 'راهکار مدیریت اسناد حمل سپند برای اتصال فایل به پرونده، کنترل نسخه و تأیید، چک‌لیست مدارک، مهلت، سطح دسترسی و ردپای ممیزی.',
        'image' => 'modules/screenshots/document-attachment-upload.webp', 'image_alt' => 'بارگذاری واقعی سند در پرونده استعلام سپند',
        'h1' => 'مدیریت اسناد حمل؛ فایل درست، نسخه درست، در زمان درست',
        'lead' => 'سند را از یک فایل بی‌زمینه به رکوردی متصل به مشتری، Shipment، نوع مدرک، نسخه، مسئول، موعد و وضعیت تأیید تبدیل کنید.',
        'problem' => 'نام‌گذاری دستی و ارسال فایل در پیام‌رسان باعث می‌شود نسخه نهایی، مسئول تأیید و کامل‌بودن مدارک در نقطه حساس قابل اتکا نباشد.',
        'boundary' => 'این صفحه راهکار حاکمیت چرخه سند است؛ صفحه ماژول، قابلیت‌های خود محصول را معرفی می‌کند، چک‌لیست اسناد فقط آمادگی پرونده را می‌سنجد و صفحه بارنامه روی HBL/MBL تمرکز دارد.',
        'capabilities' => [['title' => 'سند متصل به پرونده', 'text' => 'فایل با نوع، عنوان، طرف، Shipment و مرحله عملیاتی زمینه‌دار می‌شود.'], ['title' => 'نسخه و Approval', 'text' => 'Draft، اصلاحات، تأیید و نسخه نهایی با تاریخچه نگهداری می‌شوند.'], ['title' => 'Checklist و Deadline', 'text' => 'مدرک الزامی، مسئول آماده‌سازی و مهلت پیش از Gate عملیاتی مشخص‌اند.']],
        'evidence' => [
            ['title' => 'بارگذاری در پرونده', 'text' => 'تصویر واقعی پنجره افزودن فایل و عنوان اختیاری در پرونده استعلام.', 'image' => 'modules/screenshots/document-attachment-upload.webp', 'alt' => 'پنجره واقعی بارگذاری فایل در سپند', 'route' => 'site.modules.show', 'parameters' => ['module' => 'document-management'], 'cta' => 'مشاهده ماژول اسناد'],
            ['title' => 'زمینه عملیاتی سند', 'text' => 'نمای حرکت و پرونده نشان می‌دهد سند در کدام عملیات و زمان استفاده می‌شود.', 'image' => 'modules/screenshots/operations-calendar-list.webp', 'alt' => 'فهرست واقعی عملیات مرتبط با اسناد', 'route' => 'site.modules.show', 'parameters' => ['module' => 'transport-operations'], 'cta' => 'مشاهده پرونده عملیات'],
            ['title' => 'سند مالی متصل', 'text' => 'پیوست و تأییدکننده پرداخت نمونه‌ای از استفاده کنترل‌شده سند در فرایند مالی است.', 'image' => 'modules/screenshots/finance-payment-details.webp', 'alt' => 'جزئیات واقعی سند و تأیید پرداخت', 'route' => 'site.modules.show', 'parameters' => ['module' => 'finance-accounting'], 'cta' => 'مشاهده کنترل اسناد مالی'],
        ],
        'workflow' => [['title' => 'تعریف Taxonomy', 'text' => 'نوع سند و داده الزامی هر نوع استاندارد می‌شود.'], ['title' => 'دریافت و اتصال', 'text' => 'فایل به پرونده، طرف و مرحله درست متصل می‌شود.'], ['title' => 'کنترل نسخه', 'text' => 'ویرایش، دلیل تغییر و نسخه جاری مشخص می‌مانند.'], ['title' => 'تأیید و Gate', 'text' => 'مسئول مجاز سند را تأیید یا برای اصلاح بازمی‌گرداند.'], ['title' => 'آرشیو و بازیابی', 'text' => 'نسخه نهایی با متادیتا و سطح دسترسی قابل جست‌وجو است.']],
        'depth' => [['title' => 'Metadata', 'text' => 'نوع، عنوان، پرونده، طرف، تاریخ و سطح محرمانگی.'], ['title' => 'Version Chain', 'text' => 'شماره نسخه، فایل قبلی، دلیل اصلاح و نسخه جاری.'], ['title' => 'Approval State', 'text' => 'مسئول، وضعیت، زمان و توضیح رد یا تأیید.'], ['title' => 'Readiness Gate', 'text' => 'اقلام اجباری، Deadline و اثر نقص بر مرحله بعد.']],
        'controls' => ['حذف نسخه قبلی جایگزین Versioning نیست.', 'تأییدکننده باید با نوع سند و سطح اختیار هم‌خوان باشد.', 'دسترسی سند محرمانه از دسترسی عمومی پرونده جدا کنترل می‌شود.'],
        'metrics' => ['درصد مدارک کامل پیش از Deadline', 'میانگین زمان Draft تا Approval', 'نرخ بازگشت سند برای اصلاح', 'تعداد استفاده از نسخه منسوخ'],
        'roles' => ['عملیات برای درخواست مدرک', 'واحد اسناد برای نسخه و کنترل', 'مدیر مجاز برای Approval و استثنا'],
        'faqs' => [['q' => 'مدیریت سند با آپلود فایل چه تفاوتی دارد؟', 'a' => 'مدیریت سند علاوه بر فایل، نوع، زمینه پرونده، نسخه، وضعیت تأیید، مسئول، مهلت و تاریخچه را کنترل می‌کند.'], ['q' => 'چک‌لیست اسناد چه نقشی دارد؟', 'a' => 'بر اساس روش حمل و خدمت می‌گوید کدام مدارک لازم‌اند و آیا پرونده برای عبور از مرحله حساس آماده است.'], ['q' => 'آیا بارنامه هم در این دامنه است؟', 'a' => 'بله، اما منطق تخصصی HBL/MBL و House/Master در صفحه مستقل مدیریت بارنامه با جزئیات بیشتری توضیح داده شده است.'], ['q' => 'نسخه نهایی چگونه مشخص می‌شود؟', 'a' => 'زنجیره نسخه و وضعیت Approval نسخه جاری را روشن می‌کند و نسخه‌های قبلی برای ممیزی باقی می‌مانند.']],
        'related' => ['operations-automation', 'multimodal-transport', 'freight-finance'],
        'existing_links' => [['route' => 'solutions.document-readiness', 'label' => 'راهکار آمادگی اسناد'], ['route' => 'solutions.bill-of-lading-management', 'label' => 'مدیریت بارنامه HBL و MBL']],
    ],

    'multimodal-transport' => [
        'nav_title' => 'حمل چندوجهی', 'nav_description' => 'Journey، Leg و Handover بین روش‌ها', 'eyebrow' => 'Multimodal Transport',
        'title' => 'مدیریت حمل‌ونقل چندوجهی، Leg و Handover | سپند',
        'description' => 'مدیریت حمل چندوجهی در سپند با Journey واحد، Legهای هوایی، دریایی، جاده‌ای و ریلی، Handover، زمان، اسناد، هزینه و Tracking.',
        'image' => 'modules/screenshots/operations-calendar-month.webp', 'image_alt' => 'تقویم واقعی مسیرها و حمل‌های چندوجهی سپند',
        'h1' => 'مدیریت حمل چندوجهی؛ یک Journey، چند Leg هماهنگ',
        'lead' => 'مسیر Door-to-Door را به Legهای مرتب تقسیم کنید و زمان، حامل، تجهیز، هزینه، سند و تحویل بین روش‌های حمل را در یک Journey پیوسته نگه دارید.',
        'problem' => 'وقتی هر قطعه مسیر در فایل جدا اداره شود، مسئولیت Handover، اثر تأخیر یک Leg بر اتصال بعدی و ETA نهایی قابل مشاهده نیست.',
        'boundary' => 'این صفحه معماری انتهابه‌انتهای Journey و Handover را توضیح می‌دهد؛ صفحات هوایی، دریایی، جاده‌ای و ریلی جزئیات یک Mode و صفحه Schedule زمان سرویس مشترک را پوشش می‌دهند.',
        'capabilities' => [['title' => 'Transport Leg ترتیبی', 'text' => 'Mode، مبدأ، مقصد، حامل، تجهیز و زمان‌های هر قطعه مستقل ثبت می‌شوند.'], ['title' => 'Handover کنترل‌شده', 'text' => 'آمادگی، تحویل، Issue، زمان و مسئول نقطه تغییر Mode روشن است.'], ['title' => 'اثر انتهابه‌انتها', 'text' => 'تاخیر، هزینه یا کسری سند هر Leg تا ETA و نتیجه کل Journey ردیابی می‌شود.']],
        'evidence' => [
            ['title' => 'تقویم مشترک Journey', 'text' => 'نمای ماهانه واقعی حرکت‌ها برای دیدن وابستگی‌های زمانی مسیر.', 'image' => 'modules/screenshots/operations-calendar-month.webp', 'alt' => 'تقویم واقعی حرکت محموله‌ها در سپند', 'route' => 'site.modules.show', 'parameters' => ['module' => 'transport-operations'], 'cta' => 'مشاهده عملیات حمل'],
            ['title' => 'صف کنترل اتصال‌ها', 'text' => 'نمای فهرستی واقعی برای تمرکز بر حرکت نزدیک، تأخیر و داده ناقص.', 'image' => 'modules/screenshots/operations-calendar-list.webp', 'alt' => 'فهرست واقعی کنترل عملیات چندوجهی', 'route' => 'site.modules.show', 'parameters' => ['module' => 'operations-control-tower'], 'cta' => 'مشاهده برج کنترل'],
            ['title' => 'سند هر قطعه مسیر', 'text' => 'پیوست سند به پرونده کمک می‌کند منشأ کسری یا نسخه در هر Leg روشن بماند.', 'image' => 'modules/screenshots/document-attachment-upload.webp', 'alt' => 'ثبت واقعی سند مسیر در سپند', 'route' => 'site.modules.show', 'parameters' => ['module' => 'document-management'], 'cta' => 'مشاهده اسناد حمل'],
        ],
        'workflow' => [['title' => 'طراحی Journey', 'text' => 'مسیر کلان به قطعات واقعی با Sequence مشخص تقسیم می‌شود.'], ['title' => 'برنامه‌ریزی Leg', 'text' => 'حامل، تجهیز، Schedule و ETD/ETA هر قطعه ثبت می‌شوند.'], ['title' => 'اتصال سند و هزینه', 'text' => 'هر رکورد به Leg سازنده خودش مرتبط می‌شود.'], ['title' => 'کنترل Handover', 'text' => 'آمادگی و تحویل واقعی در نقطه تغییر Mode ثبت می‌شود.'], ['title' => 'بازمحاسبه ETA', 'text' => 'اثر Actual هر Leg بر اتصال و مقصد نهایی مرور می‌شود.']],
        'depth' => [['title' => 'Journey Model', 'text' => 'Shipment، Journey و Legهای مرتب با شناسه پایدار.'], ['title' => 'Leg Context', 'text' => 'Mode، Carrier، Equipment، Route و Schedule.'], ['title' => 'Handover State', 'text' => 'Pending، Ready، Completed یا Issue با زمان و توضیح.'], ['title' => 'Impact Trace', 'text' => 'هزینه، سند، Tracking و تأخیر منتسب به Leg.']],
        'controls' => ['Sequence تکراری یا شکسته پیش از فعال‌شدن Journey اصلاح می‌شود.', 'Completed فقط پس از تحویل واقعی ثبت می‌شود.', 'Actual جایگزین برنامه نیست و برای تحلیل انحراف کنار آن می‌ماند.'],
        'metrics' => ['درصد Handover به‌موقع', 'زمان انتظار بین Legها', 'دقت ETA مقصد نهایی', 'هزینه و تأخیر به تفکیک Leg'],
        'roles' => ['طراح عملیات برای Journey', 'کارشناس هر Mode برای Leg', 'برج کنترل برای اتصال و Handover'],
        'faqs' => [['q' => 'Transport Leg چیست؟', 'a' => 'یک قطعه مستقل مسیر با Mode، مبدأ، مقصد، حامل و بازه زمانی مشخص است؛ چند Leg یک Journey را می‌سازند.'], ['q' => 'Handover چه چیزی را کنترل می‌کند؟', 'a' => 'آمادگی و تحویل واقعی بار میان دو قطعه مسیر را با وضعیت، زمان، مسئول و شرح مغایرت ثبت می‌کند.'], ['q' => 'تأخیر یک Leg چگونه دیده می‌شود؟', 'a' => 'زمان برنامه و Actual مقایسه و اثر آن بر Handover بعدی و ETA مقصد در سطح Journey بررسی می‌شود.'], ['q' => 'آیا هر Leg اسناد و هزینه مستقل دارد؟', 'a' => 'بله؛ اتصال رکورد به Leg باعث می‌شود منشأ زمان، سند و هزینه در مسیر چندوجهی مبهم نماند.']],
        'related' => ['schedule-management', 'fleet-management', 'document-management'],
        'existing_links' => [['route' => 'site.transport-modes.show', 'parameters' => ['mode' => 'sea'], 'label' => 'عملیات تخصصی حمل دریایی'], ['route' => 'site.transport-modes.show', 'parameters' => ['mode' => 'road'], 'label' => 'عملیات تخصصی حمل جاده‌ای']],
    ],

    'schedule-management' => [
        'nav_title' => 'مدیریت برنامه حرکت', 'nav_description' => 'Schedule مرجع، ETD/ETA و Change Log', 'eyebrow' => 'Schedule Management',
        'title' => 'مدیریت Schedule، ETD و ETA حمل‌ونقل | سپند',
        'description' => 'مدیریت برنامه حرکت حمل‌ونقل در سپند؛ Schedule مرجع، ETD و ETA، اتصال Shipment، نسخه تغییر، Flag و تأیید اپراتور برای چهار روش حمل.',
        'image' => 'modules/screenshots/operations-calendar-month.webp', 'image_alt' => 'تقویم واقعی ETD و ETA محموله‌ها در سپند',
        'h1' => 'مدیریت برنامه حرکت؛ یک مرجع برای ETD، ETA و تغییرات',
        'lead' => 'چند Shipment را به Schedule مشترک متصل کنید تا تغییر Carrier یا زمان فقط یک‌بار ثبت، نسخه‌بندی و برای تمام پرونده‌های متاثر قابل بررسی شود.',
        'problem' => 'کپی‌کردن ETD و ETA در پرونده‌های جدا باعث می‌شود یک تغییر فقط در بخشی از عملیات اعمال شود و تیم‌ها با زمان‌های متفاوت کار کنند.',
        'boundary' => 'این صفحه Master Schedule و انتشار تغییر را پوشش می‌دهد؛ Journey و Handover در حمل چندوجهی و Exception ناشی از تأخیر در اتوماسیون عملیات قرار می‌گیرند.',
        'capabilities' => [['title' => 'Schedule مرجع چهار Mode', 'text' => 'Reference، Carrier، مسیر، ETD، ETA، Timezone و Status در یک رکورد نگهداری می‌شوند.'], ['title' => 'Shipment Linking', 'text' => 'پرونده‌های وابسته به منبع زمان مشترک متصل می‌شوند.'], ['title' => 'Version & Acknowledge', 'text' => 'تغییر نسخه می‌سازد، پرونده‌ها را Flag می‌کند و مشاهده اپراتور ثبت می‌شود.']],
        'evidence' => [
            ['title' => 'تقویم ماهانه حرکت', 'text' => 'تصویر واقعی برنامه Shipmentها برای ارزیابی تراکم و حرکت‌های نزدیک.', 'image' => 'modules/screenshots/operations-calendar-month.webp', 'alt' => 'تقویم ماهانه واقعی حرکت در سپند', 'route' => 'site.modules.show', 'parameters' => ['module' => 'transport-operations'], 'cta' => 'مشاهده تقویم عملیات'],
            ['title' => 'نمای فهرستی برنامه', 'text' => 'زمان، هشدار و اطلاعات ناقص در نمای مناسب رسیدگی روزانه دیده می‌شوند.', 'image' => 'modules/screenshots/operations-calendar-list.webp', 'alt' => 'فهرست واقعی برنامه و حرکت سپند', 'route' => 'site.modules.show', 'parameters' => ['module' => 'operations-control-tower'], 'cta' => 'مشاهده برج کنترل'],
            ['title' => 'اعلان اثر تغییر', 'text' => 'مرکز اعلان نمونه واقعی رساندن تغییر نیازمند اقدام به اپراتور است.', 'image' => 'modules/screenshots/workflow-notifications.webp', 'alt' => 'مرکز اعلان واقعی تغییرات برنامه', 'route' => 'site.modules.show', 'parameters' => ['module' => 'workflow-tasks'], 'cta' => 'مشاهده اعلان و وظایف'],
        ],
        'workflow' => [['title' => 'ثبت برنامه مرجع', 'text' => 'منبع، Carrier، مسیر و زمان با Timezone ثبت می‌شوند.'], ['title' => 'اتصال Shipmentها', 'text' => 'فقط پرونده‌های واقعاً وابسته به سرویس لینک می‌شوند.'], ['title' => 'دریافت تغییر معتبر', 'text' => 'زمان یا وضعیت تازه با دلیل روی همان Master اعمال می‌شود.'], ['title' => 'نسخه و Flag', 'text' => 'Change Log ساخته و پرونده‌های متاثر علامت‌گذاری می‌شوند.'], ['title' => 'Acknowledge اثر', 'text' => 'اپراتور اثر تغییر بر مشتری، Handover و ETA را بررسی می‌کند.']],
        'depth' => [['title' => 'Schedule Master', 'text' => 'Mode، Reference، Carrier، Route، Timezone و Status.'], ['title' => 'Time Model', 'text' => 'ETD/ETA برنامه‌ای، تخمینی و Actual با معنای جدا.'], ['title' => 'Dependency Map', 'text' => 'Shipmentها و Legهایی که از برنامه اثر می‌گیرند.'], ['title' => 'Change Control', 'text' => 'Version، Change Set، کاربر، Flag و Acknowledgement.']],
        'controls' => ['Schedule بدون لینک، زمان پرونده را تغییر نمی‌دهد.', 'Acknowledge یعنی تغییر دیده شده، نه اینکه بدون اثر است.', 'Reference همراه Carrier، مسیر و تاریخ کنترل می‌شود.'],
        'metrics' => ['درصد برنامه‌های تغییرکرده', 'زمان تغییر تا Acknowledge', 'تعداد Shipment متاثر از هر تغییر', 'دقت ETA برنامه در برابر Actual'],
        'roles' => ['برنامه‌ریز حمل برای Master', 'کارشناس پرونده برای Link و اثرسنجی', 'برج کنترل برای تأخیر و تغییر'],
        'faqs' => [['q' => 'چرا Schedule از Shipment جداست؟', 'a' => 'چون چند Shipment ممکن است از یک سرویس مشترک استفاده کنند و Master واحد از اختلاف زمان بین پرونده‌ها جلوگیری می‌کند.'], ['q' => 'ویرایش Schedule چه اثری دارد؟', 'a' => 'نسخه و Change Log تازه می‌سازد و پرونده‌های متصل را برای بررسی اثر تغییر Flag می‌کند.'], ['q' => 'ETD، ETA و Actual چه تفاوتی دارند؟', 'a' => 'ETD زمان انتظار خروج و ETA زمان انتظار ورود است؛ Actualها پس از وقوع واقعی رویداد جدا ثبت می‌شوند.'], ['q' => 'Schedule با Voyage یکی است؟', 'a' => 'خیر؛ Schedule مرجع زمان سرویس است و Voyage سفر یک Vessel و توالی Port Callها را مدل می‌کند.']],
        'related' => ['multimodal-transport', 'operations-automation', 'container-nvocc'],
        'existing_links' => [['route' => 'solutions.shipment-visibility', 'label' => 'دیدپذیری زمان و وضعیت حمل'], ['route' => 'site.modules.show', 'parameters' => ['module' => 'operations-control-tower'], 'label' => 'برج کنترل عملیات']],
    ],

    'rate-management' => [
        'nav_title' => 'مدیریت نرخ و تعرفه', 'nav_description' => 'Rate Master، Break و هزینه جانبی', 'eyebrow' => 'Rate Management',
        'title' => 'مدیریت نرخ و تعرفه حمل‌ونقل و Rate Break | سپند',
        'description' => 'مدیریت نرخ و تعرفه حمل‌ونقل در سپند؛ نرخ مسیر و تأمین‌کننده، اعتبار زمانی، Rate Break، Minimum Charge و هزینه اجباری برای چهار Mode.',
        'image' => 'modules/screenshots/pricing-supplier-comparison.webp', 'image_alt' => 'مقایسه واقعی نرخ تأمین‌کنندگان حمل در سپند',
        'h1' => 'مدیریت نرخ حمل؛ محاسبه یکسان، معتبر و قابل ردیابی',
        'lead' => 'نرخ پایه، واحد، بازه اعتبار، شکست مقداری و هزینه‌های جانبی را در Tariff ساختاریافته نگه دارید تا شرایط یکسان به نتیجه قابل تکرار برسد.',
        'problem' => 'نرخ پراکنده در فایل و پیام باعث استفاده از تعرفه منقضی، حذف Charge اجباری، انتخاب Unit اشتباه و اختلاف پیشنهاد کارشناسان می‌شود.',
        'boundary' => 'این صفحه Rate Master و منطق محاسبه را پوشش می‌دهد؛ ماژول نرخ‌دهی جریان استعلام تا پیشنهاد را معرفی می‌کند و Freight Finance هزینه واقعی و Margin نهایی را می‌سنجد.',
        'capabilities' => [['title' => 'Rate Master مسیرمحور', 'text' => 'Mode، Supplier، مسیر، Service، Equipment، Currency و اعتبار نگهداری می‌شوند.'], ['title' => 'Rate Break & Minimum', 'text' => 'پلکان مقدار یا وزن و کف مبلغ قرارداد کنترل می‌شوند.'], ['title' => 'Additional Charges', 'text' => 'هزینه ثابت، درصدی یا واحدی با Mandatory بودن در Breakdown می‌آید.']],
        'evidence' => [
            ['title' => 'مقایسه تأمین‌کنندگان', 'text' => 'شاهد واقعی مقایسه نرخ خرید، Transit Time، اعتبار و سابقه عملکرد.', 'image' => 'modules/screenshots/pricing-supplier-comparison.webp', 'alt' => 'مقایسه واقعی تأمین‌کنندگان در سپند', 'route' => 'site.modules.show', 'parameters' => ['module' => 'pricing-sales'], 'cta' => 'مشاهده مقایسه نرخ'],
            ['title' => 'پیشنهادهای مشابه', 'text' => 'نرخ‌های پیشنهادی مشابه و سابقه تصمیم در پرونده استعلام دیده می‌شوند.', 'image' => 'modules/screenshots/pricing-proposed-rates.webp', 'alt' => 'نرخ‌های پیشنهادی واقعی در سپند', 'route' => 'site.modules.show', 'parameters' => ['module' => 'pricing-sales'], 'cta' => 'مشاهده نرخ پیشنهادی'],
            ['title' => 'جریان فروش نرخ', 'text' => 'برد واقعی استعلام، پیشنهاد، تأیید مشتری و تبدیل به Booking.', 'image' => 'modules/screenshots/pricing-sales-workflow.webp', 'alt' => 'جریان واقعی نرخ‌دهی و فروش سپند', 'route' => 'solutions.freight-sales-automation', 'cta' => 'مشاهده اتوماسیون فروش'],
        ],
        'workflow' => [['title' => 'تعریف دامنه Tariff', 'text' => 'Mode، Supplier، Route، Service و دوره اعتبار مشخص می‌شوند.'], ['title' => 'ثبت مبنای قیمت', 'text' => 'Currency، Unit، Base Rate و Minimum Charge ثبت می‌شوند.'], ['title' => 'ساخت Rate Break', 'text' => 'بازه‌ها بدون فاصله یا هم‌پوشانی مرتب می‌شوند.'], ['title' => 'افزودن Charge', 'text' => 'هزینه‌های جانبی و Mandatory بودن آن‌ها تعیین می‌شود.'], ['title' => 'محاسبه و کنترل', 'text' => 'Tariff منطبق پیدا و Breakdown پیش از پیشنهاد بازبینی می‌شود.']],
        'depth' => [['title' => 'Matching Keys', 'text' => 'Mode، Supplier، Origin، Destination، Service و Equipment.'], ['title' => 'Price Basis', 'text' => 'Currency، Unit، Quantity، Weight و Minimum Charge.'], ['title' => 'Break Structure', 'text' => 'حداقل، حداکثر و Unit Price هر پلکان.'], ['title' => 'Cost Composition', 'text' => 'Chargeهای اجباری و اختیاری با روش محاسبه مستقل.']],
        'controls' => ['تاریخ محاسبه باید داخل بازه اعتبار Tariff باشد.', 'Rate Break هم‌پوشان پیش از فعال‌سازی رد می‌شود.', 'Currency و Unit همیشه همراه مبلغ نمایش داده می‌شوند.'],
        'metrics' => ['درصد استفاده از نرخ معتبر', 'زمان درخواست تا پیشنهاد', 'نرخ Override دستی Tariff', 'اختلاف نرخ پیشنهادی تا هزینه Actual'],
        'roles' => ['Pricing برای Rate Master', 'فروش برای محاسبه پیشنهاد', 'مدیر تجاری برای اعتبار و Approval'],
        'faqs' => [['q' => 'Rate Break چیست؟', 'a' => 'پلکان قیمت برای بازه‌های مختلف مقدار یا وزن است و هر بازه حداقل، حداکثر و قیمت واحد خودش را دارد.'], ['q' => 'Minimum Charge چه زمانی اعمال می‌شود؟', 'a' => 'وقتی حاصل مقدار و قیمت واحد از کف قراردادی کمتر باشد، حداقل مبلغ تعریف‌شده اعمال می‌شود.'], ['q' => 'هزینه جانبی چگونه وارد محاسبه می‌شود؟', 'a' => 'هر Charge روش محاسبه، Currency، Unit و Mandatory بودن دارد و در Breakdown جدا نمایش داده می‌شود.'], ['q' => 'مدیریت نرخ با Freight Finance چه تفاوتی دارد؟', 'a' => 'مدیریت نرخ قیمت پیشنهادی را می‌سازد؛ Freight Finance هزینه تعهدی و واقعی و Margin نهایی Job را کنترل می‌کند.']],
        'related' => ['freight-finance', 'schedule-management', 'multimodal-transport'],
        'existing_links' => [['route' => 'site.modules.show', 'parameters' => ['module' => 'pricing-sales'], 'label' => 'ماژول نرخ‌دهی و فروش'], ['route' => 'solutions.freight-sales-automation', 'label' => 'اتوماسیون فروش حمل']],
    ],
];

$priorityPages = require __DIR__.'/site_priority_solutions.php';
$pages = array_merge($pages, $priorityPages);

$pages['operations-automation']['evidence'] = [
    ['title' => 'Rule Builder واقعی عملیات', 'text' => 'چهار Template حمل هوایی، دریایی، جاده‌ای و ریلی و نقطه شروع ساخت Rule سفارشی در محیط واقعی.', 'image' => 'live/control-center-rules.png', 'alt' => 'Rule Builder واقعی مرکز کنترل عملیات سپند', 'route' => 'solutions.platform.show', 'parameters' => ['solution' => 'operations-automation'], 'cta' => 'دیدن چرخه Rule تا Exception'],
    ['title' => 'Exception Workbench واقعی', 'text' => 'صف رسیدگی Exception با وضعیت جاری Tenant؛ نبود Exception فعال نیز صادقانه در همین تصویر مشخص است.', 'image' => 'live/control-center-exceptions.png', 'alt' => 'Exception Workbench واقعی مرکز کنترل عملیات سپند', 'route' => 'solutions.operation-exception-management', 'cta' => 'بررسی مدیریت استثنا'],
    ['title' => 'داشبورد عملیاتی واقعی', 'text' => 'شاخص‌های جاری لید، مشتری، استعلام، Booking و پیگیری‌های نیازمند اقدام در یک نمای مدیریتی.', 'image' => 'live/operations-dashboard.png', 'alt' => 'داشبورد واقعی عملیات و پیگیری سپند', 'route' => 'solutions.shipment-visibility', 'cta' => 'مشاهده دیدپذیری عملیات'],
];
$pages['operations-automation']['demo'] = [
    'title' => 'دموی واقعی چرخه Rule تا Exception',
    'intro' => 'این سناریو با نماهای ثبت‌شده از استقرار واقعی سپند، مرز میان تعریف کنترل، ساخت Exception و رسیدگی انسانی را مرحله‌به‌مرحله نشان می‌دهد.',
    'note' => 'وضعیت داده‌ها متعلق به لحظه ثبت تصویر است؛ در Tenant بررسی‌شده هنوز Rule فعال و Exception باز ثبت نشده بود.',
    'steps' => [
        ['label' => '۱. تعریف کنترل', 'title' => 'انتخاب Template یا Rule سفارشی', 'text' => 'شرط، آستانه، Severity، مسئول، Due و Escalation تعریف می‌شوند.', 'image' => 'live/control-center-rules.png', 'alt' => 'مرحله تعریف Rule در مرکز کنترل سپند'],
        ['label' => '۲. تشخیص انحراف', 'title' => 'ساخت Exception یکتا', 'text' => 'انطباق داده عملیاتی با Rule به Exception متصل به پرونده تبدیل می‌شود.', 'image' => 'live/control-center-exceptions.png', 'alt' => 'مرحله ایجاد Exception در مرکز کنترل سپند'],
        ['label' => '۳. اقدام و سنجش', 'title' => 'رسیدگی، بستن و مرور KPI', 'text' => 'مالک اقدام نتیجه را ثبت می‌کند و زمان پاسخ و موارد تکراری در داشبورد بررسی می‌شوند.', 'image' => 'live/operations-dashboard.png', 'alt' => 'مرحله پایش نتیجه در داشبورد واقعی سپند'],
    ],
];

$pages['fleet-management']['evidence'][0] = ['title' => 'کنترل واقعی ناوگان و Compliance', 'text' => 'نمای واقعی کنترل خودرو، راننده، آمادگی مدارک و جلوگیری از تخصیص ناسازگار.', 'image' => 'live/fleet-compliance-control.png', 'alt' => 'کنترل واقعی ناوگان و Compliance در سپند', 'route' => 'solutions.fleet-dispatch-planning', 'cta' => 'مشاهده برنامه‌ریزی اعزام'];
$pages['rate-management']['evidence'][0] = ['title' => 'مدیریت واقعی Rate Master', 'text' => 'نمای واقعی تعرفه‌های ساختاریافته برای کنترل دامنه، اعتبار و مبنای محاسبه.', 'image' => 'live/rate-management.png', 'alt' => 'صفحه واقعی مدیریت نرخ و تعرفه سپند', 'route' => 'solutions.platform.show', 'parameters' => ['solution' => 'rate-management'], 'cta' => 'مرور منطق Rate Break'];

$overrides = require __DIR__.'/site_seo_overrides.php';
$pages = array_replace_recursive($pages, $overrides['platform_pages']);

foreach ($overrides['platform_pages'] as $slug => $override) {
    foreach (['capabilities', 'evidence', 'workflow', 'depth', 'controls', 'metrics', 'roles', 'faqs', 'related', 'existing_links'] as $listKey) {
        if (array_key_exists($listKey, $override)) {
            $pages[$slug][$listKey] = $override[$listKey];
        }
    }
}

unset($pages['container-nvocc']);

foreach ($pages as &$platformPage) {
    $platformPage['related'] = array_values(array_filter(
        $platformPage['related'],
        static fn (string $relatedSlug): bool => isset($pages[$relatedSlug])
    ));
}
unset($platformPage);

foreach ($pages as $slug => &$page) {
    $page['slug'] = $slug;
    $page['route'] = 'solutions.platform.show';
}
unset($page);

return [
    'updated_at' => '2026-09-06',
    'pages' => $pages,
    'hub' => [
        'categories' => [
            'all' => ['label' => 'همه راهکارها', 'description' => 'نمای کامل راهکارهای پلتفرمی سپند'],
            'operations' => ['label' => 'عملیات و کنترل', 'description' => 'هشدار، برنامه حرکت و اقدام روزانه'],
            'commercial' => ['label' => 'تجاری و مالی', 'description' => 'نرخ، هزینه، درآمد و سود پرونده'],
            'assets' => ['label' => 'ناوگان و تجهیزات', 'description' => 'خودرو، راننده، کانتینر و تعهدات'],
            'network' => ['label' => 'شبکه حمل', 'description' => 'هماهنگی مسیرها و روش‌های حمل'],
            'documents' => ['label' => 'اسناد و انطباق', 'description' => 'نسخه، مهلت، تأیید و آمادگی سند'],
            'governance' => ['label' => 'امنیت و حاکمیت', 'description' => 'فضای کاری، نقش، مجوز و ممیزی'],
        ],
        'solution_meta' => [
            'operations-automation' => [
                'category' => 'operations',
                'problem' => 'هشدارها دیده می‌شوند، اما به اقدام مسئول‌دار تبدیل نمی‌شوند.',
                'outcome' => 'Rule، اولویت، مسئول، موعد و Escalation در یک چرخه قابل پیگیری.',
            ],
            'freight-finance' => [
                'category' => 'commercial',
                'problem' => 'هزینه واقعی دیر می‌رسد و سود پرونده قابل اتکا نیست.',
                'outcome' => 'Accrual، ارز، تطبیق و Margin واقعی در سطح Booking یا Job.',
            ],
            'fleet-management' => [
                'category' => 'assets',
                'problem' => 'اعزام بدون تصویر کامل ظرفیت، سرویس و اعتبار مدارک انجام می‌شود.',
                'outcome' => 'آمادگی خودرو و راننده پیش از تخصیص و دیسپچ کنترل می‌شود.',
            ],
            'document-management' => [
                'category' => 'documents',
                'problem' => 'نسخه نهایی، مسئول تأیید یا کامل‌بودن مدارک روشن نیست.',
                'outcome' => 'سند درست با نسخه، مهلت، دسترسی و سابقه کنترل‌شده.',
            ],
            'multimodal-transport' => [
                'category' => 'network',
                'problem' => 'هر قطعه مسیر جدا اداره می‌شود و Handoverها قابل مشاهده نیستند.',
                'outcome' => 'یک Journey مرجع با Legها، اتصال‌ها، ETA و مسئول تحویل.',
            ],
            'schedule-management' => [
                'category' => 'operations',
                'problem' => 'ETD و ETA در نسخه‌های مختلف ثبت می‌شوند و تغییر دیر منتقل می‌شود.',
                'outcome' => 'Schedule مرجع، Change Log و اثر تغییر روی پرونده‌های مرتبط.',
            ],
            'rate-management' => [
                'category' => 'commercial',
                'problem' => 'نرخ منقضی یا هزینه جانبی ناقص، پیشنهاد فروش را پرریسک می‌کند.',
                'outcome' => 'Rate Master، شکست مقداری، اعتبار و Breakdown قابل ردیابی.',
            ],
            'security-access-management' => [
                'category' => 'governance',
                'problem' => 'دامنه سازمانی و اختیار هر نقش روشن یا قابل ممیزی نیست.',
                'outcome' => 'Workspace فعال، نقش، مجوز منویی و ردپای تغییر حساس.',
            ],
            'payment-workflow' => [
                'category' => 'commercial',
                'problem' => 'درخواست، تأیید و پرداخت در کانال‌های جدا نگهداری می‌شوند.',
                'outcome' => 'یک زنجیره قابل ردیابی از درخواست تا مرجع بانکی پرداخت.',
            ],
            'booking-reconciliation' => [
                'category' => 'commercial',
                'problem' => 'دریافت ثبت شده اما مصرف آن در Booking و مانده واقعی روشن نیست.',
                'outcome' => 'Receipt، Allocation، تبدیل ارز و مانده در سطح Booking.',
            ],
            'supplier-management' => [
                'category' => 'commercial',
                'problem' => 'هویت و نرخ تأمین‌کننده تکراری است و انتخاب فقط با مبلغ انجام می‌شود.',
                'outcome' => 'Supplier Master یکتا و مقایسه نرخ، زمان و سابقه اجرا.',
            ],
        ],
        'journey' => [
            ['number' => '۰۱', 'eyebrow' => 'Commercial', 'title' => 'درخواست و نرخ', 'text' => 'استعلام را با نرخ معتبر، هزینه‌های جانبی و منطق محاسبه شروع کنید.', 'solutions' => ['rate-management']],
            ['number' => '۰۲', 'eyebrow' => 'Planning', 'title' => 'مسیر و برنامه', 'text' => 'Journey، Leg، ETD و ETA را پیش از اجرا روی یک برنامه مرجع هماهنگ کنید.', 'solutions' => ['schedule-management', 'multimodal-transport']],
            ['number' => '۰۳', 'eyebrow' => 'Execution', 'title' => 'اجرا و استثنا', 'text' => 'رخدادهای مهم را به هشدار، مسئول، موعد و اقدام قابل سنجش تبدیل کنید.', 'solutions' => ['operations-automation']],
            ['number' => '۰۴', 'eyebrow' => 'Resources', 'title' => 'دارایی و ظرفیت', 'text' => 'آمادگی خودرو و راننده را در Master ناوگان کنترل و چرخه کانتینر را در صفحه تخصصی مدیریت کانتینر بررسی کنید.', 'solutions' => ['fleet-management']],
            ['number' => '۰۵', 'eyebrow' => 'Compliance', 'title' => 'سند و آمادگی', 'text' => 'نسخه و کامل‌بودن مدارک را در همان نقطه عملیاتی بررسی کنید.', 'solutions' => ['document-management']],
            ['number' => '۰۶', 'eyebrow' => 'Outcome', 'title' => 'مالی و سود واقعی', 'text' => 'هزینه تعهدی و واقعی را با درآمد و نرخ ارز همان پرونده تطبیق دهید.', 'solutions' => ['freight-finance']],
        ],
        'evidence' => [
            ['eyebrow' => 'Daily Control', 'title' => 'صف روزانه عملیات و هشدار', 'description' => 'حرکت‌های نزدیک، اطلاعات ناقص و موارد نیازمند توجه در یک نمای اجرایی دیده می‌شوند.', 'image' => 'modules/screenshots/operations-calendar-list.webp', 'alt' => 'نمای واقعی فهرست کنترل عملیات در نرم‌افزار سپند', 'route' => 'solutions.platform.show', 'parameters' => ['solution' => 'operations-automation']],
            ['eyebrow' => 'Commercial Control', 'title' => 'مقایسه نرخ تأمین‌کنندگان', 'description' => 'نرخ خرید، زمان حمل، اعتبار پیشنهاد و سابقه عملکرد برای تصمیم تجاری کنار هم قرار می‌گیرند.', 'image' => 'modules/screenshots/pricing-supplier-comparison.webp', 'alt' => 'نمای واقعی مقایسه نرخ تأمین‌کنندگان در سپند', 'route' => 'solutions.platform.show', 'parameters' => ['solution' => 'rate-management']],
            ['eyebrow' => 'Document Context', 'title' => 'سند در متن همان پرونده', 'description' => 'فایل با عنوان و زمینه عملیاتی ثبت می‌شود تا از Shipment، Booking یا اقدام مربوط جدا نماند.', 'image' => 'modules/screenshots/document-attachment-upload.webp', 'alt' => 'نمای واقعی ثبت سند در پرونده سپند', 'route' => 'solutions.platform.show', 'parameters' => ['solution' => 'document-management']],
            ['eyebrow' => 'Financial Outcome', 'title' => 'تطبیق مالی در سطح Booking', 'description' => 'دریافت، پرداخت و تبدیل ارز به پرونده متصل می‌مانند تا نتیجه مالی قابل ردیابی باشد.', 'image' => 'modules/screenshots/finance-booking-reconciliation.webp', 'alt' => 'نمای واقعی تطبیق مالی Booking در سپند', 'route' => 'solutions.platform.show', 'parameters' => ['solution' => 'freight-finance']],
        ],
        'specialized_groups' => [
            ['title' => 'کنترل و حاکمیت عملیات', 'description' => 'برای دیدپذیری، Exception، آمادگی و تصمیم مدیریتی.', 'routes' => ['solutions.shipment-visibility', 'solutions.operation-exception-management', 'solutions.transport-governance', 'solutions.document-readiness', 'solutions.fleet-dispatch-planning']],
            ['title' => 'دریایی، کانتینر و اسناد', 'description' => 'برای سناریوهای عمیق‌تر عملیات دریایی و تجهیزات.', 'routes' => ['solutions.nvocc', 'solutions.container-management', 'solutions.bill-of-lading-management']],
            ['title' => 'فروش و استقرار', 'description' => 'برای جریان تجاری یا الزامات زیرساخت سازمان.', 'routes' => ['solutions.freight-sales-automation', 'solutions.on-premise']],
        ],
    ],
];
