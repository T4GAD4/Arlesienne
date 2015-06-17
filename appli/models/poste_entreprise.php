<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Poste_entreprise extends CI_Model {

    private $table = 'poste_entreprise';
    
     public function creer($data = ''){
        
        if($data == ''){
            return false;
        }
        
        $result = $this->db->insert($this->table, $data);
        return $result;
    }
    
    public function getId($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $postes = $this->db->select('*')
                             ->from($this->table)
                             ->where('idContact',$id)
                             ->get()
                             ->result();
        
        return $postes;
    }
    
    public function delete($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $result = $this->db->delete($this->table, array('idContact' => $id)); 
        
        return $result;
    }
}
