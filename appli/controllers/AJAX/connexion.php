<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connexion extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * Co-développeur : LEFEBVRE Anthony
     * 
     */
    
        public function test_connexion()
	{
            $result = $this->session->userdata('user');
            echo output($result);
	}
        
        public function connex()
	{
            $pseudo = $_REQUEST['pseudo'];
            $password = hash('sha256',$_REQUEST['password']);
            $user = $this->utilisateurs->getUser($pseudo);
            if(!empty($user)){
                //utilisateur connu
                if($user[0]->password == $password){
                    //Utilisateur bien référencé et mot de passe correct
                    $this->session->set_userdata('user',$user);
                    $result = "ok";
                }else{
                    //Utilisateur bien référencé mais mot de passe incorrect
                    $result = "mot de passe";
                }
            }else{
               //utilisateur inconnu
               $result = 'identifiant';
            }
            echo output($result);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */