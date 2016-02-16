<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
header('Content-Type: text/html; charset=utf-8');

class Avenant extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * 
     */
    
    public function index() {
        $data = array();
        $data['user'] = $this->session->userdata('user');
        $data['nb_messages'] = $this->nb_messages;
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $data['factures'] = $this->factures->getAll();
        foreach ($data['factures'] as $facture) {
            $facture->entreprise = $this->entreprises->constructeur($facture->idEntreprise)[0];
            $facture->regle = $this->reglements->countFromFacture($facture->id)[0];
        }
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/facturation/liste');
        $this->load->view('template/footer');
    }

    public function creer($id = 0) {
        if($id == 0){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['id_marche'] = $id;
        $data['user'] = $this->session->userdata('user');
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $data['entreprises'] = $this->entreprises->getAll();
        
        $this->form_validation->set_rules('entreprise', '"Entreprise"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('objet', '"Objet"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('date', '"Date"', 'regex_match[/[0-9]{2}-[0-12]{2}-[0-9]{4}/]|trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('numero', '"Numero"', 'trim|required|encode_php_tags|xss_clean|numero_devis[' . $this->input->post('entreprise') . '.' . $this->input->post('numero') . ']');
        $this->form_validation->set_rules('montantHT', '"Montant HT"', 'trim|numeric|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('tva', '"TVA"', 'trim|required|encode_php_tags|xss_clean');
        
        if ($this->form_validation->run()) {

            $date = DateTime::createFromFormat("d-m-Y", $this->input->post('date'));

            $avenant = new stdClass();
            $avenant->idMarche = $id;
            $avenant->idEntreprise = $this->input->post('entreprise');
            $avenant->objet = $this->input->post('objet');
            $avenant->date = $date->format("Y-m-d");
            $avenant->montantHT = $this->input->post('montantHT');
            $avenant->tva = $this->input->post('tva');
            $avenant->numero = $this->input->post('numero');

            $result = $this->avenants->creer($avenant);
            
            if($avenant->idEntreprise != null){
                $marche = $this->marches->constructeur($id)[0];
                //On va chercher le projet pour avoir son chemin complet.
                $projet = $this->projets->constructeur($marche->idProjet)[0];
                $entreprise = $this->entreprises->constructeur($avenant->idEntreprise)[0];
                //On crée le dossier de l'entreprise
                shell_exec('mkdir "/home/srh/serveur/' . $projet->etat . '/'.$projet->url.'/INTERVENANTS/'.slugify($entreprise->nom).'";');
                //on envoie tout le contenu de (Nom entreprise) dans le dossier de l'entreprise
                $cmd = 'cp -r "/home/srh/serveur/' . $projet->etat . '/'.$projet->url.'/INTERVENANTS/(Nom entreprise)"/*  "/home/srh/serveur/' . $projet->etat . '/'.$projet->url.'/INTERVENANTS/'.slugify($entreprise->nom).'/";';
                shell_exec($cmd);
            }

            if ($result->id) {
                redirect(base_url() . 'marche/detail/' . $id);
            }
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/avenants/creer');
        $this->load->view('template/footer');
    }

    public function modifier($id = 0) {
        if ($id == 0) {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['user'] = $this->session->userdata('user');
        $data['nb_messages'] = $this->nb_messages;
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $data['entreprises'] = $this->entreprises->getAll();
        $data['avenant'] = $this->avenants->constructeur($id)[0];
        $data['avenant']->date = explode("-", $data['avenant']->date)[2] . '-' . explode("-", $data['avenant']->date)[1] . '-' . explode("-", $data['avenant']->date)[0];
        
        $this->form_validation->set_rules('entreprise', '"Entreprise"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('objet', '"Objet"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('date', '"Date"', 'regex_match[/[0-9]{2}-[0-12]{2}-[0-9]{4}/]|trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('numero', '"Numero"', 'trim|required|encode_php_tags|xss_clean|numero_devis_update[' . $this->input->post('entreprise') . '.' . $this->input->post('numero') . '.' . $id . ']');
        $this->form_validation->set_rules('montantHT', '"Montant HT"', 'trim|numeric|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('tva', '"TVA"', 'trim|required|encode_php_tags|xss_clean');
        
        if ($this->form_validation->run()) {

            $date = DateTime::createFromFormat("d-m-Y", $this->input->post('date'));

            $avenant = new stdClass();
            $avenant->idEntreprise = $this->input->post('entreprise');
            $avenant->objet = $this->input->post('objet');
            $avenant->numero = $this->input->post('numero');
            $avenant->date = $date->format("Y-m-d");
            $avenant->montantHT = $this->input->post('montantHT');
            $avenant->tva = $this->input->post('tva');

            $this->avenants->modify($avenant, $id);

            redirect(base_url() . 'marche/detail/' . $data['avenant']->idMarche);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/avenants/modifier');
        $this->load->view('template/footer');
    }
    
    public function supprimer($id = 0){
        
        $avenant = $this->avenants->constructeur($id);
        
        $this->avenants->delete($id);
        
        redirect('marche/detail/'.$avenant->idMarche);  
             
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */