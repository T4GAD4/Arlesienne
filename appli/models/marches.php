<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Marches extends CI_Model {

    private $table = 'marches';
    
    public function constructeur($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $marche = $this->db->select('*')
                             ->from($this->table)
                             ->where('id',$id)
                             ->limit(1)
                             ->get()
                             ->result();
        
        return $marche;
    }
    
    public function add($data = ''){
        
        if($data == ''){
            return false;
        }
        
        $result = new stdClass();
        $result->query = $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    
    public function getFromProjet($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $marches = $this->db->select('*')
                             ->from($this->table)
                             ->where('idProjet',$id)
                             ->order_by('nom ASC')
                             ->get()
                             ->result();
        
        return $marches;
    }
    
    public function getProgrammes($id = 0){
        
        
        $categories = $this->db->select('*')
                             ->from('marcheprogramme')
                             ->where('idMarche',$id)
                             ->get()
                             ->result();
        
        $programmes = Array();
        
        foreach($categories as $categorie){
            $programme = $this->db->select('nom')
                             ->from('programme')
                             ->where('idProgramme',$categorie->idProgramme)
                             ->get()
                             ->result();
            array_push($programmes, $programme[0]->nom);
        }
        
        return $programmes;
    }
    
    public function getCategorie($id = 0){
        
        
        $categories = $this->db->select('categorie as nom')
                             ->from($this->table)
                             ->where('idProjet',$id)
                             ->group_by('categorie')
                             ->order_by('categorie DESC')
                             ->get()
                             ->result();
        
        return $categories;
    }
    
    public function countSignes($id = 0){
        
        
        $categories = $this->db->select('count(*) as nb')
                             ->from($this->table)
                             ->where('idProjet',$id)
                             ->where('devise','true')
                             ->get()
                             ->result();
        
        return $categories;
    }
    
    public function update($data = '', $id = 0){
        
        if($data == '' || $id == 0){
            return false;
        }
        
        $this->db->where('id', $id);
        $result = $this->db->update($this->table, $data); 
        return $result;
    }
}