<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backloglist extends SS_Controller {
	public function index()
	{
		$this->load->view('welcome_message');
	}
	public function getBacklogLists(){
		$pid = $this->input->post("pid")?$this->input->post("pid"):-1;
		$pid = $pid!=""?$pid:-1;
		if ($this->checkLogin() == TRUE) {
			$this->load->model("M_backlog");	
			$result = $this->M_backlog->get_backlist($pid);
			$key = null;
			$data = null;
			if (count($result)>0) {
				for ($i = 0; $i < count($result); $i++) {
						$key[$i] = $result[$i]->pd_id;
						$data[$result[$i]->pd_id] = array(
							'id' => $result[$i]->pd_id,
							'title' => $result[$i]->pd_title,
							'desc' => $result[$i]->pd_desc,
							'user' => $result[$i]->pd_user,
							'p_id' => $result[$i]->pj_id,
							'p_title' => $result[$i]->pj_title,
							'reg_date' => $result[$i]->reg_date,
							'vote' => $result[$i]->vote
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
	public function getSprintLogLists(){
		$pid = $this->input->post("pid")?$this->input->post("pid"):-1;
		$bid = $this->input->post("bid")?$this->input->post("bid"):-1;
		//$pid = 1;
		if ($this->checkLogin() == TRUE) {
			$this->load->model("M_backlog");	
			$result = $this->M_backlog->get_sprintloglist($pid,$bid);
			$key = null;
			$data = null;
			if (count($result)>0) {
				for ($i = 0; $i < count($result); $i++) {
						$key[$i] = $result[$i]->id;
						/*
						for($j=0;$j<count($result[$i]->user);$j++){
							$user[$j] = array(
								'id' => $result[$i]->user[$j]->id,
								'email' => $result[$i]->user[$j]->email,
								'nickname' => $result[$i]->user[$j]->nickname
							);
						}
						*/
						$data[$result[$i]->id] = array(
							'id' => $result[$i]->id,
							'title' => $result[$i]->title,
							'desc' => $result[$i]->desc,
							'level' => $result[$i]->level,
							'pid' => $result[$i]->pid,
							'bid' => $result[$i]->bid,
							'vote' => $result[$i]->vote,
							'reg_date' => $result[$i]->reg_date
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
	public function setVote(){
		$sid = $this->input->post("sid")?$this->input->post("sid"):-1;
		$sid=1;
		if ($this->checkLogin() == TRUE) {
			$this->load->model("M_backlog");
			$result = $this->M_backlog->setSprint($sid);
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
		else {
			$view_data = array(
				'code' => '200',
				'msg' => 'FAILURE : Login required!'
			);
		}
		$this->displayJson($view_data);
	}
}