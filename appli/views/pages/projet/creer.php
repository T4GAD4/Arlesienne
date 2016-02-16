<div class="container">
    <br/>
    <?php echo form_open('projet/ajouter/'); ?>
    <fieldset>
        <legend>
            Créer un projet : 
        </legend>
        <div class="row-centered" style="margin:0;">
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="nom">Nom *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="nom" name="nom" type="text" placeholder="" class="form-control" value="<?php echo set_value('nom'); ?>" required>
                    <?php echo form_error('nom'); ?>
                </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-2 col-centered" for="">Secteur : <a href="#" data-toggle="modal" data-target="#ModalSecteur"><i class="fa fa-plus"></i></a></label>
                    <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                        <select multiple name='secteur[]' id="secteur_chosen" class='chosen-select'>
                            <option value=""></option>
                            <?php foreach($secteurs as $key => $value){ ?>
                                <option value="<?= $value; ?>"><?= $value; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Number input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Budget *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="budget" type="number" value="<?php echo set_value('budget'); ?>" class="form-control">
                    <?php echo form_error('budget'); ?>
                </div>
            </div>
            <!-- Select input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="etat">Etat *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered ">
                    <select id="etat" name="etat" class="form-control">
                        <?php
                        foreach ($select_etat as $etat) {
                            ?>
                            <option value="<?php echo $etat; ?>" <?php
                            if (set_value('etat') == $etat) {
                                echo 'selected';
                            }
                            ?>><?php echo $etat; ?></option>
                                    <?php
                                }
                                ?>
                    </select>
                </div>
            </div>
            <!-- Select input -->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="societe">Société *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered ">
                    <select id="societeliste" name="societe" class="form-control">
                        <option>Selectionner un projet</option>
                        <?php
                        foreach ($societes as $societe) {
                            ?>
                            <option value="<?php echo $societe->id; ?>" <?php
                            if (set_value('societe') == $societe->id) {
                                echo 'selected';
                            }
                            ?>><?php echo $societe->nom; ?></option>
                                    <?php
                                }
                                ?>
                    </select>
                </div>
            </div>
            <!-- Select input societe -->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="compte">Compte *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered ">
                    <select id="compte" name="compte" class="form-control">

                    </select>
                </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="adresse">Adresse *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="adresse" name="adresse" type="text" placeholder="" value="<?php echo set_value('adresse'); ?>" class="form-control">
                    <?php echo form_error('adresse'); ?>
                </div>
            </div>        
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="codepostal">Code postal *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="codepostal" name="codepostal" type="number" placeholder="" value="<?php echo set_value('codepostal'); ?>" class="form-control">
                    <?php echo form_error('codepostal'); ?>
                </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="ville">Ville *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="ville" name="ville" type="text" placeholder="" value="<?php echo set_value('ville'); ?>" class="form-control">
                    <?php echo form_error('ville'); ?>
                </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="commentaire">Commentaire</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">                     
                    <textarea class="col-xs-12" id="commentaire" name="commentaire"></textarea>
                    <?php echo form_error('commentaire'); ?>
                </div>
            </div>
        </div>
</div>
</div>
</div>

<div class="col-xs-12" style="margin-top:20px;">
    <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Annuler"/>
    <input type="submit" class="btn btn-success pull-right" id="form_contact" value="Créer"/>
</div>                    
</fieldset>
<?php echo form_close(); ?>
<span id="page" class="hidden">Creer</span>
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