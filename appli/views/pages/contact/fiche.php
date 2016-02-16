<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <a href='<?= base_url('fiche-contact/imprimer/'.$contact->id); ?>' target="_blank" class="btn btn-info pull-right"><i class="fa fa-print"></i>&nbsp;&nbsp;Imprimer la fiche</a>
        </div>
    </div>
    <br/>
    <form action='<?php echo site_url("fiche-contact/vue/$contact->id"); ?>' method="post" accept-charset="utf-8">
        <fieldset>
            <legend>
                Fiche de renseignement <?= $contact->prenom . ' ' . $contact->nom; ?>
            </legend>
        </fieldset>
        <div class='col-md-12'>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">Recherche : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered" style='text-align:center;'>
                        <h4 style='color:whitesmoke;'><input name='recherche[achat]' <?php if($fiche->achat == 1){echo "checked";} ?> type="checkbox" value='1'/> Achat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='recherche[location]' type="checkbox" value='1' <?php if($fiche->location == 1){echo "checked";} ?>/> Location</h4>
                    </div>
                </div>
            </div>
            <?php $fiche->secteur = json_decode($fiche->secteur); ?>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">Secteur : <a href="#" data-toggle="modal" data-target="#ModalSecteur"><i class="fa fa-plus"></i></a></label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <select multiple name='secteur[]' id="secteur_chosen" class='chosen-select'>
                            <option value=""></option>
                            <?php foreach($secteurs as $ky => $value){ ?>
                                <option value="<?= $value; ?>" <?php if(in_array($value, (Array)$fiche->secteur)){echo "selected";} ?>><?= $value; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">Opération initiale : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <select name='operation' class='chosen-select'>
                            <option value="0">Selectionnez un projet</option>
                            <?php foreach ($projets as $projet) { ?>
                                <option value="<?= $projet->id; ?>" <?php if($projet->id == $fiche->idProjet){echo "selected";} ?>><?= $projet->nom; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">Type de bien : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered" style='text-align:center;'>
                        <h4 style='color:whitesmoke;'><input name='typebien[maison]' type="checkbox" <?php if($fiche->maison == 1){echo "checked";} ?> value='maison'/> Maison&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='typebien[appartement]' type="checkbox" <?php if($fiche->appartement == 1){echo "checked";} ?> value='appartement'/> Appartement&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='typebien[loft]' <?php if($fiche->loft == 1){echo "checked";} ?> type="checkbox" value='loft'/> Loft&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='typebien[commerce]' type="checkbox"  <?php if($fiche->commerce == 1){echo "checked";} ?> value='commerce'/> Commerce&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='typebien[bureau]' type="checkbox" <?php if($fiche->bureau == 1){echo "checked";} ?> value='bureau'/> Bureau</h4>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">Typologie : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered" style='text-align:center;'>
                        <h4 style='color:whitesmoke;'><input name='typologie[t2]' type="checkbox"  <?php if($fiche->t2 == 1){echo "checked";} ?> value='t2'/> T2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='typologie[t3]' <?php if($fiche->t3 == 1){echo "checked";} ?> type="checkbox" value='t3'/> T3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='typologie[t4]' <?php if($fiche->t4 == 1){echo "checked";} ?> type="checkbox" value='t4'/> T4&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='typologie[t5]' <?php if($fiche->t5 == 1){echo "checked";} ?> type="checkbox" value='t5'/> T5</h4>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">Surface : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered" style='text-align:center;'>
                        <h4 style='color:whitesmoke;'><input name='surface[amenagee]' <?php if($fiche->amenagee == 1){echo "checked";} ?> type="checkbox" value='amenagee'/> Aménagée&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='surface[brute]' <?php if($fiche->brute == 1){echo "checked";} ?> type="checkbox" value='brute'/> Brute</h4>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">Autres : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered" style='text-align:center;'>
                        <h4 style='color:whitesmoke;'><input name='autres[jardin]' <?php if($fiche->jardin == 1){echo "checked";} ?> type="checkbox" value='jardin'/> Jardin ?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='autres[parking]' <?php if($fiche->parking == 1){echo "checked";} ?> type="checkbox" value='parking'/> Parking ?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='autres[garage]' <?php if($fiche->garage == 1){echo "checked";} ?> type="checkbox" value='garage'/> Garage ?</h4>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">Superficie : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <input id="superficie" name="superficie" type="text" placeholder="" class="form-control" value="<?= $fiche->superficie ; ?>" >
                        <?php echo form_error('superficie'); ?>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">Type d'achat : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered" style='text-align:center;'>
                        <h4 style='color:whitesmoke;'><input name='typeachat[investissement_locatif]' <?php if($fiche->investissement_locatif == 1){echo "checked";} ?> type="checkbox" value='investissement_locatif'/> Investissement locatif&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='typeachat[residence_principale]' <?php if($fiche->residence_principale == 1){echo "checked";} ?> type="checkbox" value='residence_principale'/> Résidence principale&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='typeachat[residence_secondaire]' <?php if($fiche->residence_secondaire == 1){echo "checked";} ?> type="checkbox" value='residence_secondaire'/> Résidence secondaire</h4>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">Budget : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <input id="budget" name="budget" type="text" placeholder="" class="form-control" value="<?= $fiche->budget ; ?>" >
                        <?php echo form_error('budget'); ?>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">Observations : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <input id="observation" name="observation" type="text" placeholder="" class="form-control" value="<?= $fiche->observation ; ?>" >
                        <?php echo form_error('observation'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Annuler"/>
                    <input type="submit" class="btn btn-warning pull-right" value="Modifier"/>
                </div>
            </div>
        </div>
    </form>
</div>



<!-- Modal Secteur -->
<div class="modal fade" id="ModalSecteur" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ajouter un secteur</h4>
            </div>
            <div class="modal-body">
                <div class="controls col-md-12 col-centered">
                    <input id="secteur" type="text" placeholder="Écrire le secteur ici!" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="Creer_secteur">Créer le secteur</button>
            </div>
        </div>
    </div>
</div>

<script>

    $(function(){
        $('#Creer_secteur').on('click', function(e){
            e.preventDefault();
            var secteur = $('#secteur').val();
            $('select[name="secteur[]"]').append('<option value="'+secteur+'">'+secteur+'</option>');
            $('.chosen-select[name="secteur[]"]').trigger("chosen:updated");
            $('#ModalSecteur').modal('hide');
        });
    });

</script>