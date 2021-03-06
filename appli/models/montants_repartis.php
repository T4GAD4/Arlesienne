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
    
    public function delete($data = '') {

        if ($data == '') {
            return false;
        }

        $result = $this->db->delete($this->table, array('id' => $data));

        return $result;
    }
    
    public function getFromFacture($id = 0) {

        if ($id == 0) {
            return false;
        }

        $regle = $this->db->select('*')
                ->from($this->table)
                ->where('idFacture', $id)
                ->get()
                ->result();

        return $regle;
    }
    
    public function getFromFactureAndMarche($id = 0, $idMarche = 0) {

        if ($id == 0 && $idMarche == 0) {
            return false;
        }

        $regle = $this->db->select('*')
                ->from($this->table)
                ->where('idFacture', $id)
                ->where('idMarche', $idMarche)
                ->get()
                ->result();

        return $regle;
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
    
    public function countFromFacture($id = 0) {

        if ($id == 0) {
            return false;
        }

        $regle = $this->db->select('sum(montant) as montant')
                ->from($this->table)
                ->where('idFacture', $id)
                ->get()
                ->result();

        return $regle;
    }
    
    public function countFromAvenant($id = 0) {

        if ($id == 0) {
            return false;
        }

        $regle = $this->db->select('sum(montant) as montant')
                ->from($this->table)
                ->where('idAvenant', $id)
                ->get()
                ->result();

        return $regle;
    }
    
    public function countNbFacturesFromAvenant($id = 0) {

        if ($id == 0) {
            return false;
        }

        $regle = $this->db->select('count(*) as nombre')
                ->from($this->table)
                ->where('idAvenant', $id)
                ->get()
                ->result();

        return $regle;
    }
    
}
