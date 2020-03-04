<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_base extends CI_Model {

    public function __construct(){
        parent::__construct();
    }
    public function create($data){
        //create the vendor into the database
        try{
            $this->db->insert($this->table,$data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }catch(Exception $e){
            return false;
        }
        
    }
    public function getRecord($condition){
        $this->db->where($condition);
        $query=$this->db->get($this->table);
        $result=$query->row_array();
        return $result;
    }
    public function updateRecord($condition,$data){
        $this->db->where($condition);
        $this->db->update($this->table,$data);
        return true;
    }

}