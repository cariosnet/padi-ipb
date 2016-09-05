<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function Home(){
		parent::__construct();	
		
		if(!$this->session->userdata('LOGGED_IN'))redirect('auth/users');
	}

	public function index(){
		$data = array(
				'pageTitle' 	=> 'Dashboard',
				'content'	 	=> 'back/home/home',
				'contentData'	=> array(
						'test'		=> 'Rian'
				)
		);
	
		$this->load->view('back/layout', $data);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/backoffice/home.php */