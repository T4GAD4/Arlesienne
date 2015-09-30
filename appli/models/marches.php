<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Marches extends CI_Model {

    private $table = 'marches';
    
    public function add($data = ''){
        
        if($data == ''){
            return false;
        }
        
        $result = new stdClass();
        $result->query = $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function getFromProgramme($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $marches = $this->db->select('*')
                             ->from($this->table)
                             ->where('idProgramme',$id)
                             ->order_by('nom ASC')
                             ->get()
                             ->result();
        
        return $marches;
    }
    
    public function getCategorie(){
        
        
        $categories = $this->db->select('categorie')
                             ->from($this->table)
                             ->group_by('categorie')
                             ->order_by('categorie DESC')
                             ->get()
                             ->result();
        
        return $categories;
    }
}