<!-- Modal d'envoie de message! -->
<div class="modal fade" id="modal_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Envoi d'un message!</h4>
            </div>
            <div class="modal-body">
                <?php echo form_open() ?>

                <div class="form-group">
                    <label for="destinataire"></label>
                    <input class="form-control typeahead" type="text" name="destinataire" placeholder="Destinataire">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" class="form-control" placeholder="Entrez votre message..."></textarea>
                </div>

                <?php echo form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <button type="button" class="message_send btn btn-primary">Envoyer</button>
            </div>
        </div>
    </div>
</div>

<footer>
    <center>
        <h5 style="color:black">Application développé pour 
            <a href="http://www.saint-roch-habitat.fr" target="_blank">Saint Roch Habitat</a>
        </h5>
    </center> 
</footer>
</body>
<?php $style = json_decode($user[0]->style); ?>
<script type="text/javascript" src="<?php echo js_url('vendors/CIConfig'); ?>"></script>
<script type="text/javascript" src="<?php echo js_url('vendors/bootstrap.min'); ?>"></script>
<script type="text/javascript" src="<?php echo js_url('vendors/modernizr'); ?>"></script>
<script type="text/javascript" src="<?php echo js_url('vendors/moment'); ?>"></script>
<script type="text/javascript" src="<?php echo js_url('vendors/datetimepicker'); ?>"></script>
<script type="text/javascript" src="<?php echo js_url('vendors/bootstrap-switch.min'); ?>"></script>
<script type="text/javascript" src="<?php echo js_url('vendors/bootstrap-colorpicker.min'); ?>"></script>
<script type="text/javascript" src="<?php echo js_url('fancybox/jquery.fancybox'); ?>"></script>
<script type="text/javascript" src="<?php echo js_url('vendors/complexity'); ?>"></script>
<script type="text/javascript" src="<?php echo js_url('vendors/gridster.min'); ?>"></script>
<script type="text/javascript" src="<?php echo js_url('vendors/typeahead'); ?>"></script>
<script type="text/javascript" src="<?php echo js_url('vendors/notify'); ?>"></script>
<script type="text/javascript" src="<?php echo js_url('vendors/chosen.min'); ?>"></script>
<script type="text/javascript" src="<?php echo js_url('scriptAurelien'); ?>"></script>
<script>
    $(document).ready(function () {
        $('.navbar-default').css({
            'background-color': "<?php echo $style->menu; ?>"
        });
        $('body').css({
            'color': "<?php echo $style->texte; ?>"
        });
        $('p').css({
            'color': "<?php echo $style->texte; ?>"
        });
        $('h1').css({
            'color': "<?php echo $style->texte; ?>"
        });
        $('span:not(.not-color)').css({
            'color': "<?php echo $style->texte; ?>"
        });
        $('h2').css({
            'color': "<?php echo $style->texte; ?>"
        });
        $('h3').css({
            'color': "<?php echo $style->texte; ?>"
        });
        $('h4').css({
            'color': "<?php echo $style->texte; ?>"
        });
        $('h5').css({
            'color': "<?php echo $style->texte; ?>"
        });
        $('body').css({
            'background-color': "<?php echo $style->background; ?>"
        });
        $('#sidebar-wrapper').css({
            'background-color': "<?php echo $style->panneau_lateral; ?>"
        });
        $('.sidebar-nav li a').css({
            'color': "<?php echo $style->texte_panneau; ?>"
        });
    });
    
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>
</html>
