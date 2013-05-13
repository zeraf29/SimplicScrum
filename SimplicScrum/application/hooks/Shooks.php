<?php
class Shooks {
    function checkPermission() {
        $CI =& get_instance();

		$CI->load->helper('cookie');
		$CI->load->library('session');
		echo $CI->input->cookie('userid');
		if ( isset($CI->allow)) {
            if(in_array($CI->router->method, $CI->allow) === false){
				if ( !$CI->input->cookie('userid') && !$CI->session->userdata("ss_userid") ) { 
					alert( $CI->input->cookie('userid'),'/~sscrum/SimplicScrum/');
				}   
			}else{

			}
        } else{
			 if ( !$CI->input->cookie('userid') && !$CI->session->userdata("ss_userid") ) { 
				alert($CI->input->cookie('userid'),'/~sscrum/SimplicScrum/');
			 }
		}
    }   
}
?>