/**
 * PICO PLAZA - Web Push, Realtime Toast & In-App Notification Center
 * Tự động đăng ký Service Worker, hiển thị Toastr, chuông báo Ting Ting, Chrome Notification & Dropdown Trung tâm thông báo
 */
(function() {
    'use strict';

    var globalAudioCtx = null;
    var lastCheckedSubmissionId = 0;
    var isDropdownOpen = false;

    // Khởi tạo và mở khóa AudioContext ngay khi người dùng tương tác trên trang
    function getUnlockedAudioContext() {
        if (!globalAudioCtx) {
            var AudioContext = window.AudioContext || window.webkitAudioContext;
            if (AudioContext) {
                globalAudioCtx = new AudioContext();
            }
        }
        if (globalAudioCtx && globalAudioCtx.state === 'suspended') {
            globalAudioCtx.resume();
        }
        return globalAudioCtx;
    }

    // Tự động mở khóa audio khi người dùng click/chạm bất kỳ đâu trên trang
    function unlockAudioOnUserAction() {
        getUnlockedAudioContext();
        document.removeEventListener('click', unlockAudioOnUserAction);
        document.removeEventListener('keydown', unlockAudioOnUserAction);
        document.removeEventListener('touchstart', unlockAudioOnUserAction);
    }
    document.addEventListener('click', unlockAudioOnUserAction);
    document.addEventListener('keydown', unlockAudioOnUserAction);
    document.addEventListener('touchstart', unlockAudioOnUserAction);

    // Phát âm thanh chuông Ting Ting tức thì 0ms
    function playNotificationSound() {
        try {
            var ctx = getUnlockedAudioContext();
            if (!ctx) return;

            var playTone = function() {
                var now = ctx.currentTime;
                
                // Nốt 1 (D5 - 587Hz)
                var osc1 = ctx.createOscillator();
                var gain1 = ctx.createGain();
                osc1.type = 'sine';
                osc1.frequency.setValueAtTime(587.33, now);
                gain1.gain.setValueAtTime(0.4, now);
                gain1.gain.exponentialRampToValueAtTime(0.001, now + 0.4);
                osc1.connect(gain1);
                gain1.connect(ctx.destination);
                osc1.start(now);
                osc1.stop(now + 0.4);

                // Nốt 2 (A5 - 880Hz) ngân vang
                var osc2 = ctx.createOscillator();
                var gain2 = ctx.createGain();
                osc2.type = 'sine';
                osc2.frequency.setValueAtTime(880.00, now + 0.12);
                gain2.gain.setValueAtTime(0.5, now + 0.12);
                gain2.gain.exponentialRampToValueAtTime(0.001, now + 0.8);
                osc2.connect(gain2);
                gain2.connect(ctx.destination);
                osc2.start(now + 0.12);
                osc2.stop(now + 0.8);
            };

            if (ctx.state === 'suspended') {
                ctx.resume().then(playTone);
            } else {
                playTone();
            }
        } catch(e) {
            console.log('[Pico Notification] Sound error:', e);
        }
    }

    // Hiển thị Banner Toast trực tiếp trên màn hình CMS
    function showToastAlert(title, message, url) {
        var existingToast = document.getElementById('pico-toast-notification');
        if (existingToast) existingToast.remove();

        var toast = document.createElement('div');
        toast.id = 'pico-toast-notification';
        toast.style.cssText = 'position:fixed; top:70px; right:20px; z-index:999999; max-width:380px; background:#ffffff; border-left:6px solid #ea580c; border-radius:10px; box-shadow:0 10px 25px rgba(0,0,0,0.2); padding:16px 20px; animation:picoSlideIn 0.4s ease; font-family:\'Roboto\', -apple-system, BlinkMacSystemFont, "Segoe UI", Arial, sans-serif;';
        
        var html = '<div style="display:flex; justify-content:space-between; align-items:flex-start; gap:12px; font-family:\'Roboto\', -apple-system, BlinkMacSystemFont, \'Segoe UI\', Arial, sans-serif;">';
        html += '<div style="font-family:inherit;">';
        html += '<div style="font-weight:700; font-size:14px; color:#0f172a; margin-bottom:4px; font-family:inherit; line-height:1.4;">' + title + '</div>';
        html += '<div style="font-size:13px; color:#475569; line-height:1.45; font-family:inherit;">' + message + '</div>';
        if (url) {
            html += '<div style="margin-top:10px;"><a href="' + url + '" style="display:inline-block; background:#ea580c; color:#ffffff; font-size:12px; font-weight:700; padding:6px 14px; border-radius:6px; text-decoration:none; font-family:inherit;">Xem & Thẩm Định Ngay &rarr;</a></div>';
        }
        html += '</div>';
        html += '<button onclick="this.parentElement.parentElement.remove()" style="background:none; border:none; color:#94a3b8; font-size:18px; cursor:pointer; padding:0; line-height:1; font-family:inherit;">&times;</button>';
        html += '</div>';

        toast.innerHTML = html;
        document.body.appendChild(toast);

        // Tự biến mất sau 12 giây
        setTimeout(function() {
            if (toast && toast.parentElement) {
                toast.style.opacity = '0';
                toast.style.transition = 'opacity 0.5s ease';
                setTimeout(function() { toast.remove(); }, 500);
            }
        }, 12000);
    }

    // Hiển thị thông báo Chrome / System Notification
    function showBrowserNotification(title, body, url) {
        // Luôn hiển thị Toast Alert trong website
        showToastAlert(title, body, url);

        if (!("Notification" in window)) return;

        if (Notification.permission === "granted") {
            try {
                var iconUrl = (typeof PICO_ROOT_BASE !== 'undefined' ? PICO_ROOT_BASE : '/') + 'images/logo.png';
                var notif = new Notification(title, {
                    body: body,
                    icon: iconUrl,
                    requireInteraction: false
                });
                notif.onclick = function() {
                    window.focus();
                    if (url) window.location.href = url;
                    notif.close();
                };
            } catch(e) {
                console.log('[Pico Notification] Error showing notification:', e);
            }
        }
    }

    // Đăng ký Service Worker
    function registerServiceWorker() {
        if ('serviceWorker' in navigator) {
            var swUrl = (typeof PICO_ROOT_BASE !== 'undefined' ? PICO_ROOT_BASE : '/') + 'sw.js';
            navigator.serviceWorker.register(swUrl, { scope: '/' })
                .then(function(reg) {
                    console.log('[Pico Notification] ServiceWorker registered:', reg.scope);
                })
                .catch(function(err) {
                    console.log('[Pico Notification] ServiceWorker registration failed:', err);
                });
        }
    }

    // Yêu cầu quyền nhận thông báo / Gửi thử thông báo mẫu
    window.picoRequestNotificationPermission = function() {
        if (!("Notification" in window)) {
            showToastAlert("🔔 Thông Báo Mẫu", "Trình duyệt đang hỗ trợ chế độ Toast Alert trong trang.", "");
            playNotificationSound();
            return;
        }

        if (Notification.permission === "granted") {
            // Đã bật -> Gửi thử 1 thông báo test
            playNotificationSound();
            showBrowserNotification(
                "🔔 [THỬ NGHIỆM] Chuông Báo Hoạt Động Tốt!",
                "Hệ thống thông báo đẩy trên máy tính đã sẵn sàng nhận hồ sơ thẩm định.",
                window.location.href
            );
            return;
        }

        Notification.requestPermission().then(function(permission) {
            updateNotificationButtonUI();
            if (permission === "granted") {
                playNotificationSound();
                showBrowserNotification(
                    "🔔 Đã Kích Hoạt Thông Báo Thành Công!",
                    "Bạn sẽ nhận được thông báo ngay khi có hồ sơ thẩm định mới từ khách hàng.",
                    window.location.href
                );
            }
        });
    };

    // Cập nhật UI nút chuông trên Header (Trạng thái Web Push)
    function updateNotificationButtonUI() {
        var btn = document.getElementById('btn-toggle-pico-push');
        var icon = document.getElementById('pico-push-bell-icon');
        var badge = document.getElementById('pico-push-badge');
        if (!btn) return;

        if (!("Notification" in window)) {
            if (icon) {
                icon.className = 'fa fa-bell';
                icon.style.color = '#10b981';
            }
            if (badge) {
                badge.style.background = '#10b981';
                badge.style.display = 'block';
            }
            return;
        }

        if (Notification.permission === "granted") {
            if (icon) {
                icon.className = 'fa fa-bell';
                icon.style.color = '#ea580c';
            }
            if (badge) {
                badge.style.background = '#10b981';
                badge.style.display = 'block';
            }
        } else if (Notification.permission === "denied") {
            if (icon) {
                icon.className = 'fa fa-bell-slash';
                icon.style.color = '#ef4444';
            }
            if (badge) {
                badge.style.background = '#ef4444';
                badge.style.display = 'block';
            }
        } else {
            if (icon) {
                icon.className = 'fa fa-bell-o';
                icon.style.color = '#f59e0b';
            }
            if (badge) {
                badge.style.background = '#f59e0b';
                badge.style.display = 'block';
            }
        }
    }

    // Cập nhật số đếm đỏ (Unread Count Badge)
    function updateUnreadBadgeUI(count) {
        var countBadge = document.getElementById('pico-notif-count-badge');
        if (!countBadge) return;

        count = parseInt(count, 10) || 0;
        if (count > 0) {
            countBadge.textContent = count > 99 ? '99+' : count;
            countBadge.style.display = 'block';
        } else {
            countBadge.textContent = '0';
            countBadge.style.display = 'none';
        }
    }

    // Bật/Tắt Dropdown Trung tâm Thông báo
    window.picoToggleNotifDropdown = function(event) {
        if (event) {
            event.stopPropagation();
            event.preventDefault();
        }

        var menu = document.getElementById('pico-notif-dropdown-menu');
        if (!menu) return;

        if (menu.style.display === 'none' || menu.style.display === '') {
            menu.style.display = 'block';
            isDropdownOpen = true;
            picoFetchAndRenderNotifications();
        } else {
            menu.style.display = 'none';
            isDropdownOpen = false;
        }
    };

    // Đóng Dropdown khi click ra ngoài
    document.addEventListener('click', function(e) {
        var wrapper = document.getElementById('pico-notif-dropdown-wrapper');
        var menu = document.getElementById('pico-notif-dropdown-menu');
        if (menu && wrapper && !wrapper.contains(e.target)) {
            menu.style.display = 'none';
            isDropdownOpen = false;
        }
    });

    // Lấy danh sách thông báo và render ra Dropdown
    function picoFetchAndRenderNotifications() {
        var container = document.getElementById('pico-notif-list-container');
        var getUrl = (typeof PICO_ADMIN_BASE !== 'undefined' ? PICO_ADMIN_BASE : '/admin/') + 'index.php/do_dept_review/ajax_get_notifications';

        var xhr = new XMLHttpRequest();
        xhr.open('GET', getUrl + '?t=' + new Date().getTime(), true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    var data = JSON.parse(xhr.responseText);
                    if (data && data.status) {
                        updateUnreadBadgeUI(data.unread_count);
                        renderNotificationList(data.items);
                    }
                } catch(e) {
                    if (container) container.innerHTML = '<div style="padding:20px; text-align:center; color:#94a3b8; font-size:13px;">Không thể tải dữ liệu thông báo.</div>';
                }
            }
        };
        xhr.send();
    }

    // Render danh sách item vào HTML
    function renderNotificationList(items) {
        var container = document.getElementById('pico-notif-list-container');
        if (!container) return;

        if (!items || items.length === 0) {
            container.innerHTML = '<div style="padding:32px 20px; text-align:center; color:#94a3b8; font-size:13px; font-family:\'Roboto\', -apple-system, BlinkMacSystemFont, \'Segoe UI\', Arial, sans-serif;"><i class="fa fa-bell-slash-o" style="font-size:28px; color:#cbd5e1; margin-bottom:8px; display:block;"></i>Hiện chưa có thông báo nào</div>';
            return;
        }

        var html = '';
        var baseAdmin = (typeof PICO_ADMIN_BASE !== 'undefined' ? PICO_ADMIN_BASE : '/admin/');

        items.forEach(function(item) {
            var isUnread = (parseInt(item.nis_read, 10) === 0);
            var itemBg = isUnread ? '#f8fafc' : '#ffffff';
            var unreadDot = isUnread ? '<span style="display:inline-block; width:8px; height:8px; background:#0284c7; border-radius:50%; margin-left:auto; flex-shrink:0;"></span>' : '';
            
            // Icon theo loại
            var iconHtml = '<div style="width:36px; height:36px; border-radius:8px; background:#ffedd5; color:#ea580c; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:15px;"><i class="fa fa-file-text-o"></i></div>';
            if (item.ctype && item.ctype.indexOf('APPROVED') !== -1) {
                iconHtml = '<div style="width:36px; height:36px; border-radius:8px; background:#dcfce7; color:#16a34a; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:15px;"><i class="fa fa-check-circle"></i></div>';
            } else if (item.ctype && item.ctype.indexOf('REJECTED') !== -1) {
                iconHtml = '<div style="width:36px; height:36px; border-radius:8px; background:#fee2e2; color:#dc2626; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:15px;"><i class="fa fa-times-circle"></i></div>';
            }

            var itemUrl = item.clink ? (item.clink.indexOf('http') === 0 ? item.clink : baseAdmin + item.clink) : 'javascript:;';

            html += '<div onclick="picoClickNotification(' + item.nid + ', \'' + itemUrl.replace(/'/g, "\\'") + '\')" style="display:flex; align-items:flex-start; gap:12px; padding:12px 16px; border-bottom:1px solid #f1f5f9; background:' + itemBg + '; cursor:pointer; transition:background 0.2s ease; font-family:\'Roboto\', -apple-system, BlinkMacSystemFont, \'Segoe UI\', Arial, sans-serif;" onmouseover="this.style.background=\'#f1f5f9\';" onmouseout="this.style.background=\'' + itemBg + '\';">';
            html += iconHtml;
            html += '<div style="flex:1; min-width:0; font-family:inherit;">';
            html += '<div style="display:flex; align-items:center; justify-content:space-between; gap:6px; margin-bottom:2px; font-family:inherit;">';
            html += '<div style="font-size:13px; font-weight:' + (isUnread ? '700' : '500') + '; color:' + (isUnread ? '#0f172a' : '#334155') + '; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; font-family:inherit;">' + (item.ctitle || 'Thông báo') + '</div>';
            html += unreadDot;
            html += '</div>';
            html += '<div style="font-size:12px; color:#64748b; line-height:1.4; margin-bottom:4px; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; font-family:inherit;">' + (item.cmessage || '') + '</div>';
            html += '<div style="font-size:11px; color:#94a3b8; font-family:inherit;"><i class="fa fa-clock-o"></i> ' + (item.time_ago || '') + '</div>';
            html += '</div>';
            html += '</div>';
        });

        container.innerHTML = html;
    }

    // Click vào 1 thông báo: Đánh dấu đã đọc và chuyển hướng
    window.picoClickNotification = function(notifId, url) {
        var markUrl = (typeof PICO_ADMIN_BASE !== 'undefined' ? PICO_ADMIN_BASE : '/admin/') + 'index.php/do_dept_review/ajax_mark_as_read?notif_id=' + notifId;
        
        var xhr = new XMLHttpRequest();
        xhr.open('GET', markUrl, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onload = function() {
            if (url && url !== 'javascript:;') {
                window.location.href = url;
            }
        };
        xhr.onerror = function() {
            if (url && url !== 'javascript:;') {
                window.location.href = url;
            }
        };
        xhr.send();
    };

    // Đánh dấu tất cả thông báo là đã đọc
    window.picoMarkAllNotificationsRead = function(event) {
        if (event) {
            event.stopPropagation();
            event.preventDefault();
        }

        var markUrl = (typeof PICO_ADMIN_BASE !== 'undefined' ? PICO_ADMIN_BASE : '/admin/') + 'index.php/do_dept_review/ajax_mark_as_read?mark_all=1';
        
        var xhr = new XMLHttpRequest();
        xhr.open('GET', markUrl, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onload = function() {
            updateUnreadBadgeUI(0);
            picoFetchAndRenderNotifications();
        };
        xhr.send();
    };

    // Khởi tạo kiểm tra định kỳ (Realtime Polling mỗi 8 giây)
    function checkNewSubmissions() {
        var checkUrl = (typeof PICO_ADMIN_BASE !== 'undefined' ? PICO_ADMIN_BASE : '/admin/') + 'index.php/do_dept_review/ajax_check_new_submissions';
        
        var xhr = new XMLHttpRequest();
        xhr.open('GET', checkUrl + '?last_id=' + lastCheckedSubmissionId + '&t=' + new Date().getTime(), true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onload = function() {
            if (xhr.status === 200) {
                try {
                    var data = JSON.parse(xhr.responseText);
                    if (data) {
                        // Cập nhật số đếm đỏ
                        if (typeof data.unread_count !== 'undefined') {
                            updateUnreadBadgeUI(data.unread_count);
                        }

                        // Nếu có hồ sơ mới được nộp
                        if (data.has_new && data.new_submissions && data.new_submissions.length > 0) {
                            playNotificationSound();
                            data.new_submissions.forEach(function(item) {
                                showBrowserNotification(
                                    "🏢 [HỒ SƠ THẨM ĐỊNH MỚI] #" + item.ccode,
                                    item.doc_type_name + " — Khách hàng: " + item.ccustomer_name,
                                    item.review_url
                                );
                            });
                            lastCheckedSubmissionId = data.max_id;

                            // Làm mới danh sách nếu dropdown đang mở
                            if (isDropdownOpen) {
                                picoFetchAndRenderNotifications();
                            }
                        } else if (data.max_id) {
                            if (lastCheckedSubmissionId === 0) {
                                lastCheckedSubmissionId = data.max_id;
                            }
                        }
                    }
                } catch(e) {}
            }
        };
        xhr.send();
    }

    // Tự động chạy khi DOM sẵn sàng
    document.addEventListener('DOMContentLoaded', function() {
        registerServiceWorker();
        updateNotificationButtonUI();
        
        // Kiểm tra ngay số đếm thông báo sau 1 giây
        setTimeout(function() {
            checkNewSubmissions();
        }, 1000);

        // Polling kiểm tra hồ sơ mới mỗi 8 giây
        setInterval(checkNewSubmissions, 8000);
    });

})();
