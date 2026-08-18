@php
    $floatingConsultationOnForm = request()->routeIs('consultation.create');
    $floatingConsultationHref = $floatingConsultationOnForm ? '#consultation-form' : route('consultation.create');
@endphp

<a
    class="floating-consultation-cta"
    id="floating-consultation-cta"
    href="{{ $floatingConsultationHref }}"
    aria-label="درخواست دمو و مشاوره نرم‌افزار حمل‌ونقل سپند"
    data-floating-consultation-cta
    data-ga-event="cta_click"
    data-ga-label="{{ $floatingConsultationOnForm ? 'floating_consultation_form' : 'floating_consultation_global' }}"
>
    <span class="floating-consultation-cta__icon" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none"><path d="M5 4.5h14a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-11a2 2 0 0 1 2-2Zm3-2v4m8-4v4M3 9h18" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/><path d="m10.4 12 4 2.25-4 2.25V12Z" fill="currentColor"/></svg>
    </span>
    <span class="floating-consultation-cta__copy">
        <small>دمو و نیازسنجی محصول</small>
        <strong>درخواست دمو و مشاوره</strong>
    </span>
    <svg class="floating-consultation-cta__arrow" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M19 12H5m6 6-6-6 6-6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
</a>

<script>
(()=>{const cta=document.querySelector('[data-floating-consultation-cta]');if(!cta)return;const mobile=window.matchMedia('(max-width: 840px)'),interactive='input, textarea, select, [contenteditable="true"]';const sync=()=>cta.classList.toggle('is-input-hidden',mobile.matches&&Boolean(document.activeElement?.matches(interactive)));document.addEventListener('focusin',sync);document.addEventListener('focusout',()=>setTimeout(sync,80));if(typeof mobile.addEventListener==='function')mobile.addEventListener('change',sync);sync()})();
</script>
