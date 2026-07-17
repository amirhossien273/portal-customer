<div class="sepand-page-loader" role="status" aria-label="در حال بارگذاری">
    <span class="sepand-page-loader__ring" aria-hidden="true"></span>
    <img src="/assets/images/brand/sepand-provided-header.png" alt="" aria-hidden="true">
    <span class="sepand-page-loader__text">در حال بارگذاری...</span>
</div>

<?php if (! $__env->hasRenderedOnce('b00d025b-eac6-416b-97ef-52b9310b16c7')): $__env->markAsRenderedOnce('b00d025b-eac6-416b-97ef-52b9310b16c7'); ?>
    <style>
        .sepand-page-loader {
            position: relative;
            width: 150px;
            height: 150px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .sepand-page-loader img {
            position: relative;
            z-index: 2;
            width: 92px;
            height: 64px;
            object-fit: contain;
            animation: sepand-loader-pulse 1.35s ease-in-out infinite;
        }

        .sepand-page-loader__ring {
            position: absolute;
            inset: 4px;
            border: 3px solid rgba(29, 156, 164, .16);
            border-top-color: #1d9ca4;
            border-right-color: #113d72;
            border-radius: 50%;
            animation: sepand-loader-spin 1.15s linear infinite;
        }

        .sepand-page-loader__text {
            position: relative;
            z-index: 2;
            color: #53647d;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .dark .sepand-page-loader img {
            content: url('/assets/images/brand/sepand-provided-header-dark.png');
        }

        .dark .sepand-page-loader__text { color: #cbd5e1; }

        @keyframes sepand-loader-spin { to { transform: rotate(360deg); } }
        @keyframes sepand-loader-pulse {
            0%, 100% { transform: scale(.94); opacity: .78; }
            50% { transform: scale(1); opacity: 1; }
        }

        @media (prefers-reduced-motion: reduce) {
            .sepand-page-loader__ring,
            .sepand-page-loader img { animation-duration: 2.5s; }
        }
    </style>
<?php endif; ?>
<?php /**PATH /var/www/sepand-crm/portal-customer-site/resources/views/components/loading-logo.blade.php ENDPATH**/ ?>