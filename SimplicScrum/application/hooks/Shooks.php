<?php
class Shooks {
    function checkPermission() {
        $CI =& get_instance();        
		if ( isset($CI->allow)) {
            if(in_array($CI->router->method, $CI->allow) === false){
				if ( !$this->input->cookie('mobile') && !$CI->user->isLogin() ) { 
					alert('You need to login!','/');
				}   
			}else{

			}
        } else{
			 if ( !$this->input->cookie('mobile') && !$CI->user->isLogin()) { 
				alert('You need to login!','/'););
			 }
		}
    }   
}
?>