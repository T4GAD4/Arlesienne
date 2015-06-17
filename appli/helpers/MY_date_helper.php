<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('conv_date')) {

    function conv_date($date = '') {
        if (!is_array($date)) {
            //	Tous les paramètres sont insérés dans un tableau
            $tab = explode('-', $date);
            switch($tab[1]){
                case '01' : $tab[1] = 'Janvier'; break;
                case '02' : $tab[1] = 'Février'; break;
                case '03' : $tab[1] = 'Mars'; break;
                case '04' : $tab[1] = 'Avril'; break;
                case '05' : $tab[1] = 'Mai'; break;
                case '06' : $tab[1] = 'Juin'; break;
                case '07' : $tab[1] = 'Juillet'; break;
                case '08' : $tab[1] = 'Août'; break;
                case '09' : $tab[1] = 'Septembre'; break;
                case '10' : $tab[1] = 'Octobre'; break;
                case '11' : $tab[1] = 'Novembre'; break;
                case '12' : $tab[1] = 'Décembre'; break;
            }
            $date = $tab[2].' '.$tab[1].' '.$tab[0];
        }
        return $date;
    }
}