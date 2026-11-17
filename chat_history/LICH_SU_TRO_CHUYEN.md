# LỊCH SỬ TRÒ CHUYỆN & TỔNG HỢP CÁC YÊU CẦU XỬ LÝ (PROJECT PICO PLAZA)

*Thời gian tổng hợp: 13/11/2026*  
*Môi trường: PHP / CodeIgniter / MariaDB - XAMPP (Windows)*  
*Thư mục gốc:* `c:\xampp\htdocs\picoplaza`

---

## MỤC LỤC
1. [Quản lý Thùng rác Thành viên (do_member_listview & do_member_trash_listview)](#1-quản-lý-thùng-rác-thành-viên)
2. [Sửa lỗi thẩm định hồ sơ #HS-202611-FD164 & Trạng thái Ban Giám đốc](#2-sửa-lỗi-thẩm-định-hồ-sơ-hs-202611-fd164)
3. [Rà soát & Chuẩn hóa nội dung thông báo Telegram](#3-rà-soát--chuẩn-hóa-nội-dung-thông-báo-telegram)
4. [Kiểm tra & Khắc phục lỗi gửi Email Bản tin Mailjet (do_newsletter)](#4-kiểm-tra--khắc-phục-lỗi-gửi-email-bản-tin-mailjet)
5. [Khắc phục lỗi Apache 500 khi Nộp Hồ Sơ Trực Tuyến bằng file PDF scan](#5-khắc-phục-lỗi-apache-500-khi-nộp-hồ-sơ-trực-tuyến-bằng-file-pdf-scan)
6. [Format lại giao diện tin nhắn Telegram Thông báo Thẩm định Hồ sơ](#6-format-lại-giao-diện-tin-nhắn-telegram-thông-báo-thẩm-định-hồ-sơ)
7. [Đổi nhãn "Người nộp" thành "Khách hàng" trong toàn bộ Thông báo Telegram](#7-đổi-nhãn-người-nộp-thành-khách-hàng-trong-toàn-bộ-thông-báo-telegram)

---

## 1. Quản lý Thùng rác Thành viên
### 1.1. Yêu cầu của người dùng
- Trong CMS Admin mục Quản lý Thành viên (`do_member_listview`), thêm một nút để chuyển tới trang quản lý các tài khoản khách hàng đã đánh dấu xóa (`cdel = 1`).
- Trong giao diện thùng rác, bổ sung chức năng tìm kiếm, phân trang, lọc và nút "Khôi phục", nút "Xóa hẳn khỏi CSDL".
- Bố trí giao diện, nút bấm đồng bộ với các listview khác trong hệ thống.
- Bổ sung nút "Sửa" và bỏ cụm text `(cdel=1)` trên tiêu đề trang theo phản hồi qua hình ảnh.

### 1.2. Các file đã xử lý
- `admin/application/controllers/do_member_listview.php`: Thêm nút điều hướng sang trang thùng rác.
- `admin/application/controllers/do_member_trash_listview.php`: Controller quản lý danh sách thành viên `cdel = 1`, xử lý khôi phục (`cdel = 0`) và xóa vĩnh viễn khỏi CSDL (`DELETE FROM picoplaza_tmember`).
- `admin/application/views/member_trash_listview/`: View hiển thị danh sách thùng rác, bảng dữ liệu, nút Sửa, nút Khôi phục, nút Xóa hẳn, loại bỏ text kỹ thuật `(cdel=1)` trên tiêu đề.

---

## 2. Sửa lỗi thẩm định hồ sơ #HS-202611-FD164
### 2.1. Yêu cầu của người dùng
- Kiểm tra tại sao hồ sơ **#HS-202611-FD164**, Ban Giám đốc chỉ có 1 nhân sự là **TRỊNH NGỌC TUẤN**, nhưng trên màn hình tiến độ phòng ban (`do_dept_review/detail/22/5`) lại báo *"Người duyệt: PHẠM DUY NĂNG"*.
- Làm rõ tính chính xác về việc TRỊNH NGỌC TUẤN đã duyệt hay chưa, chuẩn hóa truy vấn trả về đúng trạng thái Ban Giám đốc chưa duyệt nếu chưa thực hiện.
- Đổi nhãn trạng thái từ **"Chờ"** thành **"Chờ duyệt"**.

### 2.2. Phân tích & Giải pháp
- **Nguyên nhân:** Dữ liệu bước thẩm định trong bảng `picoplaza_tdoc_approval_step` của phòng Ban Giám đốc (`nid_dept = 5`) bị gán nhầm `nid_staff_user` của chuyên viên phòng kỹ thuật (`PHẠM DUY NĂNG`, ID: 8) thay vì tài khoản Ban Giám đốc (`TRỊNH NGỌC TUẤN`, ID: 10/12).
- **Giải pháp:**
  - Cập nhật logic trong `workflow_helper.php` và controller `do_dept_review.php` để chuẩn hóa người duyệt đúng theo phân công phòng ban.
  - Xử lý câu SQL kiểm tra logic thẩm định: Khi Ban Giám đốc chưa duyệt, hiển thị rõ ràng người phụ trách và trạng thái đang chờ duyệt.
  - Cập nhật nhãn hiển thị thành **"Chờ duyệt"** (kèm biểu tượng đồng hồ màu cam) trên giao diện tiến độ thẩm định của các phòng ban.

### 2.3. Các file đã xử lý
- `admin/application/helpers/workflow_helper.php`
- `admin/application/controllers/do_dept_review.php`
- `admin/application/views/dept_review_view/`

---

## 3. Rà soát & Chuẩn hóa nội dung thông báo Telegram
### 3.1. Yêu cầu của người dùng
- Rà soát toàn bộ các câu thông báo tự động gửi qua Bot Telegram trong toàn bộ hệ thống.
- Thay thế đồng loạt cụm từ:
  > *"Vui lòng đăng nhập CMS ..."*  
  thành:  
  > *"Vui lòng đăng nhập trang quản trị ..."*

### 3.2. Các file đã xử lý
- Rà soát và cập nhật mẫu tin nhắn trong `admin/application/helpers/workflow_helper.php` (các thông báo hồ sơ mới, hồ sơ chuyển bước, hoàn tất thẩm định, nhắc hạn phê duyệt).
- Cập nhật các thông báo Telegram gửi qua `send_telegram_core()` và `send_telegram_multi()`.

---

## 4. Kiểm tra & Khắc phục lỗi gửi Email Bản tin Mailjet (do_newsletter)
### 4.1. Hiện tượng & Yêu cầu
- Khi vào trang Quản trị CMS `index.php/do_newsletter`, chọn khách hàng nhận tin và bấm nút:
  *"GỬI THÔNG BÁO TỚI CÁC KHÁCH HÀNG ĐÃ CHỌN"*
  thì hệ thống xuất hiện cảnh báo lỗi:
  > *"Có lỗi xảy ra trong quá trình kết nối Mailjet API!"*

### 4.2. Nguyên nhân kỹ thuật phát hiện
1. **Email người gửi chưa được xác thực (Unverified Sender):**
   - Hàm `send_mail_mailjet()` sử dụng địa chỉ người gửi mặc định là `info@picoplaza.vn`.
   - Cơ chế bảo mật Mailjet v3.1 bắt buộc email người gửi hoặc domain `picoplaza.vn` phải được đăng ký và xác thực (Verified Sender / SPF / DKIM) trong tài khoản Mailjet sở hữu cặp API Key `6e0bab7456...`. Nếu chưa verify, Mailjet từ chối ngay với mã lỗi **HTTP 400 Bad Request**.
2. **Ẩn toàn bộ thông tin lỗi cURL / Mailjet:**
   - Code cũ dùng `@curl_exec()` và chỉ kiểm tra `return ($http_code == 200 || $http_code == 201)`. Khi cURL lỗi mạng, timeout hoặc Mailjet trả về lỗi JSON, hàm trả về `false` và controller hiển thị thông báo mù mờ.
3. **Lộ thông tin email khách hàng & Giới hạn 50 người nhận:**
   - Code cũ gộp chung toàn bộ khách hàng được chọn vào 1 thuộc tính `'To' => $arr_to`. Khách hàng nhận được sẽ nhìn thấy danh sách email của tất cả khách hàng khác; đồng thời nếu chọn trên 50 người, Mailjet API sẽ báo lỗi vượt quá giới hạn người nhận trên 1 tin nhắn.
4. **Nghẽn phân giải DNS IPv6 trên máy chủ Windows:**
   - cURL chưa cấu hình `CURLOPT_IPRESOLVE_V4` nên Windows thường mất 5 giây truy vấn DNS IPv6 trước khi chuyển sang IPv4, dễ dẫn đến timeout kết nối.

### 4.3. Các xử lý & Cải tiến đã thực hiện
1. **Tách riêng từng Message & Chia lô 50 (Batching):**
   - Mỗi khách hàng được tạo thành 1 Message độc lập trong mảng `Messages` của Mailjet API. Đảm bảo bảo mật thông tin tuyệt đối giữa các khách hàng và tự động chia lô tối đa 50 tin/lần gọi theo đúng chuẩn Mailjet v3.1.
2. **Tối ưu hóa kết nối mạng cURL:**
   - Bổ sung `CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4`, bộ nhớ đệm DNS `CURLOPT_DNS_CACHE_TIMEOUT => 600`, và nâng thời gian chờ timeout lên 15 giây.
3. **Phân tích phản hồi & Hiển thị thông báo lỗi chi tiết:**
   - Bổ sung tham số nhận lỗi `&$error_detail` cho `send_mail_mailjet()`.
   - Tự động bóc tách mã lỗi HTTP và nội dung JSON của Mailjet để hiển thị thông điệp tiếng Việt thân thiện, rõ ràng trực tiếp trên giao diện CMS (ví dụ: báo rõ email gửi chưa được verify trên Mailjet, sai API key hay timeout).
4. **Tích hợp file nhật ký [mailjet_debug.log](file:///c:/xampp/htdocs/picoplaza/mailjet_debug.log):**
   - Mọi lượt gửi email đều tự động ghi log: thời gian, người gửi, số lượng người nhận, mã HTTP, lỗi cURL và chuỗi phản hồi nguyên bản từ Mailjet để quản trị viên dễ dàng theo dõi.
5. **Cập nhật đồng bộ các file:**
   - `admin/application/helpers/ap_object_helper.php`: Cập nhật hàm `send_mail_mailjet()` và bổ sung `get_value_by_config()`.
   - `application/helpers/ap_module_helper.php`: Cập nhật đồng bộ hàm `send_mail_mailjet()` cho frontend.
   - `admin/application/controllers/do_newsletter.php`: Tiếp nhận lỗi chi tiết từ helper và hiển thị ra `$m_error_msg`.
   - `admin/application/views/newsletter_view/index.php`: Đổi sang hộp cảnh báo màu đỏ `alert-danger` khi có lỗi và màu xanh `alert-success` khi thành công.

---

## 5. Khắc phục lỗi Apache 500 khi Nộp Hồ Sơ Trực Tuyến bằng file PDF scan
### 5.1. Hiện tượng & Yêu cầu
- Khi nộp hồ sơ tại trang `doc_portal/submit`, người dùng tải lên file PDF scan tài liệu ("Giấy đề nghị vận chuyển tài sản ra, vào tòa nhà" - 2 trang scan màu có dấu đỏ) thì gặp màn hình lỗi trắng của Apache:
  > *"Internal Server Error: The server encountered an internal error or misconfiguration and was unable to complete your request. Please contact the server administrator at root@localhost..."*
- Khi thử tải lên bằng các file ảnh thông thường (JPG, PNG) thì nộp thành công, không bị lỗi.

### 5.2. Nguyên nhân kỹ thuật
1. **Dung lượng file scan PDF vượt giới hạn mặc định của Web Server / FastCGI:**
   - File PDF scan 2 trang màu độ phân giải cao có dung lượng chính xác là **5.898 KB (~ 5,76 MB)**.
   - Trong khi đó, cấu hình mặc định của Apache FastCGI (`mod_fcgid`) có tham số `FcgidMaxRequestLen = 2097152` (chỉ đúng **2 MB = 2.048 KB**), và PHP mặc định `upload_max_filesize = 2M`.
   - File 5,76 MB **vượt gần gấp 3 lần** mức trần 2 MB của máy chủ, khiến Apache ngắt kết nối ngay lập tức tại tầng Web Server và trả về trang lỗi **Apache 500 Internal Server Error** trước khi PHP kịp xử lý hay ghi log.
   - Các file ảnh JPG/PNG người dùng test trước đó có dung lượng nhỏ (< 1.5MB - tức dưới 2.048 KB) nên đi qua trót lọt mà không bị Apache chặn.
2. **Thiếu kiểm tra dung lượng phía Client (Front-end):**
   - Form thông báo *"Dung lượng tối đa 15MB"*, tuy nhiên sự kiện chọn file từ máy (`showFileName`) trước đó không hề kiểm tra `file.size`. Khi người dùng chọn file lớn hoặc file vượt ngưỡng, hệ thống vẫn cho submit khiến request bị Apache đánh sập.
3. **Chưa bắt lỗi dung lượng PHP (`post_max_size` và `upload_max_filesize`):**
   - Nếu file vượt `post_max_size`, PHP tự động hủy sạch toàn bộ dữ liệu `$_POST` và `$_FILES`.
   - Controller `doc_portal.php` chưa bắt mã lỗi `UPLOAD_ERR_INI_SIZE` / `UPLOAD_ERR_FORM_SIZE` nên không có thông báo tiếng Việt hướng dẫn người dùng nén file.

### 5.3. Các xử lý & Cải tiến đã thực hiện
1. **Nâng giới hạn tải lên trên Web Server (.htaccess):**
   - Bổ sung `LimitRequestBody 67108864` (64MB).
   - Bổ sung `FcgidMaxRequestLen 67108864` (64MB) trong `<IfModule mod_fcgid.c>`.
   - Cấu hình các directive PHP trong `<IfModule mod_php7.c>` và `mod_php.c>`: `upload_max_filesize 32M`, `post_max_size 64M`, `memory_limit 256M`, `max_execution_time 300`.
2. **Tạo file cấu hình [.user.ini](file:///c:/xampp/htdocs/picoplaza/.user.ini):**
   - Cung cấp cấu hình INI trực tiếp cho máy chủ chạy PHP-FPM / FastCGI (cPanel, DirectAdmin, Plesk): `upload_max_filesize = 32M`, `post_max_size = 64M`.
3. **Bổ sung kiểm soát dung lượng tệp ngay trên Client (`submit.php`):**
   - Hàm `showFileName(input)`: Ngay khi người dùng chọn file, kiểm tra định dạng và dung lượng:
     - Nếu > 15MB: Báo lỗi popup ngay, xóa file đã chọn và cảnh báo chữ đỏ, tuyệt đối không cho gửi.
     - Nếu từ 8MB – 15MB: Đổi chữ sang màu cam kèm chú thích *"Tệp khá lớn, quá trình tải lên có thể mất vài giây"*.
   - Khóa chặn submit form nếu tệp đính kèm vượt mức 15MB.
4. **Bắt lỗi dung lượng thân thiện trong Controller (`doc_portal.php`):**
   - Bắt trường hợp `$_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST)` do tràn `post_max_size`.
   - Bắt các mã lỗi upload của PHP (`UPLOAD_ERR_INI_SIZE`, `UPLOAD_ERR_FORM_SIZE`, `UPLOAD_ERR_PARTIAL`, `UPLOAD_ERR_NO_FILE`) và hiển thị thông báo flash lỗi rõ ràng bằng tiếng Việt.

5. **Chuyển đổi phương thức Nộp hồ sơ sang AJAX + Bắt lỗi Web Server thời gian thực:**
   - Thay vì submit form truyền thống (khiến trình duyệt bị chuyển hướng thẳng sang trang trắng Apache 500), chuyển toàn bộ luồng sang **AJAX (`XMLHttpRequest`)**.
   - Bổ sung thanh tiến trình thực tế (`xhr.upload.onprogress`), hiển thị phần trăm và số MB đã tải (`X.XX MB / Y.YY MB`).
   - Hiển thị thông số PHP thực tế nhận diện ngay dưới ô chọn file: `upload_max = ... | post_max = ...`.
   - **Bắt chính xác mã lỗi HTTP (500, 413, 0...):** Khi máy chủ từ chối kết nối hoặc ngắt giữa chừng, JavaScript lập tức chặn lại và mở hộp thông báo thân thiện với khách hàng trực tiếp trên form, loại bỏ hoàn toàn các thuật ngữ kỹ thuật khó hiểu (không nhắc FcgidMaxRequestLen hay ModSecurity).
   - Nội dung thông báo hướng dẫn khách hàng rõ ràng, lịch sự: *"Dung lượng tệp đính kèm quá lớn khiến hệ thống chưa thể tiếp nhận. Vui lòng dùng công cụ này để nén file trước khi submit: https://www.ilovepdf.com/compress_pdf hoặc liên hệ Ban quản trị để được hỗ trợ."*
   - Cập nhật đúng đường link nén PDF: `https://www.ilovepdf.com/compress_pdf`.
   - Controller `doc_portal.php`: Bổ sung hàm `return_submit_result()`, trả về chuẩn JSON cho AJAX và chuẩn Flash session cho HTTP redirect.

---

## 6. Format lại giao diện tin nhắn Telegram Thông báo Thẩm định Hồ sơ
### 6.1. Yêu cầu của người dùng
- Định dạng lại mẫu thông báo gửi đến các nhóm/kênh Telegram của Ban quản lý và các phòng ban theo thiết kế mẫu (nhánh bên phải trong ảnh minh họa đính kèm).
- Loại bỏ hoàn toàn chữ `CMS` trong câu dẫn liên kết đăng nhập: Chuyển từ *"Vui lòng đăng nhập CMS tại đây..."* thành *"Vui lòng đăng nhập tại đây để theo dõi hồ sơ."* (gắn link vào cụm từ "tại đây").
- Ẩn bớt các trường thông tin không cần thiết trên tin nhắn Telegram: Bỏ dòng `Email` và dòng `Ghi chú`.
- Đổi tên liên kết tệp đính kèm thành *"Xem tệp hồ sơ"* (thay cho *"Xem tệp scan/ảnh"*).
- Trạng thái thẩm định được làm nổi bật bằng định dạng gạch chân `<u>...</u>`:
  - Thông báo nộp hồ sơ mới: `<u>Chờ thẩm định</u>`
  - Thông báo hoàn tất: `<u>ĐÃ HOÀN TẤT THẨM ĐỊNH</u>`
- Phân cách nội dung thành 3 khối rõ ràng bằng đường kẻ nét đứt `----------------------------------------`:
  - Khối 1: Tiêu đề & Người nộp (kèm SĐT).
  - Khối 2: Mã hồ sơ, Loại hồ sơ, Tệp hồ sơ (kèm link xem tệp tải về từ khách hoặc file đã đóng dấu thẩm định).
  - Khối 3: Trạng thái, Thời gian và Link đăng nhập theo dõi.

### 6.2. Các file đã xử lý
1. `application/helpers/workflow_helper.php`:
   - Hàm `workflow_notify_new_submission()`: Cập nhật mẫu tin nhắn gửi cho các Trưởng/Chuyên viên phòng ban và gửi riêng cho Admin Tổng hợp.
   - Hàm `workflow_notify_all_depts_completed()`: Cập nhật mẫu tin nhắn khi tất cả các phòng ban đã thẩm định hoàn tất.
   - Hàm `workflow_notify_admin_waiting()` và `workflow_dept_review()`: Cập nhật các thông báo tiến trình thẩm định đồng bộ chuẩn giao diện mới.
2. `admin/application/helpers/workflow_helper.php`:
   - Đồng bộ hoàn toàn logic và cấu trúc tin nhắn Telegram tương ứng để đảm bảo tính nhất quán giữa cả Client Portal và Admin Backend.

---

## 7. Đổi nhãn "Người nộp" thành "Khách hàng" trong toàn bộ Thông báo Telegram
### 7.1. Yêu cầu của người dùng
- Rà soát và thay đổi toàn bộ text hiển thị trong các mẫu tin nhắn thông báo Telegram từ `Người nộp` thành `Khách hàng`.

### 7.2. Các file đã xử lý
1. `application/helpers/workflow_helper.php`:
   - Hàm `workflow_dept_review()`: Đổi `👤 <b>Người nộp:</b>` thành `👤 <b>Khách hàng:</b>`
   - Hàm `workflow_notify_new_submission()` (nhóm Phòng ban): Đổi `👤 <b>Người nộp:</b>` thành `👤 <b>Khách hàng:</b>`
   - Hàm `workflow_notify_new_submission()` (nhóm Ban Quản Trị / Admin): Đổi `👤 <b>Người nộp:</b>` thành `👤 <b>Khách hàng:</b>`
   - Hàm `workflow_notify_all_depts_completed()`: Đổi `👤 <b>Người nộp:</b>` thành `👤 <b>Khách hàng:</b>`
   - Hàm `workflow_notify_admin_waiting()`: Đổi `👤 <b>Người nộp:</b>` thành `👤 <b>Khách hàng:</b>`
2. `admin/application/helpers/workflow_helper.php`:
   - Đồng bộ tương tự 5 vị trí trên sang `👤 <b>Khách hàng:</b>` để đảm bảo thống nhất tuyệt đối giữa Client Portal và Admin CMS.

---
*Ghi chú: Lịch sử trên được cập nhật tự động sau mỗi yêu cầu để phục vụ việc chuyển giao và tiếp tục phiên làm việc trên các thiết bị khác.*

