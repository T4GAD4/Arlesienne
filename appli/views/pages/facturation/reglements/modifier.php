<div class="container detail-projet">
    <br/>
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
    </div>
</div>
<div class="row">
    <div class="row reglement-details">
        <div class="col-md-6 col-md-offset-3">
            <h1 class="hr center">Modifier réglement</h1>
            <?php echo form_open('facturation/modifier_reglement/'.$id_facture.'/'.$reglement->id); ?>
            <div style="padding:5px;">
                <input class="form-control" type="text" name="montant" value="<?php echo $reglement->montant; ?>" placeholder="Montant payé...">
                <?php echo form_error('montant'); ?>
                <p>Société en charge du réglement :</p>
                <select class="form-control" name="societe" id="societeliste">
                    <?php foreach ($societes as $societe) { ?>
                        <option value="<?php echo $societe->id; ?>" <?php if($societe->id == $reglement->societe->id){echo'selected';} ?>><?php echo $societe->nom; ?></option>
                    <?php } ?>
                </select>
                <p>Compte débité :</p>
                <select class="form-control" name="compte">
                    <?php foreach ($comptes as $compte) { ?>
                        <option value="<?php echo $compte->id; ?>" <?php if($compte->id == $reglement->compte->id){echo'selected';} ?>><?php echo $compte->banque . " | " . $compte->numero; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="row reglement-btn">
                <div class="col-md-10 text-left">
                    <input type="submit" class="btn small btn-success" value="Modifier"/>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>