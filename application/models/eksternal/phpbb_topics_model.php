<?php
class Phpbb_Topics_Model extends CI_Model {
	private $table = "phpbb_topics";
	
	function getListThreads(){
		$this->db->order_by("topic_time", "desc");
		return $this->db->get($this->table, 5, 0);
	}
}