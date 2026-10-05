<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
$route['default_controller']                                        = "home";
$route['/?utm_source=(:any)&utm_medium=(:any)&utm_campaign=(:any)&zarsrc=(:any)'] = "home";
$route['/?zarsrc=(:any)&utm_source=(:any)&utm_medium=(:any)&utm_campaign=(:any)'] = "home";

//$route['news']                                                   = "news_list/cat_page/0/1";
$route['news-list/([a-zA-Z0-9-_]+)/(:num)'] = "news_list/cat_page/$1/$2";
$route['news-list/([a-zA-Z0-9-_]+)']       = "news_list/cat_page/$1/1";
//$route['news-list/(:any)']                                                   = "news_list/cat_page/0/$1";
$route['posts']                                                   = "products";
$route['post/([a-zA-Z0-9-_]+)']                                                   = "product_detail/view/$1";
$route['news/([a-zA-Z0-9-_]+)']                                                   = "news_detail/detail/$1";
$route['edit_post/(:num)']                                                   = "edit_post/index/$1";

// Routes Cổng Dịch Vụ & Thẩm Định Hồ Sơ Trực Tuyến
$route['portal-tham-dinh']                     = "doc_portal/index";
$route['portal-tham-dinh/nop-ho-so']           = "doc_portal/submit";
$route['portal-tham-dinh/nop-ho-so/(:num)']    = "doc_portal/submit/$1";
$route['portal-tham-dinh/theo-doi/(:any)']     = "doc_portal/track/$1";
$route['doc_portal/track/(:any)']              = "doc_portal/track/$1";
$route['doc_portal/submit/(:num)']             = "doc_portal/submit/$1";