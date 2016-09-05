<?php
class Link_model extends CI_Model{
	private $table = "link";
	function __construct(){
		parent::__construct();
	}
	
	function getAll(){
		$this->db->select('link.*,link_kategori.nama_kategori');
		$this->db->join('link_kategori','link_kategori.id = link.link_kategori','inner');
		return $this->db->get($this->table);
	}
	
	function getAllCategory(){
		return $this->db->get('link_kategori');
	}
	
	function getLinkByCategory($kategoriId){
		$this->db->where('link_kategori',$kategoriId);
		return $this->db->get($this->table);
	}
	
	function save($dataInsert){
		return $this->db->insert($this->table, $dataInsert);
	}
	
	function update($id, $dataInsert){
		$this->db->where('id', $id);
		return $this->db->update($this->table,$dataInsert);
	}
	
	function getLinkById($id){
		$this->db->where('id',$id);
		return $this->db->get($this->table)->row();
	}
	function deleteLink($id){
		$this->db->where('id',$id);
		return $this->db->delete($this->table);
	}
	
	function saveKategori($dataInsert){
		return $this->db->insert('link_kategori', $dataInsert);
	}
	
	function updateKategori($id, $dataInsert){
		$this->db->where('id', $id);
		return $this->db->update('link_kategori',$dataInsert);
	}
	
	function getKategoriById($id){
		$this->db->where('id',$id);
		return $this->db->get('link_kategori')->row();
	}
	function deleteKategori($id){
		$this->db->where('id',$id);
		return $this->db->delete('link_kategori');
	}
}