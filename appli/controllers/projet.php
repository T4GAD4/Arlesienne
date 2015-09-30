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
        $data = array();
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $data['projets'] = $this->projets->getAll();
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
        $data = array();
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $data['projet'] = $this->projets->getFromUrl($nom)[0]; 
        $data['programmes'] = $this->programmes->getFromProjet($data['projet']->id);
        $data['marches_cat'] = $this->marches->getCategorie();
        foreach($data['programmes'] as $programme){
            $programme->marches = $this->marches->getFromProgramme($programme->idProgramme);       
        }
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/projet/detail');
        $this->load->view('template/footer');
    }

    public function ajouter() {

        $data = array();
        $data['nb_programmes'] = 0;

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
            $projet->idCompte = $this->input->post('compte');
            $projet->idSociete = $this->input->post('societe');
            $projet->nom = $this->input->post('nom');
            $projet->budget = $this->input->post('budget');
            $projet->etat = $this->input->post('etat');
            $projet->adresse = $this->input->post('adresse');
            $projet->cp = $this->input->post('codepostal');
            $projet->ville = $this->input->post('ville');
            $projet->commentaire = $this->input->post('commentaire');
            $projet->url = slugify($projet->nom);
            $result = $this->projets->add($projet);

            if ($result == true) {
                //On créé le dossier du projet
                shell_exec('cd "/home/srh/serveur/' . $projet->etat . '";'
                        . 'mkdir ' . $projet->url . ';');
                //On va créer les dossiers de chaque programme
                $nb_programmes = intval($this->input->post('number_champs'));
                if ($nb_programmes != 0) {
                    for ($i = 1; $i <= $nb_programmes; $i++) {
                        if($this->input->post("champs$i") != ""){
                            $programme = new stdClass();
                            $programme->nom = slugify($this->input->post("champs$i"));
                            $programme->idProjet = $result->id;
                            //On ajoute le programme en BDD
                            $resultat = $this->programmes->add($programme);
                            
                            //On récupére id programme enregistré pour créer ses marchés
                            creer_marches($resultat);
                            //On crée le dossier du programme
                            shell_exec('cd "/home/srh/serveur/' . $projet->etat . '/' . $projet->url . '";'
                                    . 'mkdir ' . $programme->nom . ';');
                            //On ajoute l'arborescence dans le dossier
                            shell_exec('cp -r /home/srh/serveur/arborescence/* "/home/srh/serveur/' . $projet->etat . '/' . $projet->url . '/' . $programme->nom . '"');
                        }
                    }
                } else {
                    $programme = new stdClass();
                    $programme->nom = slugify("Général");
                    $programme->idProjet = $result->id;
                    $result = $this->programmes->add($programme);

                    //On récupére id programme enregistré pour créer ses marchés
                    creer_marches($result);

                    //On crée le dossier du programme
                    shell_exec('cd "/home/srh/serveur/' . $projet->etat . '/' . $projet->url . '";'
                            . 'mkdir ' . $programme->nom . ';');
                    //On ajoute l'arborescence dans le dossier
                    shell_exec('cp -r /home/srh/serveur/arborescence/* "/home/srh/serveur/' . $projet->etat . '/' . $projet->url . '/' . $programme->nom . '"');
                }
                redirect(base_url().'projet');
            }
        }
        $data['compte'] = $this->comptes_bancaires->getCompte();
        $data['societes'] = $this->societes->getAll();
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
        shell_exec('mv /home/srh/serveur/'.str_replace(' ','\ ',$projet->etat).'/'.$projet->url.' /home/srh/serveur/Projets\ terminés/');
        $projet->etat = "Projets terminés";
        $this->projets->modify($projet, $projet->id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function abandonne($id = 0) {
        if ($id == 0) {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $projet = $this->projets->constructeur($id)[0];
        shell_exec('mv /home/srh/serveur/'.str_replace(' ','\ ',$projet->etat).'/'.$projet->url.' /home/srh/serveur/Projets\ abandonnés/');
        $projet->etat = "Projets abandonnés";
        $this->projets->modify($projet, $projet->id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function etude($id = 0) {
        if ($id == 0) {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $projet = $this->projets->constructeur($id)[0];
        shell_exec('mv /home/srh/serveur/'.str_replace(' ','\ ',$projet->etat).'/'.$projet->url.' /home/srh/serveur/Projets\ à\ l\ étude/');
        $projet->etat = "Projets à l étude";
        $this->projets->modify($projet, $projet->id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function en_cours($id = 0) {
        if ($id == 0) {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $projet = $this->projets->constructeur($id)[0];
        shell_exec('mv /home/srh/serveur/'.str_replace(' ','\ ',$projet->etat).'/'.$projet->url.' /home/srh/serveur/Projets\ en\ cours/');
        $projet->etat = "Projets en cours";
        $this->projets->modify($projet, $projet->id);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function modifier($nom) {
        if ($nom == "") {
            redirect($_SERVER['HTTP_REFERER']);
        }

        $data = array();
        $data['old_projet'] = $this->projets->getFromUrl($nom);
        if(!empty($data['old_projet'])){
            $data['old_projet'] = $data['old_projet'][0];
        }else{
            redirect(base_url("projet"));
        }

        $this->form_validation->set_rules('nom', '"Nom"', 'trim|required|encode_php_tags|xss_clean|update_unique[projet.nom.id.' . $data['old_projet']->id . ']');
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
            $projet->idCompte = $this->input->post('compte');
            $projet->idSociete = $this->input->post('societe');
            $projet->nom = $this->input->post('nom');
            $projet->budget = $this->input->post('budget');
            $projet->adresse = $this->input->post('adresse');
            $projet->cp = $this->input->post('codepostal');
            $projet->ville = $this->input->post('ville');
            $projet->commentaire = $this->input->post('commentaire');
            $projet->url = slugify($projet->nom);
            $result = $this->projets->modify($projet, $data['old_projet']->id);

            if ($result == true) {
                //On va voir si on a changé de nom de projet
                if($data['old_projet']->url != $projet->url){
                    shell_exec('mv "/home/srh/serveur/'.$data['old_projet']->etat.'/'.$data['old_projet']->url.'" "/home/srh/serveur/'.$data['old_projet']->etat.'/'.$projet->url.'"');
                }
                
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
                            
                            //On récupére id programme enregistré pour créer ses marchés
                            creer_marches($result);
                            //On crée le dossier du programme
                            shell_exec('cd "/home/srh/serveur/' . $data['old_projet']->etat . '/' . $projet->url . '";'
                                    . 'mkdir ' . $programme->nom . ';');
                            //On ajoute l'arborescence dans le dossier
                            shell_exec('cp -r /home/srh/serveur/arborescence/* "/home/srh/serveur/' . $data['old_projet']->etat . '/' . $projet->url . '/' . $programme->nom . '"');
                        }
                    }
                }
                
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