<div class="detail-marche container">
    <br/>
    <?php echo form_open('facturation/creer/'); ?>
    <fieldset>
        <legend>
            Créer une facture
        </legend>
        <div class="form-facture row-centered" style="margin:0;">
            <h3>Entreprise : </h3>
            <!-- TypeAhead input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Entreprise *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <select data-placeholder="Choisissez une entreprise" name="entreprise" id="select-entreprise" class="chosen-select" style="width:100%;" tabindex="4">
                        <?php foreach ($entreprises as $entreprise) { ?>
                            <option value="<?php echo $entreprise->id; ?>"><?php echo $entreprise->nom . ' ' . $entreprise->ville; ?></option>
                        <?php } ?>
                    </select>
                    <?php echo form_error('entreprise'); ?>
                </div>
            </div>
            <h3>Projet : </h3>
            <!-- TypeAhead input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Projet *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <select data-placeholder="Choisissez un projet" name="projet" id="select-entreprise" class="chosen-select" style="width:100%;" tabindex="4">
                        <option value='0'>Aucun projet</option>
                        <?php foreach ($projets as $projet) { ?>
                            <option value="<?php echo $projet->id; ?>" <?php if(set_value('projet') == $projet->id){echo "selected";} ?>><?php echo $projet->nom . ' ' . $projet->ville; ?></option>
                        <?php } ?>
                    </select>
                    <?php echo form_error('projet'); ?>
                </div>
            </div>
            <h3>Général : </h3>
            <!-- Number input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Objet *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="objet" type="text" value="<?php echo set_value('objet'); ?>" class="form-control">
                    <?php echo form_error('objet'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Date *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="date" placeholder="DD-MM-YYYY" type="text" value="<?php echo set_value('date'); ?>" class="form-control">
                    <?php echo form_error('date')." Le format est DD-MM-YYYY"; ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Date échéance *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="date_echeance" placeholder="DD-MM-YYYY" type="text" value="<?php echo set_value('date_echeance'); ?>" class="form-control">
                    <?php echo form_error('date_echeance')." Le format est DD-MM-YYYY"; ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Numero *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="numero" type="text" value="<?php echo set_value('numero'); ?>" class="form-control">
                    <?php echo form_error('numero'); ?>
                </div>
            </div>
            <h3>Montant : </h3>
            <!-- Number input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Montant HT *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="montantHT" type="number" value="<?php echo set_value('montantHT'); ?>" class="form-control">
                    <?php echo form_error('montantHT'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">TVA *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="tva" type="number" value="<?php echo set_value('tva'); ?>" class="form-control">
                    <?php echo form_error('tva'); ?>
                </div>
            </div>
            <h3>Options : </h3>
            <!-- Number input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="rg"></label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered checkbox">
                    <input id="type" name='bootstrapswitch-rg' type="checkbox" data-label-text="RG de 5%" data-off-text="Non" data-on-text="Oui">
                </div>
            </div>
            <input id="rg" name='rg' value="" type="hidden">
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Avoir</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="avoir" type="number" value="<?php echo set_value('avoir'); ?>" class="form-control">
                    <?php echo form_error('avoir'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Créer le réglement automatique?</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input type="checkbox" class="form-control" name="reglement_effectue"/>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Société</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <select class="form-control" name="societe" id="societeliste">
                        <?php foreach ($societes as $societe) { ?>
                            <option value="<?php echo $societe->id; ?>"><?php echo $societe->nom; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Compte</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <select class="form-control" name="compte">
                        <?php foreach ($comptes as $compte) { ?>
                            <option value="<?php echo $compte->id; ?>"><?php echo $compte->banque . " | " . $compte->numero; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-xs-12">
                <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
                <input type="submit" class="btn btn-info pull-right" id="form_contact" value="Créer"/>
            </div>                    
    </fieldset>
    <?php echo form_close(); ?>
</div>

<script>
    $(function () {
<?php if (set_value('rg') == "true") { ?>
            $('[name=bootstrapswitch-rg]').bootstrapSwitch('state', true);
            $('#rg').val("true");
<?php } else { ?>
            $('[name=bootstrapswitch-rg]').bootstrapSwitch('state', false);
            $('#rg').val("false");
<?php } ?>
    });
</script>


