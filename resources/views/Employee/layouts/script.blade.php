<!-- Vendor js -->
<script src="{{asset('backend/assets/js/vendor.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('backend/assets/js/app.js')}}"></script>

<!-- Apex Chart js -->
<script src="{{asset('backend/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>

<!-- Projects Analytics Dashboard App js -->
<script src="{{asset('backend/assets/js/pages/dashboard.js')}}"></script>

{{--Start ckeditor --}}
<script src="https://cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>
<script>
    $(document).ready(function() {
        $('.editor').each(function() {
            CKEDITOR.replace(this, {
                extraPlugins: 'font,colorbutton,justify',
                toolbar: [
                    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
                    { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'] },
                    { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
                    { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe'] },
                    { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
                    { name: 'colors', items: ['TextColor', 'BGColor'] },
                    { name: 'tools', items: ['Maximize', 'ShowBlocks'] }
                ],
                contentsLangDirection: 'rtl',
                defaultLanguage: 'ar',
                language: '{{App::getLocale()}}'
            });
        });
    });
</script>
{{--End ckeditor --}}


<!-- تأكد من تضمين مكتبة Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // استهداف جميع النماذج في الصفحة
        document.querySelectorAll("form").forEach(form => {
            form.addEventListener("submit", event => {
                // استهداف زر الإرسال داخل النموذج
                const submitButton = form.querySelector("button[type='submit']");
                if (submitButton) {
                    // حفظ المحتوى الأصلي للزر لإعادته لاحقًا
                    const originalContent = submitButton.innerHTML;

                    // تعطيل الزر وتحديث محتواه لعرض أيقونة التحميل
                    submitButton.disabled = true;
                    submitButton.innerHTML = `<i class="fas fa-spinner fa-spin"></i>`;

                    // في حال عدم استجابة السيرفر، إعادة تفعيل الزر بعد 10 ثواني
                    setTimeout(() => {
                        submitButton.disabled = false;
                        submitButton.innerHTML = originalContent;
                    }, 10000);
                }
            });
        });
    });
</script>


{{--جلب التخصصات الفرعية--}}

<!-- PWA Floating Install Button -->
<button id="pwaFloatBtn" class="pwa-float-btn" title="{{ App::getLocale() == 'ar' ? 'تثبيت التطبيق' : 'Install App' }}">
    <i class="fas fa-download"></i>
</button>

<!-- PWA Install Script -->
<script>
    (function() {
        let deferredPrompt;
        const floatBtn = document.getElementById('pwaFloatBtn');

        // Listen for the beforeinstallprompt event
        window.addEventListener('beforeinstallprompt', (e) => {
            // Prevent the mini-infobar from appearing on mobile
            e.preventDefault();
            // Stash the event so it can be triggered later
            deferredPrompt = e;
            // Show the floating install button
            floatBtn.classList.add('show');
        });

        // Handle install button click
        floatBtn.addEventListener('click', async () => {
            if (!deferredPrompt) {
                return;
            }

            // Show the install prompt
            deferredPrompt.prompt();

            // Wait for the user to respond to the prompt
            const { outcome } = await deferredPrompt.userChoice;

            if (outcome === 'accepted') {
                console.log('User accepted the install prompt');
            } else {
                console.log('User dismissed the install prompt');
            }

            // Clear the deferredPrompt
            deferredPrompt = null;
            // Hide the button after prompt
            floatBtn.classList.remove('show');
        });

        // Handle app installed event
        window.addEventListener('appinstalled', () => {
            console.log('PWA was installed');
            // Hide the install button
            floatBtn.classList.remove('show');
            deferredPrompt = null;
        });

        // Check if app is already installed
        if (window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true) {
            // App is already installed, hide install button
            floatBtn.style.display = 'none';
        }
    })();
</script>

@yield('js')
