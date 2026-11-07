<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultationProcessReviewRequest;
use App\Models\ConsultationRequest;
use App\Services\ConsultationSmsNotifier;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Throwable;

class MarketingConsultationController extends Controller
{
    public function create(): View
    {
        return view('marketing.consultation-demo', [
            'title' => 'درخواست دمو نرم‌افزار حمل‌ونقل و مشاوره خرید | سپند',
            'description' => 'درخواست دموی نرم‌افزار مدیریت حمل‌ونقل سپند؛ فرایندهای فروش، Booking، عملیات، اسناد و مالی شرکت خود را بررسی و ماژول‌های مناسب را انتخاب کنید.',
            'canonical' => route('consultation.create'),
            'image' => asset('assets/images/marketing/sepand-cargo-details.webp'),
            'imageAlt' => 'نمای نرم افزار مدیریت حمل و نقل سپند',
            'imageWidth' => 835,
            'imageHeight' => 335,
        ]);
    }

    public function createProcessReview(Request $request): View
    {
        $utmParameters = collect([
            'utm_source',
            'utm_medium',
            'utm_campaign',
            'utm_term',
            'utm_content',
        ])->mapWithKeys(fn (string $key): array => [$key => $request->query($key)])
            ->filter(fn (mixed $value): bool => is_string($value) && $value !== '')
            ->all();

        return view('marketing.consultation', [
            'title' => 'بررسی رایگان فرایندهای شرکت حمل‌ونقل | سپند',
            'description' => 'با پاسخ به چند سؤال کوتاه درباره فروش، نرخ‌گیری، بوکینگ، عملیات، اسناد، مالی یا گزارش‌گیری، مسئله اصلی شرکت خود را برای بررسی تیم سپند ثبت کنید.',
            'canonical' => route('process-review.create'),
            'image' => asset('assets/images/marketing/sepand-cargo-details.webp'),
            'imageAlt' => 'نمای نرم افزار مدیریت حمل و نقل سپند',
            'imageWidth' => 835,
            'imageHeight' => 335,
            'topics' => config('consultation_process_review.topics', []),
            'sourcePage' => $request->fullUrl(),
            'utmParameters' => $utmParameters,
        ]);
    }

    public function store(Request $request, ConsultationSmsNotifier $smsNotifier): RedirectResponse
    {
        $companyTypes = [
            'شرکت حمل‌ونقل بین‌المللی',
            'شرکت فورواردری',
            'NVOCC',
            'نماینده خط حمل',
            'شرکت لجستیک',
            'سایر',
        ];
        $userRanges = ['1 تا 5 نفر', '6 تا 15 نفر', '16 تا 30 نفر', 'بیش از 30 نفر'];
        $primaryNeeds = [
            'CRM و فروش',
            'استعلام و نرخ‌دهی',
            'Booking',
            'عملیات حمل',
            'مدیریت اسناد',
            'مالی',
            'پرتال مشتری',
            'گزارش‌های مدیریتی',
            'یکپارچه‌سازی فرایندها',
            'سایر',
        ];

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'company' => ['required', 'string', 'max:150'],
            'mobile' => ['required', 'string', 'max:30', 'regex:/^[0-9۰-۹+()\-\s]{7,30}$/u'],
            'email' => ['nullable', 'email', 'max:190'],
            'company_type' => ['required', 'string', Rule::in($companyTypes)],
            'approximate_users' => ['nullable', 'string', Rule::in($userRanges)],
            'primary_need' => ['required', 'string', Rule::in($primaryNeeds)],
            'message' => ['nullable', 'string', 'max:2000'],
            'source_page' => ['nullable', 'url', 'max:2048'],
            'website' => ['prohibited'],
        ], [
            'name.required' => 'نام و نام خانوادگی را وارد کنید.',
            'name.max' => 'نام و نام خانوادگی نباید بیشتر از ۱۰۰ کاراکتر باشد.',
            'company.required' => 'نام شرکت را وارد کنید.',
            'company.max' => 'نام شرکت نباید بیشتر از ۱۵۰ کاراکتر باشد.',
            'mobile.required' => 'شماره تماس را وارد کنید.',
            'mobile.regex' => 'شماره تماس را با رقم‌های معتبر وارد کنید.',
            'mobile.max' => 'شماره تماس واردشده بیش از حد طولانی است.',
            'email.email' => 'ایمیل را با قالب صحیح وارد کنید.',
            'email.max' => 'ایمیل واردشده بیش از حد طولانی است.',
            'company_type.required' => 'نوع کسب‌وکار را انتخاب کنید.',
            'company_type.in' => 'نوع کسب‌وکار انتخاب‌شده معتبر نیست.',
            'approximate_users.in' => 'بازه تعداد کاربران انتخاب‌شده معتبر نیست.',
            'primary_need.required' => 'مهم‌ترین نیاز فعلی شرکت را انتخاب کنید.',
            'primary_need.in' => 'نیاز انتخاب‌شده معتبر نیست.',
            'message.max' => 'توضیحات نباید بیشتر از ۲۰۰۰ کاراکتر باشد.',
        ]);

        unset($validated['website']);

        ConsultationRequest::create($validated);
        $smsNotifier->send();

        return redirect()
            ->route('consultation.create')
            ->with('status', 'درخواست شما ثبت شد. اطلاعات اولیه بررسی می‌شود و برای هماهنگی جلسه دمو با شما تماس می‌گیریم.');
    }

    public function storeProcessReview(
        StoreConsultationProcessReviewRequest $request,
        ConsultationSmsNotifier $smsNotifier
    ): RedirectResponse {
        $validated = $request->validated();
        $topics = config('consultation_process_review.topics', []);
        $topic = $topics[$validated['topic']];
        $answers = [];

        foreach ([2, 3, 4] as $step) {
            $question = $topic['questions'][$step];
            $answerId = $validated['responses'][$step];
            $answers[] = [
                'step' => $step,
                'question_id' => $question['id'],
                'question' => $question['text'],
                'answer_id' => $answerId,
                'answer' => $question['options'][$answerId],
            ];
        }

        $utmParameters = collect($validated['utm'] ?? [])
            ->filter(fn (mixed $value): bool => is_string($value) && $value !== '')
            ->all();

        try {
            ConsultationRequest::create([
                'name' => $validated['name'],
                'company' => $validated['company'],
                'mobile' => $validated['mobile'],
                'topic' => $validated['topic'],
                'topic_label' => $topic['label'],
                'answers' => $answers,
                'message' => $validated['message'] ?? null,
                'source_page' => $validated['source_page'] ?? url()->previous(),
                'utm_parameters' => $utmParameters ?: null,
                // Keep the former qualification field populated for existing reports.
                'primary_need' => $topic['label'],
            ]);
        } catch (Throwable $exception) {
            Log::error('Consultation process review could not be stored.', [
                'exception_class' => $exception::class,
                'error_code' => $exception->getCode(),
            ]);

            return back()
                ->withInput()
                ->withErrors([
                    'submission' => 'ثبت درخواست انجام نشد. پاسخ‌های شما حفظ شده‌اند؛ لطفاً دوباره تلاش کنید.',
                ]);
        }

        $smsNotifier->send();

        return redirect()
            ->route('process-review.create')
            ->with('status', 'success');
    }
}
