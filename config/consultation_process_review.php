<?php

return [
    'topics' => [
        'sales' => [
            'label' => 'فروش، مشتریان و استعلام‌ها',
            'questions' => [
                2 => [
                    'id' => 'sales_information_storage',
                    'text' => 'اطلاعات مشتریان و استعلام‌ها را کجا ثبت می‌کنید؟',
                    'options' => [
                        'excel' => 'اکسل',
                        'messages' => 'واتساپ، ایمیل یا یادداشت‌ها',
                        'software' => 'نرم‌افزار',
                        'mixed' => 'ترکیبی از چند روش',
                    ],
                ],
                3 => [
                    'id' => 'sales_main_problem',
                    'text' => 'مهم‌ترین مشکل شما در این بخش چیست؟',
                    'options' => [
                        'forgotten_followups' => 'فراموش شدن پیگیری‌ها',
                        'scattered_customer_data' => 'پراکندگی اطلاعات مشتریان',
                        'unclear_inquiry_status' => 'مشخص نبودن وضعیت استعلام‌ها',
                        'sales_performance_review' => 'دشواری بررسی عملکرد فروش',
                    ],
                ],
                4 => [
                    'id' => 'sales_next_followup',
                    'text' => 'پیگیری بعدی هر مشتری چگونه مشخص می‌شود؟',
                    'options' => [
                        'memory' => 'با حافظه و یادآوری شخصی',
                        'file_or_calendar' => 'در فایل یا تقویم ثبت می‌شود',
                        'software_owner_due_date' => 'در نرم‌افزار مسئول و موعد دارد',
                        'no_method' => 'روش مشخصی نداریم',
                    ],
                ],
            ],
        ],
        'rates' => [
            'label' => 'نرخ‌گیری و ارتباط با تأمین‌کنندگان',
            'questions' => [
                2 => [
                    'id' => 'rates_storage',
                    'text' => 'نرخ‌های دریافتی را کجا نگهداری می‌کنید؟',
                    'options' => [
                        'messages' => 'ایمیل و پیام‌رسان‌ها',
                        'excel' => 'فایل‌های اکسل',
                        'software' => 'نرم‌افزار',
                        'mixed' => 'ترکیبی از چند روش',
                    ],
                ],
                3 => [
                    'id' => 'rates_main_problem',
                    'text' => 'بیشترین مشکل شما در نرخ‌گیری چیست؟',
                    'options' => [
                        'slow_supplier_response' => 'دیر رسیدن پاسخ تأمین‌کنندگان',
                        'comparison' => 'دشواری مقایسه نرخ‌ها و شرایط',
                        'validity' => 'مشخص نبودن اعتبار نرخ‌ها',
                        'history' => 'پیدا نکردن سوابق نرخ و تأمین‌کننده',
                    ],
                ],
                4 => [
                    'id' => 'rates_team_access',
                    'text' => 'در نبود مسئول نرخ‌گیری، همکاران چطور به سوابق دسترسی دارند؟',
                    'options' => [
                        'complete_shared_access' => 'به سوابق کامل و مشترک دسترسی دارند',
                        'partial_access' => 'فقط بخشی از اطلاعات در دسترس است',
                        'ask_owner' => 'باید از خود مسئول پیگیری کنند',
                        'no_method' => 'روش مشخصی نداریم',
                    ],
                ],
            ],
        ],
        'booking' => [
            'label' => 'بوکینگ و هماهنگی حمل',
            'questions' => [
                2 => [
                    'id' => 'booking_registration',
                    'text' => 'درخواست‌ها و تأییدیه‌های بوکینگ را چطور ثبت می‌کنید؟',
                    'options' => [
                        'messages' => 'ایمیل و پیام‌رسان‌ها',
                        'shared_file' => 'اکسل یا فایل مشترک',
                        'software' => 'نرم‌افزار',
                        'mixed' => 'ترکیبی از چند روش',
                    ],
                ],
                3 => [
                    'id' => 'booking_main_problem',
                    'text' => 'بیشترین چالش شما در بوکینگ چیست؟',
                    'options' => [
                        'incomplete_initial_data' => 'ناقص بودن اطلاعات اولیه',
                        'confirmations_and_changes' => 'پیگیری تأییدیه‌ها و تغییرات',
                        'missed_deadlines' => 'فراموش شدن موعدها و اقدام‌ها',
                        'handoff_to_operations' => 'انتقال اطلاعات به عملیات',
                    ],
                ],
                4 => [
                    'id' => 'booking_next_action',
                    'text' => 'مسئول و اقدام بعدی هر بوکینگ چقدر مشخص است؟',
                    'options' => [
                        'always_clear' => 'برای همه بوکینگ‌ها مشخص و ثبت‌شده است',
                        'sometimes_clear' => 'فقط برای بعضی موارد مشخص است',
                        'verbal_followup' => 'بیشتر به پیگیری شفاهی وابسته است',
                        'no_method' => 'روش مشخصی نداریم',
                    ],
                ],
            ],
        ],
        'operations' => [
            'label' => 'عملیات و پیگیری محموله‌ها',
            'questions' => [
                2 => [
                    'id' => 'operations_status_storage',
                    'text' => 'وضعیت پرونده‌ها و محموله‌ها را کجا ثبت می‌کنید؟',
                    'options' => [
                        'excel' => 'اکسل',
                        'messages' => 'ایمیل و پیام‌رسان‌ها',
                        'software' => 'نرم‌افزار',
                        'mixed' => 'ترکیبی از چند روش',
                    ],
                ],
                3 => [
                    'id' => 'operations_main_problem',
                    'text' => 'مهم‌ترین مشکل عملیاتی شما چیست؟',
                    'options' => [
                        'unknown_latest_status' => 'اطلاع نداشتن از آخرین وضعیت محموله',
                        'missed_steps' => 'فراموش شدن مراحل و موعدها',
                        'unclear_owner' => 'مشخص نبودن مسئول اقدام بعدی',
                        'slow_customer_response' => 'زمان‌بر بودن پاسخ به مشتری',
                    ],
                ],
                4 => [
                    'id' => 'operations_status_visibility',
                    'text' => 'مدیر یا همکار شما چطور از آخرین وضعیت پرونده مطلع می‌شود؟',
                    'options' => [
                        'live_system' => 'وضعیت به‌روز در سیستم قابل مشاهده است',
                        'shared_file' => 'فایل مشترک را بررسی می‌کند',
                        'ask_owner' => 'باید از مسئول پرونده بپرسد',
                        'no_consistent_method' => 'روش مشخص و یکسانی نداریم',
                    ],
                ],
            ],
        ],
        'documents' => [
            'label' => 'مدیریت اسناد و مدارک',
            'questions' => [
                2 => [
                    'id' => 'documents_storage',
                    'text' => 'اسناد هر پرونده را کجا نگهداری می‌کنید؟',
                    'options' => [
                        'computer_folders' => 'پوشه‌های کامپیوتر',
                        'messages' => 'ایمیل و پیام‌رسان‌ها',
                        'shared_space_or_software' => 'فضای مشترک یا نرم‌افزار',
                        'mixed' => 'ترکیبی از چند روش',
                    ],
                ],
                3 => [
                    'id' => 'documents_main_problem',
                    'text' => 'بیشترین مشکل شما در مدیریت اسناد چیست؟',
                    'options' => [
                        'finding_documents' => 'پیدا کردن مدارک',
                        'latest_version' => 'تشخیص آخرین نسخه سند',
                        'incomplete_documents' => 'ناقص ماندن مدارک پرونده',
                        'team_access' => 'دسترسی و اشتراک‌گذاری بین همکاران',
                    ],
                ],
                4 => [
                    'id' => 'documents_completeness',
                    'text' => 'کامل بودن مدارک هر پرونده چطور کنترل می‌شود؟',
                    'options' => [
                        'shared_checklist' => 'چک‌لیست مشخص و مشترک داریم',
                        'manual_review' => 'مسئول پرونده به‌صورت دستی بررسی می‌کند',
                        'discover_when_needed' => 'معمولاً هنگام نیاز متوجه کمبود می‌شویم',
                        'no_method' => 'روش مشخصی نداریم',
                    ],
                ],
            ],
        ],
        'finance' => [
            'label' => 'امور مالی و پیگیری تسویه‌ها',
            'questions' => [
                2 => [
                    'id' => 'finance_registration',
                    'text' => 'اطلاعات مالی مرتبط با پرونده‌های حمل را چطور ثبت می‌کنید؟',
                    'options' => [
                        'excel' => 'اکسل',
                        'accounting_software' => 'نرم‌افزار حسابداری',
                        'connected_system' => 'سیستم متصل به پرونده‌های حمل',
                        'mixed' => 'ترکیبی از چند روش',
                    ],
                ],
                3 => [
                    'id' => 'finance_main_problem',
                    'text' => 'بیشترین چالش مالی مرتبط با پرونده‌ها چیست؟',
                    'options' => [
                        'customer_receivables' => 'پیگیری مطالبات مشتریان',
                        'supplier_payments' => 'پیگیری پرداخت به تأمین‌کنندگان',
                        'file_profitability' => 'مشخص شدن هزینه و درآمد هر پرونده',
                        'finance_operations_reconciliation' => 'تطبیق اطلاعات مالی و عملیات',
                    ],
                ],
                4 => [
                    'id' => 'finance_status_visibility',
                    'text' => 'وضعیت مالی هر پرونده چطور مشخص می‌شود؟',
                    'options' => [
                        'live_single_view' => 'در یک محل و به‌روز قابل مشاهده است',
                        'multiple_sources' => 'با بررسی چند فایل یا سیستم',
                        'ask_finance' => 'با پرس‌وجو از واحد مالی',
                        'delayed' => 'معمولاً با تأخیر مشخص می‌شود',
                    ],
                ],
            ],
        ],
        'reporting' => [
            'label' => 'گزارش‌گیری و نظارت مدیریتی',
            'questions' => [
                2 => [
                    'id' => 'reporting_preparation',
                    'text' => 'گزارش‌های مدیریتی را چطور آماده می‌کنید؟',
                    'options' => [
                        'manual_excel' => 'دستی و با اکسل',
                        'multiple_sources' => 'از چند نرم‌افزار و فایل جمع‌آوری می‌کنیم',
                        'integrated_dashboard' => 'از داشبورد یکپارچه استفاده می‌کنیم',
                        'no_regular_reporting' => 'گزارش منظم نداریم',
                    ],
                ],
                3 => [
                    'id' => 'reporting_hardest_information',
                    'text' => 'کدام اطلاعات را سخت‌تر به دست می‌آورید؟',
                    'options' => [
                        'sales_and_inquiries' => 'عملکرد فروش و وضعیت استعلام‌ها',
                        'operations_and_delays' => 'وضعیت پرونده‌ها و تأخیرها',
                        'profitability' => 'هزینه، درآمد و سود پرونده‌ها',
                        'team_workload' => 'عملکرد و حجم کار کارکنان',
                    ],
                ],
                4 => [
                    'id' => 'reporting_time_needed',
                    'text' => 'برای دسترسی به یک گزارش قابل اتکا چقدر زمان نیاز دارید؟',
                    'options' => [
                        'immediate' => 'همان لحظه در دسترس است',
                        'under_one_hour' => 'کمتر از یک ساعت',
                        'hours_to_day' => 'چند ساعت تا یک روز',
                        'over_day_or_unknown' => 'بیشتر از یک روز یا زمان نامشخص',
                    ],
                ],
            ],
        ],
        'coordination' => [
            'label' => 'هماهنگی و انتقال اطلاعات بین بخش‌ها',
            'questions' => [
                2 => [
                    'id' => 'coordination_transfer_method',
                    'text' => 'اطلاعات بین فروش، عملیات و مالی چطور منتقل می‌شود؟',
                    'options' => [
                        'verbal' => 'شفاهی و تلفنی',
                        'messages' => 'ایمیل و پیام‌رسان‌ها',
                        'shared_files' => 'فایل‌های مشترک',
                        'integrated_software' => 'نرم‌افزار یکپارچه',
                    ],
                ],
                3 => [
                    'id' => 'coordination_main_problem',
                    'text' => 'بیشترین مشکل در همکاری بین بخش‌ها چیست؟',
                    'options' => [
                        'duplicate_entry' => 'ورود چندباره اطلاعات',
                        'late_or_incomplete' => 'ناقص یا دیر رسیدن اطلاعات',
                        'unclear_owner' => 'مشخص نبودن مسئول هر کار',
                        'conflicting_information' => 'مغایرت اطلاعات بخش‌ها',
                    ],
                ],
                4 => [
                    'id' => 'coordination_change_notification',
                    'text' => 'وقتی اطلاعات یک پرونده تغییر می‌کند، بخش‌های مرتبط چطور مطلع می‌شوند؟',
                    'options' => [
                        'shared_system' => 'تغییر در سیستم مشترک قابل مشاهده است',
                        'owner_notifies' => 'مسئول پرونده به آن‌ها اطلاع می‌دهد',
                        'self_followup' => 'معمولاً باید خودشان پیگیری کنند',
                        'no_method' => 'روش مشخصی نداریم',
                    ],
                ],
            ],
        ],
    ],
];
