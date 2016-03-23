<div class="container detail-projet">
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        <a class="btn btn-info pull-right" href='<?= base_url('marche/modifier/' . $marche->id); ?>'><i class='fa fa-gears'></i> Modifier le marché</a>
    </div>
    <div class='col-md-5'>

    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h3 class="hr center"><?= $marche->nom; ?></h3>
        <h4 class="small white center"><?= $marche->categorie; ?> - 
        <?php if($marche->devise == "false"){ ?>
        <b>MARCHÉ NON DEVISÉ</b>
        <?php }else{ ?>
        <b>MARCHÉ DEVISÉ</b>
        <?php } ?></h4>
    </div>
</div>
<div class='col-md-5'>
    <br/>
    <br/>
    <div class='row  detailsMarches'>
        <h3 class="center black">Résumé général - <?= $projet->nom; ?></h3>
        <span class="hrblack"></span>
        <div class="col-md-12">
            <p><b>Entreprise(s) du marché : </b>
            <?php if(sizeof($entreprises) > 0){foreach($entreprises as $entreprise){ ?>
            <?= $entreprise->nom.', '; ?>
            <?php }}else{ ?>
            Aucune entreprise associée au marché!
            <?php } ?></p>
            <p><b>Total du marché et des avenants TTC</b> : <?= format_number(calc_tva($marche->montantHT,$marche->TVA) + floatval($totalAvenantsTTC)); ?> €</p>
            <p><b>Total des factures reçues TTC</b> : <?= format_number($totalFacturesTTC); ?> €</p>
            <p><b>Total des réglements</b> : <?= format_number($totalReglements); ?> €</p>
            <p><b>Restant à régler sur factures reçues</b> : <?= format_number($totalFacturesTTC - $totalReglements); ?> €</p>
            <p><b>Solde marché (total marché - total réglé)</b> : <?= format_number((calc_tva($marche->montantHT,$marche->TVA) + floatval($totalAvenantsTTC)) - $totalReglements); ?> €</p>
        </div>
    </div>
    <?php foreach($entreprises as $entreprise){ if($entreprise->nom != ""){ ?>
    
        <br/>
        <br/>
        <div class='row  detailsMarches'>
            <h3 class="center black">Résumé <?= $entreprise->nom; ?></h3>
            <span class="hrblack"></span>
            <div class="col-md-12">
                <p><b>Total des avenants HT</b> : <?= format_number($entreprise->avenantHT); ?> €</p>
                <p><b>Total des avenants TTC</b> : <?= format_number($entreprise->avenantTTC); ?> €</p>
                <p><b>Total des factures reçues HT</b> : <?= format_number($entreprise->factureHT); ?> €</p>
                <p><b>Total des factures reçues TTC</b> : <?= format_number($entreprise->factureTTC); ?> €</p>
                <p><b>Total des réglements HT</b> : <?= format_number($entreprise->reglementHT); ?> €</p>
                <p><b>Total des réglements TTC</b> : <?= format_number($entreprise->reglementTTC); ?> €</p>
                <p><b>Restant à régler sur factures reçues</b> : <?= format_number($entreprise->factureTTC - $entreprise->reglementTTC); ?> €</p>
            </div>
        </div>
    <?php }} ?>
</div>
<div class='col-md-7'>
    <div class="col-md-12 white center">
        <h4 class="hr">Résumé du marché</h4>
        <br/>
        <b><p>Coût HT : <?= format_number($marche->montantHT); ?> €</p></b>
        <b><p>TVA : <?= format_number($marche->TVA); ?> %</p></b>
        <b><p>Coût TTC : <?= format_number(calc_tva($marche->montantHT,$marche->TVA)); ?> €</p></b>
        <br/>
    </div>
    <div class="col-md-12 col-centered" style="text-align:center;">
        <br/>
        <h4 class="hr white">AVENANTS</h4>
        <a class="btn btn-default" href="<?= base_url('avenant/creer/' . $marche->id); ?>"><i class="fa fa-plus"></i> Créer un avenant</a>
        <?php
        if (sizeof($avenants) > 0) {
            $x = 0;
            ?>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-top:10px;text-align:left;">
    <?php foreach ($avenants as $avenant) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading<?= $x; ?>">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $x; ?>" aria-expanded="false" aria-controls="collapse<?= $x; ?>">
        <?= $avenant->numero . ' | ' . $avenant->objet . ' - ' . $avenant->entreprise->nom . '&nbsp;&nbsp;'.conv_date($avenant->date).'&nbsp;&nbsp;<span class="badge">' . format_number(calc_tva($avenant->montantHT, $avenant->TVA)) . ' €</span>'; ?><a data-toggle="tooltip" title="" data-original-title="! Supprimer l'avenant !"  href="<?= base_url('avenant/supprimer/' . $avenant->id); ?>" class="pull-right"><i class="fa fa-minus-circle" style='padding-left:5px;color:red;'></i></a><a data-toggle="tooltip" title="" data-original-title="Modifier l'avenant"  href="<?= base_url('avenant/modifier/' . $avenant->id); ?>" class="pull-right"><i class="fa fa-gears"></i></a>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse<?= $x; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $x; ?>">
                            <div class="panel-body">
                                <div class='col-md-4 center'>
                                    <h5 class='hrblack'>Montants</h5>
                                    Montant HT : <?= format_number($avenant->montantHT); ?> €<br/>
                                    TVA : <?= format_number($avenant->TVA); ?> %<br/>
                                    Montant TTC : <?= format_number(calc_tva($avenant->montantHT, $avenant->TVA)); ?> €<br/>
                                </div>
                                <div class='col-md-8 center'>
                                    <h5 class='hrblack'>Répartition</h5>
                                    Nombre de factures répartis dans cet avenant : <?= $avenant->nbFactures; ?><br/>
                                    Total réparti dans cet avenant : <?= format_number($avenant->mnt_reparti); ?> €<br/>
                                    Reste à répartir dans cet avenant : <?= format_number(calc_tva($avenant->montantHT, $avenant->TVA) - $avenant->mnt_reparti); ?> €<br/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $x++;
                }
                ?>
            </div>
        <?php } else { ?>
            <h3>Aucun avenant enregistré pour ce marché.</h3>
<?php } ?>
    </div>
    <div class="col-md-12 col-centered" style="text-align:center;">
        <br/>
        <br/>
        <h4 class="hr white">FACTURES</h4>
        <a data-toggle="tooltip" data-original-title="! Attention ! Redirection vers les factures!" class="btn btn-default" href="<?= base_url('facturation/creer'); ?>"><i class="fa fa-plus"></i> Créer une facture</a>
        <?php
        if (sizeof($factures) > 0) {
            $x = 0;
            ?>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-top:10px;text-align:left;">
    <?php foreach ($factures as $facture) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="heading<?= $x; ?>">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#facture<?= $x; ?>" aria-expanded="false" aria-controls="facture<?= $x; ?>">
        <?= $facture->objet . ' - ' . $facture->entreprise->nom . '&nbsp;&nbsp;<span class="badge"> Réglé : ' . format_number($facture->regle) . ' € / ' . format_number(calc_tva($facture->montantHT, $facture->tva)); ?> €</span><a data-toggle="tooltip" title="" data-original-title="! Supprimer la facture !"  href="<?= base_url('facturation/supprimer/' . $facture->id); ?>" class="pull-right"><i class="fa fa-minus-circle" style='padding-left:5px;color:red;'></i></a><a data-toggle="tooltip" title="" data-original-title="Modifier la facture"  href="<?= base_url('facturation/details/' . $facture->id); ?>" class="pull-right"><i class="fa fa-gears"></i></a>
                                </a>
                            </h4>
                        </div>
                        <div id="facture<?= $x; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="facture<?= $x; ?>">
                            <div class="panel-body">
                                <p>Facture reçu le <?= conv_date($facture->dateFacture); ?> et à échéance le <?= conv_date($facture->dateEcheance); ?></p>
                                <?php if($facture->regle != 0){ ?>
                                <p>Payé le // A remplir</p>
                                <?php } ?>
                                <span class="pull-right">   
                                    <a href="<?php echo base_url("facturation/regler/$facture->id"); ?>" class="btn btn-xs small text-left">Réglements</a>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php
                $x++;
            }
            ?>
            </div>
<?php } else { ?>
            <h3>Aucune facture enregistrée pour ce marché.</h3>
<?php } ?>
    </div>

</div>
</div>