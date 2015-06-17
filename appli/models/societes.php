<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Societes extends CI_Model {

    private $table = 'societes';
    
    public function getAll(){
        
        $societes = $this->db->select('*')
                             ->from($this->table)
                             ->get()
                             ->result();
        
        return $societes;
    }
    
    public function delete($data = ''){
        
        if($data == ''){
            return false;
        }
        
        $result = $this->db->delete($this->table, array('id' => $data)); 
        
        return $result;
    }
    
    public function getSociete($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $societe = $this->db->select('*')
                             ->from($this->table)
                             ->where('id',$id)
                             ->limit(1)
                             ->get()
                             ->result();
        
        return $societe;
    }
    
    public function add($data = ''){
        
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
        
        $result = new stdClass();
        $result =    $this->db->where('id', $id);
                            $this->db->update($this->table, $data); 
        return $result;
    }
    
}
