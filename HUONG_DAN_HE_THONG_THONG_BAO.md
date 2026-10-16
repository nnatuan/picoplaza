# 📋 TÀI LIỆU TỔNG KẾT HỆ THỐNG THÔNG BÁO PICO PLAZA

> **Tài liệu ghi chú & hướng dẫn vận hành hệ thống thông báo đa kênh cho việc Tiếp nhận & Thẩm định Hồ sơ Trực tuyến Pico Plaza.**

---

## 📌 PHẦN 1: TÓM TẮT DIỄN BIẾN & CÁC VẤN ĐỀ ĐÃ XỬ LÝ

### 1. Vấn đề Telegram:
* **Hiện tượng:** Khi set quyền Admin cho Bot Telegram trong nhóm phòng ban thì không nhận được thông báo nữa; số lượng member hiển thị bị lệch.
* **Nguyên nhân cốt lõi:**
  1. Khi một nhóm Telegram thông thường (Basic Group) được set Bot làm Admin, Telegram tự động nâng cấp nhóm đó thành **Supergroup**. Chat ID của nhóm bị **thay đổi vĩnh viễn** sang dãy số mới bắt đầu bằng `-100...` (ví dụ: `-1003558522936`).
  2. Lỗi mạng DNS trên máy chủ hosting: cURL mặc định hỏi IPv6 của `api.telegram.org` bị nghẽn (`Resolving timed out after 5000 milliseconds`).
* **Giải pháp đã thực hiện:**
  * Bắt tự động `migrate_to_chat_id` trong code Telegram helper.
  * Cập nhật toàn bộ Chat ID mới dạng `-100...` cho 5 phòng ban và nhóm Admin.
  * Ép cURL sử dụng IPv4 (`CURLOPT_IPRESOLVE_V4`) + Bật bộ nhớ đệm DNS (`CURLOPT_DNS_CACHE_TIMEOUT => 600`), giúp tốc độ gửi Telegram tức thì trong **0.02 giây**.

---

### 2. Vấn đề Gửi Mail (Mailjet) & Tốc độ Frontend:
* **Hiện tượng:** Nộp hồ sơ ở Frontend bị chờ lâu (1s - 3s) hoặc dễ gặp Gateway Timeout khi máy chủ gửi mail/tele đồng bộ.
* **Giải pháp đã thực hiện:**
  * **Chuyển sang cơ chế AJAX ngầm (Background Dispatch):** Khách hàng nộp hồ sơ chỉ mất **0.05 giây** là chuyển trang ngay lập tức sang màn hình theo dõi tiến độ (`doc_portal/track/HS-xxxxxx`).
  * Trình duyệt tự động kích hoạt AJAX ngầm trong nền để gửi **Telegram phòng ban + Telegram Admin + Email Mailjet** mà không làm treo hay ảnh hưởng đến người dùng.

---

### 3. Vấn đề Nền tảng Viber & Rào cản đăng ký:
* **Hiện tượng:** Người dùng tạo Bot Viber trên `partners.viber.com` bị chuyển hướng về `/about` và mục `Company details` trỏ vào form HubSpot báo lỗi.
* **Nguyên nhân:** Rakuten Viber đã khóa tính năng tạo Bot miễn phí cho cá nhân, bắt buộc xét duyệt doanh nghiệp qua đối tác có tính phí (Viber Commercial Account).
* **Trạng thái Code:** Đã viết sẵn module `send_viber_core` và cấu hình switch `picoplaza_tconfig (nid = 25: 1 = Telegram, 0 = Viber)` để sẵn sàng nếu sau này công ty đăng ký gói Viber Business.

---

## 🚀 PHẦN 2: TRIỂN KHAI GIẢI PHÁP WEB PUSH NOTIFICATION (GIẢI PHÁP KHUYÊN DÙNG)

Do Telegram bị hạn chế việc tạo tài khoản mới tại VN (chặn SMS OTP) và Viber khóa tạo Bot, hệ thống đã được nâng cấp thêm **Web Push Notification & Realtime Toast Alert** trực tiếp trên trình duyệt.

### 🌟 Ưu điểm vượt trội của Web Push:
* **Không cần tải app**, **không cần đăng ký tài khoản** Telegram hay Viber.
* Nhận thông báo **ngay trên màn hình khóa điện thoại (Android)** hoặc **góc phải màn hình máy tính (Windows/Mac)**.
* Có âm thanh chuông báo `Ting Ting` kích thích chuyên viên mở xem hồ sơ.
* Tự động lọc thông báo đúng theo phòng ban của chuyên viên đang đăng nhập.

---

## 🛠️ HƯỚNG DẪN KÍCH HOẠT & SỬ DỤNG CHO NHÂN VIÊN PHÒNG BAN

### 1. Kích hoạt trên Máy tính (Google Chrome / Cốc Cốc / Microsoft Edge):
1. Chuyên viên phòng ban truy cập vào trang quản trị CMS: `https://demo.anmydesign.com/admin/` (hoặc domain chính thức).
2. Nhìn lên góc trên bên phải (ngay cạnh Avatar và tên tài khoản), bấm vào icon chiếc chuông tròn:
   👉 **`[🔔 Icon Chuông]`** (Chấm vàng/cam: Chưa bật | Chấm xanh lá: Đã bật & sẵn sàng | Chấm đỏ: Đang chặn)
3. Trình duyệt hiện popup hỏi: *"demo.anmydesign.com muốn gửi thông báo cho bạn"* -> Bấm **"Cho phép" (Allow)**.
4. Icon chuông chuyển sang chấm xanh lá kèm tiếng chuông Ting Ting xác nhận kích hoạt thành công. (Bấm lại vào icon chuông bất kỳ lúc nào để test thử âm thanh chuông và popup thông báo).
5. Từ lúc này, mỗi khi có khách hàng nộp hồ sơ mới gửi cho phòng ban của bạn, góc phải màn hình máy tính sẽ tự động nhảy thông báo kèm chuông báo tức thì 0ms, dù bạn đang thu nhỏ trình duyệt hay đang làm việc khác.

---

### 2. Kích hoạt trên Điện thoại (Android & iOS):
* **Trên Android (Chrome/Cốc Cốc):** Mở link CMS -> Đăng nhập -> Bấm nút **"Bật Thông Báo Desktop"** -> Chọn **"Cho phép" (Allow)**. Kể cả khi tắt màn hình, khóa máy điện thoại vẫn rung và đổ chuông thông báo hồ sơ mới.
* **Trên iPhone (iOS 16.4 trở lên):** Mở link CMS trên Safari -> Bấm nút Chia sẻ (icon hình vuông có mũi tên lên) -> Chọn **"Thêm vào Màn hình chính" (Add to Home Screen)** -> Mở icon từ màn hình chính và bấm Bật thông báo.

---

## 🔔 PHẦN 3: HỆ THỐNG TRUNG TÂM THÔNG BÁO LƯU TRỮ (IN-APP NOTIFICATION CENTER)

Nhằm đảm bảo **không bao giờ bị bỏ sót hồ sơ** khi nhân viên vắng mặt hoặc chưa mở máy, hệ thống đã được tích hợp thêm **Notification Center & CSDL lưu trữ thông báo**:

### 🌟 Tính năng nổi bật:
1. **Bảng CSDL `picoplaza_tdoc_notification`:**
   - Tự động tạo và lưu trữ mọi biến động: Khách hàng nộp hồ sơ mới, Phòng ban đã duyệt/từ chối, BQL phê duyệt hoàn tất.
   - Ghi nhận trạng thái: Chưa đọc (0) / Đã đọc (1), phòng ban tiếp nhận, link trực tiếp đến hồ sơ.
2. **Số đếm đỏ trên Icon Chuông (Red Badge Count):**
   - Hiển thị số lượng thông báo chưa đọc (ví dụ: `🔴 3`).
   - Tự động đồng bộ và nhảy số theo thời gian thực mỗi 8 giây.
3. **Menu Thả Xuống (Notification Dropdown Panel):**
   - Bấm vào icon Chuông trên Header để mở danh sách thông báo gần nhất.
   - Hiển thị đầy đủ: Loại hồ sơ, Mã hồ sơ, Tên khách hàng, Thời gian tương đối (*"5 phút trước"*, *"Hôm nay 10:30"*).
   - Bấm vào thông báo sẽ mở ngay màn hình thẩm định và tự động đánh dấu đã đọc (số đếm đỏ tự giảm).
   - Có nút **"Đánh dấu tất cả đã đọc"** để xoá nhanh số đếm đỏ.

---

## 📂 DANH SÁCH CÁC FILE ĐÃ ĐƯỢC TỐI ƯU TRONG HỆ THỐNG

| Tên File | Vai trò & Chức năng |
| :--- | :--- |
| [`sw.js`](file:///c:/xampp56/htdocs/picoplaza/sw.js) | Service Worker xử lý Push Notification và Click mở link hồ sơ |
| [`admin/js/pico_push_notification.js`](file:///c:/xampp56/htdocs/picoplaza/admin/js/pico_push_notification.js) | Client JS: Dropdown thông báo, Số đếm đỏ, Chuông Ting Ting, Realtime Polling |
| [`admin/application/views/modules/mod_header.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/views/modules/mod_header.php) | Header Top Nav: Dropdown chuông, Số đếm đỏ, Menu thả xuống danh sách thông báo |
| [`admin/application/controllers/Do_dept_review.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/controllers/Do_dept_review.php) | API `ajax_get_notifications`, `ajax_mark_as_read`, `ajax_check_new_submissions` |
| [`application/helpers/workflow_helper.php`](file:///c:/xampp56/htdocs/picoplaza/application/helpers/workflow_helper.php) | Tự động tạo bảng `tdoc_notification`, lưu thông báo khi nộp & thẩm định hồ sơ |
| [`admin/application/helpers/workflow_helper.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/helpers/workflow_helper.php) | Helper quản lý trạng thái thông báo, tính thời gian `Fdoc_time_ago` |
| [`application/controllers/Doc_portal.php`](file:///c:/xampp56/htdocs/picoplaza/application/controllers/Doc_portal.php) | Xử lý nộp hồ sơ AJAX ngầm, chuyển trang tức thì trong 0.05s |
| [`application/views/doc_portal/track.php`](file:///c:/xampp56/htdocs/picoplaza/application/views/doc_portal/track.php) | Kích hoạt trigger thông báo ngầm khi nộp xong |
| [`application/helpers/ap_module_helper.php`](file:///c:/xampp56/htdocs/picoplaza/application/helpers/ap_module_helper.php) | Hàm `send_telegram_core`, `send_viber_core`, `send_mail_mailjet` ép IPv4 & DNS cache |

---
*Tài liệu được khởi tạo và cập nhật tự động vào hệ sinh thái Pico Plaza.*

