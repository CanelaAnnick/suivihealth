<div id="google_translate_element" style="display:none;"></div>
<script>
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({ pageLanguage: 'fr', includedLanguages: 'fr,en', autoDisplay: false }, 'google_translate_element');
    }
    function toggleLang() {
        const isEnglish = document.cookie.includes('googtrans=/fr/en');
        document.cookie = isEnglish
            ? 'googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;'
            : 'googtrans=/fr/en; path=/;';
        window.location.reload();
    }
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('langToggleBtn');
        if (btn) btn.textContent = document.cookie.includes('googtrans=/fr/en') ? 'FR' : 'EN';

        const hideGoogleBar = () => {
            document.querySelectorAll('iframe.goog-te-banner-frame, .goog-te-banner-frame').forEach(el => el.remove());
            document.body.style.top = '0px';
            document.documentElement.style.top = '0px';
        };
        hideGoogleBar();
        new MutationObserver(hideGoogleBar).observe(document.body, { childList: true, subtree: true });
    });
</script>
<script src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>