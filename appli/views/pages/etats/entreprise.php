<div class="container">
    <div class="row white">
        <h2 class="hr white center">Synthése projet</h2>
        <div class="col-md-6 col-md-offset-3">
            <?= form_open(base_url("etats/entreprise/generer")); ?>
            <div class="row">
                <div class="col-md-12">
                    <select data-placeholder="Choisissez un projet ou plusieurs..." name="entreprise" class="chosen-select form-control">
                        <?php foreach($entreprises as $entreprise){ ?>
                        <option value="<?= $entreprise->id; ?>" <?= set_select("entreprise", $entreprise->id); ?>><?= $entreprise->nom; ?></option>
                        <?php } ?>
                    </select>
                    <?= form_error('entreprise'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <select data-placeholder="Choisissez un projet ou plusieurs..." id="select-projets" class="chosen-select form-control col-xs-12" name="projets[]" multiple tabindex="4">
                        <?php foreach($projets as $projet){?>
                        <option value="<?php echo $projet->id; ?>" <?= set_select("projets", $projet->id); ?>>
                            <?php echo $projet->nom; ?>
                        </option>
                        <?php } ?>
                    </select>
                    <?= form_error('projets'); ?> 
                </div>
            </div>
            <br/>
            <br/>
            <input type="submit" value="Générer" class="btn btn-success pull-right"/>
            <?= form_close(); ?>
        </div>
    </div>
</div>