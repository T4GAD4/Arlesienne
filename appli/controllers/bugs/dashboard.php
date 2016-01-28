<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $data = array();
        $data['user'] = $this->session->userdata('user');
        $data['categories'] = $this->bug->getCategories();
        foreach($data['categories'] as $categorie){
            $categorie->bugs = $this->bug->getFromCategorie($categorie->categorie);
            $categorie->nombre = $this->bug->countCategorie($categorie->categorie)[0]->nombre;
        }
        
        $data['urgences'] = $this->bug->getUrgences();
        foreach($data['urgences'] as $urgence){
            $urgence->nombre = $this->bug->countUrgence($urgence->urgence)[0]->nombre;
        }
        
            $data['menu'] = $this->load->view('template/menu',$data,true);            
            $this->load->view('template/header');
            $this->load->view('template/sidebar',$data);
            $this->load->view('pages/bugs/dashboard');
            $this->load->view('template/footer');
        
    }
    
    public function add(){
        $data['user'] = $this->session->userdata('user');
        if($this->input->post()){
            
            $this->form_validation->set_rules('titre', '"Titre"', 'trim|required|encode_php_tags|xss_clean');
            $this->form_validation->set_rules('explication', '"Message"', 'trim|required|min_length[50]|encode_php_tags|xss_clean');
            $this->form_validation->set_rules('categorie', '"Categorie"', 'trim|required|encode_php_tags|xss_clean');
            $this->form_validation->set_rules('urgence', '"Urgence"', 'trim|required|encode_php_tags|xss_clean');
            
            if($this->form_validation->run()){
                    //On ajoute les tests
                    $bug = new stdClass();
                    $bug->titre = $this->input->post('titre');
                    $bug->utilisateur = $data['user']->prenom." ".$data['user']->nom;
                    $bug->message = $this->input->post('explication');
                    $bug->urgence = $this->input->post('urgence');
                    $bug->date = date('Y-m-d');
                    $bug->url_precedente = $_SERVER['HTTP_REFERER'];
                    $bug->categorie = $this->input->post('categorie');
                    
                    $result = $this->bug->insert($bug);
                    redirect(base_url('bugs/dashboard'));
            }
        }
        $data['menu'] = $this->load->view('template/menu',$data,true);            
            $this->load->view('template/header');
            $this->load->view('template/sidebar',$data);
            $this->load->view('pages/bugs/add');
            $this->load->view('template/footer');
    }
        
    
    public function resolu($id = 0){
        $data['user'] = $this->session->userdata('user');
        $data['bug'] = $id;
        if($this->input->post()){
            
            $this->form_validation->set_rules('explication', '"Message"', 'trim|required|encode_php_tags|xss_clean');
            if($this->form_validation->run()){
                
                    $resolu = new stdClass();
                    $resolu->date = date('Y-m-d');
                    $resolu->developpeur = $data['user']->prenom." ".$data['user']->nom;
                    $resolu->message = $this->input->post('explication');
                    
                    $bug = new stdClass();
                    $bug->id = $id;
                    $bug->infos_resolution = json_encode($resolu);
                    $bug->categorie = "resolu"; 
                    $this->bug->update($bug);
                    
                    redirect(base_url('bugs/dashboard'));
            }
        }
        $data['menu'] = $this->load->view('template/menu',$data,true);            
            $this->load->view('template/header');
            $this->load->view('template/sidebar',$data);
            $this->load->view('pages/bugs/resolu');
            $this->load->view('template/footer');
    }
    
    public function delete($id = 0){
        if($id == 0){
            redirect('bugs/dashboard/');
        }
        
        $bug = new stdClass();
        
        $this->bug->delete($id);
        redirect('bugs/dashboard');
    }
}


/* End of file accueil.php */
/* Location: ./application/controllers/accueil.php */