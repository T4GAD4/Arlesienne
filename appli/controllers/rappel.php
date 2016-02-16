<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rappel extends CI_Controller {

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
        $data['contact']->rappels = $this->rappels->constructeur($id);
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar',$data);
        $this->load->view('pages/contact/rappels/liste');
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
        
        $this->form_validation->set_rules('date', '"Date"', 'regex_match[/[0-9]{2}-[0-12]{2}-[0-9]{4}/]|trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('commentaire', '"Commentaire"', 'trim|required|encode_php_tags|xss_clean');
        
        if($this->form_validation->run()){
            
            $rappel = new StdClass();
            $rappel->idContact = $id;
            $rappel->date = DateTime::createFromFormat("d-m-Y", $this->input->post('date'))->format("Y-m-d");
            $rappel->utilisateur = strtoupper($data['user']->nom).' '.ucfirst($data['user']->prenom);
            $rappel->commentaire = $this->input->post('commentaire');

            $this->rappels->creer($rappel);
            
            redirect(base_url('rappel/liste/'.$id));
        }
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar',$data);
        $this->load->view('pages/contact/rappels/creer');
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
        $data['rappel'] = $this->rappels->getId($id)[0];     
        
        $this->form_validation->set_rules('date', '"Date"', 'regex_match[/[0-9]{2}-[0-12]{2}-[0-9]{4}/]|trim|required|encode_php_tags|xss_clean');
        $this->form_validation->set_rules('commentaire', '"Commentaire"', 'trim|required|encode_php_tags|xss_clean');
        
        if($this->form_validation->run()){
            
            $rappel = new StdClass();
            $rappel->date = DateTime::createFromFormat("d-m-Y", $this->input->post('date'))->format("Y-m-d");
            $rappel->utilisateur = strtoupper($data['user']->nom).' '.ucfirst($data['user']->prenom);
            $rappel->commentaire = $this->input->post('commentaire');

            $this->rappels->update($rappel, $id);
            
            redirect(base_url('rappel/liste/'.$data['rappel']->idContact));
        }
        
        $this->load->view('template/header');
        $this->load->view('template/sidebar',$data);
        $this->load->view('pages/contact/rappels/modifier');
        $this->load->view('template/footer');
        
    }
    
    public function effectuer($id){
        $user = $this->session->userdata('user');
        $rappel = $this->rappels->getId($id)[0];  
        
        $action = new stdClass();
        $action->date = $rappel->date;
        $action->idContact = $rappel->idContact;
        $action->commentaire = $rappel->commentaire;
        $action->utilisateur = strtoupper($user->nom).' '.ucfirst($user->prenom);
        
        $this->actions->creer($action);
        $this->rappels->delete($id);
        
        redirect(base_url('rappel/liste/'.$action->idContact));
        
    }
    
    public function supprimer($id){
        
        $rappel = $this->rappels->getId($id)[0];   
        
        $this->rappels->delete($id);
        
        redirect(base_url('rappel/liste/'.$rappel->idContact));
        
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */