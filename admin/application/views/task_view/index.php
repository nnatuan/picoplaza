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
        <div class="x_panel" style="border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); margin-bottom: 25px; padding: 20px;">
            <div class="x_title" style="border-bottom: 2px solid #e6e9ed; padding-bottom: 10px; margin-bottom: 20px;">
                <h2 style="font-size: 16px; font-weight: 700; color: #2c3e50; margin: 0;">
                    <i class="fa fa-bell text-danger"></i> DANH SÁCH CÔNG VIỆC NHẮC NHỞ NỘI BỘ
                </h2>
                <div class="clearfix"></div>
            </div>
            
            <div class="x_content">
                <table class="table table-striped table-bordered" style="font-size: 13.5px; width:100%;">
                    <thead>
                        <tr style="background-color: #f9fafb;">
                            <th style="width: 6%; text-align: center;">STT</th>
                            <th>Nội dung chi tiết công việc cần xử lý</th>
                            <th style="width: 18%; text-align: center;">Hạn hoàn thành</th>
                            <th style="width: 15%; text-align: center;">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($tasks)): $stt=1; foreach($tasks as $row): ?>
                            <tr>
                                <td style="text-align: center; vertical-align: middle;"><?php echo $stt++; ?></td>
                                <td style="vertical-align: middle;">
                                    <strong style="color: #b65c38; font-size:14px;"><?php echo htmlspecialchars($row['ctitle']); ?></strong>
                                    <?php if(!empty($row['cdescription'])): ?>
                                        <br><small style="color: #73879c; margin-top: 4px; display:block;"><?php echo htmlspecialchars($row['cdescription']); ?></small>
                                    <?php endif; ?>
                                </td>
                                <td style="text-align: center; vertical-align: middle; font-family: 'JetBrains Mono', monospace; font-weight:600;">
                                    <?php echo date('d/m/Y', strtotime($row['ddue_date'])); ?>
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    <?php if((int)$row['nstatus'] === 0): ?>
                                        <span class="badge" style="background:#94a3b8;color:#fff;">Chưa làm</span>
                                    <?php else: ?>
                                        <span class="badge" style="background:#c9973f;color:#fff;">Đang làm</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; else: ?>
                            <tr>
                                <td colspan="4" style="text-align: center; color: #73879c; font-style: italic; padding: 30px;">
                                    Tuyệt vời! Hiện tại bạn đã hoàn thành toàn bộ công việc được giao.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
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