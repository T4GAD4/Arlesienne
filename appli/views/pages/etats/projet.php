<div class="container">
    <div class="row white">
        <h2 class="hr white center">Synthése projet</h2>
        <div class="col-md-6 col-md-offset-3">
            <?= form_open(base_url("etats/projet/generer")); ?>
            <div class="row">
                <div class="col-md-12">
                    <select name="projet" class="form-control">
                        <?php foreach($projets as $projet){ ?>
                        <option value="<?= $projet->id; ?>"><?= $projet->nom; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <input type="submit" value="Générer" class="btn btn-success pull-right"/>
            <?= form_close(); ?>
        </div>
    </div>
</div>