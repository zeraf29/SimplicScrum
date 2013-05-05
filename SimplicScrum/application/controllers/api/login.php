<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function getLogin(){
		$email=isset($_POST["email"])?$_POST["email"]:"";
		$pw=isset($_POST["pw"])?$_POST["pw"]:"";
		echo $email = "admin@admin.com";
		echo $pw="admin";
		$this->load->model("M_user");	
		if($email=="" || $pw==""){
			echo "0";
		}else{
			//echo sha1($pw);
			$result = $this->M_user->get_login($email,$pw);
			if($result==1){
				echo "1";
			}else{
				echo "0";
			}

		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
