<?php
/**
 * Created by PhpStorm.
 * User: muhammadzulfaf
 * Date: 8/28/16
 * Time: 01:36
 */
class X_Penangkar_Model extends CI_Model{
    private $table = "X_PENANGKAR";

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function insertPenangkar($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function updatePenangkar($data, $id){
        $this->db->where('ID', $id);
        $this->db->update($this->table, $data);
    }

    function getPenangkarById($id){
        return $this->db->get_where($this->table,array('ID' => $id));
    }

    function getPagesByAlias($alias){
        return $this->db->get_where($this->table,array('ALIAS' => $alias));
    }

    function delPenangkar($id){
        $this->db->where('ID', $id);
        $this->db->delete($this->table);

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return true;
        }
    }

    function getListJoinPenangkar($status = null){
        $this->db->select(array("X_LEMBAGA.INSTITUTION_NAME","X_PENANGKAR.*"));
        $this->db->join("X_LEMBAGA","X_LEMBAGA.ID=X_PENANGKAR.ID_INSTITUTION","inner");
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