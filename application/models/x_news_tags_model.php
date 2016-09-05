<?php
class X_News_Tags_Model extends CI_Model {
	private $table = "X_NEWS_TAGS";
	
	function __construct(){
		// Call the Model constructor
		parent::__construct();
	}
	
	function insertTags($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	function updateTags($data, $id){
		$this->db->where('ID', $id);
		$this->db->update($this->table, $data); 
	}
	
	function getTagsById($id){
		return $this->db->get_where($this->table,array('ID' => $id));
	}
	
	function getTagsByName($alias){
		return $this->db->get_where($this->table,array('TAG' => $alias));
	}
	
	function delTags($id){
		$this->db->where('ID', $id);
		$this->db->delete($this->table);
		
		if ($this->db->trans_status() === FALSE){
			return false;
		}else{
			return true;
		}
	}
	
	function getListTags(){
		$this->db->order_by("TAG", "asc");
		return $this->db->get($this->table);
	}
}