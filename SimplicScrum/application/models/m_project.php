<?php
class M_project extends SS_Model{
	function get_list($email=""){
		$this->db->select('project.id,title,desc,access_key');
		$this->db->from('project');
		$this->db->join('role_table', 'project.id = role_table.pid', 'left');

		$rs = $this->db->get();
		return ($rs->num_rows() > 0) ? $rs->result() : array();
	}
}
?>
