const postAlertBox = document.getElementById('js-post-alert');
const alertTxt = document.getElementById('js-alert-text');
function showPostAlert(message) {
    alertTxt.textContent = message;
    postAlertBox.style.display = 'block';
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
  
// KIỂM TRA VALIDATION DỮ LIỆU ĐĂNG TIN NGHIÊM NGẶT NGOÀI FRONTEND JS
function validatePostListing() {
	  postAlertBox.style.display = 'none';

	  const title      = document.getElementById('txt_ctitle').value.trim();
	  const code       = document.getElementById('txt_ccode').value.trim();
	  const catBds     = document.getElementById('cbo_nid_cat_product').value;
	  const province   = document.getElementById('cbo_nid_province').value;
	  const location   = document.getElementById('txt_clocation_detail').value.trim();
	  const priceDisp  = document.getElementById('txt_cprice_display').value.trim();
	  const priceVal   = document.getElementById('txt_nprice_value').value.trim();
	  const area       = document.getElementById('txt_narea').value.trim();
	  const bedroom    = document.getElementById('txt_nbedroom').value.trim();
	  const bathroom   = document.getElementById('txt_nbathroom').value.trim();

	  if (title === '' || title.length < 10) {
		showPostAlert('Vui lòng nhập tiêu đề tin đăng chứa ít nhất 10 ký tự!');
		return false;
	  }
	  if (catBds === '0') {
		showPostAlert('Vui lòng phân loại nhóm Loại hình bất động sản!');
		return false;
	  }
	  if (province === '0') {
		showPostAlert('Vui lòng chọn khu vực Tỉnh / Thành phố!');
		return false;
	  }
	  if (location === '') {
		showPostAlert('Vui lòng nhập Địa chỉ chi tiết của bất động sản!');
		return false;
	  }
	  if (priceDisp === '') {
		showPostAlert('Vui lòng nhập Mức giá hiển thị bằng chữ (Ví dụ: 2.5 Tỷ)!');
		return false;
	  }
	  if (priceVal === '' || parseInt(priceVal) <= 0) {
		showPostAlert('Giá trị quy đổi bằng số phải lớn hơn 0 để phục vụ bộ lọc tìm kiếm!');
		return false;
	  }
	  if (area === '' || parseFloat(area) <= 0 || isNaN(area)) {
		showPostAlert('Vui lòng nhập Diện tích sử dụng hợp lệ và lớn hơn 0!');
		return false;
	  }
	  if (bedroom === '' || bathroom === '') {
		showPostAlert('Vui lòng điền đầy đủ thông số Số phòng ngủ và Số phòng vệ sinh!');
		return false;
	  }

	  return true;
}