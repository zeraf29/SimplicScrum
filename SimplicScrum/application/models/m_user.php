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
	function get_UserInfo(){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('id', $this->session->userdata("ss_userid"));
		$rs = $this->db->get();
		return ($rs->num_rows() > 0) ? $rs->result() : array();
	}
	function find_User($email){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email', $email);
		$rs = $this->db->get();
		return ($rs->num_rows() > 0) ? TRUE : FALSE;
	}
	function sign_Up($nickname,$email,$pw){

		$result = FALSE;
		$pw = sha1($pw);
		$data = array(
		   'email' => $email ,
		   'nickname' => $nickname ,
		   'pw' => $pw
		);

		$this->db->trans_start();
		$this->db->insert('user', $data); 
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
