<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fiches extends CI_Model {

    private $table = 'fiche_renseignement';
    
    public function getAll(){
        
        $fiches = $this->db->select('*')
                             ->from($this->table)
                             ->get()
                             ->result();
        
        return $fiches;
    }
    
    public function getFromContact($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $fiche = $this->db->select('*')
                             ->from($this->table)
                             ->where('idContact',$id)
                             ->limit(1)
                             ->get()
                             ->result();
        
        return $fiche;
    }
    
    public function rapprochement($secteur = ""){
        
        if($secteur == ""){
            return false;
        }
        
        $fiches = $this->db->select('*')
                             ->from($this->table)
                             ->like('secteur',$secteur)
                             ->get()
                             ->result();
        
        return $fiches;
    }
    
    public function insert($data = ''){
        
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
