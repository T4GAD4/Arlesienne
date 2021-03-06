<div class="container">
    <br/>
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
    </div>
    <div class="row">
        <?php echo form_open_multipart(base_url('vente/modifier/' . $vente->id)); ?>
        <legend>Modifier une vente</legend>

        <div class="control-group col-md-offset-3">
            <label class="control-label col-sm-2 col-centered" for="">Client(s) :</label>
            <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                <select multiple name='clients[]' id="secteur_chosen" class='chosen-select'>
                    <option value=""></option>
                    <?php foreach ($clients as $client) { ?>
                        <option value="<?= $client->id; ?>" <?php if (in_array($client->id, (Array) $vente_clients)) {
                        echo 'selected';
                    } ?>><?= strtoupper($client->nom) . ' ' . ucfirst($client->prenom); ?></option>
<?php } ?>
                </select><a data-toggle='modal' data-target='#creerContact' class='pull-right' style='font-size:20px;margin-right:-30px;'><i class='fa fa-plus-circle'></i></a>
            </div>
        </div>
        <div class="control-group col-md-offset-3">
            <label class="control-label col-sm-2 col-centered" for="">Apporteur(s) :</label>
            <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                <select multiple name='apporteurs[]' id="secteur_chosen" class='chosen-select'>
                    <option value=""></option>
                    <?php foreach ($clients as $client) { ?>
                        <option value="<?= $client->id; ?>" <?php if (in_array($client->id, (Array) explode(',', $vente->apporteur))) {
                        echo 'selected';
                    } ?>><?= strtoupper($client->nom) . ' ' . ucfirst($client->prenom); ?></option>
<?php } ?>
                </select><a data-toggle='modal' data-target='#creerContact' class='pull-right' style='font-size:20px;margin-right:-30px;'><i class='fa fa-plus-circle'></i></a>
            </div>
        </div>
        <div class="control-group col-md-offset-3">
            <label class="control-label col-sm-2 col-centered" for="">Notaire vendeur</label>
            <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                <select multiple name='notaire_vendeur[]' id="secteur_chosen" class='chosen-select'>
                    <option value=""></option>
<?php foreach ($clients as $client) { ?>
                        <option value="<?= $client->id; ?>" <?php if (in_array($client->id, (Array) explode(',', $vente->notaire_vendeur))) {
        echo 'selected';
    } ?>><?= strtoupper($client->nom) . ' ' . ucfirst($client->prenom); ?></option>
<?php } ?>
                </select><a data-toggle='modal' data-target='#creerContact' class='pull-right' style='font-size:20px;margin-right:-30px;'><i class='fa fa-plus-circle'></i></a>
            </div>
        </div>
        <div class="control-group col-md-offset-3">
            <label class="control-label col-sm-2 col-centered" for="">Notaire acquéreur</label>
            <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                <select multiple name='notaire_acquereur[]' id="secteur_chosen" class='chosen-select'>
                    <option value=""></option>
<?php foreach ($clients as $client) { ?>
                        <option value="<?= $client->id; ?>" <?php if (in_array($client->id, (Array) explode(',', $vente->notaire_acquereur))) {
        echo 'selected';
    } ?>><?= strtoupper($client->nom) . ' ' . ucfirst($client->prenom); ?></option>
<?php } ?>
                </select><a data-toggle='modal' data-target='#creerContact' class='pull-right' style='font-size:20px;margin-right:-30px;'><i class='fa fa-plus-circle'></i></a>
            </div>
        </div>
        <br/>
        <div class="control-group col-md-offset-3">
            <label class="control-label col-sm-2 col-centered" for="">Lot(s) : </label>
            <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                <select multiple name='lots[]' id="secteur_chosen" class='chosen-select'>
                    <option value=""></option>
        <?php foreach ($lots as $lot) { ?>
                        <option value="<?= $lot->id; ?>" <?php if (in_array($lot->id, (Array) $vente_lots)) {
            echo 'selected';
        } ?>>Lot n°<?= $lot->numero_lot; ?></option>
<?php } ?>
                </select>
            </div>
        </div>

        <input class="btn btn-warning pull-right" type="submit" value="Modifier" />
<?= form_close(); ?>

    </div>
</div>


<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="creerContact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Créer un utilisateur</h4>
            </div>
            <div class="modal-body">
                <div class="row-centered" style="margin:0;">
                    <form>
                        <div class="control-group">
                            <label class="control-label col-md-3 col-centered" for="civilite">Civilité</label>
                            <div class="controls col-md-9 col-centered ">
                                <select id="civilite" name="civilite" class="form-control">
<?php
foreach ($select_contacts as $select) {
    ?>
                                        <option value='<?php echo $select; ?>'><?php echo $select; ?></option>
                                    <?php
                                }
                                ?>
                                </select>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label col-md-3 col-centered" for="nom">Nom</label>
                            <div class="controls col-md-9 col-centered">
                                <input id="nom" name="nom" type="text" placeholder="" class="form-control" value="<?php echo set_value('nom'); ?>" required>
<?php echo form_error('nom'); ?>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label col-md-3 col-centered" for="prenom">Prénom</label>
                            <div class="controls col-md-9 col-centered">
                                <input id="prenom" name="prenom" type="text" placeholder="" value="<?php echo set_value('prenom'); ?>" class="form-control">
<?php echo form_error('prenom'); ?>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label col-md-3 col-centered" for="adresse">Adresse</label>
                            <div class="controls col-md-9 col-centered">
                                <input id="adresse" name="adresse" type="text" placeholder="" value="<?php echo set_value('adresse'); ?>" class="form-control">
<?php echo form_error('adresse'); ?>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label col-md-3 col-centered" for="codepostal">Code postal</label>
                            <div class="controls col-md-9 col-centered">
                                <input id="codepostal" name="codepostal" type="text" placeholder="" value="<?php echo set_value('codepostal'); ?>" class="form-control">
<?php echo form_error('codepostal'); ?>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label col-md-3 col-centered" for="ville">Ville</label>
                            <div class="controls col-md-9 col-centered">
                                <input id="ville" name="ville" type="text" placeholder="" value="<?php echo set_value('ville'); ?>" class="form-control">
<?php echo form_error('ville'); ?>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label col-md-3 col-centered" for="fixe">Fixe</label>
                            <div class="controls col-md-9 col-centered">
                                <input id="fixe" name="fixe" type="text" placeholder="" value="<?php echo set_value('fixe'); ?>" class="form-control">
<?php echo form_error('fixe'); ?>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label col-md-3 col-centered" for="portable">Portable</label>
                            <div class="controls col-md-9 col-centered">
                                <input id="portable" name="portable" type="text" placeholder="" value="<?php echo set_value('portable'); ?>" class="form-control">
<?php echo form_error('portable'); ?>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label col-md-3 col-centered" for="email">Email</label>
                            <div class="controls col-md-9 col-centered">
                                <input id="email" name="email" type="text" placeholder="" value="<?php echo set_value('email'); ?>" class="form-control">
<?php echo form_error('email'); ?>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="col-xs-12">
                        <input type="button" class="btn btn-warning pull-left" data-dismiss="modal" aria-label="Close" value="Annuler"/>
                        <input type="button" class="btn btn-success pull-right" id="form_contact" value="Enregistrer"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function () {
            $('#form_contact').click(function () {
                var data = {};
                data.civilite = $('[name=civilite]').val();
                data.nom = $('[name=nom]').val();
                data.prenom = $('[name=prenom]').val();
                data.adresse = $('[name=adresse]').val();
                data.cp = $('[name=codepostal]').val();
                data.ville = $('[name=ville]').val();
                data.fixe = $('[name=fixe]').val();
                data.portable = $('[name=portable]').val();
                data.email = $('[name=email]').val();

                if (data.nom == "") {
                    alert('Le nom doit être rempli!');
                } else if (data.prenom == "") {
                    alert('Le prénom doit être rempli!');
                } else {
                    $.post("/AJAX/contact/creer", {data: data})
                            .success(function (result) {
                                var id = JSON.parse(result).result.id;
                                $('select[name="clients[]"]').append('<option value="' + id + '">' + data.nom + ' ' + data.prenom + '</option>');
                                $('.chosen-select[name="clients[]"]').trigger("chosen:updated");
                                $('select[name="apporteurs[]"]').append('<option value="' + id + '">' + data.nom + ' ' + data.prenom + '</option>');
                                $('.chosen-select[name="apporteurs[]"]').trigger("chosen:updated");
                                $('select[name="notaire_vendeur[]"]').append('<option value="' + id + '">' + data.nom + ' ' + data.prenom + '</option>');
                                $('.chosen-select[name="notaire_vendeur[]"]').trigger("chosen:updated");
                                $('select[name="notaire_acquereur[]"]').append('<option value="' + id + '">' + data.nom + ' ' + data.prenom + '</option>');
                                $('.chosen-select[name="notaire_acquereur[]"]').trigger("chosen:updated");
                                $('#creerContact').modal('hide');
                            });
                }
            });
        });
    </script>
