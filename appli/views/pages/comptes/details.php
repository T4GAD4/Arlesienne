<div class="container">
    <br/>
    <?php if ($user[0]->compte == "associé") { ?>
        <div class="row parametres">
            <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
            <a href="<?php echo site_url("/comptes/modifier/" . $compte[0]->id); ?>" class="btn btn-warning">Modifier le compte</a>      
            <a href="<?php echo site_url("/comptes/supprimer/" . $compte[0]->id); ?>" class="btn btn-danger">Supprimer le compte</a>      
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <h3><?php echo $compte[0]->banque; ?></h3>
            <p>Type de compte : <span><?php echo $compte[0]->type; ?></span></p>
            <p>Numéro de compte : <span><?php echo $compte[0]->numero; ?></span></p>
            <p>Découvert autorisé de : <span><?php echo $compte[0]->decouvert; ?> €</span></p>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-5">
            <h4>Liste des opérations sur le compte <?php echo $compte[0]->numero; ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5">
            <table class="mouvements">
                <thead>
                <th>Date</th>
                <th>Objet</th>
                <th>Montant</th>
                </thead>
                <tbody>
                    <?php foreach ($operations as $operation) { ?>
                        <tr><td><?php echo $operation->date; ?></td><td><?php echo $operation->objet; ?></td><td style="text-align: right;"><?php
                                if ($operation->type == "debit") {
                                    echo'- ';
                                } elseif ($operation->type == "credit") {
                                    echo'+ ';
                                } else {
                                    echo'Type operation inconnu';
                                }echo $operation->montant;
                                ?></td></tr>
<?php } ?>
                </tbody>
            </table>
            <p style="font-weight:900;">Total actuel sur le compte : <?php if ($total < 0) {
    $color = 'red';
} else {
    $color = 'green';
}echo '<span style="color:' . $color . ';float:right;">' . $total . ' €</span>'; ?></p>
        </div>
        <div class="col-md-7" id="chart_div">
            
        </div>
    </div>
</div>

<script type="text/javascript">

    // Load the Visualization API and the piechart package.
    google.load('visualization', '1.0', {'packages': ['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);


    // Callback that creates and populates a data table, 
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Montant total du compte');
        data.addRows([
            ['',<?php echo $compte[0]->montant; ?>],
            <?php foreach($inters as $inter){ ?>
                ["<?php echo $inter['date'].'",'.$inter['montant']; ?>],
            <?php } ?>
                
        ]);

        // Set chart options
        var options = {'title': 'Récapitulatif global du compte',
            'width': '100%',
            'height' : 400,
            hAxis: {title: 'Date',  titleTextStyle: {color: '#999'}},
            animation:{
                duration: 1000,
                easing: 'out',
            }
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>