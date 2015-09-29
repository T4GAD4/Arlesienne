<div class="container">
    <br/>
    <?php if($user->compte == "associé"){ ?>
    <div class="row parametres">
                  <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        <a href="societe/ajouter" class="btn btn-info">Créer une nouvelle société</a>      
    </div>
    <?php } ?>
    <div class="row textcenter">
        <?php
        $x = 1;
        foreach($societes as $societe){
        ?>
        <div class="col-md-5 <?php if($x == 2) echo 'col-md-offset-1'; ?> col-sm-6 box col-centered">
            <h3><?php echo $societe->nom; ?></h3>
            <hr/>
            <p>Gérant : <span><?php echo $societe->gerant; ?></span></p>
            <p>date de création : <span><?php echo conv_date($societe->date_creation); ?></span></p>
            <p>Adresse : <span><?php echo $societe->adresse; ?> <?php echo $societe->cp; ?> <?php echo $societe->ville; ?></span></p>
            <?php if($user->compte == "associé"){?>
            <a href="societe/details/<?php echo $societe->id; ?>" class="btn btn-default">Détails</a>
            <?php } ?>
        </div>
        <?php
        if($x == 2){
        $x = 0;
        }
        $x++;
        }
        ?>
    </div>
</div>