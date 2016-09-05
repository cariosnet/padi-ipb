<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	function Profile(){
		parent::__construct();		
		
		if(!$this->session->userdata('LOGGED_IN')){
			$this->session->set_flashdata('information', 'Session Login anda telah Expire, Silahkan Login Kembali..');
			redirect('auth/users');
		}
	}

	public function index(){
		$this->load->model('X_Users_Model');
	
		$obj = $this->X_Users_Model->getUserByUsername($this->session->userdata('USERNAME'));
			
		if($obj->num_rows() == 0){
			$this->session->set_flashdata('error', 'Data pengguna tidak ditemukan.');
			redirect('backoffice/home');
		}
			
		$data = array(
				'pageTitle' 	=> 'Profile | '.$obj->row()->FULLNAME,
				'content'	 	=> 'back/profile/profile-detail',
				'contentData'	=> array(
						'user'			=> $obj->row()
				)
		);
			
		$this->load->view('back/layout', $data);
	}
	
	function submit(){
		$this->load->model('X_Users_Model');
			
		if($this->input->post('save') != ''){
			$id = $this->input->post('id');
			
			//Cek Username Availability
			if($this->input->post('username') != $this->input->post('username_old')){
				$user = $this->X_Users_Model->getUserByUsername($this->input->post('username'));
				if($user->num_rows() > 0 && $id != ""){
					$this->session->set_flashdata('error', "Maaf... Username \"".$user->row()->USERNAME."\" telah digunakan,..<br />Silahkan pilih username lain");
					redirect('backoffice/users/edit/'.$id);
				}else if ($user->num_rows() > 0 && $id == ""){
					$this->session->set_flashdata('error', "Maaf... Username \"".$user->row()->USERNAME."\" telah digunakan,..<br />Silahkan pilih username lain");
					redirect('backoffice/users/add');
				}
			}
				
			$data = array(
					'USERNAME'	=> $this->input->post('username'),
					'FULLNAME'	=> $this->input->post('fullname'),
					'EMAIL'		=> $this->input->post('email'),
					'PHONE'		=> $this->input->post('phone'),
					'ADDRESS'	=> $this->input->post('address'),
					'BIO'		=> $this->input->post('bio')
			);
			
			if($this->input->post('password') != ""){
				$data['PASSWORD'] = md5($this->input->post('password').'klikpositif');
			}
				
			//Upload Image
			if($_FILES['image']['name'] != ''){
				$this->load->library('upload');
				$uploadConf = array(
						'file_name' 		=> $data['USERNAME'],
						'upload_path'		=> $this->config->item('img_path_upload').'users/',
						'allowed_types'		=> $this->config->item('img_allowed_type'),
						'overwrite'			=> 'TRUE'
				);
			
				$this->upload->initialize($uploadConf);
			
				if (!$this->upload->do_upload('image')){
					$this->session->set_flashdata('error', $this->upload->display_errors());
					
					redirect('backoffice/profile');
			
				}else{
					if($id != null && $this->input->post('image_old', TRUE) != ''){
						$filename =  $this->config->item('img_path_upload').'users/'.$this->input->post('image_old', TRUE);
						if(file_exists($filename))	{
							unlink($filename);
						}
					}
			
					$upData 		= $this->upload->data();
					$data['IMAGE'] 	= $upData['file_name'];
					
					//Resize Image
					if($this->config->item('resize_enable')){
						$config['image_library'] = 'GD2';
						$config['source_image']  = $this->config->item('img_path_upload').'users/'.$upData['file_name'];
						$config['maintain_ratio'] = TRUE;
						$config['width'] = 200;
						$config['height'] = 260;
							
						$this->load->library('image_lib', $config);
							
						if (!$this->image_lib->resize()){
							$this->session->set_flashdata('error', $this->image_lib->display_errors());
								
							redirect('backoffice/profile/error');
						}
					}
				}
			}
		
			if($id != ''){
				$data['UPDATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['UPDATED_DATE'] 	= date('Y-m-d H:i:s');
		
				$this->X_Users_Model->updateUser($data, $id);
			}
				
			$this->session->set_flashdata('success', 'Data berhasil disimpan.');
			redirect('backoffice/profile');
		}
		redirect('backoffice/home');
	}
	
	function edit(){
		$id = $this->session->userdata('ID');
		
		$this->load->model('X_Users_Model');
		
		$obj = $this->X_Users_Model->getUserById($id);
			
		if($obj->num_rows() == 0){
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
			redirect('backoffice/users');
		}
			
		$data = array(
				'pageTitle' 	=> 'Ubah Profile | '.$obj->row()->FULLNAME,
				'content'	 	=> 'back/profile/profile-edit',
				'contentData'	=> array(
						'user'			=> $obj->row()
				)
		);
			
		$this->load->view('back/layout', $data);
	}
	
	function detail($username){
		$this->load->model('X_Users_Model');
	
		$obj = $this->X_Users_Model->getUserByUsername($username);
			
		if($obj->num_rows() == 0){
			$this->session->set_flashdata('error', 'Data pengguna tidak ditemukan.');
			redirect('backoffice/home');
		}
			
		$data = array(
				'pageTitle' 	=> 'Profile | '.$obj->row()->FULLNAME,
				'content'	 	=> 'back/profile/profile-detail',
				'contentData'	=> array(
						'user'			=> $obj->row()
				)
		);
			
		$this->load->view('back/layout', $data);
	}
}

/* End of file profile.php */
/* Location: ./application/controllers/backoffice/profile.php */