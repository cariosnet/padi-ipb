<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	
	function Users(){
		parent::__construct();		
	}

	public function index(){
		redirect('auth/users/login');
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect('auth/users/login');
	}
	
	function login(){
		if($this->session->userdata('LOGGED_IN')){
			redirect('backoffice');
		}
		
		$alert = 0;
		if($this->input->post('login') != ''){
			$this->load->model('X_Users_Model');
			
			$userData = $this->X_Users_Model->doLogin($this->input->post('username', TRUE), $this->input->post('password', TRUE));
			
			if($userData->num_rows() > 0 && $userData->row()->STATUS == "A"){
				$newdata = array(
						'ID'				=> $userData->row()->ID,
						'USERNAME'  		=> $userData->row()->USERNAME,
						'FULLNAME' 			=> $userData->row()->FULLNAME,
						'LOGGED_IN' 		=> TRUE,
						'ROLE'				=> $userData->row()->ROLE
				);
				
				$this->session->set_userdata($newdata);
				
				if($newdata['ROLE'] == 1 || $newdata['ROLE'] == 2 || $newdata['ROLE'] == 3){
					redirect('backoffice');
				}else{
					redirect('home');
				}
				
			}else if($userData->num_rows() > 0 && $userData->row()->STATUS == "N"){
				$alert = 2;
			}else{
				$alert = 1;
			}
		}		
		
		$data = array(
				'title'		=> $this->bogcamp->getSetting(1).' | Account',
				'alert'		=> $alert
		);
	
		$this->load->view('auth/login', $data);
	}
}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */