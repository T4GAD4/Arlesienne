<div class="container detail-projet">
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        <a class="btn btn-info pull-right" href='<?= base_url('marche/modifier/' . $marche->id); ?>'><i class='fa fa-gears'></i> Modifier le marché</a>
    </div>
    <div class='col-md-5'>

    </div>
</div>
<div class='col-md-7'>
    <br/>
    <br/>
    <div class='row  detailsProjets'>
        
    </div>
</div>
<div class='col-md-5'>
    <div class="col-md-12 col-centered" style="text-align:center;">
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
        <?= $avenant->numero . ' | ' . $avenant->objet . ' - ' . $avenant->entreprise->nom . '&nbsp;&nbsp;<span class="badge">' . format_number(calc_tva($avenant->montantHT, $avenant->TVA)) . ' €</span>'; ?><a data-toggle="tooltip" title="" data-original-title="! Supprimer l'avenant !"  href="<?= base_url('avenant/supprimer/' . $avenant->id); ?>" class="pull-right"><i class="fa fa-minus-circle" style='padding-left:5px;color:red;'></i></a><a data-toggle="tooltip" title="" data-original-title="Modifier l'avenant"  href="<?= base_url('avenant/modifier/' . $avenant->id); ?>" class="pull-right"><i class="fa fa-gears"></i></a>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse<?= $x; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $x; ?>">
                            <div class="panel-body">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
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
        <a data-toggle="tooltip" data-original-title="! Attention ! Redirection vers les factures!" class="btn btn-default" href="<?= base_url('facture/creer'); ?>"><i class="fa fa-plus"></i> Créer une facture</a>
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
        <?= $facture->objet . ' - ' . $facture->entreprise->nom . '&nbsp;&nbsp;<span class="badge"> Réglé : ' . format_number($facture->regle) . ' € / ' . format_number(calc_tva($facture->montantHT, $facture->tva)); ?> €</span><a data-toggle="tooltip" title="" data-original-title="! Supprimer l'avenant !"  href="<?= base_url('avenant/supprimer/' . $avenant->id); ?>" class="pull-right"><i class="fa fa-minus-circle" style='padding-left:5px;color:red;'></i></a><a data-toggle="tooltip" title="" data-original-title="Modifier l'avenant"  href="<?= base_url('avenant/modifier/' . $avenant->id); ?>" class="pull-right"><i class="fa fa-gears"></i></a>
                                </a>
                            </h4>
                        </div>
                        <div id="facture<?= $x; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="facture<?= $x; ?>">
                            <div class="panel-body">
                                <p>Facture reçu le <?= conv_date($facture->dateFacture); ?> et à échéance le <?= conv_date($facture->dateEcheance); ?></p>
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