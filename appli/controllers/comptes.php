<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comptes extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * Co-développeur : LEFEBVRE Anthony
     * 
     */
    
    public function index(){
        redirect('societe');
    }
    
    public function supprimer($id = 0){
        $data = array();$data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        if($id == 0 || $data['user']->compte != "associé"){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $result = $this->comptes_bancaires->delete($id);
        var_dump($result);
        if($result){
            redirect('societe');
        }        
    }
    
    public function details($id = "") {
        $data = array();$data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        if($id == "" || $data['user']->compte != "associé"){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data['compte'] = $this->comptes_bancaires->getCompte($id);
        $data['operations'] = $this->mouvements->get($data['compte'][0]->id);
        //Calcul du total du compte actuel
        $data['total'] = $data['compte'][0]->montant;
        $data['inters'] = array();
        foreach($data['operations'] as $operation){
            if($operation->type == "debit"){
                $data['total'] = $data['total'] - $operation->montant; 
            }else{
                $data['total'] = $data['total'] + $operation->montant; 
            }
            $data['push'] = array("montant"=>$data['total'],"date"=>$operation->date);
            array_push($data['inters'],$data['push']);
        }
        
        
        
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/comptes/details');
        $this->load->view('template/footer');
    }
    
    public function creer_compte($idSociete = "") {
        $data = array();$data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $data['societe'] = $this->societes->getSociete($idSociete)[0];
        if($idSociete == "" || $data['user']->compte != "associé"){
            redirect($_SERVER['HTTP_REFERER']);
        }
        
        $this->form_validation->set_rules('type', '"Type de compte"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('banque', '"Banque"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('numero', '"Numéro du compte"', 'trim|required|is_unique[comptes_bancaires.id]|numeric|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('montant', '"Montant actuel du compte"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('decouvert', '"Découvert autorisé"', 'trim|required|encode_php_tags|xss_clean');
        
        if ($this->form_validation->run()) {
            $compte = new stdClass();
            $compte->type = $this->input->post('type');
            $compte->banque = $this->input->post('banque');
            $compte->idSociete = $idSociete;
            $compte->numero = $this->input->post('numero');
            $compte->montant = $this->input->post('montant');
            $compte->decouvert = $this->input->post('decouvert');
            var_dump($compte);  
            $result = $this->comptes_bancaires->creer($compte);
            if($result == true){
                //Requete reussie! :)
                redirect('societe/details/'.$data['societe']->id);
            }else{
                $data = array();$data['nb_messages'] = $this->nb_messages;
                $data['user'] = $this->session->userdata('user');
                $data['menu'] = $this->load->view('template/menu', $data, true);
                $this->load->view('template/header');
                $this->load->view('template/sidebar', $data);
                echo '<h3 style="color:red">Une erreur s\'est produite lors de la modification de la société, Contactez le pôle informatique!</h3>';
                $this->load->view('pages/comptes/creer');
                $this->load->view('template/footer');
                return false;
            }
            
        } 
        
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/comptes/creer');
        $this->load->view('template/footer');
    }
    
    public function modifier($id = "") {
        $data = array();$data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        if($id == "" || $data['user']->compte != "associé"){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data['compte'] = $this->comptes_bancaires->getCompte($id)[0];
        $this->form_validation->set_rules('type', '"Type de compte"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('banque', '"Banque"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('numero', '"Numéro du compte"', 'trim|required|update_unique[comptes_bancaires$numero$id$'.$data['compte']->id.']|numeric|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('montant', '"Montant actuel du compte"', 'trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('decouvert', '"Découvert autorisé"', 'trim|required|encode_php_tags|xss_clean');
        
        if ($this->form_validation->run()) {
            $compte = new stdClass();
            $compte->type = $this->input->post('type');
            $compte->banque = $this->input->post('banque');
            $compte->numero = $this->input->post('numero');
            $compte->montant = $this->input->post('montant');
            $compte->decouvert = $this->input->post('decouvert');  
            $result = $this->comptes_bancaires->update($compte,$id);
            if($result == true){
                //Requete reussie! :)
                redirect('comptes/details/'.$data['compte']->id);
            }else{
                $data = array();$data['nb_messages'] = $this->nb_messages;
                $data['user'] = $this->session->userdata('user');
                $data['menu'] = $this->load->view('template/menu', $data, true);
                $this->load->view('template/header');
                $this->load->view('template/sidebar', $data);
                echo '<h3 style="color:red">Une erreur s\'est produite lors de la modification du compte bancaire, Contactez le pôle informatique!</h3>';
                $this->load->view('pages/comptes/modifier');
                $this->load->view('template/footer');
                return false;
            }
            
        } 
        
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/comptes/modifier');
        $this->load->view('template/footer');
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */