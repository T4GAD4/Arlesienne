<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Programmes extends CI_Model {

    private $table = 'programme';
    
    public function add($data = ''){
        
        if($data == ''){
            return false;
        }
        
        $result = new stdClass();
        $result->query = $this->db->insert($this->table, $data);
        $result->id = $this->db->insert_id();
        return $result;
    }
    
    public function getFromProjet($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $projet = $this->db->select('*')
                             ->from($this->table)
                             ->where('idProjet',$id)
                             ->get()
                             ->result();
        
        return $projet;
    }
    
}
