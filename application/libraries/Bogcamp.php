<?php
Class Bogcamp{
	
	var $CI = NULL;
	
	function __construct(){
        $this->CI =& get_instance();
    }
    
    /**
     * 
     * @param String $string
     * @param Obj Model untuk ngecek alias $obj
     * @return string
     */
	function createAlias($string, $obj){
		$newString = strtolower(preg_replace(array('/[\-]+$/', '/[\s\W]+/', '/\s[\s]+/', '/^[\-]+/', '/\&/', '/\%/', '/\@/'), '-', $string));
		if($obj->num_rows() > 0){
			return $newString.'_'.date('YmdHis');
		}else{
			return $newString;
		}
	}
	
	function convertDate($date){
		return $this->getDayName($date).', '.date('d', strtotime($date)).' '.$this->getMonthName($date).' '.date('Y | H:i', strtotime($date)).' WIB';
	}
	
	function getDayName($date){
		$x = date('N', strtotime($date));
		
		$dayNames = array(
				'Senin',
				'Selasa',
				'Rabu',
				'Kamis',
				'Jum\'at',
				'Sabtu',
				'Minggu',
		);
		
		return $dayNames[$x - 1];
	}
	
	function getMonthName($date){
		$x = date('n', strtotime($date));
	
		$monthNames = array(
				'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
		);
	
		return $monthNames[$x - 1];
	}
	
	public function substr($string, $limit){
		$string = str_replace(array("\n", "\r"), "", $string);
		
		if(strlen($string) > $limit){
			return substr($string, 0, $limit).'...';
		}else{
			return $string;
		}
	}
	
	public function getFullUrlRequest(){
		$return = $this->CI->config->site_url().$this->CI->uri->uri_string();
		if(count($_GET) > 0)
		{
			$get =  array();
			foreach($_GET as $key => $val)
			{
				$get[] = $key.'='.$val;
			}
			$return .= '?'.implode('&',$get);
		}
		return $return;
	}
	
	public function getListPages(){
		$this->CI->load->model("X_Pages_Model");
		return $this->CI->X_Pages_Model->getListPages("A");
	}
	
	public function getSetting($id){
		$this->CI->load->model("X_Setting_Model");
		return $this->CI->X_Setting_Model->getSettingById($id)->row()->VALUE;
	}
}