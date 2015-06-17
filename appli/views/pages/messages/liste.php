<div class="container">
    <br/>
    <div class="row parametres">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
    </div>
    <input id="search" type="text" class="input-md form-control" placeholder="Rechercher..."/>
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#nonlus" aria-controls="nonlus" role="tab" data-toggle="tab">Messages non lus</a></li>
        <li role="presentation"><a href="#lus" aria-controls="profile" role="tab" data-toggle="tab">Messages lus</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" id="nonlus">

            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <?php
                $x = 0;
                foreach ($non_lus as $message) {
                    $x++;
                    ?>
                    <div class="panel panel-default searchable non_lus" data-id="<?php echo $message->id; ?>" data-search="<?php echo $message->expediteur[0]->nom . ' ' . $message->expediteur[0]->prenom; ?>">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $message->id; ?>" aria-expanded="false" aria-controls="collapseOne">
                                    <span class="not-color">
                                        <?php echo $message->expediteur[0]->nom . ' ' . $message->expediteur[0]->prenom; ?>
                                        <span class="pull-right not-color"><?php echo 'Le ' . conv_date($message->date) . ' à ' . $message->heure; ?></span>
                                    </span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse<?php echo $message->id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <span class="not-color"><?php echo $message->Message; ?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

        </div>
        <div role="tabpanel" class="tab-pane fade" id="lus">

            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <?php
                $x = 0;
                foreach ($lus as $message) {
                    $x++;
                    ?>
                    <div class="panel panel-default searchable lus" data-id="<?php echo $message->id; ?>" data-search="<?php echo $message->expediteur[0]->nom . ' ' . $message->expediteur[0]->prenom; ?>">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $message->id; ?>" aria-expanded="false" aria-controls="collapseOne">
                                    <span class="not-color">
                                        <?php echo $message->expediteur[0]->nom . ' ' . $message->expediteur[0]->prenom; ?>
                                        <span class="pull-right not-color"><?php echo 'Le ' . conv_date($message->date) . ' à ' . $message->heure; ?></span>
                                    </span>
                                </a>
                            </h4>
                        </div>
                        <div id="collapse<?php echo $message->id; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                            <div class="panel-body">
                                <span class="not-color"><?php echo $message->Message; ?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

        </div>
    </div>
</div>