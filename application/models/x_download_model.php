<?php
class X_Download_Model extends CI_Model {
	private $table = "X_DOWNLOAD";
	
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
	
	function getListDataFilter($category,$title, $type, $nomor, $tahun){
		$this->db->select('X_NEWS_CATEGORY.CAT_NAME,X_NEWS_CATEGORY.CAT_ORDER, X_DOWNLOAD.*');
		$this->db->join('X_NEWS_CATEGORY','X_NEWS_CATEGORY.ID = X_DOWNLOAD.KATEGORI','left');
		if($type != "")$this->db->where('TYPE', $type);
		$this->db->where('STATUS', 'A');
		if($title != "")$this->db->like('TITLE', $title);
		if($nomor != "")$this->db->where('NOMOR', $nomor);
		if($tahun != "")$this->db->where('TAHUN', $tahun);
		if($category != "")$this->db->where('KATEGORI', $category);
		$this->db->order_by("X_NEWS_CATEGORY.CAT_ORDER", "asc");
		$this->db->order_by("X_NEWS_CATEGORY.CAT_NAME", "asc");
		return $this->db->get($this->table);
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
		
		$this->db->order_by("CREATED_DATE", "desc");
		return $this->db->get($this->table, $limit, $offset);
	}
	
	function getListDataNoLimit($type = null, $status = null, $title = NULL){
		$this->db->select('X_NEWS_CATEGORY.CAT_NAME, X_DOWNLOAD.*');
		if($type != null)$this->db->where('X_DOWNLOAD.TYPE', $type);
		if($status != null)$this->db->where('X_DOWNLOAD.STATUS', $status);
		if($title != null)$this->db->like('X_DOWNLOAD.TITLE', $title);
		
		$this->db->join('X_NEWS_CATEGORY','X_NEWS_CATEGORY.ID = X_DOWNLOAD.KATEGORI','left');
		$this->db->order_by("X_DOWNLOAD.CREATED_DATE", "desc");
		return $this->db->get($this->table);
	}
}