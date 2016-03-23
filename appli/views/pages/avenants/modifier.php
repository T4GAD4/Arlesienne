<div class="detail-marche container">
    <br/>
    <?php echo form_open('avenant/modifier/'.$avenant->id); ?>
    <fieldset>
        <legend>
            Modifier l'avenant
        </legend>
        <div class="form-facture row-centered" style="margin:0;">
            <h3>Entreprise : </h3>
            <!-- TypeAhead input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Entreprise *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <select data-placeholder="Choisissez une entreprise" name="entreprise" id="select-entreprise" class="chosen-select" style="width:100%;" tabindex="4">
                        <option value="NULL">Aucune entreprise</option>
                        <?php foreach($entreprises as $entreprise){?>
                            <option value="<?php echo $entreprise->id; ?>" <?php if($entreprise->id == intval($avenant->idEntreprise)){ echo 'selected'; }?>><?php echo $entreprise->nom.' '. $entreprise->ville; ?></option>
                        <?php } ?>
                    </select>
                    <?php echo form_error('entreprise'); ?>
                </div>
            </div>
            <h3>Général : </h3>
            <!-- Number input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Objet *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="objet" type="text" value="<?php echo $avenant->objet ?>" class="form-control">
                    <?php echo form_error('objet'); ?>
                </div>
            </div>
            <!-- Date input-->
            <div class="form-group paddingTop">
                <label class="col-md-2 control-label col-md-offset-2" for="date">Date :</label> 
                <div class='col-md-6 input-group date' id='datetimepicker'>
                    <input type='text' name="date" value="<?php echo $avenant->date ?>" class="input-md form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar">
                        </span>
                    </span>
                    <?php echo form_error('date'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Numero *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="numero" type="text" value="<?php echo $avenant->numero ?>" class="form-control">
                        <?php echo form_error('numero'); ?>
                </div>
            </div>
            <h3>Montant : </h3>
            <!-- Number input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Montant HT *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="montantHT" type="text" value="<?php echo $avenant->montantHT ?>" class="form-control">
                        <?php echo form_error('montantHT'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">TVA *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="tva" type="number" value="<?php echo $avenant->TVA ?>" class="form-control">
                        <?php echo form_error('tva'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Montant TTC</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="ttc" type="text" class="form-control">
                </div>
            </div>
            <div class="col-xs-12">
                <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
                <input type="submit" class="btn btn-info pull-right" id="form_contact" value="Modifier"/>
            </div>                    
    </fieldset>
    <?php echo form_close(); ?>
</div>
        
<script>
    $(function(){
        $('#ttc').on('blur', function(){
            var ttc = $(this).val();
            var tva = $('[name=tva]').val();
            if(ttc != ''){
                var ht = ttc / (1 + (tva/100));
                ht = ht.toFixed(2);
                $('[name=montantHT]').val(ht);
            }
        });
        
        $('[name=tva]').on('blur', function(){
            var tva = $(this).val();
            var ttc = $('#ttc').val();
            if(ttc != ''){
                var ht = ttc / (1 + (tva/100));
                ht = ht.toFixed(2);
                $('[name=montantHT]').val(ht);
            }
        });
    });
</script>