<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller {
	
	function News(){
		parent::__construct();		
		
		if(!$this->session->userdata('LOGGED_IN')){
			$this->session->set_flashdata('information', 'Session Login anda telah Expire, Silahkan Login Kembali..');
			redirect('auth/users');
		}
	}

	public function index(){
		$this->load->model('X_News_Model');
		
		$data = array(
				'pageTitle' 	=> 'Berita',
				'content'	 	=> 'back/news/news-list',
				'contentData'	=> array(
						
				)
		);
	
		$this->load->view('back/layout', $data);
	}
	
	public function create(){
			$this->load->model('X_News_Category_Model');
			$this->load->library('newslogic');
			$data = array(
					'pageTitle' 	=> 'Buat Berita Baru',
					'content'	 	=> 'back/news/news-add',
					'contentData'	=> array(
// 							'listTags'		=> $this->newslogic->getListTagsJson(),
							'listCat'		=> $this->X_News_Category_Model->getListCat()
					)
			);
			
			$this->load->view('back/layout', $data);
	}
	
	function submit(){
		$this->load->model('X_News_Model');
			
		if($this->input->post('save') != ''){
			$id = $this->input->post('id');
				
			$data = array(
					'CAT'					=> $this->input->post('cat'),
					'NEWS_TITLE'			=> $this->input->post('news_title'),
					'NEWS_SUBTITLE'			=> $this->input->post('news_subtitle'),
					'NEWS_CONTENT'			=> $this->input->post('news_content'),
					'NEWS_PICTURE_CAPTION'	=> $this->input->post('news_picture_caption'),
					'NEWS_PICTURE_SOURCE'	=> $this->input->post('news_picture_source'),
					'WRITER'				=> $this->input->post('writer'),
					'EDITOR'				=> null,
					'TAGS'					=> null,
					'STATUS'				=> $this->input->post('status'),
					'IS_HEADLINE'			=> $this->input->post('is_headline'),
					'IS_PILIHAN'			=> 0,
					'DATE'					=> date("Y-m-d H:i:s", strtotime($this->input->post('x_date')." ".$this->input->post('x_time'))),
					'TYPE'					=> "N",
					'META_TITLE'			=> $this->input->post('news_title'),
					'META_DESC'				=> $this->input->post('meta_desc'),
					'META_KEY'				=> $this->input->post('meta_key')
			);
			
			if($this->input->post('alias') != $this->input->post('alias_old'))
				$data['ALIAS']		= $this->_getAlias($this->input->post('alias'));
			else
				$data['ALIAS'] = $this->input->post('alias_old');
			
			//Save tags Suggestion
// 			$this->load->model('X_News_Tags_Model');
// 			$tags = explode(",", $data['TAGS']);
// 			for($i = 0; $i < count($tags); $i++){
// 				if($this->X_News_Tags_Model->getTagsByName($tags[$i])->num_rows() == 0){
// 					$this->X_News_Tags_Model->insertTags(array('TAG' => $tags[$i]));
// 				}
// 			}
				
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
						redirect('backoffice/news/edit/'.$id);
					}else{
						redirect('backoffice/news/create/cat/'.$data['CAT']);
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
								redirect('backoffice/news/edit/'.$id);
							}else{
								redirect('backoffice/news/create/cat/'.$data['CAT']);
							}
						}
					}
				}
			}
		
			if($id != ''){
				$data['UPDATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['UPDATED_DATE'] 	= date('Y-m-d H:i:s');
		
				$this->X_News_Model->updateNews($data, $id);
				
				//if($_FILES['news_picture']['name'] != ''){
					//redirect('backoffice/news/croping/'.$id);
				//}
			}else{
				$data['CREATED_BY'] 	= $this->session->userdata('USERNAME');
				$data['CREATED_DATE'] 	= date('Y-m-d H:i:s');
				$lastInsertedId = $this->X_News_Model->insertNews($data);
				
				//if($_FILES['news_picture']['name'] != ''){
				//	redirect('backoffice/news/croping/'.$lastInsertedId);
				//}
			}
				
			$this->session->set_flashdata('success', 'Data berhasil disimpan.');
			redirect('backoffice/news');
		}
		redirect('backoffice/news/create');
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
		$this->load->model('X_News_Category_Model');
		$this->load->model('X_News_Model');
		$this->load->library('newslogic');
		
		$obj = $this->X_News_Model->getNewsById($id);
			
		if($obj->num_rows() == 0){
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
			redirect('backoffice/news');
		}
			
		$data = array(
				'pageTitle' 	=> 'Ubah Berita',
				'content'	 	=> 'back/news/news-edit',
				'contentData'	=> array(
						'news'			=> $obj->row(),
// 						'listTags'		=> $this->newslogic->getListTagsJson(),
						'listCat'		=> $this->X_News_Category_Model->getListCat()
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
				
				$this->session->set_flashdata('success', 'Berita "'.$obj->row()->NEWS_TITLE.'" berhasil dihapus.');
			}else{
				$this->session->set_flashdata('error', 'Terjadi kesalahan.. Silahkan ulangi lagi beberapa saat lagi.');
			}
		}else{
			$this->session->set_flashdata('error', 'Data tidak ditemukan.');
		}
			
		redirect('backoffice/news');
	}
	
	function ajax_news_listing() {
		$this->load->model('X_News_Model');
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
		$sortCol = $this->datatables->getSortCol(array("", "", "", "DATE", "WRITER", "", "", "", "PAGE_VIEW"));
		
		// run query to get user listing
		$listNews = $this->X_News_Model->getListNewsJoin($start, $rows, $search, $sortCol, $sortDir,'N');
		$iTotal = $this->X_News_Model->getListNewsJoin(0, '-1', '', '', '','N')->num_rows();
		
		if($search != "")$iFilteredTotal = $this->X_News_Model->getListNewsJoin(0, -1, $search, '', '', 'N')->num_rows();
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
				$record[] = "<a target='_blank' href='".site_url("news/read/".$row->NEWS_ID."/".$row->ALIAS)."'>".$row->NEWS_TITLE."</a>";
				$record[] = "<a target='_blank' href='".site_url("kanal/".$row->CAT_ALIAS)."'>".$row->CAT_NAME."</a>";
				$record[] = date('d M Y H:i:s', strtotime($row->DATE))." WIB";
				$record[] = $row->WRITER;
				
				if($row->STATUS == 'A')$img = "true.png";else $img ="false.png";
				$record[] = "<img style='width: 20px;' alt='Status' src='".$this->config->item('ext_img').$img."' />";
				
				if($row->IS_HEADLINE == '1')$img = "true.png";else $img ="false.png";
				$record[] = "<img style='width: 20px;' alt='Headline' src='".$this->config->item('ext_img').$img."' />";
				
// 				if($row->IS_PILIHAN == '1')$img = "true.png";else $img ="false.png";
// 				$record[] = "<img style='width: 20px;' alt='Pilihan' src='".$this->config->item('ext_img').$img."' />";
				
				$record[] = $row->PAGE_VIEW;
				
				$actionButton = "<div class='btn-toolbar' style='margin: 0; padding: 0;'>
									<div class='btn-group'>
										<a href='".site_url("backoffice/news/edit/".$row->NEWS_ID)."' class='button button-basic button-small' rel='tooltip' title='Ubah'><i class='icon-edit'></i></a>
										<a href='javascript:void(0);' class='button button-basic button-small' rel='tooltip' title='Hapus' onclick='confirmPopUp(\"deleteRow(".$row->NEWS_ID.")\", \"Peringatan..\", \"Anda yakin ingin dihapus ??\", \"Ya\", \"Tidak\");'><i class='icon-trash'></i></a>
									</div>
								</div>";
				$record[] = $actionButton;
		
				$output['aaData'][] = $record;
		}
		// format it to JSON, this output will be displayed in datatable
		echo json_encode($output);
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

/* End of file news.php */
/* Location: ./application/controllers/backoffice/news.php */