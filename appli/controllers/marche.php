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
        $url = str_replace('%20',' ',$url);
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
        $data['marche'] = $this->marches->constructeur($id)[0];
        $data['projet'] = $this->projets->constructeur($data['marche']->idProjet)[0];
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $data['avenants'] = $this->avenants->getFromMarches($id);
        $data['repartitions'] = $this->montants_repartis->getFromMarches($id);
        $data['factures'] = Array();
        
        foreach($data['repartitions'] as $repartition){
            $facture = $this->factures->constructeur($repartition->idFacture)[0];
            array_push($data['factures'], $facture);
        }
        $idEntreprises = Array();
        $data['totalFacturesTTC'] = 0;
        $data['totalReglements'] = 0;
        foreach($data['factures'] as $facture){
            $facture->entreprise = $this->entreprises->constructeur($facture->idEntreprise)[0];
            array_push($idEntreprises,$facture->idEntreprise);
            $facture->regle = $this->reglements->countFromFacture($facture->id)[0]->montant;
            $data['totalReglements'] += $facture->regle;
            $data['totalFacturesTTC'] += calc_tva($facture->montantHT, $facture->tva);
        }
        
        $data['totalAvenantsTTC'] = 0;
        foreach($data['avenants'] as $avenant){
            $avenant->entreprise = $this->entreprises->constructeur($avenant->idEntreprise)[0];
            array_push($idEntreprises,$facture->idEntreprise);
            $avenant->nbFactures = $this->montants_repartis->countNbFacturesFromAvenant($avenant->id)[0]->nombre;
            $avenant->mnt_reparti = $this->montants_repartis->countFromAvenant($avenant->id)[0]->montant;
            $data['totalAvenantsTTC'] += calc_tva($avenant->montantHT, $avenant->TVA);
        }
        
        
        
        //On supprime les doublons
        $idEntreprises = array_unique($idEntreprises);
        $data['entreprises'] = Array();
        foreach($idEntreprises as $entreprise){
            array_push($data['entreprises'],$this->entreprises->constructeur($entreprise)[0]);
        }
        foreach($data['entreprises'] as $entreprise){
            //On insére les bases
            $entreprise->avenantHT = 0;
            $entreprise->avenantTTC = 0;
            $entreprise->factureHT = 0;
            $entreprise->facturesTTC = 0;
            $entreprise->reglementHT = 0;
            $entreprise->reglementTTC = 0;
            //Il faut aller chercher les avenants de l'entreprise dans le marché
            $avenants = $this->avenants->getFromMarchesEntreprise($id,$entreprise->id);
            foreach($avenants as $avenant){
                $entreprise->avenantHT += $avenant->montantHT;
                $entreprise->avenantTTC += calc_tva($avenant->montantHT,$avenant->TVA);
            }
            //Il faut aller chercher les factures de l'entreprise dans le marché
            //Pour cela, on va devoir passer par les répartitions
            $repartitions = $this->montants_repartis->getFromMarches($id);
            //On va chercher les id Factures
            $idFactures = Array();
            foreach($repartitions as $repartition){
                array_push($idFactures, $repartition->idFacture);
            }
            //On enléve les doublons
            $idFactures = array_unique($idFactures);
            $factures = Array();
            //Pour chaque facture, on va la récupérer
            foreach($idFactures as $idFacture){
                array_push($factures,$this->factures->constructeur($idFacture)[0]);
            }
            //On va virer les factures qui ne sont pas de l'entreprise
            $size = sizeof($factures);
            for($i=0; $i < $size; $i++){
                if($factures[$i]->idEntreprise != $entreprise->id){
                    unset($factures[$i]);
                }
            }
            $factures = array_values($factures);
            foreach($factures as $facture){
                $entreprise->factureHT += $facture->montantHT;
                $entreprise->factureTTC += calc_tva($facture->montantHT,$facture->tva);
                $facture->reglements = $this->reglements->getFromFacture($facture->id);
                foreach($facture->reglements as $reglement){
                    $entreprise->reglementHT += $reglement->montant / (1+($facture->tva/100));
                    $entreprise->reglementTTC += $reglement->montant;
                }
            }
        }
                
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/marche/detail');
        $this->load->view('template/footer');
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
            
            $result = $this->marches->update($marche,$id);
            
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
            
            redirect(base_url($_SERVER['HTTP_REFERER']));
        }
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/marche/modifier');
        $this->load->view('template/footer');
        
        
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */