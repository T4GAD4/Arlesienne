<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Marche_programme extends CI_Model {

    private $table = 'marcheprogramme';
    
     public function creer($data = ''){
        
        if($data == ''){
            return false;
        }
        
        $result = $this->db->insert($this->table, $data);
        return $result;
    }
    
    public function delete($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $result = $this->db->delete($this->table, array('idMarche' => $id)); 
        
        return $result;
    }
}
