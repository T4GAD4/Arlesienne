<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Utilisateur extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * 
     */
    
    public function index(){
        $data = array();
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        $data['utilisateurs'] = $this->utilisateurs->getAll();
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/utilisateur/liste');
        $this->load->view('template/footer');
    }
    
    public function supprimer($id){
        $this->utilisateurs->delete($id);
        redirect(base_url('utilisateur'));
    }
    
    public function personnaliser(){
        $data = array();
        $data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        
        $this->form_validation->set_rules('menu', '"Couleur menu"', 'trim|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('texte', '"Couleur texte"', 'trim|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('panneau', '"Couleur fond panneau lateral"', 'trim|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('texte_panneau', '"Couleur fond du texte du panneau lateral"', 'trim|encode_php_tags|xss_clean');
        
        if ($this->form_validation->run()) {            
            $arr['style'] = array(
                'menu' => $this->input->post('menu'),
                'texte' => $this->input->post('texte'),
                'texte_panneau' => $this->input->post('texte_panneau'),
                'panneau_lateral' => $this->input->post('panneau')
            );
            $perso = json_encode($arr['style']);
            $this->utilisateurs->personnaliser($perso,$data['user']->id);
            redirect('/utilisateur/personnaliser');
        }
        
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/utilisateur/personnaliser');
        $this->load->view('template/footer');
    }
    
    public function modifier($id = "") {
        $data = array();$data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        if($id == "" || $data['user']->compte == "normal"){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data['utilisateur'] = $this->utilisateurs->getId($id)[0];
        
        $this->form_validation->set_rules('nom', '"Nom"', 'trim|required|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('prenom', '"Prénom"', 'trim|required|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('mail', '"Email"', 'trim|required|max_length[500]|valid_email|update_unique[utilisateur$mail$id$'.$data['utilisateur']->id.']|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('pseudo', '"Pseudo"', 'trim|required|update_unique[utilisateur$pseudo$id$'.$data['utilisateur']->id.']|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('actif', '"Actif"', 'trim|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('compte', '"Type de compte"', 'trim|required|max_length[20]|encode_php_tags|xss_clean');

        if ($this->form_validation->run()) {
            $utilisateur = new stdClass();
            $utilisateur->nom = $this->input->post('nom');
            $utilisateur->prenom = $this->input->post('prenom');
            $utilisateur->mail = $this->input->post('mail');
            $utilisateur->pseudo = $this->input->post('pseudo');
            $utilisateur->actif = $this->input->post('actif');
            $utilisateur->compte = $this->input->post('compte');
            $result = $this->utilisateurs->update($utilisateur,$id);
            redirect('utilisateur/');            
        }     
        
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/utilisateur/modifier');
        $this->load->view('template/footer');
        
    }
    
    public function updateourself($id = "") {
        $data = array();$data['nb_messages'] = $this->nb_messages;
        $data['user'] = $this->session->userdata('user');
        if($id == "" || $id != $data['user']->id){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data['utilisateur'] = $this->utilisateurs->getId($id)[0];
        
        $this->form_validation->set_rules('nom', '"Nom"', 'trim|required|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('prenom', '"Prénom"', 'trim|required|max_length[500]|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('mail', '"Email"', 'trim|required|max_length[500]|valid_email|update_unique[utilisateur$mail$id$'.$data['utilisateur']->id.']|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('pseudo', '"Pseudo"', 'trim|required|update_unique[utilisateur$pseudo$id$'.$data['utilisateur']->id.']|encode_php_tags|xss_clean');
        
        if ($this->form_validation->run()) {
            $utilisateur = new stdClass();
            $utilisateur->nom = $this->input->post('nom');
            $utilisateur->prenom = $this->input->post('prenom');
            $utilisateur->mail = $this->input->post('mail');
            $utilisateur->pseudo = $this->input->post('pseudo');
            $result = $this->utilisateurs->update($utilisateur,$id);
            if($result == true){
                //Requete reussie! :)
                redirect('utilisateur/');
            }else{
                $data = array();
                $data['nb_messages'] = $this->nb_messages;
                $data['user'] = $this->session->userdata('user');
                $data['menu'] = $this->load->view('template/menu', $data, true);
                $this->load->view('template/header');
                $this->load->view('template/sidebar', $data);
                echo '<h3 style="color:red">Une erreur s\'est produite lors de la modification de l\'utilisateur, Contactez le pôle informatique!</h3>';
                $this->load->view('pages/utilisateur/modify_yourself');  
                $this->load->view('template/footer');
                
                return false;
            }
             
        }     
        
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/utilisateur/modify_yourself'); 
        $this->load->view('template/footer');
        
    }
 
    public function ajouter() {
       $data = array();$data['nb_messages'] = $this->nb_messages;
       $data['user'] = $this->session->userdata('user');
       if($data['user']->compte == "normal"){
           redirect($_SERVER['HTTP_REFERER']);
       }

       $this->form_validation->set_rules('nom', '"Nom"', 'trim|required|max_length[500]|encode_php_tags|xss_clean');
       $this->form_validation->set_rules('prenom', '"Prénom"', 'trim|required|max_length[500]|encode_php_tags|xss_clean');
       $this->form_validation->set_rules('mail', '"Email"', 'trim|required|max_length[500]|valid_email|is_unique[utilisateur.mail]|encode_php_tags|xss_clean');
       $this->form_validation->set_rules('pseudo', '"Pseudo"', 'trim|required|is_unique[utilisateur.pseudo]|encode_php_tags|xss_clean');
       $this->form_validation->set_rules('password', '"Mot de passe"', 'trim|required|encode_php_tags|xss_clean');
       $this->form_validation->set_rules('match_password', '"Confiration de mot de passe"', 'trim|required|matches[password]|encode_php_tags|xss_clean');
       $this->form_validation->set_rules('actif', '"Actif"', 'trim|encode_php_tags|xss_clean');
       $this->form_validation->set_rules('compte', '"Type de compte"', 'trim|required|max_length[20]|encode_php_tags|xss_clean');

       if ($this->form_validation->run()) {
           $utilisateur = new stdClass();
           $utilisateur->nom = $this->input->post('nom');
           $utilisateur->prenom = $this->input->post('prenom');
           $utilisateur->mail = $this->input->post('mail');
           $utilisateur->pseudo = $this->input->post('pseudo');
           $utilisateur->password = hash('sha256',$this->input->post('password'));
           $utilisateur->actif = $this->input->post('actif');
           $utilisateur->compte = $this->input->post('compte');
           $utilisateur->interface = '[{"col":3,"row":1,"size_x":1,"size_y":1,"url":"http://arlesienne.saint-roch-habitat.fr/contact","image":"http://arlesienne.saint-roch-habitat.fr/assets/images/menu/contacts.png","target":"_self"},{"col":3,"row":2,"size_x":1,"size_y":1,"url":"http://arlesienne.saint-roch-habitat.fr/message","image":"http://arlesienne.saint-roch-habitat.fr/assets/images/menu/message.png","target":"_self"},{"col":1,"row":1,"size_x":1,"size_y":1,"url":"http://arlesienne.saint-roch-habitat.fr/projet","image":"http://arlesienne.saint-roch-habitat.fr/assets/images/menu/projets.png","target":"_self"},{"col":4,"row":2,"size_x":1,"size_y":1,"url":"http://arlesienne.saint-roch-habitat.fr/utilisateur/personnaliser","image":"http://arlesienne.saint-roch-habitat.fr/assets/images/menu/reglages.png","target":"_self"},{"col":4,"row":1,"size_x":1,"size_y":1,"url":"http://arlesienne.saint-roch-habitat.fr/societe","image":"http://arlesienne.saint-roch-habitat.fr/assets/images/menu/societe.png","target":"_self"},{"col":2,"row":1,"size_x":1,"size_y":1,"url":"http://arlesienne.saint-roch-habitat.fr/facturation","image":"http://arlesienne.saint-roch-habitat.fr/assets/images/menu/facture.png","target":"_self"},{"col":6,"row":1,"size_x":1,"size_y":1,"url":"http://arlesienne.saint-roch-habitat.fr/mail/","image":"http://arlesienne.saint-roch-habitat.fr/assets/images/menu/email.png","target":"_self"},{"col":5,"row":1,"size_x":1,"size_y":1,"url":"http://arlesienne.saint-roch-habitat.fr/plans","image":"http://arlesienne.saint-roch-habitat.fr/assets/images/menu/plans.png","target":"_self"}]';
           $result = $this->utilisateurs->add($utilisateur);
           if($result == true){
               //Requete reussie! :)
               redirect('utilisateur/');
           }else{
               $data = array();$data['nb_messages'] = $this->nb_messages;
               $data['user'] = $this->session->userdata('user');
               $data['menu'] = $this->load->view('template/menu', $data, true);
               $this->load->view('template/header');
               $this->load->view('template/sidebar', $data);
               echo '<h3 style="color:red">Une erreur s\'est produite lors de la modification de l\'utilisateur, Contactez le pôle informatique!</h3>';
               $this->load->view('pages/utilisateur/creer');
               $this->load->view('template/footer');
               //$this->output->enable_profiler(TRUE);
               return false;
           }

       }     

       $data['menu'] = $this->load->view('template/menu', $data, true);
       $this->load->view('template/header');
       $this->load->view('template/sidebar', $data);
       $this->load->view('pages/utilisateur/creer');
       $this->load->view('template/footer');

   }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

