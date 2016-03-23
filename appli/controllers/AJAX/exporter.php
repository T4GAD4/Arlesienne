<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); header('Content-Type: text/html; charset=utf-8');

class Exporter extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * 
     */
        
        public function excel()
	{
            $table = $_REQUEST['data']['table'];
            echo json_encode($table);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */