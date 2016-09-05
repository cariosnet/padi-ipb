<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Adsbanner extends CI_Controller {
	
	function Adsbanner(){
		parent::__construct();		
		
		if(!$this->session->userdata('LOGGED_IN')){
			$this->session->set_flashdata('information', 'Session Login anda telah Expire, Silahkan Login Kembali..');
			redirect('auth/users');
		}
	}

	public function index(){
		$this->load->model('X_Ads_Banner_Model');
		$this->load->model('X_Ads_Position_Model');
		
		$data = array(
				'pageTitle' 	=> 'Berita',
				'content'	 	=> 'back/adsbanner/ads-banner-list',
				'contentData'	=> array(
						'listBanner' => $this->X_Ads_Banner_Model->getListBanner()
				)
		);
	
		$this->load->view('back/layout', $data);
	}
	
	public function create($param = null){
		if($param == "a" || $param == "b"){
			if($param == "a"){
				$widthSize = "972";
				$widthSizeTmp = "772";
				$heightSize = "90";
			}else {
				$widthSize = "320";
				$widthSizeTmp = $widthSize;
				$heightSize = "200";
			}
			
			$this->load->model('X_Ads_Position_Model');
			
			$data = array(
					'pageTitle' 	=> 'Tambah Banner Baru',
					'content'	 	=> 'back/adsbanner/ads-banner-add',
					'contentData'	=> array(
							'heightSize'	=> $heightSize,
							'widthSize' 	=> $widthSize,
							'widthSizeTmp' 	=> $widthSizeTmp,
							'listPosition'	=> $this->X_Ads_Position_Model->getListPosition(),
							'kind'			=> $param
					)
			);
			
			$this->load->view('back/layout', $data);
		}else{
			
			$data = array(
					'pageTitle' 	=> 'Tambah Iklan Baru | Pilih Ukuran',
					'content'	 	=> 'back/adsbanner/ads-size-list',
					'contentData'	=> array(
							
					)
			);
				
			$this->load->view('back/layout', $data);
		}
	}
	
	function submit(){
		$this->load->model('X_Ads_Position_Model');
		$this->load->model('X_Ads_Banner_Model');
			
		if($this->input->post('save') != ''){
			$id = $this->input->post('id');
				
			$data = array(
					'TITLE'		=> $this->input->post('title'),
					'STATUS'	=> $this->input->post('status'),
					'KIND'		=> $this->input->post('kind'),
					'TYPE'		=> $this->input->post('type'),
					'DESC'		=> $this->input->post('desc'),
					'ORDER'		=> $this->input->post('order')
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
							'upload_path'		=> $this->config->item('img_path_upload').'banner/',
							'allowed_types'		=> $this->config->item('img_allowed_type'),
							'overwrite'			=> 'TRUE'
					);
						
					$this->upload->initialize($uploadConf);
						
					if (!$this->upload->do_upload('embed')){
						$this->session->set_flashdata('error', $this->upload->display_errors());
						if($id != null){
							redirect('backoffice/adsbanner/edit/'.$id);
						}else{
							redirect('backoffice/adsbanner/create');
						}
							
					}else{
						if($id != null && $this->input->post('embed_old') != ''){
							$filename =  $this->config->item('img_path_upload').'banner/'.$this->input->post('embed_old', TRUE);
							if(file_exists($filename))	{
								unlink($filename);
							}
						}
							
						$upData 		= $this->upload->data();
						$data['EMBED'] 	= $upData['file_name'];
							
						//Resize Image
						if(true){
							$config['image_library'] = 'GD2';
							$config['source_image']  = $this->config->item('img_path_upload').'banner/'.$upData['file_name'];
							$config['maintain_ratio'] = TRUE;
							$config['width'] = $this->input->post('width_size');
							$config['height'] = 700;
								
							$this->load->library('image_lib', $config);
								
							if (!$this->image_lib->resize()){
								$this->session->set_flashdata('error', $this->image_lib->display_errors());
				
								if($id != null){
									redirect('backoffice/adsbanner/edit/'.$id);
								}else{
									redirect('backoffice/adsbanner/create');
								}
							}
						}
					}
				}
			}
				
			
		
			if($id != ''){
				$data['UPDATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['UPDATED_DATE'] 	= date('Y-m-d H:i:s');
		
				$this->X_Ads_Banner_Model->updateAds($data, $id);
				
			}else{
				$data['CREATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['CREATED_DATE'] 	= date('Y-m-d H:i:s');
				$lastInsertedId = $this->X_Ads_Banner_Model->insertAds($data);
				$id = $lastInsertedId;
			}
			
			//Save Position
			$posInputArr = array();
			if($this->input->post('position') != ""){
				$posInputArr = $this->input->post('position');
			}
			
			$banPos = $this->X_Ads_Position_Model->getListPositionBanner($id);
			$banPosArr = array();
			
			foreach ($banPos->result() as $banPosRow){
				if(!in_array($banPosRow->POSITION, $posInputArr)){
					$this->X_Ads_Position_Model->delPosition($banPosRow->ID);
				}else {
					$banPosArr[] = $banPosRow->POSITION;
				}
			}
			
			for ($i = 0; $i < count($posInputArr);$i++){
				if(!in_array($posInputArr[$i], $banPosArr)){
					$this->X_Ads_Position_Model->insertPosition(array('BANNER'=>$id, 'POSITION'=>$posInputArr[$i]));
				}
			}
				
			$this->session->set_flashdata('success', 'Data berhasil disimpan.');
			redirect('backoffice/adsbanner');
		}
		redirect('backoffice/adsbanner/create');
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
		$this->load->model('X_Ads_Banner_Model');
		$this->load->model('X_Ads_Position_Model');
		
		$obj = $this->X_Ads_Banner_Model->getAdsById($id);
			
		if($obj->num_rows() == 0){
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
			redirect('backoffice/adsbanner');
		}
		
		$param = $obj->row()->KIND;
		if($param == "a"){
			$widthSize = "972";
			$widthSizeTmp = "772";
			$heightSize = "90";
		}else {
			$widthSize = "320";
			$widthSizeTmp = $widthSize;
			$heightSize = "200";
		}
		
		$position = array();
		foreach ($this->X_Ads_Position_Model->getListPositionBanner($obj->row()->ID)->result() as $row){
			$position[] = $row->POSITION;
		}
			
		$data = array(
				'pageTitle' 	=> 'Ubah Iklan Banner',
				'content'	 	=> 'back/adsbanner/ads-banner-edit',
				'contentData'	=> array(
						'ads'			=> $obj->row(),
						'heightSize'	=> $heightSize,
						'widthSize' 	=> $widthSize,
						'widthSizeTmp' 	=> $widthSizeTmp,
						'listPosition'	=> $this->X_Ads_Position_Model->getListPosition(),
						'position'		=> $position
				)
		);
			
		$this->load->view('back/layout', $data);
	}
	
	function delete($id){
		$this->load->model('X_Ads_Banner_Model');
		$obj = $this->X_Ads_Banner_Model->getAdsById($id);
			
		if($obj->num_rows() != 0){
			$filename =  $this->config->item('img_path_upload').'banner/'.$obj->row()->URL;
			
			if($this->X_Ads_Banner_Model->delAds($obj->row()->ID)){
				if($obj->row()->URL != "" && file_exists($filename))	{
					unlink($filename);
				}
				
				$this->session->set_flashdata('success', 'Banner "'.$obj->row()->TITLE.'" berhasil dihapus.');
			}else{
				$this->session->set_flashdata('error', 'Terjadi kesalahan.. Silahkan ulangi lagi beberapa saat lagi.');
			}
		}else{
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
		}
			
		redirect('backoffice/adsbanner');
	}
	
	
}

/* End of file adsbanner.php */
/* Location: ./application/controllers/backoffice/adsbanner.php */