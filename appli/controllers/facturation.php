<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
header('Content-Type: text/html; charset=utf-8');

class Facturation extends CI_Controller {

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

    public function creer() {
        $data = array();
        $data['user'] = $this->session->userdata('user');
        $data['nb_messages'] = $this->nb_messages;
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $data['entreprises'] = $this->entreprises->getAll();
        $data['societes'] = $this->societes->getAll();
        $data['comptes'] = $this->comptes_bancaires->getFromSociete($data['societes'][0]->id);
        $this->form_validation->set_rules('entreprise', '"Entreprise"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('objet', '"Objet"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('date', '"Date"', 'regex_match[/[0-9]{2}-[0-12]{2}-[0-9]{4}/]|trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('date_echeance', '"Date échéance"', 'regex_match[/[0-9]{2}-[0-12]{2}-[0-9]{4}/]|trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('numero', '"Numero"', 'trim|required|encode_php_tags|xss_clean|numero_facture[' . $this->input->post('entreprise') . '.' . $this->input->post('numero') . ']');
        $this->form_validation->set_rules('montantHT', '"Montant HT"', 'trim|numeric|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('tva', '"TVA"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('rg', '"RG"', 'trim|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('avoir', '"Avoir"', 'trim|encode_php_tags|numeric|xss_clean');

        if ($this->form_validation->run()) {

            $date = DateTime::createFromFormat("d-m-Y", $this->input->post('date'));
            $date_echeance = DateTime::createFromFormat("d-m-Y", $this->input->post('date_echeance'));

            $facture = new stdClass();
            $facture->idEntreprise = $this->input->post('entreprise');
            $facture->objet = $this->input->post('objet');
            $facture->numFacture = $this->input->post('numero');
            $facture->dateFacture = $date->format("Y-m-d");
            $facture->dateEcheance = $date_echeance->format("Y-m-d");
            $facture->montantHT = $this->input->post('montantHT');
            $facture->tva = $this->input->post('tva');
            $facture->rg = $this->input->post('rg');
            $facture->avoir = $this->input->post('avoir');

            $result = $this->factures->creer($facture);
            
            if (is_integer($result->id) && $this->input->post('reglement_effectue') == "on") {
                $reglement = new StdClass();
                $reglement->idFacture = $result->id;
                $reglement->idCompte = $this->input->post('compte');
                $reglement->montant = format_number(floatval(calc_tva($facture->montantHT, $facture->tva,false))-floatval($facture->avoir));
                $this->reglements->creer($reglement);
            }

            if ($result->id) {
                redirect(base_url() . '/facturation/details/' . $result->id);
            }
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/facturation/creer');
        $this->load->view('template/footer');
    }

    public function details($id = 0) {
        if ($id == 0) {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['user'] = $this->session->userdata('user');
        $data['nb_messages'] = $this->nb_messages;
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $data['entreprises'] = $this->entreprises->getAll();
        $data['facture'] = $this->factures->constructeur($id)[0];
        $data['facture']->dateFacture = explode("-", $data['facture']->dateFacture)[2] . '-' . explode("-", $data['facture']->dateFacture)[1] . '-' . explode("-", $data['facture']->dateFacture)[0];
        $data['facture']->dateEcheance = explode("-", $data['facture']->dateEcheance)[2] . '-' . explode("-", $data['facture']->dateEcheance)[1] . '-' . explode("-", $data['facture']->dateEcheance)[0];

        $this->form_validation->set_rules('entreprise', '"Entreprise"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('objet', '"Objet"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('date', '"Date"', 'regex_match[/[0-9]{2}-[0-12]{2}-[0-9]{4}/]|trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('date_echeance', '"Date échéance"', 'regex_match[/[0-9]{2}-[0-12]{2}-[0-9]{4}/]|trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('numero', '"Numero"', 'trim|required|encode_php_tags|xss_clean|numero_facture_update[' . $this->input->post('entreprise') . '.' . $this->input->post('numero') . '.' . $id . ']');
        $this->form_validation->set_rules('montantHT', '"Montant HT"', 'trim|numeric|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('tva', '"TVA"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('rg', '"RG"', 'trim|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('avoir', '"Avoir"', 'trim|encode_php_tags|numeric|xss_clean');

        if ($this->form_validation->run()) {

            $date = DateTime::createFromFormat("d-m-Y", $this->input->post('date'));
            $date_echeance = DateTime::createFromFormat("d-m-Y", $this->input->post('date_echeance'));

            $facture = new stdClass();
            $facture->idEntreprise = $this->input->post('entreprise');
            $facture->objet = $this->input->post('objet');
            $facture->numFacture = $this->input->post('numero');
            $facture->dateFacture = $date->format("Y-m-d");
            $facture->dateEcheance = $date_echeance->format("Y-m-d");
            $facture->montantHT = $this->input->post('montantHT');
            $facture->tva = $this->input->post('tva');
            $facture->rg = $this->input->post('rg');
            $facture->avoir = $this->input->post('avoir');

            $this->factures->modify($facture, $id);

            redirect(base_url() . 'facturation/details/' . $id);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/facturation/modifier');
        $this->load->view('template/footer');
    }

    public function repartir($id = 0) {
        if ($id == 0) {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['user'] = $this->session->userdata('user');
        $data['nb_messages'] = $this->nb_messages;
        $data['menu'] = $this->load->view('template/menu', $data, true);
        //On a besoin des projets
        $data['projets'] = $this->projets->getAll();

        $data['facture'] = $this->factures->constructeur($id)[0];
        $data['facture']->regle = $this->reglements->countFromFacture($data['facture']->id)[0];
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/facturation/repartition');
        $this->load->view('template/footer');
    }

    public function regler($id = 0) {
        if ($id == 0) {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['user'] = $this->session->userdata('user');
        $data['nb_messages'] = $this->nb_messages;
        $data['menu'] = $this->load->view('template/menu', $data, true);

        //On récupére les données de la facture
        $data['facture'] = $this->factures->constructeur($id)[0];
        $data['facture']->regle = $this->reglements->countFromFacture($data['facture']->id)[0];

        //On récupére les réglements déja effectués
        $data['reglements'] = $this->reglements->getFromFacture($id);

        $data['societes'] = $this->societes->getAll();
        $data['comptes'] = $this->comptes_bancaires->getFromSociete($data['societes'][0]->id);

        foreach ($data['reglements'] as $reglement) {
            $reglement->compte = $this->comptes_bancaires->constructeur($reglement->idCompte)[0];
            $reglement->societe = $this->societes->constructeur($reglement->compte->idSociete)[0];
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/facturation/reglements/liste');
        $this->load->view('template/footer');
    }

    public function creer_reglement($id = 0) {
        $data = array();
        $data['user'] = $this->session->userdata('user');

        $this->form_validation->set_rules('montant', '"Montant"', 'trim|required|encode_php_tags|numeric|xss_clean');
        $this->form_validation->set_rules('compte', '"Compte"', 'trim|required|encode_php_tags|xss_clean');

        if ($this->form_validation->run()) {

            $reglement = new StdClass();
            $reglement->idFacture = $id;
            $reglement->idCompte = $this->input->post('compte');
            $reglement->montant = $this->input->post('montant');

            $result = $this->reglements->creer($reglement);

            if ($result) {
                redirect(base_url() . 'facturation/regler/' . $id);
            }
        }
        redirect(base_url('facturation/regler/' . $id));
    }

    public function supprimer_reglement($id = 0, $reglement = 0) {
        $data = array();
        $data['user'] = $this->session->userdata('user');

        $this->reglements->delete($reglement);

        redirect(base_url('facturation/regler/' . $id));
    }

    public function modifier_reglement($id = 0, $id_reglement = 0) {
        $data = array();
        $data['id_facture'] = $id;
        $data['user'] = $this->session->userdata('user');
        $data['nb_messages'] = $this->nb_messages;
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $data['reglement'] = $this->reglements->constructeur($id_reglement)[0];
        $data['societes'] = $this->societes->getAll();

        $data['reglement']->compte = $this->comptes_bancaires->constructeur($data['reglement']->idCompte)[0];
        $data['reglement']->societe = $this->societes->constructeur($data['reglement']->compte->idSociete)[0];


        $data['comptes'] = $this->comptes_bancaires->getFromSociete($data['reglement']->societe->id);

        $this->form_validation->set_rules('montant', '"Montant"', 'trim|required|encode_php_tags|numeric|xss_clean');
        $this->form_validation->set_rules('compte', '"Compte"', 'trim|required|encode_php_tags|xss_clean');

        if ($this->form_validation->run()) {

            $reglement = new StdClass();
            $reglement->idCompte = $this->input->post('compte');
            $reglement->montant = $this->input->post('montant');

            $result = $this->reglements->modify($reglement, $id_reglement);

            if ($result) {
                redirect(base_url() . 'facturation/regler/' . $id);
            }
        } else {
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('pages/facturation/reglements/modifier');
            $this->load->view('template/footer');
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */