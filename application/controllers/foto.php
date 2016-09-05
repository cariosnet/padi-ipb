<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Foto extends CI_Controller {
	var $breadData = array();
	var $breadLoop = 0;
	
	function Foto(){
		parent::__construct();	
		$this->load->model('X_Pages_Model');
		$this->load->model('X_Download_Model');
		$this->load->model('X_News_Model');
	}

    function index(){
    	$this->load->model('X_Poto_Gal_Model');
    	$this->load->library('newslogic');
    	
		$lastid = $this->X_Poto_Gal_Model->getLastIDKatExist();
		//print $lastid; exit;
		$obj = $this->X_Poto_Gal_Model->getFirstPoto($lastid);
		$list = $this->X_Poto_Gal_Model->getListPoto();
		$grid = $list->result_array();
		
		$slide = $this->X_Poto_Gal_Model->getSlidePoto($lastid);
		
		foreach($grid as $keygrid => $valgrid)
		{
			$grid_array[$valgrid['ID_KAT']]['EMBED'] = $valgrid['EMBED'];
			
			$grid_array[$valgrid['ID_KAT']]['TITLE_KAT'] = $valgrid['TITLE_KAT'];
		}
	
	//print "<pre>";print_r($grid); exit;
	
    	$data = array(
    			'pageTitle' 	=>'Foto Galeri',
    			'content'	 	=> 'front/poto/poto',
    			'meta_desc'		=> 'foto galeri',
    			'meta_key'		=> 'foto galeri',
    			'contentData'	=> array(
					'news'		=> $obj->row(),
					'list_poto'	=> $grid,
    					'breadData' => $this->breadData,
    					'listRegulasi'	=> $this->X_Download_Model->getListData(10, 0, "RE", "A"),
    					'listProduk'	=> $this->X_News_Model->getNewArtikelLimit("D"),
					'listkat'	=> $grid_array
    			)
    	);
    	
    	$this->load->view('front/layout', $data);
    }
    
     function nextkat($idkat){
    	$this->load->model('X_Poto_Gal_Model');
    	$this->load->library('newslogic');
    	
	$obj = $this->X_Poto_Gal_Model->getFirstPoto($idkat);
	$list = $this->X_Poto_Gal_Model->getListPoto();
	$grid = $list->result_array();
	
	$slide = $this->X_Poto_Gal_Model->getSlidePoto($idkat);
	
	//print "<pre>"; print_r ($grid); exit;
	
	foreach($grid as $keygrid => $valgrid)
	{
		$grid_array[$valgrid['ID_KAT']]['EMBED'] = $valgrid['EMBED'];
		
		$grid_array[$valgrid['ID_KAT']]['TITLE_KAT'] = $valgrid['TITLE_KAT'];
	}
	
	//print "<pre>";print_r($grid_array); //exit;
	
    	$data = array(
    			'pageTitle' 	=>'Foto Galeri',
    			'content'	 	=> 'front/poto/poto',
    			'meta_desc'		=> 'foto galeri',
    			'meta_key'		=> 'foto galeri',
    			'contentData'	=> array(
					'news'		=> $obj->row(),
					'list_poto'	=> $slide->result_array(),
    					'breadData' => $this->breadData,
    					'listRegulasi'	=> $this->X_Download_Model->getListData(10, 0, "RE", "A"),
    					'listProduk'	=> $this->X_News_Model->getNewArtikelLimit("D"),
					'listkat'	=> $grid_array
    			)
    	);
    	
    	$this->load->view('front/layout', $data);
    }
    
    function next($idkat,$id_foto){
    	$this->load->model('X_Poto_Gal_Model');
    	$this->load->library('newslogic');
    	
	$obj = $this->X_Poto_Gal_Model->getLatestPoto($id_foto);
	$list = $this->X_Poto_Gal_Model->getListPoto();
	$grid = $list->result_array();
	$slide = $this->X_Poto_Gal_Model->getSlidePoto($idkat);
	
	foreach($grid as $keygrid => $valgrid)
	{
		$grid_array[$valgrid['KANAL']]['NAME'] = $valgrid['CAT_NAME'];
		$grid_array[$valgrid['KANAL']][$valgrid['ID_KAT']]['EMBED'] = $valgrid['EMBED'];
		$grid_array[$valgrid['KANAL']][$valgrid['ID_KAT']]['POTOGRAFER'] = $valgrid['POTOGRAFER'];
		$grid_array[$valgrid['KANAL']][$valgrid['ID_KAT']]['CAT_NAME'] = $valgrid['CAT_NAME'];
		$grid_array[$valgrid['KANAL']][$valgrid['ID_KAT']]['TITLE_KAT'] = $valgrid['TITLE_KAT'];
	}
	
    	$data = array(
    			'pageTitle' 	=>'Foto Galeri',
    			'content'	 	=> 'front/poto/poto',
    			'meta_desc'		=> 'foto galeri',
    			'meta_key'		=> 'foto galeri',
    			'contentData'	=> array(
					'news'		=> $obj->row(),
					'list_poto'	=> $slide->result_array(),
    					'breadData' => $this->breadData,
    					'listRegulasi'	=> $this->X_Download_Model->getListData(10, 0, "RE", "A"),
    					'listProduk'	=> $this->X_News_Model->getNewArtikelLimit("D"),
					'listkat'	=> $grid_array
    			)
    	);
    	
    	$this->load->view('front/layout', $data);
    }
    
    function fokus($id){
    	$this->load->model('X_News_Model');
    	$obj = $this->X_News_Model->getNewsById($id);
    
    	if($obj->num_rows() == 0){
    		redirect('pages/error404');
    	}
    	
    	//Set PageViews
    	if(!isset($_COOKIE["views-".$obj->row()->NEWS_ID])){
    		$data['PAGE_VIEW'] = $obj->row()->PAGE_VIEW+1;
    		 
    		$this->X_News_Model->updateNews($data, $obj->row()->NEWS_ID);
    		 
    		setcookie("views-".$obj->row()->NEWS_ID, "true", time() + 900);
    	}
    	
    	if($obj->row()->NEWS_PICTURE != "")$og_image = $this->config->item('img_path').'news/'.$obj->row()->NEWS_PICTURE; else $og_image = $this->config->item('ext_img')."icon/200x200.png";
    	 
    	$data = array(
    			'pageTitle' 	=> 'Fokus: '.$obj->row()->NEWS_TITLE,
    			'content'	 	=> 'front/news/fokus',
    			'meta_desc'		=> $obj->row()->META_DESC,
    			'meta_key'		=> $obj->row()->META_KEY,
    			'og_image'		=> $og_image,
    			'contentData'	=> array(
    					'listRegulasi'	=> $this->X_Download_Model->getListData(10, 0, "RE", "A"),
    					'listProduk'	=> $this->X_News_Model->getNewArtikelLimit("D"),
    					'news'		=> $obj->row(),
    			)
    	);
    	 
    	$this->load->view('front/layout', $data);
    }
    
    function dialog($id){
    	$this->load->model('X_News_Model');
    	$obj = $this->X_News_Model->getNewsById($id);
    
    	if($obj->num_rows() == 0){
    		redirect('pages/error404');
    	}
    	 
    	//Set PageViews
    	if(!isset($_COOKIE["views-".$obj->row()->NEWS_ID])){
    		$data['PAGE_VIEW'] = $obj->row()->PAGE_VIEW+1;
    		 
    		$this->X_News_Model->updateNews($data, $obj->row()->NEWS_ID);
    		 
    		setcookie("views-".$obj->row()->NEWS_ID, "true", time() + 900);
    	}
    
    	if($obj->row()->NEWS_PICTURE != "")$og_image = $this->config->item('img_path').'news/'.$obj->row()->NEWS_PICTURE; else $og_image = $this->config->item('ext_img')."icon/200x200.png";
    	
    	$data = array(
    			'pageTitle' 	=> 'Wawancara: '.$obj->row()->NEWS_TITLE,
    			'content'	 	=> 'front/news/dialog',
    			'meta_desc'		=> $obj->row()->META_DESC,
    			'meta_key'		=> $obj->row()->META_KEY,
    			'og_image'		=> $og_image,
    			'contentData'	=> array(
    					'listRegulasi'	=> $this->X_Download_Model->getListData(10, 0, "RE", "A"),
    					'listProduk'	=> $this->X_News_Model->getNewArtikelLimit("D"),
    					'news'		=> $obj->row(),
    			)
    	);
    
    	$this->load->view('front/layout', $data);
    }
    
    private function createBreadCrumbs($catId){
    	$cat = $this->X_News_Category_Model->getCatById($catId);
    	
    	if($cat->row()->PARENT != null)$this->createBreadCrumbs($cat->row()->PARENT);
    	
    	$this->breadData[$this->breadLoop]['CAT_ALIAS'] = $cat->row()->CAT_ALIAS;
    	$this->breadData[$this->breadLoop]['CAT_NAME'] 	= $cat->row()->CAT_NAME;
   		
   		$this->breadLoop++;
    	
   		return $cat;
    }
}

/* End of file news.php */
/* Location: ./application/controllers/news.php */