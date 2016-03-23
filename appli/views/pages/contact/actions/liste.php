<div class="container">
    <br/>
    <div class="row parametres">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        <a href='<?= base_url('actionsContacts/creer/'.$contact->id); ?>' class="btn btn-info pull-right"><i class="fa fa-plus"></i>&nbsp;Créer une action</a>
        <a href='<?= base_url('rappel/liste/'.$contact->id); ?>' class="btn btn-default pull-right" style='margin-right:20px;'><i class="fa fa-arrow-left"></i>&nbsp;Voir les rappels</a>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <h3 class='hr'>Actions</h3>
        </div>
        <div class="col-md-12">
            <table class="table table-striped">
                <tr><th>Date</th><th>Commentaire</th><th>Utilisateur</th><th></th></tr>
                <?php foreach($contact->actions as $action){ ?>
                <tr><th><?= conv_date($action->date); ?></th><th><?= $action->commentaire; ?></th><th><?= $action->utilisateur; ?></th><th><a href="<?= base_url('actionsContacts/supprimer/'.$action->id); ?>" data-toggle="tooltip" data-original-title="Supprimer l'action"><i class="fa fa-minus-circle" style='color:red;'></i></a></th><th><a href="<?= base_url('actionsContacts/modifier/'.$action->id); ?>" data-toggle="tooltip" data-original-title="Modifier l'action"><i class="fa fa-gears"></i></a></th></tr>
                <?php } ?>
            </table>
        </div>
    </div>
    
</div>
