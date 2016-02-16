<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Entreprises extends CI_Model {

    private $table = 'entreprises';
    
    public function constructeur($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $entreprise = $this->db->select('*')
                                  ->from($this->table)
                                  ->where('id',$id)
                                  ->limit(1)
                                  ->get()
                                  ->result();
        return $entreprise;
    }
    
    public function getAll(){
        
        $contacts = $this->db->select('*')
                             ->from($this->table)
                             ->get()
                             ->result();
        
        return $contacts;
    }
    
    
     public function creer($data = ''){
        
        if($data == ''){
            return false;
        }
        
        $this->db->insert($this->table, $data);
        $result= $this->db->insert_id();
        return $result;
    }
    
    public function getId($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $entreprise = $this->db->select('*')
                             ->from($this->table)
                             ->where('id',$id)
                             ->limit(1)
                             ->get()
                             ->result();
        
        return $entreprise;
    }
}
