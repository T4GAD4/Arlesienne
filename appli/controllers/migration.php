<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
header('Content-Type: text/html; charset=utf-8');

class Migration extends CI_Controller {

    /**
     * 
     * Auteur : CAPI Aurélien
     * 
     */
    public function index() {
        
        $dba = $this->load->database('arlesienne2', TRUE);
        
        /*//On récupére les sociétés
        $societes = $dba->select('id,nom')->from('societe')->get()->result();
        foreach($societes as $societe){
            $this->societes->add($societe);
        }
        
        //On récupére les comptes bancaires
        $comptes = $dba->select('*')->from('compte_bancaire')->get()->result();
        foreach($comptes as $compte){
            $compte->banque = $compte->nom_banque;
            $compte->idSociete = $compte->societe;
            if($compte->type == 1){
                $compte->type = "Promoteur";
            }else{
                $compte->type = "Courant";
            }
            unset($compte->nom_banque);
            unset($compte->societe);
            $result = $this->societes->constructeur($compte->idSociete);
            if(sizeof($result) > 0){
                $this->comptes_bancaires->creer($compte);
            }
        }
        
        //On va chercher les projets
        $projets = $dba->select('*')->from('chantier')->get()->result();
        foreach($projets as $projet){
            $projet->budget = $projet->enveloppe_non_devise;
            unset($projet->enveloppe_non_devise);
            $projet->idCompte = $projet->compte_bancaire;
            unset($projet->compte_bancaire);
            switch($projet->status){
                case 0 : $projet->etat = "Projets à l étude";break;
                case 1 : $projet->etat = "Projets en cours";break;
                case 2 : $projet->etat = "Projets terminés";break;
                case 3 : $projet->etat = "Projets abandonnés";break;
            }
            unset($projet->status);
            $projet->url = str_replace("'"," ",$projet->nom);
            $projet->idSociete = $dba->select('societe')->from('compte_bancaire')->where('id',$projet->idCompte)->get()->result()[0]->societe;
            $this->projets->add($projet);
        }
        
        //On va faire les contacts
        //Pour ça, on est passé par une feuille excel puisque
        //tout les contacts (entreprises et contacts) étaient 
        //La feuille de donnée excel se trouve sur le servuer dans le dossier informatique.
        */
        //On va migrer les factures
        /*$factures = $dba->select('*')->from('situation')->get()->result();
        $x = 0;
        $total = 0;
        foreach($factures as $facture){
            $total++;
            $facture->idEntreprise = $facture->entreprise;
            unset($facture->entreprise);
            $facture->numFacture = $facture->numfacture;
            unset($facture->numfacture);
            $facture->dateFacture = $facture->date_facture;
            unset($facture->date_facture);
            $facture->dateEcheance = $facture->date_limite;
            unset($facture->date_limite);
            $facture->montantHT = $facture->montant_facture;
            $facture->tva = $facture->tva;
            unset($facture->montant_facture);
            $facture->rg = "false";
            $facture->avoir = 0;
            //On va chercher l'idProjet
            $programme = $dba->select('programme')->from('marche_initial')->where('id',$facture->marche_initial)->get()->result();
            if($programme){
                $programme = $programme[0]->programme;
                $projet = $dba->select('chantier')->from('programme')->where('id',$programme)->get()->result()[0]->chantier;
                $facture->idProjet = $projet;
            }else{
                $facture->idProjet = NULL;
            }
            unset($facture->marche_initial);
            unset($facture->date_reception);
            unset($facture->pdf);
            if($facture->idEntreprise != null && $this->entreprises->constructeur($facture->idEntreprise)){
                $this->factures->creer($facture); 
            }
        }*/
        
        //On s'occupe des réglements de factures!
        /*$reglements = $dba->select('*')->from('situation_reglement')->get()->result();
        foreach($reglements as $reglement){
            $facture = $this->factures->constructeur($reglement->situation);
            $compte = $this->comptes_bancaires->constructeur($reglement->compte_bancaire);
            $reglement->idFacture = $reglement->situation;
            unset($reglement->situation);
            $reglement->idCompte = $reglement->compte_bancaire;
            unset($reglement->compte_bancaire);
            $reglement->ttc = calc_tva(floatval($reglement->montant/100), floatval($reglement->tva/100));
            $reglement->montant = $reglement->ttc;
            unset($reglement->ttc);
            $reglement->typeReglement = $reglement->type_reglement;
            unset($reglement->type_reglement);
            unset($reglement->rapproche);
            unset($reglement->tva);
            if($facture && $compte){
                $this->reglements->creer($reglement);
            }
        }
        /*
        //On passe aux marchés
        $marches = $dba->select('*')->from('marche_initial')->get()->result();
        foreach($marches as $marche){
            $idProjet = $dba->select('chantier')->from('programme')->where('id',$marche->programme)->get()->result();
            if($idProjet){
                $idProjet = $idProjet[0]->chantier;
                $projet = $this->projets->constructeur($idProjet);
                if($projet){
                    $projet = $projet[0]->id;
                    $marche->idProjet = $projet;
                    unset($marche->programme);
                    unset($marche->date);
                    $marche->montantHT = $marche->cout;
                    unset($marche->cout);
                    $marche->TVA = $marche->tva;
                    unset($marche->tva);
                    unset($marche->pdf);
                    if($marche->non_devise == 1){
                        $marche->devise = "false";
                    }else{
                        $marche->devise = "true";
                    }
                    unset($marche->non_devise);
                    unset($marche->entreprise);
                    unset($marche->date_rg);
                    $marche->categorie = "";
                    $idCategorie = $dba->select('idCategorie')->from('marche_categoriser')->where('idmarche',$marche->id)->get()->result();
                    if($idCategorie){
                        $nomCategorie = $dba->select('nom')->from('marche_categorie')->where('id',$idCategorie[0]->idCategorie)->get()->result();
                        if($nomCategorie){
                            $marche->categorie = $nomCategorie;
                        }
                    }
                    $this->marches->add($marche);
                }
            }
        }
        
        //On s'occupe des montants répartis
        $factures = $dba->select('*')->from('situation')->get()->result();
        foreach($factures as $facture){
            $test = $this->factures->constructeur($facture->id);
            if($test){
                $marche = $this->marches->constructeur($facture->marche_initial);
                if($marche){
                    $reparti = new StdClass();
                    $reparti->idFacture = $facture->id;
                    $reparti->idMarche = $facture->marche_initial;
                    $reparti->montant = calc_tva($facture->montant_facture, $facture->tva);
                    $this->montants_repartis->add($reparti);
                }
            }
        }
        
        //On s'occupe des avenants
        $avenants = $dba->select('*')->from('marche_avenant')->get()->result();
        foreach($avenants as $avenant){
            $avenant->idMarche = $avenant->marche_initial;
            unset($avenant->marche_initial);
            $avenant->idEntreprise = $avenant->entreprise;
            unset($avenant->entreprise);
            $avenant->numero = 0;
            $avenant->montantHT = $avenant->cout;
            unset($avenant->cout);
            $avenant->TVA = $avenant->tva;
            unset($avenant->tva);
            unset($avenant->pdf);
            $marche = $this->marches->constructeur($avenant->idMarche);
            $entreprise = $this->entreprises->constructeur($avenant->idEntreprise);
            if(!$entreprise){
                $avenant->idEntreprise = null;
            }
            if($marche){
                $this->avenants->creer($avenant);
            }
        }
        
        //On s'occupe des lots
        $lots = $dba->select('*')->from('lot')->get()->result();
        foreach($lots as $lot){
            $projet = $this->projets->constructeur($lot->chantier);
            if($projet){
                $projet = $projet[0];
                $lot->idProjet = $lot->chantier;
                unset($lot->chantier);
                if($lot->type == 1){
                    $lot->type = "secondaire";
                }else{
                    $lot->type = "principal";
                }
                $lot->reference = strtoupper($projet->nom[0] . $projet->nom[1] . $lot->type[0] . $lot->numero_initial);
                $lot->numero_lot = $lot->numero_initial;
                unset($lot->numero_initial);
                $lot->numero_pdl_edf = $lot->pdl_edf;
                unset($lot->pdl_edf);
                $lot->description = $lot->options;
                unset($lot->options);
                unset($lot->groupe);
                unset($lot->prix_netvendeur_acte);                
                unset($lot->frais_agence_acte);                
                unset($lot->tva_acte);                
                unset($lot->tva_fai_acte); 
                unset($lot->nom); 
                $this->lots->insert($lot);
            }
        }
        
        //On va changer les prix car pas de virgule en Arlesienne2 donc tva = 1960 au lieu de 19.60
        $marches = $this->marches->getAll();
        foreach($marches as $marche){
            $marche->montantHT = floatval($marche->montantHT) / 100;
            $marche->TVA = floatval($marche->TVA) / 100;
            $result = $this->marches->update($marche,$marche->id);
            var_dump($result);
        }
        $avenants = $this->avenants->getAll();
        foreach($avenants as $avenant){
            $avenant->montantHT = floatval($avenant->montantHT) / 100;
            $avenant->TVA = floatval($avenant->TVA) / 100;
            $this->avenants->update($avenant,$avenant->id);
        }
        $repartis = $this->montants_repartis->getAll();
        foreach($repartis as $reparti){
            $reparti->montant = floatval($reparti->montant) / 100;
            $this->montants_repartis->update($reparti,$reparti->id);
        }
        $factures = $this->factures->getAll();
        foreach($factures as $facture){
            $facture->montantHT = floatval($facture->montantHT) / 100;
            $facture->tva = floatval($facture->tva) / 100;
            $this->factures->update($facture,$facture->id);
        }
        $reglements = $this->reglements->getAll();
        foreach($reglements as $reglement){
            $reglement->montant = floatval($reglement->montant) / 100;
            $this->reglements->update($reglement,$reglement->id);
        }
        
        */
        
        $reglements = $dba->select('*')->from('situation_reglement')->get()->result();
        foreach($reglements as $reglement){
            $facture = $this->factures->constructeur($reglement->situation);
            $compte = $this->comptes_bancaires->constructeur($reglement->compte_bancaire);
            $reglement->idFacture = $reglement->situation;
            unset($reglement->situation);
            $reglement->idCompte = $reglement->compte_bancaire;
            unset($reglement->compte_bancaire);
            $reglement->ttc = calc_tva(floatval($reglement->montant/100), floatval($reglement->tva/100));
            $reglement->montant = $reglement->ttc;
            unset($reglement->ttc);
            $reglement->typeReglement = $reglement->type_reglement;
            unset($reglement->type_reglement);
            unset($reglement->rapproche);
            unset($reglement->tva);
            if(!$compte){
                $reglement->idCompte = null;
            }
            if($facture){
                $this->reglements->creer($reglement);
            }else{
                echo "Le réglement n°$reglement->id n'a pas pu être enregistré car la facture n'existe pas!!!<br/>";
            }
        }
        
    }
      
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */