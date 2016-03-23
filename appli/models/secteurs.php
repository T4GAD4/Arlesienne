<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Secteurs extends CI_Model {

    private $table1 = 'fiche_renseignement';
    private $table2 = 'projet';

    public function getAllSecteurs() {

        $secteurs1 = $this->db->distinct()
                ->select('secteur')
                ->where('secteur <> ""')
                ->get($this->table1)
                ->result();
        
        $secteurs = Array();
        
        if (!empty($secteurs1) || $secteurs1 == NULL) {            
            foreach ($secteurs1 as $secteur) {
                $secteur->secteur = json_decode($secteur->secteur);
                if( $secteur->secteur != false){
                    foreach ($secteur->secteur as $value) {
                        array_push($secteurs, $value);
                    }
                }
            }
        }
        
        $secteurs2 = $this->db->distinct()
                ->select('secteur')
                ->where('secteur <> ""')
                ->get($this->table2)
                ->result();
        
        if (!empty($secteurs2) || $secteurs2 == NULL) {
            foreach ($secteurs2 as $secteur) {
                $secteur->secteur = json_decode($secteur->secteur);
                if($secteur->secteur != false){
                    foreach ($secteur->secteur as $value) {
                        array_push($secteurs, $value);
                    }
                }
            }
        }
        return array_unique($secteurs);
    }

}
