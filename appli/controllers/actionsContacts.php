<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ActionsContacts extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * Co-développeur : LEFEBVRE Anthony
     * 
     */
    
    public function liste($id = 0){
        if($id == 0){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = Array();
        $data['contact'] = $this->contacts->constructeur($id)[0];
        $data['contact']->actions = $this->actions->getFromContact($id);
        
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */