<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
	
	function Pages(){
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
    
    function detail($alias){
    	$this->load->model('X_News_Model');
    	$this->load->model('X_Pages_Model');
    	
    	$obj = $this->X_Pages_Model->getPagesByAlias($alias);
    	
    	if($obj->num_rows() == 0){
    		redirect('m/pages/error404');
    	}
    	 
    	//Set PageViews
    	if(!isset($_COOKIE["views-pages-".$obj->row()->ID])){
    		$data['PAGE_VIEW'] = $obj->row()->PAGE_VIEW+1;
    		 
    		$this->X_Pages_Model->updatePages($data, $obj->row()->ID);
    		 
    		setcookie("views-pages-".$obj->row()->ID, "true", time() + 900);
    	}
    	
    	$data = array(
    			'pageTitle' 	=> $obj->row()->TITLE,
    			'content'	 	=> 'm/pages/page-detail',
    			'meta_desc'		=> $obj->row()->META_DESC,
    			'meta_key'		=> $obj->row()->META_KEY,
    			'contentData'	=> array(
    					'listLatestNews'	=> $this->X_News_Model->getListNews(6, 0, "N", "A"),
    					'listPopuler'		=> $this->X_News_Model->getPopularNews(6, 0, "N", "A"),
    					'pages'				=> $obj->row()
    			)
    	);
    	
    	$this->load->view('m/layout', $data);
    }
    
    function error404(){
    	$this->load->view('front/pages/error404');
    }
}

/* End of file pages.php */
/* Location: ./application/controllers/m/pages.php */