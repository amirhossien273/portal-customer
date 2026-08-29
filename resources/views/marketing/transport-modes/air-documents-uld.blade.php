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
                <span class="section-label">Air-specific Product Evidence 03</span>
                <h2 class="section-title" id="air-documents-title">رابطه MAWB و HAWB در پرونده حمل هوایی</h2>
            </div>
            <p>MAWB و HAWB فقط شماره‌های پراکنده نیستند؛ به Shipment هوایی متصل‌اند و Document Relationship میان Master و House را تشکیل می‌دهند.</p>
        </div>

        <figure class="air-evidence air-document-evidence reveal" data-air-evidence="mawb-hawb" aria-labelledby="air-documents-caption">
            <div class="air-document-preview" role="img" aria-label="نمای ارتباط Air Shipment با MAWB و چند HAWB در پرونده حمل هوایی سپند">
                <div class="air-document-root">
                    <span>Air Shipment</span>
                    <strong dir="ltr">{{ $airDemo['shipment']['reference'] }}</strong>
                    <small>3 Pieces · PVG → DXB → IKA</small>
                </div>
                <i class="air-document-link" aria-hidden="true">↓</i>
                <article class="air-mawb-card">
                    <header><span>Master Air Waybill</span><span class="air-status is-confirmed">{{ $documents['mawb']['status'] }}</span></header>
                    <h3>MAWB <bdi dir="ltr">{{ $documents['mawb']['number'] }}</bdi></h3>
                    <p>Airline Prefix · <bdi dir="ltr">{{ $documents['mawb']['airline_prefix'] }}</bdi></p>
                </article>
                <i class="air-document-link" aria-hidden="true">↓</i>
                <div class="air-hawb-grid" aria-label="HAWBهای متصل به MAWB">
                    @foreach($documents['hawbs'] as $index => $hawb)
                        <article>
                            <span>HAWB {{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                            <strong dir="ltr">{{ $hawb['number'] }}</strong>
                            <small>{{ $hawb['pieces'] }} Piece · {{ $hawb['status'] }}</small>
                        </article>
                    @endforeach
                </div>
            </div>
            <figcaption id="air-documents-caption">ثبت اطلاعات MAWB و HAWB و رابطه Master/House در پرونده حمل هوایی؛ این Preview با Demo Data ساخته شده و داده حساس مشتری یا مالی ندارد.</figcaption>
        </figure>

        <div class="air-document-entity-graph reveal" aria-label="رابطه اسناد حمل هوایی"><span>Air Shipment</span><i>←</i><span>MAWB</span><i>←</i><span>HAWB 01</span><span>HAWB 02</span><span>HAWB 03</span></div>
    </div>
</section>

<section class="section soft air-uld-section" id="air-uld" aria-labelledby="air-uld-title">
    <div class="container">
        <div class="air-split-head reveal">
            <div>
                <span class="section-label">Air-specific Product Evidence 04</span>
                <h2 class="section-title" id="air-uld-title">ULD Assignment در Context پرواز و محموله</h2>
            </div>
            <p>ULD Assignment نوع و شماره Unit، تعداد Pieces، Gross Weight، Flight و Loading Status را به یک رابطه عملیاتی قابل‌مشاهده تبدیل می‌کند.</p>
        </div>

        <figure class="air-evidence air-uld-evidence reveal" data-air-evidence="uld-assignment" aria-labelledby="air-uld-caption">
            <div class="air-uld-preview" role="img" aria-label="نمای تخصیص ULD نوع PMC به Flight EK303 همراه Pieces و Gross Weight در سپند">
                <div class="air-uld-visual" aria-hidden="true"><span>PMC</span><i></i><i></i><i></i></div>
                <div class="air-uld-copy">
                    <span>ULD Assignment</span>
                    <h3 dir="ltr">{{ $uld['number'] }}</h3>
                    <p>این Unit برای Flight <bdi dir="ltr">{{ $uld['flight'] }}</bdi> ثبت شده است.</p>
                </div>
                <dl class="air-uld-data">
                    <div><dt>ULD Type</dt><dd dir="ltr">{{ $uld['type'] }}</dd></div>
                    <div><dt>Pieces</dt><dd>{{ $uld['pieces'] }}</dd></div>
                    <div><dt>Gross Weight</dt><dd dir="ltr">{{ $uld['gross_weight'] }}</dd></div>
                    <div><dt>Flight</dt><dd dir="ltr">{{ $uld['flight'] }}</dd></div>
                    <div class="is-status"><dt>Status</dt><dd><span class="air-status is-{{ $uld['status_key'] }}">{{ $uld['status'] }}</span></dd></div>
                </dl>
            </div>
            <figcaption id="air-uld-caption">نمای دمو ULD Assignment؛ اتصال ULD Type و Number، Pieces و Gross Weight به Flight Number و Loading Status.</figcaption>
        </figure>

        <div class="air-flight-entity-graph reveal" aria-label="رابطه موجودیت‌های عملیات ULD"><span>Air Shipment</span><i>←</i><span>ULD</span><i>←</i><span>Flight</span><i>←</i><span>Airport Milestone</span></div>
    </div>
</section>
