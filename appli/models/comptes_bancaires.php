<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comptes_bancaires extends CI_Model {

    private $table = 'comptes_bancaires';
    
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
    
    public function modify($data = '', $id = 0){
        
        if($data == '' || $id == 0){
            return false;
        }
        $result =    $this->db->where('id', $id);
                     $this->db->update($this->table, $data); 
        return $result;
    }
    
    public function getFromSociete($idSociete = 0){
        
        if($idSociete == 0){
            return false;
        }
        
        $comptes = $this->db->select('*')
                                  ->from($this->table)
                                  ->where('idSociete',$idSociete)
                                  ->get()
                                  ->result();
        return $comptes;
    }
    
    public function getCompte($id = 0){
        
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
    
}
