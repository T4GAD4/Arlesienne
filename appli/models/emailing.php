<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Emailing extends CI_Model {

    private $table = 'email';
    
     public function insert($data = ''){
        
        if($data == ''){
            return false;
        }
        
        $result = $this->db->insert($this->table, $data);
        return $result;
    }
    
 
     public function getAll(){
        
        $result = $this->db->select('*')
                 ->from($this->table)
                 ->order_by('id','DESC')
                 ->get()
                 ->result();
        
        return $result;
    }
    
     public function get($email = ""){
        
         $email .= "@saint-roch-habitat.fr";
         
        $result = $this->db->select('*')
                 ->from($this->table)
                 ->where('expediteur',$email)
                 ->order_by('id','DESC')
                 ->get()
                 ->result();
        
        return $result;
    }
    
    public function getExpediteur(){
        
        $result = $this->db->select('expediteur')
                ->from($this->table)
                ->distinct()
                 ->get()
                 ->result();
        
        return $result;
    }
    public function constructeur($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $email = $this->db->select('*')
                             ->from($this->table)
                             ->where('id',$id)
                             ->limit(1)
                             ->get()
                             ->result();
        
        return $email;
    }
}
