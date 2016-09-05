<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cat extends CI_Controller {
	
	function Cat(){
		parent::__construct();	
		$this->load->model('X_Pages_Model');
	}

	function index(){
    	redirect('home');
    }
    
    function detail($param = null){
    	$this->load->library('newslogic');
    	$this->load->library('bogcamp');
    	
    	$this->load->model('X_Ads_Position_Model');
    	$this->load->model('eksternal/Phpbb_Posts_Model', 'Phpbb_Posts_Model');
    	
    	$catObj = $this->X_News_Category_Model->getCatByAlias($param);
    	if($catObj->num_rows() == 0)redirect('home');
    	
    	$data = array(
    			'pageTitle' 	=> 'KlikPositif | '.$catObj->row()->CAT_NAME,
    			'content'	 	=> 'front/cat/cat-detail',
    			'meta_desc'		=> $catObj->row()->META_DESC,
    			'meta_key'		=> $catObj->row()->META_KEYWORD,
    			'contentData'	=> array(
    					'catObj'			=> $catObj,
    					'listHeadline'		=> $this->newslogic->getListNewsCatRel($catObj->row()->ID, 1, 0, 3, 0),
    					'listLatest'		=> $this->newslogic->getListNewsCatRel($catObj->row()->ID, null, 0, 3, 0),
    					'listPilihan'		=> $this->newslogic->getListNewsCatRel($catObj->row()->ID, null, 1, 5, 0),
    					'listParent'		=> $this->X_News_Category_Model->getListCatException($this->newslogic->getCatParent($catObj->row()->ID)),
    					'listForum'			=> $this->Phpbb_Posts_Model->getListThreads(),
    					'listBanner'		=> $this->X_Ads_Position_Model->getListPositionBannerJoinFront(2, "a"),
    					'listBannerSide'	=> $this->X_Ads_Position_Model->getListPositionBannerJoinFront(2, "b")
    			)
    	);
    	
    	$this->load->view('front/layout', $data);
    }
}

/* End of file cat.php */
/* Location: ./application/controllers/cat.php */