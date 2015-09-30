<?php
header('Content-Type: text/html; charset=utf-8');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Marche extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * 
     */

    public function detail($id = 0) {
        if($id == 0){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        var_dump($id);
    }

    public function modifier($id = 0) {
        if($id == 0){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $data['marche'] = 
        var_dump($id);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */