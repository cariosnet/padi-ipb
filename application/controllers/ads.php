<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ads extends CI_Controller {
	var $breadData = array();
	var $breadLoop = 0;
	
	function Ads(){
		parent::__construct();	
		$this->load->model('eksternal/Phpbb_Posts_Model', 'Phpbb_Posts_Model');
		$this->load->model('X_Pages_Model');
	}

	function index(){
    	$this->load->model('X_News_Model');
    	$this->load->model('X_Ads_Category_Model');
    	$this->load->model('X_Ads_Position_Model');
    	 
    	$data = array(
    			'pageTitle' 	=> 'Iklan Baris',
    			'content'	 	=> 'front/ads/indeks-ads-list',
    			'meta_desc'		=> 'Indeks Iklan Bariks KlikPositif',
    			'meta_key'		=> 'indeks, iklan, baris, space, banner, klikpositif, google',
    			'contentData'	=> array(
    					'listLatestNews'	=> $this->X_News_Model->getListNews(6, 0, "N", "A"),
    					'listPopuler'		=> $this->X_News_Model->getPopularNews(6, 0, "N", "A"),
    					'listForum'			=> $this->Phpbb_Posts_Model->getListThreads(),
    					'listCat'			=> $this->X_Ads_Category_Model->getListCat(),
    					'listBanner'		=> $this->X_Ads_Position_Model->getListPositionBannerJoinFront(11, "a"),
    					'listBannerSide'	=> $this->X_Ads_Position_Model->getListPositionBannerJoinFront(11, "b")
    			)
    	);
    
    	$this->load->view('front/layout', $data);
    }
    
    function ajax_filter(){
    	$this->load->model('X_Ads_Model');
    	 
    	$cat = null;
    	if($this->input->post('ads_cat', TRUE) != '')$cat = $this->input->post('ads_cat', TRUE);
    	$param = null;
    	if($this->input->post('ads_title', TRUE) != '')$param = $this->input->post('ads_title', TRUE);
    	 
    	$data = array(
    			'listAds'	=> $this->X_Ads_Model->getListAdsNoLimit(date('Y-m-d') ,$param, $cat, "AKTIF")
    	);
    	 
    	$this->load->view('front/ads/indeks-ads-list-ajax', $data);
    }
    
    function read($id){
    	$this->load->model('X_Ads_Model');
    	$this->load->library('newslogic');
    	$this->load->model('X_Ads_Position_Model');
    	
    	$obj = $this->X_Ads_Model->getAdsById($id);
    		
    	if($obj->num_rows() == 0){
    		redirect('pages/error404');
    	}
    	
    	//Set PageViews
    	if(!isset($_COOKIE["views-ads-".$obj->row()->ADS_ID])){
    		$data['PAGE_VIEW'] = $obj->row()->PAGE_VIEW+1;
    		$this->X_Ads_Model->updateAds($data, $obj->row()->ADS_ID);
    		setcookie("views-ads-".$obj->row()->ADS_ID, "true", time() + 900);
    	}
    	
    	$cat = $this->createBreadCrumbs($obj->row()->ADS_CAT);
    	
    	$data = array(
    			'pageTitle' 	=> $cat->row()->CAT_NAME.': '.$obj->row()->ADS_TITLE,
    			'content'	 	=> 'front/ads/read',
    			'meta_desc'		=> $obj->row()->META_DESC,
    			'meta_key'		=> $obj->row()->META_KEY,
    			'contentData'	=> array(
    					'breadData' => $this->breadData,
    					'ads'		=> $obj->row(),
    					'cat'		=> $cat->row(),
    					'listLatestNews'	=> $this->X_News_Model->getListNews(6, 0, "N", "A"),
    					'listPopuler'		=> $this->X_News_Model->getPopularNews(6, 0, "N", "A"),
    					'listForum'			=> $this->Phpbb_Posts_Model->getListThreads(),
    					'listBanner'		=> $this->X_Ads_Position_Model->getListPositionBannerJoinFront(12, "a"),
    					'listBannerSide'	=> $this->X_Ads_Position_Model->getListPositionBannerJoinFront(12, "b")
    			)
    	);
    	
    	$this->load->view('front/layout', $data);
    }
    
    private function createBreadCrumbs($catId){
    	$this->load->model('X_Ads_Category_Model');
    	$cat = $this->X_Ads_Category_Model->getCatById($catId);
    	
    	if($cat->row()->PARENT != null)$this->createBreadCrumbs($cat->row()->PARENT);
    	
    	$this->breadData[$this->breadLoop]['CAT_ALIAS'] = $cat->row()->CAT_ALIAS;
    	$this->breadData[$this->breadLoop]['CAT_NAME'] 	= $cat->row()->CAT_NAME;
   		
   		$this->breadLoop++;
    	
   		return $cat;
    }
}

/* End of file ads.php */
/* Location: ./application/controllers/ads.php */