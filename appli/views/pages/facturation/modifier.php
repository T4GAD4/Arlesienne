<div class="detail-marche container">
    <br/>
    <?php echo form_open('facturation/details/'.$facture->id); ?>
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
                        <?php foreach($entreprises as $entreprise){?>
                            <option value="<?php echo $entreprise->id; ?>" <?php if($entreprise->id == intval($facture->idEntreprise)){ echo 'selected'; }?>><?php echo $entreprise->nom.' '. $entreprise->ville; ?></option>
                        <?php } ?>
                    </select>
                    <?php echo form_error('entreprise'); ?>
                </div>
            </div>
            <h3>Général : </h3>
            <!-- Number input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Objet *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="objet" type="text" value="<?php echo $facture->objet ?>" class="form-control">
                    <?php echo form_error('objet'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Date *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="date" placeholder="DD-MM-YYYY" type="text" value="<?php echo $facture->dateFacture ?>" class="form-control">
                        <?php echo form_error('date'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Date échéance *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="date_echeance" placeholder="DD-MM-YYYY" type="text" value="<?php echo $facture->dateEcheance ?>" class="form-control">
                        <?php echo form_error('date_echeance'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Numero *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="numero" type="text" value="<?php echo $facture->numFacture ?>" class="form-control">
                        <?php echo form_error('numero'); ?>
                </div>
            </div>
            <h3>Montant : </h3>
            <!-- Number input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Montant HT *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="montantHT" type="number" value="<?php echo $facture->montantHT ?>" class="form-control">
                        <?php echo form_error('montantHT'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">TVA *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="tva" type="number" value="<?php echo $facture->tva ?>" class="form-control">
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
                    <input id="budget" name="avoir" type="number" value="<?php echo $facture->avoir ?>" class="form-control">
                        <?php echo form_error('avoir'); ?>
                </div>
            </div>
            
            <div class="col-xs-12">
                <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
                <input type="submit" class="btn btn-info pull-right" id="form_contact" value="Modifier"/>
            </div>                    
    </fieldset>
    <?php echo form_close(); ?>
</div>
        
<script>
    $(function(){
        <?php if($facture->rg == "true"){?>
            $('[name=bootstrapswitch-rg]').bootstrapSwitch('state', true);
            $('#rg').val("true");
        <?php }else{ ?>
            $('[name=bootstrapswitch-rg]').bootstrapSwitch('state', false);
            $('#rg').val("false");
        <?php } ?>
    });    
</script>


