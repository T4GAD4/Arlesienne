<div class="container">
    <br/>
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        <a href="<?php echo base_url().'projet/ajouter'; ?>" class="btn btn-success pull-right">Créer un nouveau projet</a>      
    </div>
    <div class="row noPadding">
        <div class="module__tools">
            <div class="custom-search">
                <input class="custom-search-input" type="search" id="search" placeholder="Rechercher...">
            </div>
        </div>
    </div>
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
                                        <a href="<?php echo base_url("projet/detail/$projet->url"); ?>">
                                            <?php echo $projet->nom; ?>
                                        </a>
                                    </h4>               
                                </div>
                                <div class="projet-body">
                                    <p><span style="font-size : 18px;"><?php echo $projet->adresse; ?> <?php echo $projet->cp; ?> <?php echo $projet->ville; ?>&nbsp;&nbsp;&nbsp;<a href="http://www.maps.google.fr/maps?f=q&hl=fr&q=<?php echo str_replace(' ','+',$projet->adresse); ?>+<?php echo str_replace(' ','+',$projet->cp); ?>+<?php echo str_replace(' ','+',$projet->ville); ?>" target="_blank"><i class="fa fa-location-arrow"></i></a></span></p>
                                    <div class="row projet-details">
                                        <div class="col-md-6 detail-left">
                                            <p>Budget global : <?php echo number_format($projet->budget,2,'.',' '); ?> €</p>
                                            <p>Marchés signés : <?php echo $projet->nb_marche_signes; ?></p>
                                            <p>Factures reçues : <?php echo number_format($projet->total_recu,2,'.',' '); ?> €</p>
                                            <p>Factures payés : <?php echo number_format($projet->total_paye,2,'.',' '); ?> €</p>
                                        </div>
                                        <div class="col-md-6 detail-right">
                                            <p>Lots totaux : <?= $projet->lots_totaux; ?></p>
                                            <p>Lots sous compromis : </p>
                                            <p>Lots actés : </p>
                                        </div>
                                    </div>
                                    <div class="row projet-aide">
                                        <div class="col-md-12 text-left">
                                            Changer l'état du projet :
                                        </div>
                                    </div>
                                    <div class="row projet-btn">
                                        <div class="col-md-6 text-left">
                                            <a href="<?php if($etat != "Projets en cours"){echo base_url("projet/en_cours/$projet->id");} ?>" class="btn small text-left <?php if($etat == "Projets en cours"){ echo "active"; } ?>">Projet en cours</a>
                                            <a href="<?php if($etat != "Projets terminés"){echo base_url("projet/termine/$projet->id");} ?>" class="btn small text-left <?php if($etat == "Projets terminés"){ echo "active"; } ?>">Projet terminé</a>
                                            <a href="<?php if($etat != "Projets abandonnés"){echo base_url("projet/abandonne/$projet->id");} ?>" class="btn small text-left <?php if($etat == "Projets abandonnés"){ echo "active"; } ?>">Projet abandonné</a>
                                            <a href="<?php if($etat != "Projets à l étude"){echo base_url("projet/etude/$projet->id");} ?>" class="btn small text-left <?php if($etat == "Projets à l étude"){ echo "active"; } ?>">Projet à l'étude</a>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <a href="<?php echo base_url("projet/modifier/$projet->url"); ?>" class="btn">Modifier</a>
                                            <a href="<?php echo base_url("previsionnel/liste/$projet->url"); ?>" class="btn">Prévisionnels</a>
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