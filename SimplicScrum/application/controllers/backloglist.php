<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backloglist extends SS_Controller {
	public function makeProduct(){
		$json=isset($_POST["data"])?$_POST["data"]:"";
		$this->load->model("M_backlog");
		if($json==""){
			$view_data = array(
					'code' => '200',
					'msg' => 'FAILURE : Not Blank!'
				);
		}else{
			$json = stripslashes($json);
			$json = json_decode($json);
			$result = $this->M_backlog->makeProduct($json);
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

	public function makeSprintbl(){
		$json=isset($_POST["data"])?$_POST["data"]:"";
		$this->load->model("M_backlog");
		if($json==""){
			$view_data = array(
					'code' => '200',
					'msg' => 'FAILURE : Not Blank!'
				);
		}else{
			$json = stripslashes($json);
			$json = json_decode($json);
			$result = $this->M_backlog->makeSprintbl($json);
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
}