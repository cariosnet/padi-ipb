<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Indeks extends CI_Controller {
	
	function Indeks(){
		parent::__construct();	
		$this->load->model('X_Pages_Model');
	}
    
    function index($param = null){
    	$this->load->model('X_News_Model');
    	$this->load->model('X_News_Category_Model');
    	$this->load->model('X_Ads_Position_Model');
    	$this->load->model('eksternal/Phpbb_Posts_Model', 'Phpbb_Posts_Model');
    	
    	$data = array(
    			'pageTitle' 	=> 'Indeks Berita',
    			'content'	 	=> 'front/indeks/indeks-list',
    			'meta_desc'		=> 'Indeks berita KlikPositif',
    			'meta_key'		=> 'indeks, berita, klikpositif, google',
    			'contentData'	=> array(
    					'listLatestNews'	=> $this->X_News_Model->getListNews(6, 0, "N", "A"),
    					'listPopuler'		=> $this->X_News_Model->getPopularNews(6, 0, "N", "A"),
    					'listCat'			=> $this->X_News_Category_Model->getListCat(),
    					'cat'				=> $param,
    					'listForum'			=> $this->Phpbb_Posts_Model->getListThreads(),
    					'listBanner'		=> $this->X_Ads_Position_Model->getListPositionBannerJoinFront(6, "a"),
    					'listBannerSide'	=> $this->X_Ads_Position_Model->getListPositionBannerJoinFront(6, "b")
    			)
    	);
    	 
    	$this->load->view('front/layout', $data);
    }
    
    function ajax_filter(){
    	$this->load->model('X_News_Model');
    	
    	$param = null;
    	if($this->input->post('cat', TRUE) != '')$param = $this->input->post('cat', TRUE);
    	
    	$data = array(
    			'listCat'	=> $this->X_News_Category_Model->getListCatByAlias($param),
    			'date'		=> date("Y-m-d", strtotime($this->input->post('date', TRUE)))
    	);
    	
    	$this->load->view('front/indeks/indeks-list-ajax', $data);
    }
    
    function fokus(){
    	$this->load->model('X_News_Model');
    	$this->load->model('X_Ads_Position_Model');
    	$this->load->model('eksternal/Phpbb_Posts_Model', 'Phpbb_Posts_Model');
    	 
    	$data = array(
    			'pageTitle' 	=> 'Indeks Fokus',
    			'content'	 	=> 'front/indeks/indeks-fokus-list',
    			'meta_desc'		=> 'Indeks Fokus KlikPositif',
    			'meta_key'		=> 'indeks, fokus, klikpositif, google',
    			'contentData'	=> array(
    					'listLatestNews'	=> $this->X_News_Model->getListNews(6, 0, "N", "A"),
    					'listPopuler'		=> $this->X_News_Model->getPopularNews(6, 0, "N", "A"),
    					'listForum'			=> $this->Phpbb_Posts_Model->getListThreads(),
    					'listBanner'		=> $this->X_Ads_Position_Model->getListPositionBannerJoinFront(7, "a"),
    					'listBannerSide'	=> $this->X_Ads_Position_Model->getListPositionBannerJoinFront(7, "b")
    			)
    	);
    
    	$this->load->view('front/layout', $data);
    }
    
    function dialog(){
    	$this->load->model('X_News_Model');
    	$this->load->model('X_Ads_Position_Model');
    	$this->load->model('eksternal/Phpbb_Posts_Model', 'Phpbb_Posts_Model');
    
    	$data = array(
    			'pageTitle' 	=> 'Indeks Wawancara',
    			'content'	 	=> 'front/indeks/indeks-dialog-list',
    			'meta_desc'		=> 'Indeks Wawancara KlikPositif',
    			'meta_key'		=> 'indeks, wawancara, klikpositif, google',
    			'contentData'	=> array(
    					'listLatestNews'	=> $this->X_News_Model->getListNews(6, 0, "N", "A"),
    					'listPopuler'		=> $this->X_News_Model->getPopularNews(6, 0, "N", "A"),
    					'listForum'			=> $this->Phpbb_Posts_Model->getListThreads(),
    					'listBanner'		=> $this->X_Ads_Position_Model->getListPositionBannerJoinFront(8, "a"),
    					'listBannerSide'	=> $this->X_Ads_Position_Model->getListPositionBannerJoinFront(8, "b")
    			)
    	);
    
    	$this->load->view('front/layout', $data);
    }
    
    function ajax_filter_special($param){
    	$this->load->model('X_News_Model');
    	$type = $this->input->post('type', TRUE);
    	$name = $this->input->post('name', TRUE);
    	
    	$date = null;
    	if($this->input->post('date', TRUE) != "")
    		$date = date("Y-m-d", strtotime($this->input->post('date', TRUE)));
    	
    	$data = array(
    			'type'			=> array('color'=>'#c8372f', 'url'=>$param, 'name'=> $name),
    			'listNews'		=> $this->X_News_Model->getListNewsIndeksByType($type, $date)
    	);
    	 
    	$this->load->view('front/indeks/indeks-special-list-ajax', $data);
    }
}

/* End of file indeks.php */
/* Location: ./application/controllers/indeks.php */