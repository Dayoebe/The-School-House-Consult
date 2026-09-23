const CACHE_NAME = 'school-house-public-assets-v1';
const base = new URL('./', self.location.href);
const localUrl = (path) => new URL(path, base).href;
const offlineUrl = localUrl('offline.html');
const coreAssets = [
    offlineUrl,
    localUrl('images/brand/icon-192.png'),
    localUrl('images/brand/icon-512.png'),
    localUrl('images/brand/mark-256.webp'),
];

self.addEventListener('install', (event) => {
    event.waitUntil(caches.open(CACHE_NAME).then((cache) => cache.addAll(coreAssets)));
});

self.addEventListener('activate', (event) => {
    event.waitUntil((async () => {
        const names = await caches.keys();
        await Promise.all(names.filter((name) => name.startsWith('school-house-public-assets-') && name !== CACHE_NAME).map((name) => caches.delete(name)));
        await self.clients.claim();
    })());
});

self.addEventListener('fetch', (event) => {
    const request = event.request;
    const url = new URL(request.url);
    if (request.method !== 'GET' || url.origin !== base.origin || !url.pathname.startsWith(base.pathname)) return;

    // Pages always come from the server. Never cache forms, sessions, or enquiry responses.
    if (request.mode === 'navigate') {
        event.respondWith(fetch(request).catch(async () => {
            const cached = await caches.match(offlineUrl);
            if (!cached) return Response.error();
            const html = (await cached.text()).replace('__APP_BASE__', base.href);
            return new Response(html, { headers: { 'Content-Type': 'text/html; charset=utf-8', 'Cache-Control': 'no-store' } });
        }));
        return;
    }

    const relativePath = url.pathname.slice(base.pathname.length);
    const isPublicAsset = /^build\/assets\/[\w.-]+\.(css|js)$/.test(relativePath)
        || /^images\/(brand|illustrations)\/[\w.-]+\.(png|webp)$/.test(relativePath);
    if (!isPublicAsset || url.search) return;

    event.respondWith((async () => {
        const cache = await caches.open(CACHE_NAME);
        const cached = await cache.match(request);
        if (cached) return cached;
        const response = await fetch(request);
        if (response.ok && response.type === 'basic') {
            await cache.put(request, response.clone());
        }
        return response;
    })());
});
