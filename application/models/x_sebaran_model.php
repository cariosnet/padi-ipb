<?php
/**
 * Created by PhpStorm.
 * User: muhammadzulfaf
 * Date: 8/28/16
 * Time: 01:36
 */
class X_Sebaran_Model extends CI_Model{
    private $table = "X_PESEBARAN";

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

    function delSebaran($id){


        $this->db->where('id', $id);
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