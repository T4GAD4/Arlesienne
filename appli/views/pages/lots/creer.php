<div class="container">
    <br/>
    <form action='<?php echo site_url("lot/creer/$projet->url"); ?>' method="post" accept-charset="utf-8">
        <fieldset>
            <legend>
                Création lot
            </legend>
            <h4 style="color:whitesmoke;text-align:center; margin-top:-20px;"><?= $projet->nom; ?></h4>
        </fieldset>
        <div class='col-md-12'>
            <!-- Switcher input-->
            <div class="form-group paddingTop">
                <label class="control-label col-sm-3 col-centered" for="actif">Type de lot :</label>  
                <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered" style='text-align:center;'>
                    <h5 style='color:whitesmoke;'><input type="radio" value="principal" name="type" <?= set_radio('type','principal'); ?>/>&nbsp;&nbsp;Lot principal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="secondaire" name="type" <?= set_radio('type','secondaire'); ?>/>&nbsp;&nbsp;Lot secondaire</h5>
                <?php echo form_error('type'); ?>
                    </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">Typologie : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered" style='text-align:center;'>
                        <h5 style='color:whitesmoke;'><input name='type_surface[plancher_brute]' type="checkbox" value='1' <?= set_checkbox('type_surface[plancher_brute]','1'); ?>/> Plancher/brute&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='type_surface[habitable]' <?= set_checkbox('type_surface[habitable]','1'); ?> type="checkbox" value='1'/> Habitable&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='type_surface[utile]' <?= set_checkbox('type_surface[utile]','1'); ?> type="checkbox" value='1'/> Utile&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='type_surface[terrain]' <?= set_checkbox('type_surface[terrain]','1'); ?> type="checkbox" value='1'/> Terrain</h5>
                    <?php echo form_error('type_surface'); ?>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">N° du lot : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <input id="numero_lot" name="numero_lot" type="text" placeholder="" class="form-control" value="<?= set_value('numero_lot'); ?>" >
                        <?php echo form_error('numero_lot'); ?>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">N° de copropriété : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <input id="numero_copro" name="numero_copro" type="text" placeholder="" class="form-control" value="<?= set_value('numero_copro'); ?>" >
                        <?php echo form_error('numero_copro'); ?>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">N° postal : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <input id="numero_postal" name="numero_postal" type="text" placeholder="" class="form-control" value="<?= set_value('numero_postal'); ?>" >
                        <?php echo form_error('numero_postal'); ?>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">N° PDL EDF : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <input id="numero_pdl_edf" name="numero_pdl_edf" type="text" placeholder="" class="form-control" value="<?= set_value('numero_pdl_edf'); ?>" >
                        <?php echo form_error('numero_pdl_edf'); ?>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">Surfaces : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <table id="surfaces">
                            <tr><td>Pièce</td><td>Surface</td></tr>
                            <?php if(isset($save_surfaces)){ 
                                foreach($save_surfaces as $piece => $surface){?>
                                <tr><td><input name="pieces[]" type="text" placeholder="" class="form-control" value="<?= $piece; ?>"></td><td><input id="surface" name="surfaces[]" type="text" placeholder="" class="form-control" value="<?= $surface; ?>"></td></tr>
                                <?php }} ?>
                            <tr><td><input name="pieces[]" type="text" placeholder="" class="form-control" value=""></td><td><input id="surface" name="surfaces[]" type="text" placeholder="" class="form-control" value=""></td></tr>
                            <tr><td><?php echo form_error('pieces[]');?></td><td><?php echo form_error('surfaces[]'); ?></td></tr>
                        </table>
                    </div>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-md-offset-3 col-centered" style="color:darkcyan; text-align: center; font-size:30px;">
                        <a href="#" id="ajout_surface"<i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">Description : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <textarea name="description" type="text" placeholder="" class="form-control"><?= set_value('description'); ?></textarea>
                        <?php echo form_error('description'); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <h2 class="hr">Prix initial</h2>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">Prix net vendeur : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <input id="prixnetvendeur" name="prixnetvendeur" type="text" placeholder="" class="form-control" value="<?= set_value('prixnetvendeur'); ?>" >
                        <?php echo form_error('prixnetvendeur'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group paddingTop">
                <label class="control-label col-sm-3 col-centered" for="typeTVA">Type TVA :</label>  
                <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered" style='text-align:center;'>
                    <h5 style='color:whitesmoke;'><input type="radio" value="montant" name="typeTVA" <?php if(set_value('typeTVA') == "montant"){echo "checked";} ?>/>&nbsp;&nbsp;Montant&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="pourcentage" name="typeTVA" <?php if(set_value('typeTVA') == "pourcentage"){echo "checked";} ?>/>&nbsp;&nbsp;Pourcentage</h5>
                <?php echo form_error('typeTVA'); ?>
                    </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">TVA : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <input id="tvaprixnetvendeur" name="tvaprixnetvendeur" type="text" placeholder="" class="form-control" value="<?= set_value('tvaprixnetvendeur'); ?>" >
                        <?php echo form_error('tvaprixnetvendeur'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group paddingTop">
                <label class="control-label col-sm-3 col-centered" for="typefraisagence">Type de frais d'agence :</label>  
                <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered" style='text-align:center;'>
                    <h5 style='color:whitesmoke;'><input type="radio" value="acquereur" name="typefraisagence" <?php if(set_value('typefraisagence') == "acquereur"){echo "checked";} ?>/>&nbsp;&nbsp;Charge acquéreur&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="vendeur" name="typefraisagence" <?php if(set_value('typefraisagence') == "vendeur"){echo "checked";} ?>/>&nbsp;&nbsp;Charge vendeur</h5>
                <?php echo form_error('typefraisagence'); ?>
                    </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">Frais d'agence TTC : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <input id="fraisagence" name="fraisagence" type="text" placeholder="" class="form-control" value="<?= set_value('fraisagence'); ?>" >
                        <?php echo form_error('fraisagence'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Annuler"/>
                    <input type="submit" class="btn btn-success pull-right" value="Créer"/>
                </div>
            </div>
        </div>
    </form>
</div>


<script>

    $(function () {
        $('#ajout_surface').on('click', function (e) {
            e.preventDefault();
            $('#surfaces').append('<tr height="5px"><td></td><td></td></tr>');
            $('#surfaces').append('<tr><td><input id="surface" name="pieces[]" type="text" placeholder="" class="form-control" value=""></td><td><input id="surface" name="surfaces[]" type="text" placeholder="" class="form-control" value=""></td></tr>');
        });
    });

</script>