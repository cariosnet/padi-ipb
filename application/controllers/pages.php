<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller {
	
	function Pages(){
		parent::__construct();
		$this->load->model('X_Pages_Model');
        $this->load->model('X_News_category_Model');
        $this->load->model('link_model');
    }

	function index(){
    	redirect('home');
    }
    
    function detail($alias){
    	$this->load->model('X_News_Model');
    	$this->load->model('X_Pages_Model');
    	$this->load->model('X_Download_Model');
    	$this->load->model('X_Ads_Position_Model');
        $this->load->model('eksternal/Phpbb_Posts_Model', 'Phpbb_Posts_Model');

        //print "dssfs"; exit;

    	$obj = $this->X_Pages_Model->getPagesByAlias($alias);
    	
    	if($obj->num_rows() == 0){
    		redirect('pages/error404');
    	}
    	 
    	//Set PageViews
//     	if(!isset($_COOKIE["views-pages-".$obj->row()->ID])){
//     		$data['PAGE_VIEW'] = $obj->row()->PAGE_VIEW+1;
    		 
//     		$this->X_Pages_Model->updatePages($data, $obj->row()->ID);
    		 
//     		setcookie("views-pages-".$obj->row()->ID, "true", time() + 900);
//     	}
    	
    	$data = array(
    			'pageTitle' 	=> $obj->row()->TITLE,
    			'content'	 	=> 'front/pages/page-detail',
    			'meta_desc'		=> $obj->row()->META_DESC,
    			'meta_key'		=> $obj->row()->META_KEY,
    			'contentData'	=> array(
    					'listLatestNews'	=> $this->X_News_Model->getListNews(6, 0, "N", "A"),
    					'listPopuler'		=> $this->X_News_Model->getPopularNews(6, 0, "N", "A"),
    					'pages'				=> $obj->row(),
    					//'listForum'			=> $this->Phpbb_Posts_Model->getListThreads(),
    					//'listBanner'		=> $this->X_Ads_Position_Model->getListPositionBannerJoinFront(10, "a"),
    					//'listBannerSide'	=> $this->X_Ads_Position_Model->getListPositionBannerJoinFront(10, "b"),

    					'listRegulasi'	=> $this->X_Download_Model->getListData(10, 0, "RE", "A"),
    					'listProduk'	=> $this->X_News_Model->getNewArtikelLimit("D")
    			)
    	);
    	
    	$this->load->view('front/layout', $data);
    }
    
    function error404(){
    	$this->load->view('front/pages/error404');
    }
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */