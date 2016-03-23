<div class="container">
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        <a href="<?php echo base_url() . 'mail/envoyer/'; ?>" class="btn btn-info pull-right"><i class="fa fa-paper-plane"></i>&nbsp;Envoyer un email</a> 
    </div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#tous" aria-controls="tous" role="tab" data-toggle="tab">Tous</a></li>
        <?php
        $x = 0;
        foreach ($expediteurs as $key => $value) {
            echo '<li role="presentation"><a href="#' . $x . '" aria-controls="' . $x . '" role="tab" data-toggle="tab">' . explode('@', $value->expediteur)[0] . '</a></li>';
            $x++;
        }
        ?>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="tous">
            <ul class="list-group">
                <?php foreach ($tout as $email) { ?>


                    <li class="list-group-item">
                        <span class="badge"><?= "Le " . conv_date($email->date) . " à " . $email->heure; ?></span>
                        <a href='<?= base_url("mail/details/" . $email->id); ?>'><?= $email->sujet ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <?php
        $x = 0;
        foreach ($expediteurs as $key => $value) {
            echo '<div role="tabpanel" class="tab-pane fade" id="' . $x . '">';
            foreach ($tout as $email) {
                if ($email->expediteur == $value->expediteur) {
                    ?>


                    <li class="list-group-item">
                        <span class="badge"><?= "Le " . conv_date($email->date) . " à " . $email->heure; ?></span>
                        <a href='<?= base_url("mail/details/" . $email->id); ?>'><?= $email->sujet ?></a>
                    </li>
                <?php
                }
            }
            echo '</div>';
            $x++;
        }
        ?>

    </div>

</div>