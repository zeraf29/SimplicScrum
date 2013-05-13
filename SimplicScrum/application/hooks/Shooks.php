<?php
class Shooks {
    function checkPermission() {
        $CI =& get_instance();

		$CI->load->helper('cookie');
		$CI->load->library('session');
		if ( isset($CI->allow)) {
            if(in_array($CI->router->method, $CI->allow) === false){
				if ( !$CI->input->cookie('mobile') && !$CI->session->userdata("ss_userid") ) { 
					alert('You need to login!','/~sscrum/SimplicScrum/');
				}   
			}else{

			}
        } else{
     		 echo 11;
			 if ( !$CI->input->cookie('mobile') && !$CI->session->userdata("ss_userid") ) { 
				alert('You need to login!','/~sscrum/SimplicScrum/');
			 }
		}
    }   
}
?>