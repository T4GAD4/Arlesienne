<div class="container">
    <br/>
    <?php echo form_open('projet/modifier/'.$projet->url); ?>
    <fieldset>
        <legend>
            <?php echo $projet->nom; ?>
        </legend>
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
            <!-- Select input -->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="societe">Société *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered ">
                    <select id="societe" name="societe" class="form-control">
                        <?php
                        foreach ($societes as $societe) {
                            ?>
                            <option value="<?php echo $societe->id; ?>" <?php if($projet->idSociete == $societe->id){echo 'selected';} ?>><?php echo $societe->nom; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- Select input societe -->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="compte">Compte * </label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered ">
                    <select id="compte" name="compte" class="form-control">
                        <?php
                        foreach ($comptes as $compte) {
                        ?>
                            <option value="<?php echo $compte->id; ?>" <?php if($compte->id === $projet->idCompte){echo 'selected';}?>><?php echo $compte->banque.' | '.$compte->numero; ?></option>
                        <?php
                        }
                        ?>
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
                    <input id="codepostal" name="codepostal" type="number" placeholder="" value="<?php echo $projet->cp; ?>" class="form-control">
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
            <!-- Text input-->
            <!--<div class="control-group">
                <label class="control-label col-sm-2 col-centered">Ajouter un programme</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">                     
                    <i class=" col-xs-12 fa fa-plus-circle fa-size addchamps"></i>
                </div>
            </div>
            <div id="boxchamps">
                
                <?php 
                $i = 1;
                    foreach($programmes as $programme){
                ?>
                
                <div id="champs<?php echo $i; ?>" class="control-group champ">
                    <label class="control-label col-sm-2 col-centered">Programme <?php echo $i; ?></label>
                    <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                        <input type="text" disabled class="col-sm-10 col-md-10 col-xs-10 form-control" name="champs<?php echo $i; ?>" value="<?php echo $programme->nom; ?>"/>
                    </div>
                </div>
                <?php
                        $i++;
                    }
                ?>
                
            </div>
            <input type="hidden" name="number_champs" id="number_champs" value="<?php echo $nb_programmes; ?>"/>
            <input type="hidden" name="old_number_champs" id="number_champs" value="<?php echo $nb_programmes; ?>"/>-->
            <div class="col-xs-12">
                <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
                <input type="submit" class="btn btn-info pull-right" id="form_contact" value="Modifier"/>
            </div>                    
    </fieldset>
    <?php echo form_close(); ?>
    <span id="page" class="hidden">Modifier</span>
</div>
</div>
<script type="text/javascript" src="<?php echo js_url('pages/projet'); ?>"></script>