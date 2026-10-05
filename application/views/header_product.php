<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml">
   <head>
    <meta http-equiv="pragma" content="no-cache" />
      <?php header("Content-Type: text/html; charset=UTF-8"); ?>
      <?php
         $title_global     = '';
         $tags_global      = '';
         $description_global  = '';
		 
		 $base_url = str_replace('www.', '', base_url());
		$subsite = get_subsite_by_url($base_url);
		if(!isset($subsite['nid'])) exit("Cấu hình tên miền subsite không hợp lệ!");
         ?>

      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
      <meta name="apple-mobile-web-app-capable" content="yes"/>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta http-equiv="content-language" content ="vn" />

      <meta property="og:title"              content="<?php echo $title . ' - Giá cực rẻ!'?>" />
      <meta property="og:description"        content="<?php echo $fb_cdescription?>" />
      <meta property="og:image"              content="<?php echo base_url().'upload/images_product/fb/'.$cproduct_fb ?>" />
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
      <meta name="apple-mobile-web-app-capable" content="yes"/>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta http-equiv="content-language" content ="vn" />
      <title><?php 
         if($title != '') 
            echo $title; 
         else 
         { 
            $obj_data = get_config_byid(3);
             foreach($obj_data as $data):
               $title_global  = $data['cvalue'];
             endforeach;
            echo $title_global;
         }
         ?>
      </title>
      <?php if($description != ''): ?>

      <?php 
         else: 
          $obj_data = get_config_byid(4);
          foreach($obj_data as $data):
            $description_global     = $data['cvalue'];
          endforeach;   
         ?>
      <meta name="description" content="<?php echo $description_global ?>">
      <?php endif; ?>
      <meta name="robots" content="INDEX, FOLLOW"/>
      <meta name="robots" content="NOODP, NOYDIR"/>
      <link href="<?php echo base_url().'upload/logo/'.$subsite['cimage_favicon']; ?>" rel="shortcut icon" type="image/x-icon">
      
	  <style>
		:root {
                --mau_chu_dao: <?php echo $subsite['cmau_nen']; ?>;
            }
		</style>
	  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/layout.css" media="all" />
	  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/6fd1ececbaf2f2c8aa8ea43532439dfd.css" media="all" />
	  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/my_style.css" media="all" />
      <script type="text/javascript" src="<?php echo base_url(); ?>js/6d472e74730cfe74220f020fcfafab31.js"></script>
	  <script type="text/javascript" src="<?php echo base_url(); ?>js/dcc1963f02c3f03143221ffe8ce08759.js"></script>
	  <?php /*<script type="text/javascript" src="<?php echo base_url(); ?>js/1bf78fa0e72be2ccfa19e44750d817e2.js"></script>*/ ?>