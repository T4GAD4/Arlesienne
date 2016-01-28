<div class="container detail-projet">
    <br/>
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        <a href="<?php echo base_url().'facturation/creer/'; ?>" class="btn btn-info pull-right">Créer une facture</a> 
    </div>
    
    <div class="row">
        <h1 class="hr">Facturation</h1>
    </div>
    <br/>
    <div class="row noPadding">
        <div class="module__tools">
            <div class="custom-search">
                <input class="custom-search-input" type="search" id="search" placeholder="Rechercher...">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in">
            <div class="row factures">
                    <?php
                    foreach ($factures as $facture) {
                            ?>
                            <div class="col-md-4 facture facture-centered searchable" data-search="<?php echo calc_tva($facture->montantHT,$facture->tva,false).' '.$facture->montantHT.' '.$facture->entreprise->nom.' '.$facture->numFacture.' '.$facture->objet.' '.$facture->dateFacture.' '.conv_date($facture->dateFacture) ?>">
                                <div class="row col-md-11 facture-content">
                                    <div class="col-md-12" style="text-align:center !important;">
                                        <h4>
                                            <a href="<?php echo base_url("facturation/details/$facture->id"); ?>">
                                                <?php echo $facture->entreprise->nom; ?>
                                            </a>
                                            </h4>
                                    </div>
                                    <div class="col-md-12 hrblack">
                                        <span>
                                            <?php echo 'Numéro : '.$facture->numFacture; ?>
                                        </span>
                                        <span class="pull-right">
                                            <?php echo conv_date($facture->dateFacture); ?>
                                        </span>
                                    </div>
                                    <div class="col-md-12">
                                        <span>
                                            <?php echo 'Objet : '.$facture->objet; ?>
                                        </span>
                                    </div>
                                    <div class="col-md-12">
                                        <span>
                                            <?php echo 'Retenue de Garantie : '; echo ($facture->rg == "true")? "Oui" : "Non"; ?>
                                        </span>
                                    </div>
                                    <div class="col-md-12 facture-payement">
                                        <span class="pull-right">
                                            <?php echo 'Total facture : '. format_number(floatval(calc_tva($facture->montantHT, $facture->tva,false))-floatval($facture->avoir)).' €'; ?>
                                        </span>
                                    </div>
                                    <br/>
                                    <div class="col-md-12 facture-payement">
                                        <span class="pull-left">
                                            <?php echo 'Avoir : - '. format_number(floatval($facture->avoir)).' €'; ?>
                                        </span>
                                        <span class="pull-right">
                                            <?php echo 'Déjà payé : '.  format_number($facture->regle->montant).' €'; ?>
                                        </span>
                                    </div>
                                    <br/>
                                    <div class="col-md-12 facture-payement">
                                        <span class="pull-right">
                                            <?php echo 'Reste à régler : '.format_number(floatval(calc_tva($facture->montantHT, $facture->tva,false))-floatval($facture->regle->montant)-floatval($facture->avoir)).' €'; ?>
                                        </span>
                                        <br/>
                                        <span class="pull-left">
                                            <a href="<?php echo base_url("facturation/repartir/$facture->id"); ?>" class="btn small text-left">Répartir</a>
                                        </span>
                                        <span class="pull-right">   
                                            <a href="<?php echo base_url("facturation/regler/$facture->id"); ?>" class="btn small text-left">Réglements</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    ?>
            </div>
        </div>
    </div>
</div>