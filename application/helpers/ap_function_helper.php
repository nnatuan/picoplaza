<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * =================================================================
 * Tokaban Standard System.
 * CodeIniter Tokaban framework for PHP.
 *
 * @package		: CI-TKB 
 * @author		: Tokabanf R&D Team.
 * 				: an_hm87
 * @copyright	: Copyright (c) 2009, Tokaban, Inc.
 * @since		: Version 2.0
 * =================================================================
 */ 
//an_hm87
function session_prefix()
	{								
		$obj_helper =& get_instance(); 
		return $obj_helper->config->item('system_session_id');
	}
		
function Fset_userdata($str_session_name, $obj_session_value)
	{								
		$_SESSION[$str_session_name] = $obj_session_value;   
	}		  

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An
 * @finished date	: 2009/07/23
 * @description		: Huy gia tri cua mot key session
 * @access	        : public
 *
 * @param string	: $str_session_name		: Key session can huy
 * 					: 
 * @return string	: None
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */		
function Funset_userdata($str_session_name)
	{	
		if (isset($_SESSION[$str_session_name])) 
			unset ($_SESSION[$str_session_name]); 
	}		 

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An
 * @finished date	: 2009/07/23
 * @description		: Lay gia tri cua mot key session
 * @access	        : public
 *
 * @param string	: $str_session_name		: Key session can truy xuat gia tri
 * 					: 
 * @return string	: Gia tri tuong ung voi key session can truy xuat
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */		
function Fget_userdata($str_session_name) 
	{
		if (isset($_SESSION[$str_session_name]))
			return $_SESSION[$str_session_name]; 
		else
		{
			$_SESSION[$str_session_name]=''; 
			return $_SESSION[$str_session_name]; 
		}
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An
 * @finished date	: 2009/07/23
 * @description		: Lay ket qua da duoc ma hoa.
 * @access	        : public
 *
 * @param string	: $str_data		: Gia tri can ma hoa
 * 					: 
 * @return string	: Gia tri sau khi da duoc ma hoa.
 * 					:  Luu y: Ham ma hoa nay khong su dung de giai ma.
 *-------------------------------------------------------------------
 * @editor   	    :  
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */		
function Fget_encode($str_data = '')
	{
		if(empty($str_data))
			return $str_data;
			
		if(trim($str_data)=='')
			return $str_data;	
		else
			return md5($str_data);	
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An
 * @finished date	: 2009/07/23
 * @description		: Su dung cho viec chuan bi ma hoa DB.
 * @access	        : public
 *
 * @param string	: $str_data		: Gia tri can ma hoa
 * 					: 
 * @return string	: Gia tri sau khi da duoc ma hoa.
 * 					:  Luu y: Ham ma hoa nay khong su dung de giai ma.
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */		
function Fget_tkbencode($str_data = '')
	{		
		return $str_data;	
	}
//
//
//
function Fget_tkbdecode($str_data = '')
	{
		return $str_data;	
	}

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An
 * @finished date	: 2009/07/23
 * @description		: Xuat mot bien gia tri kieu string ra html view
 * @access	        : public
 * @param string	: $str_value		: Gia tri can truy view html
 *
 * @return string	: Gia tri hop le khi view html
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */	
function Fview_text($str_value)
	{
		if( empty($str_value ) OR trim($str_value)=="")
			return "&nbsp;";
		else
			return $str_value;
	}	

function Fview_textarea($str_value)
	{
		if( empty($str_value ) OR trim($str_value)=="")
			return "&nbsp;";
		else
			return $str_value;
	}	
 
/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An
 * @finished date	: 2009/07/23
 * @description		: Xuat mot bien gia tri kieu number ra html view
 * @access	        : public
 * @param string	: $num_number		: Gia tri can truy view html
 *
 * @return string	: Gia tri hop le khi view html
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */	
function Fview_number($num_number)
	{
		if( empty($num_number ) OR trim($num_number)=='')
			return '&nbsp;';
		else
			return round($num_number,2);
	}
	
/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An
 * @finished date	: 2009/07/23
 * @description		: Xuat mot bien gia tri kieu date ra html view
 * @access	        : public
 * @param string	: $num_number		: Gia tri can truy view html
 *
 * @return string	: Gia tri hop le khi view html
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */
function Fview_date($dat_date)
	{
		if( empty($dat_date) OR trim($dat_date)=='' OR trim($dat_date)=='--')
			return '&nbsp;';
		else 
			return date('d/m/Y',strtotime($dat_date));
	}	
	
/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An
 * @finished date	: 2009/07/23
 * @description		: Ham xac dinh ten table phu hop voi ung dung da duoc dinh nghia.
 * @access	        : public
 * @param string	: $tablename		: Ten table chua co tien to.
 *
 * @return string	: Gia tri hop le khi view html
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */
function Fget_ap_table($tablename='')
  	{
    	//return trim(Fget_userdata('session_ap_prefix')).'_'. $tablename;
			$CI =& get_instance();
		return $CI->config->item('system_ap_prefix').'_'. $tablename;
  	}
//
// Ham tra ve nguyen tac hien thi thong tin phan nhanh
//
function Fget_ap_table2($tablename='')
  	{
		$CI =& get_instance();
		return $CI->config->item('system_ap_prefix').'_'. $tablename;
  	}
function Fview_textindex($index)
   {
	   $m = '';
       if(strlen($index) == 5)
		  return $m;
	   else 
	   {
		 $index = strlen($index)/5 - 1; 
		 for($n=1;$n<=$index;$n++)
			$m = '.&nbsp;&nbsp;&nbsp;' . $m;
		  return $m;										 
	   }
	}

//
// 	PART II: 	
//	DINH NGHIA CAC HAM DAC THU CUA MOT DU AN CU THE.
//	CHI CAC HAM DUNG CHUNG SU DUNG NHIEU DOI TUONG TRONG DU AN MOI DUOC DINH NGHIA NOI DAY.
//	CAC HAM DUOC DINH NGHIA TRONG PHAN NAY, PHAI DUOC SU DONG Y CUA R&D MANAGER.
//	PHAI DUOC TONG HOP TRONG FILE HE THONG EXCEL DE DAO TAO CHO CAC THANH VIEN TRONG NHOM CODE, 
//		NHUNG NGUOI THAM GIA VAO DU AN.
//	
/**
 *-------------------------------------------------------------------
 * @creator 		: Le Van Huan. huan_lv77@tokaban.com
 * @finished date 	: 2009/09/08.
 * @Description	    : Tinh toan va tra ve tong so trang tuong ung voi gia tri dau vao
 * @access	        : public
 * @param string	: num_row_per_page	: Tong so dong thong tin tren mot trang.
 * 				    : num_total_row		: Tong so dong
 * 		    
 * @return string	: Tong so trang tuong ung.
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------				
 */	
function Fget_total_page($num_row_per_page, $num_total_row)
	{
		if($num_row_per_page == 0)
			$num_row_per_page = 1;
		
		if($num_total_row % $num_row_per_page == 0)
			return $num_total_row / $num_row_per_page;
		else
			return ($num_total_row - ($num_total_row % $num_row_per_page)) / $num_row_per_page + 1;
	}		

/** 
 *-------------------------------------------------------------------
 * @creator 		: Trinh Hoang Dung. dung_th83@tokaban.com
 * @finished date 	: 2009/09/09.
 * @Description	    : Tinh toan va tra ve tong so trang tuong ung voi gia tri dau vao
 * @access	        : public
 * @param string	: None
 * 				    : 
 * 		    
 * @return string	: $icon_notnull : bieu tuong thong bao truong khong duoc rong
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------				
 */	
 function Fget_icon_notnull()
 	{
		$icon_notnull = ' <span style="color:red; font-size:10px"> * </span> ';
		return $icon_notnull;
	} 
/**
 *-------------------------------------------------------------------
 * @creator 		: Le Van Huan. huan_lv77@tokaban.com
 * @finished date 	: 2009/09/12.
 * @Description	    : Xac dinh thong tin duong dan va xu ly image sort thong tin tren cac man hinh danh muc.
 * @access	        : public
 * @param string	: str_sort	: Sap xep thong tin theo dieu kien tang giam.
 * 		    
 * @return string	: Thong tin duong dan chua image bieu tuong sort thong tin.
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------				
 */	
function Fget_image_sort($str_sort='acs')
	{ 
		if($str_sort == 'asc')
			return '<img src="' . base_url() . 'ap_images/ap_icons/asc.png" alt="sort"/>';
		else
			return '<img src="' . base_url() . 'ap_images/ap_icons/desc.png" alt="sort"/>';
	}
//
//
//
function Farray_insert(&$array,$pos,$val)
	{
		$array2 = array_splice($array,$pos);
		$array[] = $val;
		$array = array_merge($array,$array2);
	}		
//
//
//
/**
 *-------------------------------------------------------------------
 * @creator 	    : Cao An Phu. an_hm87@tokaban.com
 * @finished date   : 2009/06/08.
 * @description	    : Tra ve gia tri integer
 * @access	        : public
 * @param string    : $num_number		: Gia tri can truy view html
 *
 * @return string   : Gia tri hop le khi view html
 *-------------------------------------------------------------------
 * @editor   	    : 
 * @finished date	: 
 * @editing content	: 
 *-------------------------------------------------------------------
 */		
function Fconvert_to_int($value='')
  	{
    	return intval($value);
  	}
//
//
//	
function Fis_char_number($value)
  	{
    return (preg_match ("/^(-){0,1}([0-9]+)(,[0-9][0-9][0-9])*([.,][0-9]){0,1}([0-9]*)$/", trim($value)) == 1);
  	}

function Fis_date_null($value)
  	{
    	if(trim($value)=='' OR trim($value)=='01/01/1970')
			return TRUE;
		else
			return FALSE;	
  	}
function Fis_email($value)
  	{
		$regexp = "/^[A-z0-9_]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/";
		if (preg_match($regexp, $value)) {
			return TRUE;
		} else {
			return FALSE;
		}
  	}
	
function Fis_date($value)
  	{
		$blnValid = TRUE;
   		// check the format first (may not be necessary as we use checkdate() below)
   		if(!ereg ("^[0-9]{2}/[0-9]{2}/[0-9]{4}$", $value))
   		{
    		$blnValid = FALSE;
   		}
   		else //format is okay, check that days, months, years are okay
   		{
      		$arrDate = explode("/", $value); // break up date by slash
      		$intDay = $arrDate[0];
      		$intMonth = $arrDate[1];
      		$intYear = $arrDate[2];
				
			if ($intYear%4!=0 AND $intMonth==2 AND $intDay==29)
				$blnValid = FALSE;
			else
				{	      		
				$intIsDate = checkdate( $intMonth, $intDay,$intYear);
     			if(!$intIsDate)
        			$blnValid = FALSE;
				}	
   		}//end else
   		return ($blnValid);
  	}
	
//
// Phai dam bao co day du 10 ky tu so
//	
function Fget_strdate($value)
  	{
    	$str_day=''; 
		$str_month='';
		$str_year='';
		$str_day 	= substr($value, 0, 2);
		$str_month	= substr($value, 3, 2); 
		$str_year	= substr($value, 6, 4); 
		if (trim($value)=='')
			return '';
		else			
			return $str_year . '-'. $str_month . '-' . $str_day;
  	}

//
// Ham chuyen mot so sang chuoi index theo dung nguyen tac 5 ky tu.
// Phai bao dam la kieu so.
// Chi su dung 5 ky tu de thuc hien.
//
function Fget_convert_index($value)
  	{
		$str='0000.';
		$value=trim($value);
		
		if ($value=='')
			$value = $str;
		else if (strlen($value)>4)
			$str = substr($value, 0, 4).'.';	
		else
			$str = substr($str, 0, 4-strlen($value)) . $value . '.';
		 	
		return $str;
  	}
//
// Xac dinh lai thong tin key index
// Phai dam bao da kiem tra day du 5 ky tu
// Chi su dung 5 ky tu de thuc hien.
// $index la gia tri key index da duoc chuyen doi.
// $current_index la gia tri cac index con can chuyen doi phu hop voi he thong.
function Fget_parent_index($value)
  	{
		$str = '';
		$value=trim($value);
				
		if (strlen($value)<=5)
			$value = $str;
		else
			$value = substr($value, 0, strlen($value)-5);			
		return $value;
  	}
//
// Xac dinh lai thong tin key index
// Phai dam bao da kiem tra day du 5 ky tu
// Chi su dung 5 ky tu de thuc hien.
// $index la gia tri key index da duoc chuyen doi.
// $current_index la gia tri cac index con can chuyen doi phu hop voi he thong.
function Fget_change_key_index($old_parent_index,$new_parent_index, $current_index)
  	{		
		$new_parent_index 	= trim($new_parent_index);
		$old_parent_index 	= trim($old_parent_index);
		$current_index 		= trim($current_index);
				
		return $new_parent_index .  substr($current_index, strlen($old_parent_index), 
							strlen($current_index) - strlen($old_parent_index)) ;				
  	}
			
			
//an_hm87
//function del file 
//param:file name
//
function delfile($str_name)
{
        if(is_file($str_name)){
            return @unlink($str_name);
		}
}
//an_hm87
//function replace str
//param:str_search,str_replace,str
//
function Fstr_replace($str_search,$str_replace,$str)
{
        if(strlen($str) > 0){
            return str_replace($str_search,$str_replace,$str);
		}else
		return '';
}
//upload resize IMG
function Fupload_resize_img($file, $path, $modwidth, $modheight)
{
    $file_name = '';
    
    // 1. Chuẩn hóa mảng các định dạng ảnh được phép upload (Hỗ trợ đầy đủ cả PNG và GIF)
    $allowed_types = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png");
    
    // Kiểm tra định dạng và dung lượng file (Dưới 2MB)
    if (in_array($file["type"], $allowed_types) && ($file["size"] < 2000000))
    {
        if ($file["error"] > 0)
        {
            // Ghi log hoặc bỏ qua nếu không cần xuất lỗi ra màn hình
            return '';
        }
        else
        {
            // 2. SỬA LỖI LẤY ĐUÔI FILE: Dùng pathinfo an toàn tuyệt đối kể cả tên file có nhiều dấu chấm
            $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
            
            // Sinh tên file ngẫu nhiên mã hóa md5 để không bị trùng bản ghi trên server
            $file_name = md5(rand(2, 999) . date('Ymdhis')) . '.' . $ext;
            
            // Di chuyển file thô vào thư mục upload
            if (move_uploaded_file($file["tmp_name"], $path . $file_name))
            {
                $imagepath = $path . $file_name;
                $save      = $imagepath; // Tệp tin lưu đè sau khi co ảnh
                $file_tmp  = $imagepath; // Tệp tin gốc ban đầu
                
                // Lấy kích thước thực tế của ảnh
                list($width, $height) = getimagesize($file_tmp); 
                
                // Chỉ tiến hành xử lý nén/co ảnh nếu kích thước thực tế lớn hơn hạn mức cấu hình
                if ($width > $modwidth || $height > $modheight)
                {
                    // Tính toán tỷ lệ co giãn để giữ nguyên tỷ lệ khung hình (Không bị méo ảnh)
                    $diff = $width / $modwidth;
                    $modheight = $height / $diff; 
                    
                    // Tạo khung ảnh canvas mới
                    $tn = imagecreatetruecolor($modwidth, $modheight); 
            
                    // 3. SỬA LỖI KHỞI TẠO HÀM ĐỌC ẢNH: Phân tách rõ ràng từng định dạng cụ thể
                    $image = null;
                    if ($file["type"] == "image/jpeg" || $file["type"] == "image/pjpeg") 
                    {
                        $image = imagecreatefromjpeg($file_tmp); 
                    }
                    elseif ($file["type"] == "image/gif")
                    {
                        $image = imagecreatefromgif($file_tmp); // Đã sửa: Dùng đúng hàm cho ảnh GIF
                    }
                    elseif ($file["type"] == "image/png" || $file["type"] == "image/x-png")
                    {
                        // Giữ độ trong suốt (Alpha) cho file ảnh PNG không bị đen nền
                        imagealphablending($tn, false);
                        imagesavealpha($tn, true);
                        $image = imagecreatefrompng($file_tmp);
                    }
                
                    // Tiến hành co ảnh real-time
                    if ($image) {
                        imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height); 
                        
                        // 4. LƯU ẢNH THEO ĐÚNG ĐỊNH DẠNG: Giúp giữ nguyên chất lượng gốc tốt nhất
                        if ($file["type"] == "image/png" || $file["type"] == "image/x-png") {
                            imagepng($tn, $save, 9); // Nén ảnh PNG mức 9
                        } elseif ($file["type"] == "image/gif") {
                            imagegif($tn, $save);
                        } else {
                            imagejpeg($tn, $save, 90); // Nén ảnh JPEG chất lượng cao 90%
                        }
                        
                        // Giải phóng bộ nhớ máy chủ sau khi xử lý
                        imagedestroy($tn);
                        imagedestroy($image);
                    }
                }
            }
        }
    }   
    return $file_name;
}

function resize_img($file,$file_name,$path1,$path,$modwidth,$modheight)
{	
	copy($path1,$path.'resize_'.$file_name);
	//resize image trong hinh
	$imagepath = $path.'resize_'.$file_name;
	
	$save 		= $imagepath; //This is the new file you saving
	$file_tmp   = $imagepath; //This is the original file
	list($width, $height) = getimagesize($file_tmp) ; 

	if($width>$modwidth || $height>$modheight)
	{
		$diff = $width / $modwidth;

		$modheight = $height / $diff; 
		$tn = imagecreatetruecolor($modwidth, $modheight) ; 
		$image = '';
		if( $file["type"] == "image/jpeg" || $file["type"] == "image/pjpeg")				
		{
			$image = imagecreatefromjpeg($file_tmp) ;
		}
		elseif ($file["type"] == "image/png")
		{
			$image = imagecreatefrompng($file_tmp);
		}
		elseif ($file["type"] == "image/gif")
		{
			$image = imagecreatefromgif($file_tmp);
		}

		imagecopyresampled($tn, $image, 0, 0, 0, 0, $modwidth, $modheight, $width, $height) ; 

		imagejpeg($tn, $save, 100) ; 
	}
	
	return 'resize_'.$file_name;
	//het resize
}

/**
 *-------------------------------------------------------------------
 * @creator 		: Hoang Minh An - tieulong4000@yahoo.com
 * @finished date	: 2009/10/23
 * @description		: Thu vien dung chung cho cac combobox co, khong

 * @return string	: Gia tri hop le khi view html	
 */
function Fget_combobox_yes_no($blank_line,$str_name, $str_value, $str_style, $yes, $no)
 {
 	$str_return = '<select name = '.$str_name.' style="'.$str_style.'" >';

	if(trim($blank_line) == '')
		$str_return 	= $str_return.'<option selected="selected" value = "" ></option>';
	if(trim($str_value) == 1)
	{
		$str_return 	= $str_return.'<option selected="selected" value = "1">'.$yes.'</option>';
		$str_return 	= $str_return.'<option  value = "0">'.$no.'</option>';
	}
	if(trim($str_value) == 0 && trim($str_value) !='')
	{
		$str_return 	= $str_return.'<option  value = "1">'.$yes.'</option>';	
		$str_return 	= $str_return.'<option selected="selected" value = "0">'.$no.'</option>';
	}
	if(trim($str_value) == '')
	{
		$str_return 	= $str_return.'<option  value = "1">'.$yes.'</option>';	
		$str_return 	= $str_return.'<option  value = "0">'.$no.'</option>';
	}
	
	$str_return = $str_return.'</select>';
	return $str_return;
 }
 
function show_img_pulish($value)
{
	$str_return = '';
	if($value == 1)
		$str_return = '<img src="'.base_url().'ap_images/publish.png" alt= "co" />';
	if($value == 0)
		$str_return = '<img src="'.base_url().'ap_images/unpublish.png" alt= "khong" />';
	if($value == '')
		$str_return = '&nbsp;';
	return $str_return;
}

function show_img_pulish_active($link,$value)
{
	$str_return = '';
	if($value == 1)
		$str_return = '<a href="'.$link.'"><img src="'.base_url().'ap_images/publish.png" alt= "co" /></a>';
	if($value == 0)
		$str_return = '<a href="'.$link.'"><img src="'.base_url().'ap_images/unpublish.png" alt= "khong" /></a>';
	if($value == '')
		$str_return = '&nbsp;';
	return $str_return;
}

function show_text_pulish($value, $yes, $no)
{
	$str_return = '';
	if($value == 1)
		$str_return = $yes;
	if($value == 0)
		$str_return = $no;
	if($value == '')
		$str_return = '&nbsp;';
	return $str_return;
}

function get_day($str_date)
{
	$str_day=''; 
	$str_day 	= substr($str_date, 8, 2);
	return $str_day;
}

function get_year($str_date)
{
	$str_year=''; 
	$str_year 	= substr($str_date, 0, 4);
	return $str_year;
}
/*
function get_month($str_date)
{
	$str_month=''; 
	$str_month 	= substr($str_date, 5, 2);
	switch($str_month)
	{
		case 01:
			$str_month = 'Jan';
			break;
		case 02:
			$str_month = 'Feb';
			break;
		case 03:
			$str_month = 'Mar';
			break;
		case 04:
			$str_month = 'Apr';
			break;
		case 05:
			$str_month = 'May';
			break;
		case 06:
			$str_month = 'Jun';
			break;
		case 07:
			$str_month = 'Jul';
			break;
		case 08:
			$str_month = 'Aug';
			break;
		case 09:
			$str_month = 'Sep';
			break;
		case 10:
			$str_month = 'Oct';
			break;
		case 11:
			$str_month = 'Nov';
			break;
		case 12:
			$str_month = 'Dec';
			break;
		default:
			$str_month = '';
	}
	return $str_month;
}
*/
function Fstr_limit($string, $length, $replacer = ' ...')
{	
    if(strlen($string) > $length)
  	{
		$string = substr($string, 0, $length);
		$n = strrpos($string," ");
		return substr($string, 0, $n).$replacer;
 	 }
  return $string;

}

function filter_file_string( $str , $key)
	{
		$str = khongdau($str);
		$str = cleanText($str);
		$str = explode(" ",$str);
		$string = '';
		for($i = 0; $i<count($str); $i++):
			if($i == 0)
				$string = $str[$i];
			else
				$string = $string.$key.$str[$i];
		endfor;
		$string = strtolower($string);
		return $string;
	}

function show_price($price)
{
	$str_return = '';
	if($price > 0)
		$str_return = number_format($price).' VNĐ';
	if($price <= 0)
		$str_return = 'Call';
	return $str_return;
}

function show_price_sale($price)
{
	$str_return = '';
	if($price > 0)
		$str_return = ' <span style="text-decoration:line-through; color:#ff0000;">('.number_format($price).')</span>';
	if($price <= 0)
		$str_return = '';
	return $str_return;
}
function cleanText( $text )
	{
		$text = preg_replace( '/&nbsp;/', '', $text );
		$text = preg_replace( '/&amp;/', '', $text );
		$text = preg_replace( '/&quot;/', '', $text );
		$text = preg_replace( '/&ldquo;/', '', $text );
		$text = preg_replace( '/&rdquo;/', '', $text );
		$text = preg_replace( '/&rsquo;/', '', $text );
		$text = preg_replace( '/&ndash;/', '', $text );
		$text = preg_replace( '/&sdot;/', '', $text );
		$text = preg_replace( '/&sbquo;/', '', $text );
		$text = preg_replace( '/&lsquo;/', '', $text );
		$text = preg_replace( '/&rsquo;/', '', $text );
		$text = str_replace( '?', '', $text );	
		$text = str_replace( '&', '', $text );	
		$text = str_replace( '-', '', $text );
		$text = str_replace( ':', '', $text );
		$text = str_replace( '*', '', $text );
		$text = str_replace( "/'/", '', $text );
                $text = str_replace( "/’/", '', $text );
		$text = preg_replace( '/â€&trade;/', '', $text );
		$text = preg_replace( '/â€˜/', '', $text );
		return $text;
	}
	
function khongdau($str) {
$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
$str = preg_replace("/(đ)/", 'd', $str);
$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
$str = preg_replace("/(Đ)/", 'D', $str);
//$str = str_replace(" ", "-", str_replace("&*#39;","",$str));
return $str;
}
function trim_str( $str )
	{		
		$str = khongdau($str);
		$str = cleanText($str);		
		$str = strtolower($str);		
		return $str;
	}
