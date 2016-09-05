<?php
class X_Ads_Model extends CI_Model {
	private $table = "X_ADS";
	
	function __construct(){
		// Call the Model constructor
		parent::__construct();
	}
	
	function insertAds($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	function updateAds($data, $id){
		$this->db->where('ADS_ID', $id);
		$this->db->update($this->table, $data); 
	}
	
	function getAdsById($id){
		return $this->db->get_where($this->table,array('ADS_ID' => $id));
	}
	
	function getAdsByAlias($alias){
		return $this->db->get_where($this->table,array('ALIAS' => $alias));
	}
	
	function getAdsByCat($cat){
		return $this->db->get_where($this->table,array('ADS_CAT' => $cat));
	}
	
	function delAds($id){
		$this->db->where('ADS_ID', $id);
		$this->db->delete($this->table);
		
		if ($this->db->trans_status() === FALSE){
			return false;
		}else{
			return true;
		}
	}
	
	function getListAds($limit, $offset, $date,  $status = null){
		if($status != null)$this->db->where('STATUS', $status);
		
		$this->db->where('ADS_START <=', $date);
		$this->db->where('ADS_FINISH >=', $date);
		
		$this->db->order_by("ADS_START", "desc");
		return $this->db->get($this->table, $limit, $offset);
	}
	
	function getListAdsNoLimit($date, $param = null, $cat = null, $status = null){
		if($param != null)$this->db->like('ADS_TITLE', $param);
		
		if($status != null)$this->db->having('STATUS', $status);
		if($cat != null)$this->db->having('ADS_CAT', $cat);
		$this->db->having('ADS_START <=', $date);
		
		$this->db->having('ADS_FINISH >=', $date);
		
		$this->db->order_by("ADS_START", "desc");
		
		return $this->db->get($this->table);
	}
	
	function getListAdsJoin($offset, $limit, $search, $sortCol, $sortDir, $isPending = false){
		//$this->db->select('a.ID AS TypeId, a.Id AS Id, a.Title AS Title, a.Title_en AS Title_en, a.Title_ja AS Title_ja, a.ProvinceId AS ProvinceId, a.Date as Date, b.Name AS ProvinceName');
		$this->db->join('X_ADS_CATEGORY as b', 'b.ID = a.ADS_CAT', 'full');
		
		if($search != ""){
			$this->db->like("ADS_TITLE", $search);
			$this->db->or_like("CAT_NAME", $search);
			$this->db->or_like("STATUS", $search);
		}
		if($sortCol != "")$this->db->order_by($sortCol, $sortDir);
		$this->db->order_by("ADS_START", "desc");
		
		if($isPending)$this->db->having("STATUS", "PENDING");
		else $this->db->having("STATUS !=", "PENDING");
	
		if($limit == -1)return $this->db->get($this->table. ' as a');
		else return $this->db->get($this->table. ' as a', $limit, $offset);
	}
}