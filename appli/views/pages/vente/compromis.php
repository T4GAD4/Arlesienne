<div class="container">
    <br/>
    <form action='<?php echo site_url("vente/compromis/$vente->id"); ?>' method="post" accept-charset="utf-8">
        <fieldset>
            <legend>
                Mettre la vente sous compromis
            </legend>
        </fieldset>
        <div class='col-md-12'>
            <?php foreach($vente->lots as $lot){ ?>
            <div class="col-md-12 center marginBottom">
                <h4 class="white hr">Prix Compromis Lot n°<?= $lot->numero_lot; ?></h4>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">Prix net vendeur : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <input id="<?= $lot->id; ?>prixnetvendeur" name="<?= $lot->id; ?>prixnetvendeur" type="text" placeholder="" class="form-control" value="<?= set_value($lot->id.'prixnetvendeur'); ?>" >
                        <?php echo form_error($lot->id.'prixnetvendeur'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group paddingTop">
                <label class="control-label col-sm-3 col-centered" for="<?= $lot->id; ?>typeTVA">Type TVA :</label>  
                <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered" style='text-align:center;'>
                    <h5 style='color:whitesmoke;'><input type="radio" value="montant" name="<?= $lot->id; ?>typeTVA" <?php if(set_value($lot->id.'typeTVA') == "montant"){echo "checked";} ?>/>&nbsp;&nbsp;Montant&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="pourcentage" name="<?= $lot->id; ?>typeTVA" <?php if(set_value($lot->id.'typeTVA') == "pourcentage"){echo "checked";} ?>/>&nbsp;&nbsp;Pourcentage</h5>
                <?php echo form_error($lot->id.'typeTVA'); ?>
                    </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">TVA : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <input id="<?= $lot->id; ?>tvaprixnetvendeur" name="<?= $lot->id; ?>tvaprixnetvendeur" type="text" placeholder="" class="form-control" value="<?= set_value($lot->id.'tvaprixnetvendeur'); ?>" >
                        <?php echo form_error($lot->id.'tvaprixnetvendeur'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group paddingTop">
                <label class="control-label col-sm-3 col-centered" for="<?= $lot->id; ?>typefraisagence">Type de frais d'agence :</label>  
                <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered" style='text-align:center;'>
                    <h5 style='color:whitesmoke;'><input type="radio" value="acquereur" name="<?= $lot->id; ?>typefraisagence" <?php if(set_value($lot->id.'typefraisagence') == "acquereur"){echo "checked";} ?>/>&nbsp;&nbsp;Charge acquéreur&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="vendeur" name="<?= $lot->id; ?>typefraisagence" <?php if(set_value($lot->id.'typefraisagence') == "vendeur"){echo "checked";} ?>/>&nbsp;&nbsp;Charge vendeur</h5>
                <?php echo form_error($lot->id.'typefraisagence'); ?>
                    </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">Frais d'agence TTC : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <input id="fraisagence" name="<?= $lot->id; ?>fraisagence" type="text" placeholder="" class="form-control" value="<?= set_value($lot->id.'fraisagence'); ?>" >
                        <?php echo form_error($lot->id.'fraisagence'); ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="row">
                <div class="col-xs-12">
                    <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Annuler"/>
                    <input type="submit" class="btn btn-success pull-right" value="Créer"/>
                </div>
            </div>
        </div>
    </form>
</div>