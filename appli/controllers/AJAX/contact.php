<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); header('Content-Type: text/html; charset=utf-8');

class Contact extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * Co-développeur : LEFEBVRE Anthony
     * 
     */
        
        public function creer()
	{
            $contact = $_REQUEST['data'];
            $result = new stdClass();
            $result->id = $this->contacts->creer($contact);
            echo output($result);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */