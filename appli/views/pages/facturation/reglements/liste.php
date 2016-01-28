<div class="container detail-projet">
    <br/>
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
    </div>
    <div class="container bottom">
        <br/>
        <div class="row noPadding">
            <div class="col-md-3 detail-facture"><?php echo 'Facture n°' . $facture->numFacture; ?> </div>
            <div class="col-md-3 detail-facture"><?php echo 'Total : ' . format_number(floatval(calc_tva($facture->montantHT, $facture->tva, false)) - floatval($facture->avoir)) . ' € (avec avoir)'; ?></div>
            <div class="col-md-3 detail-facture"><?php echo 'Avoir : ' . format_number(floatval($facture->avoir)) . ' €'; ?></div>
            <div class="col-md-3 detail-facture"><?php echo 'Reste à payer : ' . format_number(floatval(calc_tva($facture->montantHT, $facture->tva, false)) - floatval($facture->regle->montant) - floatval($facture->avoir)) . ' €'; ?></div>
        </div>
    </div>
    <div class="row">
        <?php $total_regle = 0;
        if (sizeof($reglements) == 0) { ?>
            <div class="row center">
                <h3 class="hr">Aucun réglement enregistré pour cette facture</h3>
            </div>
        <?php } else {
            $x = 0;
            $total_regle = 0; ?>
    <?php foreach ($reglements as $reglement) {
        $x++;
        $total_regle += floatval($reglement->montant); ?>
                <div class="col-md-3">
                    <div class="reglement" data-search="">
                        <div class="reglement-body">
                            <div class="row reglement-details">
                                <p class="hr">Réglement n° <?php echo $x; ?></p>
                                <p>Total réglement :  <br/><b><?php echo format_number(floatval($reglement->montant)) . " €"; ?></b></p>
                                <p>Société en charge du réglement :  <br/><b><?php echo $reglement->societe->nom; ?></b></p>
                                <p>Compte débité :  <br/><b><?php echo $reglement->compte->banque . " | " . $reglement->compte->numero; ?></b></p>
                            </div>
                            <div class="row reglement-btn">
                                <div class="col-md-10 text-left">
                                    <a href="<?php echo base_url('facturation/supprimer_reglement/'.$facture->id.'/'.$reglement->id); ?>" class="btn small text-left btn-danger">Supprimer</a>
                                    <a href="<?php echo base_url('facturation/modifier_reglement/'.$facture->id.'/'.$reglement->id); ?>" class="btn small text-left btn-info">Modifier</a>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
    <?php }?>
<?php } if(floatval($total_regle) < floatval(calc_tva($facture->montantHT, $facture->tva, false)) - floatval($facture->avoir)){?>
        <div class="col-md-5">
            <div class="reglement" data-search="">
                <div class="reglement-body">
                    <?php echo form_open(base_url('facturation/creer_reglement/'.$facture->id)); ?>
                    <div class="row reglement-details">
                        <p class="hr">Ajouter réglement</p>
                        <div style="padding:5px;">
                            <input class="form-control" type="text" name="montant" value="<?php echo set_value('montant'); ?>" placeholder="Montant payé...">
                                <?php echo form_error('montant'); ?>
                            <p>Société en charge du réglement :</p>
                            <select class="form-control" name="societe" id="societeliste">
<?php foreach ($societes as $societe) { ?>
                                    <option value="<?php echo $societe->id; ?>"><?php echo $societe->nom; ?></option>
                                <?php } ?>
                            </select>
                            <p>Compte débité :</p>
                            <select class="form-control" name="compte">
<?php foreach ($comptes as $compte) { ?>
                                    <option value="<?php echo $compte->id; ?>"><?php echo $compte->banque . " | " . $compte->numero; ?></option>
<?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row reglement-btn">
                        <div class="col-md-10 text-left">
                            <input type="submit" class="btn small btn-success"/>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>                        
            </div>
<?php } ?>
            <div class="col-md-12 hr"></div>
            <div class="col-md-12"><h3>Total des réglements : <?php echo format_number(floatval($total_regle))." €"; ?></h3></div>
        </div>
    </div>