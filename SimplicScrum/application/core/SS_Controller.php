<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SS_Controller extends CI_Controller {

	/**
	 * �⺻ Controller ����
	 */
	//var $developFlag = TRUE;
	var $developFlag = FALSE;
	public function __construct() {
		parent::__construct();
		$this->allow = array('main', 'getLogin', 'login','index'); // index, method1, 	
	}

	protected function setModel($modelName) {
		$this->model = $modelName;
	}

	/**
	 * Model 
	 */
	protected function loadModel() {
		$this->load->model($this->model);
	}
	protected function getDevelop() {
	  	return $this->developFlag;
	}

	/**
	 * checkLogin
	 */
	protected function checkLogin() {
		$result = FALSE;
		if ($this->input->cookie('userid') != '') {
			$result = TRUE;
		}
		
		return $result;
	}
	/**
	 * json view output
	 */
	protected function displayJson($viewdata) {
	   	if ($this->getDevelop() == TRUE) {
	   		$this->output->set_output(json_encode($viewdata));
		} else {
			$this->output->set_content_type('application/json')
						 ->set_output(json_encode($viewdata));
		}
	}
}
?>