@php
    $airDemo = config('site_air_demo');
    $documents = $airDemo['documents'];
    $uld = $airDemo['uld'];
@endphp

{{-- TODO: connect MAWB/HAWB data to document module --}}
{{-- TODO: connect ULD assignment to production cargo data --}}

<section class="section air-documents-section" id="air-documents" aria-labelledby="air-documents-title">
    <div class="container">
        <div class="air-split-head reveal">
            <div>
                <span class="section-label">نمای عملیاتی حمل هوایی 03</span>
                <h2 class="section-title" id="air-documents-title">رابطه MAWB و HAWB در پرونده حمل هوایی</h2>
            </div>
            <p>MAWB و HAWB فقط شماره‌های پراکنده نیستند؛ به پرونده حمل هوایی متصل‌اند و رابطه اسناد میان بارنامه مادر و بارنامه‌های House را تشکیل می‌دهند.</p>
        </div>

        <figure class="air-evidence air-document-evidence reveal" data-air-evidence="mawb-hawb" aria-labelledby="air-documents-caption">
            <div class="air-document-preview" role="img" aria-label="نمای ارتباط پرونده حمل هوایی با MAWB و چند HAWB در سپند">
                <div class="air-document-root">
                    <span>پرونده حمل هوایی</span>
                    <strong dir="ltr">{{ $airDemo['shipment']['reference'] }}</strong>
                    <small>۳ بسته · <bdi dir="ltr">PVG → DXB → IKA</bdi></small>
                </div>
                <i class="air-document-link" aria-hidden="true">↓</i>
                <article class="air-mawb-card">
                    <header><span>بارنامه مادر هوایی</span><span class="air-status is-confirmed">{{ $documents['mawb']['status'] }}</span></header>
                    <h3>MAWB <bdi dir="ltr">{{ $documents['mawb']['number'] }}</bdi></h3>
                    <p>پیش‌شماره ایرلاین · <bdi dir="ltr">{{ $documents['mawb']['airline_prefix'] }}</bdi></p>
                </article>
                <i class="air-document-link" aria-hidden="true">↓</i>
                <div class="air-hawb-grid" aria-label="HAWBهای متصل به MAWB">
                    @foreach($documents['hawbs'] as $index => $hawb)
                        <article>
                            <span>HAWB {{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                            <strong dir="ltr">{{ $hawb['number'] }}</strong>
                            <small>۱ بسته · {{ $hawb['status'] }}</small>
                        </article>
                    @endforeach
                </div>
            </div>
            <figcaption id="air-documents-caption">ثبت اطلاعات MAWB و HAWB و رابطه بارنامه مادر با بارنامه‌های House؛  </figcaption>
        </figure>

        <div class="air-document-entity-graph reveal" aria-label="رابطه اسناد حمل هوایی؛ ترتیب از راست به چپ است"><strong>رابطه اسناد</strong><ol class="air-entity-flow"><li>پرونده حمل هوایی</li><li>MAWB</li><li>HAWB 01</li><li>HAWB 02</li><li>HAWB 03</li></ol></div>
    </div>
</section>

<section class="section soft air-uld-section" id="air-uld" aria-labelledby="air-uld-title">
    <div class="container">
        <div class="air-split-head reveal">
            <div>
                <span class="section-label">نمای عملیاتی حمل هوایی 04</span>
                <h2 class="section-title" id="air-uld-title">تخصیص ULD در بستر پرواز و محموله</h2>
            </div>
            <p>تخصیص ULD، نوع و شماره ULD، تعداد بسته‌ها، وزن ناخالص، پرواز و وضعیت بارگیری را در یک ساختار عملیاتی کنار هم نشان می‌دهد.</p>
        </div>

        <figure class="air-evidence air-uld-evidence reveal" data-air-evidence="uld-assignment" aria-labelledby="air-uld-caption">
            <div class="air-uld-preview" role="img" aria-label="نمای تخصیص ULD نوع PMC به پرواز EK303 همراه تعداد بسته‌ها و وزن ناخالص در سپند">
                <div class="air-uld-visual" aria-hidden="true"><span>PMC</span><i></i><i></i><i></i></div>
                <div class="air-uld-copy">
                    <span>تخصیص ULD</span>
                    <h3 dir="ltr">{{ $uld['number'] }}</h3>
                    <p>این ULD برای پرواز <bdi dir="ltr">{{ $uld['flight'] }}</bdi> ثبت شده است.</p>
                </div>
                <dl class="air-uld-data">
                    <div><dt>نوع ULD</dt><dd dir="ltr">{{ $uld['type'] }}</dd></div>
                    <div><dt>تعداد بسته‌ها</dt><dd>{{ $uld['pieces'] }}</dd></div>
                    <div><dt>وزن ناخالص</dt><dd dir="ltr">{{ $uld['gross_weight'] }}</dd></div>
                    <div><dt>پرواز</dt><dd dir="ltr">{{ $uld['flight'] }}</dd></div>
                    <div class="is-status"><dt>وضعیت</dt><dd><span class="air-status is-{{ $uld['status_key'] }}">{{ $uld['status'] }}</span></dd></div>
                </dl>
            </div>
            <figcaption id="air-uld-caption">نمای نمونه تخصیص ULD و ارتباط نوع و شماره آن، تعداد بسته‌ها و وزن ناخالص با شماره پرواز و وضعیت بارگیری.</figcaption>
        </figure>

        <div class="air-flight-entity-graph reveal" aria-label="رابطه موجودیت‌های عملیات ULD؛ ترتیب از راست به چپ است"><strong>تخصیص عملیاتی</strong><ol class="air-entity-flow"><li>پرونده حمل هوایی</li><li>ULD</li><li>پرواز</li><li>نقطه عطف فرودگاهی</li></ol></div>
    </div>
</section>
