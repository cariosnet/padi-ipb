<?php
/**
 * Created by PhpStorm.
 * User: muhammadzulfaf
 * Date: 8/28/16
 * Time: 01:36
 */
class X_Benih_Model extends CI_Model{
    private $table = "X_BENIH";

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function insertSebaran($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function updateSebaran($data, $id){
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
    }

    function getSebaranById($id){
        return $this->db->get_where($this->table,array('id' => $id));
    }

    function getPagesByAlias($alias){
        return $this->db->get_where($this->table,array('ALIAS' => $alias));
    }

    function getListJoin(){
        $this->db->select(array("X_LEMBAGA.INSTITUTION_NAME","X_LEMBAGA.REGION","X_STOK.*","X_BENIH.NAMA_BENIH","X_BENIH.BS","X_BENIH.FS","X_BENIH.SS"));
        $this->db->join("X_LEMBAGA","X_LEMBAGA.ID=X_STOK.ID_INSTITUTION","inner");
        $this->db->join("X_BENIH","X_BENIH.ID=X_STOK.ID_BENIH","inner");
        $this->db->order_by("INSTITUTION_NAME", "asc");
        $this->db->order_by("REGION", "asc");
        return $this->db->get($this->table);
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

    function getListBenih(){
        $this->db->order_by("NAMA_BENIH", "asc");
        return $this->db->get($this->table);
    }

    function getListSebaranByWilayah($parent){
        //if($status != null)$this->db->where('STATUS', $status);

        $this->db->where('ID_WILAYAH', $parent);

        $this->db->order_by("name", "asc");
        return $this->db->get($this->table);
    }

    function getListNavigation($status = null){
        $this->db->where('PARENT', null);
        $this->db->order_by("ORDER", "asc");
        $this->db->order_by("TITLE", "asc");

        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0)
        {
            $result = $query->result_array();
            foreach (array_keys($result) as $key)
            {
                $result[$key]['child'] = $this->getListPagesByParent($result[$key]['ID'], null);
                $result[$key]['child_count'] = $this->db->where('PARENT', $result[$key]['ID'])->from($this->table)->count_all_results();
            }
            return $result;
        }
    }
}