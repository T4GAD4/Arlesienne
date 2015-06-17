<div id="wrapper" class="toggled">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a href="<?php echo site_url(); ?>">
                    Accueil
                </a>
            </li>
            <li>
                <a data-toggle="collapse" data-target="#Projets" aria-expanded="false">Societe</a>
                <div class="collapse" id="Projets">
                    <a href="<?php echo site_url('societe'); ?>" class="padleft">Liste</a>
                    <a href="<?php echo site_url('societe/ajouter'); ?>" class="padleft">Créer</a>
                </div>
            </li>
            <li>
                <a href="<?php echo site_url('contact/'); ?>">Contacts</a>
            </li>
            <li>
                <a href="<?php echo site_url('utilisateur/'); ?>">Utilisateurs</a>
            </li>
            <li>
                <a href="<?php echo site_url('bug/'); ?>">Bug?</a>
            </li>
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->

   <?php
        echo $menu;
   ?>
</div>