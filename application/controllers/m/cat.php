<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cat extends CI_Controller {
	var $breadData = array();
	var $breadLoop = 0;
	
	function Cat(){
		parent::__construct();	
		
		//Detect Mobile Devices, if device is not a mobile ti will redirect to home
		if(!$this->agent->is_mobile()){
			redirect(substr($this->uri->uri_string(), 2));
		}else{
			if($this->session->userdata('SITE_VERSION') != "mobile"){
				$this->session->set_userdata(array('SITE_VERSION' => 'mobile'));
			}
		}
	}

	function index(){
    	redirect('m/home');
    }
    
    function detail($param = null){
    	$this->load->library('newslogic');
    	$this->load->library('bogcamp');
    	
    	$catObj = $this->X_News_Category_Model->getCatByAlias($param);
    	if($catObj->num_rows() == 0)redirect('home');
    	
    	$this->createBreadCrumbs($catObj->row()->ID);
    	
    	$data = array(
    			'pageTitle' 	=> 'Kanal | '.$catObj->row()->CAT_NAME,
    			'content'	 	=> 'm/cat/cat-detail',
    			'meta_desc'		=> $catObj->row()->META_DESC,
    			'meta_key'		=> $catObj->row()->META_KEYWORD,
    			'contentData'	=> array(
    					'catObj'			=> $catObj,
    					'breadData' 		=> $this->breadData,
    					'listHeadline'		=> $this->newslogic->getListNewsCatRel($catObj->row()->ID, 1, 0, 2, 0),
    					'listLatest'		=> $this->newslogic->getListNewsCatRel($catObj->row()->ID, null, 0, 10, 0),
    					'listPilihan'		=> $this->newslogic->getListNewsCatRel($catObj->row()->ID, null, 1, 5, 0),
    					'listSubKanal'		=> $this->X_News_Category_Model->getListCat($catObj->row()->ID)
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

/* End of file cat.php */
/* Location: ./application/controllers/m/cat.php */