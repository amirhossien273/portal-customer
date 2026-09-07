# گزارش جامع Audit و بازطراحی Internal Linking سپند

تاریخ: 2026-09-07

مبنای اندازه‌گیری، Crawl خروجی HTML تمام URLهای Indexable پس از پاک‌سازی View Cache است. شمارش «Internal Links» تعداد occurrenceهای لینک میان صفحات Indexable و شمارش «Unique Edges» رابطه یکتای Source → Destination است.

## Summary

| شاخص | قبل | بعد | تغییر |
| --- | ---: | ---: | ---: |
| Total Indexable Pages | 55 | 55 | +0 |
| Total Internal Links | 3,700 | 2,732 | -968 |
| Unique Internal Edges | 2,088 | 1,185 | -903 |
| Contextual Links | 25 | 235 | +210 |
| Contextual Unique Edges | 15 | 224 | +209 |
| Orphan Pages | 0 | 0 | +0 |
| Near-Orphan Pages | 40 | 0 | -40 |
| Broken Internal Targets | 0 | 0 | +0 |

- Mega Menu از فهرست همه صفحات Solution به شش ورودی موضوعی و «همه راهکارها» کاهش یافت؛ در نمونه صفحه اصلی، لینک‌های Header از 29 به 14 occurrence رسید.
- Sitemap که قبلاً دو Host شامل `sepandcrm.ir` و `127.0.0.1` داشت، اکنون فقط URLهای `https://sepandcrm.ir` را تولید می‌کند.
- Title، H1، Canonical، Indexability و Search Intent صفحات برای این Task تغییر نکرده‌اند.

## Tier و توزیع Link Equity

| Tier | تعداد صفحه | میانگین Contextual Inbound | میانگین Contextual Outbound | نقش |
| --- | ---: | ---: | ---: | --- |
| Tier 1 | 10 | 10.80 | 5.50 | Money / Authority |
| Tier 2 | 19 | 3.58 | 4.00 | Supporting Commercial |
| Tier 3 | 26 | 2.27 | 4.00 | Specialized Supporting |

Tier 1 به‌صورت میانگین بیش از سه برابر Tier 2 و بیش از چهار برابر Tier 3 لینک Contextual ورودی دریافت می‌کند. Tier 3ها به Parent و Authority Page لینک می‌دهند و از قرارگرفتن سراسری در Navigation خارج شده‌اند.

## Audit تمام صفحات Indexable

| URL | Page Title | Cluster | Tier | Inbound Internal Links | Contextual Inbound | Navigation Inbound | Outbound Internal Links | Main Anchor Texts | Orphan Risk | Recommended Action |
| --- | --- | --- | ---: | ---: | ---: | ---: | ---: | --- | --- | --- |
| `/` | نرم‌افزار مدیریت حمل‌ونقل بین‌المللی و فورواردری \| سپند | Core | 1 | 220 → 222 | 0 → 2 | 220 → 220 | 65 → 54 | سپندCRM هوشمند حمل‌ونقل، [بدون متن]، گردش کار هوشمند محصول، صفحه اصلی | navigation-only → low | نقش Authority حفظ و Anchor Mix در GSC پایش شود. |
| `/product` | معرفی نرم افزار سپند \| مدیریت یکپارچه شرکت‌های حمل‌ونقل و فورواردری | Core | 1 | 121 → 138 | 0 → 16 | 108 → 108 | 68 → 52 | معرفی محصول، معرفی محصول در عمل، معرفی کامل محصول سپند، [بدون متن] | navigation-only → low | نقش Authority حفظ و Anchor Mix در GSC پایش شود. |
| `/why-sepand` | چرا سپند؟ \| نرم افزار تخصصی مدیریت شرکت‌های حمل‌ونقل و فورواردری | Core | 2 | 108 → 110 | 0 → 1 | 107 → 108 | 66 → 48 | چرا سپند؟، چرا سپند، چرا سپند؟ ← | navigation-only → low | از Tier 3 لینک بگیرد و به Authority بالادست متصل بماند. |
| `/faq` | سؤالات متداول نرم‌افزار CRM حمل‌ونقل و فورواردری \| سپند | Core | 3 | 109 → 111 | 0 → 2 | 108 → 108 | 90 → 71 | سؤالات متداول، سؤالات متداول نرم‌افزار، پرسش‌های متداول سپند، پاسخ‌های پیش از خرید | navigation-only → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/modules` | ماژول‌های نرم‌افزار حمل‌ونقل و لجستیک \| سپند | Core | 2 | 128 → 130 | 4 → 6 | 120 → 120 | 74 → 56 | ماژول‌ها، ماژول‌های نرم‌افزار، ماژول‌های نرم‌افزار سپند، معماری ماژولار سپند | low → low | از Tier 3 لینک بگیرد و به Authority بالادست متصل بماند. |
| `/solutions` | راهکارهای نرم‌افزار حمل‌ونقل و لجستیک سپند | Core | 2 | 120 → 132 | 0 → 2 | 120 → 130 | 92 → 74 | همه راهکارها انتخاب بر اساس مسئله، شواهد محصول و عمق عملیاتی، همه راهکارهای سپند، راهکارها، راهکارهای تخصصی | navigation-only → low | از Tier 3 لینک بگیرد و به Authority بالادست متصل بماند. |
| `/compare` | مرکز مقایسه و راهنمای انتخاب نرم‌افزار حمل‌ونقل \| سپند | Compare | 2 | 64 → 71 | 0 → 7 | 61 → 61 | 65 → 47 | مرکز مقایسه نرم‌افزارها، مرکز مقایسه، هاب راهنماهای مقایسه، چارچوب‌های مقایسه نرم‌افزار | navigation-only → low | از Tier 3 لینک بگیرد و به Authority بالادست متصل بماند. |
| `/pricing` | قیمت نرم‌افزار حمل‌ونقل بین‌المللی \| سپند | Core | 2 | 119 → 121 | 1 → 3 | 108 → 108 | 60 → 42 | تعرفه‌ها، تعرفه نرم‌افزار سپند، تعرفه نرم‌افزار، مشاهده تعرفه‌ها | low → low | از Tier 3 لینک بگیرد و به Authority بالادست متصل بماند. |
| `/about` | درباره سپند \| فناوری برای یک مسیر شفاف‌تر | Core | 3 | 109 → 110 | 0 → 1 | 108 → 108 | 57 → 38 | درباره ما، تماس با ما، درباره سپند | navigation-only → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/consultation` | درخواست دمو نرم‌افزار حمل‌ونقل و مشاوره خرید \| سپند | Core | 3 | 273 → 275 | 3 → 5 | 108 → 108 | 59 → 40 | دمو و نیازسنجی محصول درخواست دمو و مشاورهدرخواست دمو، درخواست دمو و مشاوره، درخواست دمو، درخواست دمو سپند | low → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/customers/case-studies/operational-control-snapshot` | مطالعه موردی واقعی: تصویر عملیاتی یک شرکت حمل‌ونقل در سپند | Operations | 2 | 53 → 56 | 0 → 3 | 53 → 53 | 57 → 40 | مطالعه موردی واقعی، مطالعه موردی کنترل عملیات، نمونه واقعی استفاده از سپند، مطالعه موردی مشتری سپند | navigation-only → low | از Tier 3 لینک بگیرد و به Authority بالادست متصل بماند. |
| `/compare/sepand-vs-royan` | مقایسه نرم‌افزار سپند و رویان \| راهنمای بی‌طرفانه انتخاب | Compare | 3 | 4 → 5 | 0 → 1 | 0 → 0 | 75 → 56 | مقایسه مستقیم سپند در برابر رویان مقایسه بی‌طرفانه اطلاعات عمومی و موارد نیازمند بررسی در دموی دو نرم‌افزار. مشاهده مقایسه ←، 01 مقایسه مستقیم سپند در برابر رویان مقایسه بی‌طرفانه اطلاعات عمومی و موارد نیازمند بررسی در دموی دو نرم‌افزار. مشاهده صفحه ←، مقایسه سپند و رویان | navigation-only → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/compare/sepand-vs-saba` | مقایسه سپند و سبا سیستم \| راهنمای بی‌طرفانه انتخاب | Compare | 3 | 4 → 5 | 0 → 1 | 0 → 0 | 75 → 56 | مقایسه مستقیم سپند در برابر سبا سیستم بررسی قابلیت‌های اعلام‌شده و پرسش‌هایی که باید پیش از انتخاب از دو تأمین‌کننده پرسید. مشاهده مقایسه ←، 02 مقایسه مستقیم سپند در برابر سبا سیستم بررسی قابلیت‌های اعلام‌شده و پرسش‌هایی که باید پیش از انتخاب از دو تأمین‌کننده پرسید. مشاهده صفحه ←، مقایسه سپند و سبا سیستم | navigation-only → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/compare/sepand-vs-other-transport-software` | مقایسه انواع نرم‌افزار حمل‌ونقل؛ TMS، CRM و مالی \| سپند | Compare | 3 | 6 → 7 | 0 → 1 | 0 → 0 | 90 → 71 | مقایسه دسته‌ها سپند در برابر سایر نرم‌افزارهای حمل‌ونقل مقایسه سپند با CRM عمومی، نرم‌افزار حسابداری‌محور، عملیات حمل و مدیریت ناوگان. مشاهده مقایسه ←، مقایسه کامل سپند با CRMهای عمومی ←، 03 مقایسه دسته‌ها سپند در برابر سایر نرم‌افزارهای حمل‌ونقل مقایسه سپند با CRM عمومی، نرم‌افزار حسابداری‌محور، عملیات حمل و مدیریت ناوگان. مشاهده صفحه ←، مقایسه با سایر نرم‌افزارهای حمل | navigation-only → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/compare/best-transport-software` | بهترین نرم‌افزار حمل‌ونقل بین‌المللی \| راهنمای انتخاب | Compare | 2 | 6 → 8 | 0 → 2 | 0 → 0 | 80 → 62 | راهنمای انتخاب بهترین نرم‌افزار حمل‌ونقل بین‌المللی چک‌لیست ارزیابی و سناریوی دمویی برای انتخاب متناسب با فرایند و بودجه شرکت. مشاهده مقایسه ←، راهنمای انتخاب، 04 راهنمای انتخاب بهترین نرم‌افزار حمل‌ونقل بین‌المللی چک‌لیست ارزیابی و سناریوی دمویی برای انتخاب متناسب با فرایند و بودجه شرکت. مشاهده صفحه ←، راهنمای انتخاب نرم‌افزار حمل | navigation-only → low | از Tier 3 لینک بگیرد و به Authority بالادست متصل بماند. |
| `/compare/best-freight-forwarding-software` | بهترین نرم‌افزار فورواردری \| راهنمای انتخاب حرفه‌ای | Compare | 1 | 8 → 12 | 0 → 4 | 0 → 0 | 67 → 51 | راهنمای تخصصی فورواردری بهترین نرم‌افزار فورواردری معیارهای CRM، نرخ‌دهی، Booking، عملیات، اسناد و مالی برای انتخاب راهکار فورواردری. مشاهده مقایسه ←، راهنمای انتخاب نرم‌افزار فورواردری ←، راهنمای انتخاب نرم‌افزار فورواردری، 05 راهنمای تخصصی فورواردری بهترین نرم‌افزار فورواردری معیارهای CRM، نرخ‌دهی، Booking، عملیات، اسناد و مالی برای انتخاب راهکار فورواردری. مشاهده صفحه ← | navigation-only → low | نقش Authority حفظ و Anchor Mix در GSC پایش شود. |
| `/compare/best-crm-for-transport-companies` | بهترین CRM برای شرکت حمل‌ونقل \| چک‌لیست انتخاب | Sales | 3 | 7 → 8 | 0 → 1 | 0 → 0 | 67 → 48 | راهنمای انتخاب CRM بهترین CRM برای شرکت حمل‌ونقل چک‌لیست مشتری، استعلام، پیگیری، تحلیل فروش و اتصال CRM به عملیات حمل. مشاهده مقایسه ←، 06 راهنمای انتخاب CRM بهترین CRM برای شرکت حمل‌ونقل چک‌لیست مشتری، استعلام، پیگیری، تحلیل فروش و اتصال CRM به عملیات حمل. مشاهده صفحه ←، راهنمای انتخاب CRM حمل‌ونقل، بهترین CRM برای شرکت حمل‌ونقل ← | navigation-only → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/compare/best-transport-accounting-software` | بهترین نرم‌افزار حسابداری حمل‌ونقل بین‌المللی | Finance | 3 | 7 → 7 | 0 → 1 | 0 → 0 | 67 → 48 | راهنمای انتخاب مالی بهترین حسابداری حمل‌ونقل ارزیابی مالی چندارزی، دریافت‌وپرداخت، سود پرونده و ارتباط حسابداری با عملیات. مشاهده مقایسه ←، 07 راهنمای انتخاب مالی بهترین حسابداری حمل‌ونقل ارزیابی مالی چندارزی، دریافت‌وپرداخت، سود پرونده و ارتباط حسابداری با عملیات. مشاهده صفحه ←، راهنمای حسابداری حمل‌ونقل، راهنمای انتخاب حسابداری حمل ← | near-orphan → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/modules/crm` | نرم‌افزار CRM حمل‌ونقل و مدیریت مشتریان \| سپند | Sales | 1 | 27 → 147 | 2 → 13 | 0 → 107 | 65 → 46 | فروش و CRMمشتری، نرخ، پیشنهاد و Booking، CRM و مدیریت مشتری، مشاهده ماژول CRM، CRM تخصصی فورواردری | low → low | نقش Authority حفظ و Anchor Mix در GSC پایش شود. |
| `/modules/pricing-sales` | نرم‌افزار قیمت‌گذاری و پیشنهاد فروش حمل \| سپند | Sales | 1 | 29 → 41 | 1 → 13 | 0 → 0 | 66 → 49 | مشاهده ماژول Sales، مشاهده ماژول نرخ‌دهی و فروش، مدیریت نرخ و Quotation، فرایند نرخ‌دهی و پیشنهاد حمل | low → low | نقش Authority حفظ و Anchor Mix در GSC پایش شود. |
| `/modules/booking` | نرم‌افزار مدیریت Booking حمل‌ونقل \| سپند | Sales | 2 | 21 → 27 | 2 → 8 | 0 → 0 | 65 → 47 | مشاهده ماژول Booking، Booking، رزرو و Booking حمل، مدیریت Booking | low → low | از Tier 3 لینک بگیرد و به Authority بالادست متصل بماند. |
| `/modules/transport-operations` | نرم‌افزار مدیریت عملیات حمل‌ونقل \| سپند | Operations | 1 | 86 → 166 | 3 → 25 | 53 → 107 | 68 → 51 | مدیریت عملیات حمل، عملیات و کنترلاجرا، دیدپذیری، هشدار و Exception، مشاهده ماژول Operation، عملیات حمل | low → low | نقش Authority حفظ و Anchor Mix در GSC پایش شود. |
| `/modules/document-management` | نرم افزار مدیریت اسناد حمل‌ونقل و فورواردری \| سپند | Documents | 2 | 26 → 140 | 1 → 7 | 0 → 108 | 66 → 46 | مدیریت اسناد حمل، اسنادمخزن، تأیید، آمادگی و بارنامه، مشاهده ماژول Documents، مدیریت اسناد | low → low | از Tier 3 لینک بگیرد و به Authority بالادست متصل بماند. |
| `/modules/finance-accounting` | نرم‌افزار حسابداری حمل‌ونقل بین‌المللی \| سپند | Finance | 1 | 36 → 165 | 2 → 23 | 0 → 107 | 66 → 47 | مالیهزینه، دریافت، پرداخت و سود پرونده، مالی و حسابداری حمل، مشاهده ماژول Finance، [بدون متن] | low → low | نقش Authority حفظ و Anchor Mix در GSC پایش شود. |
| `/modules/workflow-tasks` | مدیریت گردش کار انسانی و وظایف حمل‌ونقل \| سپند | Operations | 3 | 14 → 16 | 1 → 3 | 0 → 0 | 65 → 46 | مشاهده ماژول گردش کار هوشمند، Workflow و Task، [بدون متن]، آشنایی با گردش کار | low → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/modules/automatic-tasks` | تسک خودکار CRM و اتوماسیون پیگیری فروش \| سپند | Sales | 3 | 60 → 9 | 0 → 2 | 53 → 0 | 63 → 45 | مشاهده امکانات تسک خودکار، قوانین وظیفه خودکار، مشاهده ماژول تسک خودکار، مشاهده تسک خودکار ← | navigation-only → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/modules/customer-portal-tracking` | پرتال مشتری حمل‌ونقل؛ OTP، رهگیری و صورتحساب \| سپند | Core | 2 | 67 → 15 | 1 → 2 | 53 → 0 | 65 → 48 | مشاهده ماژول Portal، پرتال مشتری، مشاهده امکانات پرتال مشتری، مشاهده پرتال مشتریان و رهگیری | low → low | از Tier 3 لینک بگیرد و به Authority بالادست متصل بماند. |
| `/modules/operations-control-tower` | برج کنترل عملیات حمل؛ پایش و تصمیم شیفت \| سپند | Operations | 3 | 11 → 16 | 0 → 5 | 0 → 0 | 65 → 46 | برج کنترل عملیات سپند ←، برج کنترل عملیات حمل، [بدون متن]، مشاهده برج کنترل ← | near-orphan → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/modules/document-checklists` | چک لیست مدارک حمل برای هر روش و خدمت \| سپند | Documents | 3 | 3 → 5 | 0 → 2 | 0 → 0 | 65 → 46 | مشاهده چک‌لیست اسناد، مشاهده ماژول Document Checklist، طراحی چک لیست مدارک حمل ←، الگوی مدارک هر خدمت | navigation-only → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/modules/fleet-dispatch` | دیسپچ اجرایی ناوگان و کنترل مأموریت \| سپند | Road / Fleet | 3 | 5 → 8 | 0 → 3 | 0 → 0 | 65 → 46 | مشاهده دیسپچ ناوگان، مشاهده ماژول Fleet Dispatch، نرم‌افزار دیسپچ ناوگان حمل ←، دیسپچ و تخصیص ناوگان سپند ← | near-orphan → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/transport-modes/air` | نرم‌افزار مدیریت حمل هوایی و Air Freight \| سپند | Air Freight | 1 | 8 → 10 | 1 → 2 | 0 → 0 | 63 → 46 | حمل هوایی، 2حمل هواییمدیریت منطق وزن، MAWB/HAWB، بخش‌های پرواز، ترانشیپمنت، ULD و نقاط عطف محموله هوایی.مشاهده جزئیات ←، مشاهده جزئیات هوایی، نرم‌افزار مدیریت حمل هوایی | low → low | نقش Authority حفظ و Anchor Mix در GSC پایش شود. |
| `/transport-modes/road` | نرم‌افزار مدیریت حمل زمینی و سفرهای مرزی \| سپند | Road / Fleet | 1 | 11 → 14 | 1 → 4 | 0 → 0 | 63 → 46 | 2حمل زمینیاجرای سفر زمینی از تخصیص کامیون و راننده تا مرز، تحویل، POD و هزینه واقعی همان سفر.مشاهده جزئیات ←، مشاهده جزئیات زمینی، صفحه مدیریت حمل زمینی سپند، زمینی | low → low | نقش Authority حفظ و Anchor Mix در GSC پایش شود. |
| `/transport-modes/sea` | نرم‌افزار مدیریت حمل دریایی \| سپند | Sea / NVOCC | 1 | 15 → 21 | 1 → 6 | 0 → 0 | 63 → 47 | 1حمل دریاییمدیریت Booking، کانتینر، HBL/MBL، VGM و هزینه‌های توقف در یک پرونده دریایی.مشاهده جزئیات ←، مدیریت حمل دریایی، مشاهده جزئیات دریایی، مدیریت حمل دریایی سپند | low → low | نقش Authority حفظ و Anchor Mix در GSC پایش شود. |
| `/transport-modes/rail` | نرم‌افزار مدیریت عملیات حمل ریلی و واگن \| سپند | Multimodal | 3 | 8 → 10 | 1 → 2 | 0 → 0 | 63 → 44 | 3حمل ریلیمعماری عملیات ریلی از تخصیص واگن و ایستگاه‌های مسیر تا تأخیر و تغییرات عملیاتی.مشاهده جزئیات ←، مشاهده جزئیات ریلی، نرم‌افزار مدیریت حمل ریلی، ریلی | low → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/solutions/operations-automation` | اتوماسیون عملیات حمل‌ونقل با Rule و Exception \| سپند | Operations | 2 | 70 → 15 | 0 → 3 | 54 → 0 | 68 → 50 | [بدون متن]، اتوماسیون عملیات با Rule و Trigger ←، اتوماسیون عملیات سپند ←، قواعد و Triggerهای عملیاتی | near-orphan → low | از Tier 3 لینک بگیرد و به Authority بالادست متصل بماند. |
| `/solutions/freight-finance` | مدیریت مالی حمل‌ونقل، Accrual و Margin \| سپند | Finance | 2 | 69 → 16 | 0 → 4 | 54 → 0 | 69 → 53 | [بدون متن]، Freight Financeمالی حمل‌ونقلAccrual، FX، Reconciliation و Marginمطالعه راهکار ←، مشاهده کنترل مالی پرونده ←، سود و زیان پرونده حمل | near-orphan → low | از Tier 3 لینک بگیرد و به Authority بالادست متصل بماند. |
| `/solutions/fleet-management` | نرم‌افزار مدیریت ناوگان حمل‌ونقل و رانندگان \| سپند | Road / Fleet | 2 | 59 → 115 | 0 → 3 | 54 → 108 | 70 → 49 | مدیریت ناوگان، ناوگانخودرو، راننده، برنامه‌ریزی و دیسپچ، مدیریت ناوگان و رانندگان ←، کنترل آمادگی ناوگان | near-orphan → low | از Tier 3 لینک بگیرد و به Authority بالادست متصل بماند. |
| `/solutions/document-management` | چرخه تأیید اسناد حمل \| Draft، Approval و Version Control \| سپند | Documents | 3 | 65 → 12 | 0 → 4 | 54 → 0 | 68 → 50 | چرخه تأیید اسناد، گردش تأیید Draft بارنامه ←، فرایند تأیید و اصلاح بارنامه ←، گردش Draft تا نسخه نهایی | near-orphan → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/solutions/multimodal-transport` | مدیریت حمل‌ونقل چندوجهی، Leg و Handover \| سپند | Multimodal | 3 | 59 → 5 | 0 → 2 | 54 → 0 | 70 → 53 | بررسی کامل راهکار، حمل چندوجهی، Multimodal Transportحمل چندوجهیJourney، Leg و Handover بین روش‌هامطالعه راهکار ←، کنترل Leg و Handover | near-orphan → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/solutions/schedule-management` | مدیریت Schedule، ETD و ETA حمل‌ونقل \| سپند | Sea / NVOCC | 2 | 59 → 7 | 0 → 3 | 54 → 0 | 69 → 52 | مدیریت برنامه حرکت، Schedule Managementمدیریت برنامه حرکتSchedule مرجع، ETD/ETA و Change Logمطالعه راهکار ←، Schedule حمل‌ونقل، بررسی کامل راهکار | near-orphan → low | از Tier 3 لینک بگیرد و به Authority بالادست متصل بماند. |
| `/solutions/rate-management` | مدیریت نرخ و تعرفه حمل‌ونقل و Rate Break \| سپند | Sales | 2 | 64 → 11 | 0 → 2 | 54 → 0 | 68 → 50 | [بدون متن]، Rate Managementمدیریت نرخ و تعرفهRate Master، Break و هزینه جانبیمطالعه راهکار ←، بررسی کامل راهکار، مدیریت نرخ و تعرفه | near-orphan → low | از Tier 3 لینک بگیرد و به Authority بالادست متصل بماند. |
| `/solutions/security-access-management` | امنیت، چندسازمانی و مدیریت دسترسی نرم‌افزار حمل \| سپند | Core | 3 | 57 → 4 | 0 → 2 | 54 → 0 | 67 → 48 | امنیت و مدیریت دسترسی، امنیت و مدیریت دسترسی سپند ←، کنترل نقش‌ها و مجوزها، بررسی کامل راهکار | near-orphan → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/solutions/payment-workflow` | راهنمای درخواست پرداخت تا پرداخت نهایی در سپند | Finance | 3 | 59 → 6 | 0 → 2 | 54 → 0 | 67 → 48 | Payment Workflowدرخواست تا پرداخت نهاییدرخواست، تأیید، پرداخت و سند مالیمطالعه راهکار ←، بررسی کامل راهکار، فرایند تأیید پرداخت، گردش درخواست تا پرداخت ← | near-orphan → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/solutions/booking-reconciliation` | راهنمای دریافت و تطبیق مالی Booking در سپند | Finance | 3 | 56 → 5 | 0 → 2 | 54 → 0 | 67 → 49 | Booking Reconciliationدریافت و تطبیق BookingReceipt، Allocation، FX و مانده بازمطالعه راهکار ←، بررسی کامل راهکار، Receipt Allocation بوکینگ، تطبیق مالی Booking | near-orphan → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/solutions/supplier-management` | راهنمای Supplier Master و مقایسه تأمین‌کنندگان حمل \| سپند | Sales | 3 | 55 → 4 | 0 → 2 | 54 → 0 | 67 → 48 | بررسی کامل راهکار، Supplier ManagementSupplier Master و مقایسهپروفایل، پوشش، نرخ و ارزیابی تأمین‌کنندهمطالعه راهکار ←، Supplier Master، مدیریت تأمین‌کنندگان حمل | navigation-only → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/solutions/nvocc` | نرم‌افزار NVOCC \| مدیریت عملیات، اسناد و مالی | Sea / NVOCC | 2 | 113 → 118 | 0 → 4 | 108 → 108 | 64 → 47 | راهکار NVOCC، NVOCC و کانتینردریایی، کانتینر، Schedule و HBL/MBL، راهکار NVOCC ←، نرم‌افزار تخصصی NVOCC | navigation-only → low | از Tier 3 لینک بگیرد و به Authority بالادست متصل بماند. |
| `/solutions/container-management` | نرم‌افزار مدیریت کانتینر \| کنترل چرخه و هزینه | Sea / NVOCC | 2 | 111 → 5 | 0 → 2 | 108 → 0 | 64 → 49 | راهکار مدیریت کانتینر ←، کنترل Container Master، مدیریت کانتینرتخصیص، رویداد، مهلت و هزینه تجهیزات، مدیریت چرخه کانتینر | navigation-only → low | از Tier 3 لینک بگیرد و به Authority بالادست متصل بماند. |
| `/solutions/on-premise` | نرم‌افزار حمل‌ونقل On-Premise \| راهنمای استقرار | Core | 3 | 110 → 3 | 0 → 1 | 108 → 0 | 64 → 48 | استقرار On-Premiseارزیابی استقرار نرم‌افزار در زیرساخت سازمان، صفحه تخصصیاستقرار On-Premiseالزامات زیرساخت و استقرار داخل سازمان.مشاهده صفحه ←، استقرار On-Premise | near-orphan → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/solutions/bill-of-lading-management` | نرم افزار مدیریت بارنامه HBL و MBL \| سپند | Sea / NVOCC | 2 | 115 → 11 | 0 → 4 | 108 → 0 | 64 → 49 | راهکار مدیریت بارنامه ←، مدیریت بارنامه حمل ←، راهکار Bill of Lading، کنترل بارنامه‌های HBL و MBL ← | navigation-only → low | از Tier 3 لینک بگیرد و به Authority بالادست متصل بماند. |
| `/solutions/freight-sales-automation` | اتوماسیون پیگیری فروش حمل؛ SLA و Handoff \| سپند | Sales | 2 | 116 → 9 | 0 → 2 | 108 → 0 | 64 → 49 | راهکار اتوماسیون فروش حمل‌ونقل ←، اتوماسیون فروش فورواردری ←، اتوماسیون پیگیری فروش حملاز لید و نرخ تا پیگیری و تحویل به عملیات، [بدون متن] | near-orphan → low | از Tier 3 لینک بگیرد و به Authority بالادست متصل بماند. |
| `/solutions/shipment-visibility` | دیدپذیری وضعیت محموله و Milestoneهای داخلی \| سپند | Operations | 3 | 116 → 10 | 0 → 3 | 107 → 0 | 64 → 48 | راهکار دیدپذیری عملیات حمل ←، برج کنترل حمل‌ونقل ←، دیدپذیری عملیات حملپایش وضعیت، رویداد و سکون محموله، [بدون متن] | near-orphan → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/solutions/operation-exception-management` | راهکار مدیریت استثناهای عملیات حمل \| سپند | Operations | 3 | 116 → 13 | 0 → 4 | 107 → 0 | 64 → 48 | راهکار مدیریت استثناهای عملیات حمل ←، مدیریت استثناهای حمل ←، کنترل Exception محموله، راهکار مدیریت استثناهای حمل ← | near-orphan → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/solutions/transport-governance` | راهکار حاکمیت عملیاتی شرکت حمل‌ونقل \| سپند | Operations | 3 | 111 → 6 | 0 → 1 | 107 → 0 | 64 → 48 | راهکار حاکمیت عملیاتی حمل‌ونقل ←، مرکز فرمان سازمانی حمل‌ونقل ←، راهکار حاکمیت عملیاتی حمل ←، حاکمیت عملیاتی حملریسک، SLA، دارایی و سود سازمان | navigation-only → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/solutions/document-readiness` | کنترل آماده بودن مدارک حمل پیش از عملیات \| سپند | Documents | 3 | 114 → 10 | 0 → 3 | 107 → 0 | 64 → 48 | راهکار آمادگی اسناد حمل ←، آمادگی اسناد حملالزام، تکمیل و کنترل مدارک پرونده، [بدون متن]، مشاهده کنترل آمادگی مدارک ← | near-orphan → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |
| `/solutions/fleet-dispatch-planning` | برنامه‌ریزی اعزام ناوگان؛ ظرفیت و Assignment بدون تداخل \| سپند | Road / Fleet | 3 | 113 → 9 | 0 → 3 | 107 → 0 | 64 → 48 | راهکار برنامه‌ریزی دیسپچ ناوگان ←، برنامه‌ریزی دیسپچ ناوگانظرفیت، راننده، مدارک و تداخل اعزام، [بدون متن]، مشاهده برنامه‌ریزی پیش از اعزام ← | near-orphan → low | ۲ تا ۴ لینک به Parent/Authority حفظ شود؛ Global Link نگیرد. |

## Contextual Links Added — Per Page

این جدول Edgeهای Contextual یکتایی را نشان می‌دهد که در Snapshot قبل وجود نداشتند. کاهش لینک‌های سراسری Header/Footer جداگانه و در سطح Template انجام شده است.

| Source Page | Destination Page | Anchor Text | Reason |
| --- | --- | --- | --- |
| `/` | `/product` | معرفی کامل محصول سپند | انتقال Link Equity به Authority Page خوشه Core |
| `/` | `/modules/crm` | CRM تخصصی فورواردری | انتقال Link Equity به Authority Page خوشه Sales |
| `/` | `/modules/transport-operations` | مدیریت عملیات حمل | انتقال Link Equity به Authority Page خوشه Operations |
| `/` | `/modules/finance-accounting` | حسابداری حمل‌ونقل | انتقال Link Equity به Authority Page خوشه Finance |
| `/` | `/compare/best-freight-forwarding-software` | راهنمای انتخاب نرم‌افزار فورواردری | انتقال Link Equity به Authority Page خوشه Compare |
| `/` | `/customers/case-studies/operational-control-snapshot` | مطالعه موردی کنترل عملیات | اتصال طبیعی خوشه Core به Operations |
| `/product` | `/modules/crm` | مدیریت مشتریان شرکت حمل | انتقال Link Equity به Authority Page خوشه Sales |
| `/product` | `/modules/pricing-sales` | مدیریت نرخ و Quotation | انتقال Link Equity به Authority Page خوشه Sales |
| `/product` | `/modules/transport-operations` | پرونده عملیاتی محموله | انتقال Link Equity به Authority Page خوشه Operations |
| `/product` | `/modules/finance-accounting` | مالی چندارزی فورواردری | انتقال Link Equity به Authority Page خوشه Finance |
| `/product` | `/modules/customer-portal-tracking` | پرتال مشتریان و رهگیری | تقویت Silo و مسیر Parent/Child خوشه Core |
| `/product` | `/pricing` | تعرفه نرم‌افزار سپند | تقویت Silo و مسیر Parent/Child خوشه Core |
| `/why-sepand` | `/` | سامانه یکپارچه سپند | انتقال Link Equity به Authority Page خوشه Core |
| `/why-sepand` | `/product` | معماری یکپارچه نرم‌افزار | انتقال Link Equity به Authority Page خوشه Core |
| `/why-sepand` | `/about` | درباره سپند | تقویت Silo و مسیر Parent/Child خوشه Core |
| `/why-sepand` | `/customers/case-studies/operational-control-snapshot` | نمونه واقعی استفاده از سپند | اتصال طبیعی خوشه Core به Operations |
| `/faq` | `/product` | نمای عملی نرم‌افزار سپند | انتقال Link Equity به Authority Page خوشه Core |
| `/faq` | `/modules` | هاب ماژول‌های سپند | تقویت Silo و مسیر Parent/Child خوشه Core |
| `/faq` | `/solutions` | هاب راهکارهای سپند | تقویت Silo و مسیر Parent/Child خوشه Core |
| `/modules` | `/modules/crm` | مدیریت Lead و پیگیری فروش | انتقال Link Equity به Authority Page خوشه Sales |
| `/modules` | `/modules/pricing-sales` | فرایند نرخ‌دهی و پیشنهاد حمل | انتقال Link Equity به Authority Page خوشه Sales |
| `/modules` | `/modules/transport-operations` | نرم‌افزار عملیات حمل‌ونقل | انتقال Link Equity به Authority Page خوشه Operations |
| `/modules` | `/modules/finance-accounting` | ماژول مالی و حسابداری | انتقال Link Equity به Authority Page خوشه Finance |
| `/compare` | `/compare/best-freight-forwarding-software` | بهترین نرم‌افزار فورواردری | انتقال Link Equity به Authority Page خوشه Compare |
| `/compare` | `/compare/best-transport-software` | راهنمای انتخاب نرم‌افزار حمل | تقویت Silo و مسیر Parent/Child خوشه Compare |
| `/compare` | `/compare/best-crm-for-transport-companies` | راهنمای انتخاب CRM حمل‌ونقل | اتصال طبیعی خوشه Compare به Sales |
| `/compare` | `/compare/best-transport-accounting-software` | راهنمای حسابداری حمل‌ونقل | اتصال طبیعی خوشه Compare به Finance |
| `/compare/sepand-vs-royan` | `/compare` | هاب راهنماهای مقایسه | تقویت Silo و مسیر Parent/Child خوشه Compare |
| `/compare/sepand-vs-royan` | `/compare/sepand-vs-saba` | مقایسه سپند و سبا سیستم | تقویت Silo و مسیر Parent/Child خوشه Compare |
| `/compare/sepand-vs-royan` | `/compare/best-freight-forwarding-software` | چارچوب ارزیابی سامانه فورواردری | انتقال Link Equity به Authority Page خوشه Compare |
| `/compare/sepand-vs-saba` | `/compare` | چارچوب‌های مقایسه نرم‌افزار | تقویت Silo و مسیر Parent/Child خوشه Compare |
| `/compare/sepand-vs-saba` | `/compare/sepand-vs-royan` | مقایسه سپند و رویان | تقویت Silo و مسیر Parent/Child خوشه Compare |
| `/compare/sepand-vs-saba` | `/compare/best-freight-forwarding-software` | چک‌لیست انتخاب سیستم فورواردری | انتقال Link Equity به Authority Page خوشه Compare |
| `/compare/sepand-vs-other-transport-software` | `/compare` | مرکز مقایسه نرم‌افزارها | تقویت Silo و مسیر Parent/Child خوشه Compare |
| `/compare/sepand-vs-other-transport-software` | `/compare/best-transport-software` | بهترین نرم‌افزار مدیریت حمل | تقویت Silo و مسیر Parent/Child خوشه Compare |
| `/compare/sepand-vs-other-transport-software` | `/product` | معرفی کامل محصول سپند | انتقال Link Equity به Authority Page خوشه Core |
| `/compare/best-transport-software` | `/product` | معماری یکپارچه نرم‌افزار | انتقال Link Equity به Authority Page خوشه Core |
| `/compare/best-transport-software` | `/modules` | فهرست ماژول‌های نرم‌افزار | اتصال طبیعی خوشه Compare به Core |
| `/compare/best-transport-software` | `/compare/sepand-vs-other-transport-software` | مقایسه با سایر نرم‌افزارهای حمل | تقویت Silo و مسیر Parent/Child خوشه Compare |
| `/compare/best-transport-software` | `/compare` | هاب راهنماهای مقایسه | تقویت Silo و مسیر Parent/Child خوشه Compare |
| `/pricing` | `/product` | نقشه محصول سپند | انتقال Link Equity به Authority Page خوشه Core |
| `/pricing` | `/consultation` | درخواست دمو و مشاوره | تقویت Silo و مسیر Parent/Child خوشه Core |
| `/pricing` | `/compare` | مرکز مقایسه نرم‌افزارها | اتصال طبیعی خوشه Core به Compare |
| `/pricing` | `/faq` | پرسش‌های متداول سپند | تقویت Silo و مسیر Parent/Child خوشه Core |
| `/about` | `/` | نرم‌افزار حمل‌ونقل سپند | انتقال Link Equity به Authority Page خوشه Core |
| `/about` | `/why-sepand` | چرا سپند | تقویت Silo و مسیر Parent/Child خوشه Core |
| `/about` | `/customers/case-studies/operational-control-snapshot` | مطالعه موردی مشتری سپند | اتصال طبیعی خوشه Core به Operations |
| `/consultation` | `/product` | معرفی نرم‌افزار مدیریت حمل | انتقال Link Equity به Authority Page خوشه Core |
| `/consultation` | `/faq` | پاسخ‌های پیش از خرید | تقویت Silo و مسیر Parent/Child خوشه Core |
| `/consultation` | `/pricing` | مدل قیمت‌گذاری سپند | تقویت Silo و مسیر Parent/Child خوشه Core |
| `/compare/best-freight-forwarding-software` | `/product` | نمای عملی نرم‌افزار سپند | انتقال Link Equity به Authority Page خوشه Core |
| `/compare/best-freight-forwarding-software` | `/modules/crm` | پرونده یکپارچه مشتری | انتقال Link Equity به Authority Page خوشه Sales |
| `/compare/best-freight-forwarding-software` | `/modules/pricing-sales` | قیمت‌گذاری و فروش حمل | انتقال Link Equity به Authority Page خوشه Sales |
| `/compare/best-freight-forwarding-software` | `/modules/transport-operations` | مدیریت رویدادهای محموله | انتقال Link Equity به Authority Page خوشه Operations |
| `/compare/best-freight-forwarding-software` | `/modules/finance-accounting` | حسابداری شرکت فورواردری | انتقال Link Equity به Authority Page خوشه Finance |
| `/compare/best-freight-forwarding-software` | `/solutions` | نقشه راهکارهای تخصصی | اتصال طبیعی خوشه Compare به Core |
| `/compare/best-crm-for-transport-companies` | `/modules/crm` | CRM شرکت‌های لجستیکی | انتقال Link Equity به Authority Page خوشه Sales |
| `/compare/best-crm-for-transport-companies` | `/modules/pricing-sales` | ماژول Pricing & Sales | انتقال Link Equity به Authority Page خوشه Sales |
| `/compare/best-crm-for-transport-companies` | `/compare` | چارچوب‌های مقایسه نرم‌افزار | اتصال طبیعی خوشه Sales به Compare |
| `/compare/best-transport-accounting-software` | `/modules/finance-accounting` | کنترل دریافت و پرداخت حمل | انتقال Link Equity به Authority Page خوشه Finance |
| `/compare/best-transport-accounting-software` | `/solutions/freight-finance` | سود و زیان پرونده حمل | تقویت Silo و مسیر Parent/Child خوشه Finance |
| `/compare/best-transport-accounting-software` | `/compare` | مرکز مقایسه نرم‌افزارها | اتصال طبیعی خوشه Finance به Compare |
| `/solutions/nvocc` | `/transport-modes/sea` | پرونده حمل کانتینری | انتقال Link Equity به Authority Page خوشه Sea / NVOCC |
| `/solutions/nvocc` | `/solutions/container-management` | کنترل Container Master | تقویت Silo و مسیر Parent/Child خوشه Sea / NVOCC |
| `/solutions/nvocc` | `/solutions/bill-of-lading-management` | راهکار Bill of Lading | تقویت Silo و مسیر Parent/Child خوشه Sea / NVOCC |
| `/solutions/nvocc` | `/modules/finance-accounting` | ثبت مالی هر Shipment | انتقال Link Equity به Authority Page خوشه Finance |
| `/solutions/container-management` | `/transport-modes/sea` | نرم‌افزار عملیات دریایی | انتقال Link Equity به Authority Page خوشه Sea / NVOCC |
| `/solutions/container-management` | `/solutions/nvocc` | نرم‌افزار تخصصی NVOCC | تقویت Silo و مسیر Parent/Child خوشه Sea / NVOCC |
| `/solutions/container-management` | `/solutions/schedule-management` | Schedule حمل‌ونقل | تقویت Silo و مسیر Parent/Child خوشه Sea / NVOCC |
| `/solutions/container-management` | `/modules/finance-accounting` | حسابداری شرکت فورواردری | انتقال Link Equity به Authority Page خوشه Finance |
| `/solutions/on-premise` | `/solutions/security-access-management` | امنیت و مدیریت دسترسی | تقویت Silo و مسیر Parent/Child خوشه Core |
| `/solutions/on-premise` | `/product` | معرفی کامل محصول سپند | انتقال Link Equity به Authority Page خوشه Core |
| `/solutions/on-premise` | `/consultation` | رزرو جلسه بررسی محصول | تقویت Silo و مسیر Parent/Child خوشه Core |
| `/solutions/bill-of-lading-management` | `/transport-modes/sea` | کنترل Shipment دریایی | انتقال Link Equity به Authority Page خوشه Sea / NVOCC |
| `/solutions/bill-of-lading-management` | `/solutions/nvocc` | فرایند NVOCC سپند | تقویت Silo و مسیر Parent/Child خوشه Sea / NVOCC |
| `/solutions/bill-of-lading-management` | `/modules/document-management` | مدیریت اسناد حمل | اتصال طبیعی خوشه Sea / NVOCC به Documents |
| `/solutions/bill-of-lading-management` | `/solutions/document-management` | گردش Draft تا نسخه نهایی | اتصال طبیعی خوشه Sea / NVOCC به Documents |
| `/solutions/freight-sales-automation` | `/modules/crm` | سیستم CRM سپند | انتقال Link Equity به Authority Page خوشه Sales |
| `/solutions/freight-sales-automation` | `/modules/pricing-sales` | محاسبه پیشنهاد حمل | انتقال Link Equity به Authority Page خوشه Sales |
| `/solutions/freight-sales-automation` | `/modules/booking` | رزرو و Booking حمل | تقویت Silo و مسیر Parent/Child خوشه Sales |
| `/solutions/freight-sales-automation` | `/product` | معماری یکپارچه نرم‌افزار | انتقال Link Equity به Authority Page خوشه Core |
| `/solutions/shipment-visibility` | `/modules/transport-operations` | اجرای عملیات Shipment | انتقال Link Equity به Authority Page خوشه Operations |
| `/solutions/shipment-visibility` | `/modules/operations-control-tower` | Control Tower سپند | تقویت Silo و مسیر Parent/Child خوشه Operations |
| `/solutions/shipment-visibility` | `/solutions/operation-exception-management` | کنترل Exception محموله | تقویت Silo و مسیر Parent/Child خوشه Operations |
| `/solutions/operation-exception-management` | `/modules/transport-operations` | کنترل اجرای پرونده حمل | انتقال Link Equity به Authority Page خوشه Operations |
| `/solutions/operation-exception-management` | `/solutions/operations-automation` | قواعد و Triggerهای عملیاتی | تقویت Silo و مسیر Parent/Child خوشه Operations |
| `/solutions/operation-exception-management` | `/modules/operations-control-tower` | برج کنترل عملیات حمل | تقویت Silo و مسیر Parent/Child خوشه Operations |
| `/solutions/transport-governance` | `/modules/transport-operations` | مدیریت رویدادهای محموله | انتقال Link Equity به Authority Page خوشه Operations |
| `/solutions/transport-governance` | `/modules/finance-accounting` | کنترل دریافت و پرداخت حمل | انتقال Link Equity به Authority Page خوشه Finance |
| `/solutions/transport-governance` | `/solutions/security-access-management` | کنترل نقش‌ها و مجوزها | اتصال طبیعی خوشه Operations به Core |
| `/solutions/document-readiness` | `/modules/document-management` | مخزن اسناد فورواردری | تقویت Silo و مسیر Parent/Child خوشه Documents |
| `/solutions/document-readiness` | `/modules/document-checklists` | الگوی مدارک هر خدمت | تقویت Silo و مسیر Parent/Child خوشه Documents |
| `/solutions/document-readiness` | `/solutions/document-management` | کنترل نسخه و تأیید سند | تقویت Silo و مسیر Parent/Child خوشه Documents |
| `/solutions/fleet-dispatch-planning` | `/transport-modes/road` | کنترل سفر و مرز | انتقال Link Equity به Authority Page خوشه Road / Fleet |
| `/solutions/fleet-dispatch-planning` | `/solutions/fleet-management` | کنترل آمادگی ناوگان | تقویت Silo و مسیر Parent/Child خوشه Road / Fleet |
| `/solutions/fleet-dispatch-planning` | `/modules/fleet-dispatch` | مدیریت مأموریت راننده | تقویت Silo و مسیر Parent/Child خوشه Road / Fleet |
| `/solutions` | `/modules/transport-operations` | اجرای عملیات Shipment | انتقال Link Equity به Authority Page خوشه Operations |
| `/solutions` | `/modules/finance-accounting` | کنترل مالی پرونده حمل | انتقال Link Equity به Authority Page خوشه Finance |
| `/solutions` | `/modules/crm` | سیستم CRM سپند | انتقال Link Equity به Authority Page خوشه Sales |
| `/solutions` | `/product` | قابلیت‌های یکپارچه سپند | انتقال Link Equity به Authority Page خوشه Core |
| `/solutions/operations-automation` | `/modules/transport-operations` | عملیات یکپارچه فورواردری | انتقال Link Equity به Authority Page خوشه Operations |
| `/solutions/operations-automation` | `/modules/operations-control-tower` | مرکز تصمیم شیفت | تقویت Silo و مسیر Parent/Child خوشه Operations |
| `/solutions/operations-automation` | `/solutions/operation-exception-management` | فرایند حل انحراف عملیات | تقویت Silo و مسیر Parent/Child خوشه Operations |
| `/solutions/operations-automation` | `/modules/workflow-tasks` | مدیریت فرایند انسانی | تقویت Silo و مسیر Parent/Child خوشه Operations |
| `/solutions/freight-finance` | `/modules/finance-accounting` | حسابداری حمل‌ونقل | انتقال Link Equity به Authority Page خوشه Finance |
| `/solutions/freight-finance` | `/solutions/payment-workflow` | فرایند تأیید پرداخت | تقویت Silo و مسیر Parent/Child خوشه Finance |
| `/solutions/freight-finance` | `/modules/pricing-sales` | فرایند نرخ‌دهی و پیشنهاد حمل | انتقال Link Equity به Authority Page خوشه Sales |
| `/solutions/freight-finance` | `/modules/transport-operations` | چرخه اجرایی Shipment | انتقال Link Equity به Authority Page خوشه Operations |
| `/solutions/fleet-management` | `/transport-modes/road` | عملیات حمل زمینی | انتقال Link Equity به Authority Page خوشه Road / Fleet |
| `/solutions/fleet-management` | `/solutions/fleet-dispatch-planning` | Dispatch Planning | تقویت Silo و مسیر Parent/Child خوشه Road / Fleet |
| `/solutions/fleet-management` | `/modules/fleet-dispatch` | دیسپچ اجرایی خودرو | تقویت Silo و مسیر Parent/Child خوشه Road / Fleet |
| `/solutions/fleet-management` | `/modules/transport-operations` | مدیریت عملیات حمل | انتقال Link Equity به Authority Page خوشه Operations |
| `/solutions/document-management` | `/modules/document-management` | مدیریت فایل‌های Shipment | تقویت Silo و مسیر Parent/Child خوشه Documents |
| `/solutions/document-management` | `/solutions/document-readiness` | کنترل کسری اسناد | تقویت Silo و مسیر Parent/Child خوشه Documents |
| `/solutions/document-management` | `/solutions/bill-of-lading-management` | مدیریت Draft بارنامه | اتصال طبیعی خوشه Documents به Sea / NVOCC |
| `/solutions/multimodal-transport` | `/modules/transport-operations` | پرونده عملیاتی محموله | انتقال Link Equity به Authority Page خوشه Operations |
| `/solutions/multimodal-transport` | `/transport-modes/air` | مدیریت عملیات حمل هوایی | انتقال Link Equity به Authority Page خوشه Air Freight |
| `/solutions/multimodal-transport` | `/transport-modes/sea` | مدیریت حمل دریایی | انتقال Link Equity به Authority Page خوشه Sea / NVOCC |
| `/solutions/multimodal-transport` | `/transport-modes/rail` | مدیریت حمل ریلی | تقویت Silo و مسیر Parent/Child خوشه Multimodal |
| `/solutions/schedule-management` | `/transport-modes/sea` | عملیات Sea Freight | انتقال Link Equity به Authority Page خوشه Sea / NVOCC |
| `/solutions/schedule-management` | `/solutions/nvocc` | مدیریت عملیات NVOCC | تقویت Silo و مسیر Parent/Child خوشه Sea / NVOCC |
| `/solutions/schedule-management` | `/modules/transport-operations` | نرم‌افزار عملیات حمل‌ونقل | انتقال Link Equity به Authority Page خوشه Operations |
| `/solutions/schedule-management` | `/solutions/multimodal-transport` | کنترل Leg و Handover | اتصال طبیعی خوشه Sea / NVOCC به Multimodal |
| `/solutions/rate-management` | `/modules/pricing-sales` | قیمت‌گذاری و فروش حمل | انتقال Link Equity به Authority Page خوشه Sales |
| `/solutions/rate-management` | `/solutions/supplier-management` | Supplier Master | تقویت Silo و مسیر Parent/Child خوشه Sales |
| `/solutions/rate-management` | `/modules/crm` | مدیریت مشتریان شرکت حمل | انتقال Link Equity به Authority Page خوشه Sales |
| `/solutions/rate-management` | `/modules/finance-accounting` | مالی چندارزی فورواردری | انتقال Link Equity به Authority Page خوشه Finance |
| `/solutions/security-access-management` | `/product` | جریان کامل محصول سپند | انتقال Link Equity به Authority Page خوشه Core |
| `/solutions/security-access-management` | `/solutions/on-premise` | استقرار On-Premise | تقویت Silo و مسیر Parent/Child خوشه Core |
| `/solutions/security-access-management` | `/solutions/transport-governance` | حاکمیت عملیات حمل | اتصال طبیعی خوشه Core به Operations |
| `/solutions/payment-workflow` | `/modules/finance-accounting` | ماژول مالی و حسابداری | انتقال Link Equity به Authority Page خوشه Finance |
| `/solutions/payment-workflow` | `/solutions/freight-finance` | کنترل Margin هر Job | تقویت Silo و مسیر Parent/Child خوشه Finance |
| `/solutions/payment-workflow` | `/solutions/booking-reconciliation` | Receipt Allocation بوکینگ | تقویت Silo و مسیر Parent/Child خوشه Finance |
| `/solutions/booking-reconciliation` | `/modules/finance-accounting` | کنترل مالی پرونده حمل | انتقال Link Equity به Authority Page خوشه Finance |
| `/solutions/booking-reconciliation` | `/modules/booking` | مدیریت Booking | اتصال طبیعی خوشه Finance به Sales |
| `/solutions/booking-reconciliation` | `/solutions/freight-finance` | مدیریت مالی حمل | تقویت Silo و مسیر Parent/Child خوشه Finance |
| `/solutions/supplier-management` | `/modules/pricing-sales` | ماژول Pricing & Sales | انتقال Link Equity به Authority Page خوشه Sales |
| `/solutions/supplier-management` | `/solutions/rate-management` | Rate Break و Minimum Charge | تقویت Silo و مسیر Parent/Child خوشه Sales |
| `/solutions/supplier-management` | `/modules/crm` | مدیریت Lead و پیگیری فروش | انتقال Link Equity به Authority Page خوشه Sales |
| `/customers/case-studies/operational-control-snapshot` | `/modules/transport-operations` | کنترل اجرای پرونده حمل | انتقال Link Equity به Authority Page خوشه Operations |
| `/customers/case-studies/operational-control-snapshot` | `/modules/operations-control-tower` | برج کنترل عملیات حمل | تقویت Silo و مسیر Parent/Child خوشه Operations |
| `/customers/case-studies/operational-control-snapshot` | `/modules/finance-accounting` | ثبت مالی هر Shipment | انتقال Link Equity به Authority Page خوشه Finance |
| `/customers/case-studies/operational-control-snapshot` | `/product` | جریان کامل محصول سپند | انتقال Link Equity به Authority Page خوشه Core |
| `/modules/crm` | `/modules/pricing-sales` | محاسبه پیشنهاد حمل | انتقال Link Equity به Authority Page خوشه Sales |
| `/modules/crm` | `/solutions/freight-sales-automation` | اتوماسیون فروش حمل | تقویت Silo و مسیر Parent/Child خوشه Sales |
| `/modules/crm` | `/modules/booking` | مدیریت Booking | تقویت Silo و مسیر Parent/Child خوشه Sales |
| `/modules/crm` | `/product` | قابلیت‌های یکپارچه سپند | انتقال Link Equity به Authority Page خوشه Core |
| `/modules/crm` | `/modules/automatic-tasks` | تسک خودکار CRM | تقویت Silo و مسیر Parent/Child خوشه Sales |
| `/modules/pricing-sales` | `/modules/crm` | مدیریت فرصت فروش حمل | انتقال Link Equity به Authority Page خوشه Sales |
| `/modules/pricing-sales` | `/modules/booking` | رزرو و Booking حمل | تقویت Silo و مسیر Parent/Child خوشه Sales |
| `/modules/pricing-sales` | `/solutions/rate-management` | مدیریت نرخ و تعرفه حمل | تقویت Silo و مسیر Parent/Child خوشه Sales |
| `/modules/pricing-sales` | `/solutions/supplier-management` | مدیریت تأمین‌کنندگان حمل | تقویت Silo و مسیر Parent/Child خوشه Sales |
| `/modules/pricing-sales` | `/modules/finance-accounting` | حسابداری حمل‌ونقل | انتقال Link Equity به Authority Page خوشه Finance |
| `/modules/booking` | `/modules/pricing-sales` | گردش استعلام تا Quotation | انتقال Link Equity به Authority Page خوشه Sales |
| `/modules/booking` | `/modules/transport-operations` | عملیات یکپارچه فورواردری | انتقال Link Equity به Authority Page خوشه Operations |
| `/modules/booking` | `/modules/document-management` | مدیریت اسناد حمل | اتصال طبیعی خوشه Sales به Documents |
| `/modules/booking` | `/modules/finance-accounting` | مالی چندارزی فورواردری | انتقال Link Equity به Authority Page خوشه Finance |
| `/modules/transport-operations` | `/solutions/shipment-visibility` | دیدپذیری وضعیت محموله | تقویت Silo و مسیر Parent/Child خوشه Operations |
| `/modules/transport-operations` | `/modules/operations-control-tower` | پایش روزانه عملیات | تقویت Silo و مسیر Parent/Child خوشه Operations |
| `/modules/transport-operations` | `/solutions/operations-automation` | اتوماسیون عملیات حمل | تقویت Silo و مسیر Parent/Child خوشه Operations |
| `/modules/transport-operations` | `/solutions/operation-exception-management` | مدیریت Exceptionهای عملیاتی | تقویت Silo و مسیر Parent/Child خوشه Operations |
| `/modules/transport-operations` | `/modules/finance-accounting` | ماژول مالی و حسابداری | انتقال Link Equity به Authority Page خوشه Finance |
| `/modules/transport-operations` | `/product` | نقشه محصول سپند | انتقال Link Equity به Authority Page خوشه Core |
| `/modules/document-management` | `/solutions/document-management` | چرخه تأیید اسناد | تقویت Silo و مسیر Parent/Child خوشه Documents |
| `/modules/document-management` | `/solutions/document-readiness` | کنترل آماده بودن مدارک | تقویت Silo و مسیر Parent/Child خوشه Documents |
| `/modules/document-management` | `/solutions/bill-of-lading-management` | مدیریت HBL و MBL | اتصال طبیعی خوشه Documents به Sea / NVOCC |
| `/modules/document-management` | `/modules/document-checklists` | چک لیست مدارک حمل | تقویت Silo و مسیر Parent/Child خوشه Documents |
| `/modules/finance-accounting` | `/solutions/freight-finance` | محاسبه سود واقعی Shipment | تقویت Silo و مسیر Parent/Child خوشه Finance |
| `/modules/finance-accounting` | `/solutions/payment-workflow` | گردش درخواست تا پرداخت | تقویت Silo و مسیر Parent/Child خوشه Finance |
| `/modules/finance-accounting` | `/solutions/booking-reconciliation` | تطبیق مالی Booking | تقویت Silo و مسیر Parent/Child خوشه Finance |
| `/modules/finance-accounting` | `/modules/pricing-sales` | کنترل نرخ فروش | انتقال Link Equity به Authority Page خوشه Sales |
| `/modules/finance-accounting` | `/modules/transport-operations` | چرخه اجرایی Shipment | انتقال Link Equity به Authority Page خوشه Operations |
| `/modules/workflow-tasks` | `/modules/automatic-tasks` | پیگیری خودکار فروش | اتصال طبیعی خوشه Operations به Sales |
| `/modules/workflow-tasks` | `/solutions/operations-automation` | Ruleهای چندمرحله‌ای عملیات | تقویت Silo و مسیر Parent/Child خوشه Operations |
| `/modules/workflow-tasks` | `/modules/transport-operations` | مدیریت عملیات حمل | انتقال Link Equity به Authority Page خوشه Operations |
| `/modules/automatic-tasks` | `/modules/crm` | CRM تخصصی فورواردری | انتقال Link Equity به Authority Page خوشه Sales |
| `/modules/automatic-tasks` | `/modules/workflow-tasks` | گردش کار و وظایف | اتصال طبیعی خوشه Sales به Operations |
| `/modules/automatic-tasks` | `/solutions/freight-sales-automation` | پیگیری فروش فورواردری | تقویت Silo و مسیر Parent/Child خوشه Sales |
| `/modules/customer-portal-tracking` | `/solutions/shipment-visibility` | کنترل Milestoneهای حمل | اتصال طبیعی خوشه Core به Operations |
| `/modules/customer-portal-tracking` | `/modules/booking` | فرایند ثبت بوکینگ | اتصال طبیعی خوشه Core به Sales |
| `/modules/customer-portal-tracking` | `/modules/finance-accounting` | کنترل مالی پرونده حمل | انتقال Link Equity به Authority Page خوشه Finance |
| `/modules/customer-portal-tracking` | `/product` | معرفی نرم‌افزار مدیریت حمل | انتقال Link Equity به Authority Page خوشه Core |
| `/modules/operations-control-tower` | `/modules/transport-operations` | پرونده عملیاتی محموله | انتقال Link Equity به Authority Page خوشه Operations |
| `/modules/operations-control-tower` | `/solutions/shipment-visibility` | Shipment Visibility داخلی | تقویت Silo و مسیر Parent/Child خوشه Operations |
| `/modules/operations-control-tower` | `/solutions/operation-exception-management` | رسیدگی به استثناهای حمل | تقویت Silo و مسیر Parent/Child خوشه Operations |
| `/modules/document-checklists` | `/modules/document-management` | مخزن اسناد فورواردری | تقویت Silo و مسیر Parent/Child خوشه Documents |
| `/modules/document-checklists` | `/solutions/document-readiness` | Document Readiness حمل | تقویت Silo و مسیر Parent/Child خوشه Documents |
| `/modules/document-checklists` | `/solutions/document-management` | بازبینی و Approval سند | تقویت Silo و مسیر Parent/Child خوشه Documents |
| `/modules/fleet-dispatch` | `/transport-modes/road` | مدیریت حمل جاده‌ای | انتقال Link Equity به Authority Page خوشه Road / Fleet |
| `/modules/fleet-dispatch` | `/solutions/fleet-dispatch-planning` | برنامه‌ریزی اعزام ناوگان | تقویت Silo و مسیر Parent/Child خوشه Road / Fleet |
| `/modules/fleet-dispatch` | `/solutions/fleet-management` | مدیریت ناوگان حمل‌ونقل | تقویت Silo و مسیر Parent/Child خوشه Road / Fleet |
| `/transport-modes/sea` | `/solutions/nvocc` | راهکار NVOCC | تقویت Silo و مسیر Parent/Child خوشه Sea / NVOCC |
| `/transport-modes/sea` | `/solutions/container-management` | مدیریت چرخه کانتینر | تقویت Silo و مسیر Parent/Child خوشه Sea / NVOCC |
| `/transport-modes/sea` | `/solutions/bill-of-lading-management` | کنترل بارنامه‌های حمل | تقویت Silo و مسیر Parent/Child خوشه Sea / NVOCC |
| `/transport-modes/sea` | `/solutions/schedule-management` | مدیریت برنامه حرکت | تقویت Silo و مسیر Parent/Child خوشه Sea / NVOCC |
| `/transport-modes/sea` | `/modules/finance-accounting` | کنترل دریافت و پرداخت حمل | انتقال Link Equity به Authority Page خوشه Finance |
| `/transport-modes/sea` | `/modules/transport-operations` | کنترل اجرای پرونده حمل | انتقال Link Equity به Authority Page خوشه Operations |
| `/transport-modes/air` | `/modules/pricing-sales` | مدیریت نرخ و Quotation | انتقال Link Equity به Authority Page خوشه Sales |
| `/transport-modes/air` | `/modules/booking` | ماژول Booking سپند | اتصال طبیعی خوشه Air Freight به Sales |
| `/transport-modes/air` | `/modules/transport-operations` | نرم‌افزار عملیات حمل‌ونقل | انتقال Link Equity به Authority Page خوشه Operations |
| `/transport-modes/air` | `/modules/document-management` | نرم‌افزار اسناد حمل‌ونقل | اتصال طبیعی خوشه Air Freight به Documents |
| `/transport-modes/air` | `/modules/finance-accounting` | ثبت مالی هر Shipment | انتقال Link Equity به Authority Page خوشه Finance |
| `/transport-modes/road` | `/solutions/fleet-management` | Vehicle و Driver Master | تقویت Silo و مسیر Parent/Child خوشه Road / Fleet |
| `/transport-modes/road` | `/solutions/fleet-dispatch-planning` | تخصیص بدون تداخل مأموریت | تقویت Silo و مسیر Parent/Child خوشه Road / Fleet |
| `/transport-modes/road` | `/modules/fleet-dispatch` | اجرای اعزام ناوگان | تقویت Silo و مسیر Parent/Child خوشه Road / Fleet |
| `/transport-modes/road` | `/modules/transport-operations` | اجرای عملیات Shipment | انتقال Link Equity به Authority Page خوشه Operations |
| `/transport-modes/road` | `/modules/finance-accounting` | حسابداری شرکت فورواردری | انتقال Link Equity به Authority Page خوشه Finance |
| `/transport-modes/rail` | `/solutions/multimodal-transport` | مدیریت حمل چندوجهی | تقویت Silo و مسیر Parent/Child خوشه Multimodal |
| `/transport-modes/rail` | `/solutions/schedule-management` | کنترل ETD و ETA | اتصال طبیعی خوشه Multimodal به Sea / NVOCC |
| `/transport-modes/rail` | `/modules/transport-operations` | مدیریت رویدادهای محموله | انتقال Link Equity به Authority Page خوشه Operations |

## Links Removed / Retargeted

| Source Template | Links Removed or Retargeted | Destination Strategy | Reason |
| --- | --- | --- | --- |
| `layouts/partials/solutions-dropdown` | لینک سراسری مستقیم به همه Platform Solution و Specialized Solutionها | شش Authority موضوعی + `/solutions` | کاهش Sitewide Equity برای Tier 3 و هدایت کاربر به Hub |
| `layouts/marketing` Footer | فهرست سراسری همه Specialized Solutionها و صفحات کم‌اولویت | Product، Modules و Authorityهای Documents/Fleet/NVOCC | کاهش اتکا به Footer و جلوگیری از اهمیت مصنوعی برابر |
| `welcome` Footer | Container، Bill of Lading، Sales Automation و On-Premise به‌صورت Global | Solution Hub و سه Authority موضوعی | حفظ دسترسی از Hub/Contextual بدون Global Link |
| `related-content-pages` | Anchor عمومی «مشاهده صفحه» | عنوان توصیفی همان مقصد | انتقال Intent مقصد و حذف Generic Anchor |
| Platform Related Pages | روابط عمومی و بعضاً بین‌خوشه‌ای | رابطه‌های Cluster-based برای Operations، Finance، Fleet، Rate، Schedule، Multimodal، Security و Supplier | جلوگیری از Related Page تصادفی |

## Technical Issues

| مورد | قبل | بعد | نتیجه |
| --- | ---: | ---: | --- |
| Broken internal targets | 0 | 0 | همه `href`های بررسی‌شده پاسخ کمتر از 400 دارند. |
| Redirect chains | 0 | 0 | هیچ زنجیره Redirect در مسیرهای SEO وجود ندارد. |
| Redirecting application actions | 2 | 2 | `/tracking` و `/organization-portal` عمداً یک 302 مستقیم به Login هدفمند دارند و Indexable نیستند. |
| Non-canonical links to indexable pages | 0 | 0 | لینک‌ها مستقیم به URL Canonical، بدون Query و با convention بدون trailing slash هستند. |
| Sitemap host mismatch | 1 issue | 0 | خروجی `127.0.0.1` از Sitemap حذف شد. |
| Orphan pages | 0 | 0 | همه صفحات از Hub/Navigation و مسیر موضوعی قابل دسترس‌اند. |
| Near-Orphan pages | 40 | 0 | همه صفحات حداقل Contextual یا Related inbound دارند. |
| Generic anchors | موجود در Related CTA | 0 مورد از فهرست ممنوع | Anchorهای مقصد توصیفی و برای مقصدهای پرتکرار متنوع‌اند. |
| Overlinked specialized pages | Sitewide در Mega Menu/Footer | رفع شد | Tier 3 از Global Navigation خارج و از Parent/Authority قابل دسترسی است. |

## Breadcrumb و Hub QA

- تمام 54 صفحه داخلی Breadcrumb قابل مشاهده دارند؛ صفحه Home طبق عرف Breadcrumb ندارد.
- صفحات Solution تخصصی اکنون در Breadcrumb به `/solutions` لینک می‌دهند؛ قبلاً عنوان «راهکارها» بدون لینک بود.
- مطالعه موردی به مسیر `Home → Why Sepand → Case Study` متصل شد، چون Hub مستقل Case Studies در پروژه وجود ندارد و صفحه جدید نیز طبق Scope ساخته نشد.
- `/modules`، `/solutions` و `/compare` دسترسی توصیفی به مجموعه فرزندان را حفظ کرده‌اند.
- برای Transport Modes صفحه Hub مستقل وجود ندارد؛ Breadcrumb موجود به سکشن `#transport-modes` صفحه Home متصل است.

## Files Changed

- `app/Http/Controllers/MarketingSitemapController.php`
- `config/site_internal_linking.php`
- `config/site_seo_overrides.php`
- `public/assets/css/home.css`
- `public/assets/css/marketing.css`
- `resources/views/layouts/marketing.blade.php`
- `resources/views/layouts/partials/solutions-dropdown.blade.php`
- `resources/views/marketing/case-studies/show.blade.php`
- `resources/views/marketing/content-page.blade.php`
- `resources/views/marketing/partials/contextual-paths.blade.php`
- `resources/views/marketing/partials/related-content-pages.blade.php`
- `resources/views/welcome.blade.php`
- `scripts/seo/internal-link-audit.php`
- `scripts/seo/internal-link-report.php`
- `tests/Feature/InternalLinkArchitectureTest.php`
- `tests/Feature/MarketingContentPagesTest.php`

## Validation

- Crawl کامل 55 URL Indexable روی HTML رندرشده.
- کنترل Status، Robots، Self-canonical، Breadcrumb، Query، Redirect source، Broken target، Sitemap host و Anchor Text.
- تست‌های هدفمند معماری و رگرسیون بازاریابی: 36 تست و 7,286 Assertion موفق.
- پیشنهاد پس از Deploy: مقایسه Internal Links گزارش‌شده در GSC و Crawl مجدد با ابزار خارجی پس از Recrawl گوگل.
