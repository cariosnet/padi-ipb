<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {
	
	function Search(){
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
    	$this->load->model('X_News_Model');
    	 
    	$data = array(
    			'pageTitle' 	=> 'Pencarian Berita',
    			'content'	 	=> 'm/indeks/search',
    			'meta_desc'		=> 'Pencarian berita KlikPositif',
    			'meta_key'		=> 'Pencarian, berita, klikpositif, google',
    			'contentData'	=> array(
    					'listLatestNews'	=> $this->X_News_Model->getListNews(6, 0, "N", "A"),
    					'listPopuler'		=> $this->X_News_Model->getPopularNews(6, 0, "N", "A")
    			)
    	);
    	 
    	$this->load->view('m/layout', $data);
    }
}

/* End of file search.php */
/* Location: ./application/controllers/m/search.php */