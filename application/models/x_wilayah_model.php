<?php
/**
 * Created by PhpStorm.
 * User: muhammadzulfaf
 * Date: 8/28/16
 * Time: 01:36
 */
class X_Wilayah_Model extends CI_Model{
    private $table = "X_WILAYAH";

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function insertWilayah($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function updateWilayah($data, $id){
        $this->db->where('ID', $id);
        $this->db->update($this->table, $data);
    }

    function getWilayahById($id){
        return $this->db->get_where($this->table,array('ID' => $id));
    }

    function getPagesByAlias($alias){
        return $this->db->get_where($this->table,array('ALIAS' => $alias));
    }

    function delWilayah($id){

        $this->db->where('ID', $id);
        $this->db->delete($this->table);

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return true;
        }
    }

    function getListWilayah($search = null){
        if($search != null)$this->db->where('NAME', $search);
        $this->db->order_by("NAME", "asc");
        return $this->db->get($this->table);
    }

    function getListPagesByParent($parent, $status = null){
        if($status != null)$this->db->where('STATUS', $status);

        $this->db->where('PARENT', $parent);

        $this->db->order_by("ORDER", "asc");
        $this->db->order_by("TITLE", "asc");
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