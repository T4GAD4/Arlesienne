<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {
    
    public function __construct() {
        parent::__construct();
        
        $this->_error_prefix = '<p class="perror"><i class="fa fa-exclamation-triangle"></i>';
        $this->_error_sufix = '</p>';
        $this->set_message('update_unique', 'La valeur existe déjà dans la base de donnée!');
        $this->set_message('numero_facture_update', 'Le numéro de facture existe déjà pour cette société dans une autre facture!');
    }
 
    function update_unique($value, $params) {
 
        $CI =& get_instance();
        $CI->load->database();
 
        $CI->form_validation->set_message('unique',
            'The %s is already being used.');
 
        list($table, $field, $field2, $val) = explode(".", $params);
        $query = $CI->db->select($field)->from($table)
            ->where($field, $value)->where($field2.'` !=', $val)->limit(1)->get();
        if ($query->row()) {
            return false;
        } else {
            return true;
        }
 
    }
 
    function numero_facture($value, $params) {
 
        $CI =& get_instance();
        $CI->load->database();
 
        
        $table = "factures";
        list($id, $numero) = explode(".", $params);
        
        $CI->form_validation->set_message('numero_facture','Le numero de facture : '.$numero.' existe déjà pour cette société.');
        
        $query = $CI->db->select('id')->from($table)
            ->where('idEntreprise', $id)->where('numFacture',$numero)->get();
        if ($query->row()) {
            return false;
        } else {
            return true;
        }
 
    }
 
    function numero_facture_update($value, $params) {
 
        $CI =& get_instance();
        $CI->load->database();
 
        
        $table = "factures";
        list($idEntreprise, $numero,$idFacture) = explode(".", $params);
        
        $query = $CI->db->select('id')->from($table)
            ->where('idEntreprise', $idEntreprise)->where('numFacture',$numero)->where('id != '.$idFacture)->get();
        
        if ($query->row()) {
            return false;
        } else {
            return true;
        }
 
    }
}
