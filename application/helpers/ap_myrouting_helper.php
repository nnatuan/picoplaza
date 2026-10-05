<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


//Get news
function get_sec_new($nid_sec)
	{
		
	}

function get_cat_new($nid_cat)
	{
		
	}

function get_new_detail($nid)
	{
		return ;
	}


function filter_file_string( $str , $key)
	{
		$str = explode(" ",$str);
		$string = '';
		for($i = 0; $i<count($str); $i++):
			if($i == 0)
				$string = $str[$i];
			else
				$string = $string.$key.$str[$i];
		endfor;
		$string = strtolower($string);
		return $string;
	}