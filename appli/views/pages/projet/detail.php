<div class="container detail-projet">
    <br/>
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        <a href="<?php echo base_url() . 'projet/modifier/' . $projet->url; ?>" class="btn btn-info pull-right">Modifier le projet</a> 
    </div>
    <h3 class="hr"><?php echo $projet->nom; ?></h3>
    <br/>
    <div class='row detailsProjets'>
        <div class='col-md-3 center'>
            <a width="100%" height="100%" href="<?= base_url('marche/liste/' . $projet->url); ?>" data-toggle="tooltip" title="" data-original-title="Marchés du projet"><img src="<?= img_url('menu/marches.png'); ?>"/></a><br/>
        </div>
        <div class='col-md-3 center'>
            <a width="100%" height="100%" href="<?= base_url('lot/liste/' . $projet->url); ?>" data-toggle="tooltip" title="" data-original-title="Lots du projet"><img src="<?= img_url('menu/lots.png'); ?>"/></a><br/>
        </div>
        <div class='col-md-3 center'>
            <a width="100%" height="100%" href="<?= base_url('vente/liste/' . $projet->url); ?>" data-toggle="tooltip" title="" data-original-title="Ventes du projet"><img src="<?= img_url('menu/ventes.png'); ?>"/></a><br/>
        </div>
        <div class='col-md-3 center'>
            <a width="100%" height="100%" href="<?= base_url('rapprochements_clients/vue/' . $projet->url); ?>" data-toggle="tooltip" title="" data-original-title="Rapprochement clients"><img src="<?= img_url('menu/rapprochement.png'); ?>"/></a><br/> 
        </div>
        <div class='col-md-12 center'>
            <h3 class='hr'>Chiffres du projet</h3>
            <?php
            if ($projet->etat == "Projets à l étude") {
                echo "<p class='bg-danger text-muted'>! Attention ! Ce projet est à l'étude, les calculs sont donc basés sur le budget prévisionnel renseigné à la création du projet.</p>";
            } else {
                echo "<p class='bg-danger text-muted'>! Attention ! Ce projet n'est plus à l'étude, les calculs sont donc basés sur la somme des marchés au total.</p>";
            }
            ?>
            <br/>
            <div class='row'>
                <div class='col-md-4 center borderRight'>
                    <h5 class='hr'>Marchés</h5>
                    <p>Total des marches HT : <?= format_number($totalMarchesHT); ?> €</p>
                    <p>Total des marches TTC : <?= format_number($totalMarchesTTC); ?> €</p>
                    <br/>
                    <p>Nombre de marchés signés : <?= $projet->devise; ?></p>
                    <p>Nombre de marchés nuls : <?= $projet->marchesAZero; ?></p>
                </div>
                <div class='col-md-4 center borderRight'>
                    <h5 class='hr'>Avenants</h5>
                    <p>Total des avenants HT : <?= format_number($totalAvenantsHT); ?> €</p>
                    <p>Total des avenants TTC : <?= format_number($totalAvenantsTTC); ?> €</p>
                    <br/>
                    <p>Nombre d'avenants : <?= $projet->avenants; ?></p>
                    <p>&nbsp;</p>
                </div>
                <?php
                if ($projet->etat == "Projets à l étude") {
                    $baseHT = $projet->budget;
                    $baseTTC = $projet->budget;
                } else {
                    $baseHT = $totalMarchesHT;
                    $baseTTC = $totalMarchesTTC;
                }
                ?>
                <div class='col-md-4 center'>
                    <h5 class='hr'>Projet</h5>
                    <p>Total du projet HT : <?= format_number($baseHT + $totalAvenantsHT); ?> €</p>
                    <p>Total TVA du projet : <?= format_number(($baseTTC + $totalAvenantsTTC) - ($baseHT + $totalAvenantsHT)); ?> €</p>
                    <p>Total du projet TTC : <?= format_number($baseTTC + $totalAvenantsTTC); ?> €</p>
                    <p></p>
                    <p>Budget prévisionnel : <?= format_number($projet->budget); ?> €</p>
                    <p>Différence : <?= format_number($projet->budget - ($baseTTC + $totalAvenantsTTC)); ?> €</p>
                </div>
                <div class='col-md-12 center'>
                    <?php
                    if (substr(($baseHT / $totalFacturesHT) * 100, 0, 5) < 20) {
                        $class = "progress-bar-danger";
                    } else if (substr(($baseHT / $totalFacturesHT) * 100, 0, 5) < 50) {
                        $class = "progress-bar-warning";
                    } else {
                        $class = "progress-bar-success";
                    }
                    ?>
                    <p class='text-muted'>POURCENTAGE</p>
                    <div class="progress">
                        <div class="progress-bar <?= $class; ?> progress-bar-striped active" role="progressbar" aria-valuenow="<?= substr(($baseHT / $totalFacturesHT) * 100, 0, 5) ?>"
                             aria-valuemin="0" aria-valuemax="100" style="width:<?= substr(($baseHT / $totalFacturesHT) * 100, 0, 5) ?>%;text-align:center;">
                            <?= substr(($baseHT / $totalFacturesHT) * 100, 0, 5) ?> %
                        </div>
                    </div>
                    <p class='text-muted'>Total HT du projet / Total HT des factures recues</p>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-12'>
                    <h4 class='hr'>Factures (<?= $nbFactures; ?> reçus)</h4>
                </div>
                <div class='col-md-4 center borderRight'>
                    <h5 class='hr'>Reçu</h5>
                    <p>Total HT des factures : <?= format_number($totalFacturesHT); ?> €</p>
                    <p>Total TTC des factures : <?= format_number($totalFacturesTTC); ?> €</p>
                </div>
                <div class='col-md-4 center borderRight'>
                    <h5 class='hr'>Payé</h5>
                    <p>Total des réglements : <?= format_number($reglements); ?> €</p>
                </div>
                <div class='col-md-4 center'>
                    <h5 class='hr'>Solde</h5>
                    <p>Reste à payer : <?= format_number($totalFacturesTTC - $reglements); ?> €</p>
                </div>
                <div class='col-md-12'>
                    <?php
                    if (substr(($reglements / $totalFacturesTTC) * 100, 0, 5) < 20) {
                        $class = "progress-bar-danger";
                    } else if (substr(($reglements / $totalFacturesTTC) * 100, 0, 5) < 50) {
                        $class = "progress-bar-warning";
                    } else {
                        $class = "progress-bar-success";
                    }
                    ?>
                    <p class='text-muted'>POURCENTAGE</p>
                    <div class="progress">
                        <div class="progress-bar <?= $class; ?> progress-bar-striped active" role="progressbar" aria-valuenow="<?= substr(($reglements / $totalFacturesTTC) * 100, 0, 5) ?>"
                             aria-valuemin="0" aria-valuemax="100" style="width:<?= substr(($reglements / $totalFacturesTTC) * 100, 0, 5) ?>%;text-align:center;">
                            <?= substr(($reglements / $totalFacturesTTC) * 100, 0, 5) ?> %
                        </div>
                    </div>
                    <p class='text-muted'>Sommes de réglements effectués / Somme des montants TTC des factures reçues</p>
                </div>   
            </div>
            <div class='row'>
                <div class='col-md-7 center'>
                    <?php if (isset($entreprises)) { ?>
                        <h3 class="hr">Entreprises travaillants sur le projet</h3>        
                        <?php foreach ($entreprises as $entreprise) { ?>
                            <div class='col-md-6 center'>
                                <p><?= $entreprise->nom; ?></p>
                            </div>
                        <?php }
                    }
                    ?>
                </div>  
                <div class='col-md-5 center'>
                    <h3 class="hr">Lots</h3>
                    <p>Nombre lots principaux : <?= $principaux; ?></p>
                    <p>Nombre lots secondaires : <?= $secondaires; ?></p>
                </div>    
            </div>
        </div>  
    </div>
</div>