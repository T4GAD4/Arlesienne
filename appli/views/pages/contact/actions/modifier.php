<div class="container">
    <br/>
    <form action='<?php echo site_url("actionsContacts/modifier/".$action->id); ?>' id='formulaire' method="post" accept-charset="utf-8">

        <fieldset>
            <legend>
                Modification de l'action : 
            </legend>
            <div class="row-centered" style="margin:0;">
                <!-- Date input-->
                <div class="form-group paddingTop">
                    <label class="col-md-2 control-label col-md-offset-2" for="date">Date :</label> 
                    <div class='col-md-6 input-group date' id='datetimepicker'>
                        <input type='text' name="date" value="<?php echo set_value('date', $action->date); ?>" class="input-md form-control" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar">
                            </span>
                        </span>
                        <?php echo form_error('date'); ?>
                    </div>
                </div>
                <div class="row" style="margin:0;">
                    <div class="control-group">
                        <label class="control-label col-sm-3 col-centered" for="">Commentaire : </label>
                        <div class="controls col-xs-12 col-sm-8 col-md-8 col-centered">
                            <textarea name="commentaire" type="text" placeholder="" class="form-control"><?= set_value('commentaire',$action->commentaire); ?></textarea>
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
