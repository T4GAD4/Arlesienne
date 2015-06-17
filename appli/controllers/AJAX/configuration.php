<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuration extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * Co-développeur : LEFEBVRE Anthony
     * 
     */
    
        public function update(){
            $libelle = $_REQUEST['libelle'];
            $valeur = $_REQUEST['valeur'];
            $array = $this->configurations->getValeur($libelle)[0]->valeur;
            $array = explode(';', $array);
            if(!in_array($valeur, $array)){
                array_push($array, $valeur);
            }
            $array = implode(";", $array);
            var_dump($array);
            $result = $this->configurations->update($libelle,$array);
            echo output($result);
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */