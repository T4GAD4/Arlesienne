<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * Co-développeur : LEFEBVRE Anthony
     * 
     */
        
        public function set_lu(){
            $id = $_REQUEST['id'];
            $result = $this->messages->lu($id);
            echo output($result);
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */