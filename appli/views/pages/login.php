<div class="admin-log-on">
    <div class="login-panel">
        <div class="panel-logo">
            <img src="<?php echo img_url('logo_arlesienne_moyen.png') ?>" alt="Walkabout" />
        </div>
        <div class="panel-form">
            <?php
            if($error != false){ 
            ?>
            <p class="perror"><?php echo $error; ?></p>
            <?php
            }
            echo form_open(base_url().'connexion');
            ?>
                <div class="form-group">
                    <label for="pseudo">Identifiant</label>
                    <input id="pseudo" name="pseudo" type="text" value="<?php echo set_value('pseudo'); ?>" autofocus />
                    <?php echo form_error('pseudo'); ?>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input id="password" name="password" value="<?php echo set_value('password'); ?>" type="password" />
                    <?php echo form_error('password'); ?>
                </div>
                <div class="form-group">
                    <input type="submit" class="button" value="Se connecter"/>
                </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!--<div class="recover-pwd-block" id="recover-pwd">
    <div class="container-fluid">
        <?php echo form_open('walkadmin/connexion/recoverpassword'); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="email">Votre e-mail</label>
                        <input type="email" name="email" id="email">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="button">Générer un mot de passe</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>-->


