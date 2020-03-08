<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function Add($data)
	{
		$this->db->insert('user',$data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	public function Get()
	{
		$query=$this->db->get('user');
		return $query->result_array();
	}
	public function getByID($where)
	{
		$this->db->where($where);
		$query=$this->db->get('user');
		return $query->row();
	}
	public function Update($where,$data)
	{
		$this->db->where($where);
		$this->db->update('user',$data);
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
	public function Delete($where)
	{
		$this->db->where($where);
		$this->db->delete('user');
		if($this->db->affected_rows()>0){
			return true;
		}else{
			return false;
		}
	}
}

/* End of file UserModel.php */
/* Location: ./application/models/UserModel.php */