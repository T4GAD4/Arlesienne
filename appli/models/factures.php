<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Factures extends CI_Model {

    private $table = 'factures';
    
    public function constructeur($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $facture = $this->db->select('*')
                                  ->from($this->table)
                                  ->where('id',$id)
                                  ->limit(1)
                                  ->get()
                                  ->result();
        return $facture;
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
    
    public function getAll(){
        
        $factures = $this->db->select('*')
                                  ->from($this->table)
                                  ->order_by('id','DESC')
                                  ->get()
                                  ->result();
        return $factures;
    }
    
    public function getFromProjet($id){
        
        $factures = $this->db->select('*')
                                  ->from($this->table)
                                  ->where('idProjet',$id)
                                  ->get()
                                  ->result();
        return $factures;
    }
        
}
