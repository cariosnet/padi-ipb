<?php
class Program extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function detail($alias){
		$this->load->model('X_News_Model');
		$this->load->model('X_Download_Model');
		$this->load->model('X_Pages_Model');
		$this->load->model('program_model');
		$this->load->model('X_Ads_Position_Model');
		$this->load->model('eksternal/Phpbb_Posts_Model', 'Phpbb_Posts_Model');
		 
		$obj = $this->program_model->getPagesByAlias($alias);
		 
		if($obj->num_rows() == 0){
			redirect('pages/error404');
		}
	
// 		//Set PageViews
// 		if(!isset($_COOKIE["views-pages-".$obj->row()->ID])){
// 			$data['PAGE_VIEW'] = $obj->row()->PAGE_VIEW+1;
			 
// 			$this->program_model->updatePages($data, $obj->row()->ID);
			 
// 			setcookie("views-pages-".$obj->row()->ID, "true", time() + 900);
// 		}
		 
		$data = array(
				'pageTitle' 	=> $obj->row()->TITLE,
				'content'	 	=> 'front/pages/page-detail',
				'meta_desc'		=> $obj->row()->META_DESC,
				'meta_key'		=> $obj->row()->META_KEY,
				'contentData'	=> array(
						'listLatestNews'	=> $this->X_News_Model->getListNews(6, 0, "N", "A"),
						'listPopuler'		=> $this->X_News_Model->getPopularNews(6, 0, "N", "A"),
						'pages'				=> $obj->row(),
						'listForum'			=> $this->Phpbb_Posts_Model->getListThreads(),
						'listBanner'		=> $this->X_Ads_Position_Model->getListPositionBannerJoinFront(10, "a"),
						'listBannerSide'	=> $this->X_Ads_Position_Model->getListPositionBannerJoinFront(10, "b"),

						'listRegulasi'	=> $this->X_Download_Model->getListData(10, 0, "RE", "A"),
						'listProduk'	=> $this->X_News_Model->getNewArtikelLimit("D"),
    					'listDokumen'	=> $this->X_Download_Model->getListData(10, 0, "DO", "A"),
				)
		);
		 
		$this->load->view('front/layout', $data);
	}
}