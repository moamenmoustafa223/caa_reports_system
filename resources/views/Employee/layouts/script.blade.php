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

<!-- Notification Auto-Refresh Script -->
<script>
    (function() {
        // Auto-refresh notifications every 30 seconds
        function refreshNotifications() {
            fetch('{{ route("employee.notifications.get") }}')
                .then(response => response.json())
                .then(data => {
                    // Update notification count in all places
                    document.querySelectorAll('.notification-count').forEach(el => {
                        el.textContent = data.count_display;
                    });

                    // Update notifications list
                    const notificationsList = document.getElementById('notifications-list');
                    if (notificationsList) {
                        notificationsList.innerHTML = data.html;

                        // Re-attach event listeners for new mark-as-read buttons
                        attachMarkAsReadListeners();
                    }
                })
                .catch(error => console.error('Error fetching notifications:', error));
        }

        // Mark single notification as read
        function attachMarkAsReadListeners() {
            document.querySelectorAll('.mark-as-read-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();

                    const notificationId = this.getAttribute('data-notification-id');
                    const notificationItem = this.closest('.notification-item');

                    fetch(`{{ route("employee.notifications.mark_as_read", ":id") }}`.replace(':id', notificationId))
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Remove the notification item with animation
                                notificationItem.style.opacity = '0';
                                setTimeout(() => {
                                    refreshNotifications();
                                }, 300);
                            }
                        })
                        .catch(error => console.error('Error marking notification as read:', error));
                });
            });
        }

        // Mark all notifications as read
        const markAllReadBtn = document.getElementById('mark-all-read');
        if (markAllReadBtn) {
            markAllReadBtn.addEventListener('click', function(e) {
                e.preventDefault();

                fetch('{{ route("employee.notifications.mark_all_as_read") }}')
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            refreshNotifications();
                        }
                    })
                    .catch(error => console.error('Error marking all as read:', error));
            });
        }

        // Initial attachment of listeners
        attachMarkAsReadListeners();

        // Auto-refresh every 30 seconds (30000 milliseconds)
        setInterval(refreshNotifications, 30000);
    })();
</script>

@yield('js')
