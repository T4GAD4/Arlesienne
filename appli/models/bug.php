<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bug extends CI_Model {

    protected $table = 'bugs';
    
    public function getCategories(){
        
        $categories = $this->db->select('categorie')
                               ->from($this->table)
                               ->distinct()
                               ->get()
                               ->result();
        
        return $categories;
    }
    
    public function getUrgences(){
        
        $urgences = $this->db->select('urgence')
                               ->from($this->table)
                               ->distinct()
                               ->get()
                               ->result();
        
        return $urgences;
    }
    
    public function countCategorie($categorie){
        $nb = $this->db->select('count(*) as nombre')
                           ->from($this->table)
                           ->where('categorie', $categorie)
                           ->get()
                           ->result();
        
        return $nb;
    }
    
    public function countUrgence($urgence){
        $nb = $this->db->select('count(*) as nombre')
                           ->from($this->table)
                           ->where('urgence', $urgence)
                           ->get()
                           ->result();
        
        return $nb;
    }
    
    public function getFromCategorie($categorie){        
        $bugs = $this->db->select('*')
                           ->from($this->table)
                           ->where('categorie', $categorie)
                           ->get()
                           ->result();
        
        return $bugs;
    }
    
    public function insert($data=''){
        if($data=='')
            return false;
        $bug = $this->db->insert($this->table,$data);
        return $bug;
    }

    public function update($data){
        $this->db->where('id',$data->id);
        $bug = $this->db->update($this->table,$data);
        return $bug;
    }
    
    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete($this->table); 
    }

}
