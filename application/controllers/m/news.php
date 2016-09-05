<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {
	var $breadData = array();
	var $breadLoop = 0;
	
	function News(){
		parent::__construct();	
		
		//Detect Mobile Devices, if device is not a mobile ti will redirect to home
		if(!$this->agent->is_mobile()){
			redirect(substr($this->uri->uri_string(), 2));
		}else{
			if($this->session->userdata('SITE_VERSION') != "mobile"){
				$this->session->set_userdata(array('SITE_VERSION' => 'mobile'));
			}
		}
		
		$this->load->model('X_News_Category_Model');
	}

	function index(){
    	redirect('m/home');
    }
    
    function read($id){
    	$this->load->model('X_News_Model');
    	$this->load->library('newslogic');
    	$obj = $this->X_News_Model->getNewsById($id);
    		
    	if($obj->num_rows() == 0){
    		redirect('m/pages/error404');
    	}
    	
    	//Set PageViews
    	if(!isset($_COOKIE["views-".$obj->row()->NEWS_ID])){
    		$data['PAGE_VIEW'] = $obj->row()->PAGE_VIEW+1;
    	
    		$this->X_News_Model->updateNews($data, $obj->row()->NEWS_ID);
    	
    		setcookie("views-".$obj->row()->NEWS_ID, "true", time() + 900);
    	}
    	
    	//Related Content
    	$tags = explode(",", $obj->row()->TAGS);
    	$listRelated = $this->X_News_Model->getListNewsRelated(5, 0, "N", $obj->row()->DATE, $tags);
    	
    	$cat = $this->createBreadCrumbs($obj->row()->CAT);
    	
    	$data = array(
    			'pageTitle' 	=> $cat->row()->CAT_NAME.': '.$obj->row()->NEWS_TITLE,
    			'content'	 	=> 'm/news/read',
    			'meta_desc'		=> $obj->row()->META_DESC,
    			'meta_key'		=> $obj->row()->META_KEY,
    			'contentData'	=> array(
    					'breadData' => $this->breadData,
    					'news'		=> $obj->row(),
    					'cat'		=> $cat->row(),
    					'listRelated'		=> $listRelated,
    					'listLatestNews'	=> $this->newslogic->getListNewsCatRel($cat->row()->ID, null, 0, 6, 0),
    					'listPopuler'		=> $this->newslogic->getListNewsCatRel($cat->row()->ID, null, 0, 6, 0, true)
    			)
    	);
    	
    	$this->load->view('m/layout', $data);
    }
    
    function fokus($id){
    	$this->load->model('X_News_Model');
    	$obj = $this->X_News_Model->getNewsById($id);
    
    	if($obj->num_rows() == 0){
    		redirect('m/pages/error404');
    	}
    	
    	//Set PageViews
    	if(!isset($_COOKIE["views-".$obj->row()->NEWS_ID])){
    		$data['PAGE_VIEW'] = $obj->row()->PAGE_VIEW+1;
    		 
    		$this->X_News_Model->updateNews($data, $obj->row()->NEWS_ID);
    		 
    		setcookie("views-".$obj->row()->NEWS_ID, "true", time() + 900);
    	}
    	 
    	$data = array(
    			'pageTitle' 	=> 'Fokus: '.$obj->row()->NEWS_TITLE,
    			'content'	 	=> 'm/news/fokus',
    			'meta_desc'		=> $obj->row()->META_DESC,
    			'meta_key'		=> $obj->row()->META_KEY,
    			'contentData'	=> array(
    					'listLatestNews'	=> $this->X_News_Model->getListNews(6, 0, "N", "A"),
    					'listPopuler'		=> $this->X_News_Model->getPopularNews(6, 0, "N", "A"),
    					'news'		=> $obj->row()
    			)
    	);
    	 
    	$this->load->view('m/layout', $data);
    }
    
    function dialog($id){
    	$this->load->model('X_News_Model');
    	$obj = $this->X_News_Model->getNewsById($id);
    
    	if($obj->num_rows() == 0){
    		redirect('m/pages/error404');
    	}
    	 
    	//Set PageViews
    	if(!isset($_COOKIE["views-".$obj->row()->NEWS_ID])){
    		$data['PAGE_VIEW'] = $obj->row()->PAGE_VIEW+1;
    		 
    		$this->X_News_Model->updateNews($data, $obj->row()->NEWS_ID);
    		 
    		setcookie("views-".$obj->row()->NEWS_ID, "true", time() + 900);
    	}
    
    	$data = array(
    			'pageTitle' 	=> 'Wawancara: '.$obj->row()->NEWS_TITLE,
    			'content'	 	=> 'm/news/dialog',
    			'meta_desc'		=> $obj->row()->META_DESC,
    			'meta_key'		=> $obj->row()->META_KEY,
    			'contentData'	=> array(
    					'listLatestNews'	=> $this->X_News_Model->getListNews(6, 0, "N", "A"),
    					'listPopuler'		=> $this->X_News_Model->getPopularNews(6, 0, "N", "A"),
    					'news'		=> $obj->row()
    			)
    	);
    
    	$this->load->view('m/layout', $data);
    }
    
    private function createBreadCrumbs($catId){
    	$cat = $this->X_News_Category_Model->getCatById($catId);
    	
    	if($cat->row()->PARENT != null)$this->createBreadCrumbs($cat->row()->PARENT);
    	
    	$this->breadData[$this->breadLoop]['CAT_ALIAS'] = $cat->row()->CAT_ALIAS;
    	$this->breadData[$this->breadLoop]['CAT_NAME'] 	= $cat->row()->CAT_NAME;
   		
   		$this->breadLoop++;
    	
   		return $cat;
    }
}

/* End of file news.php */
/* Location: ./application/controllers/news.php */