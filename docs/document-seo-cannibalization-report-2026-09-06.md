# گزارش رفع Cannibalization کلاستر Documents سپند

تاریخ: 2026-09-06

## نتیجه

هر پنج URL کلاستر اسناد مستقل و Indexable نگه داشته شدند. میان این صفحات Redirect یا Cross-canonical وجود ندارد. مالکیت موضوعی به شکل زیر است:

| URL | Primary Keyword | دامنه محتوا |
| --- | --- | --- |
| `/modules/document-management` | نرم افزار مدیریت اسناد حمل و نقل | Repository، بارگذاری و دریافت، Metadata، جست‌وجو، ارتباط با پرونده، دسترسی و آرشیو |
| `/solutions/document-management` | چرخه تأیید اسناد حمل | Draft، Review، Reject/Revision، نسخه جدید، Approval، Final و Audit |
| `/solutions/document-readiness` | کنترل آماده بودن مدارک حمل | کامل یا ناقص‌بودن مجموعه مدارک پیش از Gate عملیاتی |
| `/solutions/bill-of-lading-management` | نرم افزار مدیریت بارنامه HBL و MBL | HBL، MBL، Draft BL، Revision و House/Master |
| `/modules/document-checklists` | چک لیست مدارک حمل | طراحی Template اقلام موردنیاز بر اساس Mode، Service و Milestone |

## Title و H1 قبل و بعد

| URL | Title قبلی | Title جدید | H1 قبلی | H1 جدید |
| --- | --- | --- | --- | --- |
| `/modules/document-management` | نرم‌افزار مدیریت اسناد حمل‌ونقل \| سپند | نرم افزار مدیریت اسناد حمل‌ونقل و فورواردری \| سپند | نرم‌افزار مدیریت اسناد حمل‌ونقل سپند | نرم افزار مدیریت اسناد حمل‌ونقل برای شرکت‌های فورواردری |
| `/solutions/document-management` | گردش تأیید و کنترل چرخه عمر اسناد حمل \| سپند | چرخه تأیید اسناد حمل \| Draft، Approval و Version Control \| سپند | چرخه عمر و تأیید سند حمل؛ از Draft تا نسخه نهایی | چرخه تأیید اسناد حمل را از Draft تا نسخه نهایی کنترل کنید |
| `/solutions/document-readiness` | آمادگی اسناد حمل؛ چک‌لیست و کنترل عبور پرونده \| سپند | کنترل آماده بودن مدارک حمل پیش از عملیات \| سپند | آمادگی اسناد حمل؛ پرونده کامل پیش از نقطه حساس | آماده بودن مدارک حمل را پیش از مرحله حساس کنترل کنید |
| `/solutions/bill-of-lading-management` | نرم‌افزار مدیریت بارنامه حمل \| HBL و MBL | نرم افزار مدیریت بارنامه HBL و MBL \| سپند | بارنامه را از پیش‌نویس تا تأیید و آرشیو در پرونده حمل کنترل کنید | بارنامه‌های HBL و MBL را در ارتباط با Booking کنترل کنید |
| `/modules/document-checklists` | چک‌لیست استاندارد اسناد حمل‌ونقل \| سپند | چک لیست مدارک حمل برای هر روش و خدمت \| سپند | چک‌لیست استاندارد اسناد حمل سپند | چک لیست مدارک حمل برای هر روش و خدمت |

## لینک‌های داخلی

- ماژول اسناد به «چرخه تأیید و بازبینی اسناد»، «کنترل آماده بودن مجموعه مدارک» و «مدیریت تخصصی بارنامه HBL و MBL» لینک می‌دهد.
- چرخه تأیید با Anchor دقیق «نرم افزار مدیریت اسناد حمل‌ونقل» به ماژول اصلی و با Anchor مستقل به Readiness و Operations Automation لینک می‌دهد.
- Readiness فقط در زمینه Draft موجود اما بازبینی‌نشده به «چرخه بازبینی و تأیید Draft» لینک می‌دهد.
- صفحه بارنامه در بخش‌های Draft، Revision و Approval به «گردش تأیید Draft بارنامه» و «فرایند تأیید و اصلاح بارنامه» لینک می‌دهد.
- Checklist به Readiness و مخزن فایل‌های پرونده حمل لینک می‌دهد.

## Canonical، Redirect و Indexability

| URL | Canonical | وضعیت |
| --- | --- | --- |
| `/modules/document-management` | Self-canonical | `index,follow`؛ Sitemap |
| `/solutions/document-management` | Self-canonical | `index,follow`؛ Sitemap |
| `/solutions/document-readiness` | Self-canonical | `index,follow`؛ Sitemap |
| `/solutions/bill-of-lading-management` | Self-canonical | `index,follow`؛ Sitemap |
| `/modules/document-checklists` | Self-canonical | `index,follow`؛ Sitemap |

Redirect کلاستر Documents: هیچ‌کدام. Redirect قبلی Checklist به Readiness حذف شد.

## اعتبارسنجی فنی

- تست‌های هدفمند کلاستر، متادیتا، صفحات Solution، Screenshot Gallery و Query Ownership: **30 تست و 2067 Assertion؛ همگی موفق**.
- Syntax هر 15 فایل PHP/Blade تغییرکرده با `php -l` کنترل شد و خطایی ندارد.
- `git diff --check` خطای whitespace ندارد؛ هشدارهای نمایش‌داده‌شده فقط مربوط به سیاست CRLF محیط ویندوز است.
- اجرای کل Test Suite به خطاهای خارج از محدوده این تغییرات رسید: دیتابیس تست `laravel` روی محیط حاضر ساخته نشده و چند تست قدیمی همچنان متن/CSS نسخه‌های قبلی صفحات دیگر را انتظار دارند. این موارد در تست‌های هدفمند Documents تکرار نشدند.

## شواهد محصول و محدودیت ادعا

- پنجره واقعی افزودن فایل و عنوان اختیاری، قابلیت بارگذاری پیوست در پرونده را تأیید می‌کند.
- Checklist Designer در محیط عملیاتی مشاهده شد: Mode، Service، Document Type، Milestone، Assignee، Deadline، Dependency، Warning/Block، Required، Evidence، Customer Visibility و Active.
- تصویر مستقلی که Version Chain و تصمیم Approve/Reject سند را اثبات کند در دارایی‌های فعلی سایت وجود نداشت. به همین دلیل صفحه Approval این موارد را به‌عنوان نیاز فرایندی و موضوع قابل اعتبارسنجی در دمو معرفی می‌کند، نه قابلیت قطعی محصول.
- شاهد Rule Builder و اعلان وظیفه فقط به‌عنوان قابلیت مرتبط نمایش داده شده و متن صفحه صریحاً اتصال اختصاصی آن به Approval سند را نیازمند تأیید می‌داند.

## مشکلات کشف‌شده و اصلاح‌شده

- Redirect اشتباه `/modules/document-checklists` باعث حذف یک قابلیت مستقل و واقعی از Index و Sitemap شده بود؛ حذف شد.
- Readiness دو کارت تقریباً تکراری برای «مدیریت فایل» داشت؛ با چهار جزء مستقل Checklist، Repository، HBL/MBL و Gate جایگزین شد.
- Templateهای Solution عبارت‌های داخلی مانند «مرزبندی نیت جست‌وجو» و «جلوگیری از تکرار محتوا» را در UI نشان می‌دادند؛ با متن طبیعی کاربرمحور جایگزین شدند.
- Structured Data صفحات Module فاقد `WebPage` بود؛ `WebPage` با ارتباط به `BreadcrumbList`، `SoftwareApplication` و FAQ واقعی اضافه شد.
- تصویر Checklist فعلی نمای بارگذاری فایل است و خود Checklist Designer را نشان نمی‌دهد؛ بنابراین Caption نباید به‌عنوان اثبات کامل Designer تفسیر شود. تهیه Screenshot اختصاصی Checklist برای دور بعد توصیه می‌شود.
- در رگرسیون صفحات مرتبط، صفحه حمل جاده‌ای به‌دلیل نبود داده `workflow` خطای 500 می‌داد؛ ساختار فرایند پنج‌مرحله‌ای آن تکمیل شد.

## فایل‌های تغییر یافته

- `config/site_seo_strategy.php`
- `config/site_seo_overrides.php`
- `config/site_module_pages.php`
- `config/site_content_pages.php`
- `config/site_operational_modules.php`
- `config/site_operational_solutions.php`
- `config/site_transport_modes.php`
- `resources/views/marketing/module-detail.blade.php`
- `resources/views/marketing/platform-solutions/show.blade.php`
- `resources/views/marketing/content-page.blade.php`
- `tests/Feature/DocumentSeoClusterTest.php`
- `tests/Feature/MarketingSeoTest.php`
- `tests/Feature/PlatformSolutionPagesTest.php`
- `tests/Feature/MarketingContentPagesTest.php`
- `tests/Feature/ModuleScreenshotGalleryTest.php`
- `docs/seo-cluster-ownership-2026-09-06.md`
