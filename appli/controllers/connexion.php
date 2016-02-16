<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); header('Content-Type: text/html; charset=utf-8');

class Connexion extends CI_Controller {
    
    /**
     * 
     * Auteur : CAPI Aurélien
     * 
     */
    
	public function index()
	{
            $data = array(); 
            $data['error'] = false;
            if($this->input->post()){
                $this->form_validation->set_rules('pseudo', '"Identifiant"', 'trim|required|encode_php_tags|xss_clean');
                $this->form_validation->set_rules('password', '"Mot de passe"', 'trim|required|encode_php_tags|xss_clean');
                
                if($this->form_validation->run()){
                    $user = $this->utilisateurs->getUser($this->input->post('pseudo'));
                    if(sizeof($user) == 0){
                        $data['error'] = "L'identifiant utilisé est inconnu!";
                    }else{
                        $user = $user[0];
                        if($user->password == hash('sha256',$this->input->post('password'))){
                            $this->session->set_userdata('user',$user);
                            redirect(base_url().'accueil');
                        }else{
                            $data['error'] = "Le mot de passe ne correspond pas à l'identifiant renseigné";
                        }
                    }
                }
            }
            
            $this->load->view('template/header');
            $this->load->view('pages/login',$data);
            $this->load->view('template/footer');           
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */