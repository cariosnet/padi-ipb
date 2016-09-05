<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ads_Properties extends CI_Controller {

	function Ads_Properties(){
		parent::__construct();
		
		if(!$this->session->userdata('LOGGED_IN')){
			$this->session->set_flashdata('information', 'Session Login anda telah Expire, Silahkan Login Kembali..');
			redirect('auth/users');
		}
	}

	public function index(){
		redirect('backoffice/ads_properties/cat');
	}

	public function cat($param = null){
		$this->load->model('X_Ads_Category_Model');
		
		if($param == 'add'){
			$data = array(
					'pageTitle' 	=> 'Tambah Kategori Iklan',
					'content'	 	=> 'back/ads/cat-add',
					'contentData'	=> array(
							'listCat'		=> $this->X_Ads_Category_Model->getListCat()
					)
			);
			
			$this->load->view('back/layout', $data);
		}else if($param == 'edit'){
			$obj = $this->X_Ads_Category_Model->getCatById($this->uri->segment(5));
			
			if($obj->num_rows() == 0){
				$this->session->set_flashdata('error', 'Data tidak ditemukan.');
				redirect('backoffice/ads_properties/cat');
			}
			
			$data = array(
					'pageTitle' 	=> 'Ubah Kategori Iklan',
					'content'	 	=> 'back/ads/cat-edit',
					'contentData'	=> array(
							'cat'			=> $obj->row(),
							'listCat'		=> $this->X_Ads_Category_Model->getListCat()
					)
			);
			
			$this->load->view('back/layout', $data);
		}else if($param == 'delete'){
			$this->load->model('X_Ads_Model');
			$obj = $this->X_Ads_Category_Model->getCatById($this->uri->segment(5));
			
			if($obj->num_rows() != 0){
				if($this->X_Ads_Category_Model->getCatByParent($obj->row()->ID)->num_rows() == 0 && $this->X_Ads_Model->getAdsByCat($obj->row()->ID)->num_rows() == 0){
					if($this->X_Ads_Category_Model->delCat($obj->row()->ID)){
						$this->session->set_flashdata('success', 'Kategori "'.$obj->row()->CAT_NAME.'" berhasil dihapus.');
					}else{
						$this->session->set_flashdata('error', 'Terjadi kesalahan.. Silahkan ulangi lagi beberapa saat lagi.');
					}
				}else{
					$this->session->set_flashdata('error', 'Kategori "'.$obj->row()->CAT_NAME.'" tidak dapat dihapus karena sudah ada datanya<br />Hapus data berita / sub kanal terlebih dahulu untuk memulai menghapus..');
				}
			}else{
				$this->session->set_flashdata('error', 'Data tidak ditemukan.');
			}
			
			redirect('backoffice/news_properties/cat');
		}else if($param == 'submit'){
			if($this->input->post('save') != ''){
				$id = $this->input->post('id');
				
				if($this->input->post('parent') != "" && $this->input->post('parent') == $id){
					$this->session->set_flashdata('error', 'Maaf permintaan tidak bisa diproses... Silahkan pilih kategori lain untuk menjadi parent "'.$this->input->post('cat_name').'"');
					redirect('backoffice/ads_properties/cat');
				}
				
				$data = array(
						'CAT_NAME'		=> $this->input->post('cat_name'),
						'CAT_ORDER'		=> $this->input->post('cat_order'),
						'META_DESC'		=> $this->input->post('meta_desc'),
						'META_KEYWORD'	=> $this->input->post('meta_key')
				);
				
				if($this->input->post('parent') != '')
					$data['PARENT']	= $this->input->post('parent');
				
				if($this->input->post('cat_alias') != $this->input->post('cat_alias_old'))
					$data['CAT_ALIAS']		= $this->_getAlias($this->input->post('cat_alias'));
				
				if($id != ''){
					$data['UPDATED_BY'] 	= $this->session->userdata('USERNAME');
					$data['UPDATED_DATE'] 	= date('Y-m-d H:i:s');
					
					$this->X_Ads_Category_Model->updateCat($data, $id);
				}else{
					$data['CREATED_BY'] 	= $this->session->userdata('USERNAME');
					$data['CREATED_DATE'] 	= date('Y-m-d H:i:s');
					$this->X_Ads_Category_Model->insertCat($data);
				}
				
				$this->session->set_flashdata('success', 'Data berhasil disimpan.');
				redirect('backoffice/ads_properties/cat');
			}
			redirect('backoffice/ads_properties/cat');
		}else{
			$data = array(
					'pageTitle' 	=> 'Kategori Iklan',
					'content'	 	=> 'back/ads/cat-list',
					'contentData'	=> array(
							'listParent'		=> $this->X_Ads_Category_Model->getListCat()
					)
			);
			
			$this->load->view('back/layout', $data);
		}
	}
	
	private function _getAlias($string){
		$this->load->model('X_Ads_Category_Model');
		$newString = strtolower(preg_replace(array('/[\-]+$/', '/[\s\W]+/', '/\s[\s]+/', '/^[\-]+/', '/\&/', '/\%/', '/\@/'), '-', $string));
		
		$check = $this->X_Ads_Category_Model->getCatByAlias($newString);
		
		if($check->num_rows() > 0){
			return $newString.'_'.date('YmdHis');
		}else{
			return $newString;
		}
	}
}

/* End of file ads_properties.php */
/* Location: ./application/controllers/backoffice/ads_properties.php */