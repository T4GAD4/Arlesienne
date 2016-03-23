<div class="container">
    <br/>
    <form action='<?php echo site_url("rappel/modifier/".$rappel->id); ?>' id='formulaire' method="post" accept-charset="utf-8">

        <fieldset>
            <legend>
                Modification du rappel : 
            </legend>
            <div class="row-centered" style="margin:0;">
                <!-- Date input-->
                <div class="form-group paddingTop">
                    <label class="col-md-2 control-label col-md-offset-2" for="date">Date :</label> 
                    <div class='col-md-6 input-group date' id='datetimepicker'>
                        <input type='text' name="date" value="<?php echo set_value('date', $rappel->date); ?>" class="input-md form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar">
                            </span>
                        </span>
                        <?php echo form_error('date'); ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label col-sm-2 col-centered" for="budget">Heure *</label>
                    <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                        <input id="heure" name="heure" placeholder="10:20" type="text" value="<?php echo set_value('heure',$rappel->heure); ?>" class="form-control">
                        <?php echo form_error('heure'); ?>
                    </div>
                </div>
                <div class="row" style="margin:0;">
                    <div class="control-group">
                        <label class="control-label col-sm-2 col-centered" for="">Commentaire : </label>
                        <div class="controls col-xs-12 col-sm-8 col-md-6 col-centered">
                            <textarea name="commentaire" type="text" placeholder="" class="form-control"><?= set_value('commentaire',$rappel->commentaire); ?></textarea>
                            <?php echo form_error('commentaire'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Annuler"/>
                    <input type="submit" class="btn btn-success pull-right" id="form_contact" value="Modifier"/>
                </div>
            </div>          
        </fieldset>
        <?php echo form_close(); ?>
</div>
