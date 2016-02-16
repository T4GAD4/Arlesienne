<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); header('Content-Type: text/html; charset=utf-8');

class Deconnexion extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * Co-développeur : LEFEBVRE Anthony
     * 
     */
    
	public function index()
	{
            $this->session->unset_userdata('user');
            redirect('/accueil');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */