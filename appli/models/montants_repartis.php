<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Montants_repartis extends CI_Model {

    private $table = 'montant_reparti';
    
    public function getAll(){
        
        $utilisateurs = $this->db->select('*')
                             ->from($this->table)
                             ->get()
                             ->result();
        
        return $utilisateurs;
    }
    
    public function getId($id){
        
        $utilisateur = $this->db->select('*')
                             ->from($this->table)
                             ->where('id',$id)
                             ->limit(1)
                             ->get()
                             ->result();
        
        return $utilisateur;
    }
    
    public function getFromMarches($id){
        
        $montants = $this->db->select('*')
                             ->from($this->table)
                             ->where('idMarche',$id)
                             ->get()
                             ->result();
        
        return $montants;
    }
    
    
    
    
    public function add($data = ''){
        
        if($data == ''){
            return false;
        }
        
        $result = new stdClass();
        $result->query = $this->db->insert($this->table, $data);
        $result->id = $this->db->insert_id();
        return $result;
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
