<div class="container">
    <br/>
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        <a href="projet/ajouter" class="btn btn-info pull-right">Créer un nouveau projet</a>      
    </div>
    <input id="search" type="text" class="input-md form-control" placeholder="Rechercher..."/>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php
        $x = 0;
        foreach ($projets as $projet) {
        $x++;
        ?>
        <div class="panel panel-default searchable" data-search="<?php echo $projet->nom ?>">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $x; ?>" aria-expanded="false" aria-controls="collapseOne">
                        <?php echo $projet->nom; ?>
                    </a>
                </h4>
            </div>
            <div id="collapse<?php echo $x; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <p>Budget : <span><?php echo $projet->budget; ?>€</span></p>
                    <p>Etat : <span><?php echo $projet->etat; ?></span></p>
                    <p>Adresse : <span><?php echo $projet->adresse; ?></span></p>
                    <p>Code postal : <span><?php echo $projet->cp; ?></span></p>
                    <p>Ville : <span><?php echo $projet->ville; ?></span></p>
                    <p>Commentaire : <span><?php echo $projet->commentaire; ?></span></p>
                    <a href="" class="btn btn-info pull-right">Modifier</a>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>