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
}
?>