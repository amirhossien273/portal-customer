<!-- Support Floating Button -->

























































<!-- Chat Panel -->
<div class="chat-panel" id="chatPanel">

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
<?php /**PATH /var/www/sepand-crm/portal-customer-site/resources/views/components/common/footer.blade.php ENDPATH**/ ?>