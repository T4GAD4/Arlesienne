<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reglements extends CI_Model {

    private $table = 'reglement_facture';

    public function constructeur($id = 0) {

        if ($id == 0) {
            return false;
        }

        $entreprise = $this->db->select('*')
                ->from($this->table)
                ->where('id', $id)
                ->limit(1)
                ->get()
                ->result();
        return $entreprise;
    }

    public function countFromFacture($id = 0) {

        if ($id == 0) {
            return false;
        }

        $regle = $this->db->select('sum(montant) as montant')
                ->from($this->table)
                ->where('idFacture', $id)
                ->get()
                ->result();

        return $regle;
    }

    public function getFromFacture($id = 0) {

        if ($id == 0) {
            return false;
        }

        $regle = $this->db->select('*')
                ->from($this->table)
                ->where('idFacture', $id)
                ->get()
                ->result();

        return $regle;
    }

    public function creer($data = '') {

        if ($data == '') {
            return false;
        }

        $this->db->insert($this->table, $data);
        $result = $this->db->insert_id();
        return $result;
    }

    public function getId($id = 0) {

        if ($id == 0) {
            return false;
        }

        $entreprise = $this->db->select('*')
                ->from($this->table)
                ->where('id', $id)
                ->limit(1)
                ->get()
                ->result();

        return $entreprise;
    }

    public function delete($data = '') {

        if ($data == '') {
            return false;
        }

        $result = $this->db->delete($this->table, array('id' => $data));

        return $result;
    }

    public function modify($data = '', $id = 0) {

        if ($data == '' || $id == 0) {
            return false;
        }
        $result = $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        return $result;
    }

}
