const CACHE_NAME = "laravel-pwa-cache-v1";
const urlsToCache = [
    // "/", // hanya jika halaman utama ingin di-cache
    "/css/app.css",
    "/js/app.js",
    "/icons/ic_launcher.png",
];

// Install: cache file statis
self.addEventListener("install", (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            return cache.addAll(urlsToCache);
        })
    );
    self.skipWaiting(); // langsung aktif tanpa menunggu
});

// Activate: hapus cache lama
self.addEventListener("activate", (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) =>
            Promise.all(
                cacheNames.map((cache) => {
                    if (cache !== CACHE_NAME) {
                        return caches.delete(cache);
                    }
                })
            )
        )
    );
    self.clients.claim(); // klaim kontrol tanpa reload
});

// Fetch: cache-first untuk asset statis saja
self.addEventListener("fetch", (event) => {
    const request = event.request;
    const url = new URL(request.url);

    // Lewatkan request selain GET dan bukan dari origin kita
    if (request.method !== "GET" || url.origin !== location.origin) {
        return;
    }

    // Hanya cache asset statis (bukan API, bukan login, bukan dashboard, dll.)
    const isStaticAsset =
        url.pathname.startsWith("/css/") ||
        url.pathname.startsWith("/js/") ||
        url.pathname.startsWith("/icons/");

    if (isStaticAsset) {
        event.respondWith(
            caches.match(request).then((cachedResponse) => {
                return (
                    cachedResponse ||
                    fetch(request).then((response) => {
                        return caches.open(CACHE_NAME).then((cache) => {
                            cache.put(request, response.clone());
                            return response;
                        });
                    })
                );
            })
        );
    }
});
