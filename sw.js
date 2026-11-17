/**
 * PICO PLAZA - Service Worker for Web Push Notifications
 * Hỗ trợ nhận thông báo đẩy trên Desktop (Chrome, Edge, Cốc Cốc) & Mobile (Android, iOS PWA)
 */
self.addEventListener('push', function(event) {
    var data = {};
    if (event.data) {
        try {
            data = event.data.json();
        } catch(e) {
            data = { title: 'PICO PLAZA Notification', body: event.data.text() };
        }
    }

    var title = data.title || '🏢 [PICO PLAZA] Có Hồ Sơ Thẩm Định Mới';
    var options = {
        body: data.body || 'Vui lòng truy cập trang quản trị để xem và thẩm định hồ sơ.',
        icon: data.icon || '/images/logo.png',
        badge: data.badge || '/images/logo.png',
        vibrate: [200, 100, 200],
        data: {
            url: data.url || '/admin/index.php/do_dept_review_listview'
        }
    };

    event.waitUntil(
        self.registration.showNotification(title, options)
    );
});

self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    var targetUrl = event.notification.data && event.notification.data.url ? event.notification.data.url : '/admin/';
    event.waitUntil(
        clients.matchAll({ type: 'window', includeUncontrolled: true }).then(function(clientList) {
            for (var i = 0; i < clientList.length; i++) {
                var client = clientList[i];
                if (client.url.indexOf(targetUrl) !== -1 && 'focus' in client) {
                    return client.focus();
                }
            }
            if (clients.openWindow) {
                return clients.openWindow(targetUrl);
            }
        })
    );
});
