<!-- PWA Meta Tags -->
<meta name="theme-color" content="#262761">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="CAA">
<meta name="application-name" content="CAA Reporting System">
<meta name="msapplication-TileColor" content="#262761">
<meta name="msapplication-TileImage" content="/images/icons/icon-144x144.png">

<!-- PWA Manifest -->
<link rel="manifest" href="/manifest.json">

<!-- Apple Touch Icons -->
<link rel="apple-touch-icon" href="/images/icons/icon-72x72.png" sizes="72x72">
<link rel="apple-touch-icon" href="/images/icons/icon-96x96.png" sizes="96x96">
<link rel="apple-touch-icon" href="/images/icons/icon-128x128.png" sizes="128x128">
<link rel="apple-touch-icon" href="/images/icons/icon-144x144.png" sizes="144x144">
<link rel="apple-touch-icon" href="/images/icons/icon-152x152.png" sizes="152x152">
<link rel="apple-touch-icon" href="/images/icons/icon-192x192.png" sizes="192x192">
<link rel="apple-touch-icon" href="/images/icons/icon-384x384.png" sizes="384x384">
<link rel="apple-touch-icon" href="/images/icons/icon-512x512.png" sizes="512x512">

<!-- Favicon -->
<link rel="icon" type="image/png" sizes="192x192" href="/images/icons/icon-192x192.png">
<link rel="icon" type="image/png" sizes="96x96" href="/images/icons/icon-96x96.png">
<link rel="icon" type="image/png" sizes="32x32" href="/images/icons/icon-72x72.png">

<!-- Service Worker Registration -->
<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function() {
            navigator.serviceWorker.register('/serviceworker.js')
                .then(function(registration) {
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                })
                .catch(function(err) {
                    console.log('ServiceWorker registration failed: ', err);
                });
        });
    }
</script>
