<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dialog extends CI_Controller {
	
	function Dialog(){
		parent::__construct();	

		if(!$this->session->userdata('LOGGED_IN')){
			$this->session->set_flashdata('information', 'Session Login anda telah Expire, Silahkan Login Kembali..');
			redirect('auth/users');
		}
	}

	public function index(){
		$this->load->model('X_News_Model');
		
		$data = array(
				'pageTitle' 	=> 'Wawancara',
				'content'	 	=> 'back/dialog/dialog-list',
				'contentData'	=> array(
						'listNews'		=> $this->X_News_Model->getListNewsNoLimit("D", "A")
				)
		);
	
		$this->load->view('back/layout', $data);
	}
	
	public function create(){
		$data = array(
				'pageTitle' 	=> 'Buat Dialog Baru',
				'content'	 	=> 'back/dialog/dialog-add',
				'contentData'	=> array(
						
				)
		);
				
		$this->load->view('back/layout', $data);
		
	}
	
	function submit(){
		$this->load->model('X_News_Model');
			
		if($this->input->post('save') != ''){
			$id = $this->input->post('id');
				
			$data = array(
					'NEWS_TITLE'			=> $this->input->post('news_title'),
					'NEWS_SUBTITLE'			=> $this->input->post('news_subtitle'),
					'NEWS_CONTENT'			=> $this->input->post('news_content'),
					'NEWS_PICTURE_CAPTION'	=> $this->input->post('news_picture_caption'),
					'NEWS_PICTURE_SOURCE'	=> $this->input->post('news_picture_source'),
					'WRITER'				=> $this->input->post('writer'),
					'EDITOR'				=> $this->input->post('editor'),
					'STATUS'				=> $this->input->post('status'),
					'IS_HEADLINE'			=> $this->input->post('is_headline'),
					'IS_PILIHAN'			=> $this->input->post('is_pilihan'),
					'DATE'					=> date('Y-m-d H:i:s'),
					'TYPE'					=> "D",
					'META_TITLE'			=> $this->input->post('news_title'),
					'META_DESC'				=> $this->input->post('meta_desc'),
					'META_KEY'				=> $this->input->post('meta_key')
			);
			
			if($this->input->post('alias') != $this->input->post('alias_old'))
				$data['ALIAS']		= $this->_getAlias($this->input->post('alias'));
			else
				$data['ALIAS'] = $this->input->post('alias_old');
				
			//Upload Image
			if($_FILES['news_picture']['name'] != ''){
				$this->load->library('upload');
				$uploadConf = array(
						'file_name' 		=> $data['ALIAS'].'_'.date('YmdHis'),
						'upload_path'		=> $this->config->item('img_path_upload').'news/',
						'allowed_types'		=> $this->config->item('img_allowed_type'),
						'overwrite'			=> 'TRUE'
				);
			
				$this->upload->initialize($uploadConf);
			
				if (!$this->upload->do_upload('news_picture')){
					$this->session->set_flashdata('error', $this->upload->display_errors());
					if($id != null){
						redirect('backoffice/dialog/edit/'.$id);
					}else{
						redirect('backoffice/dialog/create');
					}
			
				}else{
					if($id != null && $this->input->post('news_picture_old', TRUE) != ''){
						$filename =  $this->config->item('img_path_upload').'news/'.$this->input->post('news_picture_old', TRUE);
						if(file_exists($filename))	{
							unlink($filename);
						}
					}
			
					$upData 				= $this->upload->data();
					$data['NEWS_PICTURE'] 	= $upData['file_name'];
					
					//Resize Image
					if($this->config->item('resize_enable')){
						$config['image_library'] = 'GD2';
						$config['source_image']  = $this->config->item('img_path_upload').'news/'.$upData['file_name'];
						$config['maintain_ratio'] = TRUE;
						$config['width'] = 700;
						$config['height'] = 400;
							
						$this->load->library('image_lib', $config);
							
						if (!$this->image_lib->resize()){
							$this->session->set_flashdata('error', $this->image_lib->display_errors());
								
							if($id != null){
								redirect('backoffice/dialog/edit/'.$id);
							}else{
								redirect('backoffice/dialog/create');
							}
						}
					}
				}
			}
		
			if($id != ''){
				$data['UPDATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['UPDATED_DATE'] 	= date('Y-m-d H:i:s');
		
				$this->X_News_Model->updateNews($data, $id);
				
				if($_FILES['news_picture']['name'] != ''){
					redirect('backoffice/dialog/croping/'.$id);
				}
			}else{
				$data['CREATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['CREATED_DATE'] 	= date('Y-m-d H:i:s');
				$lastInsertedId = $this->X_News_Model->insertNews($data);
				
				if($_FILES['news_picture']['name'] != ''){
					redirect('backoffice/dialog/croping/'.$lastInsertedId);
				}
			}
				
			$this->session->set_flashdata('success', 'Data berhasil disimpan.');
			redirect('backoffice/dialog');
		}
		redirect('backoffice/dialog/create');
	}
	
	public function croping($id){
		if($this->input->post('save', TRUE) != null || $this->input->post('cropUnLoad', TRUE) != null){
			$this->load->library('image_lib');
				
			//Set Crop
			$config['image_library'] = 'gd2';
			$config['source_image']  = $this->config->item('img_path_upload').'news/'.$this->input->post('img', TRUE);
			$config['maintain_ratio'] = FALSE;
			$config['height'] = $this->input->post('h', TRUE);
			$config['width'] = $this->input->post('w', TRUE);
			$config['x_axis'] = $this->input->post('x', TRUE);
			$config['y_axis'] = $this->input->post('y', TRUE);
	
			$this->image_lib->initialize($config);
	
			if (!$this->image_lib->crop()){
				$this->session->set_flashdata('error', $this->image_lib->display_errors());
				redirect('backoffice/dialog/croping/'.$id);
			}
				
			//Resize
			$config2['image_library'] = 'gd2';
			$config2['source_image']  = $this->config->item('img_path_upload').'news/'.$this->input->post('img', TRUE);
			$config2['maintain_ratio'] = FALSE;
			$config2['height'] = 350;
			$config2['width'] = 650;
				
			$this->image_lib->initialize($config2);
				
			if (!$this->image_lib->resize()){
				$this->session->set_flashdata('error', $this->image_lib->display_errors());
				redirect('backoffice/dialog/croping/'.$id);
			}else{
				$this->session->set_flashdata('success', 'Simpan Berita dan Crop photo berhasil');
				redirect('backoffice/dialog');
			}
		}
	
		$this->load->model('X_News_Model');
		$obj 	= $this->X_News_Model->getNewsById($id);
		if($obj->num_rows() < 1 || $obj->row()->NEWS_PICTURE == ''){
			$this->session->set_flashdata('error', 'Gambar pada berita tidak ditemukan.');
			redirect('backoffice/dialog');
		}
	
		$data = array(
				'pageTitle' 	=> 'Crop Photo',
				'content'	 	=> 'back/dialog/dialog-croping',
				'contentData'	=> array(
						'row'		=> $obj->row()
				)
		);
		$this->load->view('back/layout', $data);
	}
	
	function edit($id){
		$this->load->model('X_News_Model');
		
		$obj = $this->X_News_Model->getNewsById($id);
			
		if($obj->num_rows() == 0){
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
			redirect('backoffice/dialog');
		}
			
		$data = array(
				'pageTitle' 	=> 'Ubah dialog',
				'content'	 	=> 'back/dialog/dialog-edit',
				'contentData'	=> array(
						'news'			=> $obj->row(),
						
				)
		);
			
		$this->load->view('back/layout', $data);
	}
	
	function delete($id){
		$this->load->model('X_News_Model');
		$obj = $this->X_News_Model->getNewsById($id);
			
		if($obj->num_rows() != 0){
			$filename =  $this->config->item('img_path_upload').'news/'.$obj->row()->NEWS_PICTURE;
			
			if($this->X_News_Model->delNews($obj->row()->NEWS_ID)){
				if($obj->row()->NEWS_PICTURE != "" && file_exists($filename))	{
					unlink($filename);
				}
				
				$this->session->set_flashdata('success', '"'.$obj->row()->NEWS_TITLE.'" berhasil dihapus.');
			}else{
				$this->session->set_flashdata('error', 'Terjadi kesalahan.. Silahkan ulangi lagi beberapa saat lagi.');
			}
		}else{
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
		}
			
		redirect('backoffice/dialog');
	}
	
	private function _getAlias($string){
		$this->load->model('X_News_Model');
		$newString = strtolower(preg_replace(array('/[\-]+$/', '/[\s\W]+/', '/\s[\s]+/', '/^[\-]+/', '/\&/', '/\%/', '/\@/'), '-', $string));
	
		$check = $this->X_News_Model->getNewsByAlias($newString);
	
		if($check->num_rows() > 0){
			return $newString.'_'.date('YmdHis');
		}else{
			return $newString;
		}
	}
}

/* End of file dialog.php */
/* Location: ./application/controllers/backoffice/dialog.php */