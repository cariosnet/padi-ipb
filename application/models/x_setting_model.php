<?php
class X_Setting_Model extends CI_Model {
	private $table = "X_SETTING";
	
	function __construct(){
		// Call the Model constructor
		parent::__construct();
	}
	
	function updateSetting($data, $id){
		$this->db->where('ID', $id);
		$this->db->update($this->table, $data); 
	}
	
	function getSettingById($id){
		return $this->db->get_where($this->table,array('ID' => $id));
	}
}