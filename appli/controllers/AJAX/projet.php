<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Projet extends CI_Controller {

  public function Projet() {
    parent::__construct();
    $this->load->model('comptes_bancaires');
  } 

  public function getCompte(){
    $comptes = $this->comptes_bancaires->getFromSociete($_REQUEST['id']);
    echo output($comptes);
  }

}