<?php

header('Content-Type: text/html; charset=utf-8');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lot extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * 
     */
    public function liste($url = "") {
        if ($url == "") {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $url = str_replace('%20',' ',$url);
        $data = array();
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $data['projet'] = $this->projets->getFromUrl($url)[0];

        $data['principaux'] = $this->lots->getPrincipaux($data['projet']->id);
        $data['secondaires'] = $this->lots->getSecondaires($data['projet']->id);

        foreach ($data['principaux'] as $lot) {
            $lot->surfaces = $this->surfaces->getAllFromLot($lot->id);
        }
        foreach ($data['secondaires'] as $lot) {
            $lot->surfaces = $this->surfaces->getAllFromLot($lot->id);
        }

        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/lots/liste');
        $this->load->view('template/footer');
    }

    public function creer($url = "") {
        if ($url == "") {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $url = str_replace('%20',' ',$url);
        $data = array();
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $data['projet'] = $this->projets->getFromUrl($url)[0];

        if ($this->input->post()) {

            $this->form_validation->set_rules('numero_lot', '"Numero du lot"', 'trim|required|encode_php_tags|xss_clean|numero_lot[' . $data['projet']->id . '$' . $this->input->post('numero_lot') . ']');
            $this->form_validation->set_rules('numero_copro', '"Numero de copro"', 'trim|encode_php_tags|xss_clean');
            $this->form_validation->set_rules('numero_postal', '"Numero postal"', 'trim|encode_php_tags|xss_clean');
            $this->form_validation->set_rules('numero_pdl_edf', '"Numero PDL EDF"', 'trim|encode_php_tags|xss_clean');
            $this->form_validation->set_rules('description', '"Descrption"', 'trim|encode_php_tags|xss_clean');
            $this->form_validation->set_rules('type', '"Type"', 'trim|required|encode_php_tags|xss_clean');
            $this->form_validation->set_rules('type_surface', '"Type de surface"', 'required|encode_php_tags|xss_clean');
            $this->form_validation->set_rules('type_surface[plancher_brute]', '"Type de surface"', 'encode_php_tags|xss_clean');
            $this->form_validation->set_rules('type_surface[habitable]', '"Type de surface"', 'encode_php_tags|xss_clean');
            $this->form_validation->set_rules('type_surface[utile]', '"Type de surface"', 'encode_php_tags|xss_clean');
            $this->form_validation->set_rules('type_surface[terrain]', '"Type de surface"', 'encode_php_tags|xss_clean');
            $this->form_validation->set_rules('pieces[]', '"Piéces"', 'encode_php_tags|xss_clean');
            $this->form_validation->set_rules('surfaces[]', '"Surfaces"', 'encode_php_tags|xss_clean');
            if($this->input->post('tvaprixnetvendeur') != 0 || $this->input->post('tvaprixnetvendeur') != "" || $this->input->post('tvaprixnetvendeur') != "0"){
                $this->form_validation->set_rules('typeTVA', '"Type TVA"', 'required|encode_php_tags|xss_clean');
                $this->form_validation->set_rules('typefraisagence', '"Type frais d\'agence"', 'required|encode_php_tags|xss_clean');
            }else{
                $this->form_validation->set_rules('typeTVA', '"Type TVA"', 'encode_php_tags|xss_clean');
                $this->form_validation->set_rules('typefraisagence', '"Type frais d\'agence"', 'encode_php_tags|xss_clean');
            }
            $this->form_validation->set_rules('tvaprixnetvendeur', '"Tva prix net vendeur"', 'encode_php_tags|xss_clean|numeric');
            $this->form_validation->set_rules('prixnetvendeur', '"Prix net vendeur"', 'encode_php_tags|xss_clean|numeric');
            $this->form_validation->set_rules('fraisagence', '"Frais d\'agence"', 'encode_php_tags|xss_clean|numeric');

            $surfaces = array_combine($this->input->post('pieces'), $this->input->post('surfaces'));
            $data['save_surfaces'] = $surfaces;

            if ($this->form_validation->run()) {
                $plancher_brute = 0;
                if (isset($this->input->post('type_surface')["plancher_brute"])) {
                    $plancher_brute = 1;
                }
                $habitable = 0;
                if (isset($this->input->post('type_surface')["habitable"])) {
                    $habitable = 1;
                }
                $utile = 0;
                if (isset($this->input->post('type_surface')["utile"])) {
                    $utile = 1;
                }
                $terrain = 0;
                if (isset($this->input->post('type_surface')["terrain"])) {
                    $terrain = 1;
                }

                $lot = new StdClass();
                $lot->idProjet = $data['projet']->id;
                $lot->type = $this->input->post('type');
                $lot->type_surface = (string) $plancher_brute . $habitable . $utile . $terrain;
                $lot->reference = strtoupper($data['projet']->nom[0] . $data['projet']->nom[1] . $lot->type[0] . $this->input->post('numero_lot'));
                $lot->numero_lot = $this->input->post('numero_lot');
                $lot->description = $this->input->post('description');
                $lot->numero_copro = $this->input->post('numero_copro');
                $lot->numero_pdl_edf = $this->input->post('numero_pdl_edf');
                $lot->numero_postal = $this->input->post('numero_postal');
                $lot->typeTVA = $this->input->post('typeTVA');
                $lot->tvaprixnetvendeur = $this->input->post('tvaprixnetvendeur');
                $lot->prixnetvendeur = $this->input->post('prixnetvendeur');
                $lot->typefraisagence = $this->input->post('typefraisagence');
                $lot->fraisagence = $this->input->post('fraisagence');

                $id = $this->lots->insert($lot)->id;


                foreach ($surfaces as $key => $value) {
                    $surface = new StdClass();
                    if ($key != $value) {
                        $surface->piece = $key;
                        $surface->taille = $value;
                        $surface->idLot = $id;

                        $this->surfaces->insert($surface);
                    }
                }
                $this->liste($data['projet']->url);
            }else{
                $data['menu'] = $this->load->view('template/menu', $data, true);
                $this->load->view('template/header');
                $this->load->view('template/sidebar', $data);
                $this->load->view('pages/lots/creer');
                $this->load->view('template/footer');
            }
        } else {
            $data['menu'] = $this->load->view('template/menu', $data, true);
            $this->load->view('template/header');
            $this->load->view('template/sidebar', $data);
            $this->load->view('pages/lots/creer');
            $this->load->view('template/footer');
        }
    }

    public function modifier($id = "") {
        if ($id == "") {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $data['lot'] = $this->lots->constructeur($id)[0];
        $data['pieces'] = $this->surfaces->getAllFromLot($data['lot']->id);
        $data['projet'] = $this->projets->constructeur($data['lot']->idProjet)[0];

        if ($this->input->post()) {

            $this->form_validation->set_rules('numero_lot', '"Numero du lot"', 'trim|required|encode_php_tags|xss_clean|numero_lot_update[' . $data['projet']->id . '$' . $this->input->post('numero_lot') . '$' . $id . ']');
            $this->form_validation->set_rules('numero_copro', '"Numero de copro"', 'trim|encode_php_tags|xss_clean');
            $this->form_validation->set_rules('numero_postal', '"Numero postal"', 'trim|encode_php_tags|xss_clean');
            $this->form_validation->set_rules('numero_pdl_edf', '"Numero PDL EDF"', 'trim|encode_php_tags|xss_clean');
            $this->form_validation->set_rules('description', '"Descrption"', 'trim|encode_php_tags|xss_clean');
            $this->form_validation->set_rules('type', '"Type"', 'trim|required|encode_php_tags|xss_clean');
            $this->form_validation->set_rules('type_surface', '"Type de surface"', 'required|encode_php_tags|xss_clean');
            $this->form_validation->set_rules('type_surface[plancher_brute]', '"Type de surface"', 'encode_php_tags|xss_clean');
            $this->form_validation->set_rules('type_surface[habitable]', '"Type de surface"', 'encode_php_tags|xss_clean');
            $this->form_validation->set_rules('type_surface[utile]', '"Type de surface"', 'encode_php_tags|xss_clean');
            $this->form_validation->set_rules('type_surface[terrain]', '"Type de surface"', 'encode_php_tags|xss_clean');
            $this->form_validation->set_rules('pieces[]', '"Piéces"', 'encode_php_tags|xss_clean');
            $this->form_validation->set_rules('surfaces[]', '"Surfaces"', 'encode_php_tags|xss_clean');
            $this->form_validation->set_rules('pieces_existantes[]', '"Piéces existantes"', 'encode_php_tags|xss_clean');
            $this->form_validation->set_rules('surfaces_existantes[]', '"Surfaces existantes"', 'encode_php_tags|xss_clean');
            $this->form_validation->set_rules('id_existants[]', '"Id existants"', 'encode_php_tags|xss_clean');
            if($this->input->post('tvaprixnetvendeur') != 0 || $this->input->post('tvaprixnetvendeur') != "" || $this->input->post('tvaprixnetvendeur') != "0"){
                $this->form_validation->set_rules('typeTVA', '"Type TVA"', 'required|encode_php_tags|xss_clean');
                $this->form_validation->set_rules('typefraisagence', '"Type frais d\'agence"', 'required|encode_php_tags|xss_clean');
            }else{
                $this->form_validation->set_rules('typeTVA', '"Type TVA"', 'encode_php_tags|xss_clean');
                $this->form_validation->set_rules('typefraisagence', '"Type frais d\'agence"', 'encode_php_tags|xss_clean');
            }
            $this->form_validation->set_rules('tvaprixnetvendeur', '"Tva prix net vendeur"', 'encode_php_tags|xss_clean|numeric');
            $this->form_validation->set_rules('prixnetvendeur', '"Prix net vendeur"', 'encode_php_tags|xss_clean|numeric');
            $this->form_validation->set_rules('fraisagence', '"Frais d\'agence"', 'encode_php_tags|xss_clean|numeric');

            $surfaces = array_combine($this->input->post('pieces'), $this->input->post('surfaces'));
            $data['save_surfaces'] = $surfaces;
            if ($this->form_validation->run()) {
                $plancher_brute = 0;
                if (isset($this->input->post('type_surface')["plancher_brute"])) {
                    $plancher_brute = 1;
                }
                $habitable = 0;
                if (isset($this->input->post('type_surface')["habitable"])) {
                    $habitable = 1;
                }
                $utile = 0;
                if (isset($this->input->post('type_surface')["utile"])) {
                    $utile = 1;
                }
                $terrain = 0;
                if (isset($this->input->post('type_surface')["terrain"])) {
                    $terrain = 1;
                }

                $lot = new StdClass();
                $lot->idProjet = $data['projet']->id;
                $lot->type = $this->input->post('type');
                $lot->type_surface = (string) $plancher_brute . $habitable . $utile . $terrain;
                $lot->reference = strtoupper($data['projet']->nom[0] . $data['projet']->nom[1] . $lot->type[0] . $this->input->post('numero_lot'));
                $lot->numero_lot = $this->input->post('numero_lot');
                $lot->description = $this->input->post('description');
                $lot->numero_copro = $this->input->post('numero_copro');
                $lot->numero_pdl_edf = $this->input->post('numero_pdl_edf');
                $lot->numero_postal = $this->input->post('numero_postal');
                $lot->typeTVA = $this->input->post('typeTVA');
                $lot->tvaprixnetvendeur = $this->input->post('tvaprixnetvendeur');
                $lot->prixnetvendeur = $this->input->post('prixnetvendeur');
                $lot->typefraisagence = $this->input->post('typefraisagence');
                $lot->fraisagence = $this->input->post('fraisagence');

                $this->lots->update($lot, $id);
                //Juste pour les pieces que l'on crée!
                foreach ($surfaces as $key => $value) {
                    $surface = new StdClass();
                    if ($key != $value) {
                        $surface->piece = $key;
                        $surface->taille = $value;
                        $surface->idLot = $id;

                        $this->surfaces->insert($surface);
                    }
                }

                //Juste pour les pieces déjà existantes qu'on modifie ou supprime!
                $size_existants = sizeof($this->input->post('id_existants'));
                $existants = Array();
                for ($i = 0; $i < $size_existants; $i++) {
                    $surface_existante = new stdClass();
                    $surface_existante->taille = $this->input->post('surfaces_existantes')[$i];
                    $surface_existante->piece = $this->input->post('pieces_existantes')[$i];
                    var_dump($surface_existante);
                    if($surface_existante->taille != $surface_existante->piece){
                        //Cela veut dire que les deux ne sont pas vides!
                        $this->surfaces->update($surface_existante,$this->input->post('id_existants')[$i]);
                    }else{
                        //ils sont tout les deux vides, on supprime donc!
                        $this->surfaces->delete($this->input->post('id_existants')[$i]);
                    }
                    
                }
                
                redirect(base_url("lot/liste/".$data['projet']->url));
            }
        }
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/lots/modifier');
        $this->load->view('template/footer');
    }
    
    public function imprimer($id = "") {
        if ($id == "") {
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = array();
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $data['lot'] = $this->lots->constructeur($id)[0];
        $data['pieces'] = $this->surfaces->getAllFromLot($data['lot']->id);
        $data['projet'] = $this->projets->constructeur($data['lot']->idProjet)[0];
        
        $this->load->view('template/header');
        $this->load->view('pages/lots/imprimer',$data);
        $this->load->view('template/footer');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */