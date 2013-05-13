<?php
class Shooks {
    function checkPermission() {
        $CI =& get_instance();        
		if ( isset($CI->allow)) {
            if(in_array($CI->router->method, $CI->allow) === false){
				if (!$CI->user->isLogin() && $this->input->cookie('mobile')) { 
					alert('You need to login!','/');
				}   
			}else{

			}
        } else{
			 if (!$CI->user->isLogin() && $this->input->cookie('mobile')) { 
				alert('You need to login!','/'););
			 }
		}
    }   
}
?>