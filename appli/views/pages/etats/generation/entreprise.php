<div class="container white">
    <div class="row hidden-print">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        <input type="button" id='exporter' class="btn btn-info pull-right"  value="Exporter"/>
    </div>
    <div class="row white">
        <h2 class="hr white center">Synthése <?= $entreprise->nom; ?></h2>
    </div>
</div>
<div class="row">
    <div class="col-md-12 export">
        <div class="col-md-12 hidden-print" id="filtres" style="padding:20px;margin:20px;">
            FILTRES :<br/>
            <input type="checkbox" name="cacher" data-th="2"/>&nbsp;Cacher les entreprises
            <input type="checkbox" name="cacher" data-th="2"/>&nbsp;Cacher les marchés total HT
            <input type="checkbox" name="cacher" data-th="3"/>&nbsp;Cacher les factures HT
            <input type="checkbox" name="cacher" data-th="4"/>&nbsp;Cacher les réglements HT
            <input type="checkbox" name="cacher" data-th="5"/>&nbsp;Cacher le restant à payer HT
            <input type="checkbox" name="cacher" data-th="6"/>&nbsp;Cacher le solde HT<br/>
            <input type="checkbox" name="cacher" data-th="7"/>&nbsp;Cacher les marchés total TTC
            <input type="checkbox" name="cacher" data-th="8"/>&nbsp;Cacher les factures TTC
            <input type="checkbox" name="cacher" data-th="9"/>&nbsp;Cacher les réglements TTC
            <input type="checkbox" name="cacher" data-th="10"/>&nbsp;Cacher le restant à payer TTC
            <input type="checkbox" name="cacher" data-th="11"/>&nbsp;Cacher le solde TTC
        </div>
        <?php foreach ($projets as $projet) { 
            
            $projetMarcheHT = 0;
            $projetFacturesHT = 0;
            $projetReglementsHT = 0;
            $projetAReglerHT = 0;
            $projetSoldeHT = 0;

            $projetMarcheTTC = 0;
            $projetFacturesTTC = 0;
            $projetReglements = 0;
            $projetARegler = 0;
            $projetSolde = 0;
            
        ?>
        <div class='table-export'>
            <h3 class="hrblack black"><?= $projet->nom; ?> (Synthése <?= $entreprise->nom; ?>)</h3>
            <p class="small center">Le <?= conv_date(Date('Y-m-d')); ?></p>
            <table class="table-striped table-hover table">
                <tr>
                    <th>Marché</th>
                    <th>Marche total HT</th>
                    <th>Total factures HT</th>
                    <th>Déjà réglé HT</th>
                    <th>Reste à régler HT</th>
                    <th>Solde HT</th>
                    <th>Marche total TTC</th>
                    <th>Total factures TTC</th>
                    <th>Déjà réglé TTC</th>
                    <th>Reste à régler TTC</th>
                    <th>Solde TTC</th>
                </tr>
                <?php
                foreach ($projet->marches as $marche) {
                    $totalMarcheHT = $marche->montantHT + $marche->totalAvenantsHT;
                    $totalFacturesHT = $marche->totalFacturesHT;
                    $totalReglementsHT = format_number($marche->totalReglementsHT);
                    $totalAReglerHT = format_number($marche->totalFacturesHT - $marche->totalReglementsHT);
                    $totalSoldeHT = format_number(($marche->montantHT + $marche->totalAvenantsHT) - $marche->totalReglementsHT);
                    $totalMarcheTTC = format_number(calc_tva($marche->montantHT, $marche->TVA) + floatval($marche->totalAvenantsTTC));
                    $totalFacturesTTC = format_number($marche->totalFacturesTTC);
                    $totalReglements = format_number($marche->totalReglements);
                    $totalARegler = format_number($marche->totalFacturesTTC - $marche->totalReglements);
                    $totalSolde = format_number((calc_tva($marche->montantHT, $marche->TVA) + floatval($marche->totalAvenantsTTC)) - $marche->totalReglements);

                    $projetMarcheHT = $projetMarcheHT + floatval($totalMarcheHT);
                    $projetFacturesHT += $marche->totalFacturesHT;
                    $projetReglementsHT += $marche->totalReglementsHT;
                    $projetAReglerHT = $projetFacturesHT - $projetReglementsHT;
                    $projetSoldeHT = $projetMarcheHT - $projetReglementsHT;
                    
                    $projetMarcheTTC += calc_tva($marche->montantHT, $marche->TVA) + floatval($marche->totalAvenantsTTC);
                    $projetFacturesTTC += $marche->totalFacturesTTC;
                    $projetReglements += $marche->totalReglements;
                    $projetARegler += $marche->totalFacturesTTC - $marche->totalReglements;
                    $projetSolde += (calc_tva($marche->montantHT, $marche->TVA) + floatval($marche->totalAvenantsTTC)) - $marche->totalReglements;
                    ?>
                    <tr>
                        <td><a href="<?= base_url('marche/detail/'.$marche->id); ?>"/><?= $marche->nom; ?></a></td>
                        <td><?= format_number($totalMarcheHT); ?></td>
                        <td><?= format_number($totalFacturesHT); ?></td>
                        <td><?= $totalReglementsHT; ?></td>
                        <td><?= $totalAReglerHT; ?></td>
                        <td><?= $totalSoldeHT; ?></td>
                        <td><?= $totalMarcheTTC; ?></td>
                        <td><?= $totalFacturesTTC; ?></td>
                        <td><?= $totalReglements; ?></td>
                        <td><?= $totalARegler; ?></td>
                        <td><?= $totalSolde; ?></td>
                    </tr>
                <?php } ?>
                <tr style="font-weight:900;">
                    <td>Projet total (<?= $entreprise->nom; ?>)</td>
                    <td><?= format_number($projetMarcheHT); ?></td>
                    <td><?= format_number($projetFacturesHT); ?></td>
                    <td><?= format_number($projetReglementsHT); ?></td>
                    <td><?= format_number($projetAReglerHT); ?></td>
                    <td><?= format_number($projetSoldeHT); ?></td>
                    <td><?= format_number($projetMarcheTTC); ?></td>
                    <td><?= format_number($projetFacturesTTC); ?></td>
                    <td><?= format_number($projetReglements); ?></td>
                    <td><?= format_number($projetARegler); ?></td>
                    <td><?= format_number($projetSolde); ?></td>
                </tr>
            </table>
    </div>
        <?php }
        ?>
    </div>
</div>

<script>
    $(function () {
        $('[name=cacher]').on('click', function () {
            var numero = $(this).data('th');
            var checked = $(this).is(":checked");
            if (checked == false) {
                $('td:nth-child(' + numero + ')').show();
                $('th:nth-child(' + numero + ')').show();
            } else {
                $('td:nth-child(' + numero + ')').hide();
                $('th:nth-child(' + numero + ')').hide();
            }
        });
    });
</script>
<style>
    checkbox{
        margin-left:10px;
    } 
    tfoot{
        background-color:rgba(0,0,0,0.4);
        color:white;
    }
</style>