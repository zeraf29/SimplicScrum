<?php

class M_backlog extends SS_Model{
	function set_makeSprintbl(){

	}
	function get_backlist($pid){
		$this->db->select('pd.id as pd_id,pd.title as pd_title, pd.desc as pd_desc,u.nickname as pd_user,pj.id as pj_id, pj.title as pj_title, pd.reg_date as reg_date,pd.vote as vote');
		$this->db->from('product as pd');
		$this->db->join('user as u', 'pd.mid=u.id', 'left');
		$this->db->join('project as pj', 'pd.pid=pj.id', 'left');
		$this->db->where('pd.pid', $pid);
		$this->db->order_by('reg_date', 'desc');
		$rs = $this->db->get();
		return ($rs->num_rows() > 0) ? $rs->result() : array();
	}
	function get_speSprintLogLists($pid){
		$this->db->select("sb.id as id, sb.title as title, sb.desc as sdesc, sb.pid as pid, sb.reg_date as reg_date,sb.level as level, sb.bid as bid, pd.title as btitle");
		$this->db->from("sprintback as sb");
		$this->db->join('product as pd', 'sb.bid=pd.id', 'left');
		$this->db->where("sb.pid",$pid);
		$this->db->order_by('reg_date', 'desc');
		$rs = $this->db->get();
		return $data = ($rs->num_rows() > 0) ? $rs->result() : array();
	}
	function get_Phase($pid){
		$this->db->select("phase");
		$this->db->from("sprint");
		$this->db->where("pid",$pid);
		$this->db->order_by("phase","DESC");
		$this->db->limit(1);
		$rs = $this->db->get();
		$data = $rs->result();
		return ($rs->num_rows() > 0) ? $data[0]->phase : 1;
	}
	function get_notuseSLlists($pid){
		$this->db->select("*");
		$this->db->from("sprintback as sb");
		$this->db->where("sb.pid",$pid);
		$this->db->where("sb.complete","N");
		$rs = $this->db->get();
		return $data = ($rs->num_rows() > 0) ? $rs->result() : array();
	}
	function get_tasks($pid,$phase){
		$this->db->select("s.id as id,s.pid as pid, sb.id as sid, sb.title as title, sb.level as level, s.process as process, s.phase as phase, s.limit_date as limit_date, s.target_date as target_date, sb.vote as vote, sb.complete as complete, sb.bid as bid");
		$this->db->from("sprint as s");
		$this->db->join("sprintback as sb","s.sid=sb.id","left");
		$this->db->where("s.pid",$pid);
		$this->db->where("s.phase",$phase);
		$rs = $this->db->get();
		return $data = ($rs->num_rows() > 0) ? $rs->result() : array();
	}
	function get_sprint($pid){
		$this->db->select("phase");
		$this->db->from('sprint');
		$this->db->where('pid',$pid);
		$rs = $this->db->get();
		return $data = ($rs->num_rows() > 0) ? $rs->result() : array();
	}
	function get_sprintloglist($pid, $bid=0){
		$this->db->select();
		$this->db->from('sprintback');
		$this->db->where('pid',$pid);
		if($bid==0){
			$this->db->where('bid',$bid);
		}
		$this->db->order_by('vote', 'desc');
		$this->db->order_by('reg_date', 'desc');


		$rs = $this->db->get();
		$data = ($rs->num_rows() > 0) ? $rs->result() : array();
		//echo $this->db->last_query();
		/*
		if(count($data)>0){
			foreach($data as $key => $value){
				$this->db->select();
				$this->db->from('workuser as wu');
				$this->db->join('user as u', 'wu.uid=u.id', 'left');
				$this->db->where('wu.sid',$value->bid);
				$this->db->where('bid',$bid);
				$this->db->order_by('vote', 'desc');
				$this->db->order_by('wu.type', 'SB');
				$rs = $this->db->get();
				$data[$key]['user'] = ($rs->num_rows() > 0) ? $rs->result() : array();
				echo $this->db->last_query();
			}
		}
		*/
		return $data;
	}
	function setSprint($sid){
		$result = FALSE;
		$this->db->set('vote','vote+1',FALSE);
		$this->db->where('id',$sid);
		$this->db->trans_start();
		$this->db->update('sprintback');
		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();	
		}else {
			$this->db->trans_commit();
			$result = TRUE;
		}
		$this->db->trans_complete();
		//echo $this->db->last_query();
		return $result;
	}
	function makeProduct($json){

		$result = FALSE;

		$data = array(
		   'title' => $json->title ,
		   'desc' => $json->desc ,
		   'pid' => $json->pid ,
		   'mid' => $json->mid ,
		   'vote' => 0
		);

		$this->db->trans_start();
		$this->db->insert('product', $data); 
		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();	
		}else {
			$this->db->trans_commit();
			$result = TRUE;
		}
		$this->db->trans_complete();
		return $result;
	}
	function makeSprintbl($json){
		$result = FALSE;

		$data = array(
		   'title' => $json->title ,
		   'desc' => $json->desc ,
		   'pid' => $json->pid ,
		   'mid' => $json->mid ,
		   'bid' => $json->bid ,
		   'level' => $json->level ,
		   'vote' => 0
		);

		$this->db->trans_start();
		$this->db->insert('sprintback', $data); 
		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();	
		}else {
			$this->db->trans_commit();
			$result = TRUE;
		}
		$this->db->trans_complete();
		return $result;

	}
	function makeSprint($json){
		$result = FALSE;

		$this->db->trans_start();
		foreach($json->list as $key){
			$data = array(
				'pid'=>$json->pid,
				'sid'=>$key,
				'phase'=>$json->phase,
				'limit_date'=>$json->due
				);
			$this->db->insert('sprint', $data); 
		}
		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();	
		}else {
			$this->db->trans_commit();
			$result = TRUE;
		}
		$this->db->trans_complete();
		return $result;

	}
}
?>