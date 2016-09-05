<?php
class X_Agenda_Model extends CI_Model {
	private $table = "X_AGENDA";
	
	function __construct(){
		// Call the Model constructor
		parent::__construct();
	}
	
	function insertData($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	function updateData($data, $id){
		$this->db->where('ID', $id);
		$this->db->update($this->table, $data); 
	}
	
	function getDataById($id){
		return $this->db->get_where($this->table,array('ID' => $id));
	}
	
	function getDataByAlias($alias){
		return $this->db->get_where($this->table,array('ALIAS' => $alias));
	}
	
	function delData($id){
		$this->db->where('ID', $id);
		$this->db->delete($this->table);
		
		if ($this->db->trans_status() === FALSE){
			return false;
		}else{
			return true;
		}
	}
	/**
	 * 
	 * @param unknown_type $limit
	 * @param unknown_type $offset
	 * @param unknown_type $type N = Berita, F  = Fokus
	 * @param unknown_type $status A= Aktif, N = Non Aktif
	 * @param boolean $headline 
	 * @param boolean $pilihan
	 */
	function getListData($limit, $offset, $type = null, $status = null){
		if($type != null)$this->db->where('TYPE', $type);
		if($status != null)$this->db->where('STATUS', $status);
		
		$this->db->order_by("DATE", "desc");
		return $this->db->get($this->table, $limit, $offset);
	}
	
	function getListDataNoLimit($type = null, $status = null, $title = NULL){
		if($type != null)$this->db->where('TYPE', $type);
		if($status != null)$this->db->where('STATUS', $status);
		if($title != null)$this->db->like('TITLE', $title);
	
		$this->db->order_by("DATE", "desc");
		return $this->db->get($this->table);
	}
}