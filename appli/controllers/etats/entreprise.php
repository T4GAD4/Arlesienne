<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
header('Content-Type: text/html; charset=utf-8');

class Entreprise extends CI_Controller {

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
        $data['entreprises'] = $this->entreprises->getAll();
        $data['projets'] = $this->projets->getAll();
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/etats/entreprise');
        $this->load->view('template/footer');
    }

    public function generer() {
        $data = array();
        $data['user'] = $this->session->userdata('user');
        $data['nb_messages'] = $this->nb_messages;
        $data['menu'] = $this->load->view('template/menu', $data, true);

        $data['entreprise'] = $this->entreprises->constructeur($this->input->post('entreprise'))[0];
        $this->form_validation->set_rules('projets[]', '"Projet"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('entreprise', '"Entreprise"', 'trim|required|encode_php_tags|xss_clean');
        if ($this->form_validation->run()) {
            $idProjets = $this->input->post('projets');
            $data['projets'] = Array();
            //On récupére les projets
            foreach ($idProjets as $idProjet) {
                array_push($data['projets'], $this->projets->constructeur($idProjet)[0]);
            }
            //On va chercher pour chaque projet les marchés
            foreach ($data['projets'] as $projet) {
                $projet->marches = $this->marches->getFromProjet($projet->id);
                //Il faut mettre le sizeof dans une variable sinon le for remplace à chaque fois la valeur quand on supprime un élément
                $taille_marches = sizeof($projet->marches);
                //Pour chaque marché, on va chercher les entreprises travaillant dans ce marché
                for ($i = 0; $i < $taille_marches; $i++) {
                    $idEntreprises = Array();
                    $data['repartitions'] = $this->montants_repartis->getFromMarches($projet->marches[$i]->id);
                    foreach ($data['repartitions'] as $repartition) {
                        $facture = $this->factures->constructeur($repartition->idFacture)[0];
                        array_push($idEntreprises, $facture->idEntreprise);
                    }
                    $data['avenants'] = $this->avenants->getFromMarches($projet->marches[$i]->id);
                    foreach ($data['avenants'] as $avenant) {
                        array_push($idEntreprises, $facture->idEntreprise);
                    }
                    //On a récupéré toute les entreprises travaillant sur le marché
                    $idEntreprises = array_unique($idEntreprises);
                    //Si l'entreprise ne fait pas parti du marché, on supprime le marché
                    if (!in_array($this->input->post('entreprise'), $idEntreprises)) {
                        unset($projet->marches[$i]);
                    }
                }
                $projet->marches = array_values($projet->marches);
                
                //Pour chaque marché, on va aller chercher le reste à afficher
                foreach ($projet->marches as $marche) {
                    $marche->factures = Array();
                    $marche->repartitions = $this->montants_repartis->getFromMarches($marche->id);
                    //On va chercher les factures qui sont répartis dans le marché
                    foreach ($marche->repartitions as $repartition) {
                        $facture = $this->factures->constructeur($repartition->idFacture)[0];
                        if($this->input->post('entreprise') == $facture->idEntreprise){
                            array_push($marche->factures, $facture);
                        }
                    }
                    $marche->totalReglements = 0;
                    $marche->totalFacturesTTC = 0;
                    foreach ($marche->factures as $facture) {
                        $facture->regle = $this->reglements->countFromFacture($facture->id)[0]->montant;
                        $marche->totalReglements += $facture->regle;
                        $marche->totalReglementsHT += $facture->regle / (1+($facture->tva/100));
                        $marche->totalFacturesTTC += calc_tva($facture->montantHT, $facture->tva);
                        $marche->totalFacturesHT += $facture->montantHT;
                    }
                    $marche->avenants = $this->avenants->getFromMarches($marche->id);
                    $marche->totalAvenantsTTC = 0;
                    $marche->totalAvenantsHT = 0;
                    //Taille avenants
                    $taille = sizeof($marche->avenants);
                    for ($i=0;$i < $taille; $i++) {
                        if($this->input->post('entreprise') != $marche->avenants[$i]->idEntreprise){
                            unset($marche->avenants[$i]);
                        }
                    }
                    foreach($marche->avenants as $avenant){
                        $marche->totalAvenantsTTC += calc_tva($avenant->montantHT, $avenant->TVA);
                        $marche->totalAvenantsHT += floatval($avenant->montantHT);
                    }
                }
            }
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('pages/etats/generation/entreprise');
            $this->load->view('template/footer');
        } else {
            $data['entreprises'] = $this->entreprises->getAll();
            $data['projets'] = $this->projets->getAll();
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('pages/etats/entreprise');
            $this->load->view('template/footer');
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */