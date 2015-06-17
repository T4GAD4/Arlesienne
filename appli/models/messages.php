<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Messages extends CI_Model {

    private $table = 'messages';
    
     public function send($data = ''){
        
        if($data == ''){
            return false;
        }
        
        $result = $this->db->insert($this->table, $data);
        return $result;
    }
    
    public function lu($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $result = $this->db->query('UPDATE `messages` SET `etat` = "lu" WHERE `id` = '.$id);
        
        return $result;
    }
    
     public function count_non_lu($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $this->db->like('idDestinataire', $id);
        $this->db->like('etat', "non lu");
        $this->db->from($this->table);
        $result = $this->db->count_all_results();
        return $result;
    }
    
     public function getAll($id = 0){
        
        if($id == 0){
            return false;
        }
        
        $result = $this->db->select('*')
                 ->from($this->table)
                 ->where('idDestinataire',$id)
                 ->get()
                 ->result();
        
        return $result;
    }
}
