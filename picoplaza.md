# **TỔNG HỢP & TÓM TẮT CUỘC TRÒ CHUYỆN (HỆ THỐNG PICO PLAZA / SAIGON)**

Tài liệu này tổng hợp toàn bộ các vấn đề kỹ thuật, giải pháp, cấu trúc dữ liệu và mã nguồn đã được xử lý xuyên suốt cuộc trò chuyện trên nền tảng CodeIgniter Framework (PHP/MySQL).

## **1\. Tích Hợp Thông Báo Telegram & Email Cho Ticket Mới**

### **1.1. Luồng xử lý & Logic thông báo**

* Khi khách hàng gửi ticket mới tại frontend (Ticket.php):  
  * Dừng gửi mail xác nhận cho chính khách hàng.  
  * Quét danh sách tài khoản nhân sự quản trị trong bảng tuser có vai trò admin hoặc ticket\_mgr (crole IN ('admin', 'ticket\_mgr')).  
  * Gửi email thông báo duy nhất một lần qua Mailjet REST API v3.1 tới danh sách nhân sự trên.  
  * Bắn thông báo khẩn qua bot Telegram vào nhóm chat quản trị PICOPLAZA.

### **1.2. Cách lấy chat\_id của nhóm Telegram**

* Tắt tính năng **Group Privacy** của Bot thông qua @BotFather (/mybots $\\rightarrow$ chọn Bot $\\rightarrow$ Bot Settings $\\rightarrow$ Group Privacy $\\rightarrow$ Turn off).  
* Mời bot vào nhóm và cấp quyền Administrator.  
* Gửi tin nhắn thử nghiệm vào nhóm, sau đó truy xuất URL API:  
  Plaintext  
  https://api.telegram.org/bot\<BOT\_TOKEN\>/getUpdates

* Lấy giá trị id âm của Group:  
  * **ID nhóm PICOPLAZA**: \-5521381147 *(Lưu ý: Bắt buộc phải có dấu trừ \- phía trước)*.

### **1.3. Mã nguồn Helper hỗ trợ**

&nbsp;

&nbsp;

&nbsp;

PHP

/\*\*  
&nbsp;\* Lấy danh sách email nhân sự quản lý ticket & admin  
&nbsp;\*/  
function get\_ticket\_staff\_emails()  
{  
&nbsp;&nbsp;&nbsp;&nbsp;$obj\_helper \=& get\_instance();  
&nbsp;&nbsp;&nbsp;&nbsp;$obj\_helper\-\>load-\>database();  
&nbsp;&nbsp;&nbsp;&nbsp;  
&nbsp;&nbsp;&nbsp;&nbsp;$str\_query \= " SELECT cemail, cfullname FROM " . Fget\_ap\_table('tuser') . " ";  
&nbsp;&nbsp;&nbsp;&nbsp;$str\_query .= " WHERE cstatus \= '1' AND cdel \= '0' AND cemail \!= '' ";  
&nbsp;&nbsp;&nbsp;&nbsp;$str\_query .= " AND crole IN ('admin', 'ticket\_mgr') ";  
&nbsp;&nbsp;&nbsp;&nbsp;  
&nbsp;&nbsp;&nbsp;&nbsp;return $obj\_helper\-\>db-\>query($str\_query)-\>result\_array();  
}

## **2\. Nâng Cấp Module Tin Tức (Bản Tin PICO PLAZA)**

### **2.1. Yêu cầu giao diện & cấu trúc**

* **Trang tổng quan (news.php / controller news.php)**:  
  * Lặp qua toàn bộ danh mục tin tức hoạt động (tcat\_news).  
  * Mỗi nhóm gồm: **1 tin đại diện lớn** và **3 tin nhỏ** ở dưới.  
  * Loại bỏ các nút "Đọc thêm" nhỏ lẻ ở từng tin.  
  * Thêm nút "Xem thêm" dạng khối ở cuối mỗi nhóm tin:  
    * Chuyển hướng theo clink nếu có.  
    * Nếu không có clink, chuyển hướng về trang danh sách theo nhóm /news-list/ccode.  
  * Hiển thị nhãn danh mục (news-tag) và hiển thị trực tiếp trường ngày tháng ddate02.  
* **Trang danh sách theo nhóm (news\_list.php)**:  
  * Tiếp nhận ccode từ URL, truy vấn đúng tin tức thuộc danh mục và hỗ trợ phân trang.  
  * Cập nhật quy tắc URL trong routes.php:  
    PHP  
    $route\['news-list/(\[a-zA-Z0-9-\_\]+)/(:num)'\] \= "news\_list/cat\_page/$1/$2";  
    $route\['news-list/(\[a-zA-Z0-9-\_\]+)'\]       \= "news\_list/cat\_page/$1/1";

### **2.2. Helper xử lý danh mục & tin tức**

&nbsp;

&nbsp;

&nbsp;

PHP

function get\_count\_news($cat\_param \= 0)  
{  
&nbsp;&nbsp;&nbsp;&nbsp;$obj\_helper \=& get\_instance();  
&nbsp;&nbsp;&nbsp;&nbsp;$obj\_helper\-\>load-\>database();  
&nbsp;&nbsp;&nbsp;&nbsp;  
&nbsp;&nbsp;&nbsp;&nbsp;$str\_query \= ' SELECT a.nid FROM ' . Fget\_ap\_table('tnews') . ' as a ';  
&nbsp;&nbsp;&nbsp;&nbsp;$str\_query .= ' LEFT JOIN ' . Fget\_ap\_table('tcat\_news') . ' as b ON a.nid\_cat\_news \= b.nid ';  
&nbsp;&nbsp;&nbsp;&nbsp;$str\_query .= ' WHERE a.nstatus \= 1 ';

&nbsp;&nbsp;&nbsp;&nbsp;if (\!empty($cat\_param) && $cat\_param \!== '0') {  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (is\_numeric($cat\_param)) {  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$str\_query .= ' AND a.nid\_cat\_news \= ' . (int)$cat\_param . ' ';  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;} else {  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$str\_query .= ' AND b.ccode \= ' . $obj\_helper\-\>db-\>escape($cat\_param) . ' ';  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}  
&nbsp;&nbsp;&nbsp;&nbsp;}  
&nbsp;&nbsp;&nbsp;&nbsp;  
&nbsp;&nbsp;&nbsp;&nbsp;return $obj\_helper\-\>db-\>query($str\_query)-\>num\_rows();  
}

function get\_list\_news($cat\_param \= 0, $offset \= 0, $row\_per\_page \= 9)  
{  
&nbsp;&nbsp;&nbsp;&nbsp;$obj\_helper \=& get\_instance();  
&nbsp;&nbsp;&nbsp;&nbsp;$obj\_helper\-\>load-\>database();  
&nbsp;&nbsp;&nbsp;&nbsp;  
&nbsp;&nbsp;&nbsp;&nbsp;$str\_query \= ' SELECT a.\*, b.ccat\_news as ccat\_news, b.ccode as cat\_ccode ';  
&nbsp;&nbsp;&nbsp;&nbsp;$str\_query .= ' FROM ' . Fget\_ap\_table('tnews') . ' as a ';  
&nbsp;&nbsp;&nbsp;&nbsp;$str\_query .= ' LEFT JOIN ' . Fget\_ap\_table('tcat\_news') . ' as b ON a.nid\_cat\_news \= b.nid ';  
&nbsp;&nbsp;&nbsp;&nbsp;$str\_query .= ' WHERE a.nstatus \= 1 ';

&nbsp;&nbsp;&nbsp;&nbsp;if (\!empty($cat\_param) && $cat\_param \!== '0') {  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;if (is\_numeric($cat\_param)) {  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$str\_query .= ' AND a.nid\_cat\_news \= ' . (int)$cat\_param . ' ';  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;} else {  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$str\_query .= ' AND b.ccode \= ' . $obj\_helper\-\>db-\>escape($cat\_param) . ' ';  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;}  
&nbsp;&nbsp;&nbsp;&nbsp;}

&nbsp;&nbsp;&nbsp;&nbsp;$str\_query .= ' ORDER BY a.cindex+0 ASC, a.nid DESC ';  
&nbsp;&nbsp;&nbsp;&nbsp;$str\_query .= ' LIMIT ' . max(0, (int)$offset) . ', ' . (int)$row\_per\_page;  
&nbsp;&nbsp;&nbsp;&nbsp;  
&nbsp;&nbsp;&nbsp;&nbsp;return $obj\_helper\-\>db-\>query($str\_query)-\>result\_array();  
}

## **3\. Quản Lý Tài Khoản Nhân Sự (CMS)**

Đồng bộ các phân quyền tài khoản (crole) giữa bộ lọc và nhãn hiển thị danh sách:

* admin: Quản trị viên (label-danger)  
* product\_mgr: Quản lý Tin đăng (label-primary)  
* content\_mgr: Quản trị Nội dung (label-info)  
* ticket\_mgr: Quản lý Ticket (label-warning)  
* mail\_mgr: Quản lý Mail (label-success)

## **4\. Quản Lý Hồ Sơ Tài Liệu BĐS & Khắc Phục Upload**

### **4.1. Chức năng xóa tài liệu qua AJAX**

* Tách biệt hoàn toàn khỏi nút submit form chung.  
* Thêm nút **Xóa tệp này** bên cạnh file đã tải lên kèm xác nhận confirm() bằng JavaScript.  
* Gửi request đến do\_product/ajax\_delete\_document để xóa file vật lý và bản ghi trong CSDL tdocument.

### **4.2. Sửa lỗi tệp không lưu lên server khi upload**

* **Nguyên nhân**: Sử dụng hằng số FCPATH . 'upload/document/' trong thư mục quản trị admin/ khiến đường dẫn bị sai lệch vị trí.  
* **Giải pháp khắc phục**: Đổi đường dẫn lưu trữ thành đường dẫn tương đối:  
  PHP  
  $secure\_path \= '.././upload/document/';

## **5\. Đồng Bộ 4 Trạng Thái Giao Dịch Bất Động Sản**

Hệ thống hỗ trợ 4 trạng thái giao dịch thông qua trường nproduct\_status trong bảng tproduct:

| Giá trị (nproduct\_status) | Tên trạng thái | Class CSS | Màu sắc |
| :---- | :---- | :---- | :---- |
| **1** | ĐANG BÁN | .selling | Cam (--accent-orange / \#ea580c) |
| **2** | TẠM ẨN | .hidden-status | Đỏ (--primary-red / \#dc2626) |
| **3** | ĐÃ BÁN | .sold | Xám (\#64748b) |
| **4** | CHO THUÊ | .renting | Xanh dương (\#0284c7) |

### **5.1. Mã PHP hiển thị đồng bộ (Áp dụng cho products.php và product\_detail.php)**

&nbsp;

&nbsp;

&nbsp;

PHP

\<?php&nbsp;  
&nbsp;&nbsp;&nbsp;&nbsp;$p\_status \= isset($row\['nproduct\_status'\]) ? (int)$row\['nproduct\_status'\] : (isset($product\['nproduct\_status'\]) ? (int)$product\['nproduct\_status'\] : 1);  
&nbsp;&nbsp;&nbsp;&nbsp;switch ($p\_status) {  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;case 1:  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo '\<span class="status-badge selling"\>ĐANG BÁN\</span\>';  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;case 2:  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo '\<span class="status-badge hidden-status"\>TẠM ẨN\</span\>';  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;case 3:  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo '\<span class="status-badge sold"\>ĐÃ BÁN\</span\>';  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;case 4:  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo '\<span class="status-badge renting"\>CHO THUÊ\</span\>';  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;default:  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;echo '\<span class="status-badge selling"\>ĐANG BÁN\</span\>';  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;break;  
&nbsp;&nbsp;&nbsp;&nbsp;}  
?\>

### **5.2. Định dạng CSS đồng bộ**

&nbsp;

&nbsp;

&nbsp;

CSS

/\* Base Style cho Status Badge \*/  
.status-badge {  
&nbsp;&nbsp;font-size: 11px;  
&nbsp;&nbsp;font-weight: 700;  
&nbsp;&nbsp;padding: 4px 10px;  
&nbsp;&nbsp;border-radius: var(--radius);  
&nbsp;&nbsp;font-family: 'JetBrains Mono', monospace;  
&nbsp;&nbsp;display: inline-block;  
&nbsp;&nbsp;color: \#ffffff;  
&nbsp;&nbsp;text-transform: uppercase;  
}

/\* Định dạng màu sắc \*/  
.status-badge.selling      { background: var(--accent-orange, \#ea580c); }  
.status-badge.renting      { background: \#0284c7; }  
.status-badge.sold         { background: \#64748b; }  
.status-badge.hidden-status { background: var(--primary-red, \#dc2626); }

/\* Đồng bộ với Ribbon dạng thẻ \*/  
.ribbon.selling       { background: var(--accent-orange, \#ea580c); }  
.ribbon.selling::after { border-top-color: var(--accent-orange, \#ea580c); }  
.ribbon.renting       { background: \#0284c7; }  
.ribbon.renting::after { border-top-color: \#0284c7; }  
.ribbon.sold          { background: \#64748b; }  
.ribbon.sold::after   { border-top-color: \#64748b; }  
.ribbon.hidden-status { background: var(--primary-red, \#dc2626); }  
.ribbon.hidden-status::after { border-top-color: var(--primary-red, \#dc2626); }  
