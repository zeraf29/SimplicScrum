<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * TS Platform Base Controller
 * Authors: 김진협
 * Date: 2013.April.6.
 * Description: 컨트롤러 전체 공통 부분 클래스. 생성자 및 기타 공통부분 추출
*/
class SS_Model extends CI_Controller {

	/**
	 *  Controller 
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Controller
	 */
	protected function setModel($modelName) {
		$this->model = $modelName;
	}

	/**
	 * Model 
	 */
	protected function loadModel() {
		$this->load->model($this->model);
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