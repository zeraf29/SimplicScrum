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

	function makeProject($json,$m_id){

		$result = FALSE;

		$data = array(
		   'title' => $json->title ,
		   'desc' => $json->desc ,
		   'puser_id' => $m_id,
		   'sdate' => $json->start_date,
		   'edate' => $json->end_date
		);

		$this->db->trans_start();
		$this->db->insert('project', $data); 
		if ($this->db->trans_status() == FALSE) {
			$this->db->trans_rollback();	
		}else {
			$this->db->trans_commit();
			$result = TRUE;
		}
		if($result==TRUE){
			$this->db->trans_start();
			foreach($json->member as $key){

				$this->db->select('id');
				$this->db->from('user');
				$this->db->where('email',$key);
				$rs = $this->db->get()->result();

				$data = array(
					'pid' => $this->db->insert_id(),
					'uid' => $rs[0]->id,
					'rid' => '2'
				);
				$this->db->insert('role_table', $data); 
			}
			
			if ($this->db->trans_status() == FALSE) {
				$this->db->trans_rollback();	
				$result = FALSE;
			}else {
				$this->db->trans_commit();
				$result = TRUE;
			}
		}
		$this->db->trans_complete();
		return $result;
	}

	function get_proUsers($id){
		$this->db->select('u.id, u.email, nickname, r.name as role');
		$this->db->from('role_table as rt');
		$this->db->join('user as u', 'rt.uid = u.id', 'left');
		$this->db->join('role as r', 'rt.rid = r.id', 'left');
		$this->db->where('rt.pid', $id);
		$this->db->order_by('rt.rid', 'ASC');
		$rs = $this->db->get();
		return ($rs->num_rows() > 0) ? $rs->result() : array();
	}

	function deleteProject($id){
		$result = 0;

		$this->db->where('puser_id', $this->session->userdata("ss_userid"));
		$this->db->where('id', $id);
		$this->db->from('project');
		$num = $this->db->count_all_results();

		if($num>0){
			$this->db->where('pid', $id);
			$this->db->from('role_table');
			$num = $this->db->count_all_results();
			if($num==1){
				$this->db->where('id', $id);
				if($this->db->delete('project'))
					$result = 2;
			}else if($num>1){
				$result = 1;
			}
		}

		return $result;
	}
}
?>
