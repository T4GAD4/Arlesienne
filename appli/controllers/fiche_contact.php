<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
header('Content-Type: text/html; charset=utf-8');

class Fiche_contact extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * 
     */
    public function vue($id = 0) {
        if ($id == 0) {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['user'] = $this->session->userdata('user');
        $data['nb_messages'] = $this->nb_messages;
        $data['projets'] = $this->projets->getAll();
        $data['contact'] = $this->contacts->getId($id)[0];

        if ($this->input->post()) {

            $fiche = new StdClass();
            $fiche->idContact = $id;
            //On reset tout les champs afin d'éffacer les valeurs que l'on ne veut plus!
            $fiche->achat = 0;
            $fiche->location = 0;
            $fiche->observation = "";
            $fiche->maison = 0;
            $fiche->appartement = 0;
            $fiche->loft = 0;
            $fiche->jardin = 0;
            $fiche->parking = 0;
            $fiche->garage = 0;
            $fiche->commerce = 0;
            $fiche->bureau = 0;
            $fiche->t2 = 0;
            $fiche->t3 = 0;
            $fiche->t4 = 0;
            $fiche->t5 = 0;
            $fiche->amenagee = 0;
            $fiche->brute = 0;
            $fiche->investissement_locatif = 0;
            $fiche->residence_principale = 0;
            $fiche->residence_secondaire = 0;

            //On met à jour les champs
            if ($this->input->post('recherche')) {
                foreach ($this->input->post('recherche') as $key => $value) {
                    $fiche->$key = 1;
                }
            }
            if ($this->input->post('typebien')) {
                foreach ($this->input->post('typebien') as $key => $value) {
                    $fiche->$key = 1;
                }
            }
            if ($this->input->post('typologie')) {
                foreach ($this->input->post('typologie') as $key => $value) {
                    $fiche->$key = 1;
                }
            }
            if ($this->input->post('surface')) {
                foreach ($this->input->post('surface') as $key => $value) {
                    $fiche->$key = 1;
                }
            }
            if ($this->input->post('typeachat')) {
                foreach ($this->input->post('typeachat') as $key => $value) {
                    $fiche->$key = 1;
                }
            }
            if ($this->input->post('autres')) {
                foreach ($this->input->post('autres') as $key => $value) {
                    $fiche->$key = 1;
                }
            }
            $fiche->secteur = json_encode($this->input->post('secteur'));
            $fiche->superficie = $this->input->post('superficie');
            $fiche->budget = $this->input->post('budget');
            $fiche->observation = $this->input->post('observation');
            if ($this->input->post('operation') == 0) {
                $idProjet = null;
            } else {
                $idProjet = $this->input->post('operation');
            }
            $fiche->idProjet = $idProjet;


            //On envoie en BDD
            $idFiche = $this->fiches->getFromContact($id);
            if (!$idFiche) {
                $this->fiches->insert($fiche);
            } else {
                $this->fiches->update($fiche, $idFiche[0]->id);
            }
        }
        $data['fiche'] = $this->fiches->getFromContact($id);
        if (!$data['fiche']) {
            $fiche = new StdClass();
            $fiche->idContact = $id;
            //On reset tout les champs afin d'éffacer les valeurs que l'on ne veut plus!
            $fiche->achat = 0;
            $fiche->location = 0;
            $fiche->observation = "";
            $fiche->maison = 0;
            $fiche->appartement = 0;
            $fiche->loft = 0;
            $fiche->jardin = 0;
            $fiche->parking = 0;
            $fiche->garage = 0;
            $fiche->commerce = 0;
            $fiche->bureau = 0;
            $fiche->t2 = 0;
            $fiche->t3 = 0;
            $fiche->t4 = 0;
            $fiche->t5 = 0;
            $fiche->amenagee = 0;
            $fiche->brute = 0;
            $fiche->investissement_locatif = 0;
            $fiche->residence_principale = 0;
            $fiche->residence_secondaire = 0;
            //On initialise les champs qui seront vides...
            $fiche->secteur = "";
            $fiche->operation = "";
            $fiche->superficie = "";
            $fiche->budget = "";
            $fiche->idProjet = null;
            $data['fiche'] = $fiche;
        } else {
            $data['fiche'] = $data['fiche'][0];
        }
        $data['secteurs'] = $this->secteurs->getAllSecteurs();
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/contact/fiche');
        $this->load->view('template/footer');
    }

    public function imprimer($id = 0) {
        if ($id == 0) {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['user'] = $this->session->userdata('user');

        $data['contact'] = $this->contacts->getId($id)[0];
        $temp = array();
        $poste_entreprises = $this->poste_entreprise->getId($data['contact']->id);
        foreach ($poste_entreprises as $poste_entreprise) {
            $entreprise = new stdClass();
            $entreprise = $this->entreprises->getId($poste_entreprise->idEntreprise);
            $entreprise[0]->poste = $poste_entreprise->poste;
            $entreprise[0]->autoentreprise = $poste_entreprise->autoentreprise;
            array_push($temp, $entreprise);
        }
        $data['contact']->entreprises = $temp;
        $data['fiche'] = $this->fiches->getFromContact($id)[0];

        $this->load->view('template/header', $data);
        $this->load->view('pages/contact/imprimer');
        $this->load->view('template/footer');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */