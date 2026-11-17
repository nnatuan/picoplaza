<?php 
$key = $_POST['key']; 
$list = get_customer_by_key($nid_user, $key);
if(count($list)>0) {
foreach ($list as $data) {
?>
			   <div class="item-search-customer" onclick="select_customer('<?php echo $data['nid']; ?>');">
				 <?php echo $data['cphone'].' - '.$data['cname']; ?>
			  </div>
<?php } } else exit('0'); ?>