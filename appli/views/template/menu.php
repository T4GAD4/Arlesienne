<!-- Page Content -->
<div id="page-content-wrapper">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Menu</span>
                    Menu
                </button>
                <a class="navbar-brand" href="#menu-toggle" id="menu-toggle"><span><img style="max-height:30px;margin-top:-5px;" src="<?php echo img_url('logo_arlesienne_moyen.png'); ?>" alt="Logo arlesienne"/>&nbsp;&nbsp;Arlesienne</span></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Bienvenue <?php if($user){echo $user->prenom;}else{echo 'inconnu';} ?><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo site_url('utilisateur/updateourself/'.$user->id); ?>">Modifier mon compte</a></li>
                            <li><a href="<?php echo site_url('utilisateur/personnaliser'); ?>">Personnalisation de l'interface</a></li>
                            <li><a href="<?php echo site_url('message'); ?>"><span class="not-color">Mes messages <b class="badge text-right"><?php echo $nb_messages ?></b></span></a></li>
                            <li><a href="<?php echo site_url('deconnexion'); ?>">Déconnexion</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Mes raccourcis<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <?php 
                            $favoris = explode(",",$user->favoris);
                            foreach($favoris as $favori){ 
                                if($favori != ""){?>
                            <li class="favoris"><span><i data-value="<?php echo $favori; ?>" class="glyphicon glyphicon-remove"></i><a href="<?php echo site_url($favori); ?>"/><?php echo $favori; ?></a></span></li>
                                <?php }} ?>
                            <li class="divider"></li>
                            <li class="favoris"><a onclick="favoris('<?php echo control_url() ;?>')"/><span class='not-color'><i class="glyphicon glyphicon-star-empty"></i> Ajouter aux favoris</span></a></li>
                        </ul>
                    </li>
                    <li><a data-toggle="modal" data-target="#modal_message"><span><i class="glyphicon glyphicon-envelope"></i></span>Contacter un collègue</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->

    </nav>
</div>