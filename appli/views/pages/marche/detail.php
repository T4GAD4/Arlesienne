<div class="container detail-projet">
    <br/>
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        <a href="<?php echo base_url().'projet/modifier/'.$projet->url; ?>" class="btn btn-info pull-right">Modifier le projet</a> 
    </div>
    
    <div class="row">
        <h1 class="hr"><?php echo $projet->nom; ?></h1>
    </div>
    <ul class="nav nav-tabs" role="tablist">
        <span>Programmes : </span>
        <?php
        $x = "active";
        foreach ($programmes as $programme) {
        ?>
        <li class="<?php echo $x; ?>" role="presentation"><a href="#<?php echo slugify($programme->nom); ?>" aria-controls="<?php echo slugify($programme->nom); ?>" role="tab" data-toggle="tab"><?php echo $programme->nom; ?></a></li>
        <?php
        $x = "";
        }
        ?>
    </ul>
    <br/>
    <div class="row noPadding">
        <div class="module__tools">
            <div class="custom-search">
                <input class="custom-search-input" type="search" id="search" placeholder="Rechercher...">
            </div>
        </div>
    </div>
    <div class="tab-content">
    <?php
        $x = "active in";
        foreach ($programmes as $programme) {
    ?>
        <div role="tabpanel" class="tab-pane fade <?php echo $x; ?>" id="<?php echo slugify($programme->nom); ?>">
            <div class="marches">
                <?php
                    foreach($marches_cat as $categorie){
                        echo "<h3 class='hr'>$categorie->categorie</h3>";
                ?>
                    <?php
                    foreach ($programme->marches as $marche) {
                        if($marche->categorie == $categorie->categorie){
                            ?>
                            <div class="row marche searchable" data-search="<?php echo $projet->nom.' '.$categorie->categorie.' '.$marche->nom ?>">
                                <h4><a href="<?php echo base_url("marche/detail/$marche->id"); ?>"><?php echo $marche->nom; ?></a></h4>
                                <div class="marche-content row">
                                    <div class="col-md-6">
                                        <p>Coût TTC : <?php echo calc_tva($marche->montantHT,$marche->TVA,true); ?> €</p>
                                        <p>TVA : <?php echo intval($marche->TVA); ?> %</p>
                                        <p><?php echo ($marche->devise == true) ? "Non devisé" : "Devisé"; ?></p>
                                        <p>Caution : <?php echo $marche->caution; ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Total avenant : </p>
                                        <p>Total situation : </p>
                                        <p>Total réglement : </p>
                                        <p>% réglé : </p>
                                    </div>
                                </div>
                                <div class="marche-footer row">
                                    <div class="col-md-12 text-right">
                                        <a href="<?php echo base_url("marche/modifier/$marche->id"); ?>" class="btn text-right">Modifier</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                <?php
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