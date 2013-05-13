<?php
class Shooks {
    function checkPermission() {
        $CI =& get_instance();

		$CI->load->helper('cookie');
		$CI->load->library('session');
		if ( isset($CI->allow)) {
            if(in_array($CI->router->method, $CI->allow) === false){
				if ( !$CI->input->cookie('mobile') && !$CI->session->userdata("ss_userid") ) { 
					alert( $CI->input->cookie('mobile'),'/~sscrum/SimplicScrum/');
				}   
			}else{

			}
        } else{
			 if ( !$CI->input->cookie('mobile') && !$CI->session->userdata("ss_userid") ) { 
				alert($CI->input->cookie('mobile'),'/~sscrum/SimplicScrum/');
			 }
		}
    }   
}
?>