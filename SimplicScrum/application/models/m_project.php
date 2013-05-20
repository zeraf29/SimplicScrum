<?php
class M_project extends SS_Model{
	function get_list(){
		$this->db->select('p.id,p.title,p.desc,p.access_key,p.sdate,p.edate,p.openpj,r.id as rlevel');
		$this->db->from('role_table as rt');
		$this->db->join('project as p', 'rt.pid = p.id', 'left');
		$this->db->join('role as r', 'rt.rid = r.id', 'left');
		$this->db->where('rt.uid', $this->session->userdata("ss_userid"));
		$this->db->order_by('reg_date', 'ASC');
		$rs = $this->db->get();
		return ($rs->num_rows() > 0) ? $rs->result() : array();
	}

	function makeProject($title,$desc,$puser_id,$sdate,$edate){
		$result = FALSE;
		$pw = sha1($pw);
		$data = array(
		   'title' => $title ,
		   'desc' => $desc ,
		   'puser_id' => $puser_id,
		   'sdate' => $sdate,
		   'edate' => $edate
		);

		$this->db->trans_start();
		$this->db->insert('project', $data); 
		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();	
		}else {
			$this->db->trans_commit();
			$result = TRUE;
		}
		$this->db->trans_complete();
		return $result;
	}

	function deleteProject($id){
		$result = FALSE;
		$this->db->where('id', $id);
		if($this->db->delete('project'))
			$result = TRUE;

		return $result;
	}
}
?>
