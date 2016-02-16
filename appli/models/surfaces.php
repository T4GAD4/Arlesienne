<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Surfaces extends CI_Model {

    private $table = 'surfaces';
    
    public function constructeur($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $surface = $this->db->select('*')
                                  ->from($this->table)
                                  ->where('id',$id)
                                  ->limit(1)
                                  ->get()
                                  ->result();
        return $surface;
    }
    
    public function getAllFromLot($idLot = 0){
        
        if($idLot == 0){
            return false;
        }
        
        $surface = $this->db->select('*')
                                  ->from($this->table)
                                  ->where('idLot',$idLot)
                                  ->get()
                                  ->result();
        return $surface;
    }
    
    public function insert($data = ''){
        
        if($data == ''){
            return false;
        }
        
        $result = new stdClass();
        $result->query = $this->db->insert($this->table, $data);
        $result->id = $this->db->insert_id();
        return $result;
    }
    
    
    public function modify($data = '', $id = 0){
        
        if($data == '' || $id == 0){
            return false;
        }
        $result =    $this->db->where('id', $id);
                     $this->db->update($this->table, $data); 
        return $result;
    }
    
    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete($this->table); 
    }
    
}
