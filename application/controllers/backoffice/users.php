<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	
	function Users(){
		parent::__construct();		
		
		if(!$this->session->userdata('LOGGED_IN')){
			$this->session->set_flashdata('information', 'Session Login anda telah Expire, Silahkan Login Kembali..');
			redirect('auth/users');
		}
	}

	public function index(){
		$data = array(
				'pageTitle' 	=> 'Daftar Pengguna',
				'content'	 	=> 'back/users/users-list',
				'contentData'	=> array(
						
				)
		);
	
		$this->load->view('back/layout', $data);
	}
	
	public function add(){
		$data = array(
				'pageTitle' 	=> 'Tambah Pengguna',
				'content'	 	=> 'back/users/users-add',
				'contentData'	=> array(
						
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
					'BIO'		=> $this->input->post('bio'),
					'STATUS'	=> $this->input->post('status'),
					'ROLE'		=> $this->input->post('role')
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
					if($id != null){
						redirect('backoffice/users/edit/'.$id);
					}else{
						redirect('backoffice/users/add');
					}
			
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
								
							if($id != null){
								redirect('backoffice/users/edit/'.$id);
							}else{
								redirect('backoffice/users/add');
							}
						}
					}
				}
			}
		
			if($id != ''){
				$data['UPDATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['UPDATED_DATE'] 	= date('Y-m-d H:i:s');
		
				$this->X_Users_Model->updateUser($data, $id);
				
			}else{
				$data['CREATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['CREATED_DATE'] 	= date('Y-m-d H:i:s');
				$lastInsertedId = $this->X_Users_Model->insertUser($data);
				
			}
				
			$this->session->set_flashdata('success', 'Data berhasil disimpan.');
			redirect('backoffice/users');
		}
		redirect('backoffice/users/add');
	}
	
	function edit($id){
		$this->load->model('X_Users_Model');
		
		$obj = $this->X_Users_Model->getUserById($id);
			
		if($obj->num_rows() == 0){
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
			redirect('backoffice/users');
		}
			
		$data = array(
				'pageTitle' 	=> 'Ubah Pengguna',
				'content'	 	=> 'back/users/users-edit',
				'contentData'	=> array(
						'user'			=> $obj->row()
				)
		);
			
		$this->load->view('back/layout', $data);
	}
	
	function delete($id){
		$this->load->model('X_Users_Model');
		$obj = $this->X_Users_Model->getUserById($id);
			
		if($obj->num_rows() != 0){
			$filename =  $this->config->item('img_path_upload').'users/'.$obj->row()->IMAGE;
			
			if($this->X_Users_Model->delUser($obj->row()->ID)){
				if($obj->row()->IMAGE != '' && file_exists($filename))	{
					unlink($filename);
				}
				
				$this->session->set_flashdata('success', '"'.$obj->row()->USERNAME.'" berhasil dihapus.');
			}else{
				$this->session->set_flashdata('error', 'Terjadi kesalahan.. Silahkan ulangi lagi beberapa saat lagi.');
			}
		}else{
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
		}
			
		redirect('backoffice/users');
	}
	
	function ajax_users_listing() {
		$this->load->model('X_Users_Model');
		$this->load->library('datatables');
		
		// variable initialization
		$search = "";
		$start = 0;
		$rows = 10;
	
		// get search value (if any)
		if (isset($_GET['sSearch']) && $_GET['sSearch'] != "" ) {
			$search = $_GET['sSearch'];
		}
	
		// limit
		$start = $this->datatables->getOffset();
		$rows = $this->datatables->getLimit();
	
		// sort
		$sortDir = $this->datatables->getSortDir();
		$sortCol = $this->datatables->getSortCol(array("", "FULLNAME", "USERNAME", "", "", "ROLE", "", ""));
		
		// run query to get user listing
		$listNews = $this->X_Users_Model->getListUser($start, $rows, $search, $sortCol, $sortDir);
		$iTotal = $this->X_Users_Model->getListUser(0, '-1', '', '', '')->num_rows();
		
		if($search != "")$iFilteredTotal = $this->X_Users_Model->getListUser('', -1, $search, '', '')->num_rows();
		else $iFilteredTotal = $iTotal;
	
	        /*
	         * Output
	         */
	         $output = array(
	             "sEcho" => intval($_GET['sEcho']),
	             "iTotalRecords" => $iTotal,
	             "iTotalDisplayRecords" => $iFilteredTotal,
	             "aaData" => array()
	         );
	
	        // get result after running query and put it in array
	        $no = $start+1;
	        foreach ($listNews->result() as $row) {
				$record = array();
		
				$record[] = $no++;
				$record[] = "<a target='_blank' href='".site_url("backoffice/profile/".$row->USERNAME)."'>".$row->FULLNAME."</a>";
				$record[] = $row->USERNAME;
				$record[] = $row->EMAIL;
				$record[] = $row->PHONE;
				
				if($row->ROLE == '1')$role = "Super User";else if($row->ROLE == '2')$role = "Redaktur"; else $role = "Marketing";
				$record[] = $role;
				
				if($row->STATUS == 'A')$img = "true.png";else $img ="false.png";
				$record[] = "<img style='width: 20px;' alt='Status' src='".$this->config->item('ext_img').$img."' />";
				
				if($row->ID < 0){
					$actionButton = "<div class='btn-toolbar' style='margin: 0; padding: 0;'>
									<div class='btn-group'>
										<a href='".site_url('backoffice/users/edit/'.$row->ID)."' class='button button-basic button-small' rel='tooltip' title='Ubah'><i class='icon-edit'></i></a>
										<a href='javascript:void(0);' class='button button-basic button-small disabled' rel='tooltip' title='Tidak bisa dihapus'><i class='icon-trash'></i></a>
									</div>
								</div>";
				}else{
					$actionButton = "<div class='btn-toolbar' style='margin: 0; padding: 0;'>
									<div class='btn-group'>
										<a href='".site_url('backoffice/users/edit/'.$row->ID)."' class='button button-basic button-small' rel='tooltip' title='Ubah'><i class='icon-edit'></i></a>
										<a href='javascript:void(0);' class='button button-basic button-small' rel='tooltip' title='Hapus' onclick='confirmPopUp(\"deleteRow(".$row->ID.")\", \"Peringatan..\", \"Anda yakin ingin dihapus ??\", \"Ya\", \"Tidak\");'><i class='icon-trash'></i></a>
									</div>
								</div>";
				}
				
				$record[] = $actionButton;
		
				$output['aaData'][] = $record;
		}
		// format it to JSON, this output will be displayed in datatable
		echo json_encode($output);
	}
}

/* End of file users.php */
/* Location: ./application/controllers/backoffice/users.php */