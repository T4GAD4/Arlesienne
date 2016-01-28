<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>"/>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        
        
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h1>
                    Créer un bug
                    <a href="<?php echo base_url().'bugs/dashboard/'; ?>" class="btn btn-default pull-right" role="button">Retour aux bugs</a>
                </h1>
                <hr/>
            </div>

            <?php echo form_open_multipart('bugs/dashboard/add'); ?>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group col-md-12">
                          <label for="titre">Titre du bug</label>
                          <input type="text" name="titre" value="<?= set_value('titre'); ?>" class="form-control" id="titre" placeholder="Titre du bug...">
                          <?php echo form_error('titre'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group col-md-12">
                          <label for="Categorie">Categorie</label>
                          <select name="categorie"  class="form-control">
                              <option value="chancellerie" <?php set_select('categorie','chancellerie',true); ?>>Chancellerie</option>
                              <option value="technique" <?= set_select('categorie','technique'); ?>>Technique</option>
                              <option value="commercial" <?= set_select('categorie','commercial'); ?>>Commercial</option>
                              <option value="autres" <?= set_select('categorie','autres'); ?>>Autres</option>
                          </select>
                          <?php echo form_error('categorie'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group col-md-12">
                          <label for="urgence">Urgence</label>
                          <select name="urgence"  class="form-control">
                              <option value="information" <?php set_select('urgence','information',true); ?>>Information</option>
                              <option value="bug" <?= set_select('urgence','bug'); ?>>Bug</option>
                              <option value="urgent" <?= set_select('urgence','urgent'); ?>>Urgent</option>
                              <option value="idee" <?= set_select('urgence','idee'); ?>>Idée</option>
                          </select>
                          <?php echo form_error('urgence'); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group col-md-12">
                          <label for="explication">Descriptif du bug</label>
                          <textarea name="explication" placeholder="Soyez le plus précis possible, les explications nous aident nous les développeurs à interpréter et résoudre les problèmes rapidement." class="form-control" rows="7"><?= set_value('explication'); ?></textarea>
                        </div>
                        <?php echo form_error('explication'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group col-md-12 pull-right">
                            <button type="submit" class="btn btn-default pull-right">Créer</button>
                        </div>
                    </div>
                </div>
            <?php echo  form_close(); ?>
        </div>
    </body>
</html>