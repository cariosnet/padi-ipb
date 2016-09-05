<?php
class Link extends CI_Controller{
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('LOGGED_IN')){
			$this->session->set_flashdata('information', 'Session Login anda telah Expire, Silahkan Login Kembali..');
			redirect('auth/users');
		}
		$this->load->model('link_model');
	}
	
	public function index(){
	
		$data = array(
				'pageTitle' 	=> 'Link',
				'content'	 	=> 'back/link/link_list',
				'contentData'	=> array(
					'links' => $this->link_model->getAll()
				)
		);
	
		$this->load->view('back/layout', $data);
	}
	
	public function create(){
		$data = array(
				'pageTitle' 	=> 'Link',
				'content'	 	=> 'back/link/link_add',
				'contentData'	=> array(
					'listCat' => $this->link_model->getAllCategory()
				)
		);
	
		$this->load->view('back/layout', $data);
	}
	
	public function edit($id){
		$data = array(
				'pageTitle' 	=> 'Link',
				'content'	 	=> 'back/link/link_edit',
				'contentData'	=> array(
						'listCat' => $this->link_model->getAllCategory(),
						'link' => $this->link_model->getLinkById($id)
				)
		);
	
		$this->load->view('back/layout', $data);
	}
	
	public function delete($id){
		$this->link_model->deleteLink($id);
		$this->session->set_flashdata('success', 'Hapus data berhasil.');
		redirect('backoffice/link');
	}
	
	public function submit(){
		$dataInsert = array(
			'nama' => $this->input->post('nama'),
			'deskripsi' => $this->input->post('deskripsi'),
			'ref_url' => $this->input->post('ref_url'),
			'link_kategori' => $this->input->post('link_kategori'),
			'created_by' => $this->session->userdata('USERNAME'),
			'created_at' => date('Y-m-d H:i:s')
		);
		
		if($this->input->post('id')){
			$this->link_model->update($this->input->post('id'), $dataInsert);
		}else{
			$this->link_model->save($dataInsert);
		}
		$this->session->set_flashdata('success', 'Data berhasil disimpan.');
		redirect('backoffice/link');
	}
	
	public function kategori(){
	
		$data = array(
				'pageTitle' 	=> 'Link',
				'content'	 	=> 'back/link/kategori_list',
				'contentData'	=> array(
						'links' => $this->link_model->getAllCategory()
				)
		);
	
		$this->load->view('back/layout', $data);
	}
	
	public function kategori_create(){
		$data = array(
				'pageTitle' 	=> 'Link',
				'content'	 	=> 'back/link/kategori_add',
				'contentData'	=> array(
						
				)
		);
	
		$this->load->view('back/layout', $data);
	}
	
	public function kategori_edit($id){
		$data = array(
				'pageTitle' 	=> 'Link',
				'content'	 	=> 'back/link/kategori_edit',
				'contentData'	=> array(
						'link' => $this->link_model->getKategoriById($id)
				)
		);
	
		$this->load->view('back/layout', $data);
	}
	
	public function kategori_delete($id){
		$this->link_model->deleteKategori($id);
		$this->session->set_flashdata('success', 'Hapus data berhasil.');
		redirect('backoffice/link/kategori');
	}
	
	public function kategori_submit(){
		$dataInsert = array(
				'nama_kategori' => $this->input->post('nama_kategori'),
				'deskripsi' => $this->input->post('deskripsi'),
				'created_by' => $this->session->userdata('USERNAME'),
				'created_at' => date('Y-m-d H:i:s')
		);
	
		if($this->input->post('id')){
			$this->link_model->updateKategori($this->input->post('id'), $dataInsert);
		}else{
			$this->link_model->saveKategori($dataInsert);
		}
		$this->session->set_flashdata('success', 'Data berhasil disimpan.');
		redirect('backoffice/link/kategori');
	}	
}