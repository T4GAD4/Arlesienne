<div class="container">
    <div class="row white">
        <h2 class="hr white center">Synthése marché</h2>
        <div class="col-md-6 col-md-offset-3">
            <?= form_open(base_url("etats/marche/generer")); ?>
            <div class="row">
                <div class="col-md-12">
                    <select name="projet" class="form-control">
                        <?php foreach($projets as $projet){ ?>
                        <option value="<?= $projet->id; ?>"><?= $projet->nom; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <select name="categorie" class="form-control">
                        <option value="null">Selectionner une option</option>
                        <option value="Marchés travaux">Marchés de travaux</option>
                        <option value="Marchés études">Marchés d'étude</option>
                        <option value="Marchés concessionnaires">Marchés concessionnaires</option>
                    </select>
                </div>
            </div>
            <input type="submit" value="Générer" class="btn btn-success pull-right"/>
            <?= form_close(); ?>
        </div>
    </div>
</div>