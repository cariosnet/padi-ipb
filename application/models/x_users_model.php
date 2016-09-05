<?php
class X_Users_Model extends CI_Model {
	private $table = "X_USERS";
	
	function __construct(){
		// Call the Model constructor
		parent::__construct();
	}
	
	function doLogin($username, $password){
		return $this->db->get_where($this->table,array('USERNAME' => $username, 'PASSWORD' => md5($password.'klikpositif')));
	}
	
	function insertUser($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	function updateUser($data, $id){
		$this->db->where('ID', $id);
		$this->db->update($this->table, $data); 
	}
	
	function getUserById($id){
		return $this->db->get_where($this->table,array('ID' => $id));
	}

	function getUserByUsername($username){
		return $this->db->get_where($this->table,array('USERNAME' => $username));
	}
	
	function delUser($id){
		$this->db->where('ID', $id);
		$this->db->delete($this->table);
		
		if ($this->db->trans_status() === FALSE){
			return false;
		}else{
			return true;
		}
	}
	
	function getListUser($offset, $limit, $search, $sortCol, $sortDir){
		if($search != ""){
			$this->db->like("FULLNAME", $search);
			$this->db->or_like("USERNAME", $search);
			$this->db->or_like("ADDRESS", $search);
		}
		if($sortCol != "")$this->db->order_by($sortCol, $sortDir);
		$this->db->order_by("FULLNAME", "asc");
	
		if($limit == -1)return $this->db->get($this->table);
		else return $this->db->get($this->table, $limit, $offset);
	}
}