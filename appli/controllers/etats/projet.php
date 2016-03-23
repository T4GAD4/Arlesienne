<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); header('Content-Type: text/html; charset=utf-8');

class Projet extends CI_Controller {
    
    /**
     * 
     * Auteur : CAPI Aurélien
     * 
     */
    
	public function index()
	{
            $data = array();
            $data['user'] = $this->session->userdata('user');
            $data['nb_messages'] = $this->nb_messages;
            $data['menu'] = $this->load->view('template/menu',$data,true); 
            $data['projets'] = $this->projets->getEnCours();
            $this->load->view('template/header');
            $this->load->view('template/sidebar',$data);
            $this->load->view('pages/etats/projet');
            $this->load->view('template/footer');
	}
        
	public function generer()
	{
            $data = array();
            $data['user'] = $this->session->userdata('user');
            $data['nb_messages'] = $this->nb_messages;
            $data['menu'] = $this->load->view('template/menu',$data,true);  
            $data['projet'] = $this->projets->constructeur($this->input->post('projet'))[0];
            $data['marches'] = $this->marches->getFromProjet($data['projet']->id);
            foreach($data['marches'] as $marche){
                $marche->avenants = $this->avenants->getFromMarches($marche->id);
                $marche->repartitions = $this->montants_repartis->getFromMarches($marche->id);
                $marche->factures = Array();

                foreach($marche->repartitions as $repartition){
                    $facture = $this->factures->constructeur($repartition->idFacture)[0];
                    array_push($marche->factures, $facture);
                }
                
                $idEntreprises = Array();
                $marche->totalFacturesTTC = 0;
                $marche->totalReglements = 0;
                foreach($marche->factures as $facture){
                    $facture->entreprise = $this->entreprises->constructeur($facture->idEntreprise)[0];
                    array_push($idEntreprises,$facture->idEntreprise);
                    $facture->regle = $this->reglements->countFromFacture($facture->id)[0]->montant;
                    $marche->totalReglements += $facture->regle;
                    $marche->totalReglementsHT += $facture->regle / (1+($facture->tva/100));
                    $marche->totalFacturesTTC += calc_tva($facture->montantHT, $facture->tva);
                    $marche->totalFacturesHT += $facture->montantHT;
                }

                $marche->totalAvenantsTTC = 0;
                foreach($marche->avenants as $avenant){
                    $avenant->entreprise = $this->entreprises->constructeur($avenant->idEntreprise)[0];
                    array_push($idEntreprises,$facture->idEntreprise);
                    $avenant->nbFactures = $this->montants_repartis->countNbFacturesFromAvenant($avenant->id)[0]->nombre;
                    $avenant->mnt_reparti = $this->montants_repartis->countFromAvenant($avenant->id)[0]->montant;
                    $marche->totalAvenantsTTC += calc_tva($avenant->montantHT, $avenant->TVA);
                    $marche->totalAvenantsHT += floatval($avenant->montantHT);
                }

                //On supprime les doublons
                $idEntreprises = array_unique($idEntreprises);
                $marche->entreprises = Array();
                foreach($idEntreprises as $entreprise){
                    array_push($marche->entreprises,$this->entreprises->constructeur($entreprise)[0]);
                }
            }
            $this->load->view('template/header');
            $this->load->view('template/sidebar',$data);
            $this->load->view('pages/etats/generation/projet');
            $this->load->view('template/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */