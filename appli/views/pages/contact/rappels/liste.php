<div class="container">
    <br/>
    <div class="row parametres">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        <a href='<?= base_url('rappel/creer/'.$contact->id); ?>' class="btn btn-info pull-right"><i class="fa fa-plus"></i>&nbsp;Créer un rappel</a>
        <a href='<?= base_url('actionsContacts/liste/'.$contact->id); ?>' class="btn btn-default pull-right" style='margin-right:20px;'><i class="fa fa-arrow-left"></i>&nbsp;Voir les actions</a>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <h3 class='hr'>Rappels</h3>
        </div>
        <div class="col-md-12">
            <table class="table table-striped">
                <tr><th>Date</th><th>Heure</th><th>Commentaire</th><th>Utilisateur</th><th></th></tr>
                <?php foreach($contact->rappels as $rappel){ ?>
                <tr><th><?= conv_date($rappel->date); ?></th><th><?= $rappel->heure; ?></th><th><?= $rappel->commentaire; ?></th><th><?= $rappel->utilisateur; ?></th><th><a href="<?= base_url('rappel/effectuer/'.$rappel->id); ?>" data-toggle="tooltip" data-original-title="Rappel effectué"><i class="fa fa-check" style='color:green;'></i></a></th><th><a href="<?= base_url('rappel/modifier/'.$rappel->id); ?>" data-toggle="tooltip" data-original-title="Modifier le rappel"><i class="fa fa-gears"></i></a></th><th><a href="<?= base_url('rappel/supprimer/'.$rappel->id); ?>" data-toggle="tooltip" data-original-title="Supprimer le rappel"><i class="fa fa-minus-circle" style='color:red;'></i></a></th></tr>
                <?php } ?>
            </table>
        </div>
    </div>
    
</div>
