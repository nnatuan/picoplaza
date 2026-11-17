<?php 
	$this->load->view('header');
	$this->load->view('header_end');
	$this->load->view('modules/mod_header'); 
?>
<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                
                <div class="x_panel" style="border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 30px; padding: 20px;">
                    <div class="x_title" style="border-bottom: 2px solid #e6e9ed; padding-bottom: 10px; margin-bottom: 20px;">
                        <h2 style="font-size: 18px; font-weight: 700; color: #2c3e50; margin: 0;">
                            <i class="fa fa-sitemap text-success"></i> PHẦN 1: QUY TRÌNH TIẾP NHẬN &amp; DUYỆT BÀI ĐĂNG BẤT ĐỘNG SẢN
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="x_content" style="font-size: 14px; color: #4f5f6f; line-height: 1.75;">
                        <p>Dữ liệu tin đăng bất động sản vận hành dựa trên sự kết hợp thông tin linh hoạt giữa màn hình bên ngoài trang chủ và trung tâm xử lý nội bộ của nhân viên:</p>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 20px 0;">
                            <div style="padding: 15px; background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 4px;">
                                <h4 style="font-size: 14px; font-weight: 700; color: #16a34a; margin-top: 0; margin-bottom: 10px;"><i class="fa fa-desktop"></i> 1. Luồng Khách Hàng Tự Đăng Tin</h4>
                                <ul style="padding-left: 20px; margin: 0;">
                                    <li>Người dùng/Đối tác chủ động điền các thông số kỹ thuật thực tế của sản phẩm vào biểu mẫu Đăng tin có sẵn ngoài trang chủ.</li>
                                    <li>Sau khi gửi, bài đăng sẽ tự động chuyển về trạng thái chờ duyệt và chưa xuất hiện công khai.</li>
                                </ul>
                            </div>
                            <div style="padding: 15px; background-color: #f0f7ff; border: 1px solid #bfdbfe; border-radius: 4px;">
                                <h4 style="font-size: 14px; font-weight: 700; color: #1d4ed8; margin-top: 0; margin-bottom: 10px;"><i class="fa fa-user"></i> 2. Luồng Nhân Viên Đăng Hộ</h4>
                                <ul style="padding-left: 20px; margin: 0;">
                                    <li>Áp dụng khi khách hàng gửi thông số BĐS qua Zalo, hình ảnh giấy tờ thô và nhờ chuyên viên của PICO hỗ trợ đăng hộ lên trang web.</li>
                                    <li>Nhân viên vào quản trị bấm Thêm mới để nhập liệu trực tiếp thay cho khách.</li>
                                </ul>
                            </div>
                        </div>

                        <h3 style="font-size: 15px; font-weight: 600; color: #222; margin: 25px 0 12px 0; padding-left: 8px; border-left: 3px solid #1abb9c;">1.1 Giao Diện Danh Sách Bài Đăng Tiếp Nhận Dữ Liệu</h3>
                        <p>Toàn bộ các tin do khách tự gửi hoặc nhân viên đăng hộ đều được tập trung tại danh bạ quản lý bài đăng nội bộ. Người phụ trách sử dụng thanh công cụ để tìm kiếm và nhấp chọn sửa đổi:</p>
                        
                        <div style="text-align: center; margin: 20px 0;">
                            <img src="<?php echo base_url(); ?>images/guide/c1_1.png" style="max-width: 1000px; height: auto; border: 1px solid #e6e9ed; border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);" />
                            <div style="font-size: 13px; font-style: italic; color: #73879c; margin-top: 6px;"><i class="fa fa-camera"></i> Bảng điều phối danh sách bài đăng bất động sản nội bộ</div>
                        </div>

                        <h3 style="font-size: 15px; font-weight: 600; color: #222; margin: 25px 0 12px 0; padding-left: 8px; border-left: 3px solid #1abb9c;">1.2 Biểu Mẫu Nhập Liệu Và Sửa Đổi Cấu Trúc</h3>
                        <p>Khi tiến hành kiểm duyệt một bài viết, nhân viên mở <strong>"Thẻ thông tin cơ bản"</strong> để rà soát chất lượng câu từ và chuẩn hóa số liệu:</p>
                        
                        <div style="text-align: center; margin: 20px 0;">
                            <img src="<?php echo base_url(); ?>images/guide/c1_2.png" style="max-width: 1000px; height: auto; border: 1px solid #e6e9ed; border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);" />
                            <div style="font-size: 13px; font-style: italic; color: #73879c; margin-top: 6px;"><i class="fa fa-camera"></i> Biểu mẫu rà soát thông số kỹ thuật bất động sản chi tiết</div>
                        </div>

                        <ul style="padding-left: 20px;">
                            <li style="margin-bottom: 8px;"><strong>Tiêu đề tin đăng * :</strong> Kiểm tra câu chữ của khách, viết hoa chữ cái đầu và điều chỉnh ngắn gọn để tăng tính chuyên nghiệp.</li>
                            <li style="margin-bottom: 8px;"><strong>Mã Code URL * :</strong> Chuỗi chữ không dấu dùng cho liên kết link web. Hệ thống tự động sinh theo tiêu đề, nhân viên không cần can thiệp nhập thủ công ô này.</li>
                            <li style="margin-bottom: 8px;"><strong>Giá trị quy đổi bằng số (VNĐ) * :</strong> Điểm lưu ý tối cao. Khách hàng đăng tin thường gõ thiếu số 0 hoặc viết chữ dấu chấm sai định dạng. Nhân viên bắt buộc phải kiểm tra và quy đổi về chuỗi số nguyên viết liền không dấu để hệ thống chạy chính xác bộ lọc tìm kiếm ngoài trang chủ <em>(Ví dụ: giá hiển thị ghi "4.5 Tỷ" thì ô số phải điền chuẩn là <code>4500000000</code>)</em>.</li>
                        </ul>

                        <h3 style="font-size: 15px; font-weight: 600; color: #222; margin: 25px 0 12px 0; padding-left: 8px; border-left: 3px solid #1abb9c;">1.3 Kiểm Soát Trạng Thái Nghiệp Vụ Kinh Doanh</h3>
                        <p>Nằm tại khu vực cuối cùng của biểu mẫu, người duyệt bài lựa chọn cấu hình để quyết định phương thức xuất bản tin:</p>
                        <ul style="padding-left: 20px;">
                            <li style="margin-bottom: 6px;"><strong>Trạng thái giao dịch :</strong> Chọn <code>Đang bán</code> để công khai tìm khách hàng; chuyển <code>Tạm ẩn</code> để đóng tin rà soát; hoặc gán <code>Đã bán</code> để thông báo đóng giỏ hàng sản phẩm.</li>
                            <li style="margin-bottom: 6px;"><strong>Trạng thái hiển thị :</strong> Chọn <code>Yes</code> để phê duyệt tin bay ra trang chủ website hoặc chọn <code>No</code> để khóa đóng tin ngay lập tức.</li>
                        </ul>
                    </div>
                </div>

                <div class="x_panel" style="border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 30px; padding: 20px;">
                    <div class="x_title" style="border-bottom: 2px solid #e6e9ed; padding-bottom: 10px; margin-bottom: 20px;">
                        <h2 style="font-size: 18px; font-weight: 700; color: #2c3e50; margin: 0;">
                            <i class="fa fa-paperclip text-success"></i> PHẦN 2: HỆ THỐNG ĐÍNH KÈM HỒ SƠ PHÁP LÝ &amp; PHÂN QUYỀN BẢO MẬT TÀI LIỆU
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="x_content" style="font-size: 14px; color: #4f5f6f; line-height: 1.75;">
                        <p>Mặc định khách hàng tự đăng tin ngoài website không thể tự đính kèm các tài liệu mật. Trong quá trình duyệt bài, nhân viên sẽ tiếp nhận hồ sơ giấy tờ gốc từ chủ nhà để cập nhật vào bài viết thông qua thẻ: <strong>"Hồ sơ tài liệu đính kèm"</strong>.</p>
                        
                        <div style="text-align: center; margin: 20px 0;">
                            <img src="<?php echo base_url(); ?>images/guide/c2_1.png" style="max-width: 1000px; height: auto; border: 1px solid #e6e9ed; border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);" />
                            <div style="font-size: 13px; font-style: italic; color: #73879c; margin-top: 6px;"><i class="fa fa-camera"></i> Phân khu upload tài liệu pháp lý và gán quyền bảo mật trong quản trị</div>
                        </div>

                        <h3 style="font-size: 15px; font-weight: 600; color: #222; margin: 25px 0 12px 0; padding-left: 8px; border-left: 3px solid #1abb9c;">2.1 Cài Đặt 3 Cấp Độ Quyền Hạn Kiểm Soát Tải File</h3>
                        <p>Tất cả tệp tin đính kèm đều hiển thị danh sách công khai ngoài website để kích thích nhu cầu của khách lướt trang. Tuy nhiên, nhân viên sử dụng ô <strong>"Quyền kiểm soát truy cập"</strong> để thiết lập vòng chặn bảo mật cho từng tệp cụ thể:</p>
                        
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 15px; margin: 15px 0;">
                            <div style="background: #f8fafc; border: 1px solid #e6e9ed; padding: 12px; border-radius: 4px;">
                                <strong style="color:#1abb9c; display:block; margin-bottom:6px;"><i class="fa fa-unlock"></i> Mức 1: Khu vực công khai</strong>
                                Tất cả mọi người lướt website (kể cả khách vãng lai chưa có tài khoản) đều có thể nhìn thấy tên file và click tải file thô về máy bình thường.
                            </div>
                            <div style="background: #f8fafc; border: 1px solid #e6e9ed; padding: 12px; border-radius: 4px;">
                                <strong style="color:#f0ad4e; display:block; margin-bottom:6px;"><i class="fa fa-user"></i> Mức 2: Khu vực khách hàng</strong>
                                Khách vãng lai bấm nút tải sẽ lập tức bị chặn và đẩy ra thông báo lỗi cảnh báo: <em>"Vui lòng đăng nhập tài khoản thành viên để tải tài liệu này!"</em>.
                            </div>
                            <div style="background: #f8fafc; border: 1px solid #e6e9ed; padding: 12px; border-radius: 4px;">
                                <strong style="color:#d9534f; display:block; margin-bottom:6px;"><i class="fa fa-shield"></i> Mức 3: Khu vực bảo mật</strong>
                                Vòng khóa bảo vệ an toàn cao nhất. Hệ thống chặn toàn bộ người dùng bên ngoài, chỉ có các tài khoản thuộc nhân viên nội bộ công ty mới tải được file.
                            </div>
                        </div>

                        <div style="text-align: center; margin: 20px 0;">
                            <img src="<?php echo base_url(); ?>images/guide/c2_2.png" style="max-width: 1000px; height: auto; border: 1px solid #e6e9ed; border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);" />
                            <div style="font-size: 13px; font-style: italic; color: #73879c; margin-top: 6px;"><i class="fa fa-camera"></i> Khối danh sách tài liệu hiển thị đồng bộ ngoài trang chủ website</div>
                        </div>
                    </div>
                </div>

                <div class="x_panel" style="border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px; padding: 20px;">
                    <div class="x_title" style="border-bottom: 2px solid #e6e9ed; padding-bottom: 10px; margin-bottom: 20px;">
                        <h2 style="font-size: 18px; font-weight: 700; color: #2c3e50; margin: 0;">
                            <i class="fa fa-ticket text-success"></i> PHẦN 3: QUY TRÌNH TIẾP NHẬN &amp; PHẢN HỒI YÊU CẦU TICKET HỖ TRỢ KHÁCH HÀNG
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="x_content" style="font-size: 14px; color: #4f5f6f; line-height: 1.75;">
                        <p>Phân hệ Ticket thiết lập không gian tương tác khép kín, xử lý các sự cố phát sinh của khách hàng thông qua trục quy trình 2 màn hình đồng bộ:</p>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 20px 0;">
                            <div style="padding: 15px; background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 4px;">
                                <h4 style="font-size: 14px; font-weight: 700; color: #16a34a; margin-top: 0; margin-bottom: 10px;"><i class="fa fa-desktop"></i> 1. Đầu Vào Ngoài Trang Chủ</h4>
                                <p style="margin: 0;">Khách hàng điền thông tin khiếu nại, mô tả lỗi thủ tục pháp lý hoặc gán file ảnh minh chứng chứng từ vào biểu mẫu <strong>"Tạo Ticket Hỗ Trợ Nhanh"</strong> ngoài website.</p>
                            </div>
                            <div style="padding: 15px; background-color: #f0f7ff; border: 1px solid #bfdbfe; border-radius: 4px;">
                                <h4 style="font-size: 14px; font-weight: 700; color: #1d4ed8; margin-top: 0; margin-bottom: 10px;"><i class="fa fa-sliders"></i> 2. Đầu Ra Kiểm Duyệt Nội Bộ (CMS)</h4>
                                <p style="margin: 0;">Hệ thống tự động cấp một mã số định danh kiểm toán cố định dạng <code>#PS-100X</code> để nhân viên theo dõi trạng thái, xem file chứng từ và gửi tin nhắn phản hồi.</p>
                            </div>
                        </div>

                        <div style="text-align: center; margin: 20px 0;">
                            <img src="<?php echo base_url(); ?>images/guide/c3_1.png" style="max-width: 1000px; height: auto; border: 1px solid #e6e9ed; border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);max-width: 1000px;" />
                            <div style="font-size: 13px; font-style: italic; color: #73879c; margin-top: 6px;"><i class="fa fa-camera"></i> Màn hình tiếp nhận form gửi yêu cầu Ticket hỗ trợ nhanh từ ngoài website</div>
                        </div>

                        <h3 style="font-size: 15px; font-weight: 600; color: #222; margin: 25px 0 12px 0; padding-left: 8px; border-left: 3px solid #1abb9c;">3.1 Quản Lý Bảng Danh Sách Ticket Tập Trung</h3>
                        <p>Nhân viên vào phân hệ quản lý để nắm bắt tổng số lượng yêu cầu đang chờ xử lý. Nhấp chuột vào nút <strong>"Chi tiết" (Màu vàng)</strong> để tiến vào không gian hội thoại riêng biệt với khách:</p>

                        <div style="text-align: center; margin: 20px 0;">
                            <img src="<?php echo base_url(); ?>images/guide/c3_2.png" style="max-width: 1000px; height: auto; border: 1px solid #e6e9ed; border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);" />
                            <div style="font-size: 13px; font-style: italic; color: #73879c; margin-top: 6px;"><i class="fa fa-camera"></i> Bảng tra cứu điều phối trạng thái danh sách Ticket của khách hàng</div>
                        </div>

                        <h3 style="font-size: 15px; font-weight: 600; color: #222; margin: 25px 0 12px 0; padding-left: 8px; border-left: 3px solid #1abb9c;">3.2 Không Gian Bản Ghi Chi Tiết &amp; Viết Tin Nhắn Phản Hồi</h3>
                        <p>Tại giao diện xử lý chi tiết, quy trình phản hồi và cập nhật tiến độ cho khách hàng tuân thủ theo các bước sau:</p>
                        
                        <div style="text-align: center; margin: 20px 0;">
                            <img src="<?php echo base_url(); ?>images/guide/c3_3.png" style="max-width: 1000px; height: auto; border: 1px solid #e6e9ed; border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);" />
                            <div style="font-size: 13px; font-style: italic; color: #73879c; margin-top: 6px;"><i class="fa fa-camera"></i> Biểu mẫu tương tác phản hồi văn bản và dịch chuyển nấc tiến độ xử lý</div>
                        </div>

                        <ol style="padding-left: 20px;">
                            <li style="margin-bottom: 8px;"><strong>Xem file minh chứng :</strong> Nhấp chọn nút <strong>"Xem tài liệu chứng từ gửi kèm"</strong> để mở file ảnh lỗi hóa đơn hoặc giấy tờ tùy thân do khách tải lên.</li>
                            <li style="margin-bottom: 8px;"><strong>Viết tin nhắn phản hồi :</strong> Nhập câu trả lời giải đáp hoặc thông báo tiến trình xác minh vào ô văn bản <em>"Tin nhắn phản hồi"</em>.</li>
                            <li style="margin-bottom: 8px;"><strong>Cập nhật trạng thái tiến độ :</strong> Chọn nấc phân loại tương ứng (Mới tiếp nhận, Đang xử lý, Đã giải quyết) để đồng bộ đổi màu nhãn mác biểu thị tiến độ hệ thống.</li>
                        </ol>

                        <div style="text-align: center; margin: 20px 0;">
                            <img src="<?php echo base_url(); ?>images/guide/c3_4.png" style="max-width: 100%; height: auto; border: 1px solid #e6e9ed; border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);" />
                            <div style="font-size: 13px; font-style: italic; color: #73879c; margin-top: 6px;"><i class="fa fa-camera"></i> Màn hình tra cứu trục lộ trình phản hồi thực tế của khách hàng ngoài website</div>
                        </div>

                        <div style="background-color: #e8f4f8; border-left: 4px solid #3498db; padding: 15px; margin: 20px 0; border-radius: 4px; font-size: 13.5px;">
                            <i class="fa fa-info-circle" style="color: #3498db; margin-right: 5px;"></i> 
                            <strong>Cơ chế đồng bộ Timeline thông minh:</strong> Khi nhân viên bấm nút <strong>"Cập nhật xử lý" (Màu xanh dương)</strong>, hệ thống sẽ tự động tổng hợp thông điệp và chèn thêm một bước sự kiện mới vào trục Timeline tra cứu của khách hàng ngoài website. Khách hàng chỉ cần lưu lại đường dẫn URL duy nhất này là có thể tự động kiểm tra tiến độ giải quyết sự cố 24/7 một cách minh bạch.
                        </div>
                    </div>
                </div>
				
				<div class="x_panel" style="border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px; padding: 20px;">
                    <div class="x_title" style="border-bottom: 2px solid #e6e9ed; padding-bottom: 10px; margin-bottom: 20px;">
                        <h2 style="font-size: 18px; font-weight: 700; color: #2c3e50; margin: 0;">
                            <i class="fa fa-envelope-o text-success"></i> PHẦN 4: HỆ THỐNG EMAIL &amp; GỬI THÔNG BÁO
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="x_content" style="font-size: 14px; color: #4f5f6f; line-height: 1.75;">
                        <p>Hệ thống Email và Bản tin đóng vai trò là kênh thu thập thông tin và quảng bá rổ hàng độc quyền. Cơ chế hoạt động liên kết trực tiếp giữa "Phễu gom khách" ngoài trang chủ và "Hộp điều khiển" chiến dịch trong trang nội bộ:</p>
                        
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 20px 0;">
                            <div style="padding: 15px; background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 4px;">
                                <h4 style="font-size: 14px; font-weight: 700; color: #16a34a; margin-top: 0; margin-bottom: 10px;"><i class="fa fa-desktop"></i> Ngoài Trang Chủ (Khách Hàng Đăng Ký)</h4>
                                <p style="margin: 0;">Khách xem trang chủ muốn nhận tin bất động sản sớm nhất sẽ gõ địa chỉ hòm thư vào khung <strong>"Đăng Ký Nhận Bản Tin BĐS Độc Quyền"</strong>. Hệ thống ghi nhận và báo popup thành công.</p>
                            </div>
                            <div style="padding: 15px; background-color: #f0f7ff; border: 1px solid #bfdbfe; border-radius: 4px;">
                                <h4 style="font-size: 14px; font-weight: 700; color: #1d4ed8; margin-top: 0; margin-bottom: 10px;"><i class="fa fa-sliders"></i> Trong Hệ Thống CMS (Ban Quản Trị)</h4>
                                <p style="margin: 0;">Hòm thư của khách lập tức đồng bộ về bảng dữ liệu. Quản trị viên sử dụng khung soạn thảo để truyền phát thư quảng cáo hàng loạt đến toàn bộ data khách hàng.</p>
                            </div>
                        </div>

                        <div style="text-align: center; margin: 20px 0;">
                            <img src="<?php echo base_url(); ?>images/guide/c4_1.png" style="max-width: 1000px; height: auto; border: 1px solid #e6e9ed; border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);" />
                            <div style="font-size: 13px; font-style: italic; color: #73879c; margin-top: 6px;"><i class="fa fa-camera"></i> Vùng thu thập email đăng ký nhận tin bản tin tự động ngoài website</div>
                        </div>

                        <h3 style="font-size: 15px; font-weight: 600; color: #222; margin: 25px 0 12px 0; padding-left: 8px; border-left: 3px solid #1abb9c;">4.1 Tổng Quan Giao Diện Trung Tâm Bản Tin Điều Khiển Tập Trung</h3>
                        <p>Khi bấm vào mục menu <strong>"Hệ Thống Email &amp; Bản Tin"</strong> trên thanh điều hướng, màn hình quản lý được chia làm 2 khu vực nghiệp vụ riêng biệt trái — phải vô cùng trực quan:</p>

                        <div style="text-align: center; margin: 20px 0;">
                            <img src="<?php echo base_url(); ?>images/guide/c4_2.png" style="max-width: 1000px; height: auto; border: 1px solid #e6e9ed; border-radius: 4px; box-shadow: 0 2px 8px rgba(0,0,0,0.06);" />
                            <div style="font-size: 13px; font-style: italic; color: #73879c; margin-top: 6px;"><i class="fa fa-camera"></i> Màn hình trung tâm quản lý danh sách email và kích hoạt chiến dịch marketing</div>
                        </div>

                        <h3 style="font-size: 15px; font-weight: 600; color: #222; margin: 25px 0 12px 0; padding-left: 8px; border-left: 3px solid #1abb9c;">4.2 Quản Lý Danh Sách Khách Hàng &amp; Dọn Dẹp Dữ Liệu</h3>
                        <p>Nằm tại khối bên phải của màn hình, đây là nơi lưu trữ toàn bộ nguồn tài nguyên dữ liệu email thu thập được từ người dùng. Các tác vụ vận hành bao gồm:</p>
                        <ul style="padding-left: 20px; margin-bottom: 15px;">
                            <li style="margin-bottom: 8px;"><strong>Sử dụng thanh bộ lọc nhanh :</strong> Gõ một phần ký tự vào ô <em>"Tìm địa chỉ email..."</em> hoặc chọn lọc theo hộp thả xuống <em>"Trạng thái"</em> để bốc tách nhanh nhóm khách mong muốn, sau đó nhấn nút <strong>Tìm kiếm</strong>.</li>
                            <li style="margin-bottom: 8px;"><strong>Đối soát thông tin mốc thời gian :</strong> Cột <em>"Thời gian đăng ký"</em> ghi nhận chi tiết thời điểm khách bấm nút đăng ký giúp bạn đánh giá hiệu quả của các chiến dịch marketing theo từng thời điểm.</li>
                            <li style="margin-bottom: 8px;"><strong>Xóa email lỗi thời :</strong> Nếu phát hiện email rác hoặc địa chỉ thư không có thật, bạn nhấp vào nút <strong>"Xóa" (Nhãn màu đỏ)</strong> ở cuối dòng để loại bỏ hoàn toàn email đó ra khỏi cơ sở dữ liệu hệ thống.</li>
                        </ul>

                        <h3 style="font-size: 15px; font-weight: 600; color: #222; margin: 25px 0 12px 0; padding-left: 8px; border-left: 3px solid #1abb9c;">4.3 Quy Trình Soạn Thảo Và Phát Động Chiến Dịch Gửi Thư Hàng Loạt</h3>
                        <p>Tại khối bên trái <strong>"GỬI EMAIL HÀNG LOẠT"</strong>, người vận hành thực hiện quyền soạn thảo văn bản để gửi đi thông điệp quảng cáo đồng thời đến tất cả các email đang ở trạng thái hoạt động trong danh sách:</p>

                        <ol style="padding-left: 20px; margin-bottom: 15px;">
                            <li style="margin-bottom: 8px;"><strong>Nhập tiêu đề bản tin :</strong> Viết dòng chủ đề ngắn gọn, cuốn hút xuất hiện trong hộp thư đến của khách <em>(Ví dụ: "Cập nhật rổ hàng biệt thự Mini Quận 9 giá tốt tháng này...")</em>.</li>
                            <li style="margin-bottom: 8px;"><strong>Biên tập thân bài văn bản :</strong> Ô nhập liệu <em>"Nội dung chi tiết Bản tin"</em> hỗ trợ chèn cả các thẻ định dạng văn bản tiêu chuẩn <code>HTML</code> thô. Bạn hoàn toàn có thể bôi đậm chữ, xuống dòng hoặc chèn liên kết link hình ảnh sản phẩm để thư gửi đi nhìn sinh động, chuyên nghiệp hơn.</li>
                            <li style="margin-bottom: 8px;"><strong>Bấm nút truyền phát chiến dịch :</strong> Nhấp chuột vào nút lớn <strong>"Kích hoạt gửi chiến dịch ngay" (Màu xanh ngọc)</strong>. Hệ thống sẽ hiện bảng hỏi xác nhận của trình duyệt để ngăn ngừa việc vô tình bấm nhầm. Nhấn <strong>OK</strong> để máy chủ quét vòng lặp và tự động gửi lần lượt đến toàn bộ khách hàng.</li>
                        </ol>

                        <div style="background-color: #fef2f2; border-left: 4px solid #ef4444; padding: 15px; margin: 20px 0; border-radius: 4px; font-size: 13.5px; color: #7f1d1d;">
                            <i class="fa fa-exclamation-triangle" style="color: #ef4444; margin-right: 5px;"></i> 
                            <strong>Nguyên tắc vận hành an toàn cho Email Thương Hiệu:</strong> Hệ thống đã được lập trình cơ chế tự động hóa loại trừ thông minh. Khi quét vòng lặp gửi thư, máy chủ sẽ tự động bỏ qua toàn bộ những email có nhãn trạng thái là <code>Đã hủy nhận</code> (do khách hàng chủ động từ chối nhận tin bài từ trước). Ban quản trị tuyệt đối không được xóa nhãn từ chối này thủ công, việc cố tình gửi thư đến người đã từ chối sẽ khiến hòm thư thương hiệu của công ty bị Gmail đánh dấu thư rác, ảnh hưởng nghiêm trọng đến uy tín tên miền.
                        </div>
                    </div>
                </div>

                <!-- PHẦN 5: QUY TRÌNH TIẾP NHẬN, THẨM ĐỊNH ĐA PHÒNG BAN & PHÊ DUYỆT HỒ SƠ TRỰC TUYẾN -->
                <div class="x_panel" style="border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px; padding: 20px; border-left: 4px solid #0284c7;">
                    <div class="x_title" style="border-bottom: 2px solid #e6e9ed; padding-bottom: 10px; margin-bottom: 20px;">
                        <h2 style="font-size: 18px; font-weight: 700; color: #0369a1; margin: 0;">
                            <i class="fa fa-file-text-o text-primary"></i> PHẦN 5: QUY TRÌNH TIẾP NHẬN, THẨM ĐỊNH ĐA PHÒNG BAN &amp; PHÊ DUYỆT HỒ SƠ TRỰC TUYẾN
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="x_content" style="font-size: 14px; color: #4f5f6f; line-height: 1.75;">
                        <p>Hệ thống Cổng Dịch Vụ &amp; Thẩm Định Hồ Sơ Trực Tuyến giúp chuyển đổi số toàn diện quy trình nộp, xét duyệt hồ sơ giấy truyền thống thành quy trình điện tử minh bạch, khép kín giữa <strong>Khách hàng / Đối tác thuê</strong>, <strong>Các phòng ban chuyên môn</strong> và <strong>Ban Quản Lý Tòa Nhà</strong>:</p>

                        <!-- Mô hình 3 chặng khép kín -->
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 15px; margin: 20px 0;">
                            <div style="padding: 16px; background-color: #f8fafc; border: 1.5px solid #0284c7; border-radius: 6px;">
                                <div style="font-size: 14px; font-weight: 700; color: #0284c7; margin-bottom: 8px;">
                                    <i class="fa fa-cloud-upload"></i> CHẶNG 1: KHÁCH HÀNG
                                </div>
                                <p style="margin: 0; font-size: 13.5px;">Khách hàng chọn loại hồ sơ, tải biểu mẫu chuẩn, điền thông tin và đính kèm bản vẽ/tài liệu scan gửi trực tuyến 24/7. Nhận mã định danh hồ sơ để theo dõi tiến độ.</p>
                            </div>
                            <div style="padding: 16px; background-color: #f8fafc; border: 1.5px solid #ea580c; border-radius: 6px;">
                                <div style="font-size: 14px; font-weight: 700; color: #ea580c; margin-bottom: 8px;">
                                    <i class="fa fa-users"></i> CHẶNG 2: THẨM ĐỊNH SONG SONG
                                </div>
                                <p style="margin: 0; font-size: 13.5px;">Các phòng ban chuyên môn (Kỹ thuật, PCCC, Kế toán, Ban Quản lý...) tự động nhận hồ sơ, kiểm tra tài liệu và ký duyệt độc lập, đồng thời trên cùng một hồ sơ.</p>
                            </div>
                            <div style="padding: 16px; background-color: #f8fafc; border: 1.5px solid #16a34a; border-radius: 6px;">
                                <div style="font-size: 14px; font-weight: 700; color: #16a34a; margin-bottom: 8px;">
                                    <i class="fa fa-check-circle"></i> CHẶNG 3: QUẢN TRỊ DUYỆT &amp; BAN HÀNH
                                </div>
                                <p style="margin: 0; font-size: 13.5px;">Khi tất cả các phòng ban đã thẩm định đạt yêu cầu, Ban Quản Lý đưa ra quyết định phê duyệt cuối cùng, đính kèm văn bản có dấu và hoàn tất hồ sơ cho khách.</p>
                            </div>
                        </div>

                        <!-- 5.1 Dành cho Khách hàng -->
                        <h3 style="font-size: 15.5px; font-weight: 700; color: #0f172a; margin: 30px 0 12px 0; padding-left: 10px; border-left: 4px solid #0284c7;">
                            5.1. Dành Cho Khách Hàng: Nộp Hồ Sơ &amp; Tra Cứu Tiến Độ Trực Tuyến
                        </h3>
                        <p>Khách hàng và các đơn vị thuê mặt bằng thao tác hoàn toàn trên cổng dịch vụ công khai bên ngoài website:</p>

                        <div style="text-align: center; margin: 20px 0;">
                            <img src="<?php echo base_url(); ?>images/guide/tham_dinh/1.png" style="max-width: 100%; height: auto; border: 1px solid #e2e8f0; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);" />
                            <div style="font-size: 13px; font-style: italic; color: #64748b; margin-top: 8px;"><i class="fa fa-camera"></i> Hình 1: Cổng nộp hồ sơ &amp; đăng ký dịch vụ trực tuyến dành cho khách hàng</div>
                        </div>

                        <ul style="padding-left: 20px;">
                            <li style="margin-bottom: 8px;">
                                <strong>Bước 1 - Tải Biểu Mẫu Chuẩn:</strong> Tại trang nộp hồ sơ, khách hàng nhấp vào từng danh mục (Thuê mặt bằng, Thi công nội thất, Sửa chữa kỹ thuật, Tổ chức sự kiện...) để tải về tệp biểu mẫu PDF chuẩn theo quy định của tòa nhà.
                            </li>
                            <li style="margin-bottom: 8px;">
                                <strong>Bước 2 - Điền Thông Tin &amp; Gửi Tệp Đính Kèm:</strong> Nhập họ tên, số điện thoại, email nhận kết quả, nội dung đề xuất và tải lên bản vẽ/tài liệu scan (định dạng PDF, JPG, PNG dung lượng đến 20MB).
                            </li>
                            <li style="margin-bottom: 8px;">
                                <strong>Bước 3 - Nhận Mã Hồ Sơ Tra Cứu:</strong> Sau khi nộp thành công, hệ thống cấp ngay một <strong>Mã Hồ Sơ độc quyền</strong> (Ví dụ: <code>#HS-2026-0001</code>).
                            </li>
                        </ul>

                        <div style="text-align: center; margin: 20px 0;">
                            <img src="<?php echo base_url(); ?>images/guide/tham_dinh/2.png" style="max-width: 100%; height: auto; border: 1px solid #e2e8f0; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);" />
                            <div style="font-size: 13px; font-style: italic; color: #64748b; margin-top: 8px;"><i class="fa fa-camera"></i> Hình 2: Màn hình theo dõi tiến độ thẩm định trực quan của khách hàng theo thời gian thực</div>
                        </div>

                        <p>Khách hàng có thể truy cập mục <strong>"Tra Cứu Hồ Sơ"</strong>, nhập mã hồ sơ và số điện thoại bất cứ lúc nào để xem tiến độ thẩm định của từng phòng ban, nhận thông báo bổ sung giấy tờ nếu có và tải văn bản kết quả đã được Ban Quản Lý phê duyệt.</p>

                        <!-- 5.2 Dành cho Chuyên viên Thẩm định -->
                        <h3 style="font-size: 15.5px; font-weight: 700; color: #0f172a; margin: 30px 0 12px 0; padding-left: 10px; border-left: 4px solid #ea580c;">
                            5.2. Dành Cho Chuyên Viên Thẩm Định Phòng Ban: Tiếp Nhận &amp; Ký Duyệt Chuyên Môn
                        </h3>
                        <p>Mỗi nhân viên thuộc phòng ban nào (Kỹ thuật, Pháp lý, An ninh...) khi đăng nhập vào hệ thống CMS sẽ chỉ thấy và xử lý các hồ sơ được phân công cho phòng ban của mình:</p>

                        <div style="text-align: center; margin: 20px 0;">
                            <img src="<?php echo base_url(); ?>images/guide/tham_dinh/3.png" style="max-width: 100%; height: auto; border: 1px solid #e2e8f0; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);" />
                            <div style="font-size: 13px; font-style: italic; color: #64748b; margin-top: 8px;"><i class="fa fa-camera"></i> Hình 3: Danh sách các hồ sơ đang chờ thẩm định tại "Cổng Thẩm Định Phòng Ban"</div>
                        </div>

                        <ul style="padding-left: 20px;">
                            <li style="margin-bottom: 8px;">
                                <strong>Xem Danh Sách Chờ Thẩm Định:</strong> Vào mục <em>"Thẩm Định &amp; Phê Duyệt" ➔ "Cổng Thẩm Định Phòng Ban"</em>. Bảng dữ liệu tự động lọc ra các hồ sơ mà phòng ban của bạn cần thẩm định.
                            </li>
                            <li style="margin-bottom: 8px;">
                                <strong>Mở Xem Trực Tiếp Tài Liệu &amp; Bản Vẽ:</strong> Nhấp vào nút <strong>"Thẩm Định Hồ Sơ"</strong>. Khung xem tài liệu bên trái cho phép bạn duyệt trực tiếp các file PDF nhiều trang, bản vẽ hoặc hình ảnh đính kèm ngay trên trình duyệt mà không cần tốn thời gian tải về máy tính.
                            </li>
                        </ul>

                        <div style="text-align: center; margin: 20px 0;">
                            <img src="<?php echo base_url(); ?>images/guide/tham_dinh/4.png" style="max-width: 100%; height: auto; border: 1px solid #e2e8f0; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);" />
                            <div style="font-size: 13px; font-style: italic; color: #64748b; margin-top: 8px;"><i class="fa fa-camera"></i> Hình 4: Giao diện xem tài liệu và thực hiện thao tác thẩm định (Phê duyệt / Từ chối)</div>
                        </div>

                        <ol style="padding-left: 20px;">
                            <li style="margin-bottom: 8px;">
                                <strong>Trường hợp 1 - Hồ sơ đạt yêu cầu:</strong> Nhấp nút <span class="badge badge-success" style="background:#16a34a; font-size:12px; padding:4px 8px;"><i class="fa fa-check"></i> PHÊ DUYỆT THÔNG QUA (APPROVE)</span>. Bước thẩm định của phòng ban bạn sẽ lập tức chuyển màu xanh đã duyệt.
                            </li>
                            <li style="margin-bottom: 8px;">
                                <strong>Trường hợp 2 - Hồ sơ chưa đạt / Cần sửa đổi bổ sung:</strong> Nhấp nút <span class="badge badge-danger" style="background:#dc2626; font-size:12px; padding:4px 8px;"><i class="fa fa-times"></i> TỪ CHỐI HỒ SƠ (REJECT)</span>. Hộp thoại bắt buộc nhập <strong>Lý do từ chối</strong> chi tiết (Ví dụ: <em>"Bản vẽ PCCC thiếu vị trí bình chữa cháy tự động, đề nghị bổ sung"</em>) để gửi phản hồi rõ ràng cho khách hàng điều chỉnh.
                            </li>
                        </ol>

                        <!-- 5.3 Dành cho Ban Quản trị -->
                        <h3 style="font-size: 15.5px; font-weight: 700; color: #0f172a; margin: 30px 0 12px 0; padding-left: 10px; border-left: 4px solid #16a34a;">
                            5.3. Dành Cho Ban Quản Trị: Phê Duyệt Cấp Cuối &amp; Quyền Can Thiệp Khẩn Cấp
                        </h3>
                        <p>Tài khoản Quản trị viên (Admin / Lãnh đạo) nắm giữ quyền quyết định cao nhất trong toàn bộ vòng đời hồ sơ:</p>

                        <div style="text-align: center; margin: 20px 0;">
                            <img src="<?php echo base_url(); ?>images/guide/tham_dinh/5.png" style="max-width: 100%; height: auto; border: 1px solid #e2e8f0; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);" />
                            <div style="font-size: 13px; font-style: italic; color: #64748b; margin-top: 8px;"><i class="fa fa-camera"></i> Hình 5: Khu vực Phê duyệt Cấp Quản Trị và Quyền Can Thiệp Khẩn Cấp (Admin Override)</div>
                        </div>

                        <ul style="padding-left: 20px;">
                            <li style="margin-bottom: 10px;">
                                <strong>Phê Duyệt Chính Thức (Admin Review):</strong> Khi 100% các phòng ban chuyên môn liên quan đều đã bấm duyệt thông qua, hồ sơ tự động kích hoạt khung <strong>"PHÊ DUYỆT CẤP QUẢN TRỊ"</strong>. Admin tải lên tệp văn bản chính thức đã đóng dấu xác nhận (PDF), nhập lời nhắn phản hồi và nhấn <strong>"THÔNG QUA (APPROVED)"</strong>. Hồ sơ chính thức chuyển trạng thái <span class="badge badge-success" style="background:#16a34a;">HOÀN TẤT</span>.
                            </li>
                            <li style="margin-bottom: 10px;">
                                <strong>Cơ Chế Can Thiệp Đặc Biệt (Admin Override):</strong> Dành cho các tình huống khẩn cấp theo chỉ đạo của Ban Giám Đốc:
                                <ul style="margin-top: 6px;">
                                    <li><strong>FORCE APPROVE (Duyệt khẩn cấp):</strong> Cho phép phê duyệt và hoàn tất hồ sơ ngay lập tức, bỏ qua các phòng ban còn lại đang chờ.</li>
                                    <li><strong>FORCE REJECT (Dừng xử lý khẩn cấp):</strong> Hủy dừng xử lý hồ sơ ngay lập tức.</li>
                                    <li><em style="color:#b91c1c;">* Ràng buộc an toàn:</em> Bắt buộc nhập đầy đủ <strong>Admin Note</strong> (Lý do can thiệp khẩn cấp). Mọi thao tác đều được hệ thống tự động ghi nhật ký kiểm toán (Audit Trail) để đối soát minh bạch.</li>
                                </ul>
                            </li>
                        </ul>

                        <!-- 5.4 Quản lý Nhân sự & Phân quyền Thẩm định theo Phòng ban -->
                        <h3 style="font-size: 15.5px; font-weight: 700; color: #0f172a; margin: 30px 0 12px 0; padding-left: 10px; border-left: 4px solid #f59e0b;">
                            5.4. Quản Lý Nhân Sự Thẩm Định: Cơ Chế Phân Quyền &amp; Tự Động Sổ Chọn Phòng Ban Trực Thuộc
                        </h3>
                        <p>Để đảm bảo nguyên tắc <em>"Đúng người - Đúng việc - Đúng thẩm quyền"</em>, hệ thống đã chuẩn hóa vai trò chuyên biệt <strong>"Chuyên viên Thẩm định Hồ sơ"</strong> kết hợp với cơ chế gán phòng ban thông minh:</p>

                        <div style="text-align: center; margin: 20px 0;">
                            <img src="<?php echo base_url(); ?>images/guide/tham_dinh/7.png" style="max-width: 100%; height: auto; border: 1px solid #e2e8f0; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);" />
                            <div style="font-size: 13px; font-style: italic; color: #64748b; margin-top: 8px;"><i class="fa fa-camera"></i> Hình 6: Giao diện Quản lý Nhân viên — Chọn vai trò Chuyên viên Thẩm định tự động sổ ra trường Phòng ban trực thuộc</div>
                        </div>

                        <div style="background-color: #fffbeb; border: 1.5px solid #fde68a; padding: 16px; margin: 20px 0; border-radius: 6px;">
                            <h4 style="font-size: 14.5px; font-weight: 700; color: #b45309; margin-top: 0; margin-bottom: 10px;">
                                <i class="fa fa-cogs"></i> Quy trình phân quyền nhân sự thẩm định trong mục [Quản Lý Nhân Viên]:
                            </h4>
                            <ol style="padding-left: 20px; margin-bottom: 0;">
                                <li style="margin-bottom: 10px;">
                                    <strong>Truy cập biểu mẫu nhân sự:</strong> Quản trị viên vào menu <em>"Thiết Lập Hệ Thống" ➔ "Quản Lý Nhân Viên"</em> ➔ Nhấp <strong>"Thêm Mới"</strong> hoặc nhấp <strong>"Sửa"</strong> tài khoản nhân viên hiện có.
                                </li>
                                <li style="margin-bottom: 10px;">
                                    <strong>Chọn phân quyền vai trò:</strong> Tại hộp chọn <em>"Phân quyền vai trò *"</em>, chọn dòng <strong>"Chuyên viên Thẩm định Hồ sơ"</strong>.
                                </li>
                                <li style="margin-bottom: 10px;">
                                    <strong>Hiệu ứng tự động mở rộng phòng ban (Dynamic UI):</strong> Ngay khi chọn vai trò thẩm định, hệ thống sẽ <strong>lập tức tự động sổ ra ô "Phòng ban trực thuộc *"</strong> (Có biểu tượng sơ đồ màu xanh dương <i class="fa fa-sitemap text-info"></i>). Quản trị viên chỉ cần chọn đúng phòng ban công tác của nhân sự đó <em>(Ví dụ: Phòng Kỹ Thuật, Ban Quản Lý, Phòng Kế Toán &amp; Pháp Lý...)</em>.
                                </li>
                                <li style="margin-bottom: 0;">
                                    <strong>Tự động ẩn với các vai trò khác:</strong> Nếu chọn các vai trò quản trị khác (như <em>Quản trị Nội dung, Quản lý Tin đăng, Quản lý Ticket, Quản lý Mail</em>), ô chọn phòng ban này sẽ <strong>tự động ẩn đi</strong>. Điều này giúp ngăn ngừa hoàn toàn việc gán nhầm lẫn chức năng, giữ biểu mẫu luôn gọn gàng và chuẩn xác.
                                </li>
                            </ol>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin: 20px 0;">
                            <div style="padding: 14px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 6px;">
                                <strong style="color:#16a34a; font-size:13.5px; display:block; margin-bottom:6px;"><i class="fa fa-shield"></i> Cơ chế cách ly dữ liệu chuyên môn:</strong>
                                Nhân viên phòng Kỹ thuật khi đăng nhập vào hệ thống sẽ <strong>chỉ nhìn thấy và chỉ được duyệt các hồ sơ thuộc trách nhiệm kỹ thuật</strong>; hoàn toàn không thể xem hoặc can thiệp vào hồ sơ của phòng Kế toán, An ninh hay các phòng ban khác.
                            </div>
                            <div style="padding: 14px; background: #f0f7ff; border: 1px solid #bfdbfe; border-radius: 6px;">
                                <strong style="color:#1d4ed8; font-size:13.5px; display:block; margin-bottom:6px;"><i class="fa fa-eye-slash"></i> Tối ưu không gian làm việc trên Menu:</strong>
                                Các tài khoản Chuyên viên Thẩm định chỉ nhìn thấy các menu liên quan trực tiếp đến công tác thẩm định. Các menu cấu hình website, bài viết, tin tức sẽ tự động được ẩn đi, giúp chuyên viên tập trung tối đa vào công việc duyệt hồ sơ.
                            </div>
                        </div>

                        <!-- 5.5 Cấu hình động Phòng ban & Loại hồ sơ -->
                        <h3 style="font-size: 15.5px; font-weight: 700; color: #0f172a; margin: 30px 0 12px 0; padding-left: 10px; border-left: 4px solid #8b5cf6;">
                            5.5. Dành Cho Quản Trị Viên: Cấu Hình Phòng Ban &amp; Loại Hồ Sơ Biểu Mẫu Linh Hoạt
                        </h3>
                        <p>Ban Quản trị hoàn toàn có thể chủ động mở rộng hoặc tùy biến luồng xét duyệt mà không phụ thuộc vào đội ngũ kỹ thuật:</p>

						<div style="text-align: center; margin: 20px 0;">
                            <img src="<?php echo base_url(); ?>images/guide/tham_dinh/8_1.png" style="max-width: 100%; height: auto; border: 1px solid #e2e8f0; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);" />
                            <div style="font-size: 13px; font-style: italic; color: #64748b; margin-top: 8px;"><i class="fa fa-camera"></i> Hình 7: Giao diện Quản trị Danh mục Phòng ban</div>
                        </div>
                        <div style="text-align: center; margin: 20px 0;">
							<img src="<?php echo base_url(); ?>images/guide/tham_dinh/8_2.png" style="max-width: 100%; height: auto; border: 1px solid #e2e8f0; border-radius: 6px; box-shadow: 0 4px 12px rgba(0,0,0,0.08);" />
                            <div style="font-size: 13px; font-style: italic; color: #64748b; margin-top: 8px;"><i class="fa fa-camera"></i> Hình 8: Thiết lập loại Hồ sơ cùng luồng Phòng ban được phép duyệt song song</div>
                        </div>

                        <ul style="padding-left: 20px;">
                            <li style="margin-bottom: 8px;">
                                <strong>Quản Lý Phòng Ban ([Thiết Lập Hệ Thống ➔ Quản Lý Phòng Ban]):</strong> 
                                Thêm mới các phòng ban thẩm định, đặt mã định danh (Ví dụ: <code>DEPT_KT</code>, <code>DEPT_BQL</code>), cấu hình <strong>ID nhóm Telegram nhận thông báo</strong> (Ví dụ: <code>-1005521381147</code>), mô tả chi tiết chức năng thẩm định và theo dõi số lượng nhân sự đang trực thuộc cũng như số lượng hồ sơ đang chờ duyệt của từng phòng.
                                <br/><em style="color:#b91c1c; font-size:12.5px;"><i class="fa fa-lock"></i> Ràng buộc an toàn: Hệ thống sẽ tự động chặn xóa nếu phòng ban đó đang có nhân viên trực thuộc hoặc đang có hồ sơ đang trong tiến trình thẩm định.</em>
                            </li>
                            <li style="margin-bottom: 8px;">
                                <strong>Cấu Hình Loại Hồ Sơ ([Thẩm Định &amp; Phê Duyệt ➔ Cấu Hình Loại Hồ Sơ &amp; Biểu Mẫu]):</strong>
                                Tải lên tệp biểu mẫu PDF chuẩn mới, tích chọn các phòng ban cần tham gia thẩm định song song cho từng loại thủ tục. Khi khách hàng nộp loại hồ sơ này, hệ thống sẽ tự động điều phối hồ sơ đến đúng các phòng ban đã chọn.
                            </li>
                        </ul>

                        <div style="background-color: #ecfdf5; border-left: 4px solid #10b981; padding: 15px; margin: 25px 0 10px 0; border-radius: 4px; font-size: 13.5px; color: #065f46;">
                            <i class="fa fa-lightbulb-o" style="color: #10b981; font-size: 16px; margin-right: 5px;"></i> 
                            <strong>Tóm lược lợi ích vận hành:</strong> Nhờ cơ chế duyệt song song và theo dõi trực quan theo thời gian thực, quy trình thẩm định hồ sơ tại Pico Plaza giảm thiểu 80% thời gian xử lý thủ tục giấy tờ, loại bỏ nguy cơ thất lạc hồ sơ và nâng cao tính chuyên nghiệp, hài lòng cho đối tác thuê mặt bằng.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php
	$this->load->view('modules/mod_footer');
	$this->load->view('footer');
?>