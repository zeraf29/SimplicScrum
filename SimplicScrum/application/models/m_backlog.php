<?php

class M_backlog extends SS_Model{
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
		echo $this->db->last_query();
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
}
?>