<style>
    span{
        font-weight:900;
        text-align:left;
    }
</style>
<div class="container">
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        <a href="<?php echo base_url() . 'vente/modifier/' . $vente->id; ?>" class="btn btn-info pull-right"><i class="fa fa-gears"></i>&nbsp;Modifier la vente</a> 
    </div>
    <div class='row bgWhite'>
        <h3 class="black hrblack">LOT(S) <?php
            $array = Array();
            foreach ($vente->lots as $lot) {
                array_push($array, $lot->numero_lot);
            }echo implode(' + ', $array);
            ?> - <?php
            $array = Array();
            foreach ($vente->clients as $client) {
                array_push($array, $client->nom);
            }echo strtoupper(implode(', ', $array));
            ?></h3>
        <?php
        switch ($vente->etat) {
            case "compromis": $texte = "sous compromis";
                break;
            default : $texte = $vente->etat;
                break;
        }
        ?>
        <p class="center small">Vente <?= $texte; ?></p>
        <div class="col-md-5">
            <h3 class="hrblack black">Informations</h3>
            <br/>
            <div class="row col-md-12">
                <span style="vertical-align: top;">Lot(s) concernés :</span>
                <div style='display:inline-block;margin-left:20px;' class="pull-right">
                    <?php foreach ($vente->lots as $lot) { ?>
                        - Lot n° <?= $lot->numero_lot; ?><br/>
                    <?php } ?>
                </div>
            </div>
            <br/>
            <div class="col-md-12">
                <span style="vertical-align: top;">Client(s) concernés :</span>
                <div style='display:inline-block;margin-left:20px;' class="pull-right">
                    <?php foreach ($vente->clients as $client) { ?>
                        - <?= strtoupper($client->nom) . ' ' . ucfirst($client->prenom); ?><br/>
                    <?php } ?>
                </div>
            </div>
            <br/>
            <div class="row col-md-12">
                <span style="vertical-align: top;">Apporteur (s) :</span>
                <div style='display:inline-block;margin-left:20px;' class="pull-right">
                    <?php foreach ($vente->apporteur as $apporteur) { ?>
                        - <?= strtoupper($apporteur->nom) . ' ' . ucfirst($apporteur->prenom); ?><br/>
                    <?php } ?>
                </div>
            </div>
            <br/>
            <div class="row col-md-12">
                <span style="vertical-align: top;">Notaire acquereur :</span>
                <div style='display:inline-block;margin-left:20px;' class="pull-right">
                    <?php foreach ($vente->notaire_acquereur as $notaire) { ?>
                        - <?= strtoupper($notaire->nom) . ' ' . ucfirst($notaire->prenom); ?><br/>
                    <?php } ?>
                </div>
            </div>
            <br/>
            <div class="row col-md-12">
                <span style="vertical-align: top;">Notaire vendeur :</span>
                <div style='display:inline-block;margin-left:20px;' class="pull-right">
                    <?php foreach ($vente->notaire_vendeur as $notaire) { ?>
                        - <?= strtoupper($notaire->nom) . ' ' . ucfirst($notaire->prenom); ?><br/>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-12 center marginBottom">
                <a href="<?php echo base_url() . 'vente/modifier/' . $vente->id; ?>" class="btn btn-info center"><i class="fa fa-gears"></i>&nbsp;Modifier les informations</a> 
            </div>
            <h3 class="hrblack black">Financement</h3>
            <?php if (!isset($vente->pret->id)) { ?>
                <div class="col-md-12 center">
                    <a class="btn btn-info" href="<?= base_url('vente/pret/' . $vente->id); ?>"><i class="fa fa-plus"></i>&nbsp;Ajouter un emprunt</a>
                </div>
            <?php } else { ?>
                <div class="col-md-12">
                    <span style="vertical-align: top;">Date de signature compromis :</span>
                    <div style='display:inline-block;margin-left:20px;' class="pull-right">
                        <?= conv_date($vente->pret->date_signature); ?><br/>
                    </div>
                </div>
                <div class="col-md-12">
                    <span style="vertical-align: top;">Délai :</span>
                    <div style='display:inline-block;margin-left:20px;' class="pull-right">
                        <?= $vente->pret->delai; ?> jours<br/>
                    </div>
                </div>
                <div class="col-md-12">
                    <span style="vertical-align: top;">Date butoir :</span>
                    <div style='display:inline-block;margin-left:20px;' class="pull-right">
                        <?= conv_date(date('Y-m-d', strtotime($vente->pret->date_signature . ' +' . $vente->pret->delai . ' days'))); ?><br/>
                    </div>
                </div>
                <?php if ($vente->pret->date_obtention_pret == "0000-00-00") { ?>
                    <div class="col-md-12 center">
                        <span style="vertical-align: top;color:red;">Pas d'obtention du prêt pour le moment</span>
                    </div>
                <?php } else { ?>
                    <div class="col-md-12">
                        <span style="vertical-align: top;">Date d'obtention du prêt :</span>
                        <div style='display:inline-block;margin-left:20px;' class="pull-right">
                            <?= conv_date($vente->pret->date_obtention_pret); ?><br/>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <span style="vertical-align: top;">Banque :</span>
                        <div style='display:inline-block;margin-left:20px;' class="pull-right">
                            <?= $vente->pret->banque->nom; ?><br/>
                        </div>
                    </div>
                <?php } ?>
                <div class="col-md-12 center">
                    <a class="btn btn-info" href="<?= base_url('vente/modif_pret/' . $vente->pret->id); ?>"><i class="fa fa-gears"></i>&nbsp;Modifier l'emprunt</a>
                </div>
            <?php } ?>
        </div>
        <?php
        $totalInitialTTC = 0;
        $totalfraisagence = 0;
        $totalInitialHT = 0;
        $totalTVA = 0;
        foreach ($vente->lots as $lot) {
            $totalInitialHT += $lot->prixnetvendeur;
            $totalfraisagence += $lot->fraisagence;
            $totalInitialTTC += calc_ttc_vente($lot);
            if ($lot->typeTVA == "montant") {
                $totalTVA += $lot->tvaprixnetvendeur;
            } else {
                $totalTVA += calc_ttc_vente($lot) - $lot->prixnetvendeur;
            }
            if ($lot->typefraisagence == "acquereur") {
                $totalInitialHT += $lot->fraisagence;
            }
        }
        ?>
        <div class="col-md-7">
            <div class="col-md-8 col-md-offset-2 center">
                <!-- Prix initiaux -->
                <h3 class="hrblack black">Prix Initiaux</h3>
                <p>Total de la vente HT : <?= format_number($totalInitialHT); ?> € FAI</p>
                <p>Total des frais d'agence : <?= format_number($totalfraisagence); ?> €</p>
                <p>Total de TVA : <?= format_number($totalTVA); ?> €</p>
                <p>Total de la vente TTC : <?= format_number($totalInitialTTC); ?> € FAI</p>
                <a role="button" class='btn btn-info' data-toggle="modal" href="#prixInitiaux"><i class="fa fa-info-circle"></i>&nbsp;Voir les détails</a>
                
                <!-- Prix compromis -->
                <h3 class="hrblack black">Prix Compromis</h3>
                <?php
                $compromis = $prixcompromis[sizeof($prixcompromis)-1];
                $totalInitial = 0;
                $totalTVA = 0;
                $totalFraisAgence = 0;
                $totalTTC = 0;
                $compromis = json_decode($compromis);
                foreach ($compromis as $prix) {
                    $totalInitial += $prix->prixnetvendeur;
                    if ($prix->typeTVA == "montant") {
                        $totalTVA += $prix->TVA;
                    } else {
                        $totalTVA += ($prix->prixnetvendeur * (1 + ($prix->TVA / 100)));
                    }
                    if($prix->typefraisagence == "acquereur"){
                        $totalInitial += $prix->fraisagence;
                    }
                    $totalFraisAgence += $prix->fraisagence;
                }
                $totalTTC = $totalInitial + $totalTVA;
                ?>
                <b><p>Prix n°<?= sizeof($prixcompromis); ?></p></b>
                <p>Prix compromis HT : <?= format_number($totalInitial); ?> € FAI</p>
                <p>Total des frais d'agence : <?= format_number($totalFraisAgence); ?> €</p>
                <p>Total de TVA : <?= format_number($totalTVA); ?> €</p>
                <p>Prix compromis TTC : <?= format_number($totalTTC); ?> € FAI</p>
                <a role="button" class='btn btn-info' data-toggle="modal" href="#prixCompromis"><i class="fa fa-info-circle"></i>&nbsp;Voir les détails</a>
                <?php if ($vente->etat == "compromis" || $vente->etat == "initial") { ?>
                    <a role="button" class='btn btn-success' data-toggle="modal" href="<?= base_url('vente/compromis/' . $vente->id); ?>"><i class="fa fa-warning"></i>&nbsp;Ajouter un prix compromis</a>
                <?php } ?>
                    
                 <!-- Prix actés -->
                <h3 class="hrblack black">Prix Acté</h3>
                <?php if ($vente->etat == "compromis") { ?>
                    <a role="button" class='btn btn-success' data-toggle="modal" href="<?= base_url('vente/acte/' . $vente->id); ?>"><i class="fa fa-warning"></i>&nbsp;Acter la vente</a>
                <?php } ?>
            </div>
        </div>    
    </div>
    <div class="row center">
        <a href="<?= base_url('vente/abandonner/' . $vente->id); ?>" class="btn btn-danger right"><i class="fa fa-minus-circle"></i>&nbsp;Abandonner la vente!</a>
    </div>
</div>

<!-- Modal des prix initiaux détails -->
<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="prixInitiaux" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row-centered" style="margin:0;">
                    <h3 class='hr'>Détails des prix initiaux</h3>
                    <br/>
                    <?php
                    foreach ($vente->lots as $lot) {
                        if ($lot->typeTVA == "pourcentage") {
                            $totalTTC = calc_tva($lot->prixnetvendeur, $lot->tvaprixnetvendeur);
                        } else {
                            $totalTTC = $lot->prixnetvendeur + $lot->tvaprixnetvendeur;
                        }
                        if ($lot->typefraisagence == "acquereur") {
                            $totalTTC += $lot->fraisagence;
                        }
                        $totalTTC = format_number($totalTTC);
                        $totalHT = $lot->prixnetvendeur;
                        if ($lot->typefraisagence == "acquereur") {
                            $totalHT += $lot->fraisagence;
                        }
                        ?>
                        <h4 class="hr white center" style='color:white !important;'>Lot n°<?= $lot->numero_lot; ?></h4>
                        <p>Prix net vendeur : <?= format_number($totalHT); ?> € FAI</p>
                        <p>Coût TVA : <?php if ($lot->typeTVA == "pourcentage") {
                            echo format_number(calc_tva($lot->prixnetvendeur, $lot->tvaprixnetvendeur) - $lot->prixnetvendeur);
                        } else {
                            echo format_number($lot->tvaprixnetvendeur);
                        } ?> €</p>
                        <p>Coût frais d'agence : <?= format_number($lot->fraisagence); ?> € (Charge <?= $lot->typefraisagence; ?>)</p>
                        <p>Total TTC du lot : <?= $totalTTC; ?> € FAI</p>
                        <br/>
<?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>  

<!-- Modal des prix compromis -->
<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="prixCompromis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row-centered" style="margin:0;">
                    <h3 class='hr'>Détails des prix compromis</h3>
                    <br/>
                    <?php
                    $i = 0;
                    foreach ($prixcompromis as $prix) {
                        $i++;
                        $totalInitial = 0;
                        $totalTVA = 0;
                        $totalFraisAgence = 0;
                        $totalTTC = 0;
                        $compromis = json_decode($prix);
                        foreach ($compromis as $prix) {
                            $totalInitial += $prix->prixnetvendeur;
                            if ($prix->typeTVA == "montant") {
                                $totalTVA += $prix->TVA;
                            } else {
                                $totalTVA += ($prix->prixnetvendeur * (1 + ($prix->TVA / 100)));
                            }
                            if($prix->typefraisagence == "acquereur"){
                                $totalInitial += $prix->fraisagence;
                            }
                            $totalFraisAgence += $prix->fraisagence;
                        }
                        $totalTTC = $totalInitial + $totalTVA;
                        ?>
                        <h4 class="hr white center" style='color:white !important;'>Prix compromis n°<?= $i; ?></h4>
                        <p>Prix net vendeur : <?= format_number($totalInitial); ?> € FAI</p>
                        <p>Coût TVA : <?= format_number($totalTVA); ?> €</p>
                        <p>Coût frais d'agence : <?= format_number($totalFraisAgence); ?> €</p>
                        <p>Total TTC du prix : <?= format_number($totalTTC); ?> € FAI</p>
                        <br/>
<?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>  