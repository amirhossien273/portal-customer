<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreConsultationProcessReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim((string) $this->input('name')),
            'company' => trim((string) $this->input('company')),
            'mobile' => $this->normalizeMobile((string) $this->input('mobile')),
            'message' => $this->filled('message') ? trim((string) $this->input('message')) : null,
        ]);
    }

    /** @return array<string, mixed> */
    public function rules(): array
    {
        $topics = config('consultation_process_review.topics', []);
        $topic = (string) $this->input('topic');
        $questions = $topics[$topic]['questions'] ?? [];

        $rules = [
            'topic' => ['bail', 'required', 'string', Rule::in(array_keys($topics))],
            'responses' => ['required', 'array'],
            'message' => ['nullable', 'string', 'max:2000'],
            'name' => ['required', 'string', 'max:100'],
            'mobile' => ['bail', 'required', 'string', 'regex:/^09\d{9}$/'],
            'company' => ['required', 'string', 'max:150'],
            'source_page' => ['nullable', 'url', 'max:2048'],
            'utm' => ['nullable', 'array'],
            'utm.utm_source' => ['nullable', 'string', 'max:255'],
            'utm.utm_medium' => ['nullable', 'string', 'max:255'],
            'utm.utm_campaign' => ['nullable', 'string', 'max:255'],
            'utm.utm_term' => ['nullable', 'string', 'max:255'],
            'utm.utm_content' => ['nullable', 'string', 'max:255'],
            'website' => ['prohibited'],
        ];

        foreach ([2, 3, 4] as $step) {
            $rules["responses.$step"] = [
                'bail',
                'required',
                'string',
                Rule::in(array_keys($questions[$step]['options'] ?? [])),
            ];
        }

        return $rules;
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'topic.required' => 'لطفاً موضوع اصلی را انتخاب کنید.',
            'topic.in' => 'موضوع انتخاب‌شده معتبر نیست.',
            'responses.required' => 'لطفاً به سؤال‌های بررسی فرایند پاسخ دهید.',
            'responses.*.required' => 'لطفاً یک گزینه را انتخاب کنید.',
            'responses.*.in' => 'پاسخ انتخاب‌شده برای این مسیر معتبر نیست.',
            'message.max' => 'توضیحات نباید بیشتر از ۲۰۰۰ کاراکتر باشد.',
            'name.required' => 'نام و نام خانوادگی را وارد کنید.',
            'name.max' => 'نام و نام خانوادگی نباید بیشتر از ۱۰۰ کاراکتر باشد.',
            'company.required' => 'نام شرکت را وارد کنید.',
            'company.max' => 'نام شرکت نباید بیشتر از ۱۵۰ کاراکتر باشد.',
            'mobile.required' => 'شماره موبایل را وارد کنید.',
            'mobile.regex' => 'شماره موبایل را به‌صورت ۰۹xxxxxxxxx وارد کنید.',
            'source_page.url' => 'آدرس صفحه ورودی معتبر نیست.',
            'utm.*.max' => 'مقدار پارامتر ورودی بیش از حد طولانی است.',
        ];
    }

    private function normalizeMobile(string $mobile): string
    {
        $mobile = strtr($mobile, [
            '۰' => '0', '۱' => '1', '۲' => '2', '۳' => '3', '۴' => '4',
            '۵' => '5', '۶' => '6', '۷' => '7', '۸' => '8', '۹' => '9',
            '٠' => '0', '١' => '1', '٢' => '2', '٣' => '3', '٤' => '4',
            '٥' => '5', '٦' => '6', '٧' => '7', '٨' => '8', '٩' => '9',
        ]);
        $mobile = preg_replace('/\D+/', '', $mobile) ?? '';

        if (str_starts_with($mobile, '0098')) {
            $mobile = '0'.substr($mobile, 4);
        } elseif (str_starts_with($mobile, '98')) {
            $mobile = '0'.substr($mobile, 2);
        }

        return $mobile;
    }
}
