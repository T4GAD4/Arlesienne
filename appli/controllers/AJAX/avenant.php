<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); header('Content-Type: text/html; charset=utf-8');

class Avenant extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * 
     */
        
        public function liste()
	{
            $id = $_REQUEST['projet'];
            echo json_encode($this->avenants->getFromMarches($id));
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */