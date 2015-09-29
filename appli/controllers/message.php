<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Message extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * Co-développeur : LEFEBVRE Anthony
     * 
     */
    
    public function index(){
        $data = array();
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $messages = $this->messages->getAll($data['user']->id);
        $data['non_lus'] = array();
        $data['lus'] = array();
        foreach($messages as $message){
            $message->expediteur = $this->utilisateurs->getId($message->idExpediteur);
            if($message->etat == "non lu"){
                array_push($data['non_lus'], $message);
            }else{
                array_push($data['lus'], $message);
            }
        }
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/messages/liste');
        $this->load->view('template/footer');
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */