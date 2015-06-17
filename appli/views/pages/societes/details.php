<div class="container">
    <br/>
    <?php if($user[0]->compte == "associé"){?>
    <div class="row parametres">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        <a href="<?php echo site_url("/societe/modifier/".$societes[0]->id); ?>" class="btn btn-warning">Modifier la société</a>      
        <a href="<?php echo site_url("/societe/supprimer/".$societes[0]->id); ?>" class="btn btn-danger">Supprimer la société</a>      
        <a href="<?php echo site_url("/comptes/creer_compte/".$societes[0]->id); ?>" class="btn btn-info">Créer un compte</a>      
    </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3>Société : <?php echo $societes[0]->nom; ?></h3>
            <hr/>
            <p>Gérant : <span><?php echo $societes[0]->gerant; ?></span></p>
            <p>date de création : <span><?php echo conv_date($societes[0]->date_creation); ?></span></p>
            <p>Adresse : <span><?php echo $societes[0]->adresse; ?> <?php echo $societes[0]->cp; ?> <?php echo $societes[0]->ville; ?></span></p>
            <p>Siret : <span><?php echo $societes[0]->siret; ?></span></p>
            <p>Régime d'imposition : <span><?php echo $societes[0]->regime_imposition; ?></span></p>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h2>Liste des comptes :</h2>
        </div>
        <?php foreach($comptes as $compte){?>
        <div class="col-md-5 col-md-offset-2 box">
            <h3><?php echo $compte->banque; ?></h3>
            <hr/>
            <p>Type de compte : <span><?php echo $compte->type; ?></span></p>
            <p>Numéro de compte : <span><?php echo $compte->numero; ?></span></p>
            <p>Découvert autorisé de : <span><?php echo $compte->decouvert; ?> €</span></p>
            <?php if($user[0]->compte == "associé"){?>
                <a href="<?php echo site_url('comptes/details/'.$compte->id); ?>" class="btn btn-default">Détails</a>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
</div>