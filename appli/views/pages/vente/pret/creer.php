<div class="container">
    <br/>
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
    </div>
    <div class="row">
        <?php echo form_open(base_url('vente/pret/' . $vente->id)); ?>

        <fieldset>
            <legend>Créer un financement</legend>
            <!-- Date input-->
            <div class="form-group paddingTop">
                <label class="col-md-2 control-label col-md-offset-2" for="date_compromis">Date de signature compromis :</label> 
                <div class='col-md-6 input-group date' id='datetimepicker'>
                    <input type='text' name="date_compromis" value="<?php echo set_value('date_compromis', Date('Y-m-d')); ?>" class="input-md form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar">
                        </span>
                    </span>
                    <?php echo form_error('date_compromis'); ?>
                </div>
            </div>
            <br/>
            <br/>
            <div class="control-group">
                <label class="control-label col-md-4 col-centered" for="delai">Délai offre de prêt :</label>  
                <div class="controls col-xs-12 col-sm-8 col-md-5 col-centered" style='text-align:center;'>
                    <input class="form-control" type="text" value="<?= set_value('delai'); ?>" name="delai"/>
                    <?php echo form_error('delai'); ?>
                    </div>
            </div>
            <br/>
            <div class="control-group col-md-offset-3 center">
                <div class="col-md-7">
                    <p style="color:white;">Soit date butoir le : <span id="date_butoir"></span></p>
                </div>
            </div>
            <br/>
            <br/>
            <!-- Date input-->
            <div class="form-group paddingTop">
                <label class="col-md-2 control-label col-md-offset-2" for="date_obtention">Date d'obtention :</label> 
                <div class='col-md-6 input-group date' id='datetimepicker1'>
                    <input type='text' name="date_obtention" value="<?php echo set_value('date_obtention', Date('Y-m-d')); ?>" class="input-md form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar">
                        </span>
                    </span>
                    <?php echo form_error('date_obtention'); ?>
                </div>
            </div>
            <br/>
            <br/>                
            <div class="control-group ">
                <label class="control-label col-md-4 col-centered" for="">Banque :</label>
                <div class="controls col-xs-12 col-sm-8 col-md-5 col-centered">
                    <select name='banque' id="banque" class='chosen-select'>
                        <option value=""></option>
                        <?php foreach ($entreprises as $entreprise) { ?>
                            <option value="<?= $entreprise->id; ?>" <?php if(in_array($entreprise->id,(Array)set_value('banque'))){echo 'selected';} ?>><?= strtoupper($entreprise->nom); ?></option>
                        <?php } ?>
                    </select><a data-toggle='modal' data-target='#creerEntreprise' class='pull-right' style='font-size:20px;margin-right:-30px;'><i class='fa fa-plus-circle'></i></a>
                    <?php echo form_error('banque'); ?>
                </div>
            </div>

            <input class="btn btn-primary pull-right" type="submit" value="Envoyer" />
            <?= form_close(); ?>

    </div>
</div>

<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="creerEntreprise" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Créer un utilisateur</h4>
            </div>
            <div class="modal-body">
                <div class="row-centered" style="margin:0;">
                    <h3 class='hr'>Créer une entreprise</h3>
                    <br/>
                    <form>
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
                            <label class="control-label col-md-3 col-centered" for="siret">Siret</label>
                            <div class="controls col-md-9 col-centered">
                                <input id="siret" name="siret" type="text" placeholder="" value="<?php echo set_value('siret'); ?>" class="form-control">
<?php echo form_error('siret'); ?>
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
                            <label class="control-label col-md-3 col-centered" for="adresse2">Adresse 2</label>
                            <div class="controls col-md-9 col-centered">
                                <input id="adresse2" name="adresse2" type="text" placeholder="" value="<?php echo set_value('adresse2'); ?>" class="form-control">
<?php echo form_error('adresse2'); ?>
                            </div>
                        </div>
                        <!-- Text input-->
                        <div class="control-group">
                            <label class="control-label col-md-3 col-centered" for="adresse3">Adresse 3</label>
                            <div class="controls col-md-9 col-centered">
                                <input id="adresse3" name="adresse3" type="text" placeholder="" value="<?php echo set_value('adresse3'); ?>" class="form-control">
<?php echo form_error('adresse3'); ?>
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
                            <label class="control-label col-md-3 col-centered" for="fixe">Tel</label>
                            <div class="controls col-md-9 col-centered">
                                <input id="fixe" name="fixe" type="text" placeholder="" value="<?php echo set_value('fixe'); ?>" class="form-control">
<?php echo form_error('fixe'); ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label col-sm-3 col-centered" for="metier">Métier(s) :</label>
                            <div class="controls col-md-9 col-centered">
                                <select multiple name='metiers[]' id="metier" class='chosen-select'>
                                    <option value=""></option>
                                    <?php foreach ($metiers as $key => $value) { ?>
                                        <option value="<?= $value; ?>" <?php if(in_array($value,(Array)set_value('metier'))){echo 'selected';} ?>><?= strtoupper($value); ?></option>
                                    <?php } ?>
                                </select><a data-toggle='modal' data-target='#corpsMetier' class='pull-right' style='font-size:20px;margin-right:-30px;'><i class='fa fa-plus-circle'></i></a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="col-xs-12">
                        <input type="button" class="btn btn-warning pull-left" data-dismiss="modal" aria-label="Close" value="Annuler"/>
                        <input type="button" class="btn btn-success pull-right" id="form_entreprise" value="Créer"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>   

<!-- Modal Secteur -->
<div class="modal fade" id="corpsMetier" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ajouter un métier</h4>
            </div>
            <div class="modal-body">
                <div class="controls col-md-12 col-centered">
                    <input id="addmetier" type="text" placeholder="Écrire le métier ici!" class="form-control">
                </div>
                <br/>
                <br/>
                <br/>
                <button type="button" class="btn btn-primary" id="ajouter_metier">Ajouter le métier</button>
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
    $('[name=date_compromis]').on('change', function(){
        delai = parseInt($('[name=delai]').val());
        if(isNaN(delai)){
            delai = 0;
        }
        var date = new Date($(this).val());
        date.setTime(date.getTime() + ((delai) * 86400000));
        date = date.getFullYear()+'-'+("0" + (date.getMonth() + 1)).slice(-2)+'-'+("0" + date.getDate()).slice(-2);
        $('#date_butoir').html(date);
    });
    $('[name=delai]').on('change', function(){
        var delai = $(this).val();
        if(isNaN(delai)){
            delai = 0;
        }
        var date = new Date($('[name=date_compromis]').val());
        date.setTime(date.getTime() + ((delai) * 86400000));
        date = date.getFullYear()+'-'+("0" + (date.getMonth() + 1)).slice(-2)+'-'+("0" + date.getDate()).slice(-2);
        $('#date_butoir').html(date);
    });
    
    //Envoi du modal entreprise
    $('#form_entreprise').click(function () {
            var data = {};
            data.nom = $('[name=nom]').val();
            data.siret = $('[name=siret]').val();
            data.adresse1 = $('[name=adresse]').val();
            data.adresse2 = $('[name=adresse2]').val();
            data.adresse3 = $('[name=adresse3]').val();
            data.cp = $('[name=codepostal]').val();
            data.ville = $('[name=ville]').val();
            data.tel = $('[name=fixe]').val();
            data.corps_metier = $('#metier').val().join(';');

            if (data.nom == "") {
                alert('Le nom doit être rempli!');
            } else if (data.corps_metier == "") {
                alert('Le prénom doit être rempli!');
            } else {
                $.post("/AJAX/entreprise/creer", {data: data})
                        .success(function (result) {
                            var id = JSON.parse(result).result.id;
                            $('select[name="banque"]').append('<option value="' + id + '">' + data.nom + '</option>');
                            $('.chosen-select[name="banque"]').trigger("chosen:updated");
                            $('#creerEntreprise').modal('hide');
                        }).error(function(){
                            alert('ERREUR! L\'entreprise que vous avez créée existe peut-être déjà!');
                        });
            }
        });
    
    $('#ajouter_metier').on('click', function(e){
            e.preventDefault();
            var metier = $('#addmetier').val();
            $('select[name="metiers[]"]').append('<option value="'+metier+'">'+metier+'</option>');
            $('.chosen-select[name="metiers[]"]').trigger("chosen:updated");
            $('#corpsMetier').modal('hide');
        });
    
});
</script>
