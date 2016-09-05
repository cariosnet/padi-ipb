<?php
class X_Ads_Banner_Model extends CI_Model {
	private $table = "X_ADS_BANNER";
	
	function __construct(){
		// Call the Model constructor
		parent::__construct();
	}
	
	function insertAds($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	function updateAds($data, $id){
		$this->db->where('ID', $id);
		$this->db->update($this->table, $data); 
	}
	
	function getAdsById($id){
		return $this->db->get_where($this->table,array('ID' => $id));
	}
	
	function delAds($id){
		$this->db->where('ID', $id);
		$this->db->delete($this->table);
		
		if ($this->db->trans_status() === FALSE){
			return false;
		}else{
			return true;
		}
	}
	
	function getListBanner(){
		$this->db->order_by("KIND", "asc");
		$this->db->order_by("ORDER", "asc");
		$this->db->order_by("TITLE", "asc");
		return $this->db->get($this->table);
	}
}