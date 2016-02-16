<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Previsionnels extends CI_Model {

    private $table = 'previsionnel';
    
    public function getFromProjet($id = 0){
        if($id == 0){
            return false;
        }
        
        $previs = $this->db->select('*')
                             ->from($this->table)
                             ->where('idProjet',$id)
                             ->get()
                             ->result();
        
        return $previs;
    }
    
    public function constructeur($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $previ = $this->db->select('*')
                             ->from($this->table)
                             ->where('id',$id)
                             ->limit(1)
                             ->get()
                             ->result();
        
        return $previ;
    }
    
    public function creer($data = ''){
        
        if($data == ''){
            return false;
        }
        
        $this->db->insert($this->table, $data);
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
