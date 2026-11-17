<?php
class ajax_actions extends CI_Controller
{
    function __construct()
	{ 
		parent::__construct();
        session_start();
        $this->load->database();
        $this->load->helper('ap_db');
        $this->load->helper('ap_object');
        $this->load->helper('ap_function');
        $this->load->helper('ap_view');
        $this->load->helper('ap_module');
        $this->load->helper('ap_cart');
        $this->load->helper('ap_mail');
		date_default_timezone_set('Asia/Saigon');
    }
	function ajax_post_cart()
    {
        $id_pro  = '';
        $qty_pro = '';
        if (isset($_POST['id_pro']))
            $id_pro = $_POST['id_pro'];
        if (isset($_POST['qty_pro']))
            $qty_pro = $_POST['qty_pro'];
        add_cart($id_pro, $qty_pro);
        echo 'done';
    }
    function ajax_update_cart()
    {
        $id_pro  = '';
        $qty_pro = '';
        if (isset($_POST['id']))
            $id_pro = $_POST['id'];
        if (isset($_POST['qty']))
            $qty_pro = $_POST['qty'];
        update_cart($id_pro, $qty_pro);
        echo 'done';
    }
    function ajax_remove_cart()
    {
        $id_pro = '';
        if (isset($_POST['id']))
            $id_pro = $_POST['id'];
        remove_cart($id_pro);
        echo 'done';
    }
	function ajax_sort()
    {
        $value = '';
        if (isset($_POST['value']))
            $_SESSION['sort'] = $_POST['value'];
		
        exit("done");
    }
	function empty_cart()
    {
        $_SESSION["cart"] 		= NULL;
		$_SESSION["cname"]     = NULL;
		$_SESSION["cemail"]    = NULL;
		$_SESSION["cphone"]    = NULL;
		$_SESSION["cquantity"] = NULL;
		$_SESSION["cnote"]     = NULL;
		$_SESSION["caddress"]     = NULL;
		$_SESSION["empty"] = NULL;
		
		$_SESSION["cemail_log"]    = NULL;
		
		$_SESSION["cgender"]  = NULL;
		$_SESSION["cfullname"] = NULL;
		$_SESSION["cphone"] = NULL;
		$_SESSION['caddress'] = NULL;
		$_SESSION['province'] = NULL ;
		$_SESSION['district'] = NULL;
		$_SESSION['cvat_company'] = NULL;
		$_SESSION['cvat_tax'] = NULL;
		$_SESSION['cvat_address'] = NULL;
		$_SESSION['cgift'] = NULL;
		
		$_SESSION['price_sale'] = NULL;
		$_SESSION['code_sale'] = NULL;
		$_SESSION['per_sale'] = NULL;
		$_SESSION['nsale'] = NULL;
		$_SESSION['nid_code_sale'] = NULL;
		$_SESSION['total_no_with'] = NULL; 
		$_SESSION['flag_dg'] = NULL;
		$_SESSION['total'] = NULL;
		exit('1');
    }
	function get_detail_ajax() {
		$product_id = $this->input->post('id');

		if ($product_id) {
			$obj_detail = get_product_detail($product_id); 
			
			if ($obj_detail) {
				?>
				<div class="product-popup-detail" style="max-width: 1200px; padding: 25px; background:#fff; border-radius:12px;">
					<div class="product-flex-container" style="display: flex; gap: 30px; flex-wrap: wrap;">
						
						<div class="product-popup-left" style="flex: 1; min-width: 300px;">
							<div class="image-wrapper" style="border: 1px solid #eee; border-radius: 8px; overflow: hidden;">
								<img src="<?php echo base_url().'upload/images_product/full_images/'.$obj_detail['cimage']; ?>" 
									 alt="<?php echo $obj_detail['cproducts']; ?>"
									 style="width: 100%; height: auto; display: block; object-fit: contain;">
							</div>
						</div>

						<div class="product-popup-right" style="flex: 1.5; min-width: 300px;">
							<h2 style="color:#0891b2; font-size: 24px; margin-top: 0; margin-bottom: 15px; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px;">
								<?php echo $obj_detail['cproducts']; ?>
							</h2>
							
							<div class="detail-text-content" style="line-height: 1.6; font-size: 15px; color: #444; max-height: 400px; overflow-y: auto; padding-right: 10px;">
								<?php echo $obj_detail['cdetail']; ?>
							</div>


						</div>

					</div>
				</div>
				<?php
			} else {
				echo "<div style='padding:20px;'>Không tìm thấy sản phẩm.</div>";
			}
		}
		exit;
	}
}
	