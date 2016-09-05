<?php
class Bank_data extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('X_Download_Model');
		$this->load->model('X_Pages_Model');
	}
	
	function bank_data_list($type,$category=""){
		$this->load->model('X_News_Category_Model');
		
		$og_image = $this->config->item('ext_img')."icon/200x200.png";
		
		$data = array(
			'pageTitle' 	=> 'Regulasi',
			'content'	 	=> 'front/bank_data/data_list',
			'meta_desc'		=> '',
			'meta_key'		=> '',
			'og_image'		=> $og_image,
			'contentData'	=> array(
					'breadData' => '',
					'listCat'	=> $this->X_News_Category_Model->getListCatTypeAll(7),
					'type' => $type,
					'category' => $category
			)
		);
		
		$this->load->view('front/layout', $data);
	}
	
	function ajax_filter_data(){
		$data = array(
			'dataList' => $this->X_Download_Model->getListDataFilter($this->input->post('category'),$this->input->post('title'), $this->input->post('type'),$this->input->post('nomor'),$this->input->post('tahun')),
			'type' => $this->input->post('type'),
			'category' => $this->input->post('category')
		);
		$this->load->view('front/bank_data/filter_data',$data);
	}
	
	function detail($id, $alias){
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
			
			
		//Related Content
		$data = array(
				'pageTitle' 	=> 'Regulasi: '.$obj->row()->TITLE,
				'content'	 	=> 'front/bank_data/detail',
				'contentData'	=> array(
						'pages'		=> $obj->row(),
						'breadData' => '',
						'listRegulasi'	=> $this->X_Download_Model->getListData(10, 0, "RE", "A"),
						'listProduk'	=> $this->X_Download_Model->getListData(10, 0, "PR", "A"),
						'listDokumen'	=> $this->X_Download_Model->getListData(10, 0, "DO", "A"),
				)
		);
			
		$this->load->view('front/layout', $data);
	}
}