<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rechargement extends CI_Form_validation {
    
    public $nb_mail;

    public function Rechargement(){
        $CI =& get_instance();
        
        $CI->load->model("utilisateurs");
        $CI->load->model("messages");
        
        
        if($CI->session->userdata('user') != false){
            //Rechargement des données de l'utilisateur automatiquement
            $id = $CI->session->userdata('user')->id;
            //$CI->session->unset_userdata('user');
            $user = $CI->utilisateurs->getId($id)[0];
            $CI->session->set_userdata('user',$user); 
            //Rechargement des messages non lus automatiquement
            $CI->nb_messages = $CI->messages->count_non_lu($id);
            
        }else{
            if($_SERVER['REQUEST_URI'] != '/arlesiennev3/connexion'){
                redirect(base_url().'connexion');
            }
        }
    }

}

