<details class="nav-solutions" @if(request()->routeIs('solutions.*')) data-active="true" @endif>
    <summary @if(request()->routeIs('solutions.*')) aria-current="page" @endif>
        راهکارها
        <svg viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="m4 6 4 4 4-4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </summary>
    <div class="solutions-menu" aria-label="فهرست راهکارهای سپند">
        <a class="solutions-hub-link" href="{{ route('solutions.index') }}" @if(request()->routeIs('solutions.index')) aria-current="page" @endif>
            <span>همه راهکارها</span>
            <small>انتخاب بر اساس مسئله، شواهد محصول و عمق عملیاتی</small>
        </a>
        <span class="solutions-menu-heading">حوزه‌های اصلی</span>
        <a href="{{ route('site.modules.show', ['module' => 'crm']) }}"><span>فروش و CRM</span><small>مشتری، نرخ، پیشنهاد و Booking</small></a>
        <a href="{{ route('site.modules.show', ['module' => 'transport-operations']) }}"><span>عملیات و کنترل</span><small>اجرا، دیدپذیری، هشدار و Exception</small></a>
        <a href="{{ route('site.modules.show', ['module' => 'finance-accounting']) }}"><span>مالی</span><small>هزینه، دریافت، پرداخت و سود پرونده</small></a>
        <a href="{{ route('site.modules.show', ['module' => 'document-management']) }}"><span>اسناد</span><small>مخزن، تأیید، آمادگی و بارنامه</small></a>
        <a href="{{ route('solutions.platform.show', ['solution' => 'fleet-management']) }}"><span>ناوگان</span><small>خودرو، راننده، برنامه‌ریزی و دیسپچ</small></a>
        <a href="{{ route('solutions.nvocc') }}"><span>NVOCC و کانتینر</span><small>دریایی، کانتینر، Schedule و HBL/MBL</small></a>
    </div>
</details>
