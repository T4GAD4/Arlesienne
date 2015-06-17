<div class="container">
    <br/>
    <div class="row">
        <?php echo form_open('comptes/modifier/'.$compte->id); ?>
        <fieldset>

            <!-- Form Name -->
            <legend>Modifier le compte numéro <?php echo $compte->numero; ?></legend>

            <!-- Switcher input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 control-label col-md-offset-1" for="numero">Type du compte :</label>  
                <div class="col-md-6">
                    <div class="col-sm-6 col-lg-4">
                        <p>
                            <input id="type" name='switcher' type="checkbox" data-label-text="Type de compte" data-off-text="Courant" data-on-text="Promoteur">
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Text input-->
            <div class="form-group paddingTop hidden">
                <label class="col-md-3 control-label col-md-offset-1" for="banque">Banque :</label>  
                <div class="col-md-6">
                    <input id="type" name="type" placeholder="" class="form-control input-md" value="<?php echo $compte->type ?>" type="text">
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 control-label col-md-offset-1" for="banque">Banque :</label>  
                <div class="col-md-6">
                    <input id="nom" name="banque" placeholder="LCL" class="form-control input-md" required="" value="<?php echo $compte->banque ?>" type="text">
                    <?php echo form_error('banque'); ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 control-label col-md-offset-1" for="numero">Numéro du compte :</label>  
                <div class="col-md-6">
                    <input id="nom" name="numero" placeholder="1651615156161" class="form-control input-md" required="" value="<?php echo $compte->numero; ?>" type="text">
                    <?php echo form_error('numero'); ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 control-label col-md-offset-1" for="montant">Montant actuel du compte :</label>  
                <div class="col-md-6">
                    <input id="nom" name="montant" placeholder="10006.52" class="form-control input-md" required="" value="<?php echo $compte->montant; ?>" type="text">
                    <?php echo form_error('montant'); ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 control-label col-md-offset-1" for="decouvert">Découvert autorisé : </label>
                <div class="col-md-6">
                    <input id="decouvert" name="decouvert" type="text" placeholder="10000" class="form-control input-md" value="<?php echo $compte->decouvert; ?>">
                    <p class="help-block">Mettre un chiffre positif!</p>
                    <?php echo form_error('decouvert'); ?>
                </div>
            </div>
            
            <!-- Button -->
            <div class="form-group paddingTop">
              <div class="col-md-offset-2 col-md-8">
                  <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Annuler"/>
                <input type="submit" class="btn btn-warning pull-right" value="Modifier"/>
              </div>
            </div>

        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    $(document).ready(function(){
        <?php if($compte->type == "promoteur"){?>
        $('[name="switcher"]').bootstrapSwitch('state', true);
        <?php }else{ ?>
        $('[name="switcher"]').bootstrapSwitch('state', false);
        <?php } ?>
    });
</script>