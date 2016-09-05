<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Server_Time extends CI_Controller {

	function Server_Time(){
		parent::__construct();
	}

	public function index(){
		$date = date("Y-m-d H:i:s");
		
		$data = array(
				'hari'		=> $this->bogcamp->getDayName($date),
				'tanggal' 	=> date('d', strtotime($date)).' '.$this->bogcamp->getMonthName($date).' '.date('Y', strtotime($date)),
				'waktu'	 	=> date('H:i:s')
		);

		echo json_encode($data);
	}
}

/* End of file server_time.php */
/* Location: ./application/controllers/services/server_time.php */