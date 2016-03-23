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
                    <input id="type" name="actif" placeholder="" class="form-control input-md" value="<?php echo $utilisateur->actif; ?>" type="text">
                    <?php echo form_error('actif'); ?>
                </div>
            </div>
            
            <!-- Select input-->
            <div class="form-group paddingTop">
                <label class="col-md-3 control-label col-md-offset-1" for="compte">Type du compte :</label>  
                <div class="col-md-6">
                    <select name='compte' class="form-control">
                        <option value='associé' <?php if($utilisateur->compte == "associé")echo 'selected'; ?>>Associé</option>
                        <option value='developpeur' <?php if($utilisateur->compte == "developpeur")echo 'selected'; ?>>Développeur</option>
                        <option value='normal' <?php if($utilisateur->compte == "normal")echo 'selected'; ?>>Associé provisoires</option>
                    </select>
                    <?php echo form_error('compte'); ?>
                </div>
            </div>
            
            <!-- Button -->
            <div class="form-group paddingTop">
              <div class="col-md-offset-2 col-md-8">
                  <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Annuler"/>
                <input type="submit" class="btn btn-warning pull-right" value="Modifier"/>
                <a href="<?= base_url('utilisateur/supprimer/'.$utilisateur->id); ?>" class="btn btn-danger pull-right">Supprimer l'utilisateur</a>
              </div>
            </div>

        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    $(document).ready(function(){
        <?php if($utilisateur->actif == "true"){?>
        $('[name="actif_sw"]').bootstrapSwitch('state', true);
        <?php }else{ ?>
        $('[name="actif_sw"]').bootstrapSwitch('state', false);
        <?php } ?>
    });
</script>