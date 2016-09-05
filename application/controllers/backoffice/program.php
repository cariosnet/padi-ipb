<?php
class Program extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('LOGGED_IN'))redirect('auth/users');
	}
	
	public function index(){
		$this->load->model('program_model');
	
		$data = array(
				'pageTitle' 	=> 'Halaman',
				'content'	 	=> 'back/program/program-list',
				'contentData'	=> array(
						//'listPages'		=> $this->program_model->getListPages()
						'listParent'		=> $this->program_model->getListPagesByParent(NULL)
				)
		);
	
		$this->load->view('back/layout', $data);
	}
	
	public function create(){
		$this->load->model('program_model');
	
		$data = array(
				'pageTitle' 	=> 'Buat Halaman Baru',
				'content'	 	=> 'back/program/program-add',
				'contentData'	=> array(
						'listParent' => $this->program_model->getListPagesByParent(NULL, A)
				)
		);
	
		$this->load->view('back/layout', $data);
	
	}
	
	function submit(){
		$this->load->model('program_model');
			
		if($this->input->post('save') != ''){
			$id = $this->input->post('id');
	
			$data = array(
					'TITLE'			=> $this->input->post('title'),
					'CONTENT'		=> $this->input->post('content'),
					'STATUS'		=> 'A',
					'ORDER'			=> $this->input->post('order'),
					'COLOR'			=> '',
					'META_DESC'		=> $this->input->post('meta_desc'),
					'META_KEY'		=> $this->input->post('meta_key'),
					'TYPE' => $this->input->post('type'),
					'REF_URL' => $this->input->post('ref_url'),
					'PARENT' => NULL
			);

            $data['ALIAS'] = "";
			if($_FILES['news_picture']['name'] != ''){
				$this->load->library('upload');
				$uploadConf = array(
						'file_name' 		=> 'program'.'_'.$data['ALIAS'].'_'.date('YmdHis'),
						'upload_path'		=> $this->config->item('img_path_upload').'news/',
						'allowed_types'		=> $this->config->item('img_allowed_type'),
						'overwrite'			=> 'TRUE'
				);
					
				$this->upload->initialize($uploadConf);
				if(!$this->upload->do_upload('news_picture')){
					$data['IMAGE'] 	= NULL;
				}else{
					if($id != null && $this->input->post('news_picture_old', TRUE) != ''){
						$filename =  $this->config->item('img_path_upload').'news/'.$this->input->post('news_picture_old', TRUE);
						if(file_exists($filename))	{
							unlink($filename);
						}
					}
						
					$upData 				= $this->upload->data();
					$data['IMAGE'] 	= $upData['file_name'];
				}
			}
			
			if($this->input->post('alias') != $this->input->post('alias_old'))
				$data['ALIAS']		= $this->_getAlias($this->input->post('alias'));
			else
				$data['ALIAS'] = $this->input->post('alias_old');
	
			if($id != ''){
				$data['UPDATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['UPDATED_DATE'] 	= date('Y-m-d H:i:s');
	
				$this->program_model->updatePages($data, $id, $this->input->post('order_old'));
			}else{
				$data['CREATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['CREATED_DATE'] 	= date('Y-m-d H:i:s');
				$lastInsertedId = $this->program_model->insertPages($data);
			}
	
			$this->session->set_flashdata('success', 'Data berhasil disimpan.');
			redirect('backoffice/program');
		}
		redirect('backoffice/program/create');
	}
	
	function edit($id){
		$this->load->model('program_model');
	
		$obj = $this->program_model->getPagesById($id);
			
		if($obj->num_rows() == 0){
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
			redirect('backoffice/program');
		}
			
		$data = array(
				'pageTitle' 	=> 'Ubah Halaman '.$obj->row()->TITLE,
				'content'	 	=> 'back/program/program-edit',
				'contentData'	=> array(
						'program'			=> $obj->row(),
						'listParent'		=> $this->program_model->getListPagesByParent(NULL, 'A')
				)
		);
			
		$this->load->view('back/layout', $data);
	}
	
	function delete($id){
		$this->load->model('program_model');
		$obj = $this->program_model->getPagesById($id);
			
		if($obj->num_rows() != 0){
			if($this->program_model->delPages($obj->row()->ID)){
				$this->session->set_flashdata('success', 'Halaman "'.$obj->row()->TITLE.'" berhasil dihapus.');
			}else{
				$this->session->set_flashdata('error', 'Terjadi kesalahan.. Silahkan ulangi lagi beberapa saat lagi.');
			}
		}else{
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
		}
			
		redirect('backoffice/program');
	}
	
	private function _getAlias($string){
		$this->load->model('program_model');
		$newString = strtolower(preg_replace(array('/[\-]+$/', '/[\s\W]+/', '/\s[\s]+/', '/^[\-]+/', '/\&/', '/\%/', '/\@/'), '-', $string));
	
		$check = $this->program_model->getPagesByAlias($newString);
	
		if($check->num_rows() > 0){
			return $newString.'_'.date('YmdHis');
		}else{
			return $newString;
		}
	}
	
}