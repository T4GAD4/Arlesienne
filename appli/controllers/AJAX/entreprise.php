<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); header('Content-Type: text/html; charset=utf-8');

class Entreprise extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * 
     */
        
        public function getAll(){
            $result = $this->entreprises->getAll();
            echo output($result);
        }
        
        public function creer()
	{
            $entreprise = $_REQUEST['data'];
            $result = new stdClass();
            $result->id = $this->entreprises->creer($entreprise);
            echo output($result);
	}
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */