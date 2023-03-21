const cacheName = "scbs";
const filesToCache = [
    "",
    "./",
    "assets/js/index.js",
    "assets/css/styles.css"
    
];

self.addEventListener("install", e => {
    console.log("[ServiceWorker**] Install");
    e.waitUntil(
        caches.open(cacheName).then(cache => {
            console.log("[ServiceWorker**] Caching app shell");
            return cache.addAll(filesToCache);
        })
    );
});
    
    self.addEventListener("fetch", event => {
        event.respondWith(
            caches.match(event.request, {ignoreSearch: true}).then(response => {
                return response || fetch(event.request);
            })
        );
    });