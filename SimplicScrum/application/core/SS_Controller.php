<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SS_Controller extends CI_Controller {

	/**
	 * �⺻ Controller ����
	 */
	var $developFlag = TRUE;
	public function __construct() {
		parent::__construct();
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
	 * json view output
	 */
	protected function displayJson($viewdata) {
		echo $viewdata;
	   	if ($this->getDevelop() == TRUE) {
	   		echo $this->output->set_output(json_encode($viewdata));
		} else {
			echo $this->output->set_content_type('application/json')
						 ->set_output(json_encode($viewdata));
		}
	}
}
?>