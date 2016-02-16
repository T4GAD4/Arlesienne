<div class="container">
    <br/>
    <form action='<?php echo site_url("lot/modifier/$lot->id"); ?>' method="post" accept-charset="utf-8">
        <fieldset>
            <legend>
                Modification du lot n°<?= $lot->numero_lot; ?>
            </legend>
        </fieldset>
        <div class='col-md-12'>
            <!-- Switcher input-->
            <div class="form-group paddingTop">
                <label class="control-label col-sm-3 col-centered" for="actif">Type de lot :</label>  
                <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered" style='text-align:center;'>
                    <h5 style='color:whitesmoke;'><input type="radio" value="principal" name="type" <?php if($lot->type == "principal"){echo "checked";}?>/>&nbsp;&nbsp;Lot principal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="secondaire" name="type" <?php if($lot->type == "secondaire"){echo "checked";}?>/>&nbsp;&nbsp;Lot secondaire</h5>
                <?php echo form_error('type'); ?>
                    </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">Typologie : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered" style='text-align:center;'>
                        <h5 style='color:whitesmoke;'><input name='type_surface[plancher_brute]' type="checkbox" value='1' <?php if($lot->type_surface[0] == "1"){echo "checked";}?>/> Plancher/brute&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='type_surface[habitable]' <?php if($lot->type_surface[1] == "1"){echo "checked";}?> type="checkbox" value='1'/> Habitable&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='type_surface[utile]' <?php if($lot->type_surface[2] == "1"){echo "checked";}?> type="checkbox" value='1'/> Utile&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='type_surface[terrain]' <?php if($lot->type_surface[3] == "1"){echo "checked";}?> type="checkbox" value='1'/> Terrain</h5>
                    <?php echo form_error('type_surface'); ?>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">N° du lot : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <input id="numero_lot" name="numero_lot" type="text" placeholder="" class="form-control" value="<?= set_value('numero_lot',$lot->numero_lot); ?>" >
                        <?php echo form_error('numero_lot'); ?>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">N° de copropriété : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <input id="numero_copro" name="numero_copro" type="text" placeholder="" class="form-control" value="<?= set_value('numero_copro',$lot->numero_copro); ?>" >
                        <?php echo form_error('numero_copro'); ?>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">N° postal : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <input id="numero_postal" name="numero_postal" type="text" placeholder="" class="form-control" value="<?= set_value('numero_postal',$lot->numero_postal); ?>" >
                        <?php echo form_error('numero_postal'); ?>
                    </div>
                </div>
            </div>
            <div class="row" style="margin:0;">
                <div class="control-group">
                    <label class="control-label col-sm-3 col-centered" for="">N° PDL EDF : </label>
                    <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                        <input id="numero_pdl_edf" name="numero_pdl_edf" type="text" placeholder="" class="form-control" value="<?= set_value('numero_pdl_edf',$lot->numero_pdl_edf); ?>" >
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
                            <?php if(isset($pieces)){
                                foreach($pieces as $piece){?>
                                <tr><td><input name="pieces_existantes[]" type="text" placeholder="" class="form-control" value="<?= $piece->piece; ?>"></td><td><input id="surface" name="surfaces_existantes[]" type="text" placeholder="" class="form-control" value="<?= $piece->taille; ?>"><input type="hidden" name="id_existants[]" value="<?= $piece->id; ?>"/></td></tr>
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
                        <textarea name="description" type="text" placeholder="" class="form-control"><?= $lot->description; ?></textarea>
                        <?php echo form_error('description'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Annuler"/>
                    <input type="submit" class="btn btn-info pull-right" value="Modifier"/>
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