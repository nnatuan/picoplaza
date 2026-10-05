<?php 
class get_json_vtp extends CI_Controller {

var $event 				= '';
var	$obj_detail			='';
var $m_language			='eng';

var $nid		= '';
var $nid_cat			= '';

var	$title					= '';
var	$tags					= '';
var	$description			= ''; 
var	$shopid			= ''; 
var	$token			= ''; 
var	$pre_url_api			= ''; 

function __construct()
	{ 			
		
		parent::__construct();	
		session_start();
		
		$this->load->database();	
		$this->load->helper('ap_function');
		$this->load->helper('ap_object');
		$this->load->helper('ap_html');
		$this->load->helper('ap_view_helper');
		$this->load->helper('ap_db');
		//$this->load->helper('ap_module');		
		$this->config->check_system_login = '1';
		/*
		$nbh = get_setting_by_user(Fget_userdata('session_nid_user'));
		$this->shopid = $nbh['shopid'];
		$this->token = $nbh['token'];

		$cf = get_config_by_id(13);
		if($cf['cvalue']==1)
			$this->pre_url_api = "https://online-gateway.ghn.vn/";
		else
			$this->pre_url_api = "https://dev-online-gateway.ghn.vn/";
		*/
	}



function index()
{
	$this->do_process();
}
	
function do_process() 
{
	$this->get_data(); 		
	$this->caculate_data(); 		
	$this->do_business(); 		
	$this->destroy_data();
}
function detail($nid)	
{
	$this->nid = $nid;
	$this->do_process();

}
function get_shop_info()
    { 
		$url = $this->pre_url_api.'shiip/public-api/v2/shop/all';
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"token: ".$this->token
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		//$data = '{"nid":"John"}';
		//$product = get_news_by_id(491);
		//$product = get_product_all();
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  exit($response);
		  /*
		  exit(json_encode($response));
		  exit(json_encode($product));
		  exit($data);
		  exit(json_encode($data));
		  */
		}
	}
	
function get_token_by_order()
    { 
		$url = $this->pre_url_api.'shiip/public-api/v2/a5/gen-token?order_codes='.$_POST['code'];
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
			"token: ".$this->token
			//"token: d4717513-d13c-11ee-8586-12380ed2f541"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		//$data = '{"nid":"John"}';
		//$product = get_news_by_id(491);
		//$product = get_product_all();
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  exit($response);
		  /*
		  exit(json_encode($response));
		  exit(json_encode($product));
		  exit($data);
		  exit(json_encode($data));
		  */
		}
	}	
function login_vtp()
    { 
		$par = array(
			"USERNAME" => $_POST['cid'],
			"PASSWORD" => $_POST['cpassword'],
		);
		$url = 'https://partner.viettelpost.vn/v2/user/Login';
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => json_encode($par),
		  CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json",
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			$res = json_decode($response,true);	
			if($res['status']==200) {
				$_SESSION['token'] = $res['data']['token'];
				/*
				$this->db->set('ctoken', $res['data']['token']);
				$this->db->where('nid_user',Fget_userdata('session_nid_user'));
				$this->db->update('tsetting');
				*/
			}
			exit($response);
		}
	}		
function login_get_token()
    { 
		$par = array(
			"USERNAME" => $_POST['cid'],
			"PASSWORD" => $_POST['cpassword'],
		);
		$url = 'https://partner.viettelpost.vn/v2/user/Login';
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => json_encode($par),
		  CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json",
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			$res = json_decode($response,true);	
			if($res['status']==200) {
				$this->db->set('ctoken', $res['data']['token']);
				$this->db->where('nid_user',Fget_userdata('session_nid_user'));
				$this->db->update('tsetting');
			}
			exit($response);
		}
	}		
function get_service()
    { 
		$par = array(
			"TYPE" => 2
		);
		$url = 'https://partner.viettelpost.vn/v2/categories/listService';
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => json_encode($par),
		  CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json",
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		//$data = '{"nid":"John"}';
		//$product = get_news_by_id(491);
		//$product = get_product_all();
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  exit($response);
		}
	}	
function get_province()
    { 
		$url = 'https://partner.viettelpost.vn/v2/categories/listProvinceById?provinceId=-1';
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		//$data = '{"nid":"John"}';
		//$product = get_news_by_id(491);
		//$product = get_product_all();
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  exit($response);
		  /*
		  exit(json_encode($response));
		  exit(json_encode($product));
		  exit($data);
		  exit(json_encode($data));
		  */
		}
	}
function get_district()
    { 
		$url = 'https://partner.viettelpost.vn/v2/categories/listDistrict?provinceId='.$_POST['nid_province'];
		//exit($_POST['nid_province']);
		//$arr = ['province_id' => 202];
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  //CURLOPT_POSTFIELDS => $arr,
		  CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		//$data = '{"nid":"John"}';
		//$product = get_news_by_id(491);
		//$product = get_product_all();
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  exit($response);
		  /*
		  exit(json_encode($response));
		  exit(json_encode($product));
		  exit($data);
		  exit(json_encode($data));
		  */
		}
	}	
function get_ward()
    { 
		$url = 'https://partner.viettelpost.vn/v2/categories/listWards?districtId='.$_POST['nid_district'];
		//$arr = ['district_id' => $_POST['nid_district']];
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  //CURLOPT_POSTFIELDS => $arr,
		  CURLOPT_HTTPHEADER => array(
			"cache-control: no-cache",
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		//$data = '{"nid":"John"}';
		//$product = get_news_by_id(491);
		//$product = get_product_all();
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  exit($response);
		  /*
		  exit(json_encode($response));
		  exit(json_encode($product));
		  exit($data);
		  exit(json_encode($data));
		  */
		}
	}
function tinh_phi_ship()
    { 
		$setting = get_setting_by_user(Fget_userdata('session_nid_user'));

		$par = array(	
			"PRODUCT_WEIGHT" => $_POST['weight'],
			"PRODUCT_LENGTH" => $_POST['length'],
			"PRODUCT_WIDTH" => $_POST['width'],
			"PRODUCT_HEIGHT" => $_POST['height'],
			
			"PRODUCT_PRICE" => $_POST['PRODUCT_PRICE'],
			"MONEY_COLLECTION" => $_POST['MONEY_COLLECTION'],
			"ORDER_SERVICE" => $_POST['ORDER_SERVICE'],
			"SENDER_PROVINCE" => $setting['nid_province'],
			"SENDER_DISTRICT" => $setting['nid_district'],
			"RECEIVER_PROVINCE" => $_POST['RECEIVER_PROVINCE'],
			"RECEIVER_DISTRICT" => $_POST['RECEIVER_DISTRICT'],
			
			"PRODUCT_TYPE" => "HH",
			"NATIONAL_TYPE" => 1
		);
		$url = 'https://partner.viettelpost.vn/v2/order/getPrice';
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => json_encode($par),
		  //CURLOPT_POSTFIELDS => $par,
		  CURLOPT_HTTPHEADER => array(
			"Content-Type: application/json",
			//"cache-control: no-cache",
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
		//$data = '{"nid":"John"}';
		//$product = get_news_by_id(491);
		//$product = get_product_all();
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  exit($response);
		  /*
		  exit(json_encode($response));
		  exit(json_encode($product));
		  exit($data);
		  exit(json_encode($data));
		  */
		}
	}	
private function get_data()
{  
	
}
	
private function caculate_data()
{
	
}
	
private function do_business()
{	
	$data['title']			= $this->title;
	$data['tags']			= $this->tags;
	$data['description']	= $this->description;
	$data['nid']			= $this->nid;
	$data['menu_sec']		= '';
	$data['menu_cat']		= '';
	
	$data['menu_top']		= "get_json_vtp";
	$data['g_ishome']		= 0;

	$this->load->view('get_json_vtp',$data);	
}
	
private function destroy_data()
{
			
}
private function get_where_get_json_vtp_string()
{
		

		return $str ;
}

}