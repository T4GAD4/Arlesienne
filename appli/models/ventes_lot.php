<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ventes_lot extends CI_Model {

    private $table = 'vente_lot';
    
    public function constructeur($id){
        
        $ventes = $this->db->select('*')
                             ->from($this->table)
                             ->where('id',$id)
                             ->limit(1)
                             ->get()
                             ->result();
        
        return $ventes;
    }
    
    public function getAll(){
        
        $ventes = $this->db->select('*')
                             ->from($this->table)
                             ->get()
                             ->result();
        
        return $ventes;
    }
    
    public function getFromVente($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $vente = $this->db->select('idLot')
                             ->from($this->table)
                             ->where('idVente',$id)
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
    
   public function deleteAllVentes($data = ''){
        
        if($data == ''){
            return false;
        }
        
        $result = $this->db->delete($this->table, array('idVente' => $data)); 
        
        return $result;
    }
}
