# 📜 TỔNG HỢP TOÀN BỘ LỊCH SỬ YÊU CẦU & CẬP NHẬT HỆ THỐNG PICO PLAZA

> **Dự án:** Hệ thống Cổng tiếp nhận & Thẩm định Hồ sơ trực tuyến Pico Plaza Sài Gòn  
> **Thời gian cập nhật gần nhất:** Tháng 10/2026  
> **Tài liệu tổng hợp:** Toàn bộ lịch sử các yêu cầu, phân tích kỹ thuật và giải pháp mã nguồn đã triển khai.

---

## 📑 MỤC LỤC
1. [Bảng tổng hợp nhanh các yêu cầu theo trình tự thời gian](#1-bảng-tổng-hợp-nhanh-các-yêu-cầu-theo-trình-tự-thời-gian)
2. [Chi tiết các giai đoạn thực hiện & Giải pháp kỹ thuật](#2-chi-tiết-các-giai-đoạn-thực-hiện--giải-pháp-kỹ-thuật)
   - [Giai đoạn 1: Tối ưu hiển thị Listview, Nút bấm & Quy tắc File upload](#giai-đoạn-1-tối-ưu-hiển-thị-listview-nút-bấm--quy-tắc-file-upload)
   - [Giai đoạn 2: Nâng cấp hệ thống thông báo Telegram đa nhóm & Auto-fallback Supergroup](#giai-đoạn-2-nâng-cấp-hệ-thống-thông-báo-telegram-đa-nhóm--auto-fallback-supergroup)
   - [Giai đoạn 3: Phân định quyền DUYỆT (APPROVE) & CHỈ XEM (VIEW) tại các Phòng ban](#giai-đoạn-3-phân-định-quyền-duyệt-approve--chỉ-xem-view-tại-các-phòng-ban)
   - [Giai đoạn 4: Cải tiến quy trình Tinh gọn (Lược bỏ khâu Admin phê duyệt)](#giai-đoạn-4-cải-tiến-quy-trình-tinh-gọn-lược-bỏ-khâu-admin-phê-duyệt)
   - [Giai đoạn 5: Phân luồng Telegram chuyên biệt cho nhóm Chỉ xem và nhóm Duyệt](#giai-đoạn-5-phân-luồng-telegram-chuyên-biệt-cho-nhóm-chỉ-xem-và-nhóm-duyệt)
   - [Giai đoạn 6: Tính năng đóng dấu mộc đỏ tự động "ĐÃ DUYỆT" khi tải file](#giai-đoạn-6-tính-năng-đóng-dấu-mộc-đỏ-tự-động-đã-duyệt-khi-tải-file)
   - [Giai đoạn 7: Tinh chỉnh trải nghiệm người dùng & Sửa lỗi lệch font tiếng Việt chữ DUYỆT](#giai-đoạn-7-tinh-chỉnh-trải-nghiệm-người-dùng--sửa-lỗi-lệch-font-tiếng-việt-chữ-duyệt)
3. [Danh mục tệp tin mã nguồn liên quan (File Mapping)](#3-danh-mục-tệp-tin-mã-nguồn-liên-quan-file-mapping)

---

## 1. BẢNG TỔNG HỢP NHANH CÁC YÊU CẦU THEO TRÌNH TỰ THỜI GIAN

| STT | Yêu cầu người dùng (User Request) | Phân hệ ảnh hưởng | Giải pháp & Kết quả triển khai |
| :---: | :--- | :--- | :--- |
| **01** | Lỗi select cột listview trong `ap_view_helper.php` | CMS Core / View Helper | Kiểm tra danh sách cột thực tế có dùng trong listview mới thực hiện select, tránh lỗi SQL thừa cột. |
| **02** | Format lại các nút bấm cho đồng bộ giao diện | CMS Listviews | Đồng bộ CSS, class, kích thước và màu sắc các nút thao tác (Thêm, Sửa, Xóa, Chi tiết). |
| **03** | Format nút cho `Do_cat_product_listview` | CMS Sản phẩm | Áp dụng chuẩn nút bấm đồng bộ sang module quản lý danh mục sản phẩm. |
| **04** | Upload file mẫu biểu trong `Do_doc_type`: giữ nguyên tên file gốc + `_nid` | CMS Loại hồ sơ | Thay đổi quy tắc sinh tên file upload biểu mẫu chuẩn: giữ tên file gốc + `_nid` thay vì đặt tên ngẫu nhiên `mau_...`. |
| **05** | Gửi cảnh báo Ticket vào Telegram Admin: tách chuỗi dấu `;` & thêm link CMS | Hệ thống Ticket / Telegram | Cho phép `cvalue` (config id=24) chứa nhiều ID nhóm Telegram phân cách bằng dấu `;`. Thêm link CMS trực tiếp đến ticket. |
| **06** | Phân quyền Duyệt & Chỉ xem tại các Phòng ban chuyên môn | Thẩm định song song / Portal | Phân biệt `APPROVE` và `VIEW`. Frontend `track.php` chỉ hiển thị tiến độ và chờ duyệt từ các phòng ban có quyền Duyệt, ẩn phòng ban Chỉ xem với khách. |
| **07** | Bỏ khâu Quản trị Admin phê duyệt hồ sơ | Workflow Engine | Khi tất cả phòng ban có thẩm quyền duyệt xong, hồ sơ tự động chuyển thẳng sang `COMPLETED`, ghi log và cấp kết quả cho khách ngay lập tức. |
| **08** | Khắc phục lỗi không nhận tin nhắn ở nhóm Telegram `-5466283560` | Telegram Helper | Xử lý cơ chế tự động chuyển đổi ID nhóm thường thành Supergroup (thêm `-100...`) và kiểm tra cờ config bật/tắt (nid=25). |
| **09** | Cập nhật hàm lõi Telegram hỗ trợ danh sách Chat ID phân cách bởi `;` | Module Helper / Object Helper | Nâng cấp hàm `send_telegram_core()` hỗ trợ gửi đệ quy qua nhiều Chat ID khi có dấu `;` hoặc `,` và tự động fallback `-100`. |
| **10** | Phân luồng Telegram: Nhóm Chỉ xem không nhận tin khi nộp, chỉ nhận tin khi Hoàn tất | Workflow Helper | Khi khách nộp hs: **KHÔNG** gửi Telegram cho phòng ban Chỉ xem (`VIEW`), chỉ gửi phòng ban Duyệt (`APPROVE`). Khi hồ sơ `COMPLETED`: mới gửi Telegram cho nhóm Chỉ xem. |
| **11** | Đóng dấu mộc đỏ chữ "ĐÃ DUYỆT" ở góc phải trên khi khách bấm "Tải hồ sơ đã xác nhận" | Client-side Engine / PDF-Lib | Tích hợp thư viện `pdf-lib` + Canvas tự động đóng dấu mộc đỏ chuyên nghiệp vào góc phải trên của file PDF/Ảnh ngay khi khách nhấn tải, kèm API ngầm lưu bản sao lên server. |
| **12** | Loại bỏ chữ "Đang đóng dấu mộc đỏ...", chỉ để icon xoay tự nhiên | UX / Portal Frontend | Đổi nút về trạng thái tự nhiên "Đang tải về..." kèm spinner, xóa bỏ câu ghi chú đóng dấu tự động để bảo mật quy trình nghiệp vụ nội bộ. |
| **13** | Nhích con dấu lên trên để không bị đè vào dòng chữ "CHỦ NGHĨA VIỆT NAM" | Tọa độ PDF / Canvas | Điều chỉnh `marginY` từ 22pt $\rightarrow$ 8pt (nhích lên ~8.5mm), thu gọn kích thước dấu (132pt x 50pt), giảm góc nghiêng từ -3° $\rightarrow$ -1.5°. |
| **14** | Sửa lỗi font chữ DUYỆT bị lệch nét ở chữ Ệ | Canvas Typography | Xóa bỏ `weight: 900` (nguyên nhân gây văng font Arial Black thiếu tiếng Việt), thay bằng `bold` (700) nguyên bản kèm stroke mảnh `0.5px`, giúp chữ **ĐÃ DUYỆT** đồng nhất và sắc nét 100%. |
| **15** | Hiển thị con dấu mộc đỏ "ĐÃ DUYỆT" trực tiếp trong CMS Admin `/do_dept_review/detail/` | CMS Thẩm định phòng ban | Tự động phát hiện hồ sơ hoàn tất (tất cả phòng có quyền duyệt đã Approved), nạp bản đóng dấu mộc đỏ vào iframe viewer, cập nhật nút tải file có dấu và tự động lưu `cfile_approved`. |
| **16** | Hiển thị tên nhân viên đã duyệt/từ chối phía dưới phòng ban trong Tiến Độ Các Phòng Ban | CMS Thẩm định phòng ban | Tránh đổ lỗi giữa các nhân sự: Hiển thị minh bạch Họ tên nhân viên (`cfullname`/`cuserid`) và thời gian duyệt ngay dưới tên phòng ban; sửa lỗi lấy đúng session user ID `session_nid_user` khi thao tác duyệt. |
| **17** | Gửi thông báo Telegram khi hoàn tất hồ sơ tới TẤT CẢ các phòng ban (cả phòng Duyệt và phòng Chỉ xem) | Workflow Helper / Telegram | Mở rộng hàm thông báo hoàn tất: Không chỉ gửi nhóm Chỉ xem mà gửi đồng loạt tới tất cả các phòng ban phụ trách hồ sơ (cả `APPROVE` và `VIEW`) cùng nhóm BQT Admin, đính kèm tệp đã đóng dấu mộc đỏ. |

---

## 2. CHI TIẾT CÁC GIAI ĐOẠN THỰC HIỆN & GIẢI PHÁP KỸ THUẬT

### Giai đoạn 1: Tối ưu hiển thị Listview, Nút bấm & Quy tắc File upload
* **Bối cảnh & Yêu cầu:**
  * Bên listview CMS bị lỗi câu lệnh query SQL thừa cột do hàm helper select tất cả các cột không cần thiết.
  * Các nút thao tác trên các màn hình quản trị chưa đồng bộ về màu sắc và icon.
  * Khi upload biểu mẫu hồ sơ chuẩn trong module `Do_doc_type`, hệ thống tự sinh tên file tiền tố `mau_..._...` làm mất tên gốc văn bản của Pico Plaza.
* **Giải pháp thực hiện:**
  * **`ap_view_helper.php`**: Kiểm tra mảng cột thực tế có hiển thị trong cấu hình listview trước khi ráp vào mệnh đề `SELECT` của Query Builder.
  * **`Do_cat_product_listview.php`** & các listview liên quan: Đồng bộ cấu trúc nút bấm theo chuẩn Flat UI Bootstrap hiện đại.
  * **`Do_doc_type.php`**: Viết lại hàm xử lý upload: lấy tên file gốc của người dùng tải lên, chuẩn hóa khoảng trắng/ký tự đặc biệt và nối thêm `_nid` phía sau (Ví dụ: `TH-HTKH.04 Giay de nghi van chuyen tai san_12.pdf`).

---

### Giai đoạn 8: Hiển thị đóng mộc "ĐÃ DUYỆT" trong Document Viewer của CMS Admin (`/do_dept_review/detail/`)
* **Bối cảnh & Yêu cầu:**
  * Trong CMS Admin, khi các phòng ban chuyên môn (hoặc phòng ban Chỉ xem) vào xem chi tiết hồ sơ thẩm định tại `/do_dept_review/detail/{submission_id}/{dept_id}`:
  * Nếu hồ sơ đã được duyệt hoàn tất (tất cả các phòng ban có quyền duyệt đã phê duyệt thông qua), trình xem tài liệu đính kèm (Document Viewer) và nút "Tải về máy" phải hiển thị tài liệu **đã được đóng con dấu mộc đỏ "ĐÃ DUYỆT"** ở góc trên bên phải giống hệt như phiên bản khách hàng tải về ở Frontend.
* **Nguyên nhân cốt lõi khiến con dấu chưa hiển thị trước đó:**
  * Biến `$is_completed` chỉ kiểm tra cứng `cstatus === 'COMPLETED'`. Tuy nhiên một số hồ sơ được duyệt trước đó hoặc do quy trình cũ còn kẹt ở trạng thái `IN_REVIEW` (do các phòng ban Chỉ xem chưa duyệt dẫn đến tổng số bước chưa đạt 100%), khiến hệ thống chưa gán `cstatus = 'COMPLETED'`. Do đó view không kích hoạt script đóng dấu và không hiển thị badge hoàn tất.
* **Giải pháp thực hiện:**
  1. **Nâng cấp cơ chế nhận diện hồ sơ Hoàn tất:**
     * Trong controller [`Do_dept_review.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/controllers/Do_dept_review.php) và view [`detail.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/views/do_dept_review/detail.php): Lọc riêng các bước thẩm định có quyền duyệt (`cpermission !== 'VIEW'`). Nếu tất cả các bước này đều đã `APPROVED` (và số lượng > 0), hồ sơ được xác định chắc chắn là **ĐÃ HOÀN TẤT THẨM ĐỊNH**.
     * Tự động đồng bộ cập nhật `cstatus = 'COMPLETED'` và `ddate_completed = NOW()` vào database, ghi log audit và gửi Telegram cho các phòng Chỉ xem (nếu chưa gửi).
     * Nâng cấp hàm `ensure_workflow_legacy_cleanup()` ở cả 2 helper [`admin/application/helpers/workflow_helper.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/helpers/workflow_helper.php) và [`application/helpers/workflow_helper.php`](file:///c:/xampp56/htdocs/picoplaza/application/helpers/workflow_helper.php) tự động quét và chuyển đổi toàn bộ hồ sơ dạng này.
  2. **Tích hợp Document Viewer đóng dấu mộc đỏ trong CMS Admin:**
     * Tích hợp thư viện `pdf-lib` vào view [`admin/application/views/do_dept_review/detail.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/views/do_dept_review/detail.php).
     * Đồng bộ 100% quy cách con dấu mộc đỏ chuẩn: kích thước `132pt x 50pt`, tọa độ cách mép phải `16pt`, cách mép trên `8pt`, góc nghiêng tự nhiên `-1.5°`, font chữ `bold 21px Arial, "Segoe UI", Tahoma, sans-serif` + stroke `0.5px` (đều nét không lỗi font tiếng Việt).
     * Tự động nạp `stampedBlobUrl` vào iframe viewer và gán nút "Tải về máy".
     * Khi đã có file đóng dấu lưu trên server (`cfile_approved`), viewer nạp trực tiếp file từ server mà không cần render lại.
  3. **Tự động lưu ngầm bản có dấu (`ajax_save_approved_file`):**
     * Khi client đóng dấu lần đầu, file có dấu tự động được POST ngầm về server, lưu vào `upload/documents/YYYYMM/approved_...` và cập nhật trường `cfile_approved` trong database.
  4. **Đồng bộ màn hình Quản trị Hồ sơ của Super Admin:**
     * Cập nhật [`admin/application/views/do_doc_submission/detail.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/views/do_doc_submission/detail.php): ưu tiên nạp file có dấu `cfile_approved` vào viewer và hiển thị badge "ĐÃ ĐÓNG DẤU MỘC ĐỎ".

---

## 3. DANH MỤC TỆP TIN MÃ NGUỒN LIÊN QUAN (FILE MAPPING)

| Đường dẫn tệp tin | Vai trò & Nội dung cập nhật |
| :--- | :--- |
| [`admin/application/views/do_dept_review/detail.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/views/do_dept_review/detail.php) | Màn hình chi tiết thẩm định phòng ban trong CMS Admin: Tích hợp `pdf-lib`, tự động đóng dấu mộc đỏ "ĐÃ DUYỆT" lên viewer và cập nhật nút tải file có dấu. |
| [`admin/application/controllers/Do_dept_review.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/controllers/Do_dept_review.php) | Controller thẩm định phòng ban: Tự động chuyển đổi `COMPLETED` khi các phòng ban có quyền duyệt đã thông qua; thêm endpoint `ajax_save_approved_file` lưu bản có dấu. |
| [`admin/application/views/do_doc_submission/detail.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/views/do_doc_submission/detail.php) | Màn hình chi tiết hồ sơ Super Admin: Tự động ưu tiên hiển thị file đã có dấu mộc đỏ `cfile_approved`. |
| [`application/views/doc_portal/track.php`](file:///c:/xampp56/htdocs/picoplaza/application/views/doc_portal/track.php) | Màn hình theo dõi hồ sơ Frontend: Tích hợp `pdf-lib`, vẽ con dấu Canvas, xử lý nút bấm tải về, tọa độ và font chữ con dấu mộc đỏ. |
| [`application/controllers/Doc_portal.php`](file:///c:/xampp56/htdocs/picoplaza/application/controllers/Doc_portal.php) | Controller Cổng hồ sơ: Bổ sung endpoint `ajax_save_approved_file` để lưu trữ bản có dấu vào database `cfile_approved`. |
| [`admin/application/helpers/workflow_helper.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/helpers/workflow_helper.php) | Engine quy trình CMS Backend: Bổ sung cơ chế auto-cleanup quét các hồ sơ có các phòng cần duyệt đã thông qua để chuyển sang `COMPLETED`. |
| [`application/helpers/workflow_helper.php`](file:///c:/xampp56/htdocs/picoplaza/application/helpers/workflow_helper.php) | Engine quy trình Frontend: Đồng bộ hàm `ensure_workflow_legacy_cleanup()`. |

---

### Giai đoạn 2: Nâng cấp hệ thống thông báo Telegram đa nhóm & Auto-fallback Supergroup
* **Bối cảnh & Yêu cầu:**
  * Quản trị viên cần gửi cảnh báo ticket/hồ sơ đồng thời vào nhiều nhóm Telegram khác nhau bằng cách cấu hình chuỗi ID phân cách bởi dấu chấm phẩy `;`.
  * Có trường hợp cấu hình nhóm `-5466283560` nhưng bot không gửi được tin nhắn do Telegram tự động nâng cấp nhóm thường thành Supergroup khi thêm Bot làm Quản trị viên.
* **Giải pháp thực hiện:**
  * Cập nhật hàm `send_telegram_core($chat_id, $message_text)` trong cả [`ap_module_helper.php`](file:///c:/xampp56/htdocs/picoplaza/application/helpers/ap_module_helper.php) và [`ap_object_helper.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/helpers/ap_object_helper.php):
    1. **Tách đa nhóm:** Tự động phát hiện dấu `;` hoặc `,` trong `$chat_id`, tách thành mảng và gửi lần lượt đến từng nhóm, có mảng `$sent_ids` ngăn trùng lặp.
    2. **Auto-fallback Supergroup:** Nếu Telegram trả về mã lỗi 400 kèm phản hồi `group chat was upgraded to a supergroup` và `parameters.migrate_to_chat_id`, hàm sẽ tự động lấy ID mới (dạng `-100...`) và gửi lại ngay lập tức. Nếu ID ban đầu có độ dài 10 số (như `-5466283560`), hàm tự động thử nghiệm thêm tiền tố `-100` (`-1005466283560`).
    3. **Tối ưu tốc độ:** Ép cURL sử dụng IPv4 (`CURLOPT_IPRESOLVE_V4`) và DNS cache timeout 600s, giúp tốc độ phản hồi Telegram chỉ mất ~0.02s.

---

### Giai đoạn 3: Phân định quyền DUYỆT (APPROVE) & CHỈ XEM (VIEW) tại các Phòng ban
* **Bối cảnh & Yêu cầu:**
  * Một loại hồ sơ có thể liên quan đến nhiều phòng ban: Có phòng ban bắt buộc phải thẩm định phê duyệt chuyên môn (như Kỹ thuật, Kinh doanh), nhưng có phòng ban chỉ cần nắm bắt thông tin để phối hợp tác nghiệp (như An ninh, Ban Quản Lý).
  * Trước đây, trên màn hình theo dõi tiến độ của khách hàng (`doc_portal/track`), cả phòng ban Chỉ xem cũng hiện trạng thái *"Đang chờ duyệt"*, làm khách hàng hiểu lầm hồ sơ bị tắc nghẽn ở các phòng này.
* **Giải pháp thực hiện:**
  * **Cơ sở dữ liệu:** Cột `cpermission` trong bảng `picoplaza_tdoc_approval_step` lưu giá trị `APPROVE` hoặc `VIEW`.
  * **Phía Khách hàng (`doc_portal/track.php`):**
    * Ma trận *"Tiến Độ Thẩm Định Tại Các Phòng Ban Chuyên Môn"* chỉ lọc ra các bước có `cpermission = 'APPROVE'`.
    * Các phòng ban `VIEW` được ẩn khỏi giao diện khách hàng, tránh gây hiểu nhầm.
  * **Phía CMS Quản trị (`detail.php`):**
    * Gắn nhãn badge xám `Chỉ xem` / `THEO DÕI` cho phòng ban có quyền VIEW.
    * Nhân viên thuộc phòng ban VIEW bị khóa nút Duyệt/Từ chối (kiểm tra chặt chẽ cả trên giao diện lẫn trong hàm xử lý `workflow_dept_review`).

---

### Giai đoạn 4: Cải tiến quy trình Tinh gọn (Lược bỏ khâu Admin phê duyệt)
* **Bối cảnh & Yêu cầu:**
  * Khách hàng muốn tinh giản quy trình: Không cần cấp Quản trị (Admin) phải bấm duyệt thủ công một lần nữa sau khi các phòng ban đã thẩm định.
  * Chỉ cần tất cả các phòng ban có thẩm quyền duyệt (`cpermission = 'APPROVE'`) thông qua là hồ sơ tự động hoàn tất.
* **Giải pháp thực hiện:**
  * Trong hàm `workflow_dept_review()` của cả 2 helper:
    1. Sau khi một phòng ban duyệt `APPROVED`, hệ thống truy vấn các bước có quyền duyệt:
       ```sql
       SELECT * FROM picoplaza_tdoc_approval_step 
       WHERE nid_submission = ? AND (cpermission = 'APPROVE' OR cpermission IS NULL OR cpermission = '')
       ```
    2. Nếu toàn bộ các bước này đều đã `APPROVED`:
       * Chuyển trạng thái hồ sơ thẳng sang **`COMPLETED`** (bỏ qua `WAITING_ADMIN`).
       * Cập nhật `ddate_completed = NOW()`.
       * Ghi log kiểm toán `TRANSITION_COMPLETED`.
       * Gửi email hoàn tất cho khách hàng kèm link xem kết quả.
       * Bắn thông báo Telegram cho Ban Quản trị thông báo hồ sơ đã tự động hoàn tất.
  * Cập nhật quy trình chuẩn vào tài liệu dự án [`picosaigon.md`](file:///c:/xampp56/htdocs/picoplaza/picosaigon.md).

---

### Giai đoạn 5: Phân luồng Telegram chuyên biệt cho nhóm Chỉ xem và nhóm Duyệt
* **Bối cảnh & Yêu cầu:**
  * **Khi khách nộp hồ sơ mới:** KHÔNG gửi thông báo Telegram đến các nhóm phòng ban Chỉ xem (`VIEW`) để tránh gây loãng thông tin, CHỈ gửi tới các phòng ban có quyền Duyệt (`APPROVE`) và Admin.
  * **Khi hồ sơ đã hoàn tất thông qua (`COMPLETED`):** Hệ thống mới tự động gửi thông báo Telegram đến các nhóm phòng ban Chỉ xem (`VIEW`) để họ nắm thông tin phối hợp.
* **Giải pháp thực hiện:**
  * **Khi tiếp nhận (`workflow_notify_new_submission`):**
    * Lặp qua danh sách bước thẩm định, kiểm tra: `if ($perm === 'VIEW') continue;` $\rightarrow$ Bỏ qua không gửi Telegram cho nhóm Chỉ xem.
  * **Khi hoàn tất (`workflow_notify_view_depts_completed`):**
    * Viết hàm mới truy vấn tất cả phòng ban có `cpermission = 'VIEW'` của hồ sơ đó.
    * Soạn tin nhắn Telegram chính thức:
      > 📢 **[HỒ SƠ ĐÃ ĐƯỢC DUYỆT THÔNG QUA — {TÊN PHÒNG BAN}]**  
      > 🏷️ **Mã hồ sơ:** #HS-xxxxxx  
      > 📄 **Loại hồ sơ:** ...  
      > 👤 **Người nộp:** ...  
      > ✅ **Trạng thái:** ĐÃ HOÀN TẤT THẨM ĐỊNH (CÁC PHÒNG BAN PHỤ TRÁCH ĐÃ THÔNG QUA)  
      > 📎 **Tệp đính kèm:** Link tệp hồ sơ  
      > 👉 *Vui lòng đăng nhập CMS tại đây để theo dõi hồ sơ.*
    * Kích hoạt tự động khi:
      1. Phòng ban cuối cùng duyệt xong $\rightarrow$ `COMPLETED`.
      2. Admin thực hiện cưỡng chế `FORCE_APPROVE` $\rightarrow$ `COMPLETED`.
      3. Admin duyệt tay `ADMIN_APPROVE` (nếu có).

---

### Giai đoạn 6: Tính năng đóng dấu mộc đỏ tự động "ĐÃ DUYỆT" khi tải file
* **Bối cảnh & Yêu cầu:**
  * Khi hồ sơ đã hoàn tất thông qua, khách hàng nhấn nút **"TẢI HỒ SƠ ĐÃ XÁC NHẬN"** thì file tải về phải có con dấu đỏ chữ **"ĐÃ DUYỆT"** đóng ở góc trên bên phải trang đầu tiên (như ảnh khoanh tròn người dùng cung cấp).
* **Giải pháp kỹ thuật (Client-side Dynamic PDF Stamping):**
  * **Tại sao không dùng PHP trên server:** Môi trường PHP 5.6 XAMPP không có ImageMagick/Ghostscript; thư viện FPDI thuần của PHP gặp lỗi khi xử lý file scan PDF chuẩn 1.5+ có nén Object Streams.
  * **Giải pháp triển khai:**
    1. Tích hợp thư viện **`pdf-lib` (v1.17.1)** chạy trực tiếp trên trình duyệt của khách hàng.
    2. Dùng **HTML5 Canvas** độ phân giải cao 2x (300 DPI) để vẽ con dấu mộc đỏ:
       * Khung viền đôi đỏ (`#c5221f`), bo góc, nền đỏ mờ thẩm thấu nhẹ (`rgba(254, 242, 242, 0.55)`).
       * Tiêu đề: `BAN QUẢN LÝ PICO PLAZA`.
       * Nội dung chính: `★ ĐÃ DUYỆT ★`.
       * Dòng phụ: Mã hồ sơ và ngày hoàn tất thẩm định.
    3. Đóng dấu lên file:
       * **Với PDF:** Nạp trang đầu tiên, vẽ con dấu lên góc trên bên phải (Top-Right), xoay nghiêng nhẹ tạo hiệu ứng đóng dấu thực tế. Tự động hỗ trợ các trang PDF bị xoay (0°, 90°, 180°, 270°).
       * **Với Ảnh (JPG/PNG):** Dùng Canvas vẽ đè con dấu lên góc trên bên phải ảnh gốc.
    4. Kích hoạt tải file về máy khách với tên: `Ho_so_xac_nhan_{Mã_hồ_sơ}.pdf`.
    5. **Tự động lưu ngầm lên Server:** Tạo API `doc_portal/ajax_save_approved_file` trong [`Doc_portal.php`](file:///c:/xampp56/htdocs/picoplaza/application/controllers/Doc_portal.php), gửi file đã đóng dấu lưu vào `upload/documents/YYYYMM/approved_...` và cập nhật cột `cfile_approved` trong database.

---

### Giai đoạn 7: Tinh chỉnh trải nghiệm người dùng & Sửa lỗi lệch font tiếng Việt chữ DUYỆT
* **Bối cảnh & Yêu cầu:**
  1. Trạng thái nút bấm trước đó hiện chữ *"Đang đóng dấu mộc đỏ..."* và câu chú thích bên dưới khiến khách hàng nghĩ là AI tự động đóng mộc, thiếu tính bảo mật nghiệp vụ.
  2. Vị trí con dấu bị đè lên dòng tiêu đề *"CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM"*.
  3. Font chữ của từ **"DUYỆT"** bị lỗi: chữ D, U, Y, T thì siêu đậm còn riêng chữ **Ệ** lại bị mỏng dính và lệch nét.
* **Giải pháp khắc phục:**
  1. **Ẩn hoàn toàn dấu vết tự động:**
     * Nút bấm chỉ hiển thị icon xoay kèm chữ tự nhiên: `Đang tải về...` $\rightarrow$ `Đã tải về thành công!`.
     * Xóa bỏ hoàn toàn câu ghi chú dưới nút bấm.
  2. **Tinh chỉnh tọa độ con dấu (Shift Up & Right):**
     * Giảm `marginY` từ `22pt` xuống `8pt` (nhích toàn bộ con dấu lên phía trên khoảng **8.5mm** lọt vào khoảng trắng lề trên của trang).
     * Thu gọn kích thước con dấu từ `142pt x 60pt` thành `132pt x 50pt`, giúp đáy con dấu co lên cao, hoàn toàn không chạm vào dòng chữ quốc hiệu.
     * Giảm độ nghiêng từ `-3°` thành `-1.5°` để góc trái không bị chúc xuống tiêu đề.
  3. **Khắc phục lỗi font chữ Ệ:**
     * *Nguyên nhân:* Canvas sử dụng thuộc tính `weight: 900` (`Black/Heavy`). Trên Windows, font Arial Black không chứa ký tự tiếng Việt mở rộng `Ệ` (U+1EC6), khiến trình duyệt gọi font Arial Black cho D, U, Y, T và fallback sang Arial thường cho chữ `Ệ`.
     * *Khắc phục:* Chuyển về font chuẩn `bold` (700) nguyên bản: `font = 'bold 21px Arial, "Segoe UI", Tahoma, sans-serif'`. Cả Arial Bold, Segoe UI Bold và Tahoma Bold đều có sẵn ký tự `Ệ` chuẩn với độ dày nét đồng nhất 100%. Bổ sung thêm nét viền mảnh `0.5px` (`ctx.strokeText`) giúp chữ đậm đà chắc nét đúng chất con dấu mực mà hoàn toàn không bị vỡ font.

---

### Giai đoạn 9: Hiển thị tên nhân viên đã duyệt/từ chối trong bảng Tiến Độ Các Phòng Ban
* **Bối cảnh & Yêu cầu:**
  * Để tránh việc các nhân sự đùn đẩy trách nhiệm hoặc đổ lỗi cho nhau khi xử lý hồ sơ thẩm định.
  * Cần hiển thị minh bạch danh tính nhân viên nào (`cfullname` / `cuserid`) đã thực hiện phê duyệt hoặc từ chối tại mỗi phòng ban, kèm thời gian thao tác cụ thể ngay phía dưới tên phòng ban trong box **"Tiến Độ Các Phòng Ban"**.
* **Giải pháp thực hiện:**
  1. **Sửa lỗi lưu ID nhân viên đăng nhập khi duyệt:**
     * Trước đó tại [`Do_dept_review.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/controllers/Do_dept_review.php) hàm `process_action()` kiểm tra biến `$_SESSION['session_user_id']` (không tồn tại trong hệ thống CMS này vì CMS Pico Plaza sử dụng `session_nid_user`), dẫn đến ID người duyệt luôn bị gán mặc định là 1 (`Admin`).
     * Đã sửa lại lấy đúng `Fget_userdata('session_nid_user')`, đảm bảo lưu chính xác ID tài khoản nhân viên đang thao tác vào cột `nid_staff_user` của `picoplaza_tdoc_approval_step`.
  2. **Truy vấn thông tin nhân viên:**
     * Nâng cấp hàm `get_doc_approval_steps()` trong cả 2 helper: JOIN với `picoplaza_tuser` để lấy `u.cfullname as staff_name` và `u.cuserid as staff_username`.
  3. **Hiển thị giao diện trực quan:**
     * Tại [`admin/application/views/do_dept_review/detail.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/views/do_dept_review/detail.php) và [`admin/application/views/do_doc_submission/detail.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/views/do_doc_submission/detail.php):
       * Khi đã duyệt: `<i class="fa fa-user"></i> Người duyệt: [Tên nhân viên] • [dd/mm/YYYY HH:ii]`
       * Khi từ chối: `<i class="fa fa-user"></i> Từ chối bởi: [Tên nhân viên] • [dd/mm/YYYY HH:ii]` kèm lý do.
       * Khi chỉ xem: `<i class="fa fa-eye"></i> Chỉ theo dõi tiến độ`.
       * Khi đang chờ: `<i class="fa fa-clock-o"></i> Đang chờ phòng ban thẩm định`.

---

### Giai đoạn 10: Gửi thông báo Telegram khi hoàn tất tới TẤT CẢ các phòng ban (Duyệt & Chỉ xem)
* **Bối cảnh & Yêu cầu:**
  * Trước đó khi hồ sơ hoàn tất phê duyệt, hệ thống chỉ gửi Telegram tới các nhóm phòng ban Chỉ xem (`VIEW`) và nhóm BQT Admin (`config id=24`), không gửi tới các phòng ban có quyền Duyệt (`APPROVE`).
  * Thực tế tác nghiệp: Sau khi các phòng ban có quyền duyệt (như M&E, Admin Dept) đã duyệt xong phần việc của mình, họ cũng cần nhận được thông báo khi toàn bộ quy trình hoàn tất để nắm bắt kết quả cuối cùng và phối hợp thực hiện.
* **Giải pháp thực hiện:**
  * Nâng cấp hàm `workflow_notify_all_depts_completed($submission_id)` trong cả 2 helper [`admin/application/helpers/workflow_helper.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/helpers/workflow_helper.php) và [`application/helpers/workflow_helper.php`](file:///c:/xampp56/htdocs/picoplaza/application/helpers/workflow_helper.php):
    1. Bỏ điều kiện lọc `cpermission = 'VIEW'`, mở rộng truy vấn tất cả các phòng ban tham gia thẩm định của hồ sơ đó (cả `APPROVE` và `VIEW`).
    2. Tự động phân tách đa nhóm Telegram nếu cột `ctelegram_group_id` chứa nhiều ID cách nhau bởi dấu `;`.
    3. Sử dụng mảng `$sent_groups` chống gửi trùng lặp nếu nhiều phòng ban dùng chung 1 nhóm Telegram.
    4. Ưu tiên đính kèm đường dẫn xem tệp hồ sơ đã đóng dấu mộc đỏ `cfile_approved`.
    5. Giữ nguyên hàm `workflow_notify_view_depts_completed()` ủy quyền sang hàm mới để đảm bảo tương thích 100% toàn hệ thống.

---

### Giai đoạn 11: Tinh gọn nút Xem Hồ Sơ & Thêm chức năng xóa hồ sơ khỏi CSDL (Dành riêng duy nhất Admin ID #1)
* **Bối cảnh & Yêu cầu:**
  * Trong danh sách hồ sơ `do_dept_review_listview` (và `do_dept_view_listview`), nút "Xem Hồ Sơ" cần được tối giản giao diện, chỉ hiển thị icon cây bút edit (`<i class="fa fa-pencil"></i>`).
  * Bổ sung nút xóa hồ sơ khỏi CSDL nằm ngay kế bên nút xem, có biểu tượng thùng rác màu đỏ (`<i class="fa fa-trash"></i>`).
  * **Ràng buộc bảo mật tối cao:** Chỉ duy nhất **1 tài khoản Admin gốc có `nid = 1`** mới được phép xóa hồ sơ khỏi CSDL. Tất cả các tài khoản khác dù có gán vai trò (`crole`) là `admin` hay bất kỳ quyền hạn nào cũng KHÔNG được phép xóa (ẩn nút xóa trên giao diện và chặn tuyệt đối trong controller).
* **Giải pháp thực hiện:**
  1. **Giao diện Danh sách (`admin/application/views/do_dept_review/list.php`):**
     * Nút Xem & Thẩm định được rút gọn thành icon cây bút edit `<i class="fa fa-pencil"></i>`, bỏ chữ dư thừa để giao diện bảng gọn gàng.
     * Kiểm tra điều kiện ID tài khoản đăng nhập: `(int)Fget_userdata('session_nid_user') === 1`. Chỉ duy nhất tài khoản `nid = 1` mới nhìn thấy nút xóa màu đỏ `<a class="btn btn-danger btn-xs ..."><i class="fa fa-trash"></i></a>`.
     * Thêm cảnh báo xác nhận JavaScript: `confirm(...)` cảnh báo xóa vĩnh viễn trước khi kích hoạt.
     * Bổ sung khối hiển thị thông báo trạng thái `flash_success` / `flash_error` trên đầu danh sách giúp quản trị viên nắm rõ kết quả sau thao tác.
  2. **Controller xử lý (`Do_dept_review_listview.php` & `Do_dept_view_listview.php`):**
     * Viết hàm `delete_submission($submission_id)`:
       * Kiểm tra nghiêm ngặt `(int)Fget_userdata('session_nid_user') === 1`, nếu không phải tài khoản `nid = 1` sẽ từ chối ngay lập tức kèm thông báo lỗi.
       * Dọn sạch file vật lý đính kèm (`cfile_path` và `cfile_approved`) trên máy chủ bằng `unlink()`.
       * Xóa sạch toàn bộ dữ liệu hồ sơ liên quan trong 4 bảng: `picoplaza_tdoc_notification`, `picoplaza_tdoc_log`, `picoplaza_tdoc_approval_step`, `picoplaza_tdoc_submission`.
       * Chuyển hướng quay trở lại đúng trang listview trước đó kèm thông báo thành công.

---

## 3. DANH MỤC TỆP TIN MÃ NGUỒN LIÊN QUAN (FILE MAPPING)

| Đường dẫn tệp tin | Vai trò & Nội dung cập nhật |
| :--- | :--- |
| [`admin/application/views/do_dept_review/list.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/views/do_dept_review/list.php) | Giao diện danh sách hồ sơ: Rút gọn nút Xem thành icon cây bút edit, thêm nút xóa thùng rác đỏ chỉ dành cho Admin, thêm thông báo flash. |
| [`admin/application/controllers/Do_dept_review_listview.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/controllers/Do_dept_review_listview.php) | Controller Cổng thẩm định: Bổ sung method `delete_submission()` kiểm tra quyền admin, xóa sạch CSDL và dọn file vật lý. |
| [`admin/application/controllers/Do_dept_view_listview.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/controllers/Do_dept_view_listview.php) | Controller Danh sách hồ sơ chỉ xem: Bổ sung method `delete_submission()` tương tự. |
| [`application/views/doc_portal/track.php`](file:///c:/xampp56/htdocs/picoplaza/application/views/doc_portal/track.php) | Màn hình theo dõi hồ sơ: Tích hợp `pdf-lib`, vẽ con dấu Canvas, xử lý nút bấm tải về, tọa độ và font chữ con dấu mộc đỏ. |
| [`application/controllers/Doc_portal.php`](file:///c:/xampp56/htdocs/picoplaza/application/controllers/Doc_portal.php) | Controller Cổng hồ sơ: Bổ sung endpoint `ajax_save_approved_file` để lưu trữ bản có dấu vào database `cfile_approved`. |
| [`application/helpers/workflow_helper.php`](file:///c:/xampp56/htdocs/picoplaza/application/helpers/workflow_helper.php) | Engine quy trình Frontend: Bỏ khâu Admin duyệt, lọc nhóm Telegram Chỉ xem khi nộp, thêm hàm `workflow_notify_view_depts_completed()`. |
| [`admin/application/helpers/workflow_helper.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/helpers/workflow_helper.php) | Engine quy trình CMS Backend: Đồng bộ toàn bộ logic phân luồng, quyền VIEW/APPROVE và thông báo Telegram với Frontend. |
| [`application/helpers/ap_module_helper.php`](file:///c:/xampp56/htdocs/picoplaza/application/helpers/ap_module_helper.php) | Helper lõi Frontend: Hàm `send_telegram_core()` hỗ trợ đa nhóm dấu `;`, auto-fallback `-100...` Supergroup. |
| [`admin/application/helpers/ap_object_helper.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/helpers/ap_object_helper.php) | Helper lõi Backend CMS: Đồng bộ hàm `send_telegram_core()`. |
| [`admin/application/controllers/Do_doc_type.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/controllers/Do_doc_type.php) | Quản trị loại hồ sơ: Tối ưu quy tắc đặt tên file mẫu upload: giữ nguyên tên gốc + `_nid`. |
| [`admin/application/helpers/ap_view_helper.php`](file:///c:/xampp56/htdocs/picoplaza/admin/application/helpers/ap_view_helper.php) | Helper CMS Listview: Tối ưu mệnh đề SELECT chỉ chọn cột thực tế có dùng. |
| [`picosaigon.md`](file:///c:/xampp56/htdocs/picoplaza/picosaigon.md) | Tài liệu kiến trúc dự án: Cập nhật quy trình 3 bước mới, quyền VIEW/APPROVE và tính năng đóng dấu mộc đỏ tự động. |
