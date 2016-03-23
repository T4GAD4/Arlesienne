<?php
header('Content-Type: text/html; charset=utf-8');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Projet extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * 
     */
    
    public function index($nom = "") {
        //On est sur la liste des projets
        
        $nom = str_replace('%20',' ',$nom);
        $data = array();
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $data['projets'] = $this->projets->getAll(); 
        foreach($data['projets'] as $projet){
            $marches = $this->marches->getFromProjet($projet->id);
            $projet->nb_marche_signes = 0;
            $projet->total_recu = 0;
            $projet->total_paye = 0;
            $projet->lots_totaux = $this->lots->countAllFromProjet($projet->id)[0]->nombre;
            $factures = $this->factures->getFromProjet($projet->id);
            foreach($marches as $marche){
                if($marche->devise == 'true'){
                    $projet->nb_marche_signes ++;
                }
                $montants_repartis = $this->montants_repartis->getFromMarches($marche->id);
                foreach($montants_repartis as $montant_reparti){
                    array_push($factures, $this->factures->constructeur($montant_reparti->idFacture)[0]);
                }
            }
            foreach($factures as $facture){
                $projet->total_recu = $projet->total_recu + floatval(calc_tva($facture->montantHT, $facture->tva,false) - $facture->avoir);
                $reglements = $this->reglements->getFromFacture($facture->id);
                if(sizeof($reglements) > 0){
                    foreach($reglements as $reglement){
                        $projet->total_paye = $projet->total_paye + floatval($reglement->montant);
                    }   
                }
            }
            
        }
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $data['etats'] = explode(';', $this->configurations->getValeur('select_etat')[0]->valeur);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/projet/liste');
        $this->load->view('template/footer');
    }
    
    public function detail($nom = "") {
        if($nom == ""){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $nom = str_replace('%20',' ',$nom);
        $data = array();
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $data['projet'] = $this->projets->getFromUrl($nom)[0]; 
        /* Commentaire programme
        $data['programmes'] = $this->programmes->getFromProjet($data['projet']->id);
        */
        $data['marches'] = $this->marches->getFromProjet($data['projet']->id);
        /* Commentaire programme
        foreach($data['marches'] as $marche){
            $marche->programmes = $this->marches->getProgrammes($marche->id);
        }
        */
        $data['projet']->avenants = 0;
        $data['projet']->marchesRemplis = 0;
        $data['projet']->marchesAZero = 0;
        $data['projet']->devise = 0;
        $data['projet']->nonDevise = 0;
        $data['totalMarchesHT'] = 0;
        $data['totalMarchesTTC'] = 0;
        $data['totalAvenantsHT'] = 0;
        $data['totalAvenantsTTC'] = 0;
        $data['totalFacturesHT'] = 0;
        $data['totalFacturesTTC'] = 0;
        $data['reglements'] = 0;
                
        $entreprises = Array();
        foreach($data['marches'] as $marche){
            //Nb avenants au projet
            $data['projet']->avenants = $data['projet']->avenants + intval($this->avenants->countAllFromMarche($marche->id)[0]->nombre);
            //Nb marches remplis / à zero
            if($marche->montantHT != "0"){$data['projet']->marchesRemplis = $data['projet']->marchesRemplis + 1;}
            else{$data['projet']->marchesAZero = $data['projet']->marchesAZero + 1;}
            //Nb marches devisé/non-devisé
            if($marche->devise != "false"){$data['projet']->devise = $data['projet']->devise + 1;}
            else{$data['projet']->nonDevise = $data['projet']->nonDevise + 1;} 
            
            //On va chercher Toutes les entreprises travaillant sur le projet
            //il faut donc remonter dans les avenants
            $avenants = $this->avenants->getFromMarches($marche->id);
            //On va enregistrer dans un tableau les entreprises liés aux avenants
            foreach($avenants as $avenant){
                array_push($entreprises,$avenant->idEntreprise);
                $data['totalAvenantsHT'] = $data['totalAvenantsHT'] + floatval($avenant->montantHT);
                $data['totalAvenantsTTC'] = $data['totalAvenantsTTC'] + calc_tva($avenant->montantHT,$avenant->TVA,false);
            }
            //On va stocker le total des marchés dans un variable.
            $data['totalMarchesHT'] = $data['totalMarchesHT'] + floatval($marche->montantHT);
            $data['totalMarchesTTC'] = $data['totalMarchesTTC'] + calc_tva($marche->montantHT,$marche->TVA,false);
        }
        //Il faut ensuite récupérer les factures
        $factures = $this->factures->getFromProjet($data['projet']->id);
        foreach($factures as $facture){
            array_push($entreprises,$facture->idEntreprise);
            $data['totalFacturesHT'] = $data['totalFacturesHT'] + $facture->montantHT;
            $data['totalFacturesTTC'] = $data['totalFacturesTTC'] + calc_tva($facture->montantHT, $facture->tva);
            $data['nbFactures'] = sizeof($factures);
            $data['reglements'] = $data['reglements'] + $this->reglements->countFromFacture($facture->id)[0]->montant;
        }
        //On va supprimer le doublons
        $ent = array_unique($entreprises);
        
        //Et pour chaque entreprise, on va aller chercher toutes ses infos!
        $entreprises = Array();
        foreach($ent as $entreprise){
            array_push($entreprises,$this->entreprises->constructeur($entreprise)[0]);
        }
        //On envoie les entreprises à la vue!
        $data['entreprises'] = $entreprises;
        $data['principaux'] = $this->lots->countByType($data['projet']->id,"principal")[0]->nombre;
        $data['secondaires'] = $this->lots->countByType($data['projet']->id,"secondaire")[0]->nombre;
        $data['categories'] = $this->marches->getCategorie($data['projet']->id);
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/projet/detail');
        $this->load->view('template/footer');
    }

    public function ajouter() {

        $data = array();
        $data['nb_programmes'] = 0;
        $data['secteurs'] = $this->secteurs->getAllSecteurs();

        $this->form_validation->set_rules('nom', '"Nom"', 'trim|required|encode_php_tags|xss_clean|is_unique[projet.nom]');
        $this->form_validation->set_rules('budget', '"Budget"', 'trim|required|encode_php_tags|numeric|xss_clean');
        $this->form_validation->set_rules('adresse', '"Adresse"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('codepostal', '"Code postal"', 'trim|required|numeric|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('ville', '"Ville"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('commentaire', '"Commentaire"', 'trim|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('etat', '""', '');
        $this->form_validation->set_rules('societe', '""', '');
        $this->form_validation->set_rules('compte', '""', '');

        $nb_programmes = intval($this->input->post('number_champs'));
        if ($nb_programmes != 0) {
            $data['nb_programmes'] = $nb_programmes;
            $data["programme"] = Array();
            for ($i = 1; $i <= $nb_programmes; $i++) {
                $data["programme"]["$i"] = $this->input->post("champs$i");
            }
        }

        if ($this->form_validation->run()) {
            $projet = new stdClass();
            $projet->secteur = json_encode($this->input->post('secteur'));
            $projet->idCompte = $this->input->post('compte');
            $projet->idSociete = $this->input->post('societe');
            $projet->nom = $this->input->post('nom');
            $projet->budget = $this->input->post('budget');
            $projet->etat = $this->input->post('etat');
            $projet->adresse = $this->input->post('adresse');
            $projet->cp = $this->input->post('codepostal');
            $projet->ville = $this->input->post('ville');
            $projet->commentaire = $this->input->post('commentaire');
            $projet->url = ucfirst(slugify("$projet->ville $projet->nom"));
            $idProjet = $this->projets->add($projet);
            
               
            if ($idProjet == true) {
                //On créé le dossier du projet
                shell_exec('cd "/home/srh/serveur/' . $projet->etat . '";'
                        . 'mkdir ' . $projet->url . ';');
                
                //On va créer les dossiers de chaque programme
                /* Commentaire programme
                $nb_programmes = intval($this->input->post('number_champs'));
                if ($nb_programmes != 0) {
                    for ($i = 1; $i <= $nb_programmes; $i++) {
                        if($this->input->post("champs$i") != ""){
                            $programme = new stdClass();
                            $programme->nom = slugify($this->input->post("champs$i"));
                            $programme->idProjet = $idProjet;
                            //On ajoute le programme en BDD
                            $resultat = $this->programmes->add($programme);
                        }
                    }
                } 
                else {
                    $programme = new stdClass();
                    $programme->nom = slugify("Général");
                    $programme->idProjet = $idProjet;
                    $result = $this->programmes->add($programme);
                }
                */
                //On récupére id programme enregistré pour créer ses marchés
                creer_marches($idProjet);
                
                shell_exec('cp -r /home/srh/serveur/ARBORESCENCE/* "/home/srh/serveur/' . $projet->etat . '/' . $projet->url . '/"');        
                
                redirect(base_url().'projet');
            }
        }
        $data['societes'] = $this->societes->getAll();
        $data['comptes'] = $this->comptes_bancaires->getFromSociete($data['societes'][0]->id);
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $data['select_etat'] = explode(';', $this->configurations->getValeur('select_etat')[0]->valeur);
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/projet/creer', $data);
        $this->load->view('template/footer');
    }

    public function termine($id = 0) {
        if ($id == 0) {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $projet = $this->projets->constructeur($id)[0];
        shell_exec('mv "/home/srh/serveur/'.$projet->etat.'/'.$projet->url.'" "/home/srh/serveur/Projets terminés/"');
        $projet->etat = "Projets terminés";
        $this->projets->update($projet, $projet->id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function abandonne($id = 0) {
        if ($id == 0) {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $projet = $this->projets->constructeur($id)[0];
        shell_exec('mv "/home/srh/serveur/'.$projet->etat.'/'.$projet->url.'" "/home/srh/serveur/Projets abandonnés/"');
        $projet->etat = "Projets abandonnés";
        $this->projets->update($projet, $projet->id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function etude($id = 0) {
        if ($id == 0) {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $projet = $this->projets->constructeur($id)[0];
        shell_exec('mv "/home/srh/serveur/'.$projet->etat.'/'.$projet->url.'" "/home/srh/serveur/Projets à l étude/"');
        $projet->etat = "Projets à l étude";
        $this->projets->update($projet, $projet->id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function en_cours($id = 0) {
        if ($id == 0) {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $projet = $this->projets->constructeur($id)[0];
        shell_exec('mv "/home/srh/serveur/'.$projet->etat.'/'.$projet->url.'" "/home/srh/serveur/Projets en cours/"');
        $projet->etat = "Projets en cours";
        $this->projets->update($projet, $projet->id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function modifier($nom) {
        if ($nom == "") {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $nom = str_replace('%20',' ',$nom);
        $data = array();
        $data['old_projet'] = $this->projets->getFromUrl($nom);
        $data['secteurs'] = $this->secteurs->getAllSecteurs();
        if(!empty($data['old_projet'])){
            $data['old_projet'] = $data['old_projet'][0];
        }else{
            redirect(base_url("projet"));
        }

        $this->form_validation->set_rules('nom', '"Nom"', 'trim|required|encode_php_tags|xss_clean|update_unique[projet$nom$id$' . $data['old_projet']->id . ']');
        $this->form_validation->set_rules('budget', '"Budget"', 'trim|required|encode_php_tags|numeric|xss_clean');
        $this->form_validation->set_rules('adresse', '"Adresse"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('codepostal', '"Code postal"', 'trim|required|numeric|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('ville', '"Ville"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('commentaire', '"Commentaire"', 'trim|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('etat', '""', '');
        $this->form_validation->set_rules('societe', '""', '');
        $this->form_validation->set_rules('compte', '""', '');

        if ($this->form_validation->run()) {
            $projet = new stdClass();
            $projet->secteur = json_encode($this->input->post('secteur'));
            $projet->idCompte = $this->input->post('compte');
            $projet->idSociete = $this->input->post('societe');
            $projet->nom = $this->input->post('nom');
            $projet->budget = $this->input->post('budget');
            $projet->adresse = $this->input->post('adresse');
            $projet->cp = $this->input->post('codepostal');
            $projet->ville = $this->input->post('ville');
            $projet->commentaire = $this->input->post('commentaire');
            $projet->url = ucfirst(slugify("$projet->ville $projet->nom"));
            
            $result = $this->projets->update($projet, $data['old_projet']->id);

            if ($result == true) {
                //On va voir si on a changé de nom de projet
                if($data['old_projet']->url != $projet->url){
                    shell_exec('mv "/home/srh/serveur/'.$data['old_projet']->etat.'/'.$data['old_projet']->url.'" "/home/srh/serveur/'.$data['old_projet']->etat.'/'.$projet->url.'"');
                }
                /* Commentaire programme
                //On vérifie si on a ajouté des programmes
                $nouveaux = intval($this->input->post('number_champs')) - intval($this->input->post('old_number_champs'));
                if ($nouveaux > 0) {
                    //On va ajouter les nouveaux
                    for ($i = intval($this->input->post('old_number_champs'))+1; $i <= intval($this->input->post('number_champs'))+1; $i++) {
                        if($this->input->post("champs$i") != ""){
                            $programme = new stdClass();
                            $programme->nom = slugify($this->input->post("champs$i"));
                            $programme->idProjet = $data['old_projet']->id;
                            //On ajoute le programme en BDD
                            $result = $this->programmes->add($programme);
                        }
                    }
                }*/
                
                redirect(base_url()."projet/");
            }
        }
        $data['projet'] = $this->projets->getFromUrl($nom)[0];
        $data['comptes'] = $this->comptes_bancaires->getFromSociete($data['projet']->idSociete);
        $data['programmes'] = $this->programmes->getFromProjet($data['projet']->id);
        $data['nb_programmes'] = sizeof($data['programmes']);
        $data['societes'] = $this->societes->getAll();
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $data['select_etat'] = explode(';', $this->configurations->getValeur('select_etat')[0]->valeur);
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/projet/modifier', $data);
        $this->load->view('template/footer');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */