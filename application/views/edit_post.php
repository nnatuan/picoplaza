<?php 
   $this->load->view('header');
   $this->load->view('header_end');	
   $this->load->view('modules/mod_header');
?>
<style>
  .post-container { max-width: 860px; margin: 40px auto; padding: 0 20px; }
  .post-card { background: var(--card); border: 1px solid var(--line); border-top: 3px solid var(--gold); border-radius: var(--radius); padding: 40px; box-shadow: 0 15px 35px rgba(0,0,0,0.03); }
  .post-card h2 { font-size: 26px; margin-bottom: 8px; display: flex; align-items: center; gap: 10px; }
  .post-card h2 i { color: var(--brick); font-size: 22px; }
  .post-card .lede { font-size: 14px; color: var(--text-soft); margin-bottom: 32px; border-bottom: 1px dashed var(--line); padding-bottom: 16px; }
  .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
  @media(max-width:640px) { .form-row { grid-template-columns: 1fr; gap: 0; } }
  .form-group { margin-bottom: 22px; }
  .form-group label { display: block; font-size: 13.5px; font-weight: 700; margin-bottom: 8px; color: var(--text); }
  .form-group input[type=text], .form-group select, .form-group textarea { width: 100%; border: 1px solid var(--line); border-radius: var(--radius); padding: 12px 14px; font-family: 'Manrope', sans-serif; font-size: 14px; color: var(--text); background: var(--card); }
  .form-group input:focus, .form-group select:focus, .form-group textarea:focus { outline: none; border-color: var(--brick); }
  .post-alert { background: #fff1f2; border: 1px solid #ffe4e6; color: #b91c1c; padding: 14px; font-size: 14px; font-weight: 600; margin-bottom: 24px; border-radius: var(--radius); }
  .btn-wrap { margin-top: 32px; padding-top: 20px; border-top: 1px solid var(--line); display: flex; gap: 16px; }
  .btn-action { padding: 14px 28px; font-size: 14.5px; font-weight: 700; border-radius: var(--radius); cursor: pointer; border: 1px solid transparent; }
  .btn-orange { background: var(--brick); color: #fff; }
  .btn-orange:hover { background: #984a2c; }
  .btn-back { background: var(--paper-2); border-color: var(--line); color: var(--text-soft); }
  .btn-back:hover { background: var(--paper-3); color: var(--text); }
  .note-file { font-size: 12px; color: var(--text-soft); margin-top: 6px; display: block; }
  .doc-upload-divider { margin-top: 32px; padding-top: 24px; border-top: 1px dashed var(--line); }
  .doc-upload-title { font-size: 16px; font-weight: 700; margin-bottom: 20px; color: var(--text); }
  .doc-form-row { margin-bottom: 20px; background: var(--paper-2); padding: 16px; border: 1px solid var(--line); border-radius: var(--radius); }
  .doc-form-group { margin-bottom: 0; }
  .doc-form-group label i { color: var(--brick); margin-right: 6px; }
  .form-group-structure { display: flex; gap: 10px; }
  .input-structure-item { width: 50%; border: 1px solid var(--line); border-radius: var(--radius); padding: 12px; }
  .file-exist-tag { display: inline-block; background-color: #e0f2fe; color: #0369a1; font-size: 12px; font-weight: 600; padding: 3px 8px; border-radius: 3px; margin-top: 6px; }
</style>

<div class="post-container">
  <div class="post-card">
    <h2><i class="fa-solid fa-pen-to-square"></i> Chỉnh sửa thông tin bài đăng bất động sản</h2>
    <p class="lede">Cập nhật chính xác các thông số thay đổi để khách mua nắm bắt thông tin rõ ràng nhất.</p>

    <?php if(!empty($m_message)): ?>
    <div class="post-alert">
      <i class="fa-solid fa-triangle-exclamation"></i> <span><?php echo $m_message; ?></span>
    </div>
    <?php endif; ?>

    <form name="frm_edit_post" method="POST" action="" enctype="multipart/form-data">
      
      <div class="form-group">
        <label for="txt_ctitle">Tiêu đề tin đăng BĐS <span style="color:var(--brick);">*</span></label>
        <input type="text" id="txt_ctitle" name="txt_ctitle" value="<?php echo htmlspecialchars($product['ctitle']); ?>" placeholder="Ví dụ: Bán căn hộ Landmark 2 phòng ngủ view sông thoáng mát" onkeyup="document.getElementById('txt_ccode').value = locdau(this.value);">
      </div>
	
	  <div class="form-group">
        <label for="txt_ccode">Mã Code URL (Khóa cố định bảo vệ SEO link) <span style="color:var(--brick);">*</span></label>
        <input type="text" id="txt_ccode" name="txt_ccode" value="<?php echo htmlspecialchars($product['ccode']); ?>" placeholder="Hệ thống tự động tạo đường dẫn..." readonly="readonly" style="background: var(--paper-3); cursor: not-allowed; color: var(--text-soft);">
      </div>
	  
      <div class="form-row">
        <div class="form-group">
          <label for="cbo_nid_cat_product">Loại hình bất động sản <span style="color:var(--brick);">*</span></label>
          <select name="cbo_nid_cat_product" id="cbo_nid_cat_product">
            <option value="0">-- Chọn loại hình BĐS --</option>
            <?php foreach($obj_cat_product as $cat): ?>
              <option value="<?php echo $cat['nid']; ?>" <?php if($cat['nid'] == $product['nid_cat_product']) echo 'selected="selected"'; ?>><?php echo $cat['ctitle']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="cbo_nid_province">Khu vực Tỉnh / Thành phố <span style="color:var(--brick);">*</span></label>
          <select name="cbo_nid_province" id="cbo_nid_province">
            <option value="0">-- Chọn Tỉnh / Thành phố --</option>
            <?php foreach($obj_province as $prov): ?>
              <option value="<?php echo $prov['nid']; ?>" <?php if($prov['nid'] == $product['nid_province']) echo 'selected="selected"'; ?>><?php echo $prov['ctitle']; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="txt_clocation_detail">Địa chỉ chi tiết bất động sản <span style="color:var(--brick);">*</span></label>
        <input type="text" id="txt_clocation_detail" name="txt_clocation_detail" value="<?php echo htmlspecialchars($product['clocation_detail']); ?>" placeholder="Ví dụ: Số 208 Nguyễn Hữu Cảnh, Phường 22, Bình Thạnh">
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="txt_cprice_display">Mức giá hiển thị bằng chữ <span style="color:var(--brick);">*</span></label>
          <input type="text" id="txt_cprice_display" name="txt_cprice_display" value="<?php echo htmlspecialchars($product['cprice_display']); ?>" placeholder="Ví dụ: 3.2 Tỷ, Thỏa thuận, 15 Triệu/tháng">
        </div>
        <div class="form-group">
          <label for="txt_nprice_value">Giá trị quy đổi bằng số (VNĐ) <span style="color:var(--brick);">*</span></label>
          <input type="text" id="txt_nprice_value" name="txt_nprice_value" value="<?php echo $product['nprice_value']; ?>" placeholder="Ví dụ: 3200000000">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="txt_narea">Diện tích sử dụng (m²) <span style="color:var(--brick);">*</span></label>
          <input type="text" id="txt_narea" name="txt_narea" value="<?php echo $product['narea']; ?>" placeholder="Ví dụ: 78.5">
        </div>
        <div class="form-group">
          <label style="display:block;margin-bottom:8px;font-size:13.5px;font-weight:700;">Thông số phòng ốc <span style="color:var(--brick);">*</span></label>
          <div class="form-group-structure">
            <input type="text" id="txt_nbedroom" name="txt_nbedroom" value="<?php echo $product['nbedroom']; ?>" placeholder="Số phòng ngủ" class="input-structure-item">
            <input type="text" id="txt_nbathroom" name="txt_nbathroom" value="<?php echo $product['nbathroom']; ?>" placeholder="Số toilet" class="input-structure-item">
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="txt_cshort_content">Đoạn mô tả ngắn gọn (Hiện ở danh sách bài đăng)</label>
        <textarea id="txt_cshort_content" name="txt_cshort_content" rows="3" placeholder="Tóm tắt thông tin nổi bật nhất..."><?php echo htmlspecialchars($product['cshort_content']); ?></textarea>
      </div>
      
      <div class="form-group">
        <label for="editor1">Nội dung chi tiết bài đăng BĐS</label>
        <textarea id="editor1" name="txt_ccontent" rows="8"><?php echo htmlspecialchars($product['ccontent']); ?></textarea>
      </div>

      <div class="form-group">
        <label for="txt_cmaps_iframe">Mã nhúng Iframe chia sẻ từ Google Maps</label>
        <textarea id="txt_cmaps_iframe" name="txt_cmaps_iframe" rows="4"><?php echo htmlspecialchars($product['cmaps_iframe']); ?></textarea>
      </div>
	  
      <div class="form-group">
        <label for="txt_cimage">Hình ảnh đại diện chính của BĐS</label>
        <input type="file" id="txt_cimage" name="txt_cimage" accept="image/*">
        <span class="note-file">* Chọn ảnh mới nếu muốn thay thế ảnh cũ hiện tại.</span>
        <?php if(!empty($product['cimage'])): ?>
            <span class="file-exist-tag"><i class="fa-solid fa-image"></i> Đã có ảnh trên máy chủ: <?php echo $product['cimage']; ?></span>
        <?php endif; ?>
      </div>

      <div class="doc-upload-divider">
        <h3 class="doc-upload-title"><i class="fa-solid fa-paperclip"></i> Đính kèm tài liệu hồ sơ mới (Chọn tệp để tải đè thay thế file cũ)</h3>
        
        <?php 
          $input_docs = [
              'contract' => ['label' => '1. Hồ sơ Hợp đồng giao dịch', 'icon' => 'fa-file-signature'],
              'diagram'  => ['label' => '2. Sơ đồ thiết kế / Bản vẽ chi tiết', 'icon' => 'fa-compass-drafting'],
              'legal'    => ['label' => '3. Hồ sơ giấy tờ pháp lý BĐS', 'icon' => 'fa-scale-balanced']
          ];
          foreach($input_docs as $key => $meta) {
        ?>
          <div class="doc-form-row">
            <div class="form-group doc-form-group">
              <label><i class="fa-solid <?php echo $meta['icon']; ?>"></i> <?php echo $meta['label']; ?></label>
              <input type="file" name="doc_file_<?php echo $key; ?>" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
              <span class="note-file">* Định dạng: PDF, DOC, DOCX, Ảnh (Dưới 5MB).</span>
              
              <?php if(isset($existing_docs[$key])): ?>
                  <span class="file-exist-tag" style="background-color: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0;">
                      <i class="fa-solid fa-file-shield"></i> File hiện tại: <?php echo $existing_docs[$key]; ?>
                  </span>
              <?php endif; ?>
            </div>
          </div>
        <?php } ?>
      </div>

      <div class="btn-wrap">
        <button type="submit" class="btn-action btn-orange">Lưu tin đăng <i class="fa-solid fa-floppy-disk"></i></button>
        <button type="button" class="btn-action btn-back" onclick="window.location.href='<?php echo base_url(); ?>my_posts';">Hủy bỏ</button>
      </div>

      <input type="hidden" name="hidden_action" value="edit_post">
    </form>
  </div>
</div>

<?php 
   $this->load->view('modules/mod_footer');
   $this->load->view('footer');
?>