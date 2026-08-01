@extends('layouts.marketing')

@push('styles')
    .consultation-layout{display:grid;grid-template-columns:.78fr 1.22fr;gap:55px;align-items:start}.consultation-copy{padding:30px;color:#fff;background:var(--navy-900);border-radius:25px}.consultation-copy h2{margin:0 0 12px;font-size:25px}.consultation-copy p{margin:0;color:rgba(255,255,255,.68)}.consultation-copy ul{display:grid;gap:13px;margin:26px 0 0;padding:0;list-style:none}.consultation-copy li{display:flex;gap:9px;align-items:flex-start}.consultation-copy li:before{content:'✓';display:grid;flex:0 0 23px;height:23px;place-items:center;color:var(--navy);background:var(--cyan);border-radius:7px;font-weight:900}
    .consultation-form{padding:31px;background:#fff;border:1px solid var(--line);border-radius:25px;box-shadow:var(--shadow)}.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}.field{display:grid;gap:7px}.field.full{grid-column:1/-1}.field label{color:var(--navy);font-size:13px;font-weight:700}.field input,.field select,.field textarea{width:100%;padding:12px 14px;color:var(--ink);background:#fbfdfd;border:1px solid #d8e5e5;border-radius:12px;outline:0}.field textarea{min-height:120px;resize:vertical}.field input:focus,.field select:focus,.field textarea:focus{border-color:var(--teal);box-shadow:0 0 0 3px rgba(47,145,150,.1)}.form-error{color:#b42318;font-size:11px}.form-status{margin-bottom:20px;padding:14px 17px;color:#126746;background:#e7f7ef;border:1px solid #b8e6d0;border-radius:13px}.form-help{margin:15px 0 0;color:var(--muted);font-size:11px}.honeypot{position:absolute!important;width:1px!important;height:1px!important;overflow:hidden!important;clip:rect(0,0,0,0)!important;white-space:nowrap!important}
    @media(max-width:840px){.consultation-layout{grid-template-columns:1fr}.form-grid{grid-template-columns:1fr}.field.full{grid-column:auto}}
@endpush

@section('content')
<section class="page-hero">
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <div class="breadcrumb"><a href="{{ route('home') }}">صفحه اصلی</a><svg viewBox="0 0 24 24" fill="none"><path d="m9 18 6-6-6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg><span>درخواست مشاوره</span></div>
            <h1>دموی واقعی نرم‌افزار سپند<br><span>برای فرایند شرکت شما</span></h1>
            <p>اطلاعات کوتاهی از شرکت و نیازتان ثبت کنید تا جلسه دمو و نیازسنجی ماژول‌های مناسب هماهنگ شود.</p>
        </div>
        <div class="hero-art reveal"><div class="art-panel"><div class="art-content"><div class="art-head"><span class="art-mark"><svg viewBox="0 0 24 24" fill="none"><path d="M4 13a8 8 0 0 1 16 0v5a2 2 0 0 1-2 2h-2v-7h4M4 13v7H2a2 2 0 0 1-2-2v-5h4Z" stroke="currentColor" stroke-width="1.7"/></svg></span><span class="art-chip">نیازسنجی تخصصی</span></div><h2 class="art-title">از نیاز واقعی تا پیشنهاد دقیق</h2><p class="art-desc">بدون تعهد؛ متناسب با ساختار فروش، عملیات و مالی شما</p><div class="art-bars"><i></i><i></i><i></i><i></i><i></i><i></i></div></div></div></div>
    </div>
</section>

<section class="section">
    <div class="container consultation-layout">
        <aside class="consultation-copy reveal"><h2>در جلسه مشاوره چه اتفاقی می‌افتد؟</h2><p>تمرکز جلسه بر فرایند فعلی و مسئله‌های واقعی شرکت شماست.</p><ul><li>شناخت جریان فروش، Booking و عملیات</li><li>بررسی گلوگاه‌های اسناد و مالی</li><li>نمایش بخش‌های مرتبط در نرم‌افزار واقعی</li><li>پیشنهاد ترکیب ماژول‌ها و مسیر استقرار</li></ul></aside>
        <form class="consultation-form reveal" method="POST" action="{{ route('consultation.store') }}" data-ga-form="consultation_submit">
            @csrf
            <input type="hidden" name="source_page" value="{{ old('source_page', url()->previous()) }}">
            <div class="honeypot" aria-hidden="true"><label for="website">وب‌سایت</label><input id="website" name="website" type="text" tabindex="-1" autocomplete="off"></div>
            @if(session('status'))<div class="form-status" role="status">{{ session('status') }}</div>@endif
            <div class="form-grid">
                <div class="field"><label for="name">نام و نام خانوادگی *</label><input id="name" name="name" type="text" value="{{ old('name') }}" autocomplete="name" required>@error('name')<span class="form-error">{{ $message }}</span>@enderror</div>
                <div class="field"><label for="company">نام شرکت *</label><input id="company" name="company" type="text" value="{{ old('company') }}" autocomplete="organization" required>@error('company')<span class="form-error">{{ $message }}</span>@enderror</div>
                <div class="field"><label for="mobile">شماره تماس *</label><input id="mobile" name="mobile" type="tel" value="{{ old('mobile') }}" inputmode="tel" autocomplete="tel" required>@error('mobile')<span class="form-error">{{ $message }}</span>@enderror</div>
                <div class="field"><label for="email">ایمیل سازمانی</label><input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email">@error('email')<span class="form-error">{{ $message }}</span>@enderror</div>
                <div class="field full"><label for="company_type">نوع کسب‌وکار *</label><select id="company_type" name="company_type" required><option value="">انتخاب کنید</option>@foreach(['شرکت حمل‌ونقل بین‌المللی','شرکت فورواردری','NVOCC','نماینده خط حمل','شرکت لجستیک','سایر'] as $type)<option value="{{ $type }}" @selected(old('company_type') === $type)>{{ $type }}</option>@endforeach</select>@error('company_type')<span class="form-error">{{ $message }}</span>@enderror</div>
                <div class="field full"><label for="message">مهم‌ترین مسئله یا نیاز شما</label><textarea id="message" name="message" placeholder="مثلاً پیگیری فروش، کنترل عملیات، اسناد یا سود هر پرونده">{{ old('message') }}</textarea>@error('message')<span class="form-error">{{ $message }}</span>@enderror</div>
                <div class="field full"><button class="btn btn-primary" type="submit">ثبت درخواست دمو و مشاوره</button><p class="form-help">اطلاعات ثبت‌شده فقط برای پیگیری همین درخواست استفاده می‌شود.</p></div>
            </div>
        </form>
    </div>
</section>
@endsection
