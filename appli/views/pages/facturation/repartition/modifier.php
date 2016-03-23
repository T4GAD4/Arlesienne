<div class="container detail-projet">
    <br/>
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
    </div>
</div>
<div class="container bottom">
    <br/>
    <div class="row noPadding">
        <div class="col-md-4 detail-facture"><?php echo 'Facture n°' . $facture->numFacture; ?> </div>
        <div class="col-md-4 detail-facture"><?php echo 'Total : ' . format_number(floatval(calc_tva($facture->montantHT, $facture->tva, false))) . ' € (sans avoir)'; ?></div>
        <div class="col-md-4 text-right detail-facture"><?php echo 'Reste à répartir : ' . format_number($reste) . ' €'; ?></div>
    </div>
</div>
<div class="row">
    <?php echo form_open(base_url('facturation/details_repartition/' . $reparti->id)); ?>
    <div class="col-md-6 col-md-offset-3 center">
        <h4 class="white hr center">Modifier répartition</h4>
        <div style="padding:5px;">
            <input class="form-control" type="text" name="montant" value="<?php echo set_value('montant',$reparti->montant); ?>" placeholder="Montant à répartir...">
            <?php echo form_error('montant'); ?>
            <div class="row reglement-btn">
                <div class="col-md-10 text-left">
                    <input type="submit" class="btn small btn-success"/>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>