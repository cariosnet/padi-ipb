<?php
Class NewsLogic{
	var $catData = array();
	var $catLoop = 0;
	
	var $CI = NULL;
	
	function __construct(){
        $this->CI =& get_instance();
        $this->CI->load->model('X_News_Category_Model');
        $this->CI->load->model('X_News_Model');
    }
    
    function getListNewsCatRel($cat, $headline, $pilihan, $limit, $offset, $populer = false){
    	$x = $this->getCatIdRel($cat);
    	$this->catData = array();
    	return $this->CI->X_News_Model->getListNewsByCatRel($x, $headline, $pilihan, $limit, $offset, $populer);
    }
    
    private function getCatIdRel($catId){
    	$this->catLoop = 0;
    	
    	$this->catData[$this->catLoop] = $catId;$this->catLoop++;
    	$this->getAllCatAndParent($catId);
    	return $this->catData;
    }
    
    private function getAllCatAndParent($catId){
    	$cat = $this->CI->X_News_Category_Model->getCatByParent($catId);
    
    	if($cat->num_rows() != 0){
    		foreach ($cat->result() as $x){
    			$this->catData[$this->catLoop] = $x->ID;$this->catLoop++;
    			$this->getAllCatAndParent($cat->row()->ID);
    		}
    	}
    }
    
    function getCatParent($catId){
    	$cat = $this->CI->X_News_Category_Model->getCatById($catId);
    
    	if($cat->num_rows() > 0){
    		if($cat->row()->PARENT != null){
    			return $this->getCatParent($cat->row()->PARENT);
    		}else{
    			return $cat->row()->ID;
    		}
    	}else return $catId;
    }
    
    public function getListTagsJson(){
    	$tagsData = array();
    
    	$this->CI->load->model('X_News_Tags_Model');
    	foreach ($this->CI->X_News_Tags_Model->getListTags()->result() as $row){
    		$tagsData[] = $row->TAG;
    	}
    
    	return json_encode($tagsData);
    }
}