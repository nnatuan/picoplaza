<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function get_logo()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.cimage';
		$str_query .= ' FROM '.Fget_ap_table('tconfig').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = 8';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()['cimage'];
	}	
function get_config_byid($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tconfig').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = '.$nid;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_config_by_id($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tconfig').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = '.$nid;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}
function get_value_by_config($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.cvalue';
		$str_query .= ' FROM '.Fget_ap_table('tconfig').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = '.$nid;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()['cvalue'];
	}	
function get_label_by_config($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.cname';
		$str_query .= ' FROM '.Fget_ap_table('tconfig').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = '.$nid;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()['cname'];
	}	
function get_config_byid2($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tconfig').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = '.$nid;
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}
function get_module_byid($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tmodule').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = '.$nid;
		//$str_query .= ' AND a.nstatus = 1 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}
function get_module_note($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.cnote ';
		$str_query .= ' FROM '.Fget_ap_table('tmodule').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = '.$nid;
		//$str_query .= ' AND a.nstatus = 1 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()['cnote'];
	}
function get_banner_list()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT *';
		$str_query .= ' FROM '.Fget_ap_table('tbanner_images');
		$str_query .= ' WHERE nid is not null ';
		$str_query .= ' AND nstatus = 1 ';
		$str_query .= ' ORDER BY cindex+0 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_cat_product_all()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT nid, ctitle';
		$str_query .= ' FROM '.Fget_ap_table('tcat_product');
		$str_query .= ' WHERE nid is not null ';
		$str_query .= ' AND nstatus = 1 ';
		$str_query .= ' ORDER BY cindex+0 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_province_all()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT nid, ctitle';
		$str_query .= ' FROM '.Fget_ap_table('tprovince');
		$str_query .= ' WHERE nid is not null ';
		$str_query .= ' AND nstatus = 1 ';
		$str_query .= ' ORDER BY cindex+0 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_news_by_code($ccode)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT * ';
		$str_query .= ' FROM '.Fget_ap_table('tnews').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.ccode = "'.$ccode.'"';
		$str_query .= ' AND a.nstatus = 1 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}	
function get_cat_news_title($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.ccat_news ';
		$str_query .= ' FROM '.Fget_ap_table('tcat_news').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "'.$nid.'"';
		//$str_query .= ' AND a.nstatus = 1 ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()['ccat_news'];
	}	
function get_gallery()
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.nid, a.ctitle, cimage ';
		$str_query .= ' FROM '.Fget_ap_table('tgallery').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' ORDER BY cindex+0, nid desc ';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}
function get_gallery_img($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.nid, a.cimg ';
		$str_query .= ' FROM '.Fget_ap_table('tgallery_img').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid_product = "'.$nid.'"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->result_array();
	}	
function get_member_by_id($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.* ';
		$str_query .= ' FROM '.Fget_ap_table('tmember').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "'.$nid.'"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array();
	}	
function get_article_content_by_id($nid)
	{
		$obj_helper =& get_instance(); 
		$obj_helper->load->database();	
		$str_query = ' SELECT a.ccontent ';
		$str_query .= ' FROM '.Fget_ap_table('tarticle').' as a ';
		$str_query .= ' WHERE a.nid is not null ';
		$str_query .= ' AND a.nid = "'.$nid.'"';
		$obj_result = $obj_helper->db->query($str_query);  
		return $obj_result->row_array()['ccontent'];
	}	
/**
 *-------------------------------------------------------------------
 * @description     : Kiem tra thong tin va tra ve member phuc vu luong Dang nhap
 * @access          : public
 * @param string    : $username : Ten tai khoan hoac Email dang nhap
 * @param string    : $password : Mat khau chuoi chua bam
 * @return array    : Mang thong tin thanh vien hoac mang rong []
 *-------------------------------------------------------------------
 */
function get_member_login($username, $password)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();    
    
    $str_query = ' SELECT nid, cfullname, nstatus ';
    $str_query .= ' FROM ' . Fget_ap_table('tmember') . ' as a ';
    $str_query .= ' WHERE (a.cusername = ' . $obj_helper->db->escape($username) . ' OR a.cemail = ' . $obj_helper->db->escape($username) . ') ';
    $str_query .= ' AND a.cpassword = ' . $obj_helper->db->escape(md5($password));
    $str_query .= ' LIMIT 0,1 ';
    
    $obj_result = $obj_helper->db->query($str_query);  
    return $obj_result->row_array(); 
}

/**
 *-------------------------------------------------------------------
 * @description     : Kiem tra trung lap Username hoac Email phuc vu luong Dang ky
 * @access          : public
 * @param string    : $username : Tên tai khoan can kiem tra
 * @param string    : $email    : Email can kiem tra
 * @return bool     : TRUE neu da ton tai (bi trung), FALSE neu chua ton tai (hop le)
 *-------------------------------------------------------------------
 */
function Fcheck_member_duplicate($username, $email)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();    
    
    $str_query = ' SELECT nid ';
    $str_query .= ' FROM ' . Fget_ap_table('tmember') . ' ';
    $str_query .= ' WHERE cusername = ' . $obj_helper->db->escape($username) . ' ';
    $str_query .= ' OR cemail = ' . $obj_helper->db->escape($email) . ' ';
    $str_query .= ' LIMIT 0,1 ';
    
    $obj_result = $obj_helper->db->query($str_query);  
    if ($obj_result->num_rows() > 0) {
        return TRUE; 
    }
    return FALSE; 
}

/**
 *-------------------------------------------------------------------
 * @description     : Ham chen du lieu dung chung cho tat ca cac bang
 * @access          : public
 * @param string    : $table_name : Ten bang rut gon (Tu dong qua Fget_ap_table)
 * @param array     : $data       : Mang du lieu sach can chen
 * @return int|bool : Tra ve ID vua insert neu thanh cong, nguoc lai tra ve FALSE
 *-------------------------------------------------------------------
 */
function Finsert_data_global($table_name, $data)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();    
    
    if ($obj_helper->db->insert(Fget_ap_table($table_name), $data)) {
        return $obj_helper->db->insert_id();
    }
    return FALSE;
}

/**
 *-------------------------------------------------------------------
 * @description     : Kiem tra trung lap ma ccode (Slug URL) cua tin dang BĐS
 * @access          : public
 * @param string    : $ccode : Ma chuoi slug can check trung
 * @return bool     : TRUE neu da ton tai (bi trung), FALSE neu chua ton tai (hop le)
 *-------------------------------------------------------------------
 */
function check_product_duplicate($ccode)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();    
    
    $str_query = ' SELECT nid ';
    $str_query .= ' FROM ' . Fget_ap_table('tproduct') . ' ';
    $str_query .= ' WHERE ccode = ' . $obj_helper->db->escape($ccode) . ' ';
    $str_query .= ' LIMIT 0,1 ';
    
    $obj_result = $obj_helper->db->query($str_query);  
    if ($obj_result->num_rows() > 0) {
        return TRUE; 
    }
    return FALSE; 
}

/**
 *-------------------------------------------------------------------
 * @description     : Lay danh sach tinh thanh active ra Frontend dang tin
 * @access          : public
 * @return array    : Mang danh sach tinh thanh toàn quoc
 *-------------------------------------------------------------------
 */
function get_active_province()
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();    
    
    $str_query = ' SELECT nid, ctitle ';
    $str_query .= ' FROM ' . Fget_ap_table('tprovince') . ' ';
    // Có thể thêm điều kiện nstatus = 1 nếu bảng tprovince sau này có quản lý bật/tắt
    $str_query .= ' ORDER BY cindex+0 ASC, ctitle ASC ';
    
    $obj_result = $obj_helper->db->query($str_query);  
    return $obj_result->result_array(); 
}

/**
 *-------------------------------------------------------------------
 * @description     : Lay danh sach nhom danh muc dang active ra Frontend
 * @access          : public
 * @return array    : Mang danh sach danh muc
 *-------------------------------------------------------------------
 */
function get_active_cat_product()
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();    
    
    $str_query = ' SELECT nid, ctitle ';
    $str_query .= ' FROM ' . Fget_ap_table('tcat_product') . ' ';
    $str_query .= ' WHERE nstatus = 1 ';
    $str_query .= ' ORDER BY cindex ASC ';
    
    $obj_result = $obj_helper->db->query($str_query);  
    return $obj_result->result_array(); 
}

/**
 *-------------------------------------------------------------------
 * @description     : Lay thong tin chi tiet BĐS theo ccode (Slug URL)
 * @access          : public
 * @param string    : $ccode : Ma slug duong dan cua san pham
 * @return array    : Mang thong tin chi tiet hoac mang rong []
 *-------------------------------------------------------------------
 */
function get_product_detail($ccode)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();    
    
    $str_query = ' SELECT a.*, b.ctitle as ctitle_cat, c.ctitle as ctitle_province ';
    $str_query .= ' FROM ' . Fget_ap_table('tproduct') . ' as a ';
    $str_query .= ' INNER JOIN ' . Fget_ap_table('tcat_product') . ' as b ON a.nid_cat_product = b.nid ';
    $str_query .= ' INNER JOIN ' . Fget_ap_table('tprovince') . ' as c ON a.nid_province = c.nid ';
    $str_query .= ' WHERE a.nstatus = 1 ';
    $str_query .= ' AND a.ccode = ' . $obj_helper->db->escape($ccode) . ' ';
    $str_query .= ' LIMIT 0,1 ';
    
    $obj_result = $obj_helper->db->query($str_query);  
    return $obj_result->row_array(); 
}

/**
 *-------------------------------------------------------------------
 * @description     : Lay thong tin ho ten, so dien thoai chinh chu dang tin tmember
 * @access          : public
 * @param int       : $nid_member : ID nguoi dung trong bang tmember
 * @return array    : Mang thong tin chu tin dang hoac mang rong []
 *-------------------------------------------------------------------
 */
function get_member_owner_listing($nid_member)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();    
    
    $str_query = ' SELECT cfullname, cphone, cavatar ';
    $str_query .= ' FROM ' . Fget_ap_table('tmember') . ' ';
    $str_query .= ' WHERE nid = ' . (int)$nid_member . ' ';
    $str_query .= ' LIMIT 0,1 ';
    
    $obj_result = $obj_helper->db->query($str_query);  
    return $obj_result->row_array(); 
}

/**
 *-------------------------------------------------------------------
 * @description     : Tu dong tinh toan va sinh ma chuoi TicketCode cong khai (PS-XXXX)
 * @access          : public
 * @return string    : Chuoi ticket code moi nhat
 *-------------------------------------------------------------------
 */
function Fgenerate_ticket_code()
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = ' SELECT MAX(nid) as max_id FROM ' . Fget_ap_table('tticket') . ' ';
    $obj_result = $obj_helper->db->query($str_query)->row_array();
    
    $next_id = (!empty($obj_result['max_id'])) ? ((int)$obj_result['max_id'] + 1) : 1;
    
    // Tạo định dạng chuỗi: bắt đầu từ số 1000 để mã hiển thị đẹp
    $code_number = 1000 + $next_id;
    return 'PS-' . $code_number;
}

/**
 *-------------------------------------------------------------------
 * @description     : Lay thong tin chi tiet Ticket theo Ticket Code cong khai
 * @access          : public
 * @param string    : $ticket_code : Ma chuoi định danh (Vi du: PS-1042)
 * @return array    : Mang thong tin record hoac mang rong []
 *-------------------------------------------------------------------
 */
function get_ticket_by_code($ticket_code)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = ' SELECT * ';
    $str_query .= ' FROM ' . Fget_ap_table('tticket') . ' ';
    $str_query .= ' WHERE cticket_code = ' . $obj_helper->db->escape($ticket_code) . ' ';
    $str_query .= ' LIMIT 0,1 ';
    
    $obj_result = $obj_helper->db->query($str_query);
    return $obj_result->row_array();
}

/**
 *-------------------------------------------------------------------
 * @description     : Lay toan bo lich su hoi thoai / log timeline cua Ticket
 * @access          : public
 * @param int       : $nid_ticket : ID goc cua ticket trong bang tticket
 * @return array    : Mang danh sach cac buoc tuong tac
 *-------------------------------------------------------------------
 */
function Fget_ticket_logs($nid_ticket)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = ' SELECT * ';
    $str_query .= ' FROM ' . Fget_ap_table('tticket_log') . ' ';
    $str_query .= ' WHERE nid_ticket = ' . (int)$nid_ticket . ' ';
    $str_query .= ' ORDER BY dreply_at ASC, nid ASC ';
    
    $obj_result = $obj_helper->db->query($str_query);
    return $obj_result->result_array();
}

/**
 *-------------------------------------------------------------------
 * @description     : Đếm tổng số lượng sản phẩm thỏa mãn điều kiện lọc tìm kiếm
 * @access          : public
 * @param string    : $str_where_clause : Mệnh đề WHERE điều kiện lọc
 * @return int      : Tổng số dòng tìm thấy
 *-------------------------------------------------------------------
 */
function get_count_search($str_where_clause)
    {
		$obj_helper =& get_instance();
		$obj_helper->load->database();
		
        $str_query = ' SELECT nid FROM ' . Fget_ap_table('tproduct') . ' as a ';
        $str_query .= ' ' . $str_where_clause;
        
        $obj_result = $obj_helper->db->query($str_query);
        return $obj_result->num_rows();
    }

/**
 *-------------------------------------------------------------------
 * @description     : Lấy danh sách sản phẩm phân trang kèm tên Tỉnh và Danh mục
 * @access          : public
 * @param string    : $str_where_clause : Mệnh đề WHERE điều kiện lọc
 * @param int       : $offset           : Vị trí bắt đầu phân trang
 * @param int       : $row_per_page     : Số lượng dòng trên một trang
 * @return array    : Mảng danh sách sản phẩm kết quả
 *-------------------------------------------------------------------
 */
function get_list_search($str_where_clause, $offset, $row_per_page)
    {
		$obj_helper =& get_instance();
		$obj_helper->load->database();
	
        $t_product  = Fget_ap_table('tproduct');
        $t_province = Fget_ap_table('tprovince');
        $t_cat      = Fget_ap_table('tcat_product');

        $str_query = ' SELECT a.*, b.ctitle as ctitle_province, c.ctitle as ctitle_cat ';
        $str_query .= ' FROM ' . $t_product . ' as a ';
        $str_query .= ' INNER JOIN ' . $t_province . ' as b ON a.nid_province = b.nid ';
        $str_query .= ' INNER JOIN ' . $t_cat . ' as c ON a.nid_cat_product = c.nid ';
        $str_query .= ' ' . $str_where_clause;
        $str_query .= ' ORDER BY a.cindex, a.nid DESC ';
        $str_query .= ' LIMIT ' . max(0, (int)$offset) . ', ' . (int)$row_per_page;

        $obj_result = $obj_helper->db->query($str_query);
        return $obj_result->result_array();
    }
	
/**
 *-------------------------------------------------------------------
 * @description     : Lay danh sach bat dong san noi bat / moi nhat ra ngoài Homepage
 * @access          : public
 * @param int       : $limit : So luong tin can lay ra (Mac dinh la 6 tin)
 * @return array    : Mang danh sach san pham noi bat
 *-------------------------------------------------------------------
 */
function get_product_hot($limit = 6)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();    
    
    // Explicit Join lay day du truong thong tin va ten danh muc, tinh thanh mapped sach se
    $str_query = ' SELECT a.*, b.ctitle as ctitle_cat, c.ctitle as ctitle_province ';
    $str_query .= ' FROM ' . Fget_ap_table('tproduct') . ' as a ';
    $str_query .= ' INNER JOIN ' . Fget_ap_table('tcat_product') . ' as b ON a.nid_cat_product = b.nid ';
    $str_query .= ' INNER JOIN ' . Fget_ap_table('tprovince') . ' as c ON a.nid_province = c.nid ';
    $str_query .= ' WHERE a.nstatus = 1 '; // Chi lay tin dang active hoat dong
    $str_query .= ' ORDER BY a.nid DESC '; // Uu tien tin moi nhat len dau
    $str_query .= ' LIMIT 0, ' . (int)$limit;
    
    $obj_result = $obj_helper->db->query($str_query);  
    return $obj_result->result_array(); 
}	

/**
 *-------------------------------------------------------------------
 * @description     : Lấy danh sách bất động sản liên quan cùng phân khúc (Trừ sản phẩm hiện tại)
 * @access          : public
 * @param int       : $nid_cat_product : ID nhóm danh mục sản phẩm
 * @param int       : $nid_current     : ID sản phẩm đang xem để loại trừ
 * @param int       : $limit           : Số lượng tin cần lấy
 * @return array    : Mảng danh sách sản phẩm liên quan
 *-------------------------------------------------------------------
 */
function get_product_related($nid_cat_product, $nid_current, $limit = 3)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = ' SELECT a.*, b.ctitle as ctitle_province ';
    $str_query .= ' FROM ' . Fget_ap_table('tproduct') . ' as a ';
    $str_query .= ' INNER JOIN ' . Fget_ap_table('tprovince') . ' as b ON a.nid_province = b.nid ';
    $str_query .= ' WHERE a.nstatus = 1 ';
    $str_query .= ' AND a.nid_cat_product = ' . (int)$nid_cat_product . ' ';
    $str_query .= ' AND a.nid != ' . (int)$nid_current . ' ';
    $str_query .= ' ORDER BY a.nid DESC LIMIT 0, ' . (int)$limit;
    
    return $obj_helper->db->query($str_query)->result_array();
}

/**
 *-------------------------------------------------------------------
 * @description     : Lay danh sach tin tuc cau hinh hien thi ngoai Trang chu (chome=1)
 * @access          : public
 * @param int       : $limit : So luong tin can lay (Mac dinh lay 3 tin)
 * @return array    : Mang danh sach tin tuc trang chu
 *-------------------------------------------------------------------
 */
function get_news_home($limit = 3)
{
    $obj_helper =& get_instance(); 
    $obj_helper->load->database();    
    
    // Explicit Join ket noi bang tin tuc tnews va tcat_news de lay ten danh muc tag tin tuc
    $str_query = ' SELECT a.*, b.ccat_news as ccat_news ';
    $str_query .= ' FROM ' . Fget_ap_table('tnews') . ' as a ';
    $str_query .= ' LEFT JOIN ' . Fget_ap_table('tcat_news') . ' as b ON a.nid_cat_news = b.nid ';
    $str_query .= ' WHERE a.nstatus = 1 '; 
    $str_query .= ' AND a.chome = "1" '; 
    $str_query .= ' ORDER BY a.nid DESC '; // Uu tien bai moi nhat len truoc
    $str_query .= ' LIMIT 0, ' . (int)$limit;
    
    $obj_result = $obj_helper->db->query($str_query);  
    return $obj_result->result_array(); 
}

/**
 * Đếm tổng số lượng tin tức hoạt động (Hỗ trợ lọc theo nid hoặc ccode)
 */
function get_count_news($cat_param = 0)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = ' SELECT a.nid FROM ' . Fget_ap_table('tnews') . ' as a ';
    $str_query .= ' LEFT JOIN ' . Fget_ap_table('tcat_news') . ' as b ON a.nid_cat_news = b.nid ';
    $str_query .= ' WHERE a.nstatus = 1 ';

    if (!empty($cat_param) && $cat_param !== '0') {
        if (is_numeric($cat_param)) {
            $str_query .= ' AND a.nid_cat_news = ' . (int)$cat_param . ' ';
        } else {
            $str_query .= ' AND b.ccode = ' . $obj_helper->db->escape($cat_param) . ' ';
        }
    }
    
    return $obj_helper->db->query($str_query)->num_rows();
}

/**
 * Lấy danh sách bài viết phân trang theo nhóm (Hỗ trợ lọc theo nid hoặc ccode)
 */
function get_list_news($cat_param = 0, $offset = 0, $row_per_page = 9)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = ' SELECT a.*, b.ccat_news as ccat_news, b.ccode as cat_ccode ';
    $str_query .= ' FROM ' . Fget_ap_table('tnews') . ' as a ';
    $str_query .= ' LEFT JOIN ' . Fget_ap_table('tcat_news') . ' as b ON a.nid_cat_news = b.nid ';
    $str_query .= ' WHERE a.nstatus = 1 ';

    if (!empty($cat_param) && $cat_param !== '0') {
        if (is_numeric($cat_param)) {
            $str_query .= ' AND a.nid_cat_news = ' . (int)$cat_param . ' ';
        } else {
            $str_query .= ' AND b.ccode = ' . $obj_helper->db->escape($cat_param) . ' ';
        }
    }

    $str_query .= ' ORDER BY a.cindex+0 ASC, a.nid DESC ';
    $str_query .= ' LIMIT ' . max(0, (int)$offset) . ', ' . (int)$row_per_page;
    
    return $obj_helper->db->query($str_query)->result_array();
}

/**
 *-------------------------------------------------------------------
 * @description     : Lấy danh sách tài liệu của một BĐS dựa trên quyền truy cập hiện tại
 * @access          : public
 * @param int       : $nid_product   : ID của bất động sản
 * @param int       : $current_level : Cấp độ quyền hiện tại của người dùng (1, 2 hoặc 3)
 * @return array    : Mảng danh sách tài liệu hợp lệ
 *-------------------------------------------------------------------

function get_product_documents($nid_product, $current_level = 1)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = ' SELECT * FROM ' . Fget_ap_table('tdocument') . ' ';
    $str_query .= ' WHERE nstatus = 1 ';
    $str_query .= ' AND nid_product = ' . (int)$nid_product . ' ';
    
    // Ép điều kiện: Chỉ lấy các file có mức độ bảo mật nhỏ hơn hoặc bằng quyền của user hiện tại
    $str_query .= ' AND naccess_level <= ' . (int)$current_level . ' ';
    $str_query .= ' ORDER BY ctype_doc ASC, nid DESC ';
    
    return $obj_helper->db->query($str_query)->result_array();
}
 */

/**
 *-------------------------------------------------------------------
 * @description     : Lấy toàn bộ danh sách tài liệu của một BĐS (Không lọc theo quyền)
 * @access          : public
 * @param int       : $nid_product : ID của bất động sản
 * @return array    : Mảng danh sách tất cả tài liệu hoạt động
 *-------------------------------------------------------------------
 */
function get_product_documents($nid_product)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = ' SELECT * FROM ' . Fget_ap_table('tdocument') . ' ';
    $str_query .= ' WHERE nstatus = 1 ';
    $str_query .= ' AND nid_product = ' . (int)$nid_product . ' ';
    $str_query .= ' ORDER BY ctype_doc ASC, nid DESC ';
    
    return $obj_helper->db->query($str_query)->result_array();
}

/**
 *-------------------------------------------------------------------
 * @description     : Lấy danh sách Mẫu biểu & Tập tin phân loại theo Tab hiển thị
 * @access          : public
 * @param string    : $access_type : 'public' (Công khai) hoặc 'member' (Chỉ Cư dân)
 * @return array    : Mảng danh sách tập tin/mẫu biểu
 *-------------------------------------------------------------------
 */
function get_building_files($access_type = 'public')
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = " SELECT * FROM " . Fget_ap_table('tfiles') . " ";
    $str_query .= " WHERE cdel = '0' AND nstatus = 1 AND ctype = 'document' ";
    $str_query .= " AND caccess_type = " . $obj_helper->db->escape($access_type) . " ";
    $str_query .= " ORDER BY cindex+0 ASC, nid DESC ";
    
    $obj_result = $obj_helper->db->query($str_query);
    return $obj_result->result_array();
}

/**
 *-------------------------------------------------------------------
 * @description     : Đếm tổng số lượng Tập tin / Mẫu biểu theo từng Tab
 *-------------------------------------------------------------------
 */
function count_building_files($access_type = 'public')
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = " SELECT COUNT(nid) as total_rows FROM " . Fget_ap_table('tfiles') . " ";
    $str_query .= " WHERE cdel = '0' AND nstatus = 1 AND ctype = 'document' ";
    $str_query .= " AND caccess_type = " . $obj_helper->db->escape($access_type) . " ";
    
    $row = $obj_helper->db->query($str_query)->row_array();
    return isset($row['total_rows']) ? (int)$row['total_rows'] : 0;
}

/**
 *-------------------------------------------------------------------
 * @description     : Lấy danh sách Nội quy - Quy định phân loại theo Tab hiển thị
 * @access          : public
 * @param string    : $access_type : 'public' (Công khai) hoặc 'member' (Chỉ Thành viên)
 * @return array    : Mảng danh sách văn bản Nội quy - Quy định
 *-------------------------------------------------------------------
 */
function get_building_rules($access_type = 'public')
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = " SELECT * FROM " . Fget_ap_table('tfiles') . " ";
    $str_query .= " WHERE cdel = '0' AND nstatus = 1 AND ctype = 'rules' ";
    $str_query .= " AND caccess_type = " . $obj_helper->db->escape($access_type) . " ";
    $str_query .= " ORDER BY cindex+0 ASC, nid DESC ";
    
    $obj_result = $obj_helper->db->query($str_query);
    return $obj_result->result_array();
}

/**
 *-------------------------------------------------------------------
 * @description     : Kiểm tra cấp độ quyền của tài khoản đang đăng nhập
 * @access          : public
 * @return int      : 1: Khách vãng lai, 2: Thành viên, 3: Nhân viên nội bộ
 *-------------------------------------------------------------------
 */
function check_current_user_level()
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    // 1. Nếu không tồn tại session đăng nhập -> Cấp 1 (Công khai)
    if (!isset($_SESSION['session_nid_member'])) {
        return 1;
    }
    
    $nid_member = (int)$_SESSION['session_nid_member'];
    
    // 2. Truy vấn kiểm tra xem tài khoản này có phải nhân viên không
    $str_query = ' SELECT nis_staff FROM ' . Fget_ap_table('tmember') . ' WHERE nid = ' . $nid_member . ' LIMIT 0,1 ';
    $member = $obj_helper->db->query($str_query)->row_array();
    
    if (!empty($member) && $member['nis_staff'] == 1) {
        return 3; // Cấp 3: Nhân viên bảo mật
    }
    
    return 2; // Cấp 2: Khách hàng/Thành viên thường
}

/**
 *-------------------------------------------------------------------
 * @description     : Lấy danh sách Menu hiển thị ngoài Frontend
 * @access          : public
 * @return array    : Mảng danh sách các mục Menu hoạt động
 *-------------------------------------------------------------------
 */
function get_frontend_menu()
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = ' SELECT nid, ctitle, clink ';
    $str_query .= ' FROM ' . Fget_ap_table('tmenu') . ' ';
    $str_query .= ' WHERE cdel = 0 AND nstatus = 1 ';
    $str_query .= ' ORDER BY cindex+0 ASC, nid ASC ';
    
    $obj_result = $obj_helper->db->query($str_query);
    return $obj_result->result_array();
}

/**
 *-------------------------------------------------------------------
 * Gửi tin nhắn qua API Telegram Bot (Core)
 *-------------------------------------------------------------------
 */
function send_telegram_core($chat_id, $message_text)
{
    $chat_id = trim($chat_id);
    if (empty($chat_id) || empty($message_text)) return FALSE;
    
    $bot_token = "8829107476:AAEJlU-4xdYDBffuMmNM5LDTyXN6L9VUD5A"; // Điền Token Bot Telegram vào đây
    $url = "https://api.telegram.org/bot" . $bot_token . "/sendMessage";
    
    $data = array(
        'chat_id'    => $chat_id,
        'text'       => $message_text,
        'parse_mode' => 'HTML'
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 8);
    
    $response = @curl_exec($ch);
    $curl_err = @curl_error($ch);
    $http_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE);
    @curl_close($ch);
    
    $res_arr = !empty($response) ? json_decode($response, true) : null;
    
    // Ghi log kiểm tra hoạt động Telegram
    $log_line = date('Y-m-d H:i:s') . " | ChatID: " . $chat_id . " | HTTP: " . $http_code . " | Response: " . (!empty($response) ? trim($response) : $curl_err) . "\n";
    @file_put_contents(FCPATH . 'telegram_debug.log', $log_line, FILE_APPEND);
    
    // TỰ ĐỘNG XỬ LÝ KHI GROUP ĐƯỢC NÂNG CẤP LÊN SUPERGROUP (MIGRATE TO CHAT ID)
    if (!empty($res_arr) && empty($res_arr['ok'])) {
        $retry_id = '';
        if (!empty($res_arr['parameters']['migrate_to_chat_id'])) {
            $retry_id = $res_arr['parameters']['migrate_to_chat_id'];
        }
        
        if (!empty($retry_id)) {
            $data['chat_id'] = $retry_id;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_TIMEOUT, 8);
            $response = @curl_exec($ch);
            $http_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE);
            @curl_close($ch);
            
            $log_retry = date('Y-m-d H:i:s') . " | RETRY ChatID: " . $retry_id . " | HTTP: " . $http_code . " | Response: " . (!empty($response) ? trim($response) : '') . "\n";
            @file_put_contents(FCPATH . 'telegram_debug.log', $log_retry, FILE_APPEND);
        }
    }
    
    return $response;
}

/**
 *-------------------------------------------------------------------
 * Gửi tin nhắn Telegram hàng loạt đồng thời (Parallel cURL Multi)
 * Tương thích 100% PHP 5.6, PHP 7.x, PHP 8.x, không gây nghẽn timeout
 * @param array $messages Mảng chứa danh sách array('chat_id' => ..., 'text' => ...)
 *-------------------------------------------------------------------
 */
function send_telegram_multi($messages = array())
{
    if (empty($messages) || !is_array($messages)) return FALSE;
    
    $bot_token = "8829107476:AAEJlU-4xdYDBffuMmNM5LDTyXN6L9VUD5A";
    $url = "https://api.telegram.org/bot" . $bot_token . "/sendMessage";
    
    $mh = curl_multi_init();
    $curl_handles = array();
    
    foreach ($messages as $i => $item) {
        if (empty($item['chat_id']) || empty($item['text'])) continue;
        
        $ch = curl_init();
        $data = array(
            'chat_id'    => $item['chat_id'],
            'text'       => $item['text'],
            'parse_mode' => 'HTML'
        );
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        
        curl_multi_add_handle($mh, $ch);
        $curl_handles[$i] = $ch;
    }
    
    if (empty($curl_handles)) {
        curl_multi_close($mh);
        return FALSE;
    }
    
    $running = null;
    do {
        $mrc = curl_multi_exec($mh, $running);
    } while ($mrc == CURLM_CALL_MULTI_PERFORM);

    while ($running > 0 && $mrc == CURLM_OK) {
        if (curl_multi_select($mh, 0.2) == -1) {
            usleep(50000);
        }
        do {
            $mrc = curl_multi_exec($mh, $running);
        } while ($mrc == CURLM_CALL_MULTI_PERFORM);
    }
    
    foreach ($curl_handles as $ch) {
        curl_multi_remove_handle($mh, $ch);
        curl_close($ch);
    }
    curl_multi_close($mh);
    return TRUE;
}

/**
 *-------------------------------------------------------------------
 * Hàm gửi Email dùng Mailjet REST API v3.1 (Gửi đơn hoặc Gửi hàng loạt 1 lần cURL)
 * @param string|array $to_email : Chuỗi 'a@gmail.com' HOẶC Mảng array('a@gmail.com', 'b@gmail.com')
 *                                 HOẶC Mảng array(array('Email' => 'a@gmail.com', 'Name' => 'A'))
 *-------------------------------------------------------------------
 */
function send_mail_mailjet($to_email, $subject, $message, $to_name = '')
{
    $api_key    = '6e0bab7456a99c77513304e446491805';
    $secret_key = '86540048b9dbdd27a70f57753f460d65';
    
    $from_email = 'info@picoplaza.vn'; 
    $from_name  = 'Hệ Thống PICO PLAZA';
    if (function_exists('get_value_by_config')) {
        $cfg = get_value_by_config(23);
        if (!empty($cfg)) $from_name = $cfg;
    } elseif (function_exists('get_config_value')) {
        $cfg = get_config_value(23);
        if (!empty($cfg)) $from_name = $cfg;
    }

    // 1. Đóng gói danh sách người nhận (To)
    $arr_to = array();

    if (is_array($to_email)) {
        foreach ($to_email as $item) {
            if (is_array($item)) {
                // Trường hợp mảng chứa cả Email & Name
                if (!empty($item['cemail'])) {
                    $arr_to[] = array(
                        'Email' => $item['cemail'],
                        'Name'  => !empty($item['cfullname']) ? $item['cfullname'] : $item['cemail']
                    );
                }
            } else {
                // Trường hợp mảng chuỗi Email đơn thuần
                if (!empty($item)) {
                    $arr_to[] = array('Email' => $item, 'Name' => $item);
                }
            }
        }
    } else {
        // Trường hợp chỉ gửi cho 1 Email đơn
        if (!empty($to_email)) {
            $arr_to[] = array(
                'Email' => $to_email,
                'Name'  => !empty($to_name) ? $to_name : $to_email
            );
        }
    }

    // Nếu danh sách nhận rỗng thì ngắt luôn
    if (empty($arr_to)) return FALSE;

    // 2. Đóng gói Payload gửi 1 lần duy nhất cho Mailjet
    $data_payload = array(
        'Messages' => array(
            array(
                'From' => array(
                    'Email' => $from_email,
                    'Name'  => $from_name
                ),
                'To'       => $arr_to, // Truyền toàn bộ danh sách khách hàng vào đây
                'Subject'  => $subject,
                'HTMLPart' => $message
            )
        )
    );

    // 3. Gọi cURL duy nhất 1 lần (Timeout nhanh 3s)
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_payload));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_USERPWD, $api_key . ":" . $secret_key);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    curl_setopt($ch, CURLOPT_NOSIGNAL, 1);

    $response  = @curl_exec($ch);
    $http_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE);
    @curl_close($ch);

    return ($http_code == 200 || $http_code == 201);
}

/**
 * Lấy danh sách toàn bộ danh mục tin tức (tcat_news) đang hoạt động
 */
function get_all_news_categories()
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = " SELECT nid, ccat_news, ccode, clink FROM " . Fget_ap_table('tcat_news') . " ";
    $str_query .= " WHERE nstatus = 1 ";
    $str_query .= " ORDER BY cindex+0 ASC, nid DESC ";
    
    return $obj_helper->db->query($str_query)->result_array();
}

/**
 * Lấy tối đa 4 bài viết mới nhất thuộc 1 danh mục tin tức
 */
function get_news_by_cat_id($nid_cat, $limit = 4)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = " SELECT a.*, b.ccat_news as ccat_news ";
    $str_query .= " FROM " . Fget_ap_table('tnews') . " as a ";
    $str_query .= " LEFT JOIN " . Fget_ap_table('tcat_news') . " as b ON a.nid_cat_news = b.nid ";
    $str_query .= " WHERE a.nstatus = 1 AND a.nid_cat_news = " . (int)$nid_cat . " ";
    $str_query .= " ORDER BY a.cindex+0 ASC, a.nid DESC LIMIT 0, " . (int)$limit;
    
    return $obj_helper->db->query($str_query)->result_array();
}

/**
 * Lấy thông tin danh mục tin tức (tcat_news) theo ccode hoặc nid
 */
function get_cat_news_info($param)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = " SELECT * FROM " . Fget_ap_table('tcat_news') . " WHERE nstatus = 1 ";
    if (is_numeric($param)) {
        $str_query .= " AND nid = " . (int)$param . " ";
    } else {
        $str_query .= " AND ccode = " . $obj_helper->db->escape($param) . " ";
    }
    $str_query .= " LIMIT 0,1 ";
    
    return $obj_helper->db->query($str_query)->row_array();
}

/**
 * Lấy danh sách email và họ tên của nhân sự có vai trò Quản lý Ticket (ticket_mgr) hoặc Admin (admin)
 */
function get_ticket_staff_emails()
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();
    
    $str_query = " SELECT cemail, cfullname FROM " . Fget_ap_table('tuser') . " ";
    $str_query .= " WHERE cstatus = '1' AND cdel = '0' AND cemail != '' ";
    $str_query .= " AND crole IN ('admin', 'ticket_mgr') ";
    
    $obj_result = $obj_helper->db->query($str_query);
    return $obj_result->result_array();
}

/**
 * Lấy danh sách hồ sơ thẩm định của thành viên / khách hàng nộp
 */
function get_my_doc_submissions($user_id)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();

    $user_id = (int)$user_id;
    if ($user_id <= 0) {
        return array();
    }

    $member_row = $obj_helper->db->where('nid', $user_id)->get(Fget_ap_table('tmember'))->row_array();
    $member_email = !empty($member_row['cemail']) ? trim($member_row['cemail']) : '';

    $where_cond = " (s.nid_user = " . $user_id;
    if (!empty($member_email)) {
        $where_cond .= " OR s.ccustomer_email = " . $obj_helper->db->escape($member_email);
    }
    $where_cond .= ") ";

    $str_query = " SELECT s.*, t.cname as doc_type_name,
                   (SELECT COUNT(*) FROM " . Fget_ap_table('tdoc_approval_step') . " WHERE nid_submission = s.nid) as total_steps,
                   (SELECT COUNT(*) FROM " . Fget_ap_table('tdoc_approval_step') . " WHERE nid_submission = s.nid AND cstep_status = 'APPROVED') as approved_steps
                   FROM " . Fget_ap_table('tdoc_submission') . " s
                   LEFT JOIN " . Fget_ap_table('tdoc_type') . " t ON s.nid_doc_type = t.nid
                   WHERE " . $where_cond . " 
                   ORDER BY s.nid DESC ";

    return $obj_helper->db->query($str_query)->result_array();
}

/**
 * Lấy danh sách hồ sơ thẩm định phân phối theo phòng ban
 */
function get_dept_review_list($dept_id = 0, $filter_status = '')
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();

    $where_sql = " WHERE 1=1 ";
    if ((int)$dept_id > 0) {
        $where_sql .= " AND step.nid_dept = " . (int)$dept_id . " ";
    }
    if (!empty($filter_status)) {
        $where_sql .= " AND step.cstep_status = " . $obj_helper->db->escape($filter_status) . " ";
    }

    $str_query = " SELECT step.*, s.ccode, s.ccustomer_name, s.ccustomer_phone, s.ctitle, s.cstatus as submission_status, 
                          s.ddate_submit, s.cfile_path, d.cname as dept_name, t.cname as doc_type_name
                   FROM " . Fget_ap_table('tdoc_approval_step') . " step
                   INNER JOIN " . Fget_ap_table('tdoc_submission') . " s ON step.nid_submission = s.nid
                   LEFT JOIN " . Fget_ap_table('tdepartment') . " d ON step.nid_dept = d.nid
                   LEFT JOIN " . Fget_ap_table('tdoc_type') . " t ON s.nid_doc_type = t.nid
                   " . $where_sql . "
                   ORDER BY (CASE WHEN step.cstep_status = 'PENDING' THEN 1 ELSE 2 END) ASC, s.nid DESC ";

    return $obj_helper->db->query($str_query)->result_array();
}

/**
 * Lấy thông tin bước duyệt của 1 phòng ban cụ thể cho 1 hồ sơ
 */
function get_dept_step_info($submission_id, $dept_id)
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();

    $str_query = " SELECT step.*, d.cname as dept_name, d.ccode as dept_code
                   FROM " . Fget_ap_table('tdoc_approval_step') . " step
                   LEFT JOIN " . Fget_ap_table('tdepartment') . " d ON step.nid_dept = d.nid
                   WHERE step.nid_submission = " . (int)$submission_id . " AND step.nid_dept = " . (int)$dept_id . " 
                   LIMIT 1 ";

    return $obj_helper->db->query($str_query)->row_array();
}

/**
 * Lấy danh sách toàn bộ hồ sơ cho Quản trị viên (Admin)
 */
function get_doc_submissions_list($filter_status = '', $filter_code = '')
{
    $obj_helper =& get_instance();
    $obj_helper->load->database();

    $where_sql = " WHERE 1=1 ";
    if (!empty($filter_status)) {
        $where_sql .= " AND s.cstatus = " . $obj_helper->db->escape($filter_status) . " ";
    }
    if (!empty($filter_code)) {
        $where_sql .= " AND (s.ccode LIKE '%" . $obj_helper->db->escape_like_str($filter_code) . "%' OR s.ccustomer_name LIKE '%" . $obj_helper->db->escape_like_str($filter_code) . "%') ";
    }

    $str_query = " SELECT s.*, t.cname as doc_type_name,
                          (SELECT COUNT(*) FROM " . Fget_ap_table('tdoc_approval_step') . " WHERE nid_submission = s.nid) as total_steps,
                          (SELECT COUNT(*) FROM " . Fget_ap_table('tdoc_approval_step') . " WHERE nid_submission = s.nid AND cstep_status = 'APPROVED') as approved_steps
                   FROM " . Fget_ap_table('tdoc_submission') . " s
                   LEFT JOIN " . Fget_ap_table('tdoc_type') . " t ON s.nid_doc_type = t.nid
                   " . $where_sql . "
                   ORDER BY s.nid DESC ";

    return $obj_helper->db->query($str_query)->result_array();
}