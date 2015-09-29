<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Societe extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * Co-développeur : LEFEBVRE Anthony
     * 
     */
    
    public function index() {
        $data = array();$data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $data['societes'] = $this->societes->getAll();
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/societes/liste');
        $this->load->view('template/footer');
    }
    
    public function supprimer($id = 0){
        $data = array();$data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        if($id == 0 || $data['user']->compte != "associé"){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $result = $this->societes->delete($id);
        if($result){
            redirect('societe');
        }        
    }

    public function details($id = "") {
        $data = array();$data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        if($id == "" || $data['user']->compte != "associé"){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data['societes'] = $this->societes->getSociete($id);
        $data['comptes'] = $this->comptes_bancaires->getFromSociete($id);
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/societes/details');
        $this->load->view('template/footer');
    }
    
    public function modifier($id = "") {
        $data = array();$data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        if($id == "" || $data['user']->compte != "associé"){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data['societe'] = $this->societes->getSociete($id)[0];
        $this->form_validation->set_rules('nom', '"Nom"', 'trim|required|max_length[500]|encode_php_tags|xss_clean|update_unique[societes.nom.id.'. $data['societe']->id.']');
        $this->form_validation->set_rules('siret', '"Siret"', 'trim|max_length[20]|encode_php_tags|xss_clean|numeric|update_unique[societes.siret.id.'.$data['societe']->id.']');
        $this->form_validation->set_rules('gerant', '"Gérant"', 'trim|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('date_creation', '"Date de création"', 'trim|regex_match[/^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$/]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('regime_imposition', '"Régime d\'imposition"', 'trim|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('adresse', '"Adresse"', 'trim|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('cp', '"CP"', 'trim|max_length[5]|encode_php_tags|xss_clean|numeric');
        $this->form_validation->set_rules('ville', '"Ville"', 'trim|max_length[60]|encode_php_tags|xss_clean');
        
        if ($this->form_validation->run()) {
            $societe = new stdClass();
            $societe->nom = $this->input->post('nom');
            $societe->siret = $this->input->post('siret');
            $societe->date_creation = $this->input->post('date_creation');
            $societe->gerant = $this->input->post('gerant');
            $societe->regime_imposition = $this->input->post('regime_imposition');
            $societe->adresse = $this->input->post('adresse');
            $societe->cp = $this->input->post('cp');
            $societe->ville = $this->input->post('ville');
            
            $result = $this->societes->modify($societe,$id);
            if($result == true){
                //Requete reussie! :)
                redirect('societe/details/'.$data['societe']->id);
            }else{
                $data = array();$data['nb_messages'] = $this->nb_messages;
                $data['user'] = $this->session->userdata('user');
                $data['menu'] = $this->load->view('template/menu', $data, true);
                $this->load->view('template/header');
                $this->load->view('template/sidebar', $data);
                echo '<h3 style="color:red">Une erreur s\'est produite lors de la modification de la société, Contactez le pôle informatique!</h3>';
                $this->load->view('pages/societes/modifier');
                $this->load->view('template/footer');
                $this->output->enable_profiler(TRUE);
                return false;
            }
            
        }      
        
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/societes/modifier');
        $this->load->view('template/footer');
        
    }
    
    public function creer_compte($id = "") {
        $data = array();$data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        if($id == "" || $data['user']->compte != "associé"){
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        
        
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/comptes/creer');
        $this->load->view('template/footer');
    }
    
    public function ajouter() {
        
        $this->form_validation->set_rules('nom', '"Nom"', 'trim|required|max_length[500]|encode_php_tags|xss_clean|is_unique[societes.nom]');
        $this->form_validation->set_rules('siret', '"Siret"', 'trim|max_length[20]|encode_php_tags|xss_clean|numeric|is_unique[societes.siret]');
        $this->form_validation->set_rules('gerant', '"Gérant"', 'trim|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('date_creation', '"Date de création"', 'trim|regex_match[/^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$/]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('regime_imposition', '"Régime d\'imposition"', 'trim|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('adresse', '"Adresse"', 'trim|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('cp', '"CP"', 'trim|max_length[5]|encode_php_tags|xss_clean|numeric');
        $this->form_validation->set_rules('ville', '"Ville"', 'trim|max_length[60]|encode_php_tags|xss_clean');

        if ($this->form_validation->run()) {
            $societe = new stdClass();
            $societe->nom = $this->input->post('nom');
            $societe->siret = $this->input->post('siret');
            $societe->date_creation = $this->input->post('date_creation');
            $societe->gerant = $this->input->post('gerant');
            $societe->regime_imposition = $this->input->post('regime_imposition');
            $societe->adresse = $this->input->post('adresse');
            $societe->cp = $this->input->post('cp');
            $societe->ville = $this->input->post('ville');
            
            $result = $this->societes->add($societe);
            if($result->query == true){
                //Requete reussie! :)
                redirect('societe');
            }else{
                $data = array();$data['nb_messages'] = $this->nb_messages;
                $data['user'] = $this->session->userdata('user');
                $data['menu'] = $this->load->view('template/menu', $data, true);
                $this->load->view('template/header');
                $this->load->view('template/sidebar', $data);
                echo '<h3 style="color:red">Une erreur s\'est produite lors de la création de la société, Contactez le pôle informatique!</h3>';
                $this->load->view('pages/societes/creer');
                $this->load->view('template/footer');
                return false;
            }
            
        }        
            $data = array();$data['nb_messages'] = $this->nb_messages;
            $data['user'] = $this->session->userdata('user');
            $data['menu'] = $this->load->view('template/menu', $data, true);
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('pages/societes/creer');
            $this->load->view('template/footer');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */