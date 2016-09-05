<?php
class X_Ads_Position_Model extends CI_Model {
	private $tableHelp = "X_ADS_POSITION";
	private $table = "X_ADS_BANNER_POSITION";
	
	function __construct(){
		// Call the Model constructor
		parent::__construct();
	}
	
	function insertPosition($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	function updatePosition($data, $id){
		$this->db->where('ID', $id);
		$this->db->update($this->table, $data); 
	}
	
	function getPositionById($id){
		return $this->db->get_where($this->table,array('ID' => $id));
	}
	
	function delPosition($id){
		$this->db->where('ID', $id);
		$this->db->delete($this->table);
		
		if ($this->db->trans_status() === FALSE){
			return false;
		}else{
			return true;
		}
	}
	
	function getListPosition(){
		$this->db->order_by("ORDER", "asc");
		$this->db->order_by("POSITION_NAME", "asc");
		return $this->db->get($this->tableHelp);
	}
	
	function getListPositionBanner($ban, $pos = null){
		$this->db->where('BANNER', $ban);
		if($pos != null)$this->db->where('POSITION', $pos);
		return $this->db->get($this->table);
	}
	
	function getListPositionBannerJoin($ban){
		$this->db->join($this->tableHelp.' as b', 'b.ID = a.POSITION', 'full');
		$this->db->where('BANNER', $ban);
		
		$this->db->order_by("ORDER", "asc");
		$this->db->order_by("POSITION_NAME", "asc");
		return $this->db->get($this->table.' as a');
	}
	
	function getListPositionBannerJoinFront($position, $kind){
		$this->db->join('X_ADS_BANNER as b', 'b.ID = a.BANNER', 'full');
		$this->db->where('POSITION', $position);
		$this->db->where('KIND', $kind);
		$this->db->where('STATUS', "A");
	
		$this->db->order_by("ORDER", "asc");
		$this->db->order_by("TITLE", "asc");
		return $this->db->get($this->table.' as a');
	}
}