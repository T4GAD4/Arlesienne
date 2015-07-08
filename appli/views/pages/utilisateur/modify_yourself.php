<div class="container">
    <br/>
    <div class="row">
        <?php echo form_open('utilisateur/modifier/'.$utilisateur->id); ?>
        <fieldset>

            <!-- Form Name -->
            <legend>Modifier l'utilisateur <?php echo $utilisateur->nom .' '. $utilisateur->prenom; ?></legend>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 control-label col-md-offset-1" for="nom">Nom :</label>  
                <div class="col-md-6">
                    <input id="nom" name="nom" placeholder="Nom utilisateur" class="form-control input-md" required="" value="<?php echo $utilisateur->nom; ?>" type="text">
                    <?php echo form_error('nom'); ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 control-label col-md-offset-1" for="prenom">Prénom :</label>  
                <div class="col-md-6">
                    <input id="prenom" name="prenom" placeholder="prenom utilisateur" class="form-control input-md" value="<?php echo $utilisateur->prenom; ?>" type="text">
                    <?php echo form_error('prenom'); ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 control-label col-md-offset-1" for="mail">Email :</label>  
                <div class="col-md-6">
                    <input id="mail" name="mail" placeholder="Email utilisateur" class="form-control input-md" value="<?php echo $utilisateur->mail; ?>" type="text">
                    <?php echo form_error('mail'); ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 control-label col-md-offset-1" for="pseudo">Pseudo :</label>  
                <div class="col-md-6">
                    <input id="pseudo" name="pseudo" placeholder="Pseudo utilisateur" class="form-control input-md" value="<?php echo $utilisateur->pseudo; ?>" type="text">
                    <?php echo form_error('pseudo'); ?>
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