<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Potogal extends CI_Controller {
	
	function Potogal(){
		parent::__construct();		
		
		$this->load->model('X_Poto_Gal_Model');
		$this->load->model('X_Ads_Position_Model');
		$this->load->model('X_News_Category_Model');
		
		
		if(!$this->session->userdata('LOGGED_IN')){
			$this->session->set_flashdata('information', 'Session Login anda telah Expire, Silahkan Login Kembali..');
			redirect('auth/users');
		}
	}

	public function index(){
		
		$data = array(
				'pageTitle' 	=> 'Foto Galeri',
				'content'	 	=> 'back/poto/poto-gal-list',
				'contentData'	=> array(
						'listBanner' => $this->X_Poto_Gal_Model->getListPoto()
				)
		);
	
		$this->load->view('back/layout', $data);
	}
	
	public function create($param = null){
				$widthSize = "320";
				$widthSizeTmp = $widthSize;
				$heightSize = "200";
			
			$data = array(
					'pageTitle' 	=> 'Tambah Foto Baru',
					'content'	 	=> 'back/poto/poto-gal-add',
					'contentData'	=> array(
							'heightSize'	=> $heightSize,
							'widthSize' 	=> $widthSize,
							'widthSizeTmp' 	=> $widthSizeTmp,
							'listCat'	=> $this->X_Poto_Gal_Model->getListKategPoto(),
							'listKanal'		=> $this->X_News_Category_Model->getListCat(),
							'kind'			=> $param
					)
			);
			
			$this->load->view('back/layout', $data);
	}
	
	function submit(){
		$this->load->model('X_Poto_Gal_Model');
		
		//print "<pre>";
		//print_r ($this->input->post());
		//print_r ($_FILES); exit;
		
			
		if($this->input->post('save') != ''){
			$id = $this->input->post('id');
				
			$data = array(
					'TITLE'		=> $this->input->post('title'),
					'STATUS'	=> $this->input->post('status'),
					'DESC'		=> $this->input->post('desc'),
					'TYPE'		=> $this->input->post('type'),
					'ID_KAT'	=> $this->input->post('kateg'),
					'KANAL'		=> $this->input->post('kanal'),
					'POTOGRAFER'	=> $this->input->post('potografer'),
					'POTO_DATE' => $this->input->post('poto_date')
				);
			
			if($data['TYPE'] == "C"){
				$data['HTML'] = $this->input->post('html');
			}else if($data['TYPE'] == "I"){
				$data['URL'] = $this->input->post('url');
				
				//Upload Image
				if($_FILES['embed']['name'] != ''){
					$this->load->library('upload');
					$uploadConf = array(
							'file_name' 		=> date('YmdHis'),
							'upload_path'		=> $this->config->item('img_path_upload').'potogal/',
							'allowed_types'		=> $this->config->item('img_allowed_type'),
							'overwrite'			=> 'TRUE'
					);
						
					$this->upload->initialize($uploadConf);
						
					if (!$this->upload->do_upload('embed')){
						$this->session->set_flashdata('error', $this->upload->display_errors());
						if($id != null){
							redirect('backoffice/potogal/edit/'.$id);
						}else{
							redirect('backoffice/potogal/create');
						}
							
					}else{
						if($id != null && $this->input->post('embed_old') != ''){
							$filename =  $this->config->item('img_path_upload').'potogal/'.$this->input->post('embed_old', TRUE);
							if(file_exists($filename))	{
								unlink($filename);
							}
						}
							
						$upData 		= $this->upload->data();
						$data['EMBED'] 	= $upData['file_name'];
							
						//Resize Image
						if(true){
							$config['image_library'] = 'GD2';
							$config['source_image']  = $this->config->item('img_path_upload').'potogal/'.$upData['file_name'];
							$config['maintain_ratio'] = TRUE;
							//$config['width'] = $this->input->post('width_size');
							//$config['height'] = 700;
								
							$this->load->library('image_lib', $config);
								
							if (!$this->image_lib->resize()){
								$this->session->set_flashdata('error', $this->image_lib->display_errors());
				
								if($id != null){
									redirect('backoffice/potogal/edit/'.$id);
								}else{
									redirect('backoffice/potogal/create');
								}
							}
						}
					}
				}
			}
				
			
		
			if($id != ''){
				$data['UPDATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['UPDATED_DATE'] 	= date('Y-m-d H:i:s');
		
				$this->X_Poto_Gal_Model->updateAds($data, $id);
				
			}else{
				$data['CREATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['CREATED_DATE'] 	= date('Y-m-d H:i:s');
				$lastInsertedId = $this->X_Poto_Gal_Model->insertAds($data);
				$id = $lastInsertedId;
			}
			
				
			$this->session->set_flashdata('success', 'Data berhasil disimpan.');
			redirect('backoffice/potogal');
		}
		redirect('backoffice/potogal/create');
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
				redirect('backoffice/news/croping/'.$id);
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
				redirect('backoffice/news/croping/'.$id);
			}else{
				$this->session->set_flashdata('success', 'Simpan Berita dan Crop photo berhasil');
				redirect('backoffice/news');
			}
		}
	
		$this->load->model('X_News_Model');
		$obj 	= $this->X_News_Model->getNewsById($id);
		if($obj->num_rows() < 1 || $obj->row()->NEWS_PICTURE == ''){
			$this->session->set_flashdata('error', 'Gambar pada berita tidak ditemukan.');
			redirect('backoffice/news');
		}
	
		$data = array(
				'pageTitle' 	=> 'Crop Photo',
				'content'	 	=> 'back/news/news-croping',
				'contentData'	=> array(
						'row'		=> $obj->row()
				)
		);
		$this->load->view('back/layout', $data);
	}
	
	function edit($id){
		$this->load->model('X_Poto_Gal_Model');
		
		$obj = $this->X_Poto_Gal_Model->getAdsById($id);
			
		if($obj->num_rows() == 0){
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
			redirect('backoffice/potogal');
		}
		
		
			$widthSize = "320";
			$widthSizeTmp = $widthSize;
			$heightSize = "200";

		$data = array(
				'pageTitle' 	=> 'Ubah Foto',
				'content'	 	=> 'back/poto/poto-gal-edit',
				'contentData'	=> array(
						'ads'			=> $obj->row(),
						'heightSize'	=> $heightSize,
						'widthSize' 	=> $widthSize,
						'widthSizeTmp' 	=> $widthSizeTmp,
						'listCat'	=> $this->X_Poto_Gal_Model->getListKategPoto(),
						'listKanal'		=> $this->X_News_Category_Model->getListCatALL()
					)
		);
			
		$this->load->view('back/layout', $data);
	}
	
	function delete($id){
		$this->load->model('X_Poto_Gal_Model');
		$obj = $this->X_Poto_Gal_Model->getLatestPoto($id);
			
		if($obj->num_rows() != 0){
			$filename =  $this->config->item('img_path_upload').'potogal/'.$obj->row()->URL;
			
			if($this->X_Poto_Gal_Model->delAds($obj->row()->ID)){
				if($obj->row()->URL != "" && file_exists($filename))	{
					unlink($filename);
				}
				
				$this->session->set_flashdata('success', 'FOTO "'.$obj->row()->TITLE.'" berhasil dihapus.');
			}else{
				$this->session->set_flashdata('error', 'Terjadi kesalahan.. Silahkan ulangi lagi beberapa saat lagi.');
			}
		}else{
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
		}
			
		redirect('backoffice/potogal');
	}
	
	//For Kategori Foto
	
	public function kateg(){
		$this->load->model('X_Poto_Gal_Model');
		$this->load->model('X_Ads_Position_Model');
		
		$data = array(
				'pageTitle' 	=> 'Foto Kategori',
				'content'	 	=> 'back/potokateg/poto-kateg-list',
				'contentData'	=> array(
						'listBanner' => $this->X_Poto_Gal_Model->getListKategPoto()
				)
		);
	
		$this->load->view('back/layout', $data);
	}
	
	public function createkateg($param = null){
			$data = array(
					'pageTitle' 	=> 'Tambah Kategori Foto',
					'content'	 	=> 'back/potokateg/poto-kateg-add',
					'contentData'	=> array(
							'kind'			=> $param
					)
			);
			
			$this->load->view('back/layout', $data);
	}
	
	function submitkateg(){
		$this->load->model('X_Poto_Gal_Model');
		
		//print "<pre>";
		//print_r ($this->input->post());
		//print_r ($_FILES);
		
			
		if($this->input->post('save') != ''){
			$id = $this->input->post('id');
				
			$data = array(
					'TITLE'		=> $this->input->post('title'),
					'DESC'		=> $this->input->post('desc'),
					'STATUS'	=> $this->input->post('status'),
					'KAT_DATE' => date('Y-m-d')
				);
			
			if($id != ''){
				$data['UPDATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['UPDATED_DATE'] 	= date('Y-m-d H:i:s');
		
				$this->X_Poto_Gal_Model->updateKateg($data, $id);
				
			}else{
				$data['CREATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['CREATED_DATE'] 	= date('Y-m-d H:i:s');
				$lastInsertedId = $this->X_Poto_Gal_Model->insertKateg($data);
				$id = $lastInsertedId;
			}
			
				
			$this->session->set_flashdata('success', 'Data berhasil disimpan.');
			redirect('backoffice/potogal/kateg');
		}
		redirect('backoffice/potogal/createkateg');
	}
	
	function editkateg($id){
		$this->load->model('X_Poto_Gal_Model');
		
		$obj = $this->X_Poto_Gal_Model->getKategById($id);
			
		if($obj->num_rows() == 0){
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
			redirect('backoffice/potogal/kateg');
		}
		
		$data = array(
				'pageTitle' 	=> 'Ubah Foto',
				'content'	 	=> 'back/potokateg/poto-kateg-edit',
				'contentData'	=> array(
						'ads'			=> $obj->row()
					)
		);
			
		$this->load->view('back/layout', $data);
	}
	
	function deletekateg($id){
		$this->load->model('X_Poto_Gal_Model');
		$obj = $this->X_Poto_Gal_Model->getLatestPotoKateg($id);
			
		if($obj->num_rows() != 0){
			if($this->X_Poto_Gal_Model->delKateg($obj->row()->ID)){
				
				$this->session->set_flashdata('success', 'KATEGORI FOTO "'.$obj->row()->TITLE.'" berhasil dihapus.');
			}else{
				$this->session->set_flashdata('error', 'Terjadi kesalahan.. Silahkan ulangi lagi beberapa saat lagi.');
			}
		}else{
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
		}
			
		redirect('backoffice/potogal/kateg');
	}
}

/* End of file adsbanner.php */
/* Location: ./application/controllers/backoffice/adsbanner.php */