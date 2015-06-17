<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contacts extends CI_Model {

    private $table = 'contact';
    
    public function getAll(){
        
        $contacts = $this->db->select('*')
                             ->from($this->table)
                             ->get()
                             ->result();
        
        return $contacts;
    }
    
    public function getId($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $contact = $this->db->select('*')
                             ->from($this->table)
                             ->where('id',$id)
                             ->limit(1)
                             ->get()
                             ->result();
        
        return $contact;
    }
    
     public function creer($data = ''){
        
        if($data == ''){
            return false;
        }
        
        $this->db->insert($this->table, $data);
        $result= $this->db->insert_id();
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
