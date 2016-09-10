<?php
/**
 * Created by PhpStorm.
 * User: muhammadzulfaf
 * Date: 8/28/16
 * Time: 01:36
 */
class X_Stok_Model extends CI_Model{
    private $table = "X_STOK";

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function insertStok($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function updateStok($data, $id){
        $this->db->where('ID', $id);
        $this->db->update($this->table, $data);
    }

    function getStokById($id){
        return $this->db->get_where($this->table,array('ID' => $id));
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

    function delStok($id){

        $this->db->where('ID', $id);
        $this->db->delete($this->table);

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return true;
        }
    }

    function getListInstitution($status = null){
        $this->db->join("X_STATUS","X_LEMBAGA.ID_STATUS=X_STATUS.ID","inner");
        if($status != null)$this->db->where('STATUS', $status);
        $this->db->order_by("INSTITUTION_NAME", "asc");
        $this->db->order_by("REGION", "asc");
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