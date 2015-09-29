<div class="container">
    <br/>
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        <a href="projet/ajouter" class="btn btn-success pull-right">Créer un nouveau projet</a>      
    </div>
    <input id="search" type="text" class="input-md form-control" placeholder="Rechercher..."/>
    <ul class="nav nav-tabs" role="tablist">
        <?php
        $x = "active";
        foreach ($etats as $etat) {
            ?>
        <li class="<?php echo $x; ?>" role="presentation"><a href="#<?php echo slugify($etat); ?>" aria-controls="<?php echo $etat; ?>" role="tab" data-toggle="tab"><?php echo $etat; ?></a></li>
            <?php
            $x = "";
        }
        ?>
    </ul>
    <div class="tab-content">
        <?php
        $x = "active in";
        foreach ($etats as $etat) {
            ?>
        <div role="tabpanel" class="tab-pane fade <?php echo $x; ?>" id="<?php echo slugify($etat); ?>">
            <div class="projets">
                    <?php
                    $x = 0;
                    foreach ($projets as $projet) {
                        if ($projet->etat == $etat) {
                            $x++;
                            ?>
                            <div class="projet searchable" data-search="<?php echo $projet->nom ?>">
                                <div class="projet-header">
                                    <h4 class="projet-title">
                                        <a href="<?php echo base_url("projet/$projet->url"); ?>">
                                            <?php echo $projet->nom; ?>
                                        </a>
                                    </h4>               
                                </div>
                                <div class="projet-body">
                                    <p><span><?php echo $projet->adresse; ?> <?php echo $projet->cp; ?> <?php echo $projet->ville; ?></span></p>
                                    <div class="row projet-aide">
                                        <div class="col-md-12 text-left">
                                            Changer l'état du projet :
                                        </div>
                                    </div>
                                    <div class="row projet-btn">
                                        <div class="col-md-10 text-left">
                                            <a href="<?php if($etat != "Projets en cours"){echo base_url("projet/en_cours/$projet->id");} ?>" class="btn small text-left <?php if($etat == "Projets en cours"){ echo "active"; } ?>">Projet en cours</a>
                                            <a href="<?php if($etat != "Projets terminés"){echo base_url("projet/termine/$projet->id");} ?>" class="btn small text-left <?php if($etat == "Projets terminés"){ echo "active"; } ?>">Projet terminé</a>
                                            <a href="<?php if($etat != "Projets abandonnés"){echo base_url("projet/abandonne/$projet->id");} ?>" class="btn small text-left <?php if($etat == "Projets abandonnés"){ echo "active"; } ?>">Projet abandonné</a>
                                            <a href="<?php if($etat != "Projets à l étude"){echo base_url("projet/etude/$projet->id");} ?>" class="btn small text-left <?php if($etat == "Projets à l étude"){ echo "active"; } ?>">Projet à l'étude</a>
                                        </div>
                                        <div class="col-md-2 text-right">
                                            <a href="<?php echo base_url("projet/modifier/$projet->url"); ?>" class="btn text-right">Modifier</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        $x="";
        }
                    ?>
                </div>
        </div>
        <?php 
        $x = "";
        } 
        ?>
    </div>








</div>