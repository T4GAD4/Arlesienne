<div class="container">
    <br/>
    <div class="row">
        <?php echo form_open('societe/ajouter'); ?>
        <fieldset>

            <!-- Form Name -->
            <legend>Créer une société</legend>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-2 control-label col-md-offset-2" for="nom">Nom :</label>  
                <div class="col-md-6">
                    <input id="nom" name="nom" placeholder="Nom société" class="form-control input-md" required="" value="<?php echo set_value('nom'); ?>" type="text">
                    <?php echo form_error('nom'); ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-2 control-label col-md-offset-2" for="siret">Siret :</label>  
                <div class="col-md-6">
                    <input id="siret" name="siret" placeholder="Siret société" class="form-control input-md" value="<?php echo set_value('siret'); ?>" type="text">
                    <?php echo form_error('siret'); ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-2 control-label col-md-offset-2" for="gerant">Gérant :</label>  
                <div class="col-md-6">
                    <input id="gerant" name="gerant" placeholder="Gérant société" class="form-control input-md" value="<?php echo set_value('gerant'); ?>" type="text">
                    <?php echo form_error('gerant'); ?>
                </div>
            </div>

            <!-- Date input-->
            <div class="form-group paddingTop">
                <label class="col-md-2 control-label col-md-offset-2" for="date_creation">Date de création :</label> 
                <div class='col-md-6 input-group date' id='datetimepicker'>
                    <input type='text' name="date_creation" value="<?php echo set_value('date_creation', Date('Y-m-d')); ?>" class="input-md form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"> 
                        </span>
                    </span>
                    <?php echo form_error('date_creation'); ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-2 control-label col-md-offset-2" for="regime_imposition">Régime d'imposition :</label>  
                <div class="col-md-6">
                    <input id="regime_imposition" name="regime_imposition" placeholder="Régime d'imposition société" class="form-control input-md" value="<?php echo set_value('regime_imposition'); ?>" type="text">
                    <?php echo form_error('regime_imposition'); ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-2 control-label col-md-offset-2" for="adresse">Adresse :</label>  
                <div class="col-md-6">
                    <input id="adresse" name="adresse" placeholder="Adresse société" class="form-control input-md" value="<?php echo set_value('adresse'); ?>" type="text">
                    <?php echo form_error('adresse'); ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-2 control-label col-md-offset-2" for="cp">Code Postal :</label>  
                <div class="col-md-6">
                    <input id="cp" name="cp" placeholder="Code postal société" class="form-control input-md" value="<?php echo set_value('cp'); ?>" type="text">
                    <?php echo form_error('cp'); ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-2 control-label col-md-offset-2" for="ville">Ville :</label>  
                <div class="col-md-6">
                    <input id="ville" name="ville" placeholder="Ville société" class="form-control input-md" value="<?php echo set_value('ville'); ?>" type="text">
                    <?php echo form_error('ville'); ?>
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