<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function Home(){
		parent::__construct();	
		
		//Detect Mobile Devices, if device is not a mobile it will be redirect to home
		if(!$this->agent->is_mobile()){
			redirect('home');
		}else{
			if($this->session->userdata('SITE_VERSION') != "mobile"){
				$this->session->set_userdata(array('SITE_VERSION' => 'mobile'));
			}
		}
	}

	function index(){
		$this->load->model('X_News_Model');
		$this->load->library('newslogic');
		
		$data = array(
				'pageTitle' 	=> 'KlikPositif | Home',
				'content'	 	=> 'm/home/home',
				'contentData'	=> array(
						'listHeadline'		=> $this->X_News_Model->getListNews(1, 0, "N", "A", 1),
						'listParent'		=> $this->X_News_Category_Model->getListCat(),
						'listLatestNews'	=> $this->X_News_Model->getListNews(13, 0, "N", "A"),
						'listFokus'			=> $this->X_News_Model->getListNews(2, 0, "F", "A"),
						'listDialog'		=> $this->X_News_Model->getListNews(1, 0, "D", "A")
				)
		);
		 
		$this->load->view('m/layout', $data);
    }
    
    function test(){
    	echo 'bisa bro';
    }
}

/* End of file home.php */
/* Location: ./application/controllers/m/home.php */