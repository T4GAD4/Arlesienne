<?php

class Mail extends CI_Controller {

    public function envoyer() {
        $data = array();
        $data['user'] = $this->session->userdata('user');
        $data['nb_messages'] = $this->nb_messages;
        $data['menu'] = $this->load->view('template/menu', $data, true);

        $this->form_validation->set_rules('destinataire', 'Destinataire', 'trim|required|xss_clean|encode_php_tags');
        $this->form_validation->set_rules('copie', 'copie', 'trim|valid_email|xss_clean|encode_php_tags');
        $this->form_validation->set_rules('copie_cachee', 'copie_cachee', 'trim|valid_email|xss_clean|encode_php_tags');
        $this->form_validation->set_rules('expediteur', 'Expediteur', 'trim|required|valid_email|xss_clean|encode_php_tags');
        $this->form_validation->set_rules('sujet', 'Sujet', 'trim|required|xss_clean|encode_php_tags');
        $this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean|encode_php_tags');


        if ($this->form_validation->run()) {
            //Envoi du mail
            $this->email->from($this->input->post("expediteur"), 'Saint Roch Habitat');
            $this->email->to($this->input->post("destinataire"));
            $this->email->cc($this->input->post("copie"));
            $this->email->bcc($this->input->post("copie_cachee"));

            $this->email->subject($this->input->post("sujet"));
            $this->email->message($this->input->post("message"));
            
            $config['upload_path'] = './emails';
            $config['allowed_types'] = '*';
            
            $data_files = Array();
            $files = $_FILES;
            $cpt = count($_FILES['piece']['name']);
            for($i=0; $i<$cpt; $i++)
            {           
                $_FILES['piece']['name']= time()."-".$files['piece']['name'][$i];
                $_FILES['piece']['type']= $files['piece']['type'][$i];
                $_FILES['piece']['tmp_name']= $files['piece']['tmp_name'][$i];
                $_FILES['piece']['error']= $files['piece']['error'][$i];
                $_FILES['piece']['size']= $files['piece']['size'][$i];
            
                $this->upload->initialize($config);
                
                if($this->upload->do_upload("piece")){
                    $data['email'] = true;
                }else{
                    $data['email'] = false;
                }
                array_push($data_files, $this->upload->data()['full_path']);
                $this->email->attach($this->upload->data()['full_path']);
            }
            
            $data_files = implode(';',$data_files);

            $this->email->send();
            
            $email=new stdClass();
            $email->destinataire=$this->input->post("destinataire");
            $email->copie=$this->input->post("copie");
            $email->copie_cachee=$this->input->post("copie_cachee");
            $email->expediteur=$this->input->post("expediteur");
            $email->sujet=$this->input->post("sujet");
            $email->message=$this->input->post("message");
            $email->fichiers=$data_files;
            $email->date=Date('Y-m-d');
            $email->heure = date("H:i");

            $this->emailing->insert($email);
            
        }
        //charger les pages
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/email/mail');
        $this->load->view('template/footer');
        
    }
    public function details($id) {
        $data = array();
        $data['email'] = $this->emailing->constructeur($id)[0];
     
        //chrgement des données et appel des vues
        
        $data['user'] = $this->session->userdata('user');
        $data['nb_messages'] = $this->nb_messages;
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/email/detail');
        $this->load->view('template/footer');
    }
    public function index() {
        
        $data = array();
        
        $data['tout'] = $this->emailing->getAll();
        $data['contacts'] = $this->emailing->get("contact");
        $data['commercial'] = $this->emailing->get("commercial");
        $data['informatique'] = $this->emailing->get("informatique");
        $data['technique'] = $this->emailing->get("technique");
        $data['communication'] = $this->emailing->get("communication");
        
        $data['expediteurs'] = $this->emailing->getExpediteur();
       
        
        
        
        //chrgement des données et appel des vues
        
        $data['user'] = $this->session->userdata('user');
        $data['nb_messages'] = $this->nb_messages;
        $data['menu'] = $this->load->view('template/menu', $data, true);
        $this->load->view('template/header');
        $this->load->view('template/sidebar', $data);
        $this->load->view('pages/email/liste_mail');
        $this->load->view('template/footer');
        
    }

}

?>