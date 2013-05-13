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
					$priceArray = explode(",",$result[$i]->price);
					$data[$result[$i]->id] = array(
						'productname' => $result[$i]->productname,
						'distributor' => $result[$i]->distributor,
						'country_code' => $result[$i]->country_code,
						'pricebox' => $result[$i]->pricebox,
						'price' => $priceArray,
						'user_info' => $result[$i]->user_info,
						'image' => $result[$i]->image,
						'status' => $result[$i]->status,
						'reg_date' => $result[$i]->reg_date
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

		
		foreach($result as $key => $value)
			echo $key.":".$value."</br";

	}


	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
