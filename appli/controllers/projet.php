<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Projet extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * 
     */
    
    public function index()
    {
      $data = array();
      $data['nb_messages'] = $this->nb_messages;
      $data['user'] = $this->session->userdata('user');
      $data['projets'] = $this->projets->getAll();
      $data['menu'] = $this->load->view('template/menu', $data, true);
      $this->load->view('template/header');
      $this->load->view('template/sidebar', $data);
      $this->load->view('pages/projet/liste');
      $this->load->view('template/footer');
    }
    
    public function ajouter() {

     $this->form_validation->set_rules('nom', '"Nom"', 'trim|required|encode_php_tags|xss_clean|is_unique[projet.nom]');
     $this->form_validation->set_rules('budget', '"Budget"', 'trim|required|encode_php_tags|xss_clean');
     $this->form_validation->set_rules('adresse', '"Adresse"', 'trim|required|encode_php_tags|xss_clean');
     $this->form_validation->set_rules('codepostal', '"Code postal"', 'trim|required|encode_php_tags|xss_clean');
     $this->form_validation->set_rules('ville', '"Ville"', 'trim|required|encode_php_tags|xss_clean');
     $this->form_validation->set_rules('commentaire', '"Commentaire"', 'trim|encode_php_tags|xss_clean');

     if ($this->form_validation->run()) {
      $projet = new stdClass();
      $projet->idCompte = $this->input->post('compte');
      $projet->nom = $this->input->post('nom');
      $projet->budget = $this->input->post('budget');
      $projet->etat = $this->input->post('etat');
      $projet->adresse = $this->input->post('adresse');
      $projet->cp = $this->input->post('codepostal');
      $projet->ville = $this->input->post('ville');
      $projet->commentaire = $this->input->post('commentaire');
      $result = $this->projets->add($projet);
      
      if($result == true){
                //Requete reussie! :)
          //Il faut créer le dossier du projet  
          
        redirect('projet/'.$data['projet']->id);
      }
    } 
    
    $data = array();
    $data['compte'] = $this->comptes_bancaires->getCompte();
    $data['societes'] = $this->societes->getAll();
    $data['nb_messages'] = $this->nb_messages;
    $data['user'] = $this->session->userdata('user');
    $data['select_etat'] = explode(';',$this->configurations->getValeur('select_etat')[0]->valeur);
    $data['menu'] = $this->load->view('template/menu', $data, true);
    $this->load->view('template/header');
    $this->load->view('template/sidebar', $data);
    $this->load->view('pages/projet/creer');
    $this->load->view('template/footer');
  }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */