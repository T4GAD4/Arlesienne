<div class="container">
    <br/>
    <div class="row parametres">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
    <?php if ($user->compte == "developpeur" || $user->compte == "associé") { ?>
            <a href="<?php echo base_url('utilisateur/ajouter'); ?>" class="btn btn-info">Créer un nouvel utilisateur</a>      
    <?php } ?>
    </div>
    <div class="row noPadding">
        <div class="module__tools">
            <div class="custom-search">
                <input class="custom-search-input" type="search" id="search" placeholder="Rechercher...">
            </div>
        </div>
    </div>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php
        $x = 0;
        foreach ($utilisateurs as $utilisateur) {
        $x++;
        ?>
        <div class="panel panel-default searchable" data-search="<?php echo $utilisateur->nom . ' ' . $utilisateur->prenom; ?>">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $x; ?>" aria-expanded="false" aria-controls="collapseOne">
                        <?php echo $utilisateur->nom . ' ' . $utilisateur->prenom; ?>
                    </a>
                </h4>
            </div>
            <div id="collapse<?php echo $x; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <p>Type du compte : <span><?php echo $utilisateur->compte; ?></span></p>
                    <p>Email : <span><?php echo $utilisateur->mail ?></span></p>
                    <p>Pseudo : <span><?php echo $utilisateur->pseudo; ?></span></p>
                    <p>Etat : <span><b><?php echo $utilisateur->actif; ?></b></span></p>
                    <?php if ($user->compte == "developpeur" || $user->id == $utilisateur->id) { ?>
                        <a href="<?php echo site_url('utilisateur/modifier/'.$utilisateur->id); ?>" class="btn btn-info pull-right">Modifier</a> 
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>