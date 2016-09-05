<?php
class Regulasi extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('X_Download_Model');
		$this->load->model('X_Pages_Model');
	}
	
	function index(){
		$this->load->model('X_News_Model');
		$this->load->model('X_Ads_Position_Model');
	
		$data = array(
				'pageTitle' 	=> 'Indeks Regulasi',
				'content'	 	=> 'front/regulasi/regulasi-indeks',
				'meta_desc'		=> 'Indeks Regulasi',
				'meta_key'		=> 'indeks, produk, hukum',
				'contentData'	=> array(
						'listProdakHukum'	=> $this->X_Download_Model->getListData(6, 0, "RE", "A"),
						'listBankData'		=> $this->X_Download_Model->getListData(6, 0, "BD", "A")
				)
		);
	
		$this->load->view('front/layout', $data);
	}
	
	function detail($id){
		$obj = $this->X_Download_Model->getDataById($id);
	
		if($obj->num_rows() == 0){
			redirect('pages/error404');
		}
		 
		//Set PageViews
		if(!isset($_COOKIE["views-".$obj->row()->ID])){
			$data['PAGE_VIEW'] = $obj->row()->PAGE_VIEW+1;
			 
			$this->X_Download_Model->updateData($data, $obj->row()->ID);
			 
			setcookie("views-".$obj->row()->ID, "true", time() + 900);
		}
		 
		$this->load->model('X_Ads_Position_Model');
		 
		//Related Content
		$data = array(
				'pageTitle' 	=> 'Regulasi: '.$obj->row()->TITLE,
				'content'	 	=> 'front/regulasi/regulasi-detail',
				'contentData'	=> array(
						'pages'		=> $obj->row(),
						'listProdakHukum'	=> $this->X_Download_Model->getListData(6, 0, "RE", "A"),
						'listBankData'		=> $this->X_Download_Model->getListData(6, 0, "BD", "A")
				)
		);
		 
		$this->load->view('front/layout', $data);
	}
	
}