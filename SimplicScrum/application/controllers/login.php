<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends SS_Controller {

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
		$this->load->model("M_user");	
		if($email=="" || $pw=="" ){

		}else{
			$result = $this->M_user->get_login($email,$pw);
			if(count($result)>0){
				//echo $result->email;
				
				$this->session->set_userdata('ss_userid', $result[0]->id);
				$this->session->set_userdata('ss_useremail', $result[0]->email);
				$this->session->set_userdata('ss_pw', $result[0]->pw);

				$view_data = array(
					'code' => '100',
					'msg' => 'SUCCESS'
				);
			}else{
				$view_data = array(
					'code' => '200',
					'msg' => 'FAILURE : Can not found user id or password!'
				);
			}

		}
		$this->displayJson($view_data);
	}
	
}