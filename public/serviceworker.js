const CACHE_NAME = 'caa-pwa-cache-v3';
const STATIC_ASSETS = [
    '/offline',
    '/images/icons/icon-192x192.png',
    '/images/icons/icon-512x512.png',
    '/backend/assets/css/vendor.min.css',
    '/backend/assets/css/icons.min.css',
    '/backend/assets/js/vendor.min.js',
    '/backend/assets/js/app.js'
];

// Install event - cache static files only
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                console.log('Caching static assets');
                return cache.addAll(STATIC_ASSETS).catch(err => {
                    console.log('Failed to cache some resources:', err);
                });
            })
    );
    self.skipWaiting();
});

// Activate event - clean up old caches
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheName !== CACHE_NAME) {
                        console.log('Deleting old cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
    self.clients.claim();
});

// Fetch event - Network first for HTML, Cache first for static assets
self.addEventListener('fetch', event => {
    // Skip non-GET requests
    if (event.request.method !== 'GET') {
        return;
    }

    // Skip cross-origin requests
    if (!event.request.url.startsWith(self.location.origin)) {
        return;
    }

    const url = new URL(event.request.url);

    // For HTML pages (navigation requests) - ALWAYS go to network first
    if (event.request.mode === 'navigate' ||
        event.request.headers.get('accept')?.includes('text/html')) {
        event.respondWith(
            fetch(event.request)
                .then(response => {
                    return response;
                })
                .catch(() => {
                    // Only show offline page if network fails
                    return caches.match('/offline');
                })
        );
        return;
    }

    // For static assets (CSS, JS, images) - Cache first, then network
    if (url.pathname.match(/\.(css|js|png|jpg|jpeg|gif|svg|ico|woff|woff2|ttf|eot)$/)) {
        event.respondWith(
            caches.match(event.request)
                .then(response => {
                    if (response) {
                        return response;
                    }
                    return fetch(event.request).then(networkResponse => {
                        // Cache the new resource
                        if (networkResponse && networkResponse.status === 200) {
                            const responseToCache = networkResponse.clone();
                            caches.open(CACHE_NAME).then(cache => {
                                cache.put(event.request, responseToCache);
                            });
                        }
                        return networkResponse;
                    });
                })
                .catch(() => {
                    // Return nothing for failed static assets
                    return new Response('', { status: 404 });
                })
        );
        return;
    }

    // For everything else - Network first
    event.respondWith(
        fetch(event.request)
            .catch(() => {
                return caches.match(event.request);
            })
    );
});

// Push notification event
self.addEventListener('push', event => {
    const options = {
        body: event.data ? event.data.text() : 'New notification',
        icon: '/images/icons/icon-192x192.png',
        badge: '/images/icons/icon-72x72.png',
        vibrate: [100, 50, 100],
        data: {
            dateOfArrival: Date.now(),
            primaryKey: 1
        },
        actions: [
            {
                action: 'explore',
                title: 'View',
                icon: '/images/icons/icon-72x72.png'
            },
            {
                action: 'close',
                title: 'Close',
                icon: '/images/icons/icon-72x72.png'
            }
        ]
    };

    event.waitUntil(
        self.registration.showNotification('CAA Reporting System', options)
    );
});

// Notification click event
self.addEventListener('notificationclick', event => {
    event.notification.close();

    if (event.action === 'explore') {
        event.waitUntil(
            clients.openWindow('/')
        );
    }
});
