<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Avenants extends CI_Model {

    private $table = 'avenants';
    
    public function constructeur($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $compte = $this->db->select('*')
                                  ->from($this->table)
                                  ->where('id',$id)
                                  ->limit(1)
                                  ->get()
                                  ->result();
        return $compte;
    }
    
    public function getFromMarches($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $avenant = $this->db->select('*')
                                  ->from($this->table)
                                  ->where('idMarche',$id)
                                  ->get()
                                  ->result();
        return $avenant;
    }
    
    public function creer($data = ''){
        
        if($data == ''){
            return false;
        }
        
        $result = new stdClass();
        $result->query = $this->db->insert($this->table, $data);
        $result->id = $this->db->insert_id();
        return $result;
    }
    
    public function delete($data = ''){
        
        if($data == ''){
            return false;
        }
        
        $result = $this->db->delete($this->table, array('id' => $data)); 
        
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
    
    public function countAllFromMarche($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $avenants = $this->db->select('count(*) as nombre')
                                  ->from($this->table)
                                  ->where('idMarche',$id)
                                  ->get()
                                  ->result();
        return $avenants;
    }
    
}
