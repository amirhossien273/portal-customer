<?php
    $requestPath = '/'.ltrim(request()->path(), '/');
    $requestPath = $requestPath === '//' ? '/' : rtrim($requestPath, '/');
    $requestPath = $requestPath === '' ? '/' : $requestPath;
    $linkingPages = config('site_internal_linking.pages', []);
    $linkingPage = $linkingPages[$requestPath] ?? null;
    $linkTargets = config('site_internal_linking.targets', []);
    $resolvedLinks = collect($linkingPage['links'] ?? [])
        ->map(function (string $targetKey) use ($linkTargets, $linkingPages, $requestPath): ?array {
            $target = $linkTargets[$targetKey] ?? null;
            if (! is_array($target) || ($target['path'] ?? null) === $requestPath) {
                return null;
            }

            $anchors = $target['anchors'] ?? [];
            if ($anchors === []) {
                return null;
            }

            $sourcePaths = array_keys(array_filter(
                $linkingPages,
                static fn (array $page): bool => in_array($targetKey, $page['links'] ?? [], true),
            ));
            $sourceIndex = array_search($requestPath, $sourcePaths, true);
            $variant = (int) sprintf('%u', crc32($requestPath.'>'.$targetKey));
            $target['anchor'] = $anchors[($sourceIndex === false ? $variant : $sourceIndex) % count($anchors)];
            $target['sentence_variant'] = $variant % 4;

            return $target;
        })
        ->filter()
        ->values();
?>

<?php if(is_array($linkingPage) && $resolvedLinks->isNotEmpty()): ?>
<section class="section soft contextual-paths" aria-labelledby="contextual-paths-title" data-internal-link-tier="<?php echo e($linkingPage['tier']); ?>" data-internal-link-cluster="<?php echo e($linkingPage['cluster']); ?>">
    <div class="container">
        <header class="section-head reveal">
            <span class="section-label">مسیر ادامه بررسی</span>
            <h2 class="section-title" id="contextual-paths-title">این موضوع در کدام بخش فرایند ادامه پیدا می‌کند؟</h2>
            <p class="section-sub">این مسیرها بر اساس ارتباط واقعی فرایندها انتخاب شده‌اند؛ هر لینک دامنه مستقل صفحه مقصد را توضیح می‌دهد.</p>
        </header>
        <div class="contextual-paths-copy">
            <?php $__currentLoopData = $resolvedLinks->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $linkGroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p class="crm-intro reveal">
                    <?php $__currentLoopData = $linkGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php switch($link['sentence_variant']):
                            case (0): ?>
                                برای <?php echo e($link['context']); ?>، <a class="contextual-link" href="<?php echo e(route($link['route'], $link['parameters'])); ?>"><?php echo e($link['anchor']); ?></a> را بررسی کنید.<?php break; ?>
                            <?php case (1): ?>
                                اگر مسئله شما <?php echo e($link['context']); ?> است، <a class="contextual-link" href="<?php echo e(route($link['route'], $link['parameters'])); ?>"><?php echo e($link['anchor']); ?></a> ادامه طبیعی این مسیر است.<?php break; ?>
                            <?php case (2): ?>
                                جزئیات <?php echo e($link['context']); ?> در <a class="contextual-link" href="<?php echo e(route($link['route'], $link['parameters'])); ?>"><?php echo e($link['anchor']); ?></a> توضیح داده شده است.<?php break; ?>
                            <?php default: ?>
                                برای تصمیم دقیق‌تر درباره <?php echo e($link['context']); ?>، <a class="contextual-link" href="<?php echo e(route($link['route'], $link['parameters'])); ?>"><?php echo e($link['anchor']); ?></a> را کنار این صفحه ببینید.
                        <?php endswitch; ?>
                        <?php if (! ($loop->last)): ?> <span aria-hidden="true"> </span> <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH C:\project\sepand\portal-customer\resources\views/marketing/partials/contextual-paths.blade.php ENDPATH**/ ?>