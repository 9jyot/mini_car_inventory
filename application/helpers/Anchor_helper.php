<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//get main CodeIgniter object
/*echo "<pre>";
	print_r($CI->uri->rsegments[1]);	
echo "</pre>";die;*/


if ( ! function_exists('active_anchor'))
{
    function active_anchor($anchor_link = '')
    { 
    	$CI =& get_instance();
		$active_link  = $CI->uri->rsegments[1];
       if($anchor_link == $active_link){
       		$class = "active";
       }else{
   			$class = "";
       }
      
       return $class;
    }   
}