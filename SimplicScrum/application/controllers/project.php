<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends SS_Controller {

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
		$this->load->view('project');
	}
	
	public function makeProject(){
		$title=isset($_GET["title"])?$_GET["title"]:"";
		$desc=isset($_GET["desc"])?$_GET["desc"]:"";
		$puser_id = $this->session->userdata('ss_userid');


		$this->load->model("M_project");	
		if($title=="" || $desc=="" || $puser_id=="" ){
			$view_data = array(
					'code' => '200',
					'msg' => 'FAILURE : Not Blank!'
				);
		}else{
			$result = $this->M_project->makeProject($title,$desc,$puser_id);
			if($result){

				$view_data = array(
					'code' => '100',
					'msg' => 'SUCCESS'
				);

			}else{
				$view_data = array(
					'code' => '200',
					'msg' => 'FAILURE : Database Error!'
				);
			}

		}
		$this->displayJson($view_data);
	}

	public function editProject(){

	}

	public function deleteProject(){

	}
	
}