<div class="container">
    <br/>
    <div class="row">
        <?php echo form_open('comptes/creer_compte/'.$societe->id); ?>
        <fieldset>

            <!-- Form Name -->
            <legend>Créer un compte pour la société <?php echo $societe->nom; ?></legend>

            <!-- Switcher input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 col-md-offset-1 control-label" for="numero">Type du compte :</label>  
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
                <label class="col-md-3 col-md-offset-1 control-label" for="banque">Banque :</label>  
                <div class="col-md-6">
                    <input id="type" name="type" placeholder="" class="form-control input-md" value="courant" type="text">
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 col-md-offset-1 control-label" for="banque">Banque :</label>  
                <div class="col-md-6">
                    <input id="nom" name="banque" placeholder="LCL" class="form-control input-md" required="" value="<?php echo set_value('banque'); ?>" type="text">
                    <?php echo form_error('banque'); ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 col-md-offset-1 control-label" for="numero">Numéro du compte :</label>  
                <div class="col-md-6">
                    <input id="nom" name="numero" placeholder="1651615156161" class="form-control input-md" required="" value="<?php echo set_value('numero'); ?>" type="text">
                    <?php echo form_error('numero'); ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 col-md-offset-1 control-label" for="montant">Montant actuel du compte :</label>  
                <div class="col-md-6">
                    <input id="nom" name="montant" placeholder="10006.52" class="form-control input-md" required="" value="<?php echo set_value('montant'); ?>" type="text">
                    <?php echo form_error('montant'); ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 col-md-offset-1 control-label" for="decouvert">Découvert autorisé : </label>
                <div class="col-md-6">
                    <input id="decouvert" name="decouvert" type="text" placeholder="10000" class="form-control input-md" value="<?php echo set_value('decouvert'); ?>">
                    <p class="help-block">Mettre un chiffre positif!</p>
                    <?php echo form_error('decouvert'); ?>
                </div>
            </div>
            
            <!-- Button -->
            <div class="form-group paddingTop">
              <div class="col-md-offset-2 col-md-8">
                  <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Annuler"/>
                <input type="submit" class="btn btn-success pull-right" value="Créer"/>
              </div>
            </div>

        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>