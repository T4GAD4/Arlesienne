<div class="container">
    <br/>
    <form action="<?php echo site_url('projet/modifier/'.$projet->id); ?>" id='formulaire' method="post" accept-charset="utf-8">
        <fieldset>
            <legend>
                Modifier le projet : <?php echo $projet->nom; ?> 
            </legend>
            <input id="idCompte" name="idCompte" type="idCompte" value="<?php echo $projet->idCompte; ?>" class="hidden form-control">
            <div class="row-centered" style="margin:0;">
                <!-- Text input-->
                <div class="control-group">
                    <label class="control-label col-sm-2 col-centered" for="nom">Nom *</label>
                    <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                        <input id="nom" name="nom" type="text" placeholder="" class="form-control" value="<?php echo $projet->nom; ?>" required>
                        <?php echo form_error('nom'); ?>
                    </div>
                </div>
                <!-- Number input-->
                <div class="control-group">
                    <label class="control-label col-sm-2 col-centered" for="budget">Budget *</label>
                    <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                        <input id="budget" name="budget" type="number" value="<?php echo $projet->budget; ?>" class="form-control">
                        <?php echo form_error('budget'); ?>
                    </div>
                </div>
                <!-- Select input-->
                <div class="control-group">
                    <label class="control-label col-sm-2 col-centered" for="etat">Etat *</label>
                    <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered ">
                        <select id="etat" name="etat" class="form-control">
                            <option value="<?php echo $projet->etat; ?>"><?php echo $projet->etat; ?></option>
                            <?php 
                            foreach($select_etat as $etat){
                                ?>
                                <option value="<?php echo $etat; ?>"><?php echo $etat; ?></option>
                                <?php
                            } 
                            ?>
                        </select>
                    </div>
                </div>
                <!-- Select input -->
                <div class="control-group">
                    <label class="control-label col-sm-2 col-centered" for="societe">Société *</label>
                    <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered ">
                        <select id="societe" name="societe" class="form-control">
                            <?php
                            foreach($societes as $societe){
                                if($societe->id==$projet->idSociete){?>
                                <option value="<?php echo $societe->id; ?>"><?php echo $societe->nom; ?></option><?php }
                            }  
                            foreach($societes as $societe){
                                ?>
                                <option value="<?php echo $societe->id; ?>"><?php echo $societe->nom; ?></option>
                                <?php
                            } 
                            ?>
                        </select>
                    </div>
                </div>
                <!-- Select input societe -->
                <div class="control-group">
                    <label class="control-label col-sm-2 col-centered" for="compte">Compte *</label>
                    <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered ">
                        <select id="compte" name="compte" class="form-control">

                        </select>
                </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="adresse">Adresse *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="adresse" name="adresse" type="text" placeholder="" value="<?php echo $projet->adresse; ?>" class="form-control">
                    <?php echo form_error('adresse'); ?>
                </div>
            </div>        
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="codepostal">Code postal *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="codepostal" name="codepostal" type="text" placeholder="" value="<?php echo $projet->cp; ?>" class="form-control">
                    <?php echo form_error('codepostal'); ?>
                </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="ville">Ville *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="ville" name="ville" type="text" placeholder="" value="<?php echo $projet->ville; ?>" class="form-control">
                    <?php echo form_error('ville'); ?>
                </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
              <label class="control-label col-sm-2 col-centered" for="commentaire">Commentaire</label>
              <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">                     
                <textarea class="col-xs-12" id="commentaire" name="commentaire"><?php echo $projet->commentaire; ?></textarea>
                <?php echo form_error('commentaire'); ?>
            </div>
        </div>
        <div class="col-xs-12">
            <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Annuler"/>
            <input type="submit" class="btn btn-success pull-right" id="form_contact" value="Modifier"/>
        </div>                    
    </fieldset>
    <?php echo form_close(); ?>
</div>
</div>
<script type="text/javascript" src="<?php echo js_url('pages/projet'); ?>"></script>