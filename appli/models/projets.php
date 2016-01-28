<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Projets extends CI_Model {

    private $table = 'projet';
    
    public function getAll(){
        
        $projets = $this->db->select('*')
                             ->from($this->table)
                             ->get()
                             ->result();
        
        return $projets;
    }
    
    public function constructeur($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $projet = $this->db->select('*')
                             ->from($this->table)
                             ->where('id',$id)
                             ->limit(1)
                             ->get()
                             ->result();
        
        return $projet;
    }
    
    public function getFromUrl($nom = ""){
        
        if($nom == ""){
            return false;
        }
        
        $projet = $this->db->select('*')
                             ->from($this->table)
                             ->where('url',$nom)
                             ->limit(1)
                             ->get()
                             ->result();
        
        return $projet;
    }
    
    public function add($data = ''){
        
        if($data == ''){
            return false;
        }
        
        $result = new stdClass();
        $result->query = $this->db->insert($this->table, $data);
        return $this->db->insert_id();
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
