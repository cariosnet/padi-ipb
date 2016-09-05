<?php
class Program_model extends CI_Model{
	private $table = "program";
	
	function __construct(){
		// Call the Model constructor
		parent::__construct();
	}
	
	function insertPages($data){
		$this->db->where('PARENT', $data['PARENT']);
		$countOrder = $this->db->get($this->table);
		$count = $countOrder->num_rows() + 1;
		if($data['ORDER'] > $count){
			$data['ORDER'] = $count;
		}
	
		$this->db->where('PARENT', $data['PARENT']);
		$this->db->where('ORDER >= ', $data['ORDER']);
		$dat = $this->db->get($this->table);
	
		foreach ($dat->result() as $row){
			$upd['ORDER'] = $row->ORDER + 1;
			$this->db->where('ID',$row->ID);
			$this->db->update($this->table, $upd);
		}
	
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	function updatePages($data, $id, $orderOld){
		$this->db->where('PARENT', $data['PARENT']);
		$countOrder = $this->db->get($this->table);
		$count = $countOrder->num_rows() + 1;
		if($data['ORDER'] > $count){
			$data['ORDER'] = $count;
		}
	
		if($data['ORDER'] < $orderOld){
			$this->db->where('PARENT', $data['PARENT']);
			$this->db->where('ORDER >= ', $data['ORDER']);
			$this->db->where('ORDER < ',$orderOld);
			$dat = $this->db->get($this->table);
				
			foreach ($dat->result() as $row){
				$upd['ORDER'] = $row->ORDER + 1;
				$this->db->where('ID',$row->ID);
				$this->db->update($this->table, $upd);
			}
		}elseif ($data['ORDER'] > $orderOld){
			$this->db->where('PARENT', $data['PARENT']);
			$this->db->where('ORDER <= ', $data['ORDER']);
			$this->db->where('ORDER > ',$orderOld);
			$dat = $this->db->get($this->table);
	
			foreach ($dat->result() as $row){
				$upd['ORDER'] = $row->ORDER - 1;
				$this->db->where('ID',$row->ID);
				$this->db->update($this->table, $upd);
			}
		}
	
		$this->db->where('ID', $id);
		$this->db->update($this->table, $data);
	}
	
	function getPagesById($id){
		return $this->db->get_where($this->table,array('ID' => $id));
	}
	
	function getPagesByAlias($alias){
		return $this->db->get_where($this->table,array('ALIAS' => $alias));
	}
	
	function delPages($id){
		$this->db->where('ID', $id);
		$order = $this->db->get($this->table);
		$ord = $order->row();
	
		$this->db->where('ORDER > ',$ord->ORDER);
		$this->db->where('PARENT', $ord->PARENT);
		$dat = $this->db->get($this->table);
		foreach ($dat->result() as $row){
			$upd['ORDER'] = $row->ORDER - 1;
			$this->db->where('ID', $row->ID);
			$this->db->update($this->table, $upd);
		}
	
		$this->db->where('PARENT', $id);
		$this->db->delete($this->table);
	
		$this->db->where('ID', $id);
		$this->db->delete($this->table);
	
		if ($this->db->trans_status() === FALSE){
			return false;
		}else{
			return true;
		}
	}
	
	function getListPages($status = null){
		if($status != null)$this->db->where('STATUS', $status);
		$this->db->order_by("ORDER", "asc");
		$this->db->order_by("TITLE", "asc");
		return $this->db->get($this->table);
	}
	
	function getListPagesByParent($parent, $status = null){
		if($status != null)$this->db->where('STATUS', $status);
	
		$this->db->where('PARENT', $parent);
	
		$this->db->order_by("ORDER", "asc");
		$this->db->order_by("TITLE", "asc");
		return $this->db->get($this->table);
	}
}