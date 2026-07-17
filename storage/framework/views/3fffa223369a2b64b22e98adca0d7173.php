<?php
    $flashItems = collect([
        'success' => session('success'),
        'error' => session('error'),
        'warning' => session('warning'),
        'info' => session('info') ?? session('status') ?? session('message'),
    ])->filter(fn ($message) => filled($message));

    if ($errors->any()) {
        $flashItems->put('error', $errors->first());
    }

    $flashStyles = [
        'success' => ['title' => 'موفقیت', 'color' => '#00ab55', 'bg' => 'rgba(0, 171, 85, .12)', 'border' => 'rgba(0, 171, 85, .25)', 'icon' => 'M9 12.75 11.25 15 15 9.75', 'circle' => true],
        'error' => ['title' => 'خطا', 'color' => '#e7515a', 'bg' => 'rgba(231, 81, 90, .12)', 'border' => 'rgba(231, 81, 90, .25)', 'icon' => 'M6 18 18 6M6 6l12 12', 'circle' => false],
        'warning' => ['title' => 'هشدار', 'color' => '#e2a03f', 'bg' => 'rgba(226, 160, 63, .14)', 'border' => 'rgba(226, 160, 63, .28)', 'icon' => 'M12 9v4m0 4h.01', 'circle' => true],
        'info' => ['title' => 'پیام', 'color' => '#247387', 'bg' => 'rgba(47, 145, 150, .12)', 'border' => 'rgba(47, 145, 150, .25)', 'icon' => 'M12 16v-4m0-4h.01', 'circle' => true],
    ];
?>




































<?php /**PATH /var/www/sepand-crm/portal-customer-site/resources/views/components/common/flash-alerts.blade.php ENDPATH**/ ?>