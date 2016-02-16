<div class="detail-marche container">
    <br/>
    <?php echo form_open('avenant/creer/'.$id_marche); ?>
    <fieldset>
        <legend>
            Créer un avenant
        </legend>
        <div class="form-facture row-centered" style="margin:0;">
            <h3>Entreprise : </h3>
            <!-- TypeAhead input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Entreprise *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <select data-placeholder="Choisissez une entreprise" name="entreprise" id="select-entreprise" class="chosen-select" style="width:100%;" tabindex="4">
                        <?php foreach($entreprises as $entreprise){?>
                            <option value="<?php echo $entreprise->id; ?>"><?php echo $entreprise->nom.' '. $entreprise->ville; ?></option>
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
                    <input id="budget" name="objet" type="text" value="<?php echo set_value('objet'); ?>" class="form-control">
                    <?php echo form_error('objet'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Date *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="date" placeholder="DD-MM-YYYY" type="text" value="<?php echo set_value('date'); ?>" class="form-control">
                        <?php echo form_error('date'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Numero *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="numero" type="text" value="<?php echo set_value('numero'); ?>" class="form-control">
                        <?php echo form_error('numero'); ?>
                </div>
            </div>
            <h3>Montant : </h3>
            <!-- Number input-->
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">Montant HT *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="montantHT" type="number" value="<?php echo set_value('montantHT'); ?>" class="form-control">
                        <?php echo form_error('montantHT'); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label col-sm-2 col-centered" for="budget">TVA *</label>
                <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                    <input id="budget" name="tva" type="number" value="<?php echo set_value('tva'); ?>" class="form-control">
                        <?php echo form_error('tva'); ?>
                </div>
            </div>
            
            <div class="col-xs-12">
                <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
                <input type="submit" class="btn btn-info pull-right" id="form_contact" value="Créer"/>
            </div>                    
    </fieldset>
    <?php echo form_close(); ?>
</div>


