<div class="container">
    <br/>
    <form action='<?php echo site_url("contact/modifier/$contact->id"); ?>' id='formulaire' method="post" accept-charset="utf-8">
    <fieldset>
        <legend>
            Modifier <?php echo $contact->nom . ' ' . $contact->prenom; ?> : 
        </legend>
        <div class="row-centered" style="margin:0;">
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="civilite">Civilité</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered ">
                    <select id="civilite" name="civilite" class="form-control">
                        <?php
                        foreach ($select_contacts as $select) {
                            ?>
                            <option value='<?php echo $select; ?>'><?php echo $select; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="nom">Nom</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="nom" name="nom" type="text" placeholder="" class="form-control" value="<?php echo $contact->nom ?>" required>
                    <?php echo form_error('nom'); ?>
                </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="prenom">Prénom</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="prenom" name="prenom" type="text" placeholder="" value="<?php echo $contact->prenom ?>" class="form-control">
                    <?php echo form_error('prenom'); ?>
                </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="adresse">Adresse</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="adresse" name="adresse" type="text" placeholder="" value="<?php echo $contact->adresse; ?>" class="form-control">
                    <?php echo form_error('adresse'); ?>
                </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="codepostal">Code postal</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="codepostal" name="codepostal" type="text" placeholder="" value="<?php echo $contact->cp; ?>" class="form-control">
                    <?php echo form_error('codepostal'); ?>
                </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="ville">Ville</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="ville" name="ville" type="text" placeholder="" value="<?php echo $contact->ville; ?>" class="form-control">
                    <?php echo form_error('ville'); ?>
                </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="fixe">Fixe</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="fixe" name="fixe" type="text" placeholder="" value="<?php echo $contact->fixe; ?>" class="form-control">
                    <?php echo form_error('fixe'); ?>
                </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="portable">Portable</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="portable" name="portable" type="text" placeholder="" value="<?php echo $contact->portable; ?>" class="form-control">
                    <?php echo form_error('portable'); ?>
                </div>
            </div>
            <!-- Text input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="email">Email</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="email" name="email" type="text" placeholder="" value="<?php echo $contact->email; ?>" class="form-control">
                    <?php echo form_error('email'); ?>
                </div>
            </div>
            <!-- Select des listes de diffusions-->
            <?php 
                $liste = json_decode($contact->data)->liste;
                $select = Array();
                foreach($liste as $key => $value){
                    array_push($select, $value);
                }
            ?>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="liste">Liste de diffusions</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <select data-placeholder="Choisissez une liste de diffusion ou plusieurs..." id="select-diffusion" class="chosen-select form-control" style="width:100%;" name="liste_diffusion" multiple tabindex="4">
                        <?php foreach ($liste_diffusions as $liste_diffusion) { ?>
                        <option value="<?php echo $liste_diffusion; ?>" <?php if(in_array($liste_diffusion, $select)){echo "selected";} ?>>
                                <?php echo $liste_diffusion; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="autoentrepreneur"></label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered checkbox">
                    <input id="type" name='autoentrepreneur' type="checkbox" data-label-text="Autoentrepreneur" data-off-text="Non" data-on-text="Oui">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered col-centered" for="entreprise">Entreprise</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <select data-placeholder="Choisissez une entreprise ou plusieurs..." id="select-entreprise" class="chosen-select form-control col-xs-12" name="entreprise" multiple tabindex="4">
                        <?php foreach ($entreprises as $entreprise) { ?>
                            <option value="<?php echo $entreprise->id; ?>">
                                <?php echo $entreprise->nom; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 noPadding ent-list">
                </div>
            </div>
            <div class="control-group">
                <div class="col-md-12 text-center">
                    <label><button type="button" class="btn btn-success champs">Ajouter un champs personnalisé</button></label>
                </div>
            </div>
            <div id='champs_persos'>
                <?php foreach($contact_champs as $key => $value){?>
                
                <div class="form-group paddingTop champ_perso">
                    <input class="controls col-md-2 control-label col-centred labelEditable" placeholder="Votre nom de champs..." value ="<?php echo $key; ?>" style="opacity:0.85;text-align:right;"/>
                    <div class="controls col-md-6 col-centered">
                        <input class="inputEditable form-control input-md" type="text" value="<?php echo $value; ?>" placeholder="Votre champ...">
                    </div>
                    <i class="glyphicon glyphicon-remove-circle red remove-champs" style="position:relative;top:-3px;left:10px;"></i>
                </div>
                
                <?php } ?>
            </div>
            <input id="data" name='data' type="hidden">
            <input id="entreprises" name='entreprises' type="hidden">

            <div class="col-xs-12">
                <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Annuler"/>
                <input type="submit" class="btn btn-warning pull-right" id="form_contact" value="Modifier"/>
            </div>
        </div>
    </fieldset>
    <?php echo form_close(); ?>
</div>

<script>

    $(document).ready(function () {
  
        
        /*On va definir les listes selectionnés par le contact*/

        var entreprise = [];
<?php
foreach ($postes as $poste) {
    ?>
            entreprise.push("<?php echo $poste->entreprise->nom; ?>");
    <?php
}
?>
        $('#select-entreprise option').each(function () {
            if ($.inArray($(this).text().trim(), entreprise) >= 0) {
                $(this).attr('selected', true);
            }
        });
        
        
        $('[name=civilite] option').each(function () {
            if ($(this).val() == "<?php echo $contact->civilite; ?>") {
                $(this).attr('selected', true);
            }
        });
        

<?php if ($contact->autoentreprise == "true") { ?>
            $('[name=autoentrepreneur]').bootstrapSwitch('state', true);
            $('[name=autoentrepreneur]').bootstrapSwitch('disabled', true);
<?php } else { ?>
            $('[name=autoentrepreneur]').bootstrapSwitch('state', false);
            $('[name=autoentrepreneur]').bootstrapSwitch('disabled', true);
<?php } ?>
    
    $postes = '<?php echo str_replace("'","\'",json_encode($postes)); ?>';  
    
});
</script>
<script type="text/javascript" src="<?php echo js_url('contact'); ?>"></script>
