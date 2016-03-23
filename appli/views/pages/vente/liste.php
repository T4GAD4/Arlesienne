<div class="container">
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        <a href="<?php echo base_url() . 'vente/creer/' . $projet->url; ?>" class="btn btn-info pull-right"><i class="fa fa-plus"></i>&nbsp;Créer une vente</a> 
    </div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#tous" aria-controls="tous" role="tab" data-toggle="tab">Tous</a></li>
        <li role="presentation"><a href="#compromis" aria-controls="compromis" role="tab" data-toggle="tab">Compromis</a></li>
        <li role="presentation"><a href="#actes" aria-controls="actes" role="tab" data-toggle="tab">Actés</a></li>
        <li role="presentation"><a href="#abandonnes" aria-controls="abandonnes" role="tab" data-toggle="tab">Abandonnées</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="tous">
            <?php foreach ($ventes as $vente) { ?>
            <div class="bgWhite col-md-6 vente_panel">
                <a href="<?= base_url('vente/detail/'.$vente->id); ?>"><h3 class="black hrblack">LOT(S) <?php $array= Array(); foreach($vente->lots as $lot){ array_push($array,$lot->numero_lot);}echo implode(' + ',$array);  ?> - <?php $array= Array(); foreach($vente->clients as $client){ array_push($array,$client->nom);}echo strtoupper(implode(', ',$array));  ?> </h3></a>
                <p class="small center"><?= conv_date($vente->date); ?></p>
                <div class="row center">
                    <div class="col-md-12">
                        <?php switch($vente->etat){
                            case "compromis": $texte = "sous compromis";break;
                            default : $texte = $vente->etat; break;
                        } ?>
                        <h5 class="hr">Vente <?= $texte; ?></h5>
                        <?php
                        //On va chercher le dernier prix qui a été renseigné sur la vente pour avoir la derniére MAJ
                        $dernier_prix = $vente->prix[sizeof($vente->prix)-1];
                        ?>
                        <div class="col-md-12 center">
                            <p>Total de la vente : <?= format_number(calc_ttc_vente($dernier_prix)); ?> € TTC</p>                            
                        </div>                        
                    </div>
                </div>
            </div>                
            <?php } ?>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="compromis">
            <?php foreach ($ventes as $vente) { if($vente->etat == "compromis"){?>
            <div class="bgWhite col-md-6 vente_panel">
                <a href="<?= base_url('vente/detail/'.$vente->id); ?>"><h3 class="black hrblack">LOT(S) <?php $array= Array(); foreach($vente->lots as $lot){ array_push($array,$lot->numero_lot);}echo implode(' + ',$array);  ?> - <?php $array= Array(); foreach($vente->clients as $client){ array_push($array,$client->nom);}echo strtoupper(implode(', ',$array));  ?> </h3></a>
                <p class="small center"><?= conv_date($vente->date); ?></p>
                <div class="row center">
                    <div class="col-md-6">
                        <h5 class="hr">Lot(s) concernés</h5>
                        <?php foreach($vente->lots as $lot){ ?>
                            - Lot n° <?= $lot->numero_lot; ?><br/>
                        <?php } ?>
                    </div>
                    <div class="col-md-6">
                        <h5 class="hr">Client(s) concernés</h5>
                        <?php foreach($vente->clients as $client){ ?>
                        - <?= strtoupper($client->nom).' '.  ucfirst($client->prenom); ?><br/>
                        <?php } ?>
                    </div>
                    <div class="col-md-12">
                        <?php switch($vente->etat){
                            case "compromis": $texte = "sous compromis";break;
                            default : $texte = $vente->etat; break;
                        } ?>
                        <h5 class="hr">Vente <?= $texte; ?></h5>
                        <?php
                        //On va chercher le dernier prix qui a été renseigné sur la vente pour avoir la derniére MAJ
                        $dernier_prix = $vente->prix[sizeof($vente->prix)-1];
                        ?>
                        <div class="col-md-12 center">
                            <p>Total de la vente : <?= format_number(calc_ttc_vente($dernier_prix)); ?> € TTC</p>                            
                        </div>                        
                    </div>
                </div>
            </div>                
            <?php }} ?>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="actes">
            <?php foreach ($ventes as $vente) { if($vente->etat == "acte"){?>
            <div class="bgWhite col-md-6 vente_panel">
                <a href="<?= base_url('vente/detail/'.$vente->id); ?>"><h3 class="black hrblack">LOT(S) <?php $array= Array(); foreach($vente->lots as $lot){ array_push($array,$lot->numero_lot);}echo implode(' + ',$array);  ?> - <?php $array= Array(); foreach($vente->clients as $client){ array_push($array,$client->nom);}echo strtoupper(implode(', ',$array));  ?> </h3></a>
                <p class="small center"><?= conv_date($vente->date); ?></p>
                <div class="row center">
                    <div class="col-md-12">
                        <?php switch($vente->etat){
                            case "compromis": $texte = "sous compromis";break;
                            default : $texte = $vente->etat; break;
                        } ?>
                        <h5 class="hr">Vente <?= $texte; ?></h5>
                        <?php
                        //On va chercher le dernier prix qui a été renseigné sur la vente pour avoir la derniére MAJ
                        $dernier_prix = $vente->prix[sizeof($vente->prix)-1];
                        ?>
                        <div class="col-md-12 center">
                            <p>Total de la vente : <?= format_number(calc_ttc_vente($dernier_prix)); ?> € TTC</p>                            
                        </div>                        
                    </div>
                </div>
            </div>                
            <?php } }?>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="abandonnes">
            <?php foreach ($ventes as $vente) { if($vente->etat == "abandonne"){?>
            <div class="bgWhite col-md-6 vente_panel">
                <a href="<?= base_url('vente/detail/'.$vente->id); ?>"><h3 class="black hrblack">LOT(S) <?php $array= Array(); foreach($vente->lots as $lot){ array_push($array,$lot->numero_lot);}echo implode(' + ',$array);  ?> - <?php $array= Array(); foreach($vente->clients as $client){ array_push($array,$client->nom);}echo strtoupper(implode(', ',$array));  ?> </h3></a>
                <p class="small center"><?= conv_date($vente->date); ?></p>
                <div class="row center">
                    <div class="col-md-12">
                        <?php switch($vente->etat){
                            case "compromis": $texte = "sous compromis";break;
                            default : $texte = $vente->etat; break;
                        } ?>
                        <h5 class="hr">Vente <?= $texte; ?></h5>
                        <?php
                        //On va chercher le dernier prix qui a été renseigné sur la vente pour avoir la derniére MAJ
                        $dernier_prix = $vente->prix[sizeof($vente->prix)-1];
                        ?>
                        <div class="col-md-12 center">
                            <p>Total de la vente : <?= format_number(calc_ttc_vente($dernier_prix)); ?> € TTC</p>                            
                        </div>                        
                    </div>
                </div>
            </div>                
            <?php } }?>
        </div>
    </div>

</div>