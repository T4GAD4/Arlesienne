<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mouvements extends CI_Model {

    private $table = 'mouvements_comptes';
    
    public function get($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $mouvements = $this->db->select('*')
                             ->from($this->table)
                             ->where('id_compte',$id)
                             ->order_by('date','ASC')
                             ->get()
                             ->result();
        
        return $mouvements;
    }
}
