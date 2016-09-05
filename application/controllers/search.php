<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MY_Controller {
	
	function Search(){
		parent::__construct();	
		$this->load->model('X_Pages_Model');
	}
    
    function index(){
    	$this->load->model('X_News_Model');
    	$this->load->model('X_Ads_Position_Model');
    	$this->load->model('eksternal/Phpbb_Posts_Model', 'Phpbb_Posts_Model');
    	 
    	$data = array(
    			'pageTitle' 	=> 'Pencarian Berita',
    			'content'	 	=> 'front/indeks/search',
    			'meta_desc'		=> 'Pencarian berita KlikPositif',
    			'meta_key'		=> 'Pencarian, berita, klikpositif, google',
    			'contentData'	=> array(
    					'listLatestNews'	=> $this->X_News_Model->getListNews(6, 0, "N", "A"),
    					'listPopuler'		=> $this->X_News_Model->getPopularNews(6, 0, "N", "A"),
    					'listForum'			=> $this->Phpbb_Posts_Model->getListThreads(),
    					'listBanner'		=> $this->X_Ads_Position_Model->getListPositionBannerJoinFront(9, "a"),
    					'listBannerSide'	=> $this->X_Ads_Position_Model->getListPositionBannerJoinFront(9, "b")
    			)
    	);
    	 
    	$this->load->view('front/layout', $data);
    }
}

/* End of file search.php */
/* Location: ./application/controllers/search.php */