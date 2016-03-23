<div class="container">
    <br/>
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
    </div>
    <div class="row">
        <?php echo form_open_multipart(base_url('mail/envoyer')); ?>

        <fieldset>
            <?php if(isset($email) && $email == true){ ?>
                <div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Félicitations !</strong> Votre email à bien été envoyé! :D
</div>
            <?php }else if(isset($email) && $email == false){ ?>
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Attention !</strong> Votre email n'a pas pu être envoyé, peut-être n'avez vous pas mis de pièces jointe! :/
</div>
            <?php } ?>
            <!-- Form Name -->
            <legend>Envoi d'un mail</legend>

            <div class="control-group col-md-offset-3">
                <label class="control-label col-sm-2 col-centered" for="destinataire">Destinataire *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered ">
                    <input value="<?php echo set_value('destinataire'); ?>" type="text" name="destinataire" class="form-control" />
                    <?php echo form_error('destinataire'); ?>
                </div>
            </div>

            <div class="control-group col-md-offset-3">
                <label class="control-label col-sm-2 col-centered" for="copie">Copie</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered ">
                    <input value="<?php echo set_value('copie'); ?>" type="text" name="copie" class="form-control" />
                    <?php echo form_error('copie'); ?>
                </div>
            </div>

            <div class="control-group col-md-offset-3">
                <label class="control-label col-sm-2 col-centered" for="copie_cachee">Copie cachée</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered ">
                    <input value="<?php echo set_value('copie_cachee'); ?>" type="text" name="copie_cachee" class="form-control" />
                    <?php echo form_error('copie_cachee'); ?>
                </div>
            </div>

            <div class="control-group col-md-offset-3">
                <label class="control-label col-sm-2 col-centered" for="expediteur">Expediteur *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered ">
                    <select id="expediteur" name="expediteur" class="form-control">
                        <option <?php echo set_select('expediteur', 'contact@saint-roch-habitat.fr'); ?> value="contact@saint-roch-habitat.fr">contact</option>
                        <option <?php echo set_select('expediteur', 'commercial@saint-roch-habitat.fr'); ?> value="commercial@saint-roch-habitat.fr">commercial</option>
                        <option <?php echo set_select('expediteur', 'communication@saint-roch-habitat.fr'); ?> value="communication@saint-roch-habitat.fr">communication</option>
                        <option <?php echo set_select('expediteur', 'technique@saint-roch-habitat.fr'); ?> value="technique@saint-roch-habitat.fr">technique</option>
                        <option <?php echo set_select('expediteur', 'informatique@saint-roch-habitat.fr'); ?> value="informatique@saint-roch-habitat.fr">informatique</option>

                    </select>
                    <?php echo form_error('expediteur'); ?>
                </div>
            </div>

            <div class="control-group col-md-offset-3">
                <label class="control-label col-sm-2 col-centered" for="sujet">Sujet *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered ">
                    <input value="<?php echo set_value('sujet'); ?>" type="text" name="sujet" class="form-control" />
                    <?php echo form_error('sujet'); ?>
                </div>
            </div>

            <div class="control-group col-md-offset-3">
                <label class="control-label col-sm-2 col-centered" for="message">Message *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered ">
                    <textarea class="form-control" rows="5" name="message"><?php echo set_value('message'); ?></textarea>
                    <?php echo form_error('message'); ?>
                </div>
            </div>
            
            <div class="control-group col-md-offset-3">
                <label class="control-label col-sm-2 col-centered" for="piece[]">Pièces jointes *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered ">
                    <input class="form-control" type="file" name="piece[]" multiple="true"/>
                    <?php echo form_error('message'); ?>
                </div>
            </div>

            <input class="btn btn-primary pull-right" type="submit" value="Envoyer" />
            <?= form_close(); ?>

    </div>
</div>
