@php
    $roadDemo = config('site_road_demo');
    $pod = $roadDemo['pod'];
@endphp

{{-- TODO: connect POD preview to document module --}}

<section class="section soft road-pod-section" id="road-delivery-pod" aria-labelledby="road-pod-title">
    <div class="container">
        <div class="road-split-head reveal">
            <div>
                <span class="section-label">نمای عملیاتی حمل زمینی 03</span>
                <h2 class="section-title" id="road-pod-title">تحویل و POD؛ پایان قابل اثبات همان سفر</h2>
            </div>
            <p>تأیید تحویل یا POD پس از رسیدن محموله به مقصد به همان پرونده و رویداد تحویل متصل می‌شود. این بخش فقط مدرک تحویل سفر زمینی را نشان می‌دهد و گردش عمومی مدیریت اسناد را تکرار نمی‌کند.</p>
        </div>

        <figure class="road-evidence road-pod-preview reveal" data-road-evidence="delivery-pod" aria-labelledby="road-pod-caption">
            <div role="img" aria-label="نمای POD یا Proof of Delivery و تأیید تحویل محموله زمینی در سپند">
                <header class="road-preview-header">
                    <div><span>تأیید تحویل و POD</span><h3>تحویل در <bdi dir="ltr">{{ $pod['destination'] }}</bdi></h3><p>پرونده <bdi dir="ltr">{{ $pod['shipment'] }}</bdi></p></div>
                    <span class="road-status is-completed">{{ $pod['delivery_status'] }}</span>
                </header>

                <div class="road-pod-layout">
                    <section class="road-delivery-card" aria-label="اطلاعات تحویل محموله">
                        <span>تأیید تحویل</span>
                        <dl>
                            <div><dt>پرونده حمل</dt><dd dir="ltr">{{ $pod['shipment'] }}</dd></div>
                            <div><dt>مقصد</dt><dd dir="ltr">{{ $pod['destination'] }}</dd></div>
                            <div><dt>زمان تحویل</dt><dd dir="ltr">{{ $pod['delivered_at'] }}</dd></div>
                            <div><dt>تحویل‌گیرنده</dt><dd dir="ltr">{{ $pod['received_by'] }}</dd></div>
                            <div><dt>وضعیت تحویل</dt><dd><span class="road-status is-completed">{{ $pod['delivery_status'] }}</span></dd></div>
                            <div><dt>وضعیت POD</dt><dd><span class="road-status is-pod">{{ $pod['pod_status'] }}</span></dd></div>
                        </dl>
                    </section>

                    <article class="road-pod-document">
                        <div class="road-document-sheet" aria-hidden="true"><span>POD</span><i></i><i></i><i></i><strong>✓</strong></div>
                        <div><span>فایل تأیید تحویل</span><h3 dir="ltr">{{ $pod['file_name'] }}</h3><p dir="ltr">{{ $pod['document_type'] }}</p><time dir="ltr">{{ $pod['uploaded_at'] }}</time><small>{{ $pod['pod_status'] }}</small></div>
                    </article>
                </div>

                <ol class="road-pod-flow" aria-label="رابطه تحویل، تأیید گیرنده و POD با پرونده حمل زمینی">
                    <li>تحویل</li><li>تأیید گیرنده</li><li>POD</li><li>اتصال سند به پرونده حمل</li>
                </ol>
            </div>
            <figcaption id="road-pod-caption">تأیید تحویل و POD همان سفر در کنار زمان تحویل، مقصد و وضعیت پرونده نگهداری می‌شوند.</figcaption>
        </figure>

        <div class="road-pod-statuses reveal" aria-label="وضعیت‌های چرخه POD"><span>در انتظار تحویل</span><span>تحویل‌شده</span><span>POD در انتظار</span><span class="is-active">POD بارگذاری‌شده</span><span>POD تأییدشده</span></div>
    </div>
</section>
