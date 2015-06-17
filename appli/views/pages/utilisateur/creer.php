<div class="container">
    <br/>
    <div class="row">
        <?php echo form_open('utilisateur/ajouter/'); ?>
        <fieldset>

            <!-- Form Name -->
            <legend>Créer un utilisateur</legend>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 control-label col-md-offset-1" for="nom">Nom :</label>  
                <div class="col-md-6">
                    <input id="nom" name="nom" placeholder="Nom utilisateur" class="form-control input-md" required="" value="<?php echo set_value('nom'); ?>" type="text">
                    <?php echo form_error('nom'); ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 control-label col-md-offset-1" for="prenom">Prénom :</label>  
                <div class="col-md-6">
                    <input id="prenom" name="prenom" placeholder="prenom utilisateur" class="form-control input-md" value="<?php echo set_value('prenom'); ?>" type="text">
                    <?php echo form_error('prenom'); ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 control-label col-md-offset-1" for="mail">Email :</label>  
                <div class="col-md-6">
                    <input id="mail" name="mail" placeholder="Email utilisateur" class="form-control input-md" value="<?php echo set_value('mail'); ?>" type="text">
                    <?php echo form_error('mail'); ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 control-label col-md-offset-1" for="pseudo">Pseudo :</label>  
                <div class="col-md-6">
                    <input id="pseudo" name="pseudo" placeholder="Pseudo utilisateur" class="form-control input-md" value="<?php echo set_value('pseudo'); ?>" type="text">
                    <?php echo form_error('pseudo'); ?>
                </div>
            </div>

            <!-- Password input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 control-label col-md-offset-1" for="password">Mot de passe :</label>  
                <div class="col-md-6">
                    <input id="complexify" name="password" placeholder="password" class="form-control input-md" type="password">
                    <?php echo form_error('password'); ?>
                </div>
            </div>

            <!-- Password input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 control-label col-md-offset-1" for="match_password">Confirmation :</label>  
                <div class="col-md-6">
                    <input name="match_password" placeholder="confirmation" class="form-control input-md" type="password">
                    <?php echo form_error('match_password'); ?>
                </div>
            </div>
            
            <!-- Complexity input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 control-label col-md-offset-1" for="match_password"><h4 id="complexity" class="pull-right">0%</h4></label>  
                <div class="col-md-6">
                    <div class="progress">
                        <div style="width: 0%;" id="complexity-bar" class="progress-bar progress-bar-danger" role="progressbar"></div>
                    </div>
                </div>
            </div>
            
            <!-- Switcher input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 control-label col-md-offset-1" for="actif">Compte actif :</label>  
                <div class="col-md-6">
                    <div class="col-sm-6 col-lg-4">
                        <p>
                            <input id="type" name='actif_sw' type="checkbox" data-label-text="Actif" data-off-text="Non" data-on-text="Oui">
                        </p>
                    </div>
                </div>
            </div>
            <!-- Text hidden input-->
            <div class="form-group paddingTop hidden">
                <label class="col-md-3 control-label col-md-offset-1" for="banque">Actif :</label>  
                <div class="col-md-6">
                    <input id="type" name="actif" placeholder="" class="form-control input-md" value="<?php echo set_value('actif'); ?>" type="text">
                    <?php echo form_error('actif'); ?>
                </div>
            </div>
            
            <!-- Select input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 control-label col-md-offset-1" for="compte">Type du compte :</label>  
                <div class="col-md-6">
                    <select name='compte' class="form-control">
                        <option value='associé' <?php if(set_value('compte') == "associé")echo 'selected'; ?>>Associé</option>
                        <option value='developpeur' <?php if(set_value('compte') == "developpeur")echo 'selected'; ?>>Développeur</option>
                        <option value='normal' <?php if(set_value('compte') == "normal")echo 'selected'; ?>>Associé provisoires</option>
                    </select>
                    <?php echo form_error('compte'); ?>
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