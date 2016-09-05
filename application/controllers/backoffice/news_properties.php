<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_Properties extends CI_Controller {

	function News_Properties(){
		parent::__construct();
		
		if(!$this->session->userdata('LOGGED_IN')){
			$this->session->set_flashdata('information', 'Session Login anda telah Expire, Silahkan Login Kembali..');
			redirect('auth/users');
		}
	}

	public function index($type){
		redirect('backoffice/news_properties/cat/'.$type);
	}

	public function cat($type,$param = null){
		$this->load->model('X_News_Category_Model');
		
		if($param == 'add'){
			$data = array(
					'pageTitle' 	=> 'Tambah Kanal Berita',
					'content'	 	=> 'back/news_properties/cat-add',
					'contentData'	=> array(
							'listCat'		=> $this->X_News_Category_Model->getListCatType($type),
							'cat_type' => $type
					)
			);
			
			$this->load->view('back/layout', $data);
		}else if($param == 'edit'){
			$obj = $this->X_News_Category_Model->getCatById($this->uri->segment(6));
			
			if($obj->num_rows() == 0){
				$this->session->set_flashdata('error', 'Data tidak ditemukan.');
				redirect('backoffice/news_properties/cat');
			}
			
			$data = array(
					'pageTitle' 	=> 'Ubah Kanal Berita',
					'content'	 	=> 'back/news_properties/cat-edit',
					'contentData'	=> array(
							'cat'			=> $obj->row(),
							'listCat'		=> $this->X_News_Category_Model->getListCatType($type),
							'cat_type' => $type
					)
			);
			
			$this->load->view('back/layout', $data);
		}else if($param == 'delete'){
			$this->load->model('X_News_Model');
			$obj = $this->X_News_Category_Model->getCatById($this->uri->segment(6));
			
			if($obj->num_rows() != 0){
				if($this->X_News_Category_Model->getCatByParent($obj->row()->ID)->num_rows() == 0 && $this->X_News_Model->getNewsByCat($obj->row()->ID)->num_rows() == 0){
					if($this->X_News_Category_Model->delCat($obj->row()->ID)){
						$this->session->set_flashdata('success', 'Kanal "'.$obj->row()->CAT_NAME.'" berhasil dihapus.');
					}else{
						$this->session->set_flashdata('error', 'Terjadi kesalahan.. Silahkan ulangi lagi beberapa saat lagi.');
					}
				}else{
					$this->session->set_flashdata('error', 'Kanal "'.$obj->row()->CAT_NAME.'" tidak dapat dihapus karena sudah ada datanya<br />Hapus data berita / sub kanal terlebih dahulu untuk memulai menghapus..');
				}
			}else{
				$this->session->set_flashdata('error', 'Data tidak ditemukan.');
			}
			
			redirect('backoffice/news_properties/cat/'.$type);
		}else if($param == 'submit'){
			if($this->input->post('save') != ''){
				$id = $this->input->post('id');
				
				if($this->input->post('parent') != "" && $this->input->post('parent') == $id){
					$this->session->set_flashdata('error', 'Maaf permintaan tidak bisa diproses... Silahkan pilih kanal lain untuk menjadi parent "'.$this->input->post('cat_name').'"');
					redirect('backoffice/news_properties/cat');
				}
				
				$data = array(
						'CAT_NAME'		=> $this->input->post('cat_name'),
						'COLOR'			=> $this->input->post('color'),
						'CAT_ORDER'		=> $this->input->post('cat_order'),
						'META_DESC'		=> $this->input->post('meta_desc'),
						'META_KEYWORD'	=> $this->input->post('meta_key'),
						'TYPE'			=> $type
				);
				
				if($this->input->post('parent') != '')
					$data['PARENT']	= $this->input->post('parent');
				
				if($this->input->post('cat_alias') != $this->input->post('cat_alias_old'))
					$data['CAT_ALIAS']		= $this->_getAlias($this->input->post('cat_alias'));
				
				if($id != ''){
					$data['UPDATED_BY'] 	= $this->session->userdata('USERNAME');
					$data['UPDATED_DATE'] 	= date('Y-m-d H:i:s');
					
					$this->X_News_Category_Model->updateCat($data, $id);
				}else{
					$data['CREATED_BY'] 	= $this->session->userdata('USERNAME');
					$data['CREATED_DATE'] 	= date('Y-m-d H:i:s');
					$this->X_News_Category_Model->insertCat($data);
				}
				
				$this->session->set_flashdata('success', 'Data berhasil disimpan.');
				redirect('backoffice/news_properties/cat/'.$type);
			}
			redirect('backoffice/news_properties/cat/'.$type);
		}else{
			$data = array(
					'pageTitle' 	=> 'Kanal Berita',
					'content'	 	=> 'back/news_properties/cat-list',
					'contentData'	=> array(
							'listParent'		=> $this->X_News_Category_Model->getListCatType($type),
							'cat_type' => $type
					)
			);
			
			$this->load->view('back/layout', $data);
		}
	}
	
	private function _getAlias($string){
		$this->load->model('X_News_Category_Model');
		$newString = strtolower(preg_replace(array('/[\-]+$/', '/[\s\W]+/', '/\s[\s]+/', '/^[\-]+/', '/\&/', '/\%/', '/\@/'), '-', $string));
		
		$check = $this->X_News_Category_Model->getCatByAlias($newString);
		
		if($check->num_rows() > 0){
			return $newString.'_'.date('YmdHis');
		}else{
			return $newString;
		}
	}
}

/* End of file news_properties.php */
/* Location: ./application/controllers/backoffice/news_properties.php */