<?php
class X_News_Category_Model extends CI_Model {
	private $table = "X_NEWS_CATEGORY";
	
	function __construct(){
		// Call the Model constructor
		parent::__construct();
	}
	
	function insertCat($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	function updateCat($data, $id){
		$this->db->where('ID', $id);
		$this->db->update($this->table, $data); 
	}
	
	function getCatById($id){
		return $this->db->get_where($this->table,array('ID' => $id));
	}
	
	function getCatByAlias($alias){
		return $this->db->get_where($this->table,array('CAT_ALIAS' => $alias));
	}
	
	function getCatByParent($parent){
		return $this->db->get_where($this->table,array('PARENT' => $parent));
	}
	
	function delCat($id){
		$this->db->where('ID', $id);
		$this->db->delete($this->table);
		
		if ($this->db->trans_status() === FALSE){
			return false;
		}else{
			return true;
		}
	}
	
	function getListCat($parent = null){
		$this->db->where('PARENT', $parent);
		//$this->db->where('type',1);
		$this->db->where('ID <> 99');
		$this->db->order_by("CAT_ORDER", "asc");
		$this->db->order_by("CAT_NAME", "asc");
		
		return $this->db->get($this->table);
	}
	function getListCatType($type,$parent = null){
		$this->db->where('PARENT', $parent);
		$this->db->where('type',$type);
		$this->db->where('ID <> 99');
		$this->db->order_by("CAT_ORDER", "asc");
		$this->db->order_by("CAT_NAME", "asc");
	
		return $this->db->get($this->table);
	}
	function getListCatTypeAll($type){
		$this->db->where('type',$type);
		$this->db->where('ID <> 99');
		$this->db->order_by("CAT_ORDER", "asc");
		$this->db->order_by("CAT_NAME", "asc");
		
		return $this->db->get($this->table);
	}
	function getListCatArtikel($parent = null){
		$this->db->where('PARENT', $parent);
		$this->db->where('type',2);
		$this->db->where('ID <> 99');
		$this->db->order_by("CAT_ORDER", "asc");
		$this->db->order_by("CAT_NAME", "asc");
	
		return $this->db->get($this->table);
	}
	
	function getListCatALL($parent = null){
		$this->db->where('PARENT', $parent);
		$this->db->order_by("CAT_ORDER", "asc");
		$this->db->order_by("CAT_NAME", "asc");
		
		return $this->db->get($this->table);
	}
	
	function getListCatByAlias($alias = null){
		if($alias != null)$this->db->where('CAT_ALIAS', $alias);
		//$this->db->where('PARENT', $parent);
		
		$this->db->order_by("PARENT", "asc");
		$this->db->order_by("CAT_ORDER", "asc");
		$this->db->order_by("CAT_NAME", "asc");
	
		return $this->db->get($this->table);
	}
	
	function getListCatException($id){
		$this->db->where('ID !=', $id);
		$this->db->where('PARENT', null);
		$this->db->order_by("CAT_ORDER", "asc");
		$this->db->order_by("CAT_NAME", "asc");
	
		return $this->db->get($this->table);
	}
}