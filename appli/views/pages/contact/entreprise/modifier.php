<div class="container">
    <br/>
        <form action='<?php echo site_url("entreprise/modifier/$entreprise->id"); ?>' id='formulaire' method="post" accept-charset="utf-8">
        <fieldset>

            <!-- Form Name -->
            <legend>Modifier l'entreprise <?php echo $entreprise->nom; ?></legend>
            <div class="row-centered" style="margin:0;">
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="nom">Nom : *</label>  
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="nom" name="nom" placeholder="Nom de l'entreprise" class="form-control" required="" value="<?php echo $entreprise->nom; ?>" type="text">
                    <?php echo form_error('nom'); ?>
                </div>
            </div>

            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="siret">Siret : </label>  
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="nom" name="siret" placeholder="Siret de l'entreprise" class="form-control" value="<?php echo $entreprise->siret; ?>" type="text">
                    <?php echo form_error('siret'); ?>
                </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="adresse">Adresse 1 :</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="adresse1" name="adresse1" type="text" placeholder="Adresse" value="<?php echo $entreprise->adresse1; ?>" class="form-control">
                    <?php echo form_error('adresse1'); ?>
                </div>
            </div>        
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="adresse">Adresse 2 :</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="adresse2" name="adresse2" type="text" placeholder="Adresse" value="<?php echo $entreprise->adresse2; ?>" class="form-control">
                    <?php echo form_error('adresse2'); ?>
                </div>
            </div>        
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="adresse">Adresse 3 :</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="adresse3" name="adresse3" type="text" placeholder="Adresse" value="<?php echo $entreprise->adresse3; ?>" class="form-control">
                    <?php echo form_error('adresse3'); ?>
                </div>
            </div>        
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="codepostal">Code postal : *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="codepostal" name="codepostal" type="text" placeholder="Code Postal" value="<?php echo $entreprise->cp; ?>" class="form-control">
                    <?php echo form_error('codepostal'); ?>
                </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="ville">Ville : *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="ville" name="ville" type="text" placeholder="Ville" value="<?php echo $entreprise->ville; ?>" class="form-control">
                    <?php echo form_error('ville'); ?>
                </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label col-sm-2 col-centered" for="commentaire">Commentaire :</label>
              <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">                     
                <textarea class="col-xs-12" id="commentaire" name="commentaire">
                <?php echo $entreprise->commentaire; ?>
                </textarea>
                <?php echo form_error('commentaire'); ?>
              </div>
            </div>
            <!-- TypeAhead input-->
            <div class="form-group paddingTop"> 
                <div class="col-md-3 col-md-offset-1 noPadding">
                </div>
                <div class="col-md-6 noPadding">
                    <select data-placeholder="Choisissez un employé ou plusieurs..." id="select-entreprise" class="chosen-select" multiple style="width:100%;" tabindex="4">
                        <?php foreach($contacts as $contact){?>
                        <option value="<?php echo $contact->id; ?>"><?php echo $contact->nom.' '. $contact->prenom; ?></option>
                        <?php } ?>
                    </select>
                </div>             
            </div>
            
            <!-- Liste input-->
            <div class="form-group paddingTop"> 
                <div class="col-md-12 noPadding ent-list">
                    
                </div>                
            </div>
            
            <input type='hidden' name='data' id='data'/>
            
            <!-- Button -->
            <div class="col-xs-12">
                    <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Annuler"/>
                    <input type="submit" class="btn btn-success pull-right" id="form_contact" value="Modifier"/>
            </div>
            </div>
        </fieldset>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript" src="<?php echo js_url('contact'); ?>"></script>