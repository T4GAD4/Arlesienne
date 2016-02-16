<div class="container">
    <br/>
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        <a href="<?php echo base_url().'previsionnel/creer/'.$projet->url; ?>" class="btn btn-success pull-right">Créer un nouveau prévi</a>      
    </div>
    <div class="row noPadding">
        <div class="module__tools">
            <div class="custom-search">
                <input class="custom-search-input" type="search" id="search" placeholder="Rechercher...">
            </div>
        </div>
    </div>
    
    <div class="row noPadding">
        <?php foreach($previsionnels as $previsionnel){ ?>
        <ul class="previsionnel searchable" data-search="<?php echo $previsionnel->utilisateur." ".$previsionnel->date." ".$previsionnel->version." ".conv_date($previsionnel->date); ?>">
            <li class="list-group-item">
                <span class="badge"><?= conv_date($previsionnel->date); ?></span>
                <a href='<?= base_url('previsionnel/modifier/'.$previsionnel->id); ?>'><?= $previsionnel->utilisateur." - version ". $previsionnel->version; ?></a>
            </li>
        </ul>
        <?php } ?>
    </div>
</div>