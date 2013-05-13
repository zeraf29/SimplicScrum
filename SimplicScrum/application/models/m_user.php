<?php
class M_user extends SS_Model{
	function get_login($email,$pw){
		$this->db->select('*');
		$this->db->from("user");
		$this->db->where("email",$email);
		$this->db->where("pw",sha1("$pw"));
		$rs  = $this->db->get();
		return ($rs->num_rows() > 0) ? $rs->result() : array();
	}
}
?>
