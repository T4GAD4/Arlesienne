<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ActionsContacts extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * Co-développeur : LEFEBVRE Anthony
     * 
     */
    
    public function liste($id = 0){
        if($id == 0){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = Array();
        $data['user'] = $this->session->userdata('user');
        $data['nb_messages'] = $this->nb_messages;
        $data['menu'] = $this->load->view('template/menu',$data,true);    
        $data['contact'] = $this->contacts->getId($id)[0];
        $data['contact']->actions = $this->actions->constructeur($id);
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar',$data);
        $this->load->view('pages/contact/actions/liste');
        $this->load->view('template/footer');
    }
    
    public function creer($id = 0){
        if($id == 0){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = Array();
        $data['user'] = $this->session->userdata('user');
        $data['nb_messages'] = $this->nb_messages;
        $data['menu'] = $this->load->view('template/menu',$data,true);            
        $data['contact'] = $this->contacts->getId($id)[0];     
        
        $this->form_validation->set_rules('date', '"Date"', 'regex_match[/^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$/]|trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('commentaire', '"Commentaire"', 'trim|required|encode_php_tags|xss_clean');
        
        if($this->input->post('rappel') == "true"){
            $this->form_validation->set_rules('rappel_date', '"Date"', 'regex_match[/^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$/]|trim|required|encode_php_tags|xss_clean');
            $this->form_validation->set_rules('rappel_heure', '"Heure"', 'trim|encode_php_tags|xss_clean');
            $this->form_validation->set_rules('rappel_commentaire', '"Commentaire"', 'trim|required|encode_php_tags|xss_clean');
        }
        
        if($this->form_validation->run()){
            $action = new StdClass();
            $action->idContact = $id;
            $action->date = $this->input->post('date');
            $action->utilisateur = strtoupper($data['user']->nom).' '.ucfirst($data['user']->prenom);
            $action->commentaire = $this->input->post('commentaire');
            
            $this->actions->creer($action);
            
            if($this->input->post('rappel') == "true"){
                $rappel = new StdClass();
                $rappel->idContact = $id;
                $rappel->heure = $this->input->post('rappel_heure');
                $rappel->date = $this->input->post('rappel_date');
                $rappel->utilisateur = strtoupper($data['user']->nom).' '.ucfirst($data['user']->prenom);
                $rappel->commentaire = $this->input->post('rappel_commentaire');
                
                $this->rappels->creer($rappel);
            }
            
            redirect(base_url('actionsContacts/liste/'.$id));
        }
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar',$data);
        $this->load->view('pages/contact/actions/creer');
        $this->load->view('template/footer');
        
    }
    
    public function modifier($id = 0){
        if($id == 0){
            redirect($_SERVER['HTTP_REFERER']);
        }
        $data = Array();
        $data['user'] = $this->session->userdata('user');
        $data['nb_messages'] = $this->nb_messages;
        $data['menu'] = $this->load->view('template/menu',$data,true);            
        $data['action'] = $this->actions->getId($id)[0];     
        
        $this->form_validation->set_rules('date', '"Date"', 'regex_match[/^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$/]|trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('commentaire', '"Commentaire"', 'trim|required|encode_php_tags|xss_clean');
                
        if($this->form_validation->run()){
            $action = new StdClass();
            $action->date = $this->input->post('date');
            $action->commentaire = $this->input->post('commentaire');
            
            $this->actions->update($action,$id);
                        
            redirect(base_url('actionsContacts/liste/'.$data['action']->idContact));
        }
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar',$data);
        $this->load->view('pages/contact/actions/modifier');
        $this->load->view('template/footer');
        
    }
    
    public function supprimer($id){
        
        $action = $this->actions->getId($id)[0];   
        
        $this->actions->delete($id);
        
        redirect(base_url('actionsContacts/liste/'.$action->idContact));
        
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */