(() => {
    const latinDigits = (value) => value
        .replace(/[۰-۹]/g, (digit) => String('۰۱۲۳۴۵۶۷۸۹'.indexOf(digit)))
        .replace(/[٠-٩]/g, (digit) => String('٠١٢٣٤٥٦٧٨٩'.indexOf(digit)));

    const faNumber = (value) => String(value).replace(/\d/g, (digit) => '۰۱۲۳۴۵۶۷۸۹'[digit]);

    document.querySelectorAll('[data-loading-form]').forEach((form) => {
        form.addEventListener('submit', () => {
            const button = form.querySelector('.primary-button');
            if (button) {
                button.classList.add('is-loading');
                button.disabled = true;
            }
        });
    });

    const mobile = document.querySelector('#mobile');
    if (mobile) {
        mobile.addEventListener('input', () => {
            mobile.value = latinDigits(mobile.value).replace(/[^0-9+]/g, '').slice(0, 15);
        });
    }

    const otpForm = document.querySelector('[data-otp-form]');
    if (otpForm) {
        const inputs = [...otpForm.querySelectorAll('.otp-inputs input')];
        const distribute = (value, start = 0) => {
            latinDigits(value).replace(/\D/g, '').slice(0, inputs.length - start).split('').forEach((digit, index) => {
                inputs[start + index].value = digit;
            });
            const target = Math.min(start + value.length, inputs.length - 1);
            inputs[target].focus();
        };

        inputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                const value = latinDigits(input.value).replace(/\D/g, '');
                if (value.length > 1) {
                    distribute(value, index);
                    return;
                }
                input.value = value;
                input.classList.toggle('has-value', Boolean(value));
                if (value && inputs[index + 1]) inputs[index + 1].focus();
            });
            input.addEventListener('keydown', (event) => {
                if (event.key === 'Backspace' && !input.value && inputs[index - 1]) inputs[index - 1].focus();
                if (event.key === 'ArrowLeft' && inputs[index + 1]) inputs[index + 1].focus();
                if (event.key === 'ArrowRight' && inputs[index - 1]) inputs[index - 1].focus();
            });
            input.addEventListener('paste', (event) => {
                event.preventDefault();
                distribute(event.clipboardData.getData('text'), index);
            });
        });
        inputs[0]?.focus();
    }

    const timer = document.querySelector('[data-expire-at]');
    const countdown = document.querySelector('[data-countdown]');
    const resendButton = document.querySelector('[data-resend-button]');
    const resendWait = document.querySelector('[data-resend-wait]');

    if (timer && countdown) {
        const tick = () => {
            const seconds = Math.max(0, Number(timer.dataset.expireAt) - Math.floor(Date.now() / 1000));
            const minutes = String(Math.floor(seconds / 60)).padStart(2, '0');
            const rest = String(seconds % 60).padStart(2, '0');
            countdown.textContent = faNumber(`${minutes}:${rest}`);
            timer.classList.toggle('is-expired', seconds === 0);
        };
        tick();
        window.setInterval(tick, 1000);
    }

    if (resendButton) {
        const tickResend = () => {
            const seconds = Math.max(0, Number(resendButton.dataset.resendAt) - Math.floor(Date.now() / 1000));
            resendButton.disabled = seconds > 0;
            if (resendWait) resendWait.textContent = seconds > 0 ? `(${faNumber(seconds)} ثانیه)` : '';
        };
        tickResend();
        window.setInterval(tickResend, 1000);
    }
})();
