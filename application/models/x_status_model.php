<?php
/**
 * Created by PhpStorm.
 * User: muhammadzulfaf
 * Date: 8/28/16
 * Time: 04:12
 */

class X_Status_Model extends CI_Model{
    private $table = "X_STATUS";

    function __construct(){
        // Call the Model constructor
        parent::__construct();
    }

    function getListStatus(){
        $this->db->order_by("STATUS", "asc");
        return $this->db->get($this->table);
    }
}