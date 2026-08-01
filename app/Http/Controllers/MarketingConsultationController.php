<?php

namespace App\Http\Controllers;

use App\Models\ConsultationRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MarketingConsultationController extends Controller
{
    public function create(): View
    {
        return view('marketing.consultation', [
            'title' => 'درخواست مشاوره نرم‌افزار سپند | دمو و نیازسنجی',
            'description' => 'برای دریافت دمو و مشاوره نرم‌افزار CRM و مدیریت عملیات حمل‌ونقل سپند، اطلاعات شرکت و نیازهای خود را ثبت کنید.',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'company' => ['required', 'string', 'max:150'],
            'mobile' => ['required', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:190'],
            'company_type' => ['required', 'string', 'max:100'],
            'message' => ['nullable', 'string', 'max:2000'],
            'source_page' => ['nullable', 'url', 'max:2048'],
            'website' => ['prohibited'],
        ]);

        unset($validated['website']);

        ConsultationRequest::create($validated);

        return redirect()
            ->route('consultation.create')
            ->with('status', 'درخواست شما با موفقیت ثبت شد. کارشناسان سپند برای هماهنگی با شما تماس می‌گیرند.');
    }
}
