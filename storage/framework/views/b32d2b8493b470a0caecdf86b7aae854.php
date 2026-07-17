<div :class="{ 'dark text-white-dark': $store.app.semidark }">
    <nav x-data="sidebar"
        class="sidebar fixed min-h-screen h-full top-0 bottom-0 w-[260px] shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] z-50 transition-all duration-300">
        <div class="bg-white dark:bg-[#0e1726] h-full">
            <div class="flex justify-between items-center px-4 py-3">
                <a href="/" class="main-logo flex items-center gap-2 shrink-0">
                    <img x-show="$store.app.theme !== 'dark'" class="w-[76px] h-11 object-contain flex-none"
                        src="/assets/images/brand/sepand-provided-header.png" alt="سپند" />
                    <img x-show="$store.app.theme === 'dark'" class="w-[76px] h-11 object-contain flex-none"
                        src="/assets/images/brand/sepand-provided-header-dark.png" alt="سپند" />
                    <span class="flex flex-col leading-tight">
                        <span class="text-base font-extrabold text-[#0f305b] dark:text-white">سپند</span>
                        <span class="mt-0.5 text-[10px] font-semibold text-slate-500 dark:text-white-dark">CRM هوشمند حمل و نقل</span>
                    </span>
                </a>
                <a href="javascript:;"
                    class="collapse-icon w-8 h-8 rounded-full flex items-center hover:bg-gray-500/10 dark:hover:bg-dark-light/10 dark:text-white-light transition duration-300 rtl:rotate-180"
                    @click="$store.app.toggleSidebar()">
                    <svg class="w-5 h-5 m-auto" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
<ul class="perfect-scrollbar relative font-semibold space-y-0.5 h-[calc(100vh-80px)] overflow-y-auto overflow-x-hidden p-4 py-0"
        x-data="{
        activeDropdown: 22,
        init() {
            const currentPath = window.location.pathname; 
            document.querySelectorAll('[data-menu-id]').forEach(menu => {
                const children = menu.querySelectorAll('a');
                children.forEach(child => {
                   const href = new URL(child.href).pathname; 
                    if (href === currentPath) {
                        console.log('menu.dataset.menuId: ',menu.dataset.menuId);
                        this.activeDropdown = menu.dataset.menuId;
                        console.log('this.activeDropdown ',this.activeDropdown);
                    }
                });
            });
        }
    }"
    x-init="init()">

    <?php $__currentLoopData = auth()->user()->menus('slider'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php if($menu->children->isEmpty()): ?>
            <li class="menu nav-item">
                <a href="<?php echo e(route($menu->route)); ?>"
                class="nav-link group <?php echo e(request()->routeIs($menu->route) ? 'active' : ''); ?> ">
                    <div class="flex items-center">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 24 24"
                             fill="currentColor"
                             width="24"
                             height="24">
                            <path d="M7 2C3.686 2 1 4.239 1 7v6c0 2.761 2.686 5 6 5h1v3a1 1 0 0 0 1.707.707L13.414 18H17c3.314 0 6-2.239 6-5V7c0-2.761-2.686-5-6-5H7z"/>
                        </svg>

                        <span class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">
                            <?php echo e($menu->title); ?>

                        </span>
                    </div>
                </a>
            </li>

        <?php else: ?>
            <li class="menu nav-item" data-menu-id="<?php echo e($menu->id); ?>">
                <button type="button"
                        class="nav-link group w-full"
                        :class="{ 'active': activeDropdown === '<?php echo e($menu->id); ?>' }"
                        @click="activeDropdown === '<?php echo e($menu->id); ?>'
                            ? activeDropdown = null
                            : activeDropdown = '<?php echo e($menu->id); ?>'">

                    <div class="flex items-center">
                        <svg class="group-hover:!text-primary shrink-0"
                            width="20" height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg">

                            <?php echo $menu->icon; ?>


                        </svg>

                        <span class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">
                            <?php echo e($menu->title); ?>

                        </span>
                    </div>

                    <div class="rtl:rotate-180"
                        :class="{ '!rotate-90': activeDropdown === '<?php echo e($menu->id); ?>' }">
                        <svg width="16" height="16" viewBox="0 0 24 24">
                            <path d="M9 5L15 12L9 19"
                                stroke="currentColor"
                                stroke-width="1.5"
                                fill="none"/>
                        </svg>
                    </div>
                </button>

                <ul x-cloak x-show="activeDropdown === '<?php echo e($menu->id); ?>'" x-collapse
                    class="sub-menu text-gray-500">

                    <?php $__currentLoopData = $menu->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(route($child->route)); ?>"
                            class="<?php echo e(request()->routeIs($child->route) ? 'active' : ''); ?>">
                                <?php echo e($child->title); ?>

                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>
            </li>
        <?php endif; ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php if(Route::has('chats.index')): ?>
        <li class="menu nav-item">
            <a href="<?php echo e(route('chats.index')); ?>"
               class="nav-link group <?php echo e(request()->routeIs('chats.*') ? 'active' : ''); ?>">
                <div class="flex items-center">
                    <svg class="h-6 w-6 shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path opacity="0.5" d="M21 11.5C21 16.194 16.97 20 12 20c-1.156 0-2.261-.206-3.276-.58-.248-.092-.372-.138-.472-.158a1.43 1.43 0 0 0-.269-.014c-.102.009-.213.046-.434.12l-3.156 1.052c-.71.237-1.065.355-1.252.168-.187-.188-.069-.542.168-1.252l1.052-3.156c.074-.222.11-.332.12-.435.009-.1.006-.17-.014-.268-.021-.1-.067-.225-.158-.473a9.15 9.15 0 0 1-.58-3.275c0-4.7 4.029-8.506 9-8.506C17.699 3.223 21 6.806 21 11.5Z" fill="currentColor"/>
                        <path d="M8 10.5h8M8 14h5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    <span class="ltr:pl-3 rtl:pr-3 text-black dark:text-[#506690] dark:group-hover:text-white-dark">
                        گفتگوی سازمانی
                    </span>
                </div>
            </a>
        </li>
    <?php endif; ?>

</ul>

        </div>
    </nav>
</div>
<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("sidebar", () => ({
            init() {
                const selector = document.querySelector('.sidebar ul a[href="' + window.location
                    .pathname + '"]');
                if (selector) {
                    selector.classList.add('active');
                    const ul = selector.closest('ul.sub-menu');
                    if (ul) {
                        let ele = ul.closest('li.menu').querySelectorAll('.nav-link');
                        if (ele) {
                            ele = ele[0];
                            setTimeout(() => {
                                ele.click();
                            });
                        }
                    }
                }
            },
        }));
    });
</script>
<?php /**PATH /var/www/sepand-crm/portal-customer-site/resources/views/components/common/sidebar.blade.php ENDPATH**/ ?>