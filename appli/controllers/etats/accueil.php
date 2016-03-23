<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); header('Content-Type: text/html; charset=utf-8');

class Accueil extends CI_Controller {
    
    /**
     * 
     * Auteur : CAPI Aurélien
     * 
     */
    
	public function index()
	{
            $data = array();
            $data['user'] = $this->session->userdata('user');
            $data['nb_messages'] = $this->nb_messages;
            $data['menu'] = $this->load->view('template/menu',$data,true);            
            $this->load->view('template/header');
            $this->load->view('template/sidebar',$data);
            $this->load->view('pages/etats/accueil');
            $this->load->view('template/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */