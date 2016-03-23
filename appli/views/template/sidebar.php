<div id="wrapper" class="toggled">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li>
                <a href="<?php echo site_url(); ?>"><i class="fa fa-home" style="padding-left : 0;padding-right : 10px;"></i> Accueil</a>
            </li>
            <li>
                <a data-toggle="collapse" data-target="#Projets" aria-expanded="false"><i class="fa fa-connectdevelop" style="padding-left : 0;padding-right : 10px;"></i> Projets</a>
                <div class="collapse" id="Projets">
                    <a href="<?php echo site_url('projet'); ?>" class="padleft">Liste</a>
                    <a href="<?php echo site_url('projet/ajouter'); ?>" class="padleft">Créer</a> 
                </div>
            </li>
            <?php if($user->compte == "associé"){ ?>
            <li>
                <a data-toggle="collapse" data-target="#societe" aria-expanded="false"><i class="fa fa-building-o" style="padding-left : 0;padding-right : 10px;"></i> Sociétés</a>
                <div class="collapse" id="societe">
                    <a href="<?php echo site_url('societe'); ?>" class="padleft">Liste</a>
                    <a href="<?php echo site_url('societe/ajouter'); ?>" class="padleft">Créer</a>
                </div>
            </li>
            <?php } ?>
            <li>
                <a data-toggle="collapse" data-target="#facture" aria-expanded="false"><i class="fa fa-file-pdf-o" style="padding-left : 0;padding-right : 10px;"></i> Facturation</a>
                <div class="collapse" id="facture">
                    <a href="<?php echo site_url('facturation'); ?>" class="padleft">Liste</a>
                    <a href="<?php echo site_url('facturation/creer'); ?>" class="padleft">Créer</a>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" data-target="#contact" aria-expanded="false"><i class="fa fa-users" style="padding-left : 0;padding-right : 10px;"></i> Contacts</a>
                <div class="collapse" id="contact">
                    <a href="<?php echo site_url('contact'); ?>" class="padleft">Liste</a>
                    <a href="<?php echo site_url('contact/ajouter'); ?>" class="padleft">Créer un particulier</a>
                    <a href="<?php echo site_url('entreprise/ajouter'); ?>" class="padleft">Créer une entreprise</a>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" data-target="#me" aria-expanded="false"><i class="fa fa-lock" style="padding-left : 0;padding-right : 10px;"></i> Mon compte</a>
                <div class="collapse" id="me">
                    <a href="<?php echo site_url('utilisateur/modifier/' . $user->id); ?>" class="padleft">Modifier mon compte</a>
                    <a href="<?php echo site_url('utilisateur/personnaliser'); ?>" class="padleft">Modifier mon interface</a>
                </div>
            </li>
            <li>
                <a href="<?php echo site_url('message/'); ?>"><i class="fa fa-envelope-o" style="padding-left : 0;padding-right : 10px;"></i> Mes messages</a>
            </li>
            <li>
                <a href="<?php echo site_url('utilisateur/'); ?>"><i class="fa fa-users" style="padding-left : 0;padding-right : 10px;"></i> Utilisateurs</a>
            </li>
            <li>
                <a href="<?php echo site_url('etats/'); ?>"><i class="fa fa-sticky-note" style="padding-left : 0;padding-right : 10px;"></i> Etats</a>
            </li>
            <li>
                <a data-toggle="collapse" data-target="#email" aria-expanded="false"><i class="fa fa-paper-plane" style="padding-left : 0;padding-right : 10px;"></i>Email</a>
                <div class="collapse" id="email">
                    <a href="<?php echo site_url('mail/'); ?>" class="padleft">Emails envoyés</a>
                    <a href="<?php echo site_url('mail/envoyer'); ?>" class="padleft">Envoyer un email</a>
                </div>
            </li>
            <li>
                <a href="<?php echo site_url('bugs/dashboard/add'); ?>"><i class="fa fa-bug" style="padding-left : 0;padding-right : 10px;"></i> Bug?</a>
            </li>
            <?php if($user->compte == "developpeur"){ ?>
            <li>
                <a href="<?php echo site_url('migration/'); ?>"><i class="fa fa-bug" style="padding-left : 0;padding-right : 10px;"></i> Migration</a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <?php
    echo $menu;
    ?>
</div>