<?php
header('Content-Type: text/html; charset=utf-8');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Previsionnel extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * 
     */
    
    public function liste($nom = "") {
        //On est sur la liste des previ
        if($nom == ""){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $data['projet'] = $this->projets->getFromUrl($nom)[0];
        $data['previsionnels'] = $this->previsionnels->getFromProjet($data['projet']->id);
        
        $data['menu'] = $this->load->view('template/menu', $data, true);
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/previsionnel/liste');
        $this->load->view('template/footer');
    }
    
    public function creer($nom = ""){
        //On est sur la création d'un previ
        if($nom == ""){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $data['projet'] = $this->projets->getFromUrl($nom)[0];
        
        $previ = new stdClass();
        $previ->idProjet = $data['projet']->id;
        $previ->utilisateur = $data['user']->prenom .' '. $data['user']->nom;
        $previ->date = date('Y-m-d');
        $previ->version = 1;
        
        $id = $this->previsionnels->creer($previ);
        
        redirect(base_url('previsionnel/modifier/'.$id));
    }
    
    public function modifier($id = 0){
        if($id == 0){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $data['previsionnel'] = $this->previsionnels->constructeur($id)[0];
        
        
        $data['menu'] = $this->load->view('template/menu', $data, true);
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/previsionnel/modifier');
        $this->load->view('template/footer');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */