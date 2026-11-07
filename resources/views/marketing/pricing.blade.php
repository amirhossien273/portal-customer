@extends('layouts.marketing')

@php
    $title = 'قیمت نرم افزار حمل و نقل و خرید نرم افزار فورواردری | سپند';
    $description = 'قیمت نرم افزار حمل و نقل سپند را بر اساس تعداد کاربران محاسبه کنید و برای خرید نرم افزار فورواردری، دمو و مشاوره تخصصی دریافت کنید.';
@endphp

@push('head')
    <meta name="keywords" content="قیمت نرم افزار حمل و نقل، خرید نرم افزار فورواردری، خرید نرم افزار فورواردی، تعرفه نرم افزار حمل و نقل">
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/marketing-pricing-calculator.css') }}?v=20261107-4">
@endpush

@section('content')
<section class="page-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <div class="breadcrumb"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>تعرفه‌ها</span></div>
            <h1>قیمت نرم افزار حمل و نقل<br><span>و خرید نرم افزار فورواردری</span></h1>
            <p>قیمت نرم افزار حمل و نقل سپند را بر اساس تعداد کاربران محاسبه کنید و برای خرید نرم افزار فورواردری، دوره پرداخت مناسب تیم خود را انتخاب کنید.</p>
            <div class="hero-actions"><a class="btn btn-primary" href="#plans">محاسبه تعرفه</a><a class="btn btn-outline" href="{{ route('modules') }}">مشاهده ماژول‌ها</a></div>
        </div>
        <div class="hero-art reveal"><div class="art-panel"><div class="art-content"><div class="art-head"><span class="art-mark"><svg viewBox="0 0 24 24" fill="none"><path d="M4 7h16v12H4V7Zm3-3h10v3H7V4Zm2 8h6m-3-3v6" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><span class="art-chip">تعرفه شفاف</span></div><h2 class="art-title">متناسب با اندازه تیم شما</h2><p class="art-desc">هرچه تعداد کاربران بیشتر شود، نرخ هر کاربر کاهش پیدا می‌کند</p><div class="art-bars"><i></i><i></i><i></i><i></i><i></i><i></i></div></div></div></div>
    </div>
</section>

<section class="section" id="plans">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">محاسبه تعرفه سپند</span>
            <h2 class="section-title">تعداد کاربران را انتخاب کنید؛<br><span>هزینه را همان لحظه ببینید</span></h2>
            <p class="section-sub">اشتراک سپند از ۵ کاربر آغاز می‌شود و با افزایش تعداد کاربران، نرخ هر کاربر کاهش پیدا می‌کند.</p>
        </div>

        <section class="pricing-calculator reveal" data-pricing-calculator aria-labelledby="pricing-calculator-title">
            <div class="pricing-calculator__controls">
                <div class="pricing-calculator__intro">
                    <span>محاسبه‌گر آنلاین</span>
                    <h3 id="pricing-calculator-title">تعرفه متناسب با اندازه تیم شما</h3>
                    <p>تعداد کاربران و دوره پرداخت را تغییر دهید تا نرخ هر کاربر، مبلغ ماهانه و مبلغ قابل پرداخت نمایش داده شود.</p>
                </div>

                <div class="pricing-billing-toggle" role="group" aria-label="انتخاب دوره پرداخت">
                    <button type="button" data-billing="monthly" aria-pressed="false">پرداخت ماهانه</button>
                    <button type="button" data-billing="annual" aria-pressed="true">پرداخت سالانه <span>به‌صرفه‌تر</span></button>
                </div>

                <div class="pricing-user-control">
                    <div class="pricing-user-control__heading">
                        <label for="pricing-users">تعداد کاربران</label>
                        <div class="pricing-user-stepper">
                            <button type="button" data-user-step="-1" aria-label="کاهش یک کاربر">−</button>
                            <output for="pricing-users" aria-live="polite"><strong data-user-output>۵</strong><span>کاربر</span></output>
                            <button type="button" data-user-step="1" aria-label="افزایش یک کاربر">+</button>
                        </div>
                    </div>
                    <input id="pricing-users" type="range" min="5" max="100" step="1" value="5" data-user-range aria-describedby="pricing-user-help">
                    <div class="pricing-range-labels" aria-hidden="true"><span>۵ کاربر</span><span>۱۰۰ کاربر</span></div>
                    <p id="pricing-user-help">برای تیم‌های بیش از ۱۰۰ کاربر، همین نرخ بازه آخر مبناست و جزئیات استقرار جداگانه بررسی می‌شود.</p>
                </div>

                <div class="pricing-tier-list" aria-label="بازه‌های تعرفه هر کاربر">
                    <article class="is-active" data-price-tier data-min-users="5" data-max-users="10" data-monthly-rate="2500000" data-annual-rate="2200000" aria-current="true"><strong>۵ تا ۱۰ کاربر</strong><span>ماهانه ۲٬۵۰۰٬۰۰۰</span><span>سالانه ۲٬۲۰۰٬۰۰۰ تومان</span></article>
                    <article data-price-tier data-min-users="11" data-max-users="15" data-monthly-rate="2200000" data-annual-rate="1900000"><strong>۱۱ تا ۱۵ کاربر</strong><span>ماهانه ۲٬۲۰۰٬۰۰۰</span><span>سالانه ۱٬۹۰۰٬۰۰۰ تومان</span></article>
                    <article data-price-tier data-min-users="16" data-max-users="25" data-monthly-rate="1900000" data-annual-rate="1600000"><strong>۱۶ تا ۲۵ کاربر</strong><span>ماهانه ۱٬۹۰۰٬۰۰۰</span><span>سالانه ۱٬۶۰۰٬۰۰۰ تومان</span></article>
                    <article data-price-tier data-min-users="26" data-max-users="100" data-monthly-rate="1600000" data-annual-rate="1300000"><strong>۲۶ کاربر به بالا</strong><span>ماهانه ۱٬۶۰۰٬۰۰۰</span><span>سالانه ۱٬۳۰۰٬۰۰۰ تومان</span></article>
                </div>
            </div>

            <aside class="pricing-summary" aria-live="polite">
                <div class="pricing-summary__top"><span data-billing-title>اشتراک سالانه</span><strong data-tier-label>بازه ۵ تا ۱۰ کاربر</strong></div>
                <div class="pricing-summary__unit"><span data-per-user-price>۲٬۲۰۰٬۰۰۰</span><small>تومان برای هر کاربر در ماه</small></div>
                <dl>
                    <div><dt>تعداد کاربران</dt><dd><span data-summary-users>۵</span> کاربر</dd></div>
                    <div><dt>معادل هزینه ماهانه تیم</dt><dd><span data-monthly-total>۱۱٬۰۰۰٬۰۰۰</span> تومان</dd></div>
                    <div class="pricing-summary__payable"><dt data-payable-label>مبلغ پرداخت یک‌ساله</dt><dd><span data-payable-total>۱۳۲٬۰۰۰٬۰۰۰</span> تومان</dd></div>
                    <div class="pricing-summary__saving" data-annual-saving><dt>صرفه‌جویی سالانه</dt><dd><span data-saving-total>۱۸٬۰۰۰٬۰۰۰</span> تومان</dd></div>
                </dl>
                <a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="pricing_calculator_consultation">درخواست دمو و مشاوره خرید</a>
                <p>مبالغ فوق مربوط به اشتراک کاربران است. هزینه استقرار، سفارشی‌سازی، مالیات و خدمات خارج از اشتراک پس از بررسی نیاز اعلام می‌شود.</p>
            </aside>
        </section>

        <section class="custom-panel reveal" aria-labelledby="custom-panel-title">
            <span class="custom-panel__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M4 5h16v14H4V5Zm0 4h16M9 9v10" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M12 12h5m-5 3h3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span>
            <div class="custom-panel__copy"><span>برای نیازهای ویژه سازمان</span><h3 id="custom-panel-title">پنل اختصاصی</h3><p>اگر به ساختار، فرایند، سطح دسترسی یا گزارش‌های اختصاصی نیاز دارید، سناریوی شرکت شما در جلسه دمو بررسی و مسیر مناسب پیشنهاد می‌شود.</p></div>
            <a class="btn btn-primary" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="pricing_custom_panel_demo">درخواست دموی پنل اختصاصی</a>
        </section>
    </div>
</section>

<section class="section soft">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">شفافیت در انتخاب</span><h2 class="section-title">چه عواملی تعرفه را<br><span>مشخص می‌کنند؟</span></h2></div>
        <div class="card-grid">
            <article class="content-card reveal"><span class="card-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M16 20v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm8-2h5m-2.5-2.5v5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><h3>تعداد کاربران</h3><p>تعداد اعضای فعال، بازه نرخ هر کاربر را مشخص می‌کند.</p></article>
            <article class="content-card reveal"><span class="card-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M4 4h6v6H4V4Zm10 0h6v6h-6V4ZM4 14h6v6H4v-6Zm10 0h6v6h-6v-6Z" stroke="currentColor" stroke-width="1.6"/></svg></span><h3>دوره پرداخت</h3><p>پرداخت سالانه با نرخ پایین‌تر از پرداخت ماهانه محاسبه می‌شود.</p></article>
            <article class="content-card reveal"><span class="card-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M12 3a9 9 0 1 0 9 9M12 7v5l3 2M17 3h4v4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><h3>استقرار و خدمات</h3><p>آموزش، مهاجرت داده و سفارشی‌سازی پس از بررسی نیاز جداگانه برآورد می‌شوند.</p></article>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head reveal"><span class="section-label">سؤالات متداول</span><h2 class="section-title">پیش از انتخاب اشتراک</h2></div>
        <div class="faq reveal">
            <details><summary>نرخ هر کاربر چگونه محاسبه می‌شود؟</summary><p>نرخ واحد بر اساس تعداد کل کاربران فعال تعیین می‌شود. بازه‌های تعرفه ۵ تا ۱۰، ۱۱ تا ۱۵، ۱۶ تا ۲۵ و ۲۶ کاربر به بالا هستند.</p></details>
            <details><summary>تفاوت پرداخت ماهانه و سالانه چیست؟</summary><p>در پرداخت سالانه، نرخ ماهانه هر کاربر کمتر است و مبلغ ۱۲ ماه به‌صورت یک‌جا پرداخت می‌شود. محاسبه‌گر، معادل هزینه ماهانه و مبلغ کل سال را هم‌زمان نشان می‌دهد.</p></details>
            <details><summary>امکان افزایش تعداد کاربران وجود دارد؟</summary><p>بله. با رشد تیم می‌توانید تعداد کاربران را افزایش دهید و نرخ واحد بر اساس بازه جدید محاسبه می‌شود.</p></details>
            <details><summary>آیا هزینه استقرار و سفارشی‌سازی در اشتراک محاسبه شده است؟</summary><p>خیر. مبالغ محاسبه‌گر مربوط به اشتراک کاربران است؛ آموزش، مهاجرت داده، سفارشی‌سازی، استقرار و مالیات پس از بررسی نیاز به‌صورت جداگانه اعلام می‌شوند.</p></details>
        </div>
    </div>
</section>

<section class="cta-wrap"><div class="container"><div class="cta reveal"><div class="cta-copy"><h2>برای دریافت پیشنهاد دقیق آماده‌اید؟</h2><p>تعداد کاربران را انتخاب کنید و برای بررسی استقرار و خدمات موردنیاز با تیم سپند گفت‌وگو کنید.</p></div><div class="cta-action"><a class="btn" href="{{ route('consultation.create') }}" data-ga-event="cta_click" data-ga-label="pricing_bottom_consultation">درخواست دمو و مشاوره خرید</a></div></div></div></section>
@endsection

@push('scripts')
<script>
(()=>{
    const calculator=document.querySelector('[data-pricing-calculator]');
    if(!calculator)return;
    const range=calculator.querySelector('[data-user-range]');
    const billingButtons=[...calculator.querySelectorAll('[data-billing]')];
    const tierElements=[...calculator.querySelectorAll('[data-price-tier]')];
    const tiers=tierElements.map(element=>({
        element,
        min:Number(element.dataset.minUsers),
        max:Number(element.dataset.maxUsers),
        monthly:Number(element.dataset.monthlyRate),
        annual:Number(element.dataset.annualRate),
        label:element.querySelector('strong').textContent.trim(),
    }));
    const formatter=new Intl.NumberFormat('fa-IR');
    let billing='annual';

    const findTier=users=>tiers.find(tier=>users>=tier.min&&users<=tier.max)||tiers[tiers.length-1];
    const setText=(selector,value)=>{const element=calculator.querySelector(selector);if(element)element.textContent=value};
    const render=()=>{
        const users=Number(range.value);
        const tier=findTier(users);
        const perUser=tier[billing];
        const monthlyTotal=perUser*users;
        const payable=billing==='annual'?monthlyTotal*12:monthlyTotal;
        const saving=(tier.monthly-tier.annual)*users*12;
        const progress=((users-Number(range.min))/(Number(range.max)-Number(range.min)))*100;

        range.style.setProperty('--range-progress',progress+'%');
        setText('[data-user-output]',formatter.format(users));
        setText('[data-summary-users]',formatter.format(users));
        setText('[data-tier-label]','بازه '+tier.label);
        setText('[data-per-user-price]',formatter.format(perUser));
        setText('[data-monthly-total]',formatter.format(monthlyTotal));
        setText('[data-payable-total]',formatter.format(payable));
        setText('[data-saving-total]',formatter.format(saving));
        setText('[data-billing-title]',billing==='annual'?'اشتراک سالانه':'اشتراک ماهانه');
        setText('[data-payable-label]',billing==='annual'?'مبلغ پرداخت یک‌ساله':'مبلغ پرداخت ماه جاری');
        calculator.querySelector('[data-annual-saving]').hidden=billing!=='annual';

        billingButtons.forEach(button=>button.setAttribute('aria-pressed',String(button.dataset.billing===billing)));
        tiers.forEach(item=>{
            const active=item===tier;
            item.element.classList.toggle('is-active',active);
            if(active)item.element.setAttribute('aria-current','true');
            else item.element.removeAttribute('aria-current');
        });
    };

    range.addEventListener('input',render);
    calculator.querySelectorAll('[data-user-step]').forEach(button=>button.addEventListener('click',()=>{
        const next=Math.min(Number(range.max),Math.max(Number(range.min),Number(range.value)+Number(button.dataset.userStep)));
        range.value=String(next);
        render();
    }));
    billingButtons.forEach(button=>button.addEventListener('click',()=>{billing=button.dataset.billing;render()}));
    render();
})();
</script>
@endpush
