<?php 
class sitemap extends CI_Controller {

var $event 				= '';
var	$obj_detail			='';
var $m_language			='eng';

var $nid		= '';
var $nid_cat			= '';

var	$title					= '';
var	$tags					= '';
var	$description			= ''; 

var	$content			= ''; 

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

private function get_data()
{  
	
}
	
private function caculate_data()
{
	$base_url = Fstr_replace('admin/', '', base_url());
		$urls = [
			['loc' => '<a target="_blank" href="'.$base_url.'">'.$base_url.'</a>']
		];
		
		$list_sec = get_sec_all();
		foreach ($list_sec as $sec) {
			$url = $base_url.'san-pham/'.$sec['ccode'];
			$urls[] = ['loc' => '<a target="_blank" href="'.$url.'">'.$url.'</a>'];
			$list_cat = get_cat_by_sec($sec['nid']);
			foreach ($list_cat as $cat) {
				$url = $base_url.'san-pham/'.$sec['ccode'].'/'.$cat['ccode'];
				$urls[] = ['loc' => '<a target="_blank" href="'.$url.'">'.$url.'</a>'];
				$list_product = get_product_by_cat($cat['nid']);
				foreach ($list_product as $product) {
					$url = $base_url.$sec['ccode'].'/'.$cat['ccode'].'/'.$product['ccode'];
					$urls[] = ['loc' => '<a target="_blank" href="'.$url.'">'.$url.'</a>'];
				}
			}
		}
		
		$list_brand = get_brand_all();
		foreach ($list_brand as $data) {
			$url = $base_url.'thuong-hieu/'.$data['ccode'];
			$urls[] = ['loc' => '<a target="_blank" href="'.$url.'">'.$url.'</a>'];
		}
		
		$url = $base_url.'tin-tuc';
		$urls[] = ['loc' => '<a target="_blank" href="'.$url.'">'.$url.'</a>'];
		$list_news = get_news_all();
		foreach ($list_news as $news) {
			$url = $base_url.'tin-tuc/'.$news['ccode'];
			$urls[] = ['loc' => '<a target="_blank" href="'.$url.'">'.$url.'</a>'];
		}
		
		$url = $base_url.'lien-he';
		$urls[] = ['loc' => '<a target="_blank" href="'.$url.'">'.$url.'</a>'];
		
		$url = $base_url.'chinh-sach-giao-hang';
		$urls[] = ['loc' => '<a target="_blank" href="'.$url.'">'.$url.'</a>'];
		
		$url = $base_url.'chinh-sach-thanh-toan';
		$urls[] = ['loc' => '<a target="_blank" href="'.$url.'">'.$url.'</a>'];
		
		$url = $base_url.'chinh-sach-doi-tra';
		$urls[] = ['loc' => '<a target="_blank" href="'.$url.'">'.$url.'</a>'];
		
		$url = $base_url.'chinh-sach-bao-mat';
		$urls[] = ['loc' => '<a target="_blank" href="'.$url.'">'.$url.'</a>'];
		
		// Tạo nội dung XML cho sitemap
		$sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
		$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		
		$i=1;
		foreach ($urls as $url) {
			$sitemap .= '<url>';
			$sitemap .= '<loc>' .$i.'. '. htmlspecialchars($url['loc']) . '</loc>';
			$sitemap .= '</url>';
			$i++;
		}

		$sitemap .= '</urlset>';

		// Ghi nội dung XML vào tệp sitemap.xml
		$file = fopen('sitemap.xml', 'w');
		fwrite($file, $sitemap);
		fclose($file);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, base_url().'sitemap.xml');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec ($ch);
		curl_close ($ch);
		$xml = new SimpleXMLElement($data);
		foreach ($xml->url as $url_list) {
			$url = $url_list->loc;
			//echo $url.'</br>';
			$this->content .= $url.'</br>';
		}
}
	
private function do_business()
{	
	$data['title']			= $this->title;
	$data['tags']			= $this->tags;
	$data['description']	= $this->description;
	$data['nid']			= $this->nid;
	$data['menu_sec']		= '';
	$data['menu_cat']		= '';
	
	$data['menu_top']		= "sitemap";
	$data['content']		= $this->content;

	$this->load->view('sitemap',$data);	
}
	
private function destroy_data()
{
			
}
private function get_where_sitemap_string()
{
		

		return $str ;
}

}