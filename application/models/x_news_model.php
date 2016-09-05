<?php
class X_News_Model extends CI_Model {
	private $table = "X_NEWS";
	
	function __construct(){
		// Call the Model constructor
		parent::__construct();
	}
	
	function news_row(){
		$this->db->where('STATUS','A');
		$this->db->where('TYPE','N');
		return $this->db->get($this->table)->num_rows();
	}
	
	function news_row_category($alias){
		$this->db->join('X_NEWS_CATEGORY cat', 'cat.ID = X_NEWS.CAT','inner');
		$this->db->where('cat.CAT_ALIAS', $alias);
		$this->db->where('X_NEWS.STATUS','A');
		$this->db->where('X_NEWS.TYPE','N');
		return $this->db->get($this->table)->num_rows();
	}
	
	function getNewArtikelLimit($idx){
		$this->db->where('X_NEWS.TYPE',$idx);
		$this->db->where('X_NEWS.STATUS','A');
		$this->db->order_by('X_NEWS.CREATED_DATE','DESC');
		$this->db->limit(7);
		return $this->db->get($this->table);
	}
	
	function getAllNewsCategory($alias,$type,$page,$uri){
		$this->db->select('X_NEWS.*');
		$this->db->join('X_NEWS_CATEGORY cat', 'cat.ID = X_NEWS.CAT','inner');
		$this->db->where('cat.CAT_ALIAS', $alias);
		$this->db->where('X_NEWS.STATUS','A');
		$this->db->where('X_NEWS.TYPE',$type);
		return $this->db->get ($this->table, $page, $uri );
	}
	
	function getAllNews($type,$page,$uri){
		$this->db->where('STATUS','A');
		$this->db->where('TYPE',$type);
        $this->db->order_by('X_NEWS.CREATED_DATE','DESC');
		return $this->db->get ($this->table, $page, $uri );
	}
	
	function insertNews($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	function updateNews($data, $id){
		$this->db->where('NEWS_ID', $id);
		$this->db->update($this->table, $data); 
	}
	
	function getNewsById($id){
		return $this->db->get_where($this->table,array('NEWS_ID' => $id));
	}
	
	function getNewsByAlias($alias){
		return $this->db->get_where($this->table,array('ALIAS' => $alias));
	}
	
	function getNewsByCat($cat){
        $this->db->where('CAT',$cat);
        $this->db->order_by('X_NEWS.CREATED_DATE','DESC');
        return $this->db->get ($this->table);
		//return $this->db->get_where($this->table,array('CAT' => $cat));
	}
	
	function getNewsByCatLimit($cat){
		$this->db->where('CAT', $cat);
		$this->db->limit(2);
		return $this->db->get($this->table);
	}
	
	function delNews($id){
		$this->db->where('NEWS_ID', $id);
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
	function getListNews($limit, $offset, $type = null, $status = null, $headline = null, $pilihan = null){
		if($type != null)$this->db->where('TYPE', $type);
		if($status != null)$this->db->where('STATUS', $status);
		if($headline != null)$this->db->where('IS_HEADLINE', $headline);
		if($pilihan != null)$this->db->where('IS_PILIHAN', $pilihan);
		if($headline == null)$this->db->where('IS_HEADLINE !=1');
		
		$this->db->order_by("DATE", "desc");
		return $this->db->get($this->table, $limit, $offset);
	}
	
	function getPopularNews($limit, $offset, $type = null, $status = null, $headline = null, $pilihan = null){
		if($type != null)$this->db->where('TYPE', $type);
		if($status != null)$this->db->where('STATUS', $status);
		if($headline != null)$this->db->where('IS_HEADLINE', $headline);
		if($pilihan != null)$this->db->where('IS_PILIHAN', $pilihan);
	
		$this->db->order_by("PAGE_VIEW", "desc");
		$this->db->order_by("DATE", "desc");
		return $this->db->get($this->table, $limit, $offset);
	}
	
	function getListNewsNoLimit($type = null, $status = null, $headline = null, $pilihan = null){
		if($type != null)$this->db->where('TYPE', $type);
		if($status != null)$this->db->where('STATUS', $status);
		if($headline != null)$this->db->where('IS_HEADLINE', $headline);
		if($pilihan != null)$this->db->where('IS_PILIHAN', $pilihan);
	
		$this->db->order_by("DATE", "desc");
		return $this->db->get($this->table);
	}
	
	function getListNewsByCatRel($cat, $headline, $pilihan, $limit, $offset, $populer = false){
		$this->db->where('CAT', $cat[0]);
		for($i = 1; $i < count($cat); $i++)
			$this->db->or_where('CAT', $cat[$i]);
		
		$this->db->having('STATUS', "A");
		if($headline != null)$this->db->having('IS_HEADLINE', $headline);
		if($pilihan != null)$this->db->having('IS_PILIHAN', $pilihan);
		
		if($populer == true)$this->db->order_by('PAGE_VIEW', "desc");
		$this->db->order_by("DATE", "desc");
		return $this->db->get($this->table, $limit, $offset);
	}
	
	function getListNewsByCat($cat, $headline, $pilihan, $limit, $offset){
		if($headline != null)$this->db->where('IS_HEADLINE', $headline);
		if($pilihan != null)$this->db->where('IS_PILIHAN', $pilihan);
		
		$this->db->where('STATUS', "A");
		$this->db->where('CAT', $cat);
		$this->db->order_by("DATE", "desc");
		return $this->db->get($this->table, $limit, $offset);
	}
	
	function getListNewsIndeks($cat, $date, $headline = null, $pilihan = null){
		if($headline != null)$this->db->where('IS_HEADLINE', $headline);
		if($pilihan != null)$this->db->where('IS_PILIHAN', $pilihan);
	
		if($date != null)$this->db->like('DATE', $date, "after");
		$this->db->where('STATUS', "A");
		$this->db->where('CAT', $cat);
		$this->db->order_by("DATE", "desc");
		return $this->db->get($this->table);
	}
	
	function getListNewsIndeksByType($type, $date){
		$this->db->where('TYPE', $type);
		if($date != null)$this->db->like('DATE', $date, "after");
		
		$this->db->where('STATUS', "A");
		$this->db->order_by("DATE", "desc");
		return $this->db->get($this->table);
	}
	
	function getListNewsJoin($offset, $limit, $search, $sortCol, $sortDir, $type){
		//$this->db->select('a.ID AS TypeId, a.Id AS Id, a.Title AS Title, a.Title_en AS Title_en, a.Title_ja AS Title_ja, a.ProvinceId AS ProvinceId, a.Date as Date, b.Name AS ProvinceName');
		$this->db->join('X_NEWS_CATEGORY as b', 'b.ID = a.CAT', 'full');
		$this->db->where('a.TYPE', $type);
		if($search != ""){
			$this->db->like("NEWS_TITLE", $search);
			$this->db->or_like("CAT_NAME", $search);
		}
		if($sortCol != "")$this->db->order_by($sortCol, $sortDir);
		
		$this->db->order_by("DATE", "desc");
	
		if($limit == -1)return $this->db->get($this->table. ' as a');
		else return $this->db->get($this->table. ' as a', $limit, $offset);
	}
	
	function getListNewsRelated($limit, $offset, $type, $dateMax, $tags){
		$this->db->like('TAGS', $tags[0]);
		for($i = 1; $i < count($tags); $i++)
			$this->db->or_like('TAGS', $tags[$i]);
		
		$this->db->having('DATE <', $dateMax);
		$this->db->having('STATUS', "A");
		$this->db->having('TYPE', $type);
		
		$this->db->order_by("DATE", "desc");
		
		return $this->db->get($this->table, $limit, $offset);
	}
}