<div class="container detail-projet">
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        <a href="<?= base_url('lot/creer/' . $projet->url); ?>" class="btn btn-info pull-right">Créer un lot</a>
    </div>
    <div class="row noPadding">
        <div class="module__tools">
            <div class="custom-search">
                <input class="custom-search-input" type="search" id="search" placeholder="Rechercher...">
            </div>
        </div>
    </div>    
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active in"><a href="#principal" aria-controls="principal" role="tab" data-toggle="tab">Lots principaux</a></li>
        <li role="presentation"><a href="#secondaire" aria-controls="secondaire" role="tab" data-toggle="tab">Lots secondaires</a></li>
    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="fade tab-pane active in" id="principal"> 
            <div class="panel-group" id="accordion-lots" role="tablist" aria-multiselectable="false">
                <?php $x=0; foreach ($principaux as $lot) { ?>
                    <div class="panel panel-default" class="searchable" data-search="<?= $lot->reference.' '.$lot->numero_lot; ?>">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#principaux<?= $x; ?>" aria-expanded="false" aria-controls="collapse<?= $x; ?>">
                                    <?= $lot->reference ." - Lot n° ". $lot->numero_lot; ?> <a data-toggle="tooltip" title="" data-original-title="Modifier le lot"  href="<?= base_url('lot/modifier/'.$lot->id); ?>" class="pull-right"><i class="fa fa-gears"></i></a><a target="_blank" data-toggle="tooltip" title="" data-original-title="Imprimer la fiche du lot"  href="<?= base_url('lot/imprimer/'.$lot->id); ?>" style="margin-right:10px;" class="pull-right"><i class="fa fa-print"></i></a>
                                </a>
                            </h4>
                        </div>
                        <div id="principaux<?= $x; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $x; ?>">
                            <div class="panel-body">
                                <div class="row center noPadding">
                                    <h4 class="hrblack">Type de surface</h4>
                                </div>
                                <div class="row center ">
                                    <div class="col-md-3"><?php if($lot->type_surface[0] == "1"){echo "Plancher/brute";}else{echo "<s>Plancher/brute</s>";}?></div>
                                    <div class="col-md-3"><?php if($lot->type_surface[1] == "1"){echo "Habitable";}else{echo "<s>Habitable</s>";}?></div>
                                    <div class="col-md-3"><?php if($lot->type_surface[2] == "1"){echo "Utile";}else{echo "<s>Utile</s>";}?></div>
                                    <div class="col-md-3"><?php if($lot->type_surface[3] == "1"){echo "Terrain";}else{echo "<s>Terrain</s>";}?></div>
                                </div>
                                <div class="row noPadding">
                                    <div class="col-md-5 col-md-offset-1 borderRight">
                                        <h4 class="hrblack center">Numéros</h4><br/>
                                    <h5>Numéro du Lot : <?= $lot->numero_lot; ?></h5>
                                    <h5>Numéro de Copro : <?= $lot->numero_copro; ?></h5>
                                    <h5>Numéro Postal : <?= $lot->numero_postal; ?></h5>
                                    <h5>Numéro du PDL EDF : <?= $lot->numero_pdl_edf; ?></h5>
                                    </div>                                    
                                    <div class="col-md-5 col-md-offset-1">
                                        <h4 class="hrblack center">Pièces / Surfaces</h4><br/>
                                        <?php foreach($lot->surfaces as $piece){ ?>
                                        <h5><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
<path class="path" d="M14 7.001H2.999C1.342 7 0 8.3 0 10v11c0 1.7 1.3 3 3 3H14c1.656 0 3-1.342 3-3V10 C17 8.3 15.7 7 14 7.001z M14.998 21c0 0.551-0.447 1-0.998 1.002H2.999C2.448 22 2 21.6 2 21V10 c0.001-0.551 0.449-0.999 1-0.999H14c0.551 0 1 0.4 1 0.999V21z"></path>
<path class="path" d="M14.266 0.293c-0.395-0.391-1.034-0.391-1.429 0c-0.395 0.39-0.395 1 0 1.415L13.132 2H3.869l0.295-0.292 c0.395-0.391 0.395-1.025 0-1.415c-0.394-0.391-1.034-0.391-1.428 0L0 3l2.736 2.707c0.394 0.4 1 0.4 1.4 0 c0.395-0.391 0.395-1.023 0-1.414L3.869 4.001h9.263l-0.295 0.292c-0.395 0.392-0.395 1 0 1.414s1.034 0.4 1.4 0L17 3 L14.266 0.293z"></path>
<path class="path" d="M18.293 9.734c-0.391 0.395-0.391 1 0 1.429s1.023 0.4 1.4 0L20 10.868v9.263l-0.292-0.295 c-0.392-0.395-1.024-0.395-1.415 0s-0.391 1 0 1.428L21 24l2.707-2.736c0.391-0.394 0.391-1.033 0-1.428s-1.023-0.395-1.414 0 l-0.292 0.295v-9.263l0.292 0.295c0.392 0.4 1 0.4 1.4 0s0.391-1.034 0-1.429L21 7L18.293 9.734z"></path>
</svg>&nbsp;&nbsp;<b><?= $piece->piece; ?> :</b>  <?= $piece->taille; ?> m²</h5>
                                        <?php } ?>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $x++;} ?>
            </div>
        </div>
        <div role="tabpanel" class="fade tab-pane" id="secondaire">
            <div class="panel-group" id="accordion-lots" role="tablist" aria-multiselectable="true">
                <?php $x=0; foreach ($secondaires as $lot) { ?>
                    <div class="panel panel-default" class="searchable" data-search="<?= $lot->reference.' '.$lot->numero_lot; ?>">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#secondaires<?= $x; ?>" aria-expanded="false" aria-controls="collapse<?= $x; ?>">
                                    <?= $lot->reference ." - Lot n° ". $lot->numero_lot; ?> <a href="<?= base_url('lot/modifier/'.$lot->id); ?>" class="pull-right"><i class="fa fa-gears"></i></a><a target="_blank" data-toggle="tooltip" title="" data-original-title="Imprimer la fiche du lot"  href="<?= base_url('lot/imprimer/'.$lot->id); ?>" style="margin-right:10px;" class="pull-right"><i class="fa fa-print"></i>
                                </a>
                            </h4>
                        </div>
                        <div id="secondaires<?= $x; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?= $x; ?>">
                             <div class="panel-body">
                                <div class="row center noPadding">
                                    <h4 class="hrblack">Type de surface</h4>
                                </div>
                                <div class="row center ">
                                    <div class="col-md-3"><?php if($lot->type_surface[0] == "1"){echo "Plancher/brute";}else{echo "<s>Plancher/brute</s>";}?></div>
                                    <div class="col-md-3"><?php if($lot->type_surface[1] == "1"){echo "Habitable";}else{echo "<s>Habitable</s>";}?></div>
                                    <div class="col-md-3"><?php if($lot->type_surface[2] == "1"){echo "Utile";}else{echo "<s>Utile</s>";}?></div>
                                    <div class="col-md-3"><?php if($lot->type_surface[3] == "1"){echo "Terrain";}else{echo "<s>Terrain</s>";}?></div>
                                </div>
                                <div class="row noPadding">
                                    <div class="col-md-5 col-md-offset-1 borderRight">
                                        <h4 class="hrblack center">Numéros</h4><br/>
                                    <h5>Numéro du Lot : <?= $lot->numero_lot; ?></h5>
                                    <h5>Numéro de Copro : <?= $lot->numero_copro; ?></h5>
                                    <h5>Numéro Postal : <?= $lot->numero_postal; ?></h5>
                                    <h5>Numéro du PDL EDF : <?= $lot->numero_pdl_edf; ?></h5>
                                    </div>                                    
                                    <div class="col-md-5 col-md-offset-1">
                                        <h4 class="hrblack center">Pièces / Surfaces</h4><br/>
                                        <?php foreach($lot->surfaces as $piece){ ?>
                                            <h5><b><?= $piece->piece; ?> :</b>  <?= $piece->taille; ?> m²</h5>
                                        <?php } ?>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $x++;} ?>
            </div>
        </div>
    </div>
</div>