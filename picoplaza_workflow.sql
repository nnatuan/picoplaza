-- ========================================================
-- PICOPLAZA WORKFLOW & DOCUMENT APPROVAL SYSTEM DATABASE
-- Database Schema for Multi-Department Document Review Portal
-- Prefix: picoplaza_
-- ========================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- 1. Table structure for picoplaza_tdepartment (Danh mục phòng ban)
-- ----------------------------
DROP TABLE IF EXISTS `picoplaza_tdepartment`;
CREATE TABLE `picoplaza_tdepartment` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `ccode` varchar(50) NOT NULL COMMENT 'Mã phòng ban (KD, KT, KTPL, BQL...)',
  `cname` varchar(150) NOT NULL COMMENT 'Tên phòng ban thẩm định',
  `cdescription` text DEFAULT NULL,
  `ctelegram_group_id` varchar(50) DEFAULT NULL COMMENT 'ID nhóm Telegram nhận thông báo hồ sơ thẩm định mới',
  `nstatus` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1: Hoạt động, 0: Tạm ngưng',
  `cindex` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`nid`),
  UNIQUE KEY `uk_dept_code` (`ccode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Danh mục phòng ban thẩm định';

INSERT INTO `picoplaza_tdepartment` (`nid`, `ccode`, `cname`, `cdescription`, `ctelegram_group_id`, `nstatus`, `cindex`) VALUES
(1, 'DEPT_KDMB', 'Phòng Kinh Doanh Mặt Bằng (PDS)', 'Thẩm định hợp đồng thuê mặt bằng, tư cách pháp lý & người đại diện hợp pháp của khách hàng', NULL, 1, 1),
(2, 'DEPT_VH', 'Phòng Kỹ Thuật - Vận Hành (M&E)', 'Thẩm định bản vẽ thi công, PCCC, cấp điện/nước/máy lạnh & phân luồng thang máy vận chuyển', NULL, 1, 2),
(3, 'DEPT_TH', 'Phòng Tổng Hợp / Hành Chính (Admin Dept)', 'Tiếp nhận hồ sơ nhân sự/công nhân, phê duyệt khung thời gian ra vào & làm việc ngoài giờ', NULL, 1, 3),
(4, 'DEPT_KTPL', 'Phòng Kế Toán & Pháp Lý', 'Thẩm định giấy phép kinh doanh, mã số thuế, kiểm soát thanh toán & tiền cọc thi công', NULL, 1, 4),
(5, 'DEPT_BQL', 'Ban Quản Lý & An Ninh Tòa Nhà', 'Kiểm soát ra vào, an ninh trật tự, niêm phong mặt bằng nghỉ lễ & kiểm tra hiện trạng bàn giao', NULL, 1, 5);

-- ----------------------------
-- 2. Table structure for picoplaza_tdoc_type (Cấu hình loại hồ sơ & Luồng duyệt)
-- ----------------------------
DROP TABLE IF EXISTS `picoplaza_tdoc_type`;
CREATE TABLE `picoplaza_tdoc_type` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `ccode` varchar(50) NOT NULL COMMENT 'Mã loại hồ sơ (TH_HTKH_04, VH_TC_05...)',
  `cname` varchar(255) NOT NULL COMMENT 'Tên loại hồ sơ / đề xuất',
  `cdescription` text DEFAULT NULL,
  `cfile_template` varchar(255) DEFAULT NULL COMMENT 'Đường dẫn file mẫu PDF chuẩn',
  `cdepts_required` varchar(255) NOT NULL COMMENT 'Danh sách ID phòng ban duyệt song song (VD: 1,2,3)',
  `cdepts_view` varchar(255) DEFAULT NULL COMMENT 'Danh sách ID phòng ban chỉ xem song song (VD: 4,5)',
  `nstatus` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1: Hoạt động, 0: Tạm ngưng',
  `cindex` int(11) NOT NULL DEFAULT 0,
  `ddate_created` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`nid`),
  UNIQUE KEY `uk_doc_type_code` (`ccode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cấu hình loại hồ sơ & luồng duyệt song song';

-- Dữ liệu mẫu 6 loại hồ sơ chuẩn Pico Plaza thực tế từ thư mục upload/doc_type
INSERT INTO `picoplaza_tdoc_type` (`nid`, `ccode`, `cname`, `cdescription`, `cfile_template`, `cdepts_required`, `cdepts_view`, `nstatus`, `cindex`) VALUES
(1, 'TH_HTKH_04', 'Giấy đề nghị vận chuyển tài sản ra vào toà nhà (Mẫu TH-HTKH.04)', 'Áp dụng cho khách hàng đăng ký mang tài sản, hàng hóa vào hoặc ra khỏi tòa nhà Pico Plaza', 'upload/doc_type/TH-HTKH.04 Giấy đề nghị vận chuyển tài sản ra vào toà nhà.pdf', '1,2,3', '', 1, 1),
(2, 'TH_HTKH_08', 'Giấy đăng ký nghỉ lễ (Mẫu TH-HTKH.08)', 'Áp dụng cho doanh nghiệp thông báo lịch nghỉ lễ, yêu cầu cấp/ngắt điện nước máy lạnh, niêm phong', 'upload/doc_type/TH-HTKH.08 Giấy đăng ký nghỉ lễ.pdf', '2,3,5', '', 1, 2),
(3, 'TH_HTKH_09', 'Giấy đăng ký hoạt động tại Picoplaza (Mẫu TH-HTKH.09)', 'Áp dụng cho đơn vị mới tiếp nhận mặt bằng khai báo thông tin doanh nghiệp, nhân sự, phương tiện', 'upload/doc_type/TH-HTKH.09 Giấy đăng ký hoạt động tại Picoplaza.pdf', '1,3,4', '', 1, 3),
(4, 'TH_HTKH_10', 'Phiếu đăng ký dịch vụ ngoài giờ (Mẫu TH-HTKH.10)', 'Áp dụng khi có nhu cầu làm việc ngoài giờ, yêu cầu cấp điện, nước, máy lạnh, thang máy và giữ xe', 'upload/doc_type/TH-HTKH.10 Đăng ký làm việc ngoài giờ.pdf', '2,3', '', 1, 4),
(5, 'VH_TC_05', 'Phiếu đăng ký thi công - Fit-out Form (Mẫu VH-TC.05)', 'Áp dụng cho đơn vị thi công, cải tạo gian hàng, lắp đặt biển hiệu và xuất nhập trang thiết bị', 'upload/doc_type/VH-TC.05 Phiếu đăng ký thi công.pdf', '1,2,3', '', 1, 5),
(6, 'VH_TC_07', 'Giấy đăng ký vận chuyển vật tư, trang thiết bị thi công (Mẫu VH-TC.07)', 'Áp dụng khi vận chuyển máy móc, vật liệu xây dựng phục vụ thi công vào hoặc ra tòa nhà', 'upload/doc_type/VH-TC.07 Giấy đăng ký vận chuyển vật tư trang thiết bị thi công.pdf', '1,2,3', '', 1, 6);

-- ----------------------------
-- 3. Table structure for picoplaza_tdoc_submission (Hồ sơ khách hàng nộp)
-- ----------------------------
DROP TABLE IF EXISTS `picoplaza_tdoc_submission`;
CREATE TABLE `picoplaza_tdoc_submission` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `ccode` varchar(50) NOT NULL COMMENT 'Mã hồ sơ (VD: HS-2026-0001)',
  `nid_user` int(11) NOT NULL DEFAULT 0 COMMENT 'ID tài khoản khách hàng nộp',
  `nid_doc_type` int(11) NOT NULL COMMENT 'ID loại hồ sơ',
  `ccustomer_name` varchar(150) NOT NULL COMMENT 'Tên khách hàng / Doanh nghiệp',
  `ccustomer_phone` varchar(30) NOT NULL COMMENT 'Số điện thoại liên hệ',
  `ccustomer_email` varchar(100) NOT NULL COMMENT 'Email nhận kết quả',
  `ctitle` varchar(255) NOT NULL COMMENT 'Tiêu đề hồ sơ / Tên mặt bằng gian hàng',
  `cnote` text DEFAULT NULL COMMENT 'Ghi chú thêm từ khách hàng',
  `cfile_path` varchar(255) NOT NULL COMMENT 'Đường dẫn file scan/ảnh hồ sơ gốc khách nộp',
  `cfile_approved` varchar(255) DEFAULT NULL COMMENT 'Đường dẫn file văn bản chính thức đã xác nhận',
  `cstatus` enum('INIT','IN_REVIEW','WAITING_ADMIN','COMPLETED','REJECTED') NOT NULL DEFAULT 'IN_REVIEW' COMMENT 'Trạng thái hồ sơ',
  `creject_reason` text DEFAULT NULL COMMENT 'Lý do từ chối (từ phòng ban hoặc admin)',
  `cadmin_note` text DEFAULT NULL COMMENT 'Ghi chú can thiệp đặc biệt của Admin',
  `is_override` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1: Có sự can thiệp Admin Override',
  `ddate_submit` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ddate_completed` datetime DEFAULT NULL,
  PRIMARY KEY (`nid`),
  UNIQUE KEY `uk_submission_code` (`ccode`),
  KEY `idx_status` (`cstatus`),
  KEY `idx_user` (`nid_user`),
  KEY `idx_doc_type` (`nid_doc_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Hồ sơ khách hàng nộp thẩm định';

-- ----------------------------
-- 4. Table structure for picoplaza_tdoc_approval_step (Vết duyệt từng phòng ban)
-- ----------------------------
DROP TABLE IF EXISTS `picoplaza_tdoc_approval_step`;
CREATE TABLE `picoplaza_tdoc_approval_step` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `nid_submission` int(11) NOT NULL COMMENT 'ID hồ sơ',
  `nid_dept` int(11) NOT NULL COMMENT 'ID phòng ban được phân công duyệt/xem',
  `cpermission` enum('APPROVE','VIEW') NOT NULL DEFAULT 'APPROVE' COMMENT 'Quyền của phòng ban: APPROVE (Duyệt), VIEW (Chỉ xem)',
  `nid_staff_user` int(11) DEFAULT NULL COMMENT 'ID nhân viên thực hiện thao tác duyệt/từ chối',
  `cstep_status` enum('PENDING','APPROVED','REJECTED') NOT NULL DEFAULT 'PENDING' COMMENT 'Trạng thái duyệt của phòng ban',
  `creason_note` text DEFAULT NULL COMMENT 'Ghi chú hoặc lý do từ chối bắt buộc',
  `dtime_action` datetime DEFAULT NULL COMMENT 'Thời điểm thao tác',
  PRIMARY KEY (`nid`),
  UNIQUE KEY `uk_submission_dept` (`nid_submission`,`nid_dept`),
  KEY `idx_submission` (`nid_submission`),
  KEY `idx_dept` (`nid_dept`),
  KEY `idx_status` (`cstep_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Chi tiết bước duyệt song song của từng phòng ban';

-- ----------------------------
-- 5. Table structure for picoplaza_tdoc_log (Nhật ký kiểm toán / Audit Trail)
-- ----------------------------
DROP TABLE IF EXISTS `picoplaza_tdoc_log`;
CREATE TABLE `picoplaza_tdoc_log` (
  `nid` int(11) NOT NULL AUTO_INCREMENT,
  `nid_submission` int(11) NOT NULL COMMENT 'ID hồ sơ',
  `nid_user` int(11) DEFAULT NULL COMMENT 'ID người thực hiện',
  `cuser_role` varchar(50) DEFAULT NULL COMMENT 'Vai trò người thực hiện (customer, dept_staff, admin)',
  `caction` varchar(50) NOT NULL COMMENT 'Hành động: SUBMIT, DEPT_APPROVE, DEPT_REJECT, ADMIN_APPROVE, ADMIN_REJECT, FORCE_APPROVE, FORCE_REJECT',
  `cold_status` varchar(50) DEFAULT NULL,
  `cnew_status` varchar(50) DEFAULT NULL,
  `cnote` text DEFAULT NULL COMMENT 'Nội dung chi tiết/lý do can thiệp',
  `cip_address` varchar(50) DEFAULT NULL,
  `ddate_log` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`nid`),
  KEY `idx_submission_log` (`nid_submission`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Nhật ký kiểm toán theo dõi quy trình hồ sơ';

-- ----------------------------
-- 6. Mở rộng bảng picoplaza_tuser (Gắn phòng ban cho nhân sự)
-- ----------------------------
-- Thêm cột nid_dept nếu chưa có
SET @exist_col = (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'picoplaza_tuser' AND COLUMN_NAME = 'nid_dept');
SET @sql_stmt = IF(@exist_col = 0, 'ALTER TABLE `picoplaza_tuser` ADD COLUMN `nid_dept` int(11) NULL DEFAULT 0 COMMENT \'Phòng ban công tác\' AFTER `crole`;', 'SELECT \'Column already exists\';');
PREPARE stmt FROM @sql_stmt;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Cập nhật quyền menu vào picoplaza_taccess
INSERT IGNORE INTO `picoplaza_taccess` (`nid`, `cname`, `ccontroller`, `cfunction`, `nstatus`, `cindex`, `nid_group`, `cname_group`) VALUES
(41, 'Xem Hồ Sơ Quản Trị', 'do_doc_submission_listview', '', 1, '1', 9, 'Quản lý Hồ Sơ & Phê Duyệt'),
(42, 'Chi tiết & Duyệt Admin', 'do_doc_submission', 'f_edit', 1, '2', 9, 'Quản lý Hồ Sơ & Phê Duyệt'),
(43, 'Cổng Thẩm Định Phòng Ban', 'do_dept_review_listview', '', 1, '3', 9, 'Quản lý Hồ Sơ & Phê Duyệt'),
(44, 'Thực Hiện Thẩm Định', 'do_dept_review', 'f_review', 1, '4', 9, 'Quản lý Hồ Sơ & Phê Duyệt'),
(45, 'Loại Hồ Sơ & Luồng Duyệt', 'do_doc_type_listview', '', 1, '5', 9, 'Quản lý Hồ Sơ & Phê Duyệt'),
(46, 'Cấu hình Phòng Ban', 'do_dept_listview', '', 1, '6', 9, 'Quản lý Hồ Sơ & Phê Duyệt'),
(47, 'Xem Hồ Sơ (Chỉ Xem)', 'do_dept_view_listview', '', 1, '7', 9, 'Quản lý Hồ Sơ & Phê Duyệt');

-- Bổ sung cột cdepts_view vào picoplaza_tdoc_type nếu nâng cấp
SET @exist_view_col = (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'picoplaza_tdoc_type' AND COLUMN_NAME = 'cdepts_view');
SET @sql_stmt2 = IF(@exist_view_col = 0, 'ALTER TABLE `picoplaza_tdoc_type` ADD COLUMN `cdepts_view` varchar(255) NULL DEFAULT \'\' COMMENT \'Danh sách ID phòng ban chỉ xem song song\' AFTER `cdepts_required`;', 'SELECT \'Column cdepts_view already exists\';');
PREPARE stmt2 FROM @sql_stmt2;
EXECUTE stmt2;
DEALLOCATE PREPARE stmt2;

-- Bổ sung cột cpermission vào picoplaza_tdoc_approval_step nếu nâng cấp
SET @exist_perm_col = (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'picoplaza_tdoc_approval_step' AND COLUMN_NAME = 'cpermission');
SET @sql_stmt3 = IF(@exist_perm_col = 0, 'ALTER TABLE `picoplaza_tdoc_approval_step` ADD COLUMN `cpermission` enum(\'APPROVE\',\'VIEW\') NOT NULL DEFAULT \'APPROVE\' COMMENT \'Quyền của phòng ban: APPROVE (Duyệt), VIEW (Chỉ xem)\' AFTER `nid_dept`;', 'SELECT \'Column cpermission already exists\';');
PREPARE stmt3 FROM @sql_stmt3;
EXECUTE stmt3;
DEALLOCATE PREPARE stmt3;

SET FOREIGN_KEY_CHECKS = 1;

