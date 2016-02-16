<div class="container">
    <br/>
    <form action='<?php echo site_url("rappel/creer/".$contact->id); ?>' id='formulaire' method="post" accept-charset="utf-8">

        <fieldset>
            <legend>
                Créer un rappel pour le contact <?= $contact->nom . ' ' . $contact->prenom; ?> :  
            </legend>
            <div class="row-centered" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-2 col-centered" for="budget">Date *</label>
                    <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                        <input id="date" name="date" placeholder="DD-MM-YYYY" type="text" value="<?php echo set_value('date', Date("d-m-Y")); ?>" class="form-control">
                        <?php echo form_error('date')." Le format est DD-MM-YYYY"; ?>
                    </div>
                </div>
                <div class="row" style="margin:0;">
                    <div class="control-group">
                        <label class="control-label col-sm-2 col-centered" for="">Commentaire : </label>
                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                            <textarea name="commentaire" type="text" placeholder="" class="form-control"><?= set_value('commentaire'); ?></textarea>
                            <?php echo form_error('commentaire'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Annuler"/>
                    <input type="submit" class="btn btn-success pull-right" id="form_contact" value="Créer"/>
                </div>
            </div>          
        </fieldset>
        <?php echo form_close(); ?>
</div>
