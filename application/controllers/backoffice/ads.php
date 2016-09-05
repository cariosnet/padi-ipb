<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ads extends CI_Controller {
	
	function Ads(){
		parent::__construct();		
		
		if(!$this->session->userdata('LOGGED_IN')){
			$this->session->set_flashdata('information', 'Session Login anda telah Expire, Silahkan Login Kembali..');
			redirect('auth/users');
		}
	}

	public function index(){
		$this->load->model('X_Ads_Model');
		
		$data = array(
				'pageTitle' 	=> 'Iklan Baris',
				'content'	 	=> 'back/ads/ads-list',
				'contentData'	=> array(
						
				)
		);
	
		$this->load->view('back/layout', $data);
	}
	
	public function request(){
		$this->load->model('X_Ads_Model');
	
		$data = array(
				'pageTitle' 	=> 'Permintaan Iklan Baris',
				'content'	 	=> 'back/ads/ads-request-list',
				'contentData'	=> array(
	
				)
		);
	
		$this->load->view('back/layout', $data);
	}
	
	public function create(){
		$this->load->model('X_Ads_Category_Model');
			
		$listCat = $this->X_Ads_Category_Model->getListCat(null);
				
		$data = array(
				'pageTitle' 	=> 'Buat Iklan Baru',
				'content'	 	=> 'back/ads/ads-add',
				'contentData'	=> array(
						'listCat'		=> $listCat
				)
		);
			
		$this->load->view('back/layout', $data);
	}
	
	function submit(){
		$this->load->model('X_Ads_Model');
			
		if($this->input->post('save') != ''){
			$id = $this->input->post('id');
				
			$data = array(
					'ADS_AUTHOR'			=> $this->input->post('ads_author'),
					'ADS_AUTHOR_PHONE'		=> $this->input->post('ads_author_phone'),
					'ADS_AUTHOR_EMAIL'		=> $this->input->post('ads_author_email'),
					'ADS_AUTHOR_ADDRESS'	=> $this->input->post('ads_author_address'),
					'ADS_CAT'				=> $this->input->post('ads_cat'),
					'ADS_TITLE'				=> $this->input->post('ads_title'),
					'ADS_CONTENT'			=> $this->input->post('ads_content'),
					'ADS_START	'			=> date("Y-m-d", strtotime($this->input->post('ads_start'))),
					'ADS_FINISH'			=> date("Y-m-d", strtotime($this->input->post('ads_finish'))),
					'STATUS'				=> $this->input->post('status'),
					'META_DESC'				=> $this->input->post('meta_desc'),
					'META_KEY'				=> $this->input->post('meta_key')
			);
			
			if($this->input->post('alias') != $this->input->post('alias_old'))
				$data['ALIAS']		= $this->_getAlias($this->input->post('alias'));
			else
				$data['ALIAS'] = $this->input->post('alias_old');
				
			//Upload Image
			if($_FILES['ads_picture']['name'] != ''){
				$this->load->library('upload');
				$uploadConf = array(
						'file_name' 		=> $data['ALIAS'].'_'.date('YmdHis'),
						'upload_path'		=> $this->config->item('img_path_upload').'ads/',
						'allowed_types'		=> $this->config->item('img_allowed_type'),
						'overwrite'			=> 'TRUE'
				);
			
				$this->upload->initialize($uploadConf);
			
				if (!$this->upload->do_upload('ads_picture')){
					$this->session->set_flashdata('error', $this->upload->display_errors());
					if($id != null){
						redirect('backoffice/ads/edit/'.$id);
					}else{
						redirect('backoffice/ads/create/');
					}
			
				}else{
					if($id != null && $this->input->post('ads_picture_old', TRUE) != ''){
						$filename =  $this->config->item('img_path_upload').'ads/'.$this->input->post('ads_picture_old', TRUE);
						if(file_exists($filename))	{
							unlink($filename);
						}
					}
			
					$upData 				= $this->upload->data();
					$data['ADS_PICTURE'] 	= $upData['file_name'];
					
					//Resize Image
					if($this->config->item('resize_enable')){
						$config['image_library'] = 'GD2';
						$config['source_image']  = $this->config->item('img_path_upload').'ads/'.$upData['file_name'];
						$config['maintain_ratio'] = TRUE;
						$config['width'] = 700;
						$config['height'] = 400;
							
						$this->load->library('image_lib', $config);
							
						if (!$this->image_lib->resize()){
							$this->session->set_flashdata('error', $this->image_lib->display_errors());
								
							if($id != null){
								redirect('backoffice/ads/edit/'.$id);
							}else{
								redirect('backoffice/ads/create/');
							}
						}
					}
				}
			}
		
			if($id != ''){
				$data['UPDATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['UPDATED_DATE'] 	= date('Y-m-d H:i:s');
		
				$this->X_Ads_Model->updateAds($data, $id);
				
				if($_FILES['ads_picture']['name'] != ''){
					redirect('backoffice/ads/croping/'.$id);
				}
			}else{
				$data['CREATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['CREATED_DATE'] 	= date('Y-m-d H:i:s');
				$lastInsertedId = $this->X_Ads_Model->insertAds($data);
				
				if($_FILES['ads_picture']['name'] != ''){
					redirect('backoffice/ads/croping/'.$lastInsertedId);
				}
			}
				
			$this->session->set_flashdata('success', 'Data berhasil disimpan.');
			redirect('backoffice/ads');
		}
		redirect('backoffice/ads/create');
	}
	
	public function croping($id){
		if($this->input->post('save', TRUE) != null || $this->input->post('cropUnLoad', TRUE) != null){
			$this->load->library('image_lib');
				
			//Set Crop
			$config['image_library'] = 'gd2';
			$config['source_image']  = $this->config->item('img_path_upload').'ads/'.$this->input->post('img', TRUE);
			$config['maintain_ratio'] = FALSE;
			$config['height'] = $this->input->post('h', TRUE);
			$config['width'] = $this->input->post('w', TRUE);
			$config['x_axis'] = $this->input->post('x', TRUE);
			$config['y_axis'] = $this->input->post('y', TRUE);
	
			$this->image_lib->initialize($config);
	
			if (!$this->image_lib->crop()){
				$this->session->set_flashdata('error', $this->image_lib->display_errors());
				redirect('backoffice/ads/croping/'.$id);
			}
				
			//Resize
			$config2['image_library'] = 'gd2';
			$config2['source_image']  = $this->config->item('img_path_upload').'ads/'.$this->input->post('img', TRUE);
			$config2['maintain_ratio'] = FALSE;
			$config2['height'] = 350;
			$config2['width'] = 650;
				
			$this->image_lib->initialize($config2);
				
			if (!$this->image_lib->resize()){
				$this->session->set_flashdata('error', $this->image_lib->display_errors());
				redirect('backoffice/ads/croping/'.$id);
			}else{
				$this->session->set_flashdata('success', 'Simpan Iklan dan Crop photo berhasil');
				redirect('backoffice/ads');
			}
		}
	
		$this->load->model('X_Ads_Model');
		$obj 	= $this->X_Ads_Model->getAdsById($id);
		if($obj->num_rows() < 1 || $obj->row()->ADS_PICTURE == ''){
			$this->session->set_flashdata('error', 'Gambar pada berita tidak ditemukan.');
			redirect('backoffice/ads');
		}
	
		$data = array(
				'pageTitle' 	=> 'Crop Photo',
				'content'	 	=> 'back/ads/ads-croping',
				'contentData'	=> array(
						'row'		=> $obj->row()
				)
		);
		$this->load->view('back/layout', $data);
	}
	
	function edit($id){
		$this->load->model('X_Ads_Category_Model');
		$this->load->model('X_Ads_Model');
		//$this->load->library('newslogic');
		
		$obj = $this->X_Ads_Model->getAdsById($id);
			
		if($obj->num_rows() == 0){
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
			redirect('backoffice/ads');
		}
			
		$data = array(
				'pageTitle' 	=> 'Ubah Iklan',
				'content'	 	=> 'back/ads/ads-edit',
				'contentData'	=> array(
						'ads'			=> $obj->row(),
						'listCat'		=> $this->X_Ads_Category_Model->getListCat()
				)
		);
			
		$this->load->view('back/layout', $data);
	}
	
	function delete($id){
		$this->load->model('X_Ads_Model');
		$obj = $this->X_Ads_Model->getAdsById($id);
			
		if($obj->num_rows() != 0){
			$filename =  $this->config->item('img_path_upload').'ads/'.$obj->row()->ADS_PICTURE;
			
			if($this->X_Ads_Model->delAds($obj->row()->ADS_ID)){
				if($obj->row()->ADS_PICTURE != '' && file_exists($filename))	{
					unlink($filename);
				}
				
				$this->session->set_flashdata('success', 'Iklan "'.$obj->row()->ADS_TITLE.'" berhasil dihapus.');
			}else{
				$this->session->set_flashdata('error', 'Terjadi kesalahan.. Silahkan ulangi lagi beberapa saat lagi.');
			}
		}else{
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
		}
			
		redirect('backoffice/ads');
	}
	
	function ajax_ads_listing($status = "") {
		$this->load->model('X_Ads_Model');
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
		$sortCol = $this->datatables->getSortCol(array("", "ADS_TITLE", "", "", "", "STATUS", "PAGE_VIEW", ""));
		
		if($status == 'pending')$isPending = true;
		else $isPending = false;
		
		// run query to get user listing
		$listNews = $this->X_Ads_Model->getListAdsJoin($start, $rows, $search, $sortCol, $sortDir, $isPending);
		$iTotal = $this->X_Ads_Model->getListAdsJoin(0, '-1', '', '', '', $isPending)->num_rows();
		
		if($search != "")$iFilteredTotal = $this->X_Ads_Model->getListAdsJoin('', -1, $search, '', '', $isPending)->num_rows();
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
				$record[] = "<a target='_blank' href='".site_url("ads/read/".$row->ADS_ID."/".$row->ALIAS)."'>".$row->ADS_TITLE."</a>";
				$record[] = $row->CAT_NAME;
				$record[] = date('d M Y', strtotime($row->ADS_START));
				$record[] = date('d M Y', strtotime($row->ADS_FINISH));
				
				$record[] = $row->ADS_AUTHOR;
				$record[] = $row->STATUS;
				$record[] = $row->PAGE_VIEW;
				
				$actionButton = "<div class='btn-toolbar' style='margin: 0; padding: 0;'>
									<div class='btn-group'>
										<a href='".site_url("backoffice/ads/edit/".$row->ADS_ID)."' class='button button-basic button-small' rel='tooltip' title='Ubah'><i class='icon-edit'></i></a>
										<a href='javascript:void(0);' class='button button-basic button-small' rel='tooltip' title='Hapus' onclick='confirmPopUp(\"deleteRow(".$row->ADS_ID.")\", \"Peringatan..\", \"Anda yakin ingin dihapus ??\", \"Ya\", \"Tidak\");'><i class='icon-trash'></i></a>
									</div>
								</div>";
				$record[] = $actionButton;
		
				$output['aaData'][] = $record;
		}
		// format it to JSON, this output will be displayed in datatable
		echo json_encode($output);
	}
	
	private function _getAlias($string){
		$this->load->model('X_Ads_Model');
		$newString = strtolower(preg_replace(array('/[\-]+$/', '/[\s\W]+/', '/\s[\s]+/', '/^[\-]+/', '/\&/', '/\%/', '/\@/'), '-', $string));
	
		$check = $this->X_Ads_Model->getAdsByAlias($newString);
	
		if($check->num_rows() > 0){
			return $newString.'_'.date('YmdHis');
		}else{
			return $newString;
		}
	}
}

/* End of file news.php */
/* Location: ./application/controllers/backoffice/news.php */