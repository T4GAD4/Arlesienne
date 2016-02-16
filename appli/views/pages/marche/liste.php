<div class="container detail-projet">
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
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
        $x = "class='active'";
        $y = 0;
        foreach ($categories as $categorie) {
        ?>
        <li role="presentation" <?= $x; ?>><a href="#<?= $y; ?>" aria-controls="<?= $y; ?>" role="tab" data-toggle="tab"><?= $categorie->nom; ?></a></li>
        <?php
        $x = "";
        $y++;
        }
        ?>
    </ul>
    <div class="tab-content">
        <?php
        $x = "in active";
        $y = 0;
        foreach ($categories as $categorie) {
        ?>   
        <div role="tabpanel" class="fade tab-pane <?= $x; ?>" id="<?= $y; ?>"> 
            <?php
            foreach ($marches as $marche) {
            if ($marche->categorie == $categorie->nom) {
            ?>
            <div class="row marche searchable" data-search="<?php echo $projet->nom . ' ' . $categorie->nom . ' ' . $marche->nom ?>">
                <h4><a href="<?php echo base_url("marche/detail/$marche->id"); ?>"><?php echo $marche->nom; ?></a></h4>
                <div class="marche-footer">
                    <div class="col-md-12 text-right">
                        <a href="<?php echo base_url("marche/modifier/$marche->id"); ?>" class="btn text-right">Modifier</a>
                    </div>
                </div>
            </div>
            <?php } ?>                    
            <?php
            }
            ?>
        </div>
        <?php
        $x = "";
        $y++;
        }
        ?>
    </div>
</div>