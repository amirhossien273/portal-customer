<?php

namespace App\Http\Controllers;

use App\Models\Crm\CustomerPersonal;
use App\Repositories\CustomerPortalRepository;
use App\Support\MobileNumber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\View\View;
use Throwable;

class CustomerPortalAuthController extends Controller
{
    private const OTP_SESSION_KEY = 'customer_portal_otp';

    public function __construct(private readonly CustomerPortalRepository $customers)
    {
    }

    public function showLogin(Request $request): View|RedirectResponse
    {
        if ($request->session()->has('customer_portal')) {
            return redirect()->route('portal.dashboard');
        }

        return view('auth.customer-login');
    }

    public function requestOtp(Request $request): RedirectResponse
    {
        $mobile = MobileNumber::normalize($request->string('mobile')->toString());

        if (! $mobile) {
            return back()->withInput()->withErrors([
                'mobile' => 'شماره موبایل را با ساختار صحیح، مانند ۰۹۱۲۱۲۳۴۵۶۷ وارد کنید.',
            ]);
        }

        // TODO: Re-enable the per-mobile OTP limiter after the temporary
        // preview/testing phase is finished.
        // $rateKey = $this->rateKey($request, $mobile);
        // if (RateLimiter::tooManyAttempts($rateKey, config('customer_portal.otp.max_requests'))) {
        //     return back()->withInput()->withErrors([
        //         'mobile' => 'تعداد درخواست‌ها بیش از حد مجاز است. چند دقیقه دیگر دوباره تلاش کنید.',
        //     ]);
        // }
        // RateLimiter::hit($rateKey, config('customer_portal.otp.request_decay_seconds'));

        try {
            $personal = $this->customers->findPersonalByMobile($mobile);
        } catch (Throwable $exception) {
            Log::error('Customer portal could not query CRM.', ['exception' => $exception]);

            return back()->withInput()->withErrors([
                'mobile' => 'ارتباط با سامانه مشتریان موقتاً برقرار نیست. لطفاً دوباره تلاش کنید.',
            ]);
        }

        if (! $personal) {
            return back()->withInput()->withErrors([
                'mobile' => 'برای این شماره موبایل، مشتری فعالی در سپند پیدا نشد.',
            ]);
        }

        return $this->issueOtp($request, $personal, $mobile);
    }

    public function showVerify(Request $request): View|RedirectResponse
    {
        $pending = $request->session()->get(self::OTP_SESSION_KEY);
        if (! is_array($pending)) {
            return redirect()->route('login')->with('auth_error', 'ابتدا شماره موبایل خود را وارد کنید.');
        }

        return view('auth.customer-verify', [
            'maskedMobile' => MobileNumber::mask($pending['mobile']),
            'customerName' => $pending['name'],
            'expiresAt' => $pending['expires_at'],
            'resendAt' => $pending['resend_at'],
            'previewOtp' => $request->session()->get('preview_otp'),
        ]);
    }

    public function verify(Request $request): RedirectResponse
    {
        $digits = $request->input('digits', []);
        $otp = is_array($digits) ? implode('', $digits) : '';

        if (preg_match('/^\d{6}$/', $otp) !== 1) {
            return back()->withErrors(['otp' => 'کد ۶ رقمی را کامل وارد کنید.']);
        }

        $pending = $request->session()->get(self::OTP_SESSION_KEY);
        if (! is_array($pending)) {
            return redirect()->route('login')->with('auth_error', 'درخواست ورود شما معتبر نیست.');
        }

        if (now()->timestamp > (int) $pending['expires_at']) {
            $request->session()->forget(self::OTP_SESSION_KEY);

            return redirect()->route('login')->with('auth_error', 'اعتبار کد ورود تمام شده است؛ کد تازه‌ای بگیرید.');
        }

        $pending['attempts'] = (int) ($pending['attempts'] ?? 0) + 1;
        $request->session()->put(self::OTP_SESSION_KEY, $pending);

        if ($pending['attempts'] > config('customer_portal.otp.max_attempts')) {
            $request->session()->forget(self::OTP_SESSION_KEY);

            return redirect()->route('login')->with('auth_error', 'تعداد تلاش‌های ناموفق بیش از حد مجاز بود؛ دوباره کد بگیرید.');
        }

        if (! Hash::check($otp, $pending['hash'])) {
            return back()->withErrors(['otp' => 'کد واردشده صحیح نیست. دوباره بررسی کنید.']);
        }

        $identity = [
            'customer_id' => $pending['customer_id'],
            'personal_id' => $pending['personal_id'],
            'tenant_id' => $pending['tenant_id'],
            'mobile' => $pending['mobile'],
            'authenticated_at' => now()->timestamp,
        ];

        $request->session()->forget(self::OTP_SESSION_KEY);
        $request->session()->regenerate();
        $request->session()->put('customer_portal', $identity);

        return redirect()->intended(route('portal.dashboard'))
            ->with('success', 'با موفقیت وارد پورتال مشتریان شدید.');
    }

    public function resend(Request $request): RedirectResponse
    {
        $pending = $request->session()->get(self::OTP_SESSION_KEY);
        if (! is_array($pending)) {
            return redirect()->route('login');
        }

        if (now()->timestamp < (int) $pending['resend_at']) {
            return back()->withErrors(['otp' => 'برای درخواست کد تازه کمی صبر کنید.']);
        }

        try {
            $personal = CustomerPersonal::query()
                ->whereKey($pending['personal_id'])
                ->where('customer_id', $pending['customer_id'])
                ->where('tenant_id', $pending['tenant_id'])
                ->firstOrFail();
        } catch (Throwable $exception) {
            Log::warning('Customer portal OTP resend failed.', ['exception' => $exception]);

            return redirect()->route('login')->with('auth_error', 'امکان ارسال مجدد کد وجود ندارد.');
        }

        return $this->issueOtp($request, $personal, $pending['mobile']);
    }

    public function logout(Request $request): RedirectResponse
    {
        $request->session()->forget(['customer_portal', self::OTP_SESSION_KEY]);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('logged_out', 'با امنیت کامل از حساب خود خارج شدید.');
    }

    private function issueOtp(Request $request, CustomerPersonal $personal, string $mobile): RedirectResponse
    {
        $otp = (string) random_int(100000, 999999);
        $expiresAt = now()->addSeconds(config('customer_portal.otp.expires_in_seconds'))->timestamp;
        $resendAt = now()->addSeconds(config('customer_portal.otp.resend_after_seconds'))->timestamp;

        $request->session()->put(self::OTP_SESSION_KEY, [
            'hash' => Hash::make($otp),
            'customer_id' => (string) $personal->customer_id,
            'personal_id' => (string) $personal->getKey(),
            'tenant_id' => (string) $personal->tenant_id,
            'mobile' => $mobile,
            'name' => $personal->full_name ?: 'مشتری سپند',
            'attempts' => 0,
            'expires_at' => $expiresAt,
            'resend_at' => $resendAt,
        ]);

        if (config('customer_portal.otp.preview')) {
            $request->session()->flash('preview_otp', $otp);
        }

        return redirect()->route('login.verify');
    }

    private function rateKey(Request $request, string $mobile): string
    {
        return 'customer-portal-otp:'.hash('sha256', $request->ip().'|'.$mobile);
    }
}
