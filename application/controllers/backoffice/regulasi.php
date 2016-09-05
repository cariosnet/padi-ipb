<?php
class Regulasi extends CI_Controller{
	public function __construct(){
		parent::__construct();
		
		if(!$this->session->userdata('LOGGED_IN')){
			$this->session->set_flashdata('information', 'Session Login anda telah Expire, Silahkan Login Kembali..');
			redirect('auth/users');
		}
	}
	
	public function index(){
		$this->load->model('X_Download_Model');
	
		$data = array(
				'pageTitle' 	=> 'Regulasi',
				'content'	 	=> 'back/regulasi/regulasi-list',
				'contentData'	=> array(
						'listData'		=> $this->X_Download_Model->getListDataNoLimit("RE")
				)
		);
	
		$this->load->view('back/layout', $data);
	}
	
	public function create(){
		$this->load->model('X_News_Category_Model');
		$data = array(
				'pageTitle' 	=> 'Buat Regulasi Baru',
				'content'	 	=> 'back/regulasi/regulasi-add',
				'contentData'	=> array(
						'listCat'		=> $this->X_News_Category_Model->getListCatTypeAll(7)
				)
		);
	
		$this->load->view('back/layout', $data);
	
	}
	
	function submit(){
		$this->load->model('X_Download_Model');
			
		if($this->input->post('save') != ''){
			$id = $this->input->post('id');
	
			$data = array(
					'TITLE'		=> $this->input->post('title'),
					'DESC'		=> $this->input->post('desc'),
					'STATUS'	=> $this->input->post('status'),
					'TYPE'		=> "RE",
					'TAHUN'		=> $this->input->post('tahun'),
					'NOMOR'		=> $this->input->post('nomor'),
					'KATEGORI'	=> $this->input->post('kategori')
			);
				
			if($this->input->post('alias') != $this->input->post('alias_old'))
				$data['ALIAS']		= $this->_getAlias($this->input->post('alias'));
			else
				$data['ALIAS'] = $this->input->post('alias_old');
	
			//Upload File
			if($_FILES['file']['name'] != ''){
				$this->load->library('upload');
				$uploadConf = array(
						'file_name' 		=> "RE_".$data['ALIAS'].'_'.date('YmdHis'),
						'upload_path'		=> $this->config->item('file_path_upload'),
						'allowed_types'		=> $this->config->item('file_allowed_type'),
						'overwrite'			=> 'TRUE'
				);
					
				$this->upload->initialize($uploadConf);
					
				if (!$this->upload->do_upload('file')){
					$this->session->set_flashdata('error', $this->upload->display_errors());
					if($id != null){
						redirect('backoffice/regulasi/edit/'.$id);
					}else{
						redirect('backoffice/regulasi/create');
					}
						
				}else{
					if($id != null && $this->input->post('file_old', TRUE) != ''){
						$filename =  $this->config->item('file_path_upload').$this->input->post('file_old', TRUE);
						if(file_exists($filename))	{
							unlink($filename);
						}
					}
						
					$upData 				= $this->upload->data();
					$data['FILE'] 	= $upData['file_name'];
				}
			}
	
			if($id != ''){
				$data['UPDATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['UPDATED_DATE'] 	= date('Y-m-d H:i:s');
	
				$this->X_Download_Model->updateData($data, $id);
	
				if($_FILES['file']['name'] != ''){
					redirect('backoffice/regulasi');
				}
			}else{
				$data['CREATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['CREATED_DATE'] 	= date('Y-m-d H:i:s');
				$lastInsertedId = $this->X_Download_Model->insertData($data);
	
				if($_FILES['file']['name'] != ''){
					redirect('backoffice/regulasi');
				}
			}
	
			$this->session->set_flashdata('success', 'Data berhasil disimpan.');
			redirect('backoffice/regulasi');
		}
		redirect('backoffice/regulasi/create');
	}
	
	function edit($id){
		$this->load->model('X_News_Category_Model');
		$this->load->model('X_Download_Model');
	
		$obj = $this->X_Download_Model->getDataById($id);
			
		if($obj->num_rows() == 0){
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
			redirect('backoffice/regulasi');
		}
			
		$data = array(
				'pageTitle' 	=> 'Ubah Regulasi',
				'content'	 	=> 'back/regulasi/regulasi-edit',
				'contentData'	=> array(
						'row'			=> $obj->row(),
						'listCat'		=> $this->X_News_Category_Model->getListCatTypeAll(7)
				)
		);
			
		$this->load->view('back/layout', $data);
	}
	
	function delete($id){
		$this->load->model('X_Download_Model');
		$obj = $this->X_Download_Model->getDataById($id);
			
		if($obj->num_rows() != 0){
			$filename =  $this->config->item('file_path_upload').$obj->row()->FILE;
				
			if($this->X_Download_Model->delData($obj->row()->ID)){
				if($obj->row()->FILE != "" && file_exists($filename))	{
					unlink($filename);
				}
	
				$this->session->set_flashdata('success', 'Data "'.$obj->row()->TITLE.'" berhasil dihapus.');
			}else{
				$this->session->set_flashdata('error', 'Terjadi kesalahan.. Silahkan ulangi lagi beberapa saat lagi.');
			}
		}else{
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
		}
			
		redirect('backoffice/regulasi');
	}
	
	private function _getAlias($string){
		$this->load->model('X_Download_Model');
		$newString = strtolower(preg_replace(array('/[\-]+$/', '/[\s\W]+/', '/\s[\s]+/', '/^[\-]+/', '/\&/', '/\%/', '/\@/'), '-', $string));
	
		$check = $this->X_Download_Model->getDataByAlias($newString);
	
		if($check->num_rows() > 0){
			return $newString.'_'.date('YmdHis');
		}else{
			return $newString;
		}
	}
}