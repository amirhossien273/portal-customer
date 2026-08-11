<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['name']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['name']); ?>
<?php foreach (array_filter((['name']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php switch($name):
    case ('dashboard'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><path d="M4 4h6v6H4V4Zm10 0h6v10h-6V4ZM4 14h6v6H4v-6Zm10 4h6v2h-6v-2Z"/></svg><?php break; ?>
    <?php case ('inquiries'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><path d="M7 3h10l3 3v15H4V3h3Zm2 5h6m-6 4h7m-7 4h5"/><path d="M16 3v4h4"/></svg><?php break; ?>
    <?php case ('shipments'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><path d="M3 7h11v10H3V7Zm11 3h4l3 3v4h-7v-7ZM7 20a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm10 0a2 2 0 1 0 0-4 2 2 0 0 0 0 0 4Z"/></svg><?php break; ?>
    <?php case ('financials'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><path d="M4 7h16v12H4V7Zm0 4h16M8 16h3"/><path d="m6 7 2-3h8l2 3"/></svg><?php break; ?>
    <?php case ('profile'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/></svg><?php break; ?>
    <?php case ('logout'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><path d="M14 8V4H4v16h10v-4m-3-4h10m-3-3 3 3-3 3"/></svg><?php break; ?>
    <?php case ('menu'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><path d="M4 7h16M4 12h16M4 17h16"/></svg><?php break; ?>
    <?php case ('close'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><path d="m5 5 14 14M19 5 5 19"/></svg><?php break; ?>
    <?php case ('bell'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><path d="M18 8a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9Zm-8 12h4"/></svg><?php break; ?>
    <?php case ('search'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg><?php break; ?>
    <?php case ('arrow-left'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><path d="M19 12H5m6 6-6-6 6-6"/></svg><?php break; ?>
    <?php case ('chevron-left'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><path d="m14 6-6 6 6 6"/></svg><?php break; ?>
    <?php case ('calendar'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><path d="M4 5h16v16H4V5Zm0 5h16M8 3v4m8-4v4"/></svg><?php break; ?>
    <?php case ('route'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><circle cx="6" cy="18" r="2"/><circle cx="18" cy="6" r="2"/><path d="M8 18h3a2 2 0 0 0 2-2V8a2 2 0 0 1 2-2h1"/></svg><?php break; ?>
    <?php case ('box'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><path d="m4 7 8-4 8 4v10l-8 4-8-4V7Zm0 0 8 4 8-4m-8 4v10"/></svg><?php break; ?>
    <?php case ('check'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><path d="m6 12 4 4 8-9"/></svg><?php break; ?>
    <?php case ('clock'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg><?php break; ?>
    <?php case ('location'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><path d="M20 10c0 5-8 11-8 11S4 15 4 10a8 8 0 1 1 16 0Z"/><circle cx="12" cy="10" r="2.5"/></svg><?php break; ?>
    <?php case ('support'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><path d="M4 13a8 8 0 0 1 16 0v5a2 2 0 0 1-2 2h-2v-7h4M4 13v7H2a2 2 0 0 1-2-2v-5h4Z"/></svg><?php break; ?>
    <?php case ('empty'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><path d="M4 7h16v13H4V7Zm4-3h8l2 3M8 12h8m-6 4h4"/></svg><?php break; ?>
    <?php case ('money'): ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M15 8.5c-.7-.4-1.7-.7-2.7-.7-1.5 0-2.8.7-2.8 2s1.1 1.7 2.8 2.1 2.8.9 2.8 2.2-1.3 2.1-2.9 2.1c-1.2 0-2.3-.4-3.1-.9M12 6v12"/></svg><?php break; ?>
    <?php default: ?><svg <?php echo e($attributes); ?> viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/></svg>
<?php endswitch; ?>
<?php /**PATH C:\project\sepand\portal-customer\resources\views/components/portal/icon.blade.php ENDPATH**/ ?>