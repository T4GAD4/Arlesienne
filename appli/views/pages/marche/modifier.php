<div class="detail-marche container">
    <br/>
    <?php echo form_open('marche/modifier/'.$marche->id); ?>
    <fieldset>
        <legend>
            <?php echo $marche->nom;?>
        </legend>
        <div class="row-centered" style="margin:0;">
            <!-- Number input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Montant HT *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" onblur="reloadTTC()" name="montant" type="number" value="<?php echo floatval($marche->montantHT); ?>" class="form-control">
                    <?php echo form_error('montant'); ?>
                </div>
            </div>
            <!-- Number input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">TVA *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" onblur="reloadTTC()" name="tva" step="5" type="number" value="<?php echo floatval($marche->TVA); ?>" class="form-control">
                    <?php echo form_error('tva'); ?>
                </div>
            </div>
            <!-- Number input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">TTC</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <p style="color:white;"><span id="ttc_total"><?= format_number(calc_tva(floatval($marche->montantHT),floatval($marche->TVA))); ?></span>&nbsp;€</p>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="devisé">Devisé *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered checkbox">
                    <input id="type" name='bootstrapswitch-devise' type="checkbox" data-label-text="Devisé" data-off-text="Non" data-on-text="Oui">
                </div>
            </div>
            <input id="devise" name='devise' type="hidden">
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="adresse">Caution *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="adresse" name="caution" type="text" placeholder="" value="<?php echo floatval($marche->caution); ?>" class="form-control">
                    <?php echo form_error('caution'); ?>
                </div>
            </div>   
            <!--<h4>Ceci est juste pour classer et retrouver plus facilement les marchés.</h4>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="liste">Programme(s) concernés par ce marché</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered checkbox">
                    <?php
                    foreach($programmes as $programme){
                        $x = "";
                        if (in_array($programme->nom, $marche->programmes)){
                            $x = "checked";
                        }
                    ?>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="liste[]" value="<?php echo $programme->idProgramme; ?>" <?php echo $x; ?>> <?php echo ucfirst($programme->nom); ?>
                        </label>
                    </div>
                    <?php
                    }
                    ?>
                    <?php echo form_error('liste'); ?>
                </div>
            </div>
            -->
            <div class="col-xs-12">
                <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
                <input type="submit" class="btn btn-info pull-right" id="form_contact" value="Modifier"/>
            </div>                    
    </fieldset>
    <?php echo form_close(); ?>
    <span id="page" class="hidden">Modifier</span>
</div>
</div>
<script>
    $(function(){
        <?php if($marche->devise == "true"){?>
            $('[name=bootstrapswitch-devise]').bootstrapSwitch('state', true);
            $('#devise').val("true");
        <?php }else{ ?>
            $('[name=bootstrapswitch-devise]').bootstrapSwitch('state', false);
            $('#devise').val("false");
        <?php } ?>
    });  
    
</script>

