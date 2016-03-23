<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('calc_ttc_vente')) {

    function calc_ttc_vente($vente) {
        if ($vente) {
            if($vente->typeTVA == "montant"){
                $total = $vente->prixnetvendeur + $vente->tvaprixnetvendeur;
            }else{
                $total = $vente->prixnetvendeur * (1 + ($vente->tvaprixnetvendeur/100));
            }
            if($vente->typefraisagence == "acquereur"){
                $total = $total + $vente->fraisagence;
            }
            return $total;
        }
    }
}