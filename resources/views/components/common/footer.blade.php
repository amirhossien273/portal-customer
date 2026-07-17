<!-- Support Floating Button -->
{{--<div class="support-widget">--}}
{{--    <div class="support-actions">--}}

{{--        <!-- Telegram -->--}}
{{--        <a href="https://t.me/USERNAME" target="_blank" class="support-btn telegram">--}}
{{--            <svg width="22" height="22" viewBox="0 0 24 24" class="box-telegram" fill="currentColor"--}}
{{--                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                <path d="M21.8 4.1L2.9 11.5c-.9.4-.9 1.6.1 1.9l4.9 1.5--}}
{{--                         1.9 5.8c.3.9 1.4 1.1 2 .4l2.8-3.1--}}
{{--                         5.3 3.9c.8.6 2 .1 2.2-.9l3.2-15.3--}}
{{--                         c.2-1.1-.9-2-2-1.6z"/>--}}
{{--            </svg>--}}
{{--        </a>--}}

{{--        <!-- WhatsApp -->--}}
{{--        <a href="https://wa.me/989XXXXXXXXX" target="_blank" class="support-btn whatsapp">--}}
{{--            <svg width="22" height="22" viewBox="0 0 24 24"--}}
{{--                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                <path fill="currentColor"--}}
{{--                      d="M12 2C6.48 2 2 6.26 2 11.5--}}
{{--                         c0 1.94.6 3.74 1.63 5.24L2 22--}}
{{--                         l5.52-1.53A10.2 10.2 0 0 0 12 21--}}
{{--                         c5.52 0 10-4.26 10-9.5S17.52 2 12 2z"/>--}}
{{--                <path fill="#fff"--}}
{{--                      d="M9.8 7.5c-.3-.7-.6-.7-1-.7h-.8--}}
{{--                         c-.3 0-.7.1-1.1.5-.4.4-1.5 1.4-1.5 3.4--}}
{{--                         s1.5 3.9 1.7 4.1c.2.2 2.9 4.4 7.1 6--}}
{{--                         3.5 1.4 4.2 1.1 5 .9.8-.2 2.6-1--}}
{{--                         3-2 .4-.9.4-1.7.3-1.9c-.1-.2-.3-.3-.7-.5--}}
{{--                         -.4-.2-2.3-1.1-2.7-1.2-.4-.1-.7-.2-1 .2--}}
{{--                         -.3.4-1.1 1.2-1.3 1.4-.3.2-.6.3-1 .1--}}
{{--                         -.4-.2-1.7-.6-3.2-2-.9-.8-1.5-1.8-1.7-2.1--}}
{{--                         -.2-.3 0-.5.2-.7l.5-.6c.2-.2.3-.4.5-.8--}}
{{--                         .1-.3.1-.6 0-.9-.2-.3-.8-2-1.1-2.7z"/>--}}
{{--            </svg>--}}
{{--        </a>--}}

{{--        <!-- Chat -->--}}
{{--        <button class="support-btn chat" onclick="openChat(event)">--}}
{{--            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor"--}}
{{--                 xmlns="http://www.w3.org/2000/svg">--}}
{{--                <path d="M20 15a3 3 0 0 1-3 3H8l-4 4V6--}}
{{--                         a3 3 0 0 1 3-3h10a3 3 0 0 1 3 3z"/>--}}
{{--            </svg>--}}
{{--        </button>--}}
{{--    </div>--}}

{{--    <!-- Main Button -->--}}
{{--    <button class="support-main-btn" onclick="toggleSupport()">--}}
{{--        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor"--}}
{{--             xmlns="http://www.w3.org/2000/svg">--}}
{{--            <path d="M21 13c0 1.1-.9 2-2 2H7l-4 4V5--}}
{{--                     a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>--}}
{{--        </svg>--}}
{{--    </button>--}}
{{--</div>--}}

<!-- Chat Panel -->
<div class="chat-panel" id="chatPanel">
{{--    <x-chat::chat  />--}}
</div>

<style>
.support-widget {
    position: fixed;
    bottom: 25px;
    right: 25px;
    z-index: 9999;
}

[dir="rtl"] .support-widget {
    right: auto;
    left: 25px;
}

.support-main-btn {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: #0f305b;
    color: #fff;
    border: none;
    box-shadow: 0 8px 20px rgba(0,0,0,.3);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.support-actions {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 12px;
    opacity: 0;
    pointer-events: none;
    transform: translateY(15px);
    transition: all .25s ease;
}

.box-telegram{
    position: absolute;
    left: 15px;
}

.support-actions.active {
    opacity: 1;
    pointer-events: auto;
    transform: translateY(0);
}

.support-btn {
    width: 48px;
    height: 48px;
    margin-bottom: 10px;
    border-radius: 50%;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    border: none;
    cursor: pointer;
}

.telegram { background: #229ED9; }
.whatsapp { background: #25D366; }
.chat { background: #1f2937; }

/* Chat panel */
.chat-panel {
    position: fixed;
    bottom: 25px;
    right: 90px;
    width: 100%;
    max-width: 480px;
    height: 80vh;
    max-height: 660px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,.2);
    display: flex;
    flex-direction: column;
    opacity: 0;
    pointer-events: none;
    transform: translateY(20px);
    transition: all .25s ease;
    z-index: 9998;
    top: 100px;
}

.chat-panel.active {
    opacity: 1;
    pointer-events: auto;
    transform: translateY(0);
}

/* RTL */
[dir="rtl"] .chat-panel {
    right: auto;
    left: 90px;
}

.chat-panel .box .flex .panel-box-chat {
    display: none ;
}
.chat-panel .box .flex .panel .flex .box-btn {
    display: block ;
}
</style>

<script>
window.toggleSupport = function () {
    document.querySelector('.support-actions')?.classList.toggle('active');
}

window.openChat = function (e) {
    e.stopPropagation();
    document.getElementById('chatPanel')?.classList.add('active');
}

window.closeChat = function () {
    document.getElementById('chatPanel')?.classList.remove('active');
}

document.addEventListener('click', function () {
    document.getElementById('chatPanel')?.classList.remove('active');
});

document.getElementById('chatPanel')?.addEventListener('click', function (e) {
    e.stopPropagation();
});
</script>
