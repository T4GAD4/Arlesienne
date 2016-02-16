<div class="container detail-projet">
    <br/>
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
    </div>
</div>
<?php
$reste = floatval(calc_tva($facture->montantHT, $facture->tva, false)) - $facture->reparti;
?>
<div class="container bottom">
    <br/>
    <div class="row noPadding">
        <div class="col-md-4 detail-facture"><?php echo 'Facture n°' . $facture->numFacture; ?> </div>
        <div class="col-md-4 detail-facture"><?php echo 'Total : ' . format_number(floatval(calc_tva($facture->montantHT, $facture->tva, false))) . ' € (sans avoir)'; ?></div>
        <div class="col-md-4 text-right detail-facture"><?php echo 'Reste à répartir : ' . format_number($reste) . ' €'; ?></div>
    </div>
</div>
<div class="row">
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in">
            <div class="row factures">
                <?php
                $x = 0;
                foreach ($repartis as $reparti) {
                    $x++;
                    ?>
                    <div class="col-md-3 facture facture-centered searchable">
                        <div class="row col-md-11 facture-content">
                            <div class="col-md-12" style="text-align:center !important;">
                                <h4>
                                    <a href="<?php echo base_url("facturation/details_repartition/$reparti->id"); ?>">
                                        Répartition n° <?= $x; ?>
                                    </a>
                                </h4>
                            </div>
                            <div class="col-md-12 hrblack">
                                <span>
                                    <?php echo 'Projet : ' . $projet->nom; ?>
                                </span>
                                <span class="pull-right">
                                    <?php echo 'Marché : ' . $reparti->marche->nom; ?>
                                </span>
                            </div>
                            <div class="col-md-12 center">
                                <span>
                                    <?php echo 'Montant réparti : ' . format_number($reparti->montant); ?> €
                                </span>
                            </div>
                            <div class="col-md-12 right">
                                <span>
                                    <a class='pull-right' data-toggle='tooltip' data-original-title='! Supprimer le montant réparti !' href='<?= base_url('facturation/supprimer_repartition/'.$facture->id.'/'.$reparti->id); ?>'><i class='fa fa-minus-circle' style='color:red !important;'></i></a>
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
<div class="row">
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in">
            <div class="row factures">
                <?php
                if ($reste > 0) {
                    ?>
                    <div class="col-md-3 col-md-offset-4">
                        <div class="reglement" data-search="">
                            <div class="reglement-body">
                                <?php echo form_open(base_url('facturation/creer_repartition/' . $facture->id)); ?>
                                <div class="row reglement-details">
                                    <h4 class="hr">Ajouter répartition</h4>
                                    <div style="padding:5px;">
                                        <input class="form-control" type="text" name="montant" value="<?php echo set_value('montant'); ?>" placeholder="Montant à répartir...">
                                        <?php echo form_error('montant'); ?>
                                        <p>Marché concerné * :</p>
                                        <select class="form-control chosen-select" name="marche">
                                            <?php foreach ($marches as $marche) { ?>
                                                <option value="<?php echo $marche->id; ?>" <?php
                                                if (set_value('marche') == $marche->id) {
                                                    echo 'selected';
                                                }
                                                ?>><?php echo $marche->nom; ?></option>
    <?php } ?>
                                        </select>
                                        <br/><br/>
                                        <p>Avenant concerné :</p>
                                        <select class="form-control" name="avenant">
                                            <option value='0'>Choisissez un avenant</option>
                                            <?php foreach ($avenants as $avenant) { ?>
                                                <option value="<?php echo $avenant->id; ?>"><?php echo $avenant->numero . " | " . $avenant->objet ." - ".conv_date($avenant->date); ?></option>
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
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('[name=marche]').on('change', function () {
                var data = {};
                data.projet = $(this)[0].value;

                //On effectue la requete AJAX
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('/AJAX/avenant/liste'); ?>",
                    data: data
                }).success(function (data) {
                    data = JSON.parse(data);
                    //On vide la liste actuelle
                    $('[name=avenant]').empty();
                    $('[name=avenant]').append("<option value='0'>Choisissez un avenant</option>");
                    $.each(data, function (key, value) {
                        $('[name=avenant]').append("<option value='" + value.id + "'>" + value.numero +" | "+ value.objet + "</option>");
                    });
                }).fail(function () {
                    alert('Erreur de chargement des avenants! Veuillez recommencer!');
                })
            });
        })
    </script>