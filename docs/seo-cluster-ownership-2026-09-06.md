# نقشه مالکیت کلاسترهای SEO سپند

آخرین به‌روزرسانی: ۱۴۰۵/۰۶/۱۵ — 2026-09-06

## نتیجه اجرایی

- ۹ کلاستر P0/P1 با ۳۳ URL یکتای Indexable و ۳۳ Query اصلی یکتا تعریف شد.
- مالک هر Query، Intent، مخاطب و Outcome در `config/site_seo_strategy.php` ثبت شده است تا ساخت صفحه جدید دوباره Cannibalization ایجاد نکند.
- Title، H1 و Meta Description صفحات هم‌کلاستر مستقل شده‌اند.
- لینک‌های داخلی به URLهای Primary منتقل و URLهای Merge شده از Sitemap و مجموعه‌های Indexable حذف شده‌اند.
- صفحه `/solutions` هاب راهکارهاست و صفحه `/compare` فقط هاب مقایسه و انتخاب است.

## تصمیم URLهای هم‌پوشان

| URL قدیمی | مقصد Primary | تصمیم |
| --- | --- | --- |
| `/modules/operational-control-center` | `/solutions/operation-exception-management` | Merge روی گردش رسیدگی، مالکیت و بستن Exception |
| `/modules/enterprise-command-center` | `/solutions/transport-governance` | Merge روی سیاست، اختیار و تصمیم بین‌واحدی |
| `/solutions/container-nvocc` | `/solutions/container-management` | حذف Intent ترکیبی و انتقال به مالک Container Master/Depot/Lease/Utilization |

سه انتقال باقی‌مانده 301، مستقیم و بدون زنجیره هستند. مقصدها Self-canonical دارند و URLهای قدیمی در Sitemap یا لینک داخلی باقی نمی‌مانند. `/modules/document-checklists` به‌دلیل قابلیت مستقل و واقعی Checklist Designer از فهرست انتقال‌ها خارج و به‌عنوان صفحه Indexable با مالکیت «چک لیست مدارک حمل» حفظ شد.

## مرزبندی کلاسترها

| کلاستر | Pillar | مرز صفحات Child |
| --- | --- | --- |
| Operations — P0 | `/modules/transport-operations` | Tower=پایش و تصمیم شیفت؛ Automation=Rule/Trigger/Escalation؛ Visibility=Status/Milestone؛ Exception=Resolve Workflow؛ Governance=Policy/Authority |
| Documents — P0 | `/modules/document-management` | Module=Repository/فایل/دسترسی؛ Solution Document=Draft/Review/Approval/Version؛ Readiness=کامل‌بودن مجموعه مدارک/Gate؛ BL=HBL/MBL؛ Checklist=تعریف اقلام موردنیاز |
| Container & NVOCC — P0 | `/solutions/nvocc` | NVOCC=مدل کسب‌وکار؛ Container=Master/Depot/Lease/Utilization؛ Sea=عملیات روش حمل دریایی |
| Fleet — P1 | `/solutions/fleet-management` | Management=Asset/Driver/Compliance/Availability؛ Dispatch=اجرای مأموریت؛ Planning=ظرفیت و تداخل پیش از اجرا |
| Finance — P1 | `/modules/finance-accounting` | Module=محصول مالی؛ Freight Finance=Accrual/Variance/Margin؛ Payment=Approval/Execution؛ Compare=انتخاب بازار |
| CRM & Sales — P1 | `/modules/crm` | CRM=Relationship/Pipeline؛ Pricing=Inquiry تا Quotation؛ Rate=Repository/Break/Charge؛ Sales Automation=Follow-up/SLA/Handoff؛ Compare=انتخاب CRM |
| Visibility & Portal — P1 | `/modules/customer-portal-tracking` | Portal=سلف‌سرویس بیرونی OTP؛ Visibility=وضعیت داخلی؛ Tower=پایش و تصمیم شیفت |
| Automation — P1 | `/modules/workflow-tasks` | Workflow=کار انسانی؛ Automatic Task=یک Event تا Task؛ Operations Automation=Rule چندمرحله‌ای تا Exception |
| Compare — P1 | `/compare` | Hub=مسیریابی؛ Category=مقایسه معماری‌ها؛ General Best=چارچوب انتخاب عمومی؛ Freight Best=انتخاب تخصصی فورواردری |

## شواهد محصول و KPI

- اسکرین‌های واقعی محیط عملیاتی برای Control Tower، Rule تا Exception، امنیت، پرداخت، Booking Reconciliation، پرتال OTP، کانتینر، ناوگان، Supplier و Rate به صفحات مرتبط متصل شده‌اند.
- سه صفحه Fleet تصویر و KPI مستقل دارند. نمونه KPI برنامه‌ریزی: `Conflict-free Plan Rate`، `Capacity-fit Rate`، `Compliance Rejection Rate` و `Plan Lead Time`.
- ادعاهای KPI مطالعه موردی به‌صورت قابل ممیزی و با مرزبندی Baseline/After نوشته شده‌اند؛ انتشار عدد جدید فقط با داده واقعی مشتری مجاز است.

## QA پیش از انتشار

1. Config/View Cache در Release پاک و دوباره ساخته شود.
2. سه URL قدیمی با `curl -I` بررسی شوند: فقط یک 301 و سپس 200 مقصد.
3. مقصدها از نظر Self-canonical، Indexable Robots، تنها یک H1 و Structured Data معتبر کنترل شوند.
4. Sitemap جدید منتشر و در Google Search Console دوباره Submit شود.
5. URL Inspection برای سه مقصد Primary و Pillarهای P0 درخواست شود.
6. هیچ لینک داخلی، Breadcrumb یا Navigation نباید به URL قدیمی اشاره کند.

## پروتکل تصمیم‌گیری با GSC

داده GSC در این محیط در دسترس نبود؛ بنابراین تصمیم Merge بر اساس Intent و معماری فعلی محصول اعمال شده و باید پس از انتشار با داده واقعی تأیید شود.

- بازه‌ها: ۲۸ روز پس از انتشار در برابر ۲۸ روز قبل؛ سپس بازبینی روزهای ۵۶ و ۸۴.
- Dimensionها: `Query + Page` برای هر کلاستر، همراه Impressions، Clicks، CTR و Average Position.
- موفقیت: Query اصلی فقط یک Landing Page غالب داشته باشد، Impressionهای URL قدیمی افت کنند و مقصد Primary Impression/Click را جذب کند.
- هشدار Cannibalization: یک Query اصلی در دو URL Indexable با Impression معنادار تکرار شود یا URL غیرمالک از مالک تعیین‌شده جلو بزند.
- بازکردن دوباره URL Merge شده فقط زمانی مجاز است که حداقل در دو چرخه ۲۸روزه، Query مستقل و Intent متفاوت پایدار دیده شود؛ در غیر این صورت Title/H1، لینک داخلی و محتوای مقصد اصلاح می‌شود.

## تست خودکار

`SeoClusterOwnershipTest` از تکرار Query Owner، Title/H1/Snippet یکسان، بازگشت URLهای قدیمی به Sitemap یا لینک داخلی و ازبین‌رفتن تمایز سه صفحه Fleet جلوگیری می‌کند.
