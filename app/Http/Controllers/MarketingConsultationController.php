<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConsultationProcessReviewRequest;
use App\Models\ConsultationRequest;
use App\Services\ConsultationSmsNotifier;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class MarketingConsultationController extends Controller
{
    public function create(Request $request): View
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
            'canonical' => route('consultation.create'),
            'image' => asset('assets/images/marketing/sepand-cargo-details.webp'),
            'imageAlt' => 'نمای نرم افزار مدیریت حمل و نقل سپند',
            'imageWidth' => 835,
            'imageHeight' => 335,
            'topics' => config('consultation_process_review.topics', []),
            'sourcePage' => $request->fullUrl(),
            'utmParameters' => $utmParameters,
        ]);
    }

    public function store(
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
            ->route('consultation.create')
            ->with('status', 'success');
    }
}
