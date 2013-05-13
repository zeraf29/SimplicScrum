<?php
class Shooks {
    function checkPermission() {
        $CI =& get_instance();

		$this->load->helper('cookie');
		$CI->load->library('session');
		if ( isset($CI->allow)) {
            if(in_array($CI->router->method, $CI->allow) === false){
				if ( !$CI->input->cookie('mobile') && !$CI->session->userdata("userid") ) { 
					alert('You need to login!','/');
				}   
			}else{

			}
        } else{
			 if ( !$CI->input->cookie('mobile') && !$CI->session->userdata("userid") ) { 
				alert('You need to login!','/');
			 }
		}
    }   
}
?>