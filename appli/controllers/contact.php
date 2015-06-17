<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends CI_Controller {

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
        $data['contacts'] = $this->contacts->getAll();
        $data['entreprises'] = $this->entreprises->getAll();
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/contact/liste');
        $this->load->view('template/footer');
    }
    
    public function ajouter(){
        $this->form_validation->set_rules('nom', '"Nom"', 'trim|required|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('prenom', '"Prenom"', 'trim|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('adresse', '"Adresse"', 'trim|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('codepostal', '"Code postal"', 'trim|max_length[7]|numeric|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('ville', '"Ville"', 'trim|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('fixe', '"Fixe"', 'trim|numeric|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('portable', '"Portable"', 'trim|numeric|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('email', '"Email"', 'trim|valid_email|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('siret', '"Siret"', 'trim|min_length[14]|max_length[14]|encode_php_tags|xss_clean|numeric');
        
        if($this->form_validation->run()){
            $contact = new stdClass();
            $contact->civilite = $this->input->post('civilite');
            $contact->nom = $this->input->post('nom');
            $contact->prenom = $this->input->post('prenom');
            $contact->adresse = $this->input->post('adresse');
            $contact->cp = $this->input->post('codepostal');
            $contact->ville = $this->input->post('ville');
            $contact->fixe = $this->input->post('fixe');
            $contact->portable = $this->input->post('portable');
            $contact->email = $this->input->post('email');
            $contact->autoentreprise = $this->input->post('autoentrepreneur');
            
            $contact->data = $this->input->post('data');
            
            
            // On ajoute le contact
            $contact->id = $this->contacts->creer($contact);
            
            if($this->input->post('autoentrepreneur') != false){
                // Créer entreprise au nom du contact!
                $entreprise = new stdClass();
                $entreprise->nom = $contact->nom .' '. $contact->prenom;
                $entreprise->siret = $this->input->post('siret');
                $entreprise->id = $this->entreprises->creer($entreprise);
                // Ajouter le poste entre les deux!
                $poste_entreprise = new stdClass();
                $poste_entreprise->idContact = $contact->id;
                $poste_entreprise->idEntreprise = $entreprise->id;
                $poste_entreprise->poste = "Gérant";
                $this->poste_entreprise->creer($poste_entreprise);
            }            
            //Ensuite ajouter les postes dans l'entreprise
            $liaisons = json_decode($this->input->post('entreprises'));
            $poste_entreprises = new stdClass();
            foreach($liaisons as $liaison){
                $poste_entreprises->idContact = $contact->id;
                $poste_entreprises->idEntreprise = $liaison->id;
                $poste_entreprises->poste = $liaison->poste;
                $this->poste_entreprise->creer($poste_entreprises);
            }
            
        }
        $data = array();
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $data['select_contacts'] = explode(';',$this->configurations->getValeur('select_contacts')[0]->valeur);
        $data['type_contact'] = explode(';',$this->configurations->getValeur('type_contact')[0]->valeur);
        $data['liste_diffusions'] = explode(';',$this->configurations->getValeur('liste_diffusion')[0]->valeur);
        $data['entreprises'] = $this->entreprises->getAll();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/contact/creer');
        $this->load->view('template/footer');
    }
    
    public function modifier($id = 0){
        if($id == 0){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $this->form_validation->set_rules('nom', '"Nom"', 'trim|required|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('prenom', '"Prenom"', 'trim|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('adresse', '"Adresse"', 'trim|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('codepostal', '"Code postal"', 'trim|max_length[7]|numeric|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('ville', '"Ville"', 'trim|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('fixe', '"Fixe"', 'trim|numeric|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('portable', '"Portable"', 'trim|numeric|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('email', '"Email"', 'trim|valid_email|max_length[500]|encode_php_tags|xss_clean');

        
        if($this->form_validation->run()){
            $contact = new stdClass();
            $contact->civilite = $this->input->post('civilite');
            $contact->nom = $this->input->post('nom');
            $contact->prenom = $this->input->post('prenom');
            $contact->adresse = $this->input->post('adresse');
            $contact->cp = $this->input->post('codepostal');
            $contact->ville = $this->input->post('ville');
            $contact->fixe = $this->input->post('fixe');
            $contact->portable = $this->input->post('portable');
            $contact->email = $this->input->post('email');
            $contact->data = $this->input->post('data');
            
            // On ajoute le contact
            $this->contacts->update($contact,$id);
                    
            //Ensuite ajouter les postes dans l'entreprise
            $liaisons = json_decode($this->input->post('entreprises'));
            $poste_entreprises = new stdClass();
            $this->poste_entreprise->delete($id);
            foreach($liaisons as $liaison){
                $poste_entreprises->idContact = $id;
                $poste_entreprises->idEntreprise = $liaison->id;
                $poste_entreprises->poste = $liaison->poste;
                $this->poste_entreprise->creer($poste_entreprises);
            }
        }
        
        $data = array();
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $data['menu'] = $this->load->view('template/menu', $data, true);
        //On recupere le contact
        $data['contact'] = $this->contacts->getId($id)[0];
        //On recuperer les postes du contact
        $data['postes'] = $this->poste_entreprise->getId($data['contact']->id);
        //Pour chaque poste, on va récupérer l'entreprise
        if($data['postes'] != null){
            foreach($data['postes'] as $poste){
                $poste->entreprise = $this->entreprises->getId($poste->idEntreprise)[0];
            }
        }
        //On transforme les datas en donnée utilisable dans la vue
        $data['contact_liste'] = json_decode($data['contact']->data)->liste;
        $data['contact_champs'] = json_decode($data['contact']->data)->champs_persos;
        //On récupére les paramétres pour les select et autres.
        $data['select_contacts'] = explode(';',$this->configurations->getValeur('select_contacts')[0]->valeur);
        $data['type_contact'] = explode(';',$this->configurations->getValeur('type_contact')[0]->valeur);
        $data['liste_diffusions'] = explode(';',$this->configurations->getValeur('liste_diffusion')[0]->valeur);
        $data['entreprises'] = $this->entreprises->getAll();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/contact/modifier'); 
        $this->load->view('template/footer');
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */