<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#0f305b">
    <meta name="description" content="سپند؛ راهکار یکپارچه، هوشمند و شفاف مدیریت حمل‌ونقل و زنجیره تأمین">
    <title>سپند | مسیر هوشمند تجارت شما</title>
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('assets/images/favicon.png')); ?>?v=20260801">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>?v=20260801">
    <script>document.documentElement.classList.add('js');</script>
    <style>
        @font-face {
            font-family: "IRANSans";
            src: url("<?php echo e(asset('fonts/iransans/woff2/IRANSansWeb(FaNum).woff2')); ?>") format("woff2");
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }
        @font-face {
            font-family: "IRANSans";
            src: url("<?php echo e(asset('fonts/iransans/woff2/IRANSansWeb(FaNum)_Medium.woff2')); ?>") format("woff2");
            font-weight: 500;
            font-style: normal;
            font-display: swap;
        }
        @font-face {
            font-family: "IRANSans";
            src: url("<?php echo e(asset('fonts/iransans/woff2/IRANSansWeb(FaNum)_Bold.woff2')); ?>") format("woff2");
            font-weight: 700;
            font-style: normal;
            font-display: swap;
        }
        @font-face {
            font-family: "IRANSans";
            src: url("<?php echo e(asset('fonts/iransans/woff2/IRANSansWeb(FaNum)_Black.woff2')); ?>") format("woff2");
            font-weight: 900;
            font-style: normal;
            font-display: swap;
        }

        :root {
            --navy: #0f305b;
            --navy-900: #081e39;
            --navy-800: #0b294e;
            --teal: #2f9196;
            --teal-dark: #24777c;
            --cyan: #12d6d2;
            --ink: #11243a;
            --muted: #617086;
            --cloud: #f3f8f8;
            --line: #dce9e9;
            --white: #ffffff;
            --shadow: 0 22px 70px rgba(15, 48, 91, .11);
            --radius-xl: 32px;
            --radius-lg: 22px;
        }

        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; scroll-padding-top: 96px; }
        html, body { max-width: 100%; overflow-x: clip; }
        body {
            margin: 0;
            color: var(--ink);
            background: var(--white);
            font-family: "IRANSans", Tahoma, sans-serif;
            font-size: 15px;
            line-height: 1.9;
            -webkit-font-smoothing: antialiased;
        }
        body.menu-open { overflow: hidden; }
        a { color: inherit; text-decoration: none; }
        button, input, textarea { font: inherit; }
        button { cursor: pointer; }
        img, svg { display: block; }
        .container { width: min(1180px, calc(100% - 40px)); margin-inline: auto; }
        .skip-link {
            position: fixed; top: -80px; right: 18px; z-index: 200;
            padding: 10px 18px; color: #fff; background: var(--navy); border-radius: 10px;
        }
        .skip-link:focus { top: 14px; }

        .site-header {
            position: fixed; inset: 0 0 auto; z-index: 100;
            height: 84px; display: flex; align-items: center;
            border-bottom: 1px solid transparent;
            transition: background .3s ease, box-shadow .3s ease, border-color .3s ease;
        }
        .site-header.scrolled {
            background: rgba(255, 255, 255, .92);
            border-color: rgba(15, 48, 91, .08);
            box-shadow: 0 8px 36px rgba(15, 48, 91, .06);
            backdrop-filter: blur(16px);
        }
        .nav-wrap { display: flex; align-items: center; justify-content: space-between; gap: 32px; }
        .brand { display: inline-flex; width: auto; height: 50px; align-items: center; justify-content: flex-start; gap: 9px; flex: 0 0 auto; }
        .brand img { width: 64px; height: 48px; object-fit: contain; }
        .brand-copy { display: flex; min-width: 100px; flex-direction: column; align-items: center; justify-content: center; line-height: 1.35; text-align: center; white-space: nowrap; }
        .brand-copy strong { color: var(--navy); font-size: 15px; font-weight: 900; }
        .brand-copy small { margin-top: 2px; color: #6d8298; font-size: 9px; font-weight: 600; }
        .main-nav { display: flex; align-items: center; gap: 27px; margin-right: auto; }
        .main-nav > a {
            position: relative; color: #3f5065; font-size: 14px; font-weight: 500;
            transition: color .2s ease;
        }
        .main-nav > a::after {
            content: ""; position: absolute; right: 0; left: 100%; bottom: -8px; height: 2px;
            border-radius: 2px; background: var(--teal); transition: left .25s ease;
        }
        .main-nav > a:hover { color: var(--navy); }
        .main-nav > a:hover::after { left: 0; }
        .portal-actions { display: flex; align-items: center; gap: 8px; }
        .portal-link {
            display: inline-flex; align-items: center; justify-content: center; gap: 9px;
            min-height: 43px; padding: 0 13px; color: var(--navy); background: rgba(255,255,255,.76);
            border: 1px solid rgba(15,48,91,.14); border-radius: 12px; font-size: 11px; font-weight: 700;
            white-space: nowrap; transition: .25s ease;
        }
        .portal-link:hover { color: var(--teal-dark); background: #fff; border-color: var(--teal); transform: translateY(-2px); }
        .portal-link svg { width: 17px; flex: 0 0 auto; }
        .portal-link.organization { color: #fff; background: var(--navy); border-color: var(--navy); box-shadow: 0 9px 22px rgba(15,48,91,.16); }
        .portal-link.organization:hover { color: #fff; background: var(--teal-dark); border-color: var(--teal-dark); }
        .portal-link.tracking { position: relative; }
        .portal-new {
            position: absolute; top: -9px; right: 10px; padding: 1px 7px; color: #fff; background: #20b889;
            border: 2px solid #f7fbfc; border-radius: 20px; font-size: 8px; line-height: 1.6; font-weight: 700;
            box-shadow: 0 4px 10px rgba(32,184,137,.2);
        }
        .mobile-portals { display: none; }
        .menu-toggle {
            display: none; width: 44px; height: 44px; padding: 0; border: 1px solid var(--line);
            border-radius: 12px; color: var(--navy); background: #fff; align-items: center; justify-content: center;
        }
        .menu-toggle svg { width: 22px; }

        .hero {
            position: relative; min-height: 760px; padding: 162px 0 92px; overflow: hidden;
            background:
                radial-gradient(circle at 11% 20%, rgba(18, 214, 210, .11), transparent 28%),
                radial-gradient(circle at 86% 18%, rgba(47, 145, 150, .1), transparent 26%),
                linear-gradient(180deg, #f8fbfc 0%, #fff 100%);
        }
        .hero::before {
            content: ""; position: absolute; inset: 0; pointer-events: none; opacity: .35;
            background-image: radial-gradient(rgba(15, 48, 91, .19) .7px, transparent .7px);
            background-size: 26px 26px; mask-image: linear-gradient(to bottom, #000, transparent 85%);
        }
        .hero-orb {
            position: absolute; width: 430px; height: 430px; left: -250px; top: 170px;
            border: 1px solid rgba(47, 145, 150, .18); border-radius: 50%;
            box-shadow: 0 0 0 70px rgba(47, 145, 150, .025), 0 0 0 140px rgba(47, 145, 150, .018);
        }
        .hero-grid { position: relative; display: grid; grid-template-columns: 1.02fr .98fr; align-items: center; gap: 78px; }
        .eyebrow {
            display: inline-flex; align-items: center; gap: 9px; margin-bottom: 20px; padding: 7px 13px;
            color: var(--teal-dark); background: rgba(47, 145, 150, .09); border: 1px solid rgba(47, 145, 150, .16);
            border-radius: 100px; font-size: 12px; font-weight: 700; letter-spacing: -.1px;
        }
        .eyebrow-dot { width: 7px; height: 7px; background: var(--cyan); border-radius: 50%; box-shadow: 0 0 0 5px rgba(18,214,210,.13); }
        .hero h1 { margin: 0 0 22px; color: var(--navy-900); font-size: clamp(42px, 5vw, 68px); line-height: 1.35; letter-spacing: -2.4px; font-weight: 900; }
        .hero h1 span { position: relative; color: var(--teal); white-space: nowrap; }
        .hero h1 span::after {
            content: ""; position: absolute; right: 4px; bottom: -2px; width: 82%; height: 8px;
            background: url("data:image/svg+xml,%3Csvg width='240' height='12' viewBox='0 0 240 12' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M3 9C60 1 151 2 237 4' stroke='%2312D6D2' stroke-width='5' stroke-linecap='round'/%3E%3C/svg%3E") center/100% 100% no-repeat;
            opacity: .55;
        }
        .hero-copy > p { max-width: 580px; margin: 0 0 31px; color: var(--muted); font-size: 17px; line-height: 2.05; }
        .hero-actions { display: flex; align-items: center; flex-wrap: wrap; gap: 13px; }
        .btn {
            display: inline-flex; min-height: 55px; padding: 0 25px; align-items: center; justify-content: center; gap: 10px;
            border: 1px solid transparent; border-radius: 15px; font-weight: 700; transition: .25s ease;
        }
        .btn svg { width: 19px; transition: transform .25s ease; }
        .btn-primary { color: #fff; background: var(--navy); box-shadow: 0 15px 30px rgba(15, 48, 91, .2); }
        .btn-primary:hover { background: var(--teal-dark); transform: translateY(-3px); box-shadow: 0 19px 34px rgba(47,145,150,.23); }
        .btn-primary:hover svg { transform: translateX(-3px); }
        .btn-secondary { color: var(--navy); background: rgba(255,255,255,.65); border-color: rgba(15,48,91,.15); }
        .btn-secondary:hover { color: var(--teal-dark); border-color: var(--teal); background: #fff; transform: translateY(-3px); }
        .hero-points { display: flex; align-items: center; gap: 25px; margin-top: 35px; color: #5e6f83; font-size: 12px; font-weight: 500; }
        .hero-point { display: inline-flex; align-items: center; gap: 8px; }
        .hero-point svg { width: 18px; color: var(--teal); }

        .hero-visual { position: relative; min-height: 500px; isolation: isolate; }
        .visual-glow { position: absolute; width: 390px; height: 390px; inset: 54px 55px auto auto; border-radius: 50%; background: rgba(18,214,210,.1); filter: blur(4px); z-index: -2; }
        .visual-ring { position: absolute; width: 400px; height: 400px; top: 48px; right: 45px; border: 1px dashed rgba(47,145,150,.34); border-radius: 50%; z-index: -1; animation: spin 50s linear infinite; }
        .dashboard-card {
            position: absolute; top: 48px; right: 12px; width: min(440px, calc(100% - 20px)); min-height: 388px;
            padding: 21px; overflow: hidden; background: rgba(255,255,255,.92); border: 1px solid rgba(255,255,255,.9);
            border-radius: 28px; box-shadow: 0 32px 80px rgba(15,48,91,.17); backdrop-filter: blur(14px);
            transform: perspective(1200px) rotateY(-4deg) rotateX(2deg);
        }
        .dash-head { display: flex; align-items: center; justify-content: space-between; margin-bottom: 26px; }
        .dash-title { display: flex; align-items: center; gap: 11px; }
        .dash-mark { display: grid; width: 36px; height: 36px; place-items: center; color: #fff; background: var(--navy); border-radius: 11px; }
        .dash-mark svg { width: 19px; }
        .dash-title strong { display: block; color: var(--navy); font-size: 13px; line-height: 1.6; }
        .dash-title small { color: #8692a3; font-size: 9px; }
        .live-pill { display: flex; align-items: center; gap: 6px; padding: 5px 9px; color: var(--teal-dark); background: #eaf7f6; border-radius: 99px; font-size: 9px; font-weight: 700; }
        .live-pill i { width: 6px; height: 6px; background: #31c48d; border-radius: 50%; animation: pulse 2s infinite; }
        .route-map { position: relative; height: 142px; padding: 18px 13px; background: linear-gradient(135deg, #f2f8f9, #f9fcfc); border: 1px solid #e4eeee; border-radius: 20px; }
        .route-line { position: absolute; top: 63px; right: 57px; left: 58px; height: 2px; background: repeating-linear-gradient(90deg, var(--teal) 0 8px, transparent 8px 15px); }
        .route-progress { position: absolute; top: 63px; right: 57px; width: 56%; height: 2px; background: var(--cyan); box-shadow: 0 0 10px var(--cyan); }
        .route-nodes { position: relative; display: flex; justify-content: space-between; z-index: 2; }
        .route-node { display: grid; justify-items: center; gap: 8px; width: 90px; color: #6c7b8f; font-size: 9px; }
        .node-icon { display: grid; width: 40px; height: 40px; place-items: center; color: var(--navy); background: #fff; border: 1px solid #dce8e8; border-radius: 13px; box-shadow: 0 6px 15px rgba(15,48,91,.07); }
        .node-icon svg { width: 20px; }
        .route-node.active .node-icon { color: #fff; background: var(--teal); border-color: var(--teal); box-shadow: 0 8px 20px rgba(47,145,150,.25); }
        .route-node strong { color: var(--navy); font-size: 10px; }
        .dash-stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-top: 14px; }
        .dash-stat { padding: 12px; background: #fff; border: 1px solid #e8efef; border-radius: 15px; }
        .dash-stat small { display: block; color: #8491a1; font-size: 8px; }
        .dash-stat strong { display: block; margin-top: 2px; color: var(--navy); font-size: 13px; }
        .dash-stat .teal { color: var(--teal-dark); }
        .mini-chart { display: flex; align-items: end; gap: 3px; height: 18px; margin-top: 8px; direction: ltr; }
        .mini-chart i { display: block; width: 5px; background: #bfe4e3; border-radius: 3px; }
        .mini-chart i:nth-child(1) { height: 7px; } .mini-chart i:nth-child(2) { height: 12px; }
        .mini-chart i:nth-child(3) { height: 9px; } .mini-chart i:nth-child(4) { height: 17px; background: var(--teal); }
        .floating-card {
            position: absolute; z-index: 4; display: flex; align-items: center; gap: 11px; padding: 11px 14px;
            background: rgba(255,255,255,.95); border: 1px solid #e3eded; border-radius: 15px;
            box-shadow: 0 15px 34px rgba(15,48,91,.13); animation: float 5s ease-in-out infinite;
        }
        .floating-card svg { width: 20px; color: var(--teal); }
        .floating-card strong { display: block; color: var(--navy); font-size: 10px; }
        .floating-card span { display: block; color: #8a96a5; font-size: 8px; }
        .float-one { top: 18px; left: -16px; }
        .float-two { bottom: 37px; right: -30px; animation-delay: -2.4s; }
        .float-two .check { display: grid; width: 29px; height: 29px; place-items: center; color: #fff; background: #22b883; border-radius: 50%; }
        .float-two .check svg { width: 15px; color: #fff; }

        .trust-bar { position: relative; z-index: 5; margin-top: -42px; }
        .trust-inner {
            display: grid; grid-template-columns: 1.2fr repeat(4, 1fr); min-height: 94px; align-items: center;
            padding: 10px 30px; background: #fff; border: 1px solid #e3ecec; border-radius: 22px; box-shadow: var(--shadow);
        }
        .trust-copy strong { display: block; color: var(--navy); font-size: 15px; }
        .trust-copy span { color: #8490a0; font-size: 11px; }
        .trust-item { display: flex; align-items: center; justify-content: center; gap: 9px; color: #6a798c; font-size: 12px; font-weight: 500; border-right: 1px solid #e6eeee; }
        .trust-item svg { width: 21px; color: var(--teal); }

        .section { padding: 128px 0; }
        .section-soft { background: var(--cloud); }
        .section-head { max-width: 710px; margin: 0 auto 60px; text-align: center; }
        .section-label { display: inline-flex; align-items: center; gap: 8px; margin-bottom: 12px; color: var(--teal-dark); font-size: 12px; font-weight: 700; }
        .section-label::before, .section-label::after { content: ""; width: 22px; height: 1px; background: var(--teal); opacity: .55; }
        .section-title { margin: 0; color: var(--navy-900); font-size: clamp(30px, 4vw, 44px); line-height: 1.5; letter-spacing: -1.2px; font-weight: 900; }
        .section-title span { color: var(--teal); }
        .section-subtitle { margin: 15px auto 0; color: var(--muted); font-size: 15px; line-height: 2; }

        .services-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; }
        .service-card {
            position: relative; min-height: 294px; padding: 27px 24px; overflow: hidden; background: #fff;
            border: 1px solid #e3ecec; border-radius: var(--radius-lg); transition: .3s ease;
        }
        .service-card::after { content: ""; position: absolute; right: -45px; bottom: -65px; width: 150px; height: 150px; background: rgba(47,145,150,.055); border-radius: 50%; transition: .35s ease; }
        .service-card:hover { border-color: rgba(47,145,150,.4); transform: translateY(-8px); box-shadow: 0 24px 50px rgba(15,48,91,.1); }
        .service-card:hover::after { transform: scale(1.35); background: rgba(47,145,150,.09); }
        .service-icon { display: grid; width: 57px; height: 57px; margin-bottom: 24px; place-items: center; color: var(--teal-dark); background: #eaf6f6; border-radius: 17px; transition: .3s ease; }
        .service-icon svg { width: 27px; }
        .service-card:hover .service-icon { color: #fff; background: var(--teal); transform: rotate(-4deg); }
        .service-card h3 { margin: 0 0 10px; color: var(--navy); font-size: 18px; font-weight: 800; }
        .service-card p { margin: 0; color: var(--muted); font-size: 12px; line-height: 2; }
        .service-link { position: absolute; right: 24px; bottom: 22px; z-index: 2; display: inline-flex; align-items: center; gap: 7px; color: var(--teal-dark); font-size: 11px; font-weight: 700; }
        .service-link svg { width: 15px; transition: transform .2s; }
        .service-card:hover .service-link svg { transform: translateX(-4px); }

        .about-grid { display: grid; grid-template-columns: .94fr 1.06fr; align-items: center; gap: 95px; }
        .about-visual { position: relative; min-height: 510px; }
        .about-panel { position: absolute; inset: 0 45px 32px 0; overflow: hidden; background: var(--navy); border-radius: var(--radius-xl); box-shadow: 0 30px 70px rgba(15,48,91,.2); }
        .about-panel::before { content: ""; position: absolute; width: 370px; height: 370px; left: -120px; top: -120px; border: 1px solid rgba(18,214,210,.22); border-radius: 50%; box-shadow: 0 0 0 55px rgba(18,214,210,.025), 0 0 0 110px rgba(18,214,210,.018); }
        .about-panel::after { content: ""; position: absolute; inset: 0; opacity: .15; background-image: radial-gradient(#fff .7px, transparent .7px); background-size: 24px 24px; }
        .about-content-card { position: absolute; z-index: 2; top: 62px; right: 38px; left: 38px; padding: 28px; color: #fff; }
        .about-logo { display: grid; width: 72px; height: 72px; margin-bottom: 34px; place-items: center; background: #fff; border-radius: 22px; box-shadow: 0 16px 35px rgba(0,0,0,.18); }
        .about-logo img { width: 48px; height: 48px; object-fit: contain; }
        .about-quote { margin: 0; font-size: 21px; line-height: 2; font-weight: 700; }
        .about-meta { display: flex; align-items: center; gap: 12px; margin-top: 25px; color: rgba(255,255,255,.66); font-size: 11px; }
        .about-meta::before { content: ""; width: 28px; height: 2px; background: var(--cyan); }
        .about-badge { position: absolute; z-index: 3; bottom: 0; left: 0; width: 172px; padding: 20px; color: var(--navy); background: #fff; border: 1px solid #e3ecec; border-radius: 20px; box-shadow: var(--shadow); }
        .about-badge strong { display: block; font-size: 20px; font-weight: 900; }
        .about-badge span { color: #79879a; font-size: 10px; }
        .about-badge-line { display: flex; gap: 5px; margin-top: 14px; }
        .about-badge-line i { display: block; height: 4px; flex: 1; background: #d5e8e7; border-radius: 4px; }
        .about-badge-line i:first-child { flex: 2.4; background: var(--teal); }
        .about-copy .section-label { justify-content: flex-start; }
        .about-copy .section-label::after { display: none; }
        .about-copy .section-title { margin-bottom: 20px; }
        .about-copy > p { margin: 0 0 28px; color: var(--muted); font-size: 14px; line-height: 2.2; }
        .about-list { display: grid; grid-template-columns: 1fr 1fr; gap: 14px 18px; margin-bottom: 34px; }
        .about-list-item { display: flex; align-items: center; gap: 10px; color: #3d5067; font-size: 12px; font-weight: 600; }
        .about-list-item span { display: grid; flex: 0 0 auto; width: 25px; height: 25px; place-items: center; color: var(--teal-dark); background: #e7f5f4; border-radius: 8px; }
        .about-list-item svg { width: 14px; }

        .why { position: relative; padding: 122px 0; color: #fff; background: var(--navy-900); overflow: hidden; }
        .why::before { content: ""; position: absolute; width: 600px; height: 600px; top: -380px; right: -100px; border: 1px solid rgba(18,214,210,.17); border-radius: 50%; box-shadow: 0 0 0 90px rgba(18,214,210,.02), 0 0 0 180px rgba(18,214,210,.015); }
        .why::after { content: ""; position: absolute; inset: 0; opacity: .11; background-image: radial-gradient(#fff .65px, transparent .65px); background-size: 25px 25px; }
        .why .container { position: relative; z-index: 2; }
        .why-top { display: grid; grid-template-columns: .8fr 1.2fr; align-items: end; gap: 80px; margin-bottom: 63px; }
        .why .section-label { color: var(--cyan); }
        .why .section-label::before { background: var(--cyan); }
        .why .section-title { color: #fff; }
        .why-intro { margin: 0 0 5px; color: rgba(255,255,255,.62); font-size: 14px; line-height: 2.1; }
        .why-grid { display: grid; grid-template-columns: repeat(4, 1fr); border: 1px solid rgba(255,255,255,.1); border-radius: 24px; overflow: hidden; }
        .why-card { min-height: 270px; padding: 31px 26px; border-left: 1px solid rgba(255,255,255,.1); transition: background .3s; }
        .why-card:last-child { border-left: 0; }
        .why-card:hover { background: rgba(255,255,255,.055); }
        .why-num { color: var(--cyan); font-size: 11px; font-weight: 700; letter-spacing: 1px; }
        .why-icon { display: grid; width: 49px; height: 49px; margin: 22px 0 19px; place-items: center; color: var(--cyan); background: rgba(18,214,210,.1); border: 1px solid rgba(18,214,210,.15); border-radius: 15px; }
        .why-icon svg { width: 24px; }
        .why-card h3 { margin: 0 0 9px; font-size: 16px; font-weight: 700; }
        .why-card p { margin: 0; color: rgba(255,255,255,.56); font-size: 11px; line-height: 2; }

        .process-grid { position: relative; display: grid; grid-template-columns: repeat(4, 1fr); gap: 35px; }
        .process-grid::before { content: ""; position: absolute; top: 32px; right: 12.5%; left: 12.5%; border-top: 1px dashed rgba(47,145,150,.35); }
        .process-item { position: relative; text-align: center; }
        .process-num { position: relative; z-index: 2; display: grid; width: 65px; height: 65px; margin: 0 auto 21px; place-items: center; color: var(--teal-dark); background: #fff; border: 1px solid #cfe3e2; border-radius: 19px; box-shadow: 0 11px 28px rgba(15,48,91,.09); font-size: 17px; font-weight: 900; transition: .3s; }
        .process-item:hover .process-num { color: #fff; background: var(--teal); border-color: var(--teal); transform: translateY(-5px) rotate(-3deg); }
        .process-item h3 { margin: 0 0 8px; color: var(--navy); font-size: 15px; font-weight: 800; }
        .process-item p { max-width: 220px; margin: auto; color: var(--muted); font-size: 11px; line-height: 2; }

        .cta-wrap { padding: 0 0 120px; }
        .cta {
            position: relative; display: grid; grid-template-columns: 1.25fr .75fr; align-items: center; min-height: 300px;
            padding: 56px 65px; overflow: hidden; color: #fff; background: linear-gradient(120deg, var(--teal-dark), var(--teal)); border-radius: 32px; box-shadow: 0 28px 70px rgba(47,145,150,.23);
        }
        .cta::before { content: ""; position: absolute; width: 420px; height: 420px; left: -160px; top: -220px; border: 1px solid rgba(255,255,255,.23); border-radius: 50%; box-shadow: 0 0 0 60px rgba(255,255,255,.025), 0 0 0 120px rgba(255,255,255,.02); }
        .cta::after { content: ""; position: absolute; width: 170px; height: 170px; left: 110px; bottom: -120px; background: rgba(18,214,210,.35); border-radius: 50%; filter: blur(2px); }
        .cta-copy { position: relative; z-index: 2; }
        .cta h2 { max-width: 650px; margin: 0 0 13px; font-size: clamp(28px, 4vw, 40px); line-height: 1.55; font-weight: 900; letter-spacing: -.8px; }
        .cta p { margin: 0; color: rgba(255,255,255,.75); font-size: 13px; }
        .cta-actions { position: relative; z-index: 2; display: flex; justify-content: flex-end; }
        .cta .btn { color: var(--navy); background: #fff; box-shadow: 0 16px 35px rgba(15,48,91,.17); }
        .cta .btn:hover { transform: translateY(-3px); box-shadow: 0 21px 40px rgba(15,48,91,.23); }

        .site-footer { padding: 68px 0 26px; color: rgba(255,255,255,.68); background: var(--navy-900); }
        .footer-grid { display: grid; grid-template-columns: 1.6fr repeat(3, .8fr); gap: 65px; padding-bottom: 48px; }
        .footer-brand img { width: 64px; height: 48px; object-fit: contain; filter: brightness(0) invert(1); opacity: .95; }
        .footer-brand p { max-width: 360px; margin: 22px 0 0; font-size: 12px; line-height: 2.15; }
        .footer-col h3 { margin: 0 0 18px; color: #fff; font-size: 13px; }
        .footer-col a { display: block; width: fit-content; margin-bottom: 10px; font-size: 11px; transition: .2s; }
        .footer-col a:hover { color: var(--cyan); transform: translateX(-3px); }
        .footer-contact { display: flex; align-items: center; gap: 9px; margin-bottom: 12px; font-size: 11px; }
        .footer-contact svg { flex: 0 0 auto; width: 17px; color: var(--cyan); }
        .footer-bottom { display: flex; align-items: center; justify-content: space-between; padding-top: 24px; border-top: 1px solid rgba(255,255,255,.09); font-size: 10px; }
        .footer-status { display: flex; align-items: center; gap: 7px; }
        .footer-status i { width: 7px; height: 7px; background: #34d399; border-radius: 50%; box-shadow: 0 0 0 4px rgba(52,211,153,.1); }

        .reveal { opacity: 1; transform: none; }
        .js .reveal { opacity: 0; transform: translateY(24px); transition: opacity .7s ease, transform .7s ease; }
        .js .reveal.is-visible { opacity: 1; transform: none; }
        .delay-1 { transition-delay: .08s !important; } .delay-2 { transition-delay: .16s !important; }
        .delay-3 { transition-delay: .24s !important; } .delay-4 { transition-delay: .32s !important; }

        /* Slightly larger type scale for improved Persian readability. */
        body { font-size: 17px; }
        .main-nav > a { font-size: 16px; }
        .portal-link { font-size: 13px; }
        .portal-new { font-size: 10px; }
        .eyebrow, .section-label { font-size: 14px; }
        .hero-copy > p { font-size: 19px; }
        .hero-points { font-size: 14px; }
        .trust-copy span, .trust-item { font-size: 13px; }
        .section-subtitle { font-size: 17px; }
        .service-card p, .about-list-item { font-size: 14px; }
        .service-link, .about-meta { font-size: 13px; }
        .about-copy > p, .why-intro { font-size: 16px; }
        .why-card p, .process-item p { font-size: 13px; }
        .why-card h3, .process-item h3 { font-size: 17px; }
        .cta p { font-size: 15px; }
        .footer-brand p, .footer-col a, .footer-contact { font-size: 13px; }
        .footer-bottom { font-size: 12px; }

        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-9px); } }
        @keyframes spin { to { transform: rotate(360deg); } }
        @keyframes pulse { 0%,100% { box-shadow: 0 0 0 0 rgba(49,196,141,.35); } 50% { box-shadow: 0 0 0 6px rgba(49,196,141,0); } }

        @media (max-width: 1024px) {
            .brand-copy { min-width: 0; }
            .brand-copy small { display: none; }
            .main-nav { gap: 18px; }
            .portal-link { padding-inline: 10px; gap: 6px; }
            .hero-grid { gap: 32px; }
            .hero h1 { font-size: 48px; }
            .services-grid { grid-template-columns: repeat(2, 1fr); }
            .about-grid { gap: 48px; }
            .why-grid { grid-template-columns: repeat(2, 1fr); }
            .why-card:nth-child(2) { border-left: 0; }
            .why-card:nth-child(-n+2) { border-bottom: 1px solid rgba(255,255,255,.1); }
            .footer-grid { grid-template-columns: 1.3fr repeat(3, .7fr); gap: 35px; }
        }

        @media (max-width: 820px) {
            .site-header { height: 74px; }
            .brand { width: auto; height: 47px; gap: 7px; flex-basis: auto; }
            .brand img { width: 60px; height: 45px; }
            .brand-copy { min-width: 92px; }
            .brand-copy strong { font-size: 14px; }
            .brand-copy small { display: block; font-size: 8px; }
            .menu-toggle { display: flex; }
            .desktop-portals { display: none; }
            .main-nav {
                position: fixed; inset: 74px 16px auto; display: grid; gap: 0; padding: 15px;
                background: #fff; border: 1px solid var(--line); border-radius: 18px; box-shadow: var(--shadow);
                opacity: 0; visibility: hidden; transform: translateY(-12px); transition: .25s ease;
            }
            .main-nav.open { opacity: 1; visibility: visible; transform: none; }
            .main-nav > a { padding: 12px 10px; border-bottom: 1px solid #edf2f2; }
            .main-nav > a::after { display: none; }
            .mobile-portals { display: grid; grid-template-columns: 1fr 1fr; gap: 9px; padding-top: 14px; }
            .mobile-portals .portal-link { min-height: 47px; padding-inline: 10px; font-size: 11px; }
            .mobile-portals .tracking { grid-column: 1 / -1; }
            .mobile-portals .portal-new { top: -7px; right: 16px; }
            .hero { min-height: auto; padding: 126px 0 110px; }
            .hero-grid { grid-template-columns: 1fr; gap: 55px; }
            .hero-copy { text-align: center; }
            .hero-copy > p { margin-inline: auto; }
            .hero-actions, .hero-points { justify-content: center; }
            .hero-visual { width: min(520px, 100%); margin: auto; }
            .dashboard-card { right: 6%; }
            .float-one { left: 0; }
            .float-two { right: 0; }
            .trust-inner { grid-template-columns: 1fr 1fr; padding: 24px; gap: 20px; }
            .trust-copy { grid-column: 1 / -1; text-align: center; }
            .trust-item { border-right: 0; }
            .section { padding: 96px 0; }
            .about-grid { grid-template-columns: 1fr; }
            .about-visual { width: min(550px, 100%); margin: auto; order: 2; }
            .about-copy { order: 1; }
            .why-top { grid-template-columns: 1fr; gap: 22px; }
            .process-grid { grid-template-columns: repeat(2, 1fr); row-gap: 55px; }
            .process-grid::before { display: none; }
            .cta { grid-template-columns: 1fr; gap: 30px; padding: 48px; text-align: center; }
            .cta-actions { justify-content: center; }
            .footer-grid { grid-template-columns: 1.5fr 1fr 1fr; }
            .footer-brand { grid-column: 1 / -1; }
        }

        @media (max-width: 580px) {
            .container { width: min(100% - 28px, 1180px); }
            .hero { padding-top: 116px; }
            .hero h1 { font-size: 37px; letter-spacing: -1.5px; }
            .hero-copy > p { font-size: 14px; }
            .hero-actions { display: grid; }
            .btn { width: 100%; }
            .hero-points { gap: 13px; font-size: 10px; }
            .hero-visual { min-height: 410px; }
            .dashboard-card { top: 38px; right: 0; width: 100%; min-height: 343px; padding: 15px; transform: none; }
            .visual-ring, .visual-glow { width: 320px; height: 320px; right: 10px; }
            .route-map { height: 126px; padding-inline: 2px; }
            .route-line, .route-progress { top: 57px; right: 42px; }
            .route-node { width: 75px; }
            .node-icon { width: 35px; height: 35px; }
            .dash-stat { padding: 9px; }
            .dash-stat strong { font-size: 10px; }
            .float-one { top: 5px; left: 5px; }
            .float-two { bottom: 0; }
            .trust-bar { margin-top: -53px; }
            .trust-inner { border-radius: 18px; padding: 20px 12px; }
            .trust-item { font-size: 10px; }
            .trust-item svg { width: 18px; }
            .section { padding: 80px 0; }
            .section-head { margin-bottom: 40px; }
            .section-title { font-size: 29px; }
            .services-grid { grid-template-columns: 1fr; }
            .service-card { min-height: 265px; }
            .about-visual { min-height: 445px; }
            .about-panel { inset: 0 0 28px 0; }
            .about-content-card { top: 35px; right: 24px; left: 24px; padding: 16px; }
            .about-quote { font-size: 17px; }
            .about-badge { width: 150px; }
            .about-list { grid-template-columns: 1fr; }
            .why { padding: 80px 0; }
            .why-grid { grid-template-columns: 1fr; }
            .why-card { min-height: auto; border-left: 0; border-bottom: 1px solid rgba(255,255,255,.1); }
            .why-card:nth-child(3) { border-bottom: 1px solid rgba(255,255,255,.1); }
            .why-card:last-child { border-bottom: 0; }
            .process-grid { grid-template-columns: 1fr; }
            .cta-wrap { padding-bottom: 80px; }
            .cta { min-height: 370px; padding: 38px 23px; border-radius: 24px; }
            .footer-grid { grid-template-columns: 1fr 1fr; gap: 35px 22px; }
            .footer-brand { grid-column: 1 / -1; }
            .footer-bottom { align-items: flex-start; gap: 12px; flex-direction: column; }
        }

        @media (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
            *, *::before, *::after { animation-duration: .01ms !important; animation-iteration-count: 1 !important; transition-duration: .01ms !important; }
        }
    </style>
</head>
<body>
    <a class="skip-link" href="#main-content">رفتن به محتوای اصلی</a>

    <header class="site-header" id="site-header">
        <div class="container nav-wrap">
            <a class="brand" href="#top" aria-label="سپند، صفحه اصلی">
                <img src="<?php echo e(asset('assets/images/brand/sepand-provided-header.png')); ?>" alt="" aria-hidden="true">
                <span class="brand-copy" aria-hidden="true">
                    <strong>سپند</strong>
                    <small>CRM هوشمند حمل‌ونقل</small>
                </span>
            </a>
            <nav class="main-nav" id="main-nav" aria-label="منوی اصلی">
                <a href="<?php echo e(route('modules')); ?>">ماژول‌ها</a>
                <a href="<?php echo e(route('pricing')); ?>">تعرفه‌ها</a>
                <a href="<?php echo e(route('about')); ?>">درباره ما</a>
                <a href="#why-us">چرا سپند؟</a>
                <div class="portal-actions mobile-portals" aria-label="ورود به سامانه‌های سپند">
                    <a class="portal-link tracking" href="#contact">
                        <span class="portal-new">جدید</span>
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 15h13V6H7L3 10v5Zm13-6h3l2 3v3h-5V9Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><circle cx="7" cy="17" r="2" stroke="currentColor" stroke-width="1.6"/><circle cx="18" cy="17" r="2" stroke="currentColor" stroke-width="1.6"/></svg>
                        رهگیری محموله
                    </a>
                    <a class="portal-link" href="<?php echo e(route('login')); ?>">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 19V8h16v11M2 19h20M8 8V5h8v3M8 12h2m4 0h2m-8 3h2m4 0h2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        پورتال مشتریان
                    </a>
                    <a class="portal-link organization" href="#contact">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 20V4h10v16M15 9h4v11M3 20h18M8 8h4m-4 4h4m-4 4h4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        پرتال سازمان
                    </a>
                </div>
            </nav>
            <div class="portal-actions desktop-portals" aria-label="ورود به سامانه‌های سپند">
                <a class="portal-link tracking" href="#contact">
                    <span class="portal-new">جدید</span>
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M3 15h13V6H7L3 10v5Zm13-6h3l2 3v3h-5V9Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><circle cx="7" cy="17" r="2" stroke="currentColor" stroke-width="1.6"/><circle cx="18" cy="17" r="2" stroke="currentColor" stroke-width="1.6"/></svg>
                    رهگیری محموله
                </a>
                <a class="portal-link" href="<?php echo e(route('login')); ?>">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 19V8h16v11M2 19h20M8 8V5h8v3M8 12h2m4 0h2m-8 3h2m4 0h2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    پورتال مشتریان
                </a>
                <a class="portal-link organization" href="#contact">
                    <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M5 20V4h10v16M15 9h4v11M3 20h18M8 8h4m-4 4h4m-4 4h4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    پرتال سازمان
                </a>
            </div>
            <button class="menu-toggle" id="menu-toggle" type="button" aria-expanded="false" aria-controls="main-nav" aria-label="باز کردن منو">
                <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
            </button>
        </div>
    </header>

    <main id="main-content">
        <section class="hero" id="top">
            <div class="hero-orb" aria-hidden="true"></div>
            <div class="container hero-grid">
                <div class="hero-copy reveal is-visible">
                    <div class="eyebrow"><span class="eyebrow-dot"></span>راهکار یکپارچه مدیریت حمل‌ونقل</div>
                    <h1>مسیر تجارت شما،<br><span>شفاف‌تر از همیشه</span></h1>
                    <p>سپند، پیچیدگی‌های حمل‌ونقل و زنجیره تأمین را به یک تجربه ساده، قابل‌پیگیری و هوشمند تبدیل می‌کند؛ تا شما با اطمینان بیشتری تصمیم بگیرید.</p>
                    <div class="hero-actions">
                        <a class="btn btn-primary" href="#contact">
                            درخواست مشاوره
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                        <a class="btn btn-secondary" href="#services">
                            مشاهده خدمات
                            <svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="m8 10 4 4 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </div>
                    <div class="hero-points" aria-label="مزیت‌های کلیدی">
                        <span class="hero-point"><svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>پیگیری لحظه‌ای</span>
                        <span class="hero-point"><svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>گزارش‌دهی شفاف</span>
                        <span class="hero-point"><svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>پشتیبانی تخصصی</span>
                    </div>
                </div>

                <div class="hero-visual reveal is-visible delay-2" aria-label="نمایی از داشبورد مدیریت محموله سپند">
                    <div class="visual-glow" aria-hidden="true"></div>
                    <div class="visual-ring" aria-hidden="true"></div>
                    <div class="dashboard-card">
                        <div class="dash-head">
                            <div class="dash-title">
                                <span class="dash-mark"><svg viewBox="0 0 24 24" fill="none"><path d="M4 17V9l8-5 8 5v8l-8 5-8-5Z" stroke="currentColor" stroke-width="1.6"/><path d="m4 9 8 5 8-5M12 14v8" stroke="currentColor" stroke-width="1.6"/></svg></span>
                                <span><strong>محموله فعال</strong><small>نمای کلی فرایند حمل</small></span>
                            </div>
                            <span class="live-pill"><i></i>به‌روزرسانی زنده</span>
                        </div>
                        <div class="route-map">
                            <div class="route-line"></div><div class="route-progress"></div>
                            <div class="route-nodes">
                                <div class="route-node active">
                                    <span class="node-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M4 17V9l8-5 8 5v8l-8 5-8-5Z" stroke="currentColor" stroke-width="1.6"/></svg></span>
                                    <span><strong>ثبت سفارش</strong><br>تکمیل شده</span>
                                </div>
                                <div class="route-node active">
                                    <span class="node-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M3 15h13V6H7L3 10v5Zm13-6h3l2 3v3h-5V9Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><circle cx="7" cy="17" r="2" stroke="currentColor" stroke-width="1.6"/><circle cx="18" cy="17" r="2" stroke="currentColor" stroke-width="1.6"/></svg></span>
                                    <span><strong>در مسیر</strong><br>در حال انجام</span>
                                </div>
                                <div class="route-node">
                                    <span class="node-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M5 20V8h14v12M3 20h18M8 8V4h8v4M9 12h6M9 16h6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span>
                                    <span><strong>تحویل مقصد</strong><br>مرحله بعد</span>
                                </div>
                            </div>
                        </div>
                        <div class="dash-stats">
                            <div class="dash-stat"><small>وضعیت اسناد</small><strong class="teal">تکمیل</strong><div class="mini-chart"><i></i><i></i><i></i><i></i></div></div>
                            <div class="dash-stat"><small>پیشرفت مسیر</small><strong>۶۸٪</strong><div class="mini-chart"><i></i><i></i><i></i><i></i></div></div>
                            <div class="dash-stat"><small>زمان باقی‌مانده</small><strong>۲ روز</strong><div class="mini-chart"><i></i><i></i><i></i><i></i></div></div>
                        </div>
                    </div>
                    <div class="floating-card float-one">
                        <svg viewBox="0 0 24 24" fill="none"><path d="M12 8v4l3 2M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg>
                        <span><strong>کنترل لحظه‌ای</strong><span>در تمام مسیر حمل</span></span>
                    </div>
                    <div class="floating-card float-two">
                        <span class="check"><svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        <span><strong>محموله به‌روزرسانی شد</strong><span>اطلاعات با موفقیت ثبت شد</span></span>
                    </div>
                </div>
            </div>
        </section>

        <div class="trust-bar reveal">
            <div class="container trust-inner">
                <div class="trust-copy"><strong>یک همراه برای تمام مسیر</strong><span>راهکارهای منعطف برای نیازهای متنوع شما</span></div>
                <div class="trust-item"><svg viewBox="0 0 24 24" fill="none"><path d="M3 15h13V6H7L3 10v5Zm13-6h3l2 3v3h-5V9Z" stroke="currentColor" stroke-width="1.6"/><circle cx="7" cy="17" r="2" stroke="currentColor" stroke-width="1.6"/><circle cx="18" cy="17" r="2" stroke="currentColor" stroke-width="1.6"/></svg>حمل زمینی</div>
                <div class="trust-item"><svg viewBox="0 0 24 24" fill="none"><path d="M3 17h18l-2 3H5l-2-3Zm3 0V8h12v9M9 8V4h6v4" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>حمل دریایی</div>
                <div class="trust-item"><svg viewBox="0 0 24 24" fill="none"><path d="m3 14 18-7-7 14-3-6-8-1Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>حمل هوایی</div>
                <div class="trust-item"><svg viewBox="0 0 24 24" fill="none"><path d="M5 20V8h14v12M3 20h18M8 8V4h8v4M9 12h6M9 16h6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>امور گمرکی</div>
            </div>
        </div>

        <section class="section" id="services">
            <div class="container">
                <div class="section-head reveal">
                    <span class="section-label">خدمات سپند</span>
                    <h2 class="section-title">هر آنچه برای یک حمل‌ونقل<br><span>مطمئن و یکپارچه</span> نیاز دارید</h2>
                    <p class="section-subtitle">از برنامه‌ریزی تا تحویل نهایی، جزئیات عملیات شما در یک مسیر شفاف و قابل‌کنترل مدیریت می‌شود.</p>
                </div>
                <div class="services-grid">
                    <article class="service-card reveal delay-1">
                        <span class="service-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M3 15h13V6H7L3 10v5Zm13-6h3l2 3v3h-5V9Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><circle cx="7" cy="17" r="2" stroke="currentColor" stroke-width="1.6"/><circle cx="18" cy="17" r="2" stroke="currentColor" stroke-width="1.6"/></svg></span>
                        <h3>حمل زمینی</h3><p>برنامه‌ریزی و پایش هوشمند حمل جاده‌ای با دسترسی شفاف به وضعیت هر مرحله.</p>
                        <a class="service-link" href="#contact">درخواست مشاوره <svg viewBox="0 0 24 24" fill="none"><path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></a>
                    </article>
                    <article class="service-card reveal delay-2">
                        <span class="service-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M3 17h18l-2 3H5l-2-3Zm3 0V8h12v9M9 8V4h6v4" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M2 22c2-1 3-1 5 0 2-1 3-1 5 0 2-1 3-1 5 0 2-1 3-1 5 0" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/></svg></span>
                        <h3>حمل دریایی</h3><p>مدیریت محموله‌های دریایی و کانتینری با هماهنگی مستمر و مستندسازی دقیق.</p>
                        <a class="service-link" href="#contact">درخواست مشاوره <svg viewBox="0 0 24 24" fill="none"><path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></a>
                    </article>
                    <article class="service-card reveal delay-3">
                        <span class="service-icon"><svg viewBox="0 0 24 24" fill="none"><path d="m3 14 18-7-7 14-3-6-8-1Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="m11 15 4-3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span>
                        <h3>حمل هوایی</h3><p>انتخاب سریع‌ترین مسیر برای محموله‌های حساس به زمان همراه با رهگیری یکپارچه.</p>
                        <a class="service-link" href="#contact">درخواست مشاوره <svg viewBox="0 0 24 24" fill="none"><path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></a>
                    </article>
                    <article class="service-card reveal delay-4">
                        <span class="service-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M5 20V8h14v12M3 20h18M8 8V4h8v4M9 12h6M9 16h6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg></span>
                        <h3>تشریفات گمرکی</h3><p>هماهنگی فرایندهای اسنادی و گمرکی برای عبور روان‌تر محموله از نقاط کلیدی.</p>
                        <a class="service-link" href="#contact">درخواست مشاوره <svg viewBox="0 0 24 24" fill="none"><path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></a>
                    </article>
                </div>
            </div>
        </section>

        <section class="section section-soft" id="about">
            <div class="container about-grid">
                <div class="about-visual reveal">
                    <div class="about-panel">
                        <div class="about-content-card">
                            <span class="about-logo"><img src="<?php echo e(asset('assets/images/brand/sepand-provided-header.png')); ?>" alt=""></span>
                            <p class="about-quote">ما فقط محموله‌ها را جابه‌جا نمی‌کنیم؛ جریان اطلاعات، اعتماد و تصمیم‌گیری را در تمام مسیر به هم متصل می‌کنیم.</p>
                            <div class="about-meta">تفکر یکپارچه سپند</div>
                        </div>
                    </div>
                    <div class="about-badge"><strong>دید ۳۶۰ درجه</strong><span>از سفارش تا تحویل نهایی</span><div class="about-badge-line"><i></i><i></i><i></i></div></div>
                </div>
                <div class="about-copy reveal delay-2">
                    <span class="section-label">درباره ما</span>
                    <h2 class="section-title">فناوری در کنار تجربه؛<br><span>برای یک مسیر مطمئن‌تر</span></h2>
                    <p>سپند با شناخت عمیق از نیازهای کسب‌وکارهای فعال در زنجیره تأمین، بستری یکپارچه برای مدیریت عملیات حمل‌ونقل فراهم کرده است. هدف ما ساده است: کاهش ابهام، افزایش کنترل و ساختن تجربه‌ای که در آن هر تصمیم بر پایه اطلاعات دقیق گرفته شود.</p>
                    <div class="about-list">
                        <div class="about-list-item"><span><svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>فرایندهای شفاف و قابل‌پیگیری</div>
                        <div class="about-list-item"><span><svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>ارتباط منسجم در تمام مراحل</div>
                        <div class="about-list-item"><span><svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>تصمیم‌گیری مبتنی بر داده</div>
                        <div class="about-list-item"><span><svg viewBox="0 0 24 24" fill="none"><path d="m5 12 4 4L19 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg></span>راهکار متناسب با هر کسب‌وکار</div>
                    </div>
                    <a class="btn btn-primary" href="#why-us">چرا سپند؟ <svg viewBox="0 0 24 24" fill="none"><path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></a>
                </div>
            </div>
        </section>

        <section class="why" id="why-us">
            <div class="container">
                <div class="why-top reveal">
                    <div><span class="section-label">چرا سپند؟</span><h2 class="section-title">تفاوتی که در<br><span>تمام مسیر</span> حس می‌کنید</h2></div>
                    <p class="why-intro">ترکیب فناوری، شفافیت عملیاتی و همراهی یک تیم متخصص باعث می‌شود کنترل بیشتری بر زمان، هزینه و کیفیت فرایند حمل داشته باشید.</p>
                </div>
                <div class="why-grid">
                    <article class="why-card reveal delay-1"><span class="why-num">۰۱</span><span class="why-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M4 19V9m5 10V5m5 14v-7m5 7V3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><h3>شفافیت واقعی</h3><p>وضعیت عملیات و اسناد را بدون ابهام و در یک نمای یکپارچه دنبال کنید.</p></article>
                    <article class="why-card reveal delay-2"><span class="why-num">۰۲</span><span class="why-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M12 3a9 9 0 1 0 9 9M12 7v5l3 2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="m17 3 4 1-1 4" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><h3>سرعت و هماهنگی</h3><p>گردش اطلاعات منسجم، اتلاف زمان و رفت‌وبرگشت‌های غیرضروری را کم می‌کند.</p></article>
                    <article class="why-card reveal delay-3"><span class="why-num">۰۳</span><span class="why-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M12 21s7-3 7-9V5l-7-2-7 2v7c0 6 7 9 7 9Z" stroke="currentColor" stroke-width="1.7"/><path d="m9 12 2 2 4-5" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><h3>امنیت و اطمینان</h3><p>اطلاعات حساس کسب‌وکار شما در بستری ساختاریافته و کنترل‌شده مدیریت می‌شود.</p></article>
                    <article class="why-card reveal delay-4"><span class="why-num">۰۴</span><span class="why-icon"><svg viewBox="0 0 24 24" fill="none"><path d="M4 13a8 8 0 0 1 16 0v5a2 2 0 0 1-2 2h-2v-7h4M4 13v7H2a2 2 0 0 1-2-2v-5h4Z" stroke="currentColor" stroke-width="1.7" stroke-linejoin="round"/><path d="M16 20c0 1-1 2-3 2" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/></svg></span><h3>همراهی تخصصی</h3><p>در هر مرحله، تیم سپند برای پاسخ‌گویی و حل سریع چالش‌ها کنار شماست.</p></article>
                </div>
            </div>
        </section>

        <section class="section" id="process">
            <div class="container">
                <div class="section-head reveal">
                    <span class="section-label">مسیر همکاری</span>
                    <h2 class="section-title">شروعی ساده برای یک<br><span>همکاری ماندگار</span></h2>
                    <p class="section-subtitle">فقط در چهار گام، نیازهای شما را به یک فرایند عملیاتی روشن و قابل‌مدیریت تبدیل می‌کنیم.</p>
                </div>
                <div class="process-grid">
                    <article class="process-item reveal delay-1"><span class="process-num">۱</span><h3>ثبت درخواست</h3><p>اطلاعات اولیه و نیاز حمل‌ونقل خود را با ما در میان بگذارید.</p></article>
                    <article class="process-item reveal delay-2"><span class="process-num">۲</span><h3>بررسی و مشاوره</h3><p>تیم ما بهترین سناریو را متناسب با اولویت‌های شما بررسی می‌کند.</p></article>
                    <article class="process-item reveal delay-3"><span class="process-num">۳</span><h3>طراحی راهکار</h3><p>مسیر اجرایی، زمان‌بندی و نقاط کنترلی به‌صورت شفاف مشخص می‌شود.</p></article>
                    <article class="process-item reveal delay-4"><span class="process-num">۴</span><h3>شروع و پایش</h3><p>عملیات آغاز می‌شود و شما تمام مسیر را یکپارچه دنبال می‌کنید.</p></article>
                </div>
            </div>
        </section>

        <section class="cta-wrap" id="contact">
            <div class="container">
                <div class="cta reveal">
                    <div class="cta-copy"><h2>برای ساختن یک مسیر شفاف‌تر آماده‌اید؟</h2><p>با سپند، مدیریت حمل‌ونقل را ساده‌تر، هوشمندتر و قابل‌اعتمادتر تجربه کنید.</p></div>
                    <div class="cta-actions"><a class="btn" href="#process">مشاهده مسیر همکاری <svg viewBox="0 0 24 24" fill="none"><path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg></a></div>
                </div>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand"><a href="#top"><img src="<?php echo e(asset('assets/images/brand/sepand-provided-header.png')); ?>" alt="سپند"></a><p>سپند، بستری یکپارچه برای مدیریت هوشمند حمل‌ونقل؛ با تمرکز بر شفافیت، کنترل و تجربه‌ای مطمئن در تمام مسیر.</p></div>
                <div class="footer-col"><h3>دسترسی سریع</h3><a href="<?php echo e(route('modules')); ?>">ماژول‌ها</a><a href="<?php echo e(route('pricing')); ?>">تعرفه‌ها</a><a href="<?php echo e(route('about')); ?>">درباره ما</a></div>
                <div class="footer-col"><h3>راهکارها</h3><a href="#services">خدمات حمل</a><a href="<?php echo e(route('modules')); ?>">مدیریت عملیات</a><a href="<?php echo e(route('modules')); ?>">مدیریت مشتریان</a></div>
                <div class="footer-col"><h3>ارتباط با ما</h3><a class="footer-contact" href="#contact"><svg viewBox="0 0 24 24" fill="none"><path d="M4 5h16v14H4V5Zm0 1 8 7 8-7" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>درخواست همکاری</a><span class="footer-contact"><svg viewBox="0 0 24 24" fill="none"><path d="M4 13a8 8 0 0 1 16 0v5a2 2 0 0 1-2 2h-2v-7h4M4 13v7H2a2 2 0 0 1-2-2v-5h4Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>پاسخ‌گویی تخصصی</span></div>
            </div>
            <div class="footer-bottom"><span>© <?php echo e(date('Y')); ?> سپند؛ تمامی حقوق محفوظ است.</span><span class="footer-status"><i></i>سامانه‌های سپند فعال هستند</span></div>
        </div>
    </footer>

    <script>
        (() => {
            const header = document.getElementById('site-header');
            const menu = document.getElementById('main-nav');
            const toggle = document.getElementById('menu-toggle');

            const updateHeader = () => header.classList.toggle('scrolled', window.scrollY > 18);
            updateHeader();
            window.addEventListener('scroll', updateHeader, { passive: true });

            toggle.addEventListener('click', () => {
                const open = menu.classList.toggle('open');
                toggle.setAttribute('aria-expanded', String(open));
                toggle.setAttribute('aria-label', open ? 'بستن منو' : 'باز کردن منو');
                document.body.classList.toggle('menu-open', open);
            });

            menu.querySelectorAll('a').forEach(link => link.addEventListener('click', () => {
                menu.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
                document.body.classList.remove('menu-open');
            }));

            const revealItems = document.querySelectorAll('.reveal:not(.is-visible)');
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver((entries, instance) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            instance.unobserve(entry.target);
                        }
                    });
                }, { threshold: .12, rootMargin: '0px 0px -35px' });
                revealItems.forEach(item => observer.observe(item));
            } else {
                revealItems.forEach(item => item.classList.add('is-visible'));
            }

        })();
    </script>
</body>
</html>
<?php /**PATH /var/www/sepand-crm/portal-customer-site/resources/views/welcome.blade.php ENDPATH**/ ?>
