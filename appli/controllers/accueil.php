<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accueil extends CI_Controller {
    
    /**
     * 
     * Auteur : CAPI Aurélien
     * 
     */
    
	public function index()
	{
            var_dump('test');
            $data = array();
            $data['user'] = $this->session->userdata('user');
            $data['nb_messages'] = $this->nb_messages;
            $data['menu'] = $this->load->view('template/menu',$data,true);            
            $this->load->view('template/header');
            $this->load->view('template/sidebar',$data);
            $this->load->view('pages/accueil');
            $this->load->view('template/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */