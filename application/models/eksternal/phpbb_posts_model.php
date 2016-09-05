<?php
class Phpbb_Posts_Model extends CI_Model {
	private $table = "phpbb_posts";
	
	function getListThreads(){
		$this->db->order_by("post_time", "desc");
		return $this->db->get($this->table, 5, 0);
	}
}