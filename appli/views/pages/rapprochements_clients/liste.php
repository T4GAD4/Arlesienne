<div class="detail-marche container">
    <div class='row'>
        <div class="col-md-12">
            <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        </div>
    </div>
    <div class='col-md-12'>
        <h1 class="hr center">Détails du rapprochement secteur</h1>
        <h3><?= $projet->nom; ?></h3>
        <p style="color:whitesmoke;">Secteurs : <?= implode(", ", json_decode($projet->secteur)); ?></p>
    </div>
</div>
<div class='col-md-12'>
    <h1 class="hr center">Clients potentiels</h1>
    <div class="row noPadding">
        <div class="module__tools">
            <div class="custom-search">
                <input class="custom-search-input" type="search" id="search" placeholder="Rechercher...">
            </div>
        </div>
    </div>
    <table class="table table-striped table-hover">
        <tr><th>Nom Prénom</th><th>Adresse</th><th>Superficie</th><th>Secteurs</th><th>Budget</th></tr>
        <?php foreach($clients as $client){ 
            $secteurs = implode(", ", json_decode($client->fiche->secteur));
            $oui = "<span style='color:green;'>OUI</span>";
            $non = "<span style='color:red;'>OUI</span>";
        ?>
        <tr class="searchable" data-search="<?= $client->nom.' '.$client->prenom.' '.$client->email.' '.$client->adresse.' '.$client->cp.' '.$client->ville.' '.$secteurs; ?>"><td><?= strtoupper($client->nom).' '.$client->prenom; ?></td><td><?= $client->adresse.' '.$client->cp.' '.  strtoupper($client->ville); ?></td><td><?= $client->fiche->superficie; ?> m²</td><td><?= $secteurs; ?></td><td><?= format_number((float)$client->fiche->budget); ?> €</td></tr>
        <?php } ?>
    </table>
</div>


