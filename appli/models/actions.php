<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Actions extends CI_Model {

    private $table = 'action_contacts';
    
    public function constructeur($id){
        
        $actions = $this->db->select('*')
                             ->from($this->table)
                             ->where('idContact',$id)
                             ->get()
                             ->result();
        
        return $actions;
    }
    
    public function getAll(){
        
        $actions = $this->db->select('*')
                             ->from($this->table)
                             ->get()
                             ->result();
        
        return $actions;
    }
    
    public function getId($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $action = $this->db->select('*')
                             ->from($this->table)
                             ->where('id',$id)
                             ->limit(1)
                             ->get()
                             ->result();
        
        return $action;
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
    
    public function delete($data = ''){
        
        if($data == ''){
            return false;
        }
        
        $result = $this->db->delete($this->table, array('id' => $data)); 
        
        return $result;
    }
    
}
