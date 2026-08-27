<section class="section air-weight-section" id="air-chargeable-weight" aria-labelledby="air-chargeable-weight-title">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-label">منطق وزن در Air Freight</span>
            <h2 class="section-title" id="air-chargeable-weight-title">محاسبه Chargeable Weight در حمل هوایی</h2>
            <p class="section-sub">
                در حمل هوایی، Chargeable Weight با مقایسه Actual / Gross Weight و Volumetric Weight تعیین می‌شود و عدد بزرگ‌تر مبنای Air Freight Rating قرار می‌گیرد.
            </p>
        </div>

        <p class="air-weight-declaration reveal" lang="en" dir="ltr">
            Chargeable Weight in air freight is determined by comparing the shipment's actual weight with its volumetric weight.
        </p>

        <div class="air-weight-example reveal" data-air-weight-example>
            <div class="air-weight-example__head">
                <div>
                    <span>مثال محاسباتی</span>
                    <h3>سه کارتن با ابعاد یکسان</h3>
                </div>
                <p>ضریب قراردادی نمونه: <bdi>۶۰۰۰</bdi></p>
            </div>

            <div class="air-weight-inputs" aria-label="ورودی‌های مثال محاسبه وزن حجمی">
                <div><span>تعداد کارتن</span><strong>۳</strong></div>
                <div><span>ابعاد هر کارتن</span><strong dir="ltr">80 × 60 × 50 cm</strong></div>
                <div><span>Actual / Gross Weight</span><strong dir="ltr">90 kg</strong></div>
            </div>

            <div class="air-weight-formula" aria-label="فرمول نمونه وزن حجمی">
                <span>Volumetric Weight</span>
                <code dir="ltr">80 × 60 × 50 × 3 ÷ 6000 = 120 kg</code>
            </div>

            <div class="air-weight-results" aria-label="نتیجه مقایسه وزن واقعی و حجمی">
                <article>
                    <span>Actual Weight</span>
                    <strong dir="ltr">90 kg</strong>
                </article>
                <article>
                    <span>Volumetric Weight</span>
                    <strong dir="ltr">120 kg</strong>
                </article>
                <article class="is-chargeable">
                    <span>Chargeable Weight</span>
                    <strong dir="ltr">120 kg</strong>
                    <small>عدد بزرگ‌تر انتخاب می‌شود</small>
                </article>
            </div>

            <ol class="air-weight-flow" aria-label="رابطه داده‌های وزن محموله هوایی با نرخ حمل">
                <li><span>Air Shipment</span><small>پرونده حمل هوایی</small></li>
                <li><span>Dimensions &amp; Weight</span><small>ابعاد و وزن ثبت‌شده</small></li>
                <li><span>Chargeable Weight</span><small>وزن قابل محاسبه</small></li>
                <li><span>Air Freight Rating</span><small>ورودی محاسبه نرخ هوایی</small></li>
            </ol>
        </div>

        <aside class="air-weight-product-note reveal" aria-label="نحوه ثبت وزن در محصول سپند">
            <span class="air-weight-product-note__icon" aria-hidden="true">✓</span>
            <div>
                <h3>آنچه در محصول سپند ثبت می‌شود</h3>
                <p>
                    سپند فیلدهای طول، عرض، ارتفاع، حجم بسته، وزن ناخالص و خالص، حجم کل و Chargeable Weight را کنار همان قلم کالا نگه می‌دارد. در منطق فعلی محصول، ضریب ثابت ۵۰۰۰ یا ۶۰۰۰ و محاسبه خودکار آن تأیید نشده است؛ عدد ۶۰۰۰ در مثال بالا فقط یک ضریب قراردادی نمونه است و داده واقعی نرم‌افزار محسوب نمی‌شود.
                </p>
            </div>
        </aside>
    </div>
</section>
<?php /**PATH C:\project\sepand\portal-customer\resources\views/marketing/transport-modes/air-chargeable-weight.blade.php ENDPATH**/ ?>