<div class="container detail-projet">
    <br/>
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        <a href="<?php echo base_url() . 'projet/modifier/' . $projet->url; ?>" class="btn btn-info pull-right">Modifier le projet</a> 
    </div>
    <h3 class="hr"><?php echo $projet->nom; ?></h3>
    <br/>
    <a href="<?= base_url('marche/liste/'.$projet->url); ?>">Marchés du projet</a>
</div>
