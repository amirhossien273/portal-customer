<?php

$appHost = parse_url((string) env('APP_URL', 'http://localhost'), PHP_URL_HOST) ?: 'localhost';
$configuredDomains = (string) env('TENANCY_CENTRAL_DOMAINS', $appHost);

return [
    /*
    | The bare domains that host tenant subdomains. Multiple domains may be
    | supplied as a comma-separated value, for example: example.com,localhost
    */
    'central_domains' => array_values(array_filter(array_map(
        'trim',
        explode(',', $configuredDomains)
    ))),

    'default_tenant' => [
        'id' => env('TENANCY_DEFAULT_ID', '00000000-0000-0000-0000-000000000001'),
        'name' => env('TENANCY_DEFAULT_NAME', env('APP_NAME', 'Default Tenant')),
        'subdomain' => env('TENANCY_DEFAULT_SUBDOMAIN', 'default'),
    ],

    /* Tables automatically constrained by tenant-aware validation rules. */
    'tenant_tables' => [
        'users',
        'menus',
        'groups',
        'user_has_groups',
        'group_has_permissions',
        'group_menu_has_permissions',
        'businesses',
        'provinces',
        'cities',
        'customers',
        'tags',
        'customer_tags',
        'products',
        'transaction_types',
        'transaction_failed_reasons',
        'transactions',
        'responsibles',
        'offers',
        'offer_items',
        'services',
        'costs',
        'equipment_types',
        'lo_countries',
        'lo_cities',
        'bookings',
        'supplier_categories',
        'suppliers',
        'supplier_contact_infos',
        'supplier_types',
        'booking_supplier_parties',
        'booking_containers',
        'booking_trackings',
        'booking_tracking_event_titles',
        'flows',
        'flow_steps',
        'flowables',
        'flowable_histories',
        'flow_task_title_rules',
        'tasks',
        'task_assignees',
        'task_titles',
        'dashboard_shortcuts',
        'dashboard_widget_group',
        'chats',
        'chat_groups',
        'messages',
        'chat_group_has_users',
        'chatables',
        'chat_message_reads',
        'invoices',
        'invoice_items',
        'invoice_sequences',
        'medias',
        'notes',
        'notifications',
        'operation_jobs',
        'operation_shipments',
        'operation_cargos',
        'payments',
        'receipts',
        'settings',
        'tickets',
        'ticket_responses',
    ],
];
