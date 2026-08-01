@php
    $errorCode = $errorCode ?? '403';
    $errorPageTitle = $errorPageTitle ?? 'دسترسی غیرمجاز';
    $errorTitle = $errorTitle ?? 'اجازهٔ ورود به این بخش را ندارید';
    $errorDescription = $errorDescription ?? 'دسترسی به این صفحه برای حساب کاربری شما فعال نیست. اگر فکر می‌کنید این یک اشتباه است، با مدیر سیستم تماس بگیرید.';
    $errorVisualLabel = $errorVisualLabel ?? 'حریم امن سامانه سپند';
    $localizedErrorCode = strtr((string) $errorCode, ['0' => '۰', '1' => '۱', '2' => '۲', '3' => '۳', '4' => '۴', '5' => '۵', '6' => '۶', '7' => '۷', '8' => '۸', '9' => '۹']);
@endphp
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#f4f9f9">
    <title>{{ $errorPageTitle }} | سپند</title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon.png') }}?v=20260801">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v=20260801">
    <link rel="stylesheet" href="{{ asset('assets/IranSansFont.css') }}">

    <style>
        :root {
            color-scheme: light;
            --navy: #0f305b;
            --navy-deep: #09233f;
            --teal: #2f9196;
            --teal-light: #67c5c5;
            --ink: #17344c;
            --muted: #61778a;
            --surface: rgba(255, 255, 255, .86);
            --border: rgba(47, 145, 150, .17);
        }

        *, *::before, *::after { box-sizing: border-box; }

        html { min-height: 100%; }

        body {
            min-height: 100vh;
            min-height: 100svh;
            margin: 0;
            overflow-x: hidden;
            color: var(--ink);
            background:
                radial-gradient(circle at 88% 5%, rgba(80, 188, 190, .2), transparent 30rem),
                radial-gradient(circle at 4% 100%, rgba(15, 48, 91, .12), transparent 34rem),
                #f4f9f9;
            font-family: IRANSans, Tahoma, Arial, sans-serif;
        }

        button, a { font: inherit; }

        .page {
            position: relative;
            isolation: isolate;
            display: grid;
            min-height: 100vh;
            min-height: 100svh;
            place-items: center;
            padding: clamp(20px, 4vw, 56px);
        }

        .page::before,
        .page::after {
            position: fixed;
            z-index: -1;
            border: 1px solid rgba(47, 145, 150, .12);
            border-radius: 50%;
            content: "";
        }

        .page::before { width: 28rem; height: 28rem; top: -16rem; right: -9rem; }
        .page::after { width: 20rem; height: 20rem; bottom: -12rem; left: -7rem; }

        .card {
            display: grid;
            grid-template-columns: minmax(0, .92fr) minmax(0, 1.08fr);
            width: min(100%, 1050px);
            min-height: min(650px, calc(100svh - 64px));
            overflow: hidden;
            border: 1px solid var(--border);
            border-radius: 32px;
            background: var(--surface);
            box-shadow: 0 32px 80px rgba(15, 48, 91, .14);
            backdrop-filter: blur(20px);
        }

        .content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: clamp(36px, 6vw, 74px);
        }

        .logo { display: inline-flex; align-items: center; width: fit-content; margin-bottom: 54px; }
        .logo img { display: block; width: auto; height: 42px; max-width: 150px; object-fit: contain; }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            width: fit-content;
            margin-bottom: 17px;
            padding: 8px 13px;
            border: 1px solid rgba(47, 145, 150, .2);
            border-radius: 999px;
            color: #24777d;
            background: rgba(47, 145, 150, .08);
            font-size: 12px;
            font-weight: 700;
        }

        .eyebrow::before {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--teal);
            box-shadow: 0 0 0 5px rgba(47, 145, 150, .12);
            content: "";
        }

        h1 {
            margin: 0 0 18px;
            color: var(--navy-deep);
            font-size: clamp(30px, 4vw, 47px);
            line-height: 1.35;
            letter-spacing: -.04em;
        }

        .description {
            max-width: 31rem;
            margin: 0;
            color: var(--muted);
            font-size: clamp(14px, 1.5vw, 16px);
            line-height: 2;
        }

        .actions { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 35px; }

        .button {
            display: inline-flex;
            min-height: 50px;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 0 21px;
            border: 1px solid transparent;
            border-radius: 14px;
            text-decoration: none;
            transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
            cursor: pointer;
        }

        .button:hover { transform: translateY(-2px); }
        .button:focus-visible { outline: 3px solid rgba(47, 145, 150, .28); outline-offset: 3px; }

        .button-primary {
            color: #fff;
            background: linear-gradient(135deg, var(--navy), #174f78);
            box-shadow: 0 12px 24px -12px rgba(15, 48, 91, .8);
        }

        .button-primary:hover { box-shadow: 0 16px 28px -12px rgba(15, 48, 91, .75); }

        .button-secondary {
            border-color: rgba(15, 48, 91, .13);
            color: var(--navy);
            background: rgba(255, 255, 255, .72);
        }

        .button svg { width: 19px; height: 19px; flex: none; }

        .visual {
            position: relative;
            display: grid;
            overflow: hidden;
            place-items: center;
            min-height: 480px;
            background: linear-gradient(145deg, var(--navy-deep), #104064 52%, #287f86);
        }

        .visual::before {
            position: absolute;
            width: 26rem;
            height: 26rem;
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 50%;
            box-shadow: 0 0 0 70px rgba(255, 255, 255, .035), 0 0 0 140px rgba(255, 255, 255, .025);
            content: "";
        }

        .dots {
            position: absolute;
            inset: 0;
            opacity: .18;
            background-image: radial-gradient(circle, #fff 1px, transparent 1.5px);
            background-size: 22px 22px;
            mask-image: linear-gradient(to bottom left, #000, transparent 75%);
        }

        .illustration { position: relative; z-index: 1; display: grid; place-items: center; }

        .code {
            position: absolute;
            top: 50%;
            color: rgba(255, 255, 255, .07);
            font-family: Arial, sans-serif;
            font-size: clamp(170px, 24vw, 290px);
            font-weight: 900;
            letter-spacing: -.08em;
            line-height: 1;
            transform: translateY(-50%);
            user-select: none;
        }

        .shield {
            position: relative;
            display: grid;
            width: 162px;
            height: 184px;
            place-items: center;
            border: 1px solid rgba(255, 255, 255, .28);
            border-radius: 72px 72px 82px 82px;
            color: #fff;
            background: linear-gradient(150deg, rgba(255, 255, 255, .2), rgba(255, 255, 255, .07));
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, .22), 0 25px 55px rgba(0, 0, 0, .25);
            backdrop-filter: blur(12px);
            clip-path: polygon(50% 0, 96% 18%, 89% 70%, 50% 100%, 11% 70%, 4% 18%);
            animation: float 4s ease-in-out infinite;
        }

        .shield svg { width: 70px; height: 70px; filter: drop-shadow(0 9px 15px rgba(0, 0, 0, .2)); }

        .shield.is-not-found {
            width: 166px;
            height: 166px;
            border-radius: 50%;
            clip-path: none;
        }

        .shield.is-not-found svg { width: 88px; height: 88px; }

        .visual-label {
            position: absolute;
            z-index: 2;
            bottom: 42px;
            display: flex;
            align-items: center;
            gap: 9px;
            color: rgba(255, 255, 255, .72);
            font-size: 12px;
        }

        .visual-label::before { width: 30px; height: 1px; background: var(--teal-light); content: ""; }

        @keyframes float { 50% { transform: translateY(-10px); } }

        @media (max-width: 780px) {
            .page { display: block; padding: 0; }

            .card {
                display: flex;
                min-height: 100vh;
                min-height: 100svh;
                flex-direction: column-reverse;
                border: 0;
                border-radius: 0;
                box-shadow: none;
                background: rgba(255, 255, 255, .7);
            }

            .visual { min-height: 38svh; border-radius: 0 0 32px 32px; }
            .visual::before { width: 17rem; height: 17rem; box-shadow: 0 0 0 48px rgba(255, 255, 255, .035); }
            .code { font-size: clamp(130px, 47vw, 190px); }
            .shield { width: 116px; height: 134px; }
            .shield svg { width: 52px; height: 52px; }
            .shield.is-not-found { width: 124px; height: 124px; }
            .shield.is-not-found svg { width: 67px; height: 67px; }
            .visual-label { bottom: 22px; }

            .content { flex: 1; justify-content: flex-start; padding: 27px 24px max(28px, env(safe-area-inset-bottom)); }
            .logo { margin-bottom: 30px; }
            .logo img { height: 34px; max-width: 128px; }
            h1 { margin-bottom: 12px; font-size: clamp(26px, 8vw, 34px); }
            .description { font-size: 14px; line-height: 1.9; }
            .actions { margin-top: 25px; }
            .button { min-height: 48px; flex: 1 1 145px; padding-inline: 15px; font-size: 13px; }
        }

        @media (max-width: 420px) and (max-height: 720px) {
            .visual { min-height: 32svh; }
            .visual-label { display: none; }
            .shield { width: 96px; height: 110px; }
            .shield svg { width: 43px; height: 43px; }
            .shield.is-not-found { width: 98px; height: 98px; }
            .shield.is-not-found svg { width: 54px; height: 54px; }
            .logo { margin-bottom: 18px; }
            .eyebrow { margin-bottom: 11px; padding-block: 6px; }
            .actions { margin-top: 18px; }
        }

        @media (prefers-reduced-motion: reduce) {
            .shield { animation: none; }
            .button { transition: none; }
        }

        @media (prefers-color-scheme: dark) {
            :root { color-scheme: dark; --ink: #e4f1f3; --muted: #a4bac7; --surface: rgba(7, 29, 48, .88); }
            body { background: radial-gradient(circle at 90% 0, rgba(47, 145, 150, .17), transparent 30rem), #061a2c; }
            h1 { color: #f1fbfc; }
            .button-secondary { border-color: rgba(103, 197, 197, .22); color: #bde7e8; background: rgba(255, 255, 255, .06); }
            .eyebrow { color: #80d0d1; }
            .card { border-color: rgba(103, 197, 197, .16); }
        }

        @media (prefers-color-scheme: dark) and (max-width: 780px) {
            .card { background: rgba(7, 29, 48, .72); }
        }
    </style>
</head>
<body>
    <main class="page">
        <section class="card" aria-labelledby="error-title">
            <div class="content">
                <a class="logo" href="{{ url('/') }}" aria-label="صفحه اصلی سپند">
                    <picture>
                        <source srcset="{{ asset('assets/images/brand/sepand-provided-header-dark.png') }}" media="(prefers-color-scheme: dark)">
                        <img src="{{ asset('assets/images/brand/sepand-provided-header.png') }}" alt="سپند">
                    </picture>
                </a>

                <span class="eyebrow">خطای {{ $localizedErrorCode }}</span>
                <h1 id="error-title">{{ $errorTitle }}</h1>
                <p class="description">{{ $errorDescription }}</p>

                <div class="actions">
                    <a class="button button-primary" href="{{ url('/') }}">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M3 11.4 12 4l9 7.4v7.1a1.5 1.5 0 0 1-1.5 1.5h-15A1.5 1.5 0 0 1 3 18.5v-7.1Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                            <path d="M9.3 20v-5.8h5.4V20" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/>
                        </svg>
                        بازگشت به داشبورد
                    </a>
                    <button class="button button-secondary" type="button" onclick="history.length > 1 ? history.back() : location.assign('{{ url('/') }}')">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <path d="M9 6 3 12l6 6M4 12h10.5a5.5 5.5 0 0 1 5.5 5.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        صفحهٔ قبل
                    </button>
                </div>
            </div>

            <div class="visual" aria-hidden="true">
                <div class="dots"></div>
                <div class="code">{{ $errorCode }}</div>
                <div class="illustration">
                    <div class="shield{{ $errorCode === '404' ? ' is-not-found' : '' }}">
                        @if ($errorCode === '404')
                            <svg viewBox="0 0 96 96" fill="none">
                                <circle cx="41" cy="41" r="25" stroke="white" stroke-width="8"/>
                                <path d="m60 60 20 20" stroke="white" stroke-width="9" stroke-linecap="round"/>
                                <path d="M31 41h20M41 31v20" stroke="rgba(255,255,255,.95)" stroke-width="5" stroke-linecap="round"/>
                            </svg>
                        @else
                            <svg viewBox="0 0 80 80" fill="none">
                                <rect x="20" y="35" width="40" height="31" rx="9" fill="rgba(255,255,255,.95)"/>
                                <path d="M28 35v-8c0-7 5.4-13 12-13s12 6 12 13v8" stroke="white" stroke-width="6" stroke-linecap="round"/>
                                <circle cx="40" cy="49" r="4" fill="#206875"/>
                                <path d="M40 52v6" stroke="#206875" stroke-width="4" stroke-linecap="round"/>
                            </svg>
                        @endif
                    </div>
                </div>
                <span class="visual-label">{{ $errorVisualLabel }}</span>
            </div>
        </section>
    </main>
</body>
</html>
