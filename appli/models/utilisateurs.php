<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Utilisateurs extends CI_Model {

    private $table = 'utilisateur';
    
    public function getAll(){
        
        $utilisateurs = $this->db->select('*')
                             ->from($this->table)
                             ->get()
                             ->result();
        
        return $utilisateurs;
    }
    
    public function getRaccourcis($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $raccourcis = $this->db->select('favoris')
                             ->from($this->table)
                             ->where('id',$id)
                             ->get()
                             ->result();
        
        return $raccourcis;
    }
    
    public function personnaliser($data = '', $id = 0){
        
        if($id == 0){
            return false;
        }
        
        $result = $this->db->query('UPDATE `utilisateur` SET `style` = \''.$data.'\' WHERE `id` = '.$id);
        
        return $result;
    }
    
    public function updateFavoris($data = '', $id = 0){
        
        if($id == 0){
            return false;
        }
        
        $result = $this->db->query('UPDATE `utilisateur` SET `favoris` = \''.$data.'\' WHERE `id` = '.$id);
        
        return $result;
    }
    
    public function updateInterface($data = '', $id = 0){
        
        if($id == 0){
            return false;
        }
        
        $result = $this->db->query('UPDATE `utilisateur` SET `interface` = \''.$data.'\' WHERE `id` = '.$id);
        
        return $result;
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
    
    public function getUser($pseudo){
        
        $utilisateur = $this->db->select('*')
                             ->from($this->table)
                             ->where('pseudo',$pseudo)
                             ->limit(1)
                             ->get()
                             ->result();
        
        return $utilisateur;
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
    
    public function update($data = '', $id = 0){
        
        if($data == '' || $id == 0){
            return false;
        }
        
        $result = new stdClass();
        $result =    $this->db->where('id', $id);
                            $this->db->update($this->table, $data); 
        return $result;
    }
    
}
