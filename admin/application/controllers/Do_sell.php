<?php	if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * GHI CHÚ:
 Khi tạo đơn thì cvat lưu ở khách hàng và ở order
 *  
 */
  
// ------------------------------------------------------------------------
class do_sell extends CI_Controller 
{
	var $m_language 		= ''; 
	var $m_nid_user_login 	= ''; 
	
	var $m_event			= 'view';
		
	var $m_action			= ''; 	 
	var $m_frm_link_to_		= ''; 

	var $m_txt_user_name	= ''; 
	var $m_txt_password		= ''; 
	var $cnote = '';
	var $ntotal = '';
	var $cname = '';
    var $caddress = '';
	var $cvat = '';
	var $cship = '';
	var $cmst = '';
    var $cemail = '';
    var $cphone = '';
	var $btn_submit = '';
	var $msg_err = '';
	var $check_customer_old = '';
	var $id_customer_old = '';
	var $cprice_receive = '';
	var $cprice_refund = '';
	var $cpayment_method = '';
	var $cprice_sale_vnd = '';
	var $cprice_sale_per = '';
	var $ccode_order = '';
	// ------------------------------------------------------------------------
	
/**
 * Constructor
 *
 * Load cac thu vien can su dung cho class
 *
 * @access	public
 */	
function __construct()
	{ 
		parent::__construct();  
		session_start();
		$this->load->database();
		$this->load->helper('ap_function');
		$this->load->helper('ap_db');
		$this->load->helper('ap_html');
		$this->load->helper('ap_object');
		//$this->load->helper('ap_module');
		//$this->load->helper('ap_cart');
		$this->config->check_system_login = '1';  
	}
	
	// ------------------------------------------------------------------------
	
/**
 * Goi tuan tu cac ham theo dung quy dinh ve luong du lieu
 * 
 * @access	public
 */		
function index()
	{
		$this->get_data(); 
		$this->caculate_data(); 
		$this->do_business();
		$this->destroy_data();
	}	
function do_process()
    {
        $this->get_data();
        $this->caculate_data();
        $this->do_business();
        $this->destroy_data();
    }	
function ghn()
	{
		$this->m_event = "ghn";
		$this->do_process();
	}	
function viettelpost()
	{
		if(!isset($_SESSION['token']))
			$this->m_event = "viettelpost_login";
		else
			$this->m_event = "viettelpost";
		$this->do_process();
	}
function vtp_order($ccode)
	{
		$this->ccode_order = $ccode;
		if(!isset($_SESSION['token']))
			$this->m_event = "viettelpost_login";
		else
			$this->m_event = "viettelpost";
		$this->do_process();
	}
function layout_2()
	{
		$this->m_event = "layout_2";
		$this->do_process();
	}	
	// ------------------------------------------------------------------------
	
/**
 * Khong can xu ly
 *
 * @access	private
 */	
private function get_data()
	{
		$this->m_nid_user_login = Fget_userdata('session_nid_user');
		$this->m_language = Fget_userdata('session_user_language');	
		// Load file ngon ngu can su dung.
		$this->load->language('ap', $this->m_language);
		
		// Your code at here	
		if (isset($_POST['cname']))
            $this->cname = $_POST['cname'];
		if (isset($_POST['caddress']))
            $this->caddress = $_POST['caddress'];
		if (isset($_POST['cvat']))
            $this->cvat = $_POST['cvat'];
		if (isset($_POST['cship']))
            $this->cship = $_POST['cship'];
		if (isset($_POST['cmst']))
            $this->cmst = $_POST['cmst'];
		if (isset($_POST['cemail']))
            $this->cemail = $_POST['cemail'];
		if (isset($_POST['cphone']))
            $this->cphone = $_POST['cphone'];
		if (isset($_POST['cnote']))
            $this->cnote = $_POST['cnote'];
		if (isset($_POST['ntotal']))
            $this->ntotal = $_POST['ntotal'];
		if (isset($_POST['btn_submit']))
            $this->btn_submit = $_POST['btn_submit'];	
		if (isset($_POST['check_customer_old']))
            $this->check_customer_old = $_POST['check_customer_old'];	
		if (isset($_POST['id_customer_old']))
            $this->id_customer_old = $_POST['id_customer_old'];
		if (isset($_POST['cprice_receive']))
            $this->cprice_receive = $_POST['cprice_receive'];
		if (isset($_POST['cprice_refund']))
            $this->cprice_refund = $_POST['cprice_refund'];
		if (isset($_POST['cpayment_method']))
            $this->cpayment_method = $_POST['cpayment_method'];
		if (isset($_POST['cprice_sale_vnd']))
            $this->cprice_sale_vnd = $_POST['cprice_sale_vnd'];
		if (isset($_POST['cprice_sale_per']))
            $this->cprice_sale_per = $_POST['cprice_sale_per'];
	}

	// ------------------------------------------------------------------------
	
/**
 * Khong can xu ly
 *
 * @access	private
 */		
private function caculate_data()
	{
		// Your code at here	
		/*
		if ($this->btn_submit != '') {
            $this->insert_cart();
        }	
		$list = get_order_tmp_by_member($this->m_nid_user_login); 
		if(count($list)==0) {
			$data = array(
			'nid_member' => $this->m_nid_user_login,
			'cprice_receive' => 0,
			'cprice_refund' => 0,
			'cprice_sale_vnd' => 0,
			'cprice_sale_per' => 0,
			'cnote' => '',
			'nactive' => 1
			);
			$this->db->insert('torder_tmp', $data);
		}	
		if(!isset($_SESSION['nid_order_tmp'])) {
			$order = get_order_tmp_active(Fget_userdata('session_nid_user'));
			if(isset($order['nid']))
				$_SESSION['nid_order_tmp'] = $order['nid'];
		}
		*/
	}
function insert_cart()
    {
		date_default_timezone_set('Asia/Saigon');
        
		$order_tmp = get_order_tmp_by_id($_SESSION['nid_order_tmp']);
		$list_detail = get_order_detail_tmp_by_order($_SESSION['nid_order_tmp']);
		if(count($list_detail) > 0) {
			if ($this->check_customer_old == 1) {
				$id_customer = $this->id_customer_old;
			} else {
				$data_customer           = array(
				"cname" => $this->cname,
				"cemail" => $this->cemail,
				"cphone" => $this->cphone,
				"caddress" => $this->caddress,
				'niduser01'     			=> $this->m_nid_user_login,
				'ddate01'					=> dbget_current_date()
				//"cvat" => $this->cvat
				);		
				$this->db->insert("tcustomer", $data_customer);
				$id_customer = dbget_identity();
			}
			if($id_customer != '') {
				if($this->cprice_receive >= $this->ntotal) {
						$order_status = 1;
						if($this->cpayment_method == 0 || $this->cpayment_method == 1)
							$order_status = 2;
						$data           = array(
							"nid_customer" => $id_customer,
							"nid_member" => $this->m_nid_user_login,
							"cfullname" => $this->cname,
							"cemail" => $this->cemail,
							"nphone" => $this->cphone,
							"caddress" => $this->caddress,
							"cnote" => $this->cnote,
							"ntotal" => $this->ntotal,
							"cmst" => $this->cmst,
							"cvat" => $this->cvat,
							"cship" => $this->cship,
							"cin_hoa_don" => 0,
							"cprice_receive" => $this->cprice_receive,
							"cprice_refund" => $this->cprice_refund,
							"cprice_sale_vnd" => $this->cprice_sale_vnd,
							"cprice_sale_per" => $this->cprice_sale_per,
							"cpayment_method" => $this->cpayment_method,
							"ctime" => time(),
							"ctime_search" => strtotime(date("m/d/Y",time())),
							"nid_order_status" => $order_status,
							//"ctype_order" => 0,
							'niduser01'     			=> $this->m_nid_user_login,
							"ddate01" => date("Y-m-d"),
							"ctime01" => date("H:i:s")
						);
						$this->db->insert("torder", $data);
						$id_cart = dbget_identity();
						//$ccode_order= "ANMY".($id_cart+100000000);
						$ccode_order= "AM".$this->m_nid_user_login.$id_cart;
						$data_code_order = array('ccode' => $ccode_order);
						$this->db->where('nid', $id_cart);
						$this->db->update('torder',$data_code_order);
						
						foreach ($list_detail as $cart) {
								   $product = get_product_byid($cart['nid_product']);
								   if($product['fprice_sale'] != 0 && $product['fprice_sale'] != '')
										$price=$product['fprice_sale'];
									else
										$price=$product['fprice'];
							$data_detail = array(
								'nid_order' => $id_cart,
								'nid_product' => $cart['nid_product'],
								'nquantity' => $cart['nquantity'],
								//'nquantity_remain' => $cart['nquantity'],
								'cprice' => $price,
								'cprice_sale_vnd' => $cart['cprice_sale_vnd'],
								'cprice_sale_per' => $cart['cprice_sale_per'],
								'cnote' => $cart['cnote']
							);
							$this->db->insert('torder_detail', $data_detail);
						}
						
						empty_cart();
						
						//xoa data bang tam
						$this->db->where('nid', $_SESSION['nid_order_tmp']);
						$this->db->delete('torder_tmp');
						$this->db->where('nid_order', $_SESSION['nid_order_tmp']);
						$this->db->delete('torder_detail_tmp');
						
						$order = get_order_tmp_max_id($this->m_nid_user_login);
						$data = array('nactive' => 1);
						$this->db->where('nid', $order['nid']);
						$this->db->update('torder_tmp', $data);
						$_SESSION['nid_order_tmp'] = $order['nid'];
						
						redirect(base_url().'index.php/do_order/f_edit/'.$id_cart);

				}
				else {
					$this->msg_err = 'Số tiền khách đưa không đủ';
				}
			} else {
				$this->msg_err = 'Chưa có thông tin khách hàng';
			}
		} else {
			$this->msg_err = 'Đơn hàng chưa có sản phẩm';
		}
    }	
// ------------------------------------------------------------------------

/**
 * Thiet lap cac session dung chung cho toan he thong 
 * Redirect do_login controller
 *
 * @access	private
 */
private function do_business()
	{				 
		/*$data['view'] = 'sell';
		$data['password'] = Fget_userdata('session_user_full_name');		
		$data['user_fullname'] = Fget_userdata('session_user_full_name');
		$data['user_encode'] = Obj_get_encode($str);
		$data['user_decode'] = Obj_get_decode(Obj_get_encode($str));*/
		$data['menu'] = Fget_menu_html($this->m_nid_user_login);
		$data['menu_active']	= 'sell';
		$data['menu_group_active']		= 'order';
		$data['msg_err']	= $this->msg_err;
		$data['cname']	= $this->cname;
		$data['cemail']	= $this->cemail;
		$data['cphone']	= $this->cphone;
		$data['caddress']	= $this->caddress;
		$data['cvat']	= $this->cvat;
		$data['cship']	= $this->cship;
		$data['cmst']	= $this->cmst;
		$data['cnote']	= $this->cnote;
		$data['cprice_receive']	= $this->cprice_receive;
		$data['cprice_refund']	= $this->cprice_refund;
		$data['cprice_sale_vnd']	= $this->cprice_sale_vnd;
		$data['cprice_sale_per']	= $this->cprice_sale_per;
		$data['cpayment_method']	= $this->cpayment_method;
		$data['event'] = $this->m_event;
		$data['nid_user'] = $this->m_nid_user_login;
		$data['ccode_order'] = $this->ccode_order;
		$data['fr_img']              = Fstr_replace('admin/', '', base_url());
		//exit($this->m_event);
		$this->load->view('sell_view/index', $data);
	}
		
	// ------------------------------------------------------------------------
	
/**
 * Khong can xy ly
 *
 * @access	private
 */			
private function destroy_data()
	{
	
	}

// END do_init class		
}		
/* End of file do_init.php */
/* Location: controller/do_init.php */