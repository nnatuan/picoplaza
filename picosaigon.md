# **TÀI LIỆU KỸ THUẬT & HƯỚNG DẪN HỆ THỐNG CỔNG THẨM ĐỊNH & PHÊ DUYỆT HỒ SƠ ĐA PHÒNG BAN (PICO SAIGON / PICOPLAZA)**

---

## **1. TỔNG QUAN HỆ THỐNG**

Hệ thống **Cổng Dịch Vụ & Tiếp Nhận, Thẩm Định, Phê Duyệt Hồ Sơ Trực Tuyến** được phát triển theo đặc tả trong tài liệu [Dexuat.pdf](file:///c:/xampp56/htdocs/picoplaza/Dexuat.pdf), hoạt động trên nền tảng **CodeIgniter Framework (PHP/MySQL)** với tiền tố bảng **`picoplaza_`**.

Hệ thống kế thừa toàn bộ hạ tầng bảo mật, helpers, cơ chế bắn thông báo khẩn qua **Telegram Bot** và **Mailjet REST API v3.1** từ dự án Pico Plaza, đồng thời được tách biệt mã nguồn thành các module độc lập.

```mermaid
flowchart TD
    A[Khách hàng] -->|1. Tải mẫu PDF & Ký thủ công| B[Scan / Chụp ảnh Upload]
    B -->|2. Nộp hồ sơ| C{Dynamic Routing Engine}
    
    subgraph ParallelReview [Thẩm định song song tại các phòng ban phụ trách]
        C -->|Phân luồng| D1[Phòng Kinh Doanh]
        C -->|Phân luồng| D2[Phòng Kỹ Thuật]
        C -->|Phân luồng| D3[Phòng Kế Toán / BQL]
        
        D1 -->|Reject| RJ[Trạng thái REJECTED + Lý do]
        D2 -->|Reject| RJ
        D3 -->|Reject| RJ
        
        D1 -->|Approve| AP1[Xác nhận KD]
        D2 -->|Approve| AP2[Xác nhận KT]
        D3 -->|Approve| AP3[Xác nhận BQL]
    end
    
    AP1 & AP2 & AP3 -->|Tất cả phòng ban duyệt thông qua| CP[Trạng thái: COMPLETED - Hoàn Tất Hồ Sơ]
    
    subgraph EmergencyOverride [Cơ chế Can thiệp Khẩn cấp Admin]
        AO{Admin Override}
        AO -.->|Force Approve| CP
        AO -.->|Force Reject| RJ
    end
    
    CP -->|Mở quyền tải| OUT[Tải văn bản chính thức có dấu 'Đã xác nhận']
    RJ -->|Báo lỗi & sửa lại| A
```

---

## **2. CẤU TRÚC CƠ SỞ DỮ LIỆU (DATABASE SCHEMA)**

Script nạp CSDL hoàn chỉnh được lưu tại: **[picoplaza_workflow.sql](file:///c:/xampp56/htdocs/picoplaza/picoplaza_workflow.sql)**

### **2.1. Bảng `picoplaza_tdepartment` (Danh mục phòng ban)**
* Quản lý các phòng ban tham gia thẩm định chuyên môn:
  * `DEPT_KD`: Phòng Kinh Doanh (Thẩm định giá thuê, hợp đồng).
  * `DEPT_KT`: Phòng Kỹ Thuật (Thẩm định bản vẽ thi công, an toàn PCCC, kết cấu điện nước).
  * `DEPT_KTPL`: Phòng Kế Toán & Pháp Lý (Thẩm định tư cách pháp nhân, tài chính).
  * `DEPT_BQL`: Ban Quản Lý Tòa Nhà (Thẩm định an ninh, vệ sinh, phương án ra vào).

### **2.2. Bảng `picoplaza_tdoc_type` (Cấu hình loại hồ sơ & Luồng duyệt)**
* Quản lý biểu mẫu chuẩn và danh sách phòng ban:
  * `cdepts_required`: Danh sách phòng ban có thẩm quyền **DUYỆT** (`cpermission = 'APPROVE'`).
  * `cdepts_view`: Danh sách phòng ban **CHỈ XEM** (`cpermission = 'VIEW'`) để nắm bắt thông tin, phối hợp tác nghiệp.

### **2.3. Bảng `picoplaza_tdoc_submission` (Hồ sơ khách hàng nộp)**
* Chứa toàn bộ thông tin hồ sơ:
  * `ccode`: Mã định danh hồ sơ (`HS-YYYYMM-XXXX`).
  * `cstatus`: `INIT` $\rightarrow$ `IN_REVIEW` $\rightarrow$ `COMPLETED` / `REJECTED`.
  * `cfile_path`: Tệp scan/ảnh hồ sơ gốc khách hàng nộp.
  * `cfile_approved`: Tệp văn bản chính thức đã xác nhận cấp quyền cho khách hàng tải về.
  * `is_override`: Đánh dấu hồ sơ có sự can thiệp Admin Override.
  * `cadmin_note`: Ghi chú can thiệp của Quản trị viên.

### **2.4. Bảng `picoplaza_tdoc_approval_step` (Vết duyệt của từng phòng ban)**
* Lưu trạng thái thẩm định độc lập của từng phòng ban: `PENDING`, `APPROVED`, `REJECTED` kèm phân quyền `cpermission` (`APPROVE` / `VIEW`), lý do `creason_note` và thời gian thao tác.

### **2.5. Bảng `picoplaza_tdoc_log` (Nhật ký kiểm toán / Audit Trail)**
* Ghi lại lịch sử chi tiết mọi thao tác (Ai thao tác, IP nào, đổi trạng thái gì, nội dung ghi chú).

---

## **3. QUY TRÌNH 3 BƯỚC TINH GỌN & WORKFLOW ENGINE**

> [!NOTE]
> **Cập nhật quy trình mới theo yêu cầu khách hàng:** Lược bỏ hoàn toàn khâu Admin phê duyệt hồ sơ. Chỉ cần các phòng ban phụ trách có thẩm quyền phê duyệt thẩm định thông qua, hồ sơ tự động được chuyển sang trạng thái **`COMPLETED`** và cấp chứng nhận/văn bản xác nhận cho khách hàng.

### **Bước 1: Khởi tạo & Upload**
* Khách hàng truy cập `/portal-tham-dinh` $\rightarrow$ Tải mẫu PDF chuẩn $\rightarrow$ Ký xác nhận $\rightarrow$ Scan/Chụp ảnh tải lên hệ thống.
* Trạng thái hồ sơ chuyển sang **`IN_REVIEW`**.

### **Bước 2: Thẩm định song song tại các phòng ban phụ trách (Parallel Review)**
* Hệ thống tự động phân phối hồ sơ đến Cổng thẩm định của các phòng ban được chỉ định (`/admin/do_dept_review_listview`).
* **Quy tắc duyệt độc lập**:
  1. **Nếu 1 phòng ban Từ chối (Reject)**: Bắt buộc nhập lý do $\rightarrow$ Toàn bộ hồ sơ ngay lập tức chuyển sang **`REJECTED`** $\rightarrow$ Hệ thống tự động gửi email thông báo chi tiết lý do cho khách hàng.
  2. **Nếu tất cả các phòng ban có quyền duyệt (Approve) đã thông qua**: Hệ thống **tự động hoàn tất hồ sơ ngay lập tức** $\rightarrow$ Trạng thái chuyển thẳng sang **`COMPLETED`** $\rightarrow$ Gửi email thông báo hoàn tất cho khách hàng và bắn thông báo xác nhận lên Telegram Bot của Ban Quản Trị.
  3. **Phòng ban chỉ xem (VIEW)**: Có thể truy cập xem nội dung hồ sơ và tiến độ thẩm định của các đơn vị khác, nhưng không can thiệp vào kết quả duyệt.

### **Bước 3: Hoàn tất & Trả kết quả (Cấp văn bản xác nhận)**
* Hồ sơ đạt trạng thái **`COMPLETED`**.
* Khách hàng tra cứu tại `/portal-tham-dinh/theo-doi/:code`: Hiển thị Stepper hoàn tất 3 bước, mở nút tải văn bản chính thức với ghi chú *"Đã thông qua thẩm định"* kèm tệp đính kèm.

---

## **4. CƠ CHẾ QUẢN TRỊ & CAN THIỆP ĐẶC BIỆT (ADMIN OVERRIDE)**

Quản trị viên (Admin) được trang bị quyền can thiệp cưỡng chế trong các tình huống khẩn cấp:

1. **`Force Approve`**:
   * Phê duyệt nhanh, bỏ qua các bước xét duyệt còn lại của các phòng ban chưa kịp duyệt.
   * Tự động đánh dấu hoàn tất toàn bộ các bước và chuyển hồ sơ sang `COMPLETED`.
2. **`Force Reject`**:
   * Hủy / Dừng xử lý hồ sơ lập tức ở bất kỳ giai đoạn nào.
3. **Ràng buộc kiểm soát & An toàn dữ liệu**:
   * Bắt buộc phải nhập **`Admin Note`** nêu rõ lý do can thiệp.
   * Hệ thống tự động gắn nhãn `OVERRIDE` và ghi log chi tiết vào bảng kiểm toán `picoplaza_tdoc_log`.

---

## **5. DANH MỤC FILE & CÁC THÀNH PHẦN MÃ NGUỒN ĐÃ TRIỂN KHAI**

### **5.1. Database**
* [picoplaza_workflow.sql](file:///c:/xampp56/htdocs/picoplaza/picoplaza_workflow.sql): CSDL bảng biểu luồng thẩm định.

### **5.2. Core Helper & Workflow Engine**
* [application/helpers/workflow_helper.php](file:///c:/xampp56/htdocs/picoplaza/application/helpers/workflow_helper.php): Động cơ phân luồng, duyệt song song, admin override, audit log, bắn Telegram và Mailjet.
* [admin/application/helpers/workflow_helper.php](file:///c:/xampp56/htdocs/picoplaza/admin/application/helpers/workflow_helper.php): Helper phía CMS.

### **5.3. Phân hệ Khách hàng (Frontend)**
* [Doc_portal.php](file:///c:/xampp56/htdocs/picoplaza/application/controllers/Doc_portal.php): Controller chính phía Frontend.
* [doc_portal/index.php](file:///c:/xampp56/htdocs/picoplaza/application/views/doc_portal/index.php): Cổng danh mục biểu mẫu & tra cứu.
* [doc_portal/submit.php](file:///c:/xampp56/htdocs/picoplaza/application/views/doc_portal/submit.php): Form nộp hồ sơ & upload file an toàn.
* [doc_portal/track.php](file:///c:/xampp56/htdocs/picoplaza/application/views/doc_portal/track.php): Dòng thời gian tiến độ, ma trận phòng ban, tải văn bản chính thức.

### **5.4. Phân hệ Thẩm định Phòng ban & Admin (Backend CMS)**
* [Do_dept_review_listview.php](file:///c:/xampp56/htdocs/picoplaza/admin/application/controllers/Do_dept_review_listview.php): Danh sách hồ sơ phân phối theo chuyên môn phòng ban.
* [Do_dept_review.php](file:///c:/xampp56/htdocs/picoplaza/admin/application/controllers/Do_dept_review.php): Chi tiết thẩm định, Document Viewer, Approve / Modal Reject.
* [Do_doc_submission_listview.php](file:///c:/xampp56/htdocs/picoplaza/admin/application/controllers/Do_doc_submission_listview.php): Quản trị tổng thể ma trận hồ sơ cho Admin.
* [Do_doc_submission.php](file:///c:/xampp56/htdocs/picoplaza/admin/application/controllers/Do_doc_submission.php): Phê duyệt cuối và xử lý Admin Override (Force Approve / Reject).
* [Do_doc_type_listview.php](file:///c:/xampp56/htdocs/picoplaza/admin/application/controllers/Do_doc_type_listview.php) & [Do_doc_type.php](file:///c:/xampp56/htdocs/picoplaza/admin/application/controllers/Do_doc_type.php): Module quản trị động các loại hồ sơ, upload biểu mẫu PDF và cấu hình phòng ban thẩm định song song.
* Views tương ứng tại [admin/application/views/do_dept_review/](file:///c:/xampp56/htdocs/picoplaza/admin/application/views/do_dept_review/), [admin/application/views/do_doc_submission/](file:///c:/xampp56/htdocs/picoplaza/admin/application/views/do_doc_submission/) và [admin/application/views/doc_type_view/](file:///c:/xampp56/htdocs/picoplaza/admin/application/views/doc_type_view/).

### **5.5. Cấu hình Routes & Menu**
* [application/config/routes.php](file:///c:/xampp56/htdocs/picoplaza/application/config/routes.php): Định tuyến thân thiện `/portal-tham-dinh`, `/portal-tham-dinh/nop-ho-so`, `/portal-tham-dinh/theo-doi/:code`.
* [admin/application/views/modules/mod_header.php](file:///c:/xampp56/htdocs/picoplaza/admin/application/views/modules/mod_header.php): Thêm menu sidebar CMS.
* [application/views/modules/mod_header.php](file:///c:/xampp56/htdocs/picoplaza/application/views/modules/mod_header.php): Thêm menu điều hướng Frontend.

---

## **6. HƯỚNG DẪN KÍCH HOẠT & VẬN HÀNH**

1. **Nạp CSDL**: Import file [picoplaza_workflow.sql](file:///c:/xampp56/htdocs/picoplaza/picoplaza_workflow.sql) vào database `picoplaza` trong phpMyAdmin hoặc Navicat.
2. **Truy cập Frontend**:
   * URL Cổng hồ sơ: `http://localhost/picoplaza/portal-tham-dinh`
   * URL Nộp hồ sơ: `http://localhost/picoplaza/portal-tham-dinh/nop-ho-so`
3. **Truy cập Quản trị CMS**:
   * URL Cổng Thẩm định Phòng ban: `http://localhost/picoplaza/admin/index.php/do_dept_review_listview`
   * URL Cấu hình Loại Hồ Sơ & Biểu Mẫu: `http://localhost/picoplaza/admin/index.php/do_doc_type_listview`

---

## **7. NHẬT KÝ CẬP NHẬT QUY TRÌNH (CHANGELOG)**

### **Phiên bản cập nhật - Tinh gọn quy trình duyệt (Theo yêu cầu khách hàng)**:
1. **Lược bỏ khâu Quản trị Admin phê duyệt hồ sơ**:
   - Loại bỏ trạng thái trung gian `WAITING_ADMIN` ("Chờ Admin Duyệt").
   - Khi tất cả phòng ban phụ trách có thẩm quyền (`cpermission = 'APPROVE'`) thẩm định thông qua, hệ thống **tự động chuyển trạng thái hồ sơ sang `COMPLETED`** ngay lập tức.
   - Tự động ghi log chuyển đổi hoàn tất và gửi email thông báo kết quả phê duyệt cho khách hàng kèm đường dẫn tải văn bản chính thức.
   - Bắn thông báo xác nhận hoàn tất lên Telegram Bot cho Ban Quản Trị theo dõi.
2. **Cập nhật giao diện Khách hàng (Frontend Portal)**:
   - Stepper tiến độ rút ngắn từ 4 bước thành **3 bước chuẩn**: `1. Khởi tạo & Upload` $\rightarrow$ `2. Thẩm định phòng ban` $\rightarrow$ `3. Cấp văn bản xác nhận`. Bỏ hoàn toàn bước 3 "Admin phê duyệt".
   - Badge trạng thái hồ sơ hiển thị nhãn xanh `HOÀN TẤT - ĐÃ THÔNG QUA` (hoặc `ĐÃ DUYỆT`), không còn badge cam `CHỜ ADMIN PHÊ DUYỆT`.
   - Ngay khi các phòng ban duyệt xong, hộp thông báo thành công và nút tải văn bản đã xác nhận được mở tức thì cho khách hàng.
3. **Cập nhật giao diện Quản trị CMS (Backend)**:
   - Ẩn mục menu `Quản Trị Phê Duyệt Hồ Sơ` khỏi sidebar menu theo yêu cầu.
   - Loại bỏ khung form thao tác duyệt/từ chối cấp Admin trong trang chi tiết hồ sơ (`detail.php`).
   - Cột trạng thái trong danh sách hồ sơ cập nhật đồng bộ tag xanh `HOÀN TẤT`.
4. **Cơ chế Tự động Dọn dẹp & Chuyển đổi Dữ liệu cũ (Auto-migration)**:
   - Bổ sung hàm `ensure_workflow_legacy_cleanup()` tự động phát hiện và chuyển đổi tất cả hồ sơ cũ đang ở trạng thái `WAITING_ADMIN` sang `COMPLETED`, đảm bảo tính nhất quán trên toàn bộ hệ thống ngay khi truy cập.

