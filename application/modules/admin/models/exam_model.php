<?php 
/**
* KhoiPK
* Class Exam Model
*/
class exam_model extends CI_Model
{
	protected $table = "tbl_exam";

	public function getAll($params = array())
	{
		$this->db->select('tbl_exam.id, tbl_exam.name, tbl_exam.enable_date');
		return $this->db->from($this->table)
					->get()
					->result_array();
	}

	public function insertOrUpdate($data,$id = "")
	{
		if(!$id) {
			$this->db->insert($this->table,$data);
		} else {
			$this->db->where("id",$id);
			$this->db->update($this->table,$data);
		}
	}

	public function getOnce($id)
	{

		return $this->db->select('*')
					 ->from($this->table)	
					 ->where("id",$id)
					 ->get()
					 ->row_array();

	}
}