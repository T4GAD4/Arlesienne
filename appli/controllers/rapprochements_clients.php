<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); header('Content-Type: text/html; charset=utf-8');

class Rapprochements_clients extends CI_Controller {
    
    /**
     * 
     * Auteur : CAPI Aurélien
     * 
     */
    
	public function vue($nom)
	{
            $data = array();
            $data['user'] = $this->session->userdata('user');
            $data['nb_messages'] = $this->nb_messages;
            $data['menu'] = $this->load->view('template/menu',$data,true);  
            
            $data['projet'] = $this->projets->getFromUrl($nom)[0];
            $secteurs = json_decode($data['projet']->secteur);
            
            $this->load->view('template/header');
            $this->load->view('template/sidebar',$data);
            
            if($secteurs == NULL){
                //Aucun secteur enregistré dans ce projet donc aucun rapprochement possible!
                $this->load->view('pages/rapprochements_clients/vide');
            }else{
                //On déclare un tableau vide dans lequel on va stocker les id qu'on aura récupérés
                $clients = Array();
                //Pour chaque secteur du projet, on va chercher l'idContact dans la table fiche_renseignement
                //et on l'insére dans $clients
                foreach($secteurs as $secteur){
                    $list_clients = $this->fiches->rapprochement($secteur);
                    foreach($list_clients as $client){
                        array_push($clients,$client->idContact);                        
                    }
                }
                //On peut récupérer dans $clients plusieurs fois le même idContact donc on va supprimer les doublons
                $clients = array_unique($clients);
                //On déclare le vrai tableau des contacts pour le rapprochement
                $data['clients'] = Array();
                //Pour chaque idContact On va chercher le contact
                foreach($clients as $client){
                    array_push($data['clients'],$this->contacts->getId($client)[0]);
                }
                //Pour chaque contact, on va chercher sa fiche de renseignements
                foreach($data['clients'] as $client){
                    $client->fiche = $this->fiches->getFromContact($client->id)[0];
                }
                
                //On charge la vue
                $this->load->view('pages/rapprochements_clients/liste',$data);
                
            }
            
            $this->load->view('template/footer');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */