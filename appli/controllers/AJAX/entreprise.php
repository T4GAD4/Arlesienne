<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); header('Content-Type: text/html; charset=utf-8');

class Entreprise extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * Co-développeur : LEFEBVRE Anthony
     * 
     */
        
        public function getAll(){
            $result = $this->entreprises->getAll();
            echo output($result);
        }
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */