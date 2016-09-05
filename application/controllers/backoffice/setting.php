<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends CI_Controller {
	
	function Setting(){
		parent::__construct();	
		if(!$this->session->userdata('LOGGED_IN'))redirect('auth/users');
	}

	public function index(){
		$this->load->model('X_Pages_Model');
		
		$data = array(
				'pageTitle' 	=> 'Pengaturan',
				'content'	 	=> 'back/setting/setting-edit',
				'contentData'	=> array(
						
				)
		);
	
		$this->load->view('back/layout', $data);
	}
	
	function submit(){
		$this->load->model('X_Setting_Model');
			
		if($this->input->post('save') != ''){
			$this->X_Setting_Model->updateSetting(array('VALUE'=>$this->input->post("1", TRUE)), 1);
			$this->X_Setting_Model->updateSetting(array('VALUE'=>$this->input->post("2", TRUE)), 2);
			$this->X_Setting_Model->updateSetting(array('VALUE'=>$this->input->post("3", TRUE)), 3);
			$this->X_Setting_Model->updateSetting(array('VALUE'=>$this->input->post("4", TRUE)), 4);
			$this->X_Setting_Model->updateSetting(array('VALUE'=>$this->input->post("5", TRUE)), 5);
			$this->X_Setting_Model->updateSetting(array('VALUE'=>$this->input->post("6", TRUE)), 6);
			$this->X_Setting_Model->updateSetting(array('VALUE'=>$this->input->post("7", TRUE)), 7);
			$this->X_Setting_Model->updateSetting(array('VALUE'=>$this->input->post("8", TRUE)), 8);
	
			$this->session->set_flashdata('success', 'Pengaturan berhasil disimpan.');
		}else $this->session->set_flashdata('error', 'Apa yang anda lakukan!!! ini dapat merusak database..!!! STOP');
		
		redirect('backoffice/setting');
	}
}

/* End of file setting.php */
/* Location: ./application/controllers/backoffice/setting.php */