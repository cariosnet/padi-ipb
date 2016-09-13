<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function Home(){
		parent::__construct();	
		$this->load->model('X_Pages_Model');
	}

	function index(){
		$this->load->model('X_News_Model');
		$this->load->model('X_Ads_Model');
		$this->load->model('X_Ads_Position_Model');
		$this->load->model('X_Download_Model');
		$this->load->model('X_Poto_Gal_Model');
		$this->load->model('program_model');
		$this->load->model('link_model');
		$this->load->model('eksternal/Phpbb_Posts_Model', 'Phpbb_Posts_Model');
		
		$this->load->library('newslogic');
		
    	$data = array(
    			'pageTitle' 	=> $this->bogcamp->getSetting(1).' | '.$this->bogcamp->getSetting(2),
    			'content'	 	=> 'front/home/home',
    			'contentData'	=> array(
    					'listHeadline'		=> $this->X_News_Model->getListNews(4, 0, "N", "A", 1),
    					'listParent'		=> $this->X_News_Category_Model->getListCat(),
				    	'listLatestNews'	=> $this->X_News_Model->getListNews(6, 0, "N", "A"),
    					'listFokus'			=> $this->X_News_Model->getListNews(2, 0, "F", "A"),
    					'listDialog'		=> $this->X_News_Model->getListNews(1, 0, "D", "A"),
    					'listRegulasi'	=> $this->X_Download_Model->getListData(7, 0, "RE", "A"),
    					
    					'listDokumen'	=> $this->X_Download_Model->getListData(7, 0, "DO", "A"),
    					
//     					'listForum'			=> $this->Phpbb_Posts_Model->getListThreads(),
//     					'listAds'			=> $this->X_Ads_Model->getListAds(5, 0, date('Y-m-d'), "AKTIF"),
//     					'listBanner'		=> $this->X_Ads_Position_Model->getListPositionBannerJoinFront(1, "a"),
//     					'listBannerSide'	=> $this->X_Ads_Position_Model->getListPositionBannerJoinFront(1, "b"),
    					'listProgram'	 => $this->program_model->getListPages(),
    					'linkList'	=> $this->link_model->getAllCategory(),
                        'listFoto'	=> $this->X_Poto_Gal_Model->getListPotobyCateg(),
                        'listAllFoto' => $this->X_Poto_Gal_Model->getListPoto(),

    					'listArtikel' => $this->X_News_Model->getNewArtikelLimit("A"),
    					'listReferensi' => $this->X_News_Model->getNewArtikelLimit("R"),
    					'listJalanJalan' => $this->X_News_Model->getNewArtikelLimit("J"),
    					'listSerbaSerbi' => $this->X_News_Model->getNewArtikelLimit("S"),
    					'listPpkt' => $this->X_News_Model->getNewArtikelLimit("P"),
    					'listProduk'	=> $this->X_News_Model->getNewArtikelLimit("D")
    			)
    	);
    	
    	$this->load->view('front/layout', $data);
    }

    function upbs(){
        $this->load->model('X_Wilayah_Model');
        $data = array(
            'pageTitle' 	=> $this->bogcamp->getSetting(1).' | '.$this->bogcamp->getSetting(2),
            'content'	 	=> 'front/maps/upbs',
            'contentData'	=> array(
                'sebaran'		=> $this->X_Wilayah_Model->getListWilayah(NULL)
            )
        );

        $this->load->view('front/layout', $data);
    }

    function news(){
        $data = array(
            'pageTitle' 	=> $this->bogcamp->getSetting(1).' | '.$this->bogcamp->getSetting(2),
            'content'	 	=> 'front/news/index',
            'contentData'	=> array(

            )
        );

        $this->load->view('front/layout', $data);
    }

    function penangkaran(){
        $data = array(
            'pageTitle' 	=> $this->bogcamp->getSetting(1).' | '.$this->bogcamp->getSetting(2),
            'content'	 	=> 'front/penangkaran/index',
            'contentData'	=> array(

            )
        );

        $this->load->view('front/layout', $data);
    }

    function news_detail(){
        $data = array(
            'pageTitle' 	=> $this->bogcamp->getSetting(1).' | '.$this->bogcamp->getSetting(2),
            'content'	 	=> 'front/news/detail',
            'contentData'	=> array(

            )
        );

        $this->load->view('front/layout', $data);
    }

    function budidaya(){
        $this->load->model('X_News_Model');

        $data = array(

            'pageTitle' 	=> $this->bogcamp->getSetting(1).' | '.$this->bogcamp->getSetting(2),
            'content'	 	=> 'front/budidaya/index',
            'contentData'	=> array(
                'budidaya' => $this->X_News_Model->getBudidaya()
            )
        );

        $this->load->view('front/layout', $data);
    }
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */