<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
<?php $__currentLoopData = $urls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e($url['loc']); ?></loc>
        <lastmod><?php echo e($url['lastmod']); ?></lastmod>
<?php $__currentLoopData = $url['images'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <image:image>
            <image:loc><?php echo e($image['loc']); ?></image:loc>
            <image:title><?php echo e($image['title']); ?></image:title>
        </image:image>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </url>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</urlset>
<?php /**PATH C:\project\sepand\portal-customer\resources\views/marketing/sitemap.blade.php ENDPATH**/ ?>