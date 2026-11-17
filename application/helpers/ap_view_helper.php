<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//
// 
//
function Vuser_view()
{
	$str=' (SELECT ';
	$str.=' a.nid 			as nid 			,';
	$str.=' a.ccode 		as ccode 		,';
	$str.=' a.cnote 		as cnote 		,';
	$str.=' a.niduser01 	as niduser01 	,';
	$str.=' a.niduser02 	as niduser02 	,';
	$str.=' a.ddate01 		as ddate01 		,';
	$str.=' a.ddate02 		as ddate02 		,';
	$str.=' a.cuserid 		as cuserid 		,';
	$str.=' a.cpassword 	as cpassword 	,';
	$str.=' a.cemail 		as cemail 		,';
	$str.=' a.cfirstname 	as cfirstname 	,';
	$str.=' a.cmiddlename 	as cmiddlename 	,';
	$str.=' a.clastname 	as clastname 	,';	
	$str.=' concat(a.cfirstname, " " ,  a.cmiddlename, " " , a.clastname)	as cfullname 	,';	
	$str.=' b.cuser_type 	as cisadmin_name,';
	$str.=' a.cisadmin 	as cisadmin 		 ';
	$str.=' FROM ' . Fget_ap_table('tuser') . ' as a , ' . Fget_ap_table('tuser_type') . ' as b';
	$str.=' WHERE a.cdel="0" AND a.cisadmin=b.nid'; 
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}

//
// Danh muc kenh bao cao
//
function Vdepartment_group_view()
{
	$str =' (SELECT ';
	$str.=' a.nid 			as nid 			,';
	$str.=' a.cnote 		as cnote 		,';
	$str.=' a.niduser01 	as niduser01 	,';
	$str.=' a.niduser02 	as niduser02 	,';
	$str.=' a.ddate01 		as ddate01 		,';
	$str.=' a.ddate02 		as ddate02 		,';	
	$str.=' a.ccode			as ccode		,';
	$str.=' a.cgroup		as cgroup		';
	$str.=' FROM ' . Fget_ap_table('tdepartment_group') 	. ' as a ';
	$str.=' WHERE a.cdel="0" '; 
	$str.=' ) ';
	$str.=' as view ';
	
	return $str;
}

//
// 
//
function Vdepartment_view()
{
	$str=' (SELECT ';
	$str.=' a.nid 			as nid ,';
	$str.=' a.ccode 		as ccode ,';
	$str.=' a.cdepartment 	as cdepartment ,';
	$str.=' a.nid_index 	as nid_index ,';
	$str.=' a.cindex 		as cindex ,';
	$str.=' a.nid_user 		as nid_user ,';
	$str.=' concat(b.cfirstname, " " ,  b.cmiddlename, " " , b.clastname)	as cfullname 	,';	
	$str.=' a.nid_department_group 	as nid_department_group,';
	$str.=' c.cgroup		as cgroup,';
	
	$str.=' a.cdel 			as cdel ,';
	$str.=' a.cnote 		as cnote ,';
	$str.=' a.cstatus 		as cstatus ,';
	$str.=' a.niduser01 	as niduser01 ,';
	$str.=' a.niduser02 	as niduser02 ,';
	$str.=' a.ddate01 		as ddate01 ,';
	$str.=' a.ddate02 		as ddate02 ';
	
	$str.=' FROM ' . Fget_ap_table('tdepartment')	. ' as a ,';
	$str.='      ' . Fget_ap_table('tuser')    	. ' as b ,';
	$str.='      ' . Fget_ap_table('tdepartment_group') . ' as c ';
	$str.=' WHERE a.cdel="0" '; 
	$str.=' AND   a.nid_user=b.nid'; 
	$str.=' AND   a.nid_department_group=c.nid'; 
	$str.=' ) as view'; 
	
	return $str;
}	
//
// Danh muc kenh bao cao
//

function Vmenu_view() 	
{		
	$str=' ( ';
	$str.=' SELECT ';
	$str.=' a.nid 			as nid 	,';
	$str.=' a.cmenu 		as cmenu 	,';
	$str.=' a.cicon_name 	as cicon_name 	,';	
	$str.=' a.cbasic 		as isbasic 	,';	
	$str.=' a.cindex 		as cindex 	,';	
	$str.=' a.cnode 		as cnode 	,';	
	$str.=' a.cbasic 		as cbasic 	,';	
	$str.=' a.cstatus 		as ccstatus 	';
		
	$str.=' FROM ' ;
	$str.='      ' . Fget_ap_table('tmenu')	. ' as a ';	
	$str.=' WHERE  	a.nid is not null AND a.cdel=0';
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}
	
function Vuser_menu_view()
{
	return ' (SELECT * FROM tuser WHERE cdel="0") as vuser ';
}


function Vnew_view()
{
	$str ='(SELECT';
	$str.=' a.nid				as nid ,';
	$str.=' a.cindex			as cindex ,';
	$str.=' a.nid_cat_news		as nid_cat ,';
	$str.=' a.nhit				as nhit ,';
	$str.=' a.cshort_content	as cshort_content ,';
	$str.=' a.ccontent			as ccontent ,';
	$str.=' a.cimage_thumb		as cimage_thumb ,';
	$str.=' b.ccat_news			as ccat_news ,';
	$str.=' b.ccode				as ccode_cat ,';
	
	//$str.=' e.clanguage			as clanguage ,';
	//$str.=' e.nid				as nid_language ,';
	$str.=' a.ccode				as ccode ,';
	$str.=' a.ctitle			as ctitle ,';
	$str.=' a.ctag				as ctag ,';
	$str.=' a.alwcmt			as alwcmt ,';
	$str.=' a.nstatus 			as nstatus ,';
	$str.=' a.niduser01 		as niduser01 ,';
	$str.=' a.nid_section_news	as nid_section_news ,';
	$str.=' c.csection_news		as csection_news ,';	
	$str.=' c.ccode				as ccode_sec ,';	
	$str.=' a.ddate01 			as ddate01 ,';
	$str.=' a.ddate02 			as ddate02 ';

	$str.=' FROM ' . Fget_ap_table('tsection_news') . ' as c	 ,';
	$str.= 		     Fget_ap_table('tnews') . ' as a';
	$str.= ' LEFT JOIN '. Fget_ap_table('tcat_news') . ' as b  ON (a.nid_cat_news = b.nid) ';
	
	$str.=' WHERE 	a.nid is not null ';
	$str.=' AND 	a.nid_section_news 	= c.nid ';
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}


function Vbanner_view()
{	
	$str=' (SELECT ';
	$str.=' a.nid					as nid ,';
	$str.=' a.cimage				as cimage,';
	$str.=' a.ctext					as ctext ,';
	$str.=' a.clink					as clink ,';
	$str.=' a.cstatus				as cstatus ,';
	$str.=' concat(b.cfirstname, " " , b.cmiddlename, " " , b.clastname)	as cfullname 	,';	
	$str.=' a.niduser01				as nid_user01 ,';
	$str.=' a.ddate01				as ddate01';
	$str.=' FROM ' . Fget_ap_table('tbanner') .' as a ,';
	$str.=  Fget_ap_table('tuser') .' as b ';
	$str.=' WHERE 	a.niduser01 = b.nid ';
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}



function Vadvertising_view()
{	
	$str=' (SELECT ';
	$str.=' a.nid					as nid ,';
	$str.=' a.cname					as cname ,';
	$str.=' a.cimage				as cimage,';
	$str.=' a.clink					as clink ,';
	$str.=' concat(b.cfirstname, " " , b.cmiddlename, " " , b.clastname)	as cfullname 	,';	
	$str.=' a.niduser01				as nid_user01 ,';
	$str.=' a.ddate01				as ddate01';
	$str.=' FROM ' . Fget_ap_table('tbanner') .' as a ,';
	$str.=  Fget_ap_table('tuser') .' as b ';
	$str.=' WHERE 	a.niduser01 = b.nid ';
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}


function Vcat_new_view()
{
	$str=' (SELECT ';

	$str.=' a.nid					as nid ,';
	$str.=' a.ccat_news				as ccat_news,';
	$str.=' a.cnote					as cnote ,';
	$str.=' a.ccode					as ccode ,';	
	$str.=' a.nstatus				as nstatus ,';
	$str.=' a.cindex				as cindex ,';
	$str.=' a.niduser01				as nid_user01 ,';
	
	$str.=' b.nid_org				as nid_org ,';
	$str.=' b.nid_language			as nid_language,';
	$str.=' b.nid_translate			as nid_translate,';
	$str.=' b.ctbl_name				as ctbl_name,';
	
	$str.=' c.clanguage				as clanguage,';
	//$str.=' d.cfirstname			as cfullname,';
	$str.=' concat(d.cfirstname, " " , d.cmiddlename, " " , d.clastname)	as cfullname 	,';	
	$str.=' a.ddate01				as ddate01';
	$str.=' FROM ' . Fget_ap_table2('tcat_news') . ' as a ,' ;
	$str.='      ' . Fget_ap_table2('ttranslate'). ' as b ,';
	$str.='      ' . Fget_ap_table2('tlanguage') . ' as c, ';
	$str.=' 	 ' . Fget_ap_table2('tuser') 	  . ' as d ';
	$str.=' WHERE a.nid 		= b.nid_translate '; 
	$str.=' AND   c.nid 		= b.nid_language'; 
	$str.=' AND   a.niduser01	= d.nid'; 
//	$str.=' AND   b.ctbl_name 		= "tcat_news"';
	$str.=') as view ';
	return $str;
}

function Vsponline_view()
{
	$str=' (SELECT ';
	$str.=' a.nid					as nid ,';
	$str.=' a.ccontact_nick			as ccontact_nick,';
	$str.=' a.cname					as cname,';	
	$str.=' a.cindex				as cindex,';
	$str.=' a.nstatus				as nstatus,';
	$str.=' a.cnote					as cnote,';		
	$str.=' a.niduser01				as niduser01 ,';
	$str.=' a.niduser02				as niduser02 ,';
	$str.=' concat(b.cfirstname, " " , b.cmiddlename, " " , b.clastname)	as cfullname 	,';	
	$str.=' a.ddate01				as ddate01 ,';
	$str.=' a.ddate02				as ddate02 ';
	$str.=' FROM ' . Fget_ap_table('tsponline') . ' as a , ' . Fget_ap_table('tuser') . ' as b';
	$str.=' WHERE a.niduser01=b.nid'; 
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}
function Vhotline_view()
{
	$str=' (SELECT ';
	$str.=' a.nid						as nid,';	
	$str.=' a.cphone					as cphone,';	
	$str.=' a.cindex					as cindex,';		
	$str.=' a.niduser01				as niduser01 ,';
	$str.=' a.niduser02				as niduser02 ,';
	$str.=' concat(b.cfirstname, " " , b.cmiddlename, " " , b.clastname)	as cfullname 	,';	
	$str.=' a.ddate01				as ddate01 ,';
	$str.=' a.ddate02				as ddate02 ';
	$str.=' FROM ' . Fget_ap_table('tphone') . ' as a , ' . Fget_ap_table('tuser') . ' as b';
	$str.=' WHERE a.niduser01=b.nid'; 
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}

function Vconfig_view()
{
	$str=' (SELECT ';
	$str.=' a.nid					as nid ,';
	$str.=' a.ccode					as ccode,';
	$str.=' a.cvalue				as cvalue,';
	$str.=' a.cname				as cname,';		
	$str.=' a.niduser01				as niduser01 ,';
	$str.=' a.niduser02				as niduser02 ,';
	$str.=' concat(b.cfirstname, " " , b.cmiddlename, " " , b.clastname)	as cfullname 	,';	
	$str.=' a.ddate01				as ddate01 ,';
	$str.=' a.ddate02				as ddate02 ';
	$str.=' FROM ' . Fget_ap_table('tconfig') . ' as a , ' . Fget_ap_table('tuser') . ' as b';
	$str.=' WHERE a.niduser01=b.nid'; 
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}


function Vtfaq()
{
	$str=' (SELECT ';
	$str.=' a.nid					as nid ,';
	$str.=' a.ccode					as ccode,';
	$str.=' a.cindex				as cindex,';
	$str.=' a.ccus_name				as ccus_name,';	
	$str.=' a.ccus_add				as ccus_add,';		
	$str.=' a.ccus_email			as ccus_email,';			
	$str.=' a.question				as question,';
	$str.=' a.canswer				as canswer,';
	$str.=' a.ctitle				as ctitle,';	
	$str.=' a.status				as status,';
	$str.=' a.cshow					as cshow,';
	$str.=' b.nid_org				as nid_org ,';
	$str.=' b.nid_language			as nid_language,';
	$str.=' b.nid_translate			as nid_translate,';
	$str.=' b.ctbl_name				as ctbl_name,';
	$str.=' c.clanguage				as clanguage,';
	$str.=' concat(d.cfirstname, " " , d.cmiddlename, " " , d.clastname)	as cfullname 	,';	
	
	$str.=' a.niduser01				as niduser01 ,';
	$str.=' a.niduser02				as niduser02 ,';
	$str.=' a.ddate01				as ddate01 ,';
	$str.=' a.ddate02				as ddate02 ';
	$str.=' FROM ' . Fget_ap_table2('tfaq') . ' as a , ' ;
	$str.='      ' . Fget_ap_table2('ttranslate'). ' as b ,';
	$str.='      ' . Fget_ap_table2('tlanguage') . ' as c, ';
	$str.=' 	 ' . Fget_ap_table2('tuser') 	  . ' as d ';	
	$str.=' WHERE a.nid 		= b.nid_translate '; 
	$str.=' AND   c.nid 		= b.nid_language'; 
	$str.=' AND   b.ctbl_name 		= "tfaq"';	
	$str.=' AND   a.niduser01	= d.nid'; 	
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}

function Vcomment()
{
	$str=' (SELECT ';
	$str.=' a.nid					as nid ,';
	$str.=' b.nid					as nid_news ,';
	$str.=' a.ccode					as ccode,';
	$str.=' a.cindex				as cindex,';
	$str.=' a.ccomment				as comment,';
	$str.=' a.status				as status,';
	$str.=' concat(c.cfirstname, " " , c.cmiddlename, " " , c.clastname)	as cfullname 	,';	
	$str.=' a.niduser01				as niduser01 ,';
	$str.=' a.ddate01				as ddate01 ';
	$str.=' FROM ' . Fget_ap_table('tcomment') . ' as a ,'. Fget_ap_table('tnews') . ' as b ,'. Fget_ap_table('tuser') . ' as c';
	$str.=' WHERE a.nid_news = b.nid'; 
	$str.=' AND a.niduser01=c.nid';
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}

function Vmateria_product()
{
	$str=' (SELECT ';
	$str.=' a.nid					as nid ,';
	$str.=' a.ccode					as ccode,';
	$str.=' a.cmaterial_products	as cmaterial_products,';
	$str.=' a.cimage				as cimage,';
	$str.=' a.cnote					as cnote,';
	$str.=' a.nstatus				as nstatus,';	
	$str.=' a.cindex				as cindex,';
	$str.=' concat(b.cfirstname, " " , b.cmiddlename, " " , b.clastname)	as cfullname  ,	';	
	$str.=' a.niduser01				as niduser01 ,';
	$str.=' a.niduser02				as niduser02 ,';
	$str.=' a.ddate01				as ddate01 ,';
	$str.=' a.ddate02				as ddate02 ';
	
	$str.=' FROM ' . Fget_ap_table('tmaterial_products') . ' as a ,'. Fget_ap_table('tuser') . ' as b';
	$str.=' WHERE a.niduser01=b.nid';
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}


function Vcat_product()
{
	$str=' (SELECT ';
	$str.=' a.nid					as nid ,';
	$str.=' a.ccode					as ccode,';
	$str.=' a.ccat_products			as ccat_products,';
	$str.=' c.nid					as nid_material_products,';
	$str.=' c.cmaterial_products	as cmaterial_products,';
	$str.=' a.cimage				as cimage,';
	$str.=' a.cnote					as cnote,';
	$str.=' a.nstatus				as nstatus,';	
	$str.=' a.cindex				as cindex,';
	$str.=' concat(b.cfirstname, " " , b.cmiddlename, " " , b.clastname)	as cfullname  ,	';	
	$str.=' a.niduser01				as niduser01 ,';
	$str.=' a.niduser02				as niduser02 ,';
	$str.=' a.ddate01				as ddate01 ,';
	$str.=' a.ddate02				as ddate02 ';
	
	$str.=' FROM ' . Fget_ap_table('tcat_products') . ' as a ,'. Fget_ap_table('tuser') . ' as b, ';
	$str.=' '. Fget_ap_table('tmaterial_products') . ' as c ';
	$str.=' WHERE a.niduser01=b.nid ';
	$str.=' AND a.nid_material_products = c.nid';
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}

function Vproduct()
{
	$str=' (SELECT ';
	$str.=' a.nid					as nid ,';
	$str.=' a.ccode					as ccode,';
	$str.=' a.cproducts				as cproducts,';
	$str.=' a.nspecial_products		as nspecial_products,';
	
	$str.=' concat(a.cproducts," ",a.ctag," ",a.cdescription," ",a.cdetail)	as ckey_work, ';
	
	$str.=' a.nid_material_products	as nid_material_products,';
	$str.=' c.cmaterial_products	as cmaterial_products,';
	$str.=' a.nid_cat_products		as nid_cat_products,';
	$str.=' d.ccat_products			as ccat_products,';
	
	$str.=' a.cimage				as cimage,';
	$str.=' a.cimage_resize			as cimage_resize,';
	$str.=' a.fprice				as fprice,';
	$str.=' a.nquantity				as nquantity,';
	$str.=' a.cdescription			as cdescription,';
	$str.=' a.cdetail				as cdetail,';
	$str.=' a.cvideo_clip			as cvideo_clip,';
	$str.=' a.nstatus				as nstatus,';	
	$str.=' a.ctag					as ctag,';	
	$str.=' a.cnote					as cnote,';	
	$str.=' a.ncheck				as ncheck,';	
	$str.=' a.cindex				as cindex,';
	$str.=' concat(b.cfirstname, " " , b.cmiddlename, " " , b.clastname)	as cfullname  ,	';	
	$str.=' a.niduser01				as niduser01 ,';
	$str.=' a.niduser02				as niduser02 ,';
	$str.=' a.ddate01				as ddate01 ,';
	$str.=' a.ddate02				as ddate02 ';
	
	$str.=' FROM ' . Fget_ap_table('tuser') . ' as b, ';
	$str.=' '. Fget_ap_table('tmaterial_products') . ' as c, ';
	$str.=' '. Fget_ap_table('tproducts') . ' as a ';
	//$str.=' '. Fget_ap_table('tcat_products') . ' as d ';
	$str.= ' LEFT JOIN '. Fget_ap_table('tcat_products') . ' as d  ON (a.nid_cat_products = d.nid) ';
	$str.=' WHERE a.niduser01=b.nid ';
	$str.=' AND a.nid_material_products = c.nid';
	//$str.=' AND a.nid_cat_products = d.nid';
	$str.=' AND a.nstatus = 1';
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}

function Vimage_product()
{
	$str=' (SELECT ';
	$str.=' a.nid					as nid ,';
	$str.=' a.cimage				as cimage,';
	$str.=' a.cimage_resize			as cimage_resize,';
	$str.=' a.ccode					as ccode,';
	$str.=' c.nid					as nid_products,';
	$str.=' c.cproducts				as cproducts,';
	$str.=' a.cnote					as cnote,';
	$str.=' a.nstatus				as nstatus,';	
	$str.=' a.cindex				as cindex,';
	$str.=' a.niduser01				as niduser01 ,';
	$str.=' a.niduser02				as niduser02 ,';
	$str.=' a.ddate01				as ddate01 ,';
	$str.=' a.ddate02				as ddate02 ';
	
	$str.=' FROM ' . Fget_ap_table('timage_products') . ' as a , ';
	$str.=' '. Fget_ap_table('tproducts') . ' as c ';
	$str.=' WHERE a.nid is not null ';
	$str.=' AND a.nid_products = c.nid';
	$str.=' AND a.nstatus = 1';
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}

function Vmateria_work()
{
	$str=' (SELECT ';
	$str.=' a.nid					as nid ,';
	$str.=' a.ccode					as ccode,';
	$str.=' a.cmaterial_works		as cmaterial_works,';
	$str.=' a.cimage				as cimage,';
	$str.=' a.cnote					as cnote,';
	$str.=' a.nstatus				as nstatus,';	
	$str.=' a.cindex				as cindex,';
	$str.=' concat(b.cfirstname, " " , b.cmiddlename, " " , b.clastname)	as cfullname  ,	';	
	$str.=' a.niduser01				as niduser01 ,';
	$str.=' a.niduser02				as niduser02 ,';
	$str.=' a.ddate01				as ddate01 ,';
	$str.=' a.ddate02				as ddate02 ';
	
	$str.=' FROM ' . Fget_ap_table('tmaterial_works') . ' as a ,'. Fget_ap_table('tuser') . ' as b';
	$str.=' WHERE a.niduser01=b.nid';
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}

function Vcat_work()
{
	$str=' (SELECT ';
	$str.=' a.nid					as nid ,';
	$str.=' a.ccode					as ccode,';
	$str.=' a.ccat_products			as ccat_products,';
	$str.=' c.nid					as nid_material_products,';
	$str.=' c.cmaterial_products	as cmaterial_products,';
	$str.=' a.cimage				as cimage,';
	$str.=' a.cnote					as cnote,';
	$str.=' a.nstatus				as nstatus,';	
	$str.=' a.cindex				as cindex,';
	$str.=' concat(b.cfirstname, " " , b.cmiddlename, " " , b.clastname)	as cfullname  ,	';	
	$str.=' a.niduser01				as niduser01 ,';
	$str.=' a.niduser02				as niduser02 ,';
	$str.=' a.ddate01				as ddate01 ,';
	$str.=' a.ddate02				as ddate02 ';
	
	$str.=' FROM ' . Fget_ap_table('tcat_products') . ' as a ,'. Fget_ap_table('tuser') . ' as b, ';
	$str.=' '. Fget_ap_table('tmaterial_products') . ' as c ';
	$str.=' WHERE a.niduser01=b.nid ';
	$str.=' AND a.nid_material_products = c.nid';
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}

function Vwork()
{
	$str=' (SELECT ';
	$str.=' a.nid					as nid ,';
	$str.=' a.ccode					as ccode,';
	$str.=' a.cworks				as cworks,';
	$str.=' a.nspecial_works		as nspecial_works,';
	
	$str.=' concat(a.cworks," ",a.ctag," ",a.cdescription," ",a.cdetail)	as ckey_work, ';
	
	$str.=' a.nid_material_works	as nid_material_works,';
	$str.=' c.cmaterial_works		as cmaterial_works,';
	$str.=' a.nid_cat_works			as nid_cat_works,';
	$str.=' d.ccat_works			as ccat_works,';
	
	$str.=' a.cimage				as cimage,';
	$str.=' a.cimage_resize			as cimage_resize,';
	$str.=' a.fprice				as fprice,';
	$str.=' a.nquantity				as nquantity,';
	$str.=' a.cdescription			as cdescription,';
	$str.=' a.cdetail				as cdetail,';
	$str.=' a.cvideo_clip			as cvideo_clip,';
	$str.=' a.nstatus				as nstatus,';	
	$str.=' a.ctag					as ctag,';	
	$str.=' a.cnote					as cnote,';	
	$str.=' a.ncheck				as ncheck,';	
	$str.=' a.cindex				as cindex,';
	$str.=' concat(b.cfirstname, " " , b.cmiddlename, " " , b.clastname)	as cfullname  ,	';	
	$str.=' a.niduser01				as niduser01 ,';
	$str.=' a.niduser02				as niduser02 ,';
	$str.=' a.ddate01				as ddate01 ,';
	$str.=' a.ddate02				as ddate02 ';
	
	$str.=' FROM ' . Fget_ap_table('tuser') . ' as b, ';
	$str.=' '. Fget_ap_table('tmaterial_works') . ' as c, ';
	$str.=' '. Fget_ap_table('tworks') . ' as a ';
	//$str.=' '. Fget_ap_table('tcat_products') . ' as d ';
	$str.= ' LEFT JOIN '. Fget_ap_table('tcat_works') . ' as d  ON (a.nid_cat_works = d.nid) ';
	$str.=' WHERE a.niduser01=b.nid ';
	$str.=' AND a.nid_material_works = c.nid';
	//$str.=' AND a.nid_cat_products = d.nid';
	$str.=' AND a.nstatus = 1';
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}

function Vimage_work()
{
	$str=' (SELECT ';
	$str.=' a.nid					as nid ,';
	$str.=' a.cimage				as cimage,';
	$str.=' a.cimage_resize			as cimage_resize,';
	$str.=' a.ccode					as ccode,';
	$str.=' c.nid					as nid_works,';
	$str.=' c.cworks				as cworks,';
	$str.=' a.cnote					as cnote,';
	$str.=' a.nstatus				as nstatus,';	
	$str.=' a.cindex				as cindex,';
	$str.=' a.niduser01				as niduser01 ,';
	$str.=' a.niduser02				as niduser02 ,';
	$str.=' a.ddate01				as ddate01 ,';
	$str.=' a.ddate02				as ddate02 ';
	
	$str.=' FROM ' . Fget_ap_table('timage_works') . ' as a , ';
	$str.=' '. Fget_ap_table('tworks') . ' as c ';
	$str.=' WHERE a.nid is not null ';
	$str.=' AND a.nid_works = c.nid';
	$str.=' AND a.nstatus = 1';
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}

function Vcustomer()
{
	$str=' (SELECT ';
	$str.=' a.nid					as nid ,';
	$str.=' a.ccode					as ccode,';
	$str.=' a.customerid			as customerid,';
	$str.=' a.cpassword				as cpassword,';
	$str.=' a.cemail				as cemail,';
	$str.=' a.chandphone			as chandphone,';	
	$str.=' a.cfirstname			as cfirstname,';
	$str.=' a.cmiddlename			as cmiddlename,';
	$str.=' a.clastname				as clastname,';
	$str.=' a.caddress				as caddress,';
	$str.=' a.nstatus				as nstatus,';
	$str.=' a.cdel					as cdel,';
	$str.=' a.niduser01				as niduser01 ,';
	$str.=' a.niduser02				as niduser02 ,';
	$str.=' a.ddate01				as ddate01 ,';
	$str.=' a.ddate02				as ddate02 ';
	
	$str.=' FROM ' . Fget_ap_table('tcustomer') . ' as a ';
	$str.=' WHERE a.cdel="0" '; 
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}
function Vorder_status()
{
	$str=' (SELECT ';
	$str.=' a.nid					as nid ,';
	$str.=' a.ccode					as ccode,';
	$str.=' a.corder_status			as corder_status,';
	$str.=' a.cnote					as cnote,';
	$str.=' a.cindex				as cindex,';
	$str.=' a.nstatus				as nstatus,';
	$str.=' a.niduser01				as niduser01 ,';
	$str.=' a.niduser02				as niduser02 ,';
	$str.=' a.ddate01				as ddate01 ,';
	$str.=' a.ddate02				as ddate02 ';
	
	$str.=' FROM ' . Fget_ap_table('torder_status') . ' as a ';
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}

function Vwood_view()
{
	$str ='(SELECT';
	$str.=' a.nid				as nid ,';
	$str.=' a.cindex			as cindex ,';
	$str.=' a.nid_cat_news		as nid_cat ,';
	$str.=' a.nhit				as nhit ,';
	$str.=' a.cshort_content	as cshort_content ,';
	$str.=' a.ccontent			as ccontent ,';
	$str.=' a.cimage_thumb		as cimage_thumb ,';
	$str.=' b.ccat_news			as ccat_news ,';
	$str.=' b.ccode				as ccode_cat ,';
	
	//$str.=' e.clanguage			as clanguage ,';
	//$str.=' e.nid				as nid_language ,';
	$str.=' a.ccode				as ccode ,';
	$str.=' a.ctitle			as ctitle ,';
	$str.=' a.ctag				as ctag ,';
	$str.=' a.alwcmt			as alwcmt ,';
	$str.=' a.nstatus 			as nstatus ,';
	$str.=' a.niduser01 		as niduser01 ,';
	$str.=' a.nid_section_news	as nid_section_news ,';
	$str.=' c.csection_news		as csection_news ,';	
	$str.=' c.ccode				as ccode_sec ,';	
	$str.=' a.ddate01 			as ddate01 ,';
	$str.=' a.ddate02 			as ddate02 ';

	$str.=' FROM ' . Fget_ap_table('tsection_wood') . ' as c	 ,';
	$str.= 		     Fget_ap_table('twood') . ' as a';
	$str.= ' LEFT JOIN '. Fget_ap_table('tcat_wood') . ' as b  ON (a.nid_cat_news = b.nid) ';
	
	$str.=' WHERE 	a.nid is not null ';
	$str.=' AND 	a.nid_section_news 	= c.nid ';
	$str.=' ) ';
	$str.=' as view ';
	return $str;
}


?>