<?php
class M_project extends SS_Model{
	function get_list(){
		$this->db->select('p.id,p.title,p.desc,p.access_key,p.openpj,r.id as rlevel');
		$this->db->from('role_table as rt');
		$this->db->join('project as p', 'rt.pid = p.id', 'left');
		$this->db->join('role as r', 'rt.rid = r.id', 'left');
		$this->db->where('rt.id', $this->input->cookie('userid'));
		$this->db->order_by('order', 'ASC');
		$rs = $this->db->get();
		return ($rs->num_rows() > 0) ? $rs->result() : array();
	}
}
?>
