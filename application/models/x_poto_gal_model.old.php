<?php
class X_Poto_Gal_Model extends CI_Model {
	private $table = "X_POTO_GAL";
	private $table_kateg = "X_POTO_KAT";
	
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
		$this->db->select('X_POTO_GAL.*,X_POTO_KAT.TITLE as TITLE_KAT');
		$this->db->join("X_POTO_KAT", 'X_POTO_KAT.ID = X_POTO_GAL.ID_KAT');
		$this->db->where('X_POTO_GAL.ID', $id);
		$this->db->order_by("X_POTO_GAL.ID", "desc");
		return $this->db->get($this->table);
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
	
	function getListPoto(){
		$this->db->select('X_POTO_GAL.*,X_POTO_KAT.TITLE as TITLE_KAT, X_NEWS_CATEGORY.CAT_NAME');
		$this->db->join("X_POTO_KAT", 'X_POTO_KAT.ID = X_POTO_GAL.ID_KAT');
		$this->db->join("X_NEWS_CATEGORY", 'X_NEWS_CATEGORY.ID = X_POTO_GAL.KANAL');
		$this->db->order_by("X_POTO_GAL.ID", "desc");
		return $this->db->get($this->table);
	}
	
	function getListPotobyCateg(){
		$this->db->select('X_POTO_GAL.*,X_POTO_KAT.TITLE as TITLE_KAT, X_NEWS_CATEGORY.CAT_NAME');
		$this->db->join("X_POTO_KAT", 'X_POTO_KAT.ID = X_POTO_GAL.ID_KAT');
		$this->db->join("X_NEWS_CATEGORY", 'X_NEWS_CATEGORY.ID = X_POTO_GAL.KANAL');
		$this->db->order_by("X_POTO_KAT.ID", "desc");
		$this->db->order_by("X_POTO_GAL.ID", "asc");
		$this->db->group_by('X_POTO_KAT.TITLE');
		$this->db->limit(5);
		return $this->db->get($this->table);
	}
	
	function getSlidePoto($id){
		$this->db->select('X_POTO_GAL.*,X_POTO_KAT.TITLE as TITLE_KAT, X_NEWS_CATEGORY.CAT_NAME');
		$this->db->join("X_POTO_KAT", 'X_POTO_KAT.ID = X_POTO_GAL.ID_KAT');
		$this->db->join("X_NEWS_CATEGORY", 'X_NEWS_CATEGORY.ID = X_POTO_GAL.KANAL');
		$this->db->where("X_POTO_GAL.ID_KAT", $id);
		$this->db->order_by("X_POTO_GAL.ID", "asc");
		return $this->db->get($this->table);
	}
	
	function getLatestPoto($id){
		$this->db->select('X_POTO_GAL.*,X_POTO_KAT.TITLE as TITLE_KAT, X_NEWS_CATEGORY.CAT_NAME');
		$this->db->join("X_POTO_KAT", 'X_POTO_KAT.ID = X_POTO_GAL.ID_KAT');
		$this->db->join("X_NEWS_CATEGORY", 'X_NEWS_CATEGORY.ID = X_POTO_GAL.KANAL');
		$this->db->where("X_POTO_GAL.ID", $id);
		return $this->db->get($this->table);
	}
	
	function getFirstPoto($id){
		$this->db->select('X_POTO_GAL.*,X_POTO_KAT.TITLE as TITLE_KAT, X_NEWS_CATEGORY.CAT_NAME');
		$this->db->join("X_POTO_KAT", 'X_POTO_KAT.ID = X_POTO_GAL.ID_KAT');
		$this->db->join("X_NEWS_CATEGORY", 'X_NEWS_CATEGORY.ID = X_POTO_GAL.KANAL');
		$this->db->where("X_POTO_GAL.ID_KAT", $id);
		$this->db->order_by("X_POTO_GAL.ID", "desc");
		return $this->db->get($this->table, 1);
	}
	
	//for kateg
	
	function getListKategPoto(){
		$this->db->order_by("ID", "asc");
		return $this->db->get($this->table_kateg);
	}
	
	function insertKateg($data){
		$this->db->insert($this->table_kateg, $data);
		return $this->db->insert_id();
	}
	
	function updateKateg($data, $id){
		$this->db->where('ID', $id);
		$this->db->update($this->table_kateg, $data); 
	}
	
	function getLatestPotoKateg($id){
		$this->db->where("ID", $id);
		return $this->db->get($this->table_kateg);
	}
	
	function delKateg($id){
		$this->db->where('ID', $id);
		$this->db->delete($this->table_kateg);
		
		if ($this->db->trans_status() === FALSE){
			return false;
		}else{
			return true;
		}
	}
	
	function getKategById($id){
		return $this->db->get_where($this->table_kateg,array('ID' => $id));
	}
}