<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
header('Content-Type: text/html; charset=utf-8');

class Vente extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * 
     */
    
    public function liste($nom = "") {
        if ($nom == "") {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $nom = str_replace('%20',' ',$nom);
        $data = array();
        $data['user'] = $this->session->userdata('user');
        $data['projet'] = $this->projets->getFromUrl($nom)[0];
        $data['ventes'] = $this->ventes->getFromProjet($data['projet']->id);
        foreach($data['ventes'] as $vente){
            $vente->lots = $this->ventes_lot->getFromVente($vente->id);
            $vente->clients = $this->ventes_client->getFromVente($vente->id);
            $vente->prix = $this->prixventes->getFromVente($vente->id);
            $clients = Array();
            if(sizeof($vente->clients) > 1){
                foreach($vente->clients as $client){
                    array_push($clients,$this->contacts->getId($client->idClient)[0]);
                }
            }else if(sizeof($vente->clients) == 1){
                array_push($clients,$this->contacts->getId($vente->clients[0]->idClient)[0]);
            }
            $vente->clients = $clients;
            $lots = Array();
            foreach($vente->lots as $lot){
                array_push($lots,$this->lots->constructeur($lot->idLot)[0]);
            }
            $vente->lots = $lots;
        }
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/vente/liste');
        $this->load->view('template/footer');
    }
    
    public function detail($id = 0){
        if($id == 0){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['user'] = $this->session->userdata('user');
        $data['vente'] = $this->ventes->constructeur($id)[0];
        $lots = $this->ventes_lot->getFromVente($id);
        $clients = $this->ventes_client->getFromVente($id);
        $data['vente']->prix = $this->prixventes->getFromVente($id);
        $data['vente']->lots = Array();
        $data['vente']->clients = Array();
        $apporteur = Array();
        $notaire_acquereur = Array();
        $notaire_vendeur = Array();
        foreach($lots as $lot){
            array_push($data['vente']->lots,$this->lots->constructeur($lot->idLot)[0]);
        }
        foreach($clients as $client){
            array_push($data['vente']->clients,$this->contacts->getId($client->idClient)[0]);
        }
        $apporteurs = explode(',',$data['vente']->apporteur);
        foreach($apporteurs as $apporteur1){
            array_push($apporteur,$this->contacts->getId($apporteur1)[0]);
        }
        $notaires = explode(',',$data['vente']->notaire_vendeur);
        foreach($notaires as $notaire){
            array_push($notaire_vendeur,$this->contacts->getId($notaire)[0]);
        }
        $notaires = explode(',',$data['vente']->notaire_acquereur);
        foreach($notaires as $notaire){
            array_push($notaire_acquereur,$this->contacts->getId($notaire)[0]);
        }
        
        $data['vente']->pret = $this->ventes_pret->getFromVente($id)[0];
        $banque = $this->entreprises->constructeur($data['vente']->pret->idBanque)[0];
        $data['vente']->pret->banque = new stdClass();
        $data['vente']->pret->banque = $banque;
        $data['vente']->apporteur = $apporteur;
        $data['vente']->notaire_vendeur = $notaire_vendeur;
        $data['vente']->notaire_acquereur = $notaire_acquereur;
        
        $data['compromis'] = Array();
        $data['compromis'] = $this->prixventes->getFromVentePrixCompromis($id);
        //On va calculer les prix compromis
        //On récupére le nombre de lots pour avoir le nombe de prix compromis
        $taille = sizeof($data['vente']->lots);
        $compromis = sizeof($data['compromis']);
        $data['prixcompromis'] = Array();
        //Sur tout les prix compromis
        for($i = 0; $i < $compromis; $i+=$taille  ){
            //On fait un step dunombre de lots pour avoir chaque prix compromis par étape
            $temp = Array();
            for($j = 0; $j < $taille; $j++){
                //On traite le prix
                array_push($temp, $data['compromis'][$j]);
                //On supprime du tableau
                unset($data['compromis'][$j]);
            }
            //On va chercher le detail du lot pour chaque prix compromis
            foreach($temp as $prix){
                $prix->lot = new stdClass();
                $prix->lot = $this->lots->constructeur($prix->idLot)[0];
            }
            //On encode le temp
            $temp = json_encode($temp);
            //On le balance dans la variable qu'on pourra récupérer
            array_push($data['prixcompromis'],$temp);
            //On remet le tableau à 0;
            $data['compromis'] = array_values($data['compromis']);
        }
        
        //On va chercher le prix acte
        $data['prixacte'] = $this->prixventes->getFromVentePrixActe($id);
        
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/vente/detail');
        $this->load->view('template/footer');
    }

    public function creer($nom = "") {
        if ($nom == "") {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $nom = str_replace('%20',' ',$nom);
        $data = array();
        $data['user'] = $this->session->userdata('user');
        $data['projet'] = $this->projets->getFromUrl($nom)[0];
        $data['lots'] = $this->lots->getFromProjet($data['projet']->id);
        $data['clients'] = $this->contacts->getAll();

        $this->form_validation->set_rules('lots[]', '"Numero du lot"', 'trim|required|encode_php_tags|xss_clean|numero_lot[' . $data['projet']->id . '$' . $this->input->post('numero_lot') . ']');
        $this->form_validation->set_rules('clients[]', '"Numero de copro"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('notaire_vendeur[]', '"Notaire vendeur"', 'trim|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('notaire_acquereur[]', '"Notaire acquéreur"', 'trim|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('apporteurs[]', '"Apporteur(s)"', 'trim|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('prixnetvendeur', '"Prix net vendeur"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('typeTVA', '"Type TVA"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('tvaprixnetvendeur', '"TVA prix net vendeur"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('typefraisagence', '"Type frais agence"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('fraisagence', '"Frais agence"', 'trim|required|encode_php_tags|xss_clean');

        if ($this->form_validation->run()) {
            //On va créer la vente
            $vente = new stdClass();
            $vente->idProjet = $data['projet']->id;
            $vente->etat = "initial";
            $vente->apporteur = implode(',',$this->input->post('apporteurs'));
            $vente->notaire_vendeur = implode(',',$this->input->post('notaire_vendeur'));
            $vente->notaire_acquereur = implode(',',$this->input->post('notaire_acquereur'));
            $vente->date = Date('Y-m-d');
            $vente->urldossier = "";
            $result = $this->ventes->creer($vente);
            var_dump($result);

            //On va créer les clients de la vente
            $vente_clients = new stdClass();
            $vente_clients->idVente = $result;
            $clients = Array();
            foreach ($this->input->post('clients') as $key => $value) {
                $vente_clients->idClient = $value;
                $this->ventes_client->creer($vente_clients);
                $cli = $this->contacts->getId($vente_clients->idClient);
                foreach($cli as $cli2){
                    array_push($clients,  strtoupper($cli2->nom));
                }  
            }
            
            //On va créer le groupement de lots
            $vente_lots = new stdClass();
            $vente_lots->idVente = $result;
            $lots = Array();
            foreach ($this->input->post('lots') as $key => $value) {
                $vente_lots->idLot = $value;
                $this->ventes_lot->creer($vente_lots);
                $num = $this->lots->constructeur($vente_lots->idLot);
                foreach($num as $numero){
                    array_push($lots,$numero->numero_lot);
                }                
            }
            //On va générer l'url du dossier
            unset($vente);
            $vente = new StdClass();
            foreach($lots as $lot){
                $vente->urldossier .= "Lot ".$lot." ";
            }
            $vente->urldossier .= "- ".implode(' ',$clients);
            $this->ventes->update($vente,$result);
            
            //On va créer le dossier de la vente
            shell_exec('mkdir "/home/srh/serveur/' . $data['projet']->etat . '/'.$data['projet']->url.'/COMMERCIAL/3- Gestion des ventes/1- Prospects/'.$vente->urldossier.'";');
            //on envoie tout le contenu de (Nom entreprise) dans le dossier de l'entreprise
            $cmd = 'cp -r "/home/srh/serveur/' . $data['projet']->etat . '/'.$data['projet']->url.'/COMMERCIAL/3- Gestion des ventes/1- Prospects/(Lot X1) (LOT X2) - (Nom Acquéreur)"/*  "/home/srh/serveur/' . $data['projet']->etat . '/'.$data['projet']->url.'/COMMERCIAL/3- Gestion des ventes/1- Prospects/'.$vente->urldossier.'/";';
            $result = shell_exec($cmd);
            
            redirect(base_url('vente/liste/'.$data['projet']->url));
        }else{
            $data['menu'] = $this->load->view('template/menu', $data, true);
            $data['select_contacts'] = explode(';',$this->configurations->getValeur('select_contacts')[0]->valeur);
            $data['type_contact'] = explode(';',$this->configurations->getValeur('type_contact')[0]->valeur);
            $data['liste_diffusions'] = explode(';',$this->configurations->getValeur('liste_diffusion')[0]->valeur);
            $data['entreprises'] = $this->entreprises->getAll();
            $data['checkbox'] = $this->input->post('autoentrepreneur');
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('pages/vente/creer');
            $this->load->view('template/footer');
        }
    }

    public function modifier($id = 0) {
        if ($id == 0) {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['user'] = $this->session->userdata('user');
        $data['vente'] = $this->ventes->constructeur($id)[0];
        $data['projet'] = $this->projets->constructeur($data['vente']->idProjet)[0];

        $this->form_validation->set_rules('lots[]', '"Numero du lot"', 'trim|required|encode_php_tags|xss_clean|numero_lot[' . $data['projet']->id . '$' . $this->input->post('numero_lot') . ']');
        $this->form_validation->set_rules('clients[]', '"Numero de copro"', 'trim|required|encode_php_tags|xss_clean');

        if ($this->form_validation->run()) {
            $this->ventes_client->deleteAllVentes($id);
            $vente_clients = new stdClass();
            $vente->apporteur = (Array) implode(',',$this->input->post('apporteurs'));
            $vente->notaire_vendeur = implode(',',$this->input->post('notaire_vendeur'));
            $vente->notaire_acquereur = implode(',',$this->input->post('notaire_acquereur'));
            $this->ventes->update($vente,$id);
            //On va modifier les clients de la vente
            $vente_clients->idVente = $id;
            $clients = Array();
            foreach ($this->input->post('clients') as $key => $value) {
                $vente_clients->idClient = $value;
                $this->ventes_client->creer($vente_clients);
                $cli = $this->contacts->getId($vente_clients->idClient);
                foreach($cli as $cli2){
                    array_push($clients,  strtoupper($cli2->nom));
                }
            }

            //On va modifier le groupement de lots
            $this->ventes_lot->deleteAllVentes($id);
            $vente_lots = new stdClass();
            $vente_lots->idVente = $id;
            $lots = Array();
            foreach ($this->input->post('lots') as $key => $value) {
                $vente_lots->idLot = $value;
                $this->ventes_lot->creer($vente_lots);
                $num = $this->lots->constructeur($vente_lots->idLot);
                foreach($num as $numero){
                    array_push($lots,$numero->numero_lot);
                } 
            }            
            //On va générer l'url du dossier
            unset($vente);
            $vente = new StdClass();
            foreach($lots as $lot){
                $vente->urldossier .= "Lot ".$lot." ";
            }
            $vente->urldossier .= "- ".implode(' ',$clients);
            
            $this->ventes->update($vente,$id);
            switch($data['vente']->etat){
                case "compromis" : $dossier = "2- Compromis";break;
                case "acte" : $dossier = "3- Acté";break;
                case "abandonne" : $dossier = "4- Abandonné";break;
                case "initial" : $dossier = "1- Prospects";break;
            }
            if($data['vente']->urldossier != $vente->urldossier){
                $cmd = 'mv "/home/srh/serveur/'.$data['projet']->etat.'/'.$data['projet']->url.'/COMMERCIAL/3- Gestion des ventes/'.$dossier.'/'.$data['vente']->urldossier.'" "/home/srh/serveur/'.$data['projet']->etat.'/'.$data['projet']->url.'/COMMERCIAL/3- Gestion des ventes/'.$dossier.'/'.$vente->urldossier.'"';
                shell_exec($cmd);
            }
            redirect(base_url('vente/detail/'.$data['vente']->id));
        }

        $data['vente'] = $this->ventes->constructeur($id)[0];
        $data['projet'] = $this->projets->constructeur($data['vente']->idProjet)[0];
        $lots = $this->ventes_lot->getFromVente($id);
        $data['vente_lots'] = Array();
        foreach ($lots as $lot) {
            array_push($data['vente_lots'], $lot->idLot);
        }
        $clients = $this->ventes_client->getFromVente($id);
        $data['vente_clients'] = Array();
        foreach ($clients as $client) {
            array_push($data['vente_clients'], $client->idClient);
        }
        $data['prix'] = $this->prixventes->getFromVente($id)[0];
        $data['lots'] = $this->lots->getFromProjet($data['projet']->id);
        $data['clients'] = $this->contacts->getAll();

        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/vente/modifier');
        $this->load->view('template/footer');
    }
    
    public function pret($id = 0) {
        if ($id == 0) {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['user'] = $this->session->userdata('user');
        $data['vente'] = $this->ventes->constructeur($id)[0];
        $banque = $this->entreprises->constructeur($data['vente']->pret->idBanque)[0];
        $data['vente']->pret->banque = new stdClass();
        $data['vente']->pret->banque = $banque;
        
        $this->form_validation->set_rules('date_compromis', '"Date de compromis"', 'trim|required|encode_php_tags|xss_clean|regex_match[/[0-9]{4}-[0-9]{2}-[0-9]{2}/]');
        $this->form_validation->set_rules('date_obtention', '"Date d\'obtention"', 'trim|encode_php_tags|xss_clean|regex_match[/[0-9]{4}-[0-9]{2}-[0-9]{2}/]');
        $this->form_validation->set_rules('delai', '"Délai d\'offre"', 'trim|required|encode_php_tags|xss_clean');
        if($this->input->post('date_obtention')){
            $this->form_validation->set_rules('banque', '"Banque"', 'trim|required|encode_php_tags|xss_clean');
            $banque = $this->input->post('banque');
        }else{
            $this->form_validation->set_rules('banque', '"Banque"', 'trim|encode_php_tags|xss_clean');
            $banque = null;
        }
        if($this->form_validation->run()){ 
            
            $pret = new StdClass();
            $pret->idVente = $id;
            $pret->idBanque = $banque;
            $pret->date_signature = $this->input->post('date_compromis');
            $pret->delai = $this->input->post('delai');
            $pret->date_obtention_pret = $this->input->post('date_obtention');
            
            $this->ventes_pret->creer($pret);
            
            redirect(base_url('vente/detail/'.$id));
        }
        
        $data['entreprises'] = $this->entreprises->getAll();
        foreach($data['entreprises'] as $key => $entreprise){
            $array = explode(';',$entreprise->corps_metier);
            if(!in_array("banque", $array)){
                unset($data['entreprises'][$key]);
            }
        }
        $metiers = $this->entreprises->getMetiers();
        $array = Array();
        foreach($metiers as $metier){
            $var = explode(';',$metier->corps_metier);
            foreach($var as $v){
                if($v != ""){
                    array_push($array,$v);
                }
            }
        }
        $data['metiers'] = array_unique($array);
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/vente/pret/creer');
        $this->load->view('template/footer');
    }
    
    public function modif_pret($id = 0) {
        if ($id == 0) {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['user'] = $this->session->userdata('user');
        $data['pret'] = $this->ventes_pret->constructeur($id)[0];
        
        
        $this->form_validation->set_rules('date_compromis', '"Date de compromis"', 'trim|required|encode_php_tags|xss_clean|regex_match[/[0-9]{4}-[0-9]{2}-[0-9]{2}/]');
        $this->form_validation->set_rules('date_obtention', '"Date d\'obtention"', 'trim|encode_php_tags|xss_clean|regex_match[/[0-9]{4}-[0-9]{2}-[0-9]{2}/]');
        $this->form_validation->set_rules('delai', '"Délai d\'offre"', 'trim|required|encode_php_tags|xss_clean');
        if($this->input->post('date_obtention')){
            $this->form_validation->set_rules('banque', '"Banque"', 'trim|required|encode_php_tags|xss_clean');
            $banque = $this->input->post('banque');
        }else{
            $this->form_validation->set_rules('banque', '"Banque"', 'trim|encode_php_tags|xss_clean');
            $banque = null;
        }

        if($this->form_validation->run()){ 
            
            $pret = new StdClass();
            $pret->idBanque = $banque;
            $pret->date_signature = $this->input->post('date_compromis');
            $pret->delai = $this->input->post('delai');
            $pret->date_obtention_pret = $this->input->post('date_obtention');
            
            $this->ventes_pret->update($pret,$id);
            
            redirect(base_url('vente/detail/'.$data['pret']->idVente));
        }
        $data['entreprises'] = $this->entreprises->getAll();
        foreach($data['entreprises'] as $key => $entreprise){
            $array = explode(';',$entreprise->corps_metier);
            if(!in_array("banque", $array)){
                unset($data['entreprises'][$key]);
            }
            
        }
        $metiers = $this->entreprises->getMetiers();
        $array = Array();
        foreach($metiers as $metier){
            $var = explode(';',$metier->corps_metier);
            foreach($var as $v){
                if($v != ""){
                    array_push($array,$v);
                }
            }
        }
        $data['metiers'] = array_unique($array);
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/vente/pret/modifier');
        $this->load->view('template/footer');
    }
    
    public function compromis($id = 0){
        if($id == 0){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['user'] = $this->session->userdata('user');
        $data['vente'] = $this->ventes->constructeur($id)[0];
        $lots = $this->ventes_lot->getFromVente($id);
        $data['vente']->lots = Array();
        foreach($lots as $lot){
            array_push($data['vente']->lots,$this->lots->constructeur($lot->idLot)[0]);
        }
        $data['projet'] = $this->projets->constructeur($data['vente']->lots[0]->idProjet)[0];
        foreach($data['vente']->lots as $lot){
            $this->form_validation->set_rules($lot->id.'prixnetvendeur', '"Prix net vendeur"', 'trim|required|encode_php_tags|xss_clean');
            $this->form_validation->set_rules($lot->id.'typeTVA', '"Type TVA"', 'trim|required|encode_php_tags|xss_clean');
            $this->form_validation->set_rules($lot->id.'tvaprixnetvendeur', '"TVA prix net vendeur"', 'trim|required|encode_php_tags|xss_clean');
            $this->form_validation->set_rules($lot->id.'typefraisagence', '"Type frais agence"', 'trim|required|encode_php_tags|xss_clean');
            $this->form_validation->set_rules($lot->id.'fraisagence', '"Frais agence"', 'trim|required|encode_php_tags|xss_clean');
        }
        
        if($this->form_validation->run()){
            foreach($data['vente']->lots as $lot){
                $compromis = new StdClass();
                $compromis->date = Date('Y-m-d');
                $compromis->etat = "compromis";
                $compromis->idVente = $id;
                $compromis->idLot = $lot->id;
                $compromis->prixnetvendeur = $this->input->post($lot->id.'prixnetvendeur');
                $compromis->typeTVA = $this->input->post($lot->id.'typeTVA');
                $compromis->TVA = $this->input->post($lot->id.'tvaprixnetvendeur');
                $compromis->typefraisagence = $this->input->post($lot->id.'typefraisagence');
                $compromis->fraisagence = $this->input->post($lot->id.'fraisagence');
                
                $this->prixventes->creer($compromis);
            }
            $vente = new stdClass();
            $vente->etat = "compromis";
            $this->ventes->update($vente,$id);
            
            $cmd = 'mv "/home/srh/serveur/' . $data['projet']->etat . '/'.$data['projet']->url.'/COMMERCIAL/3- Gestion des ventes/1- Prospects/'.$data['vente']->urldossier.'/" "/home/srh/serveur/' . $data['projet']->etat . '/'.$data['projet']->url.'/COMMERCIAL/3- Gestion des ventes/2- Compromis/"';
            shell_exec($cmd);
        
            
            redirect(base_url('vente/detail/'.$id));
        }
        
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/vente/compromis');
        $this->load->view('template/footer');
    }
    
     public function abandonner($id = 0){
        if($id == 0){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['user'] = $this->session->userdata('user');
        $data['vente'] = $this->ventes->constructeur($id)[0];
        $lots = $this->ventes_lot->getFromVente($id);
        $data['vente']->lots = Array();
        foreach($lots as $lot){
            array_push($data['vente']->lots,$this->lots->constructeur($lot->idLot)[0]);
        }
        $data['projet'] = $this->projets->constructeur($data['vente']->lots[0]->idProjet)[0];
        $vente = new stdClass();
        $vente->etat = "abandonne";
        $this->ventes->update($vente,$id);
        switch($data['vente']->etat){
            case "compromis" : $dossier = "2- Compromis";break;
            case "acte" : $dossier = "3- Acté";break;
            case "abandonne" : $dossier = "4- Abandonné";break;
            case "initial" : $dossier = "1- Prospects";break;
        }
        $cmd = 'mv "/home/srh/serveur/' . $data['projet']->etat . '/'.$data['projet']->url.'/COMMERCIAL/3- Gestion des ventes/'.$dossier.'/'.$data['vente']->urldossier.'/" "/home/srh/serveur/' . $data['projet']->etat . '/'.$data['projet']->url.'/COMMERCIAL/3- Gestion des ventes/4- Abandonné/"';
        shell_exec($cmd);


        redirect(base_url('vente/detail/'.$id));
    }
    
        public function acte($id = 0){
        if($id == 0){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['user'] = $this->session->userdata('user');
        $data['vente'] = $this->ventes->constructeur($id)[0];
        $data['projet'] = $this->projets->constructeur($data['vente']->idProjet)[0];
        $lots = $this->ventes_lot->getFromVente($id);
        $data['vente']->lots = Array();
        foreach($lots as $lot){
            array_push($data['vente']->lots,$this->lots->constructeur($lot->idLot)[0]);
        }
        
        foreach($data['vente']->lots as $lot){
            $this->form_validation->set_rules($lot->id.'prixnetvendeur', '"Prix net vendeur"', 'trim|required|encode_php_tags|xss_clean');
            $this->form_validation->set_rules($lot->id.'typeTVA', '"Type TVA"', 'trim|required|encode_php_tags|xss_clean');
            $this->form_validation->set_rules($lot->id.'tvaprixnetvendeur', '"TVA prix net vendeur"', 'trim|required|encode_php_tags|xss_clean');
            $this->form_validation->set_rules($lot->id.'typefraisagence', '"Type frais agence"', 'trim|required|encode_php_tags|xss_clean');
            $this->form_validation->set_rules($lot->id.'fraisagence', '"Frais agence"', 'trim|required|encode_php_tags|xss_clean');
        }
        
        if($this->form_validation->run()){
            foreach($data['vente']->lots as $lot){
                $acte = new StdClass();
                $acte->date = Date('Y-m-d');
                $acte->etat = "acte";
                $acte->idVente = $id;
                $acte->idLot = $lot->id;
                $acte->prixnetvendeur = $this->input->post($lot->id.'prixnetvendeur');
                $acte->typeTVA = $this->input->post($lot->id.'typeTVA');
                $acte->TVA = $this->input->post($lot->id.'tvaprixnetvendeur');
                $acte->typefraisagence = $this->input->post($lot->id.'typefraisagence');
                $acte->fraisagence = $this->input->post($lot->id.'fraisagence');
                
                $this->prixventes->creer($acte);
            }
            $vente = new stdClass();
            $vente->etat = "acte";
            $this->ventes->update($vente,$id);
            
            $cmd = 'mv "/home/srh/serveur/' . $data['projet']->etat . '/'.$data['projet']->url.'/COMMERCIAL/3- Gestion des ventes/2- Compromis/'.$data['vente']->urldossier.'/" "/home/srh/serveur/' . $data['projet']->etat . '/'.$data['projet']->url.'/COMMERCIAL/3- Gestion des ventes/3- Acté/"';
            shell_exec($cmd);
            
            redirect(base_url('vente/detail/'.$id));
        }
        
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/vente/acte');
        $this->load->view('template/footer');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */