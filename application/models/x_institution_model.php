<?php
/**
 * Created by PhpStorm.
 * User: muhammadzulfaf
 * Date: 8/28/16
 * Time: 01:36
 */
class X_Institution_Model extends CI_Model{
    private $table = "X_LEMBAGA";

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function insertInstitution($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function updateInstitution($data, $id){
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

    function getListInstitution($status = null){
        $this->db->join("X_STATUS","X_LEMBAGA.ID_STATUS=X_STATUS.ID","inner");
        if($status != null)$this->db->where('STATUS', $status);
        $this->db->order_by("INSTITUTION_NAME", "asc");
        $this->db->order_by("REGION", "asc");
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