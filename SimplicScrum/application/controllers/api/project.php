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
		$this->load->view('welcome_message');
	}
	public function getList(){

		$this->load->model("M_project");	

		$result = $this->M_project->get_list();
		$key = null;
		$data = null;
		
		if (count($result) != 0) {
			for ($i = 0; $i < count($result); $i++) {
					$key[$i] = $result[$i]->id;
					$data[$result[$i]->id] = array(
						'title' => $result[$i]->title,
						'desc' => $result[$i]->desc,
						'puser_id' => $result[$i]->puser_id,
						'access_key' => $result[$i]->access_key,
						'openpj' => $openpj
					);
			}
		}
		$view_data = array(
			'code' => '200',
			'msg' => 'SUCCESS',
			'key' => $key,
			'item' => $data
		);
		
		$this->displayJson($view_data);

	}
	public function getList(){
		if ($this->checkLogin() == TRUE) {
			$this->load->model("M_project");	
			$result = $this->M_project->get_list();
			$key = null;
			$data = null;
			if (count($result)>0) {
				for ($i = 0; $i < count($result); $i++) {
						$key[$i] = $result[$i]->id;
						$data[$result[$i]->id] = array(
							'title' => $result[$i]->title,
							'desc' => $result[$i]->desc,
							'access_key' => $result[$i]->access_key,
							'openpj' => $result[$i]->openpj,
							'rlevel' => $result[$i]->rlevel
						);
					}
				$view_data = array(
					'code' => '100',
					'msg' => 'SUCCESS',
					'key' => $key,
					'item' => $data
				);
			}else{
				$view_data = array(
					'code' => '300',
					'msg' => 'SUCCESS',
					'key' => $key,
					'item' => $data
				);

			}
		}else {
			$view_data = array(
				'code' => '200',
				'msg' => 'FAILURE : Login required!'
			);
		}
		$this->displayJson($view_data);

	}

	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
