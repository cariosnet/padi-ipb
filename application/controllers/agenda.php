<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agenda extends CI_Controller {
	
	function Agenda(){
		parent::__construct();	
		$this->load->model('X_Agenda_Model');
		$this->load->model('X_Pages_Model');
	}

	function index(){
    	$this->load->model('X_News_Model');

    	$this->load->model('X_Download_Model');
    	$data = array(
    			'pageTitle' 	=> 'Indeks Agenda',
    			'content'	 	=> 'front/agenda/agenda-indeks',
    			'meta_desc'		=> 'Indeks Produk Hukum',
    			'meta_key'		=> 'indeks, produk, hukum',
    			'contentData'	=> array(
    					'listRegulasi'	=> $this->X_Download_Model->getListData(10, 0, "RE", "A"),
    					'listProduk'	=> $this->X_News_Model->getNewArtikelLimit("D"),
    			)
    	);
    
    	$this->load->view('front/layout', $data);
    }
    
    /**
     * Untuk produk hukum dan bank data
     * @param unknown_type $param
     */
    function ajax_filter_special($param){
    	$this->load->model('X_Agenda_Model');
    	$type = $this->input->post('type', TRUE);
    	$name = $this->input->post('name', TRUE);
    	 
    	$title = null;
    	if($this->input->post('title', TRUE) != "")
    		$title = $this->input->post('title', TRUE);
    	 
    	$data = array(
    			'type'			=> array('color'=>'#c8372f', 'url'=>$param, 'name'=> $name),
    			'listData'		=> $this->X_Agenda_Model->getListDataNoLimit($type, "A", $title)
    	);
    
    	$this->load->view('front/agenda/indeks-special-list-ajax', $data);
    }
    
    function detail($id){
    	$obj = $this->X_Agenda_Model->getDataById($id);
    		
    	if($obj->num_rows() == 0){
    		redirect('pages/error404');
    	}
    	
    	//Set PageViews
    	if(!isset($_COOKIE["views-".$obj->row()->ID])){
    		$data['PAGE_VIEW'] = $obj->row()->PAGE_VIEW+1;
    	
    		$this->X_Agenda_Model->updateData($data, $obj->row()->ID);
    	
    		setcookie("views-".$obj->row()->ID, "true", time() + 900);
    	}
    	
    	$this->load->model('X_Download_Model');
    	$this->load->model('X_News_Model');
    	
    	//Related Content
    	$data = array(
    			'pageTitle' 	=> 'Agenda: '.$obj->row()->TITLE,
    			'content'	 	=> 'front/agenda/agenda-detail',
    			'contentData'	=> array(
    					'pages'		=> $obj->row(),
    					'listRegulasi'	=> $this->X_Download_Model->getListData(10, 0, "RE", "A"),
    					'listProduk'	=> $this->X_News_Model->getNewArtikelLimit("D")
    			)
    	);
    	
    	$this->load->view('front/layout', $data);
    }
}

/* End of file agenda.php */
/* Location: ./application/controllers/agenda.php */