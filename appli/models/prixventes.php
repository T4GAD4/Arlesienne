<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Prixventes extends CI_Model {

    private $table = 'prixvente';
    
    public function constructeur($id){
        
        $ventes = $this->db->select('*')
                             ->from($this->table)
                             ->where('id',$id)
                             ->limit(1)
                             ->get()
                             ->result();
        
        return $ventes;
    }    
    
    public function getFromVente($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $vente = $this->db->select('*')
                             ->from($this->table)
                             ->where('idVente',$id)
                             ->order_by('id', 'ASC')
                             ->get()
                             ->result();
        
        return $vente;
    }
    
    public function getFromVentePrixCompromis($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $vente = $this->db->select('*')
                             ->from($this->table)
                             ->where('idVente',$id)
                             ->where('etat','compromis')
                             ->order_by('id', 'ASC')
                             ->get()
                             ->result();
        
        return $vente;
    }
    
    public function getFromVentePrixActe($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $vente = $this->db->select('*')
                             ->from($this->table)
                             ->where('idVente',$id)
                             ->where('etat','acte')
                             ->order_by('id', 'ASC')
                             ->get()
                             ->result();
        
        return $vente;
    }
    
    public function getAll(){
        
        $ventes = $this->db->select('*')
                             ->from($this->table)
                             ->get()
                             ->result();
        
        return $ventes;
    }
    
    public function getFromProjet($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $vente = $this->db->select('*')
                             ->from($this->table)
                             ->where('idProjet',$id)
                             ->get()
                             ->result();
        
        return $vente;
    }
    
     public function creer($data = ''){
        
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
    
    public function delete($data = ''){
        
        if($data == ''){
            return false;
        }
        
        $result = $this->db->delete($this->table, array('id' => $data)); 
        
        return $result;
    }
    
}
