<?php
class MY_Controller extends CI_Controller{
	function MY_Controller(){
		parent::__construct();
		
//		if($this->agent->is_mobile()){
//			if($this->input->get('version', TRUE) == "desktop"){
//				//setcookie("site_version", "desktop", time() + 900);
//				$this->session->set_userdata(array('SITE_VERSION' => 'desktop'));
//			}else if($this->input->get('version', TRUE) == "mobile"){
//				//setcookie("site_version", "mobile", time() + 900);
//				$this->session->set_userdata(array('SITE_VERSION' => 'mobile'));
//			}
//
//			//Set Redirection
//			if($this->session->userdata('SITE_VERSION') == ""){
//				//setcookie("site_version", "mobile", time() + 900);
//				$this->session->set_userdata(array('SITE_VERSION' => 'mobile'));
//			}
//
//			if($this->session->userdata('SITE_VERSION') != "desktop"){
//				redirect("m/".$this->uri->uri_string());
//			}
//		}
		
		//Load for Global
		$this->load->model('X_News_Category_Model');
	}
}