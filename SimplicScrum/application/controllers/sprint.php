<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sprint extends SS_Controller {

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
		$pid = isset($_GET["pid"])?$_GET["pid"]:-1;
		$phase = isset($_GET["phase"])?$_GET["phase"]:-1;
		$data["project_id"] = $pid;
		$data["phase"] = $phase;
		$this->load->helper('text');

		if($pid!=-1){
			$this->load->model("M_backlog");	
			$data["backlog"]["tasks"]=$this->M_backlog->get_tasks($pid,$phase);
			$data["phase"] = $this->M_backlog->get_Phase($pid);
		}
		$this->load->view('sprint',$data);
	}
	
	
}