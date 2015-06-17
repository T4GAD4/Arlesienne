<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rechargement extends CI_Form_validation {
    
    public $nb_mail;

    public function Rechargement(){
        $CI =& get_instance();
        
        $CI->load->model("utilisateurs");
        $CI->load->model("messages");
        
        
        if($CI->session->userdata('user') != false){
            //Rechargement des données de l'utilisateur automatiquement
            $id = $CI->session->userdata('user')[0]->id;
            //$CI->session->unset_userdata('user');
            $user = $CI->utilisateurs->getId($id);
            $CI->session->set_userdata('user',$user); 

            //Rechargement des messages non lus automatiquement
            $CI->nb_messages = $CI->messages->count_non_lu($id);
        }
    }

}

