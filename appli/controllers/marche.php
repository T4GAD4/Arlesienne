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
    
    public function liste($url = "") {
        if($url == ""){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $data['projet'] = $this->projets->getFromUrl($url)[0]; 
        
        $data['marches'] = $this->marches->getFromProjet($data['projet']->id);
        
        $data['categories'] = $this->marches->getCategorie($data['projet']->id);
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/marche/liste');
        $this->load->view('template/footer');
    }

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
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $data['marche'] = $this->marches->constructeur($id)[0];
        $data['projet'] = $this->projets->constructeur($data['marche']->idProjet)[0];
        $data['programmes'] = $this->programmes->getFromProjet($data['marche']->idProjet);
        $data['marche']->programmes = $this->marches->getProgrammes($data['marche']->id);
        
        $this->form_validation->set_rules('montant', '"Montant"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('tva', '"TVA"', 'trim|required|encode_php_tags|numeric|xss_clean');
        $this->form_validation->set_rules('devise', '"Devisé"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('caution', '"Caution"', 'trim|required|numeric|encode_php_tags|xss_clean');
        
        if ($this->form_validation->run()) {
            $marche = new StdClass();
            $marche->montantHT = intval($this->input->post('montant'));
            $marche->TVA = intval($this->input->post('tva'));
            $marche->devise = $this->input->post('devise');
            $marche->caution = intval($this->input->post('caution'));
            
            $result = $this->marches->modify($marche,$id);
            
            /* Commentaire programme
            $programmesAssociés = $this->input->post('liste');
            $this->marche_programme->delete($data['marche']->id);
            foreach($programmesAssociés as $prog){
                $assoc = new StdClass();
                $assoc->idProgramme = $prog;
                $assoc->idMarche = $id;
                $this->marche_programme->creer($assoc);
            }
            */
            
            redirect(base_url("projet/detail/".slugify($data['projet']->ville." ".$data['projet']->nom)));
        }
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/marche/modifier', $data);
        $this->load->view('template/footer');
        
        
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */