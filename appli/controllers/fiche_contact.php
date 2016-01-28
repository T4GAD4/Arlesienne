<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); header('Content-Type: text/html; charset=utf-8');

class Fiche_contact extends CI_Controller {
    
    /**
     * 
     * Auteur : CAPI Aurélien
     * 
     */
    
	public function vue($id = 0)
	{
            if($id == 0){
                redirect($_SERVER['HTTP_REFERER']);
            }
            $data = array();
            $data['user'] = $this->session->userdata('user');
            $data['nb_messages'] = $this->nb_messages;
            
            $data['contact'] = $this->contacts->getId($id)[0];
            
            $data['menu'] = $this->load->view('template/menu',$data,true);            
            $this->load->view('template/header');
            $this->load->view('template/sidebar',$data);
            $this->load->view('pages/contact/fiche');
            $this->load->view('template/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */