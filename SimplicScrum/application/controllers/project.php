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
		$data["list"] = $this->getList();
		$this->load->view('project',$data);
	}
	
	public function makeProject(){
		$title=isset($_POST["title"])?$_POST["title"]:"";
		$desc=isset($_POST["desc"])?$_POST["desc"]:"";
		$puser_id = $this->session->userdata('ss_userid');
		$sdate = isset($_POST["sadte"])?$_POST["sdate"]:"";
		$edate = isset($_POST["edate"])?$_POST["edate"]:"";



		$this->load->model("M_project");	
		if($title=="" || $desc=="" || $puser_id=="" ){
			$view_data = array(
					'code' => '200',
					'msg' => 'FAILURE : Not Blank!'
				);
		}else{
			$result = $this->M_project->makeProject($title,$desc,$puser_id,$sdate,$edate);
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

	protected function getList(){
		if ($this->checkLogin() == TRUE) {
			$this->load->model("M_project");	
			$result = $this->M_project->get_list();
			$key = null;
			$data = null;
			if (count($result)>0) {
				for ($i = 0; $i < count($result); $i++) {
						$data[$i] = array(
							'id'	=>$result[$i]->id,
							'title' => $result[$i]->title,
							'desc' => $result[$i]->desc,
							'access_key' => $result[$i]->access_key,
							'openpj' => $result[$i]->openpj,
							'rlevel' => $result[$i]->rlevel,
							'sdate' => $result[$i]->sdate,
							'edate' => $result[$i]->edate,
						);
					}
				
			}
		}
		return $data;
	}

	public function editProject(){

	}

	public function deleteProject(){
		$id=isset($_POST["id"])?$_POST["id"]:"";


		$this->load->model("M_project");	
		if($id==""  ){
			$view_data = array(
					'code' => '200',
					'msg' => 'FAILURE : Not Blank!'
				);
		}else{
			$result = $this->M_project->deleteProject($id);
			if($result==2){

				$view_data = array(
					'code' => '100',
					'msg' => 'SUCCESS'
				);

			}else if($result==1){
				$view_data = array(
					'code' => '200',
					'msg' => 'FAILURE : Member exists.!'
				);
			}else{
				$view_data = array(
					'code' => '300',
					'msg' => 'FAILURE : You don\' have permission!'
				);
			}

		}
		$this->displayJson($view_data);
	}

	public function isMember(){
		$email=isset($_POST["email"])?$_POST["email"]:"";

		$this->load->model("M_user");

		if($id==""  ){
			$view_data = array(
					'code' => '200',
					'msg' => 'FAILURE : Not Blank!'
				);
		}else{
			$result = $this->M_user->find_User($email);
			if($result==TRUE){

				$view_data = array(
					'code' => '100',
					'msg' => 'SUCCESS'
				);

			}else{
				$view_data = array(
					'code' => '200',
					'msg' => 'FAILURE : .!'
				);
			}
		}
		$this->displayJson($view_data);	

	}
	
}