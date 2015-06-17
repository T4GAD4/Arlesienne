<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Configurations extends CI_Model {

    private $table = 'configuration';
    
    public function getValeur($libelle){
        
        if($libelle == ''){
            return false;
        }
        
        $result = $this->db->select('*')
                           ->from($this->table)
                           ->where('libelle', $libelle)
                           ->limit(1)
                           ->get()
                           ->result();
        
        return $result;
    }
    
    public function update($libelle,$data){
        
        if($libelle == ''){
            return false;
        }
        
        $result = $this->db->query('UPDATE '.$this->table.'  SET `valeur` = "'.$data.'" WHERE `libelle` = "'.$libelle.'"');
        
        return $result;
    }
    
}
