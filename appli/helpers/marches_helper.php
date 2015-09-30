<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('creer_marches')) {

    function creer_marches($id = 0) {
        if ($id != 0) {
            
            //On déclare CodeIgniter
            $CI =& get_instance();
            $CI->load->model('marches');
            
            //On va chercher les marchés
            $json = json_decode($CI->configurations->getValeur("marches")[0]->valeur);
            
            
            foreach($json as $categorie => $marches){
                foreach($marches as $marche){
                    $obj = new stdClass();
                    $obj->idProgramme = $id;
                    $obj->categorie = $categorie;
                    $obj->nom = $marche;
                    $CI->marches->add($obj);
                }
            }            
        }
    }
}

if (!function_exists('calc_tva')) {

    function calc_tva($montant,$tva) {
        return number_format(intval($montant)+((intval($montant)*intval($tva))/100),2,"."," ");
    }
}