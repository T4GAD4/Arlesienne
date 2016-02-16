<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lots extends CI_Model {

    private $table = 'lots';
    
    public function constructeur($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $lot = $this->db->select('*')
                                  ->from($this->table)
                                  ->where('id',$id)
                                  ->limit(1)
                                  ->get()
                                  ->result();
        return $lot;
    }
    
    public function getPrincipaux($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $lot = $this->db->select('*')
                                  ->from($this->table)
                                  ->where('idProjet',$id)
                                  ->where('type','principal')
                                  ->get()
                                  ->result();
        return $lot;
    }
    
    public function countAllFromProjet($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $lot = $this->db->select('count(*) as nombre')
                                  ->from($this->table)
                                  ->where('idProjet',$id)
                                  ->get()
                                  ->result();
        return $lot;
    }
    
    public function countByType($id = 0, $type = ""){
        
        if($id == 0 || $type == ""){
            return false;
        }
        
        $lot = $this->db->select('count(*) as nombre')
                                  ->from($this->table)
                                  ->where('idProjet',$id)
                                  ->where('type',$type)
                                  ->get()
                                  ->result();
        return $lot;
    }
    
    public function getSecondaires($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $lot = $this->db->select('*')
                                  ->from($this->table)
                                  ->where('idProjet',$id)
                                  ->where('type','secondaire')
                                  ->get()
                                  ->result();
        return $lot;
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
    
    
    public function update($data = '', $id = 0){
        
        if($data == '' || $id == 0){
            return false;
        }
        $result =    $this->db->where('id', $id);
                     $this->db->update($this->table, $data); 
        return $result;
    }
    
}
