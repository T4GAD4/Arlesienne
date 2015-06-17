<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilisateur extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * Co-développeur : LEFEBVRE Anthony
     * 
     */
        
        public function favoris()
	{
            $id = $this->session->userdata('user')[0]->id;
            $url = $_REQUEST['url'];
            $result = $this->utilisateurs->getRaccourcis($id)[0]->favoris;
            if($result != ""){$result = explode(",", $result);}
            else{$result = array();}
            if (in_array($url, $result)) {
                $result = false;
            }else{
                array_push($result, $url);
                $result = implode(",", $result);
                $result = $this->utilisateurs->updateFavoris($result,$id);
                if($result == true){
                    //On va recharger les infos de l'utilisateur
                    $this->session->unset_userdata('user');
                    $user = $this->utilisateurs->getId($id);
                    $this->session->set_userdata('user',$user);                
                }
            }
            echo output($result);
	}
        
        public function remove_favoris()
	{
            $id = $this->session->userdata('user')[0]->id;
            $remove = $_REQUEST['remove'];
            $result = $this->utilisateurs->getRaccourcis($id)[0]->favoris;
            if($result != ""){$result = explode(",", $result);}
            for($i =0; $i <sizeof($result); $i++){
                if($result[$i] == $remove){
                    unset($result[$i]);
                    $result = array_values($result);
                }
            }
            $result = implode(",", $result);
            $result = $this->utilisateurs->updateFavoris($result,$id);
            echo output($result);
	}
        
         public function save_interface()
	{
            $id = $this->session->userdata('user')[0]->id;
            $interface= $_REQUEST['interface'];
            $result = $this->utilisateurs->updateInterface($interface,$id);
            if($result == true){
                    //On va recharger les infos de l'utilisateur
                    $this->session->unset_userdata('user');
                    $user = $this->utilisateurs->getId($id);
                    $this->session->set_userdata('user',$user);                
                }
            echo output($result);
	}
        
        public function getAll(){
            $result = $this->utilisateurs->getAll();
            echo output($result);
        }
        
        public function send_message(){
            var_dump($_REQUEST);
            $data = new stdClass();
            $data->idDestinataire = $_REQUEST['destinataire'];
            $data->idExpediteur = $this->session->userdata('user')[0]->id;
            $data->message = $_REQUEST['message'];
            $data->date = date('Y-m-d');
            $data->heure = date('H:i');
            $result = $this->messages->send($data);
            echo output($result);
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */