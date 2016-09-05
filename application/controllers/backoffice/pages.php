<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
	
	function Pages(){
		parent::__construct();	
		if(!$this->session->userdata('LOGGED_IN'))redirect('auth/users');
	}

	public function index(){
		$this->load->model('X_Pages_Model');
		
		$data = array(
				'pageTitle' 	=> 'Halaman',
				'content'	 	=> 'back/pages/pages-list',
				'contentData'	=> array(
						//'listPages'		=> $this->X_Pages_Model->getListPages()
						'listParent'		=> $this->X_Pages_Model->getListPagesByParent(NULL)
				)
		);
	
		$this->load->view('back/layout', $data);
	}
	
	public function create(){
		$this->load->model('X_Pages_Model');
		
		$data = array(
				'pageTitle' 	=> 'Buat Halaman Baru',
				'content'	 	=> 'back/pages/pages-add',
				'contentData'	=> array(
						'listParent' => $this->X_Pages_Model->getListPagesByParent(NULL, A)
				)
		);
	
		$this->load->view('back/layout', $data);
	
	}
	
	function submit(){
		$this->load->model('X_Pages_Model');
			
		if($this->input->post('save') != ''){
			$id = $this->input->post('id');
	
			$data = array(
					'TITLE'			=> $this->input->post('title'),
					'CONTENT'		=> $this->input->post('content'),
					'STATUS'		=> 'A',
					'ORDER'			=> $this->input->post('order'),
					'COLOR'			=> $this->input->post('color'),
					'META_DESC'		=> $this->input->post('meta_desc'),
					'META_KEY'		=> $this->input->post('meta_key'),
					'TYPE' => $this->input->post('type'),
					'REF_URL' => $this->input->post('ref_url')
			);
			
			if($this->input->post('parent') != "")
				$data['PARENT'] = $this->input->post('parent');
			else
				$data['PARENT'] = NULL;
			
			if($this->input->post('alias') != $this->input->post('alias_old'))
				$data['ALIAS']		= $this->_getAlias($this->input->post('alias'));
			else
				$data['ALIAS'] = $this->input->post('alias_old');
	
			if($id != ''){
				$data['UPDATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['UPDATED_DATE'] 	= date('Y-m-d H:i:s');
	
				$this->X_Pages_Model->updatePages($data, $id, $this->input->post('order_old'));
			}else{
				$data['CREATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['CREATED_DATE'] 	= date('Y-m-d H:i:s');
				$lastInsertedId = $this->X_Pages_Model->insertPages($data);
			}
	
			$this->session->set_flashdata('success', 'Data berhasil disimpan.');
			redirect('backoffice/pages');
		}
		redirect('backoffice/pages/create');
	}
	
	function edit($id){
		$this->load->model('X_Pages_Model');
	
		$obj = $this->X_Pages_Model->getPagesById($id);
			
		if($obj->num_rows() == 0){
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
			redirect('backoffice/pages');
		}
			
		$data = array(
				'pageTitle' 	=> 'Ubah Halaman '.$obj->row()->TITLE,
				'content'	 	=> 'back/pages/pages-edit',
				'contentData'	=> array(
						'pages'			=> $obj->row(),
						'listParent'		=> $this->X_Pages_Model->getListPagesByParent(NULL, 'A')
				)
		);
			
		$this->load->view('back/layout', $data);
	}
	
	function delete($id){
		$this->load->model('X_Pages_Model');
		$obj = $this->X_Pages_Model->getPagesById($id);
			
		if($obj->num_rows() != 0){
			if($this->X_Pages_Model->delPages($obj->row()->ID)){
				$this->session->set_flashdata('success', 'Halaman "'.$obj->row()->TITLE.'" berhasil dihapus.');
			}else{
				$this->session->set_flashdata('error', 'Terjadi kesalahan.. Silahkan ulangi lagi beberapa saat lagi.');
			}
		}else{
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
		}
			
		redirect('backoffice/pages');
	}
	
	private function _getAlias($string){
		$this->load->model('X_Pages_Model');
		$newString = strtolower(preg_replace(array('/[\-]+$/', '/[\s\W]+/', '/\s[\s]+/', '/^[\-]+/', '/\&/', '/\%/', '/\@/'), '-', $string));
	
		$check = $this->X_Pages_Model->getPagesByAlias($newString);
	
		if($check->num_rows() > 0){
			return $newString.'_'.date('YmdHis');
		}else{
			return $newString;
		}
	}
}

/* End of file pages.php */
/* Location: ./application/controllers/backoffice/pages.php */