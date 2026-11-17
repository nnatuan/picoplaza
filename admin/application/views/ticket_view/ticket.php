<style>
  .meta-ticket-panel { background: #f8fafc; border: 1px solid #e2e8f0; padding: 15px; margin-bottom: 20px; }
  .meta-ticket-panel table { width: 100%; }
  .meta-ticket-panel td { padding: 5px 10px; font-size: 14px; color: #1e293b; }
  .meta-ticket-panel td.title-lbl { font-weight: 700; color: #64748b; width: 150px; text-transform: uppercase; font-size: 12px; }
  .cust-msg-box { background: #fff; border-left: 3px solid #b65c38; padding: 12px 15px; font-size: 14px; line-height: 1.6; margin-bottom: 25px; white-space: pre-line; color: #0f172a; }
  
  .box-timeline-flow { list-style: none; padding: 0; margin: 15px 0; position: relative; }
  .box-timeline-flow::before { content: ""; position: absolute; left: 16px; top: 0; bottom: 0; width: 2px; background: #e2e8f0; }
  .box-timeline-flow li { position: relative; padding-left: 40px; margin-bottom: 15px; font-size: 13.5px; }
  .node-dot { position: absolute; left: 11px; top: 4px; width: 12px; height: 12px; border-radius: 50%; background: #cbd5e1; border: 2px solid #fff; }
  .box-timeline-flow li.staff-rep .node-dot { background: #c9973f; }
  .box-timeline-flow li.cust-rep .node-dot { background: #3f6b57; }
  .node-time { font-family: 'JetBrains Mono', monospace; font-size: 11px; color: #94a3b8; }
  .node-msg-body { background: #f8fafc; padding: 10px 14px; border-radius: 2px; border: 1px solid #e2e8f0; display: inline-block; max-width: 100%; margin-top: 4px; }
</style>

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><small></small></h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><?php echo $lbl_form_title; ?></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <?php if(!empty($m_message)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $m_message; ?>
                            </div>
                        <?php endif; ?>

                        <form name='form_main' method="post" action="<?php echo $link_page; ?>">
                            
                            <div class="meta-ticket-panel">
                                <table>
                                    <tr>
                                        <td class="title-lbl">Mã số Ticket:</td>
                                        <td style="font-family:'JetBrains Mono',monospace; font-weight:700; color:#a9782a;">#<?php echo $ticket['cticket_code']; ?></td>
                                        <td class="title-lbl">Thời gian nhận:</td>
                                        <td style="color:#64748b;"><?php echo date('H:i:s d/m/Y', strtotime($ticket['dcreated_at'])); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="title-lbl">Tên khách hàng:</td>
                                        <td><strong><?php echo Fview_text($ticket['cname']); ?></strong></td>
                                        <td class="title-lbl">Địa chỉ Email:</td>
                                        <td><?php echo $ticket['cemail']; ?></td>
                                    </tr>
                                    <tr>
                                        <td class="title-lbl">Tệp đính kèm:</td>
                                        <td colspan="3">
                                            <?php if(!empty($ticket['cfile_attach'])): ?>
                                                <a href="<?php echo str_replace('admin/', '', base_url()); ?>upload/tickets/<?php echo $ticket['cfile_attach']; ?>" target="_blank" class="btn btn-secondary btn-sm" style="padding:2px 8px; font-size:12px; margin:0;">
													<i class="fa fa-paperclip"></i> Xem tài liệu chứng từ gửi kèm
												</a>
                                            <?php else: ?>
                                                <span class="text-muted" style="font-style:italic; font-size:13px;">Khách hàng không tải lên tài liệu nào.</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <h4 style="font-size:16px; font-weight:700; color:#0f172a; margin-bottom:8px;">
                                <i class="fa fa-folder-open text-muted"></i> Tiêu đề : <?php echo Fview_text($ticket['ctitle']); ?>
                            </h4>
                            <div class="cust-msg-box"><?php echo Fview_text($ticket['ccontent']); ?></div>

                            <!-- TRỤC TIMELINE ĐÃ UPDATE HIỂN THỊ HỌ TÊN + SĐT KHÁCH HÀNG & TÊN NHÂN VIÊN -->
<h4 style="font-size:15px; font-weight:700; color:#0f172a; margin-top:25px;">
    <i class="fa fa-clock text-muted"></i> Trục Timeline tiến độ & Lịch sử trao đổi qua lại
</h4>

<ul class="box-timeline-flow">
    <?php foreach($ticket_logs as $log): 
        $is_staff = ($log['cis_staff_reply'] == '1');
        
        if ($is_staff) {
            // Tên Nhân viên phản hồi (Lấy từ bảng tuser qua JOIN)
            $author_name = !empty($log['staff_name']) ? '💼 ' . Fview_text($log['staff_name']) . ' (NV Hỗ trợ)' : '💼 Ban Quản Trị Hệ Thống';
        } else {
            // Họ tên + SĐT Khách hàng (Lấy từ mảng $ticket)
            $cust_name  = !empty($ticket['cname']) ? Fview_text($ticket['cname']) : 'Khách hàng';
            $cust_phone = !empty($ticket['cphone']) ? ' — 📞 ' . Fview_text($ticket['cphone']) : '';
            
            $author_name = '👤 ' . $cust_name . $cust_phone;
        }
    ?>
        <li class="<?php echo $is_staff ? 'staff-rep' : 'cust-rep'; ?>">
            <div class="node-dot"></div>
            <div>
                <strong><?php echo $author_name; ?></strong>
                <div class="node-time"><?php echo date('d/m/Y — H:i', strtotime($log['dreply_at'])); ?></div>
                <div class="node-msg-body"><?php echo Fview_text($log['ccontent_reply']); ?></div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>

                            <div class="ln_solid" style="margin: 25px 0;"></div>

                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align"><strong>Cập nhật trạng thái</strong></label>
                                <div class="col-md-8 col-sm-8 ">
                                    <?php echo $gen_cbo_status; ?>
                                </div>	
                            </div>
                            
                            <div class="item form-group">
                                <label class="col-form-label col-md-2 col-sm-2 label-align"><strong>Tin nhắn phản hồi</strong></label>
                                <div class="col-md-8 col-sm-8 ">
                                    <textarea class="form-control" name="txt_content_reply" rows="4" placeholder="Nhập nội dung văn bản phản hồi, giải đáp thắc mắc hoặc thông báo quy trình xử lý để khách hàng có thể tra cứu theo dõi ..."></textarea>
                                    <small class="text-muted" style="margin-top:5px; display:block;">* Lưu ý: Khi gửi phản hồi, hệ thống sẽ ghi nhận đích danh tài khoản của bạn vào lịch sử xử lý.</small>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            
                            <div class="item form-group">
                                <div class="col-md-8 col-sm-8 offset-md-2">
                                    <button type="button" class="btn btn-primary" name="btn_submit" value="<?php echo $btn_update; ?>" 
                                        onclick="js_SetSubmitButtonClick(this.form, this.name);">Cập nhật xử lý</button>
                                    <button class="btn btn-danger" type="button" name="btn_cancel" value="<?php echo $btn_cancel; ?>" 
                                        onclick="location.href='<?php echo $link_cancel; ?>'">Quay về danh sách</button>
                                </div>
                            </div>

                            <input name="hidden_nid" type="hidden" value="<?php echo $nid; ?>" />
                            <input name="hidden_event" type="hidden" value="<?php echo $event; ?>" />
                            <input type="hidden" name="hidden_button" value="" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>