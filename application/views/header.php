<!DOCTYPE html>
<html xmlns="https://www.w3.org/1999/xhtml">
   <head>
   	<meta http-equiv="pragma" content="no-cache" />
      <?php	header("Content-Type: text/html; charset=UTF-8"); ?>
      <?php
         $title_global		= '';
         $tags_global		= '';
         $description_global	= '';
		 
		$desc = get_config_byid2(4);
		$img = get_config_byid2(7);
		$fb_cimage_url  = base_url().'upload/fb/'.$img['cimage'];
		$fb_cdescription  = $desc['cvalue'];
		
		/*
		if($menu_top=="product_detail") {
			$fb_cimage_url  = base_url().'upload/images_product/fb/'.$cproduct_fb;
			$fb_cdescription  = $fb_cdescription;
		} elseif($menu_top=="news") {
			$fb_cimage_url  = base_url().'upload/image_article/'.$obj_news['cimage_thumb'];
			$fb_cdescription  = $obj_news['cnote'];
		} else {
			$fb_cimage_url  = base_url().'upload/fb/'.$img['cimage'];
			$fb_cdescription  = $desc['cvalue'];
		} */
         ?>

	  <meta property="og:title"              content="<?php echo $title; ?>" />
	  <meta property="og:description"        content="<?php echo $fb_cdescription; //$subsite['cmeta_desc_global']; ?>" />
      <meta property="og:image"              content="<?php echo $fb_cimage_url; //base_url().'upload/fb/'.$subsite['cimage_fb']; ?>" />

      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
      <meta name="mobile-web-app-capable" content="yes"/>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="facebook-domain-verification" content="wvyooknqxiqjdt9my9bqo98ucsg0ij" />
      <meta http-equiv="content-language" content ="vn" />
      <title><?php 
         if($title != '') 
         	echo $title; 
         else 
         { 
         	$obj_data = get_config_byid(3);
         	 foreach($obj_data as $data):
         		$title_global	= $data['cvalue'];
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
         	$description_global		= $data['cvalue'];
          endforeach;	
         ?>
      <meta name="description" content="<?php echo $fb_cdescription; //$subsite['cmeta_desc_global']; //$description_global ?>">
      <?php endif; ?>
      <meta name="robots" content="INDEX, FOLLOW"/>
      <meta name="robots" content="NOODP, NOYDIR"/>
      <link href="<?php //$cf = get_config_by_id(8); echo base_url().'upload/fb/'.$cf['cimage']; ?><?php echo base_url(); ?>favicon.svg?v<?php echo time(); ?>" rel="shortcut icon" type="image/x-icon">

	<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,500;0,9..144,600;1,9..144,400;1,9..144,500&family=Manrope:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css?v<?php echo time(); ?>" media="all" />	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/my_style.css?v<?php echo time(); ?>" media="all" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/gallery.css?v<?php echo time(); ?>" media="all" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/responsive_style.css?v<?php echo time(); ?>" media="all" />
	  