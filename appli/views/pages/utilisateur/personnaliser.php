<?php
$style = json_decode($user->style);
$page = "personnaliser";
?>


<div class="container">

    <div role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Page d'accueil</a></li>
            <li role="presentation"><a href="#color" aria-controls="profile" role="tab" data-toggle="tab">Couleurs</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="home">

                <div class="row">
                    <a class="btn btn-info" data-toggle="modal" data-target="#modal_widget">Ajouter un élément</a>
                    <a class="btn btn-success pull-right" onclick="save_gridster()">Sauvegarder mon interface</a>
                    <br/><br/>
                    <div class="col-md-12 col-sm-12">
                        <div class="gridster" id="gridster">
                            <ul>
                                <?php
                                $interface = json_decode($user->interface);
                                foreach ($interface as $data) {
                                    ?>
                                    <li draggable="true" data-target="<?php echo $data->target; ?>" data-image="<?php echo $data->image; ?>" style="background:url('<?php echo $data->image; ?>') 100% 100% no-repeat;background-size:contain;background-position: center center;" data-url="<?php echo $data->url; ?>" data-row="<?php echo $data->row; ?>" data-col="<?php echo $data->col; ?>" data-sizex="<?php echo $data->size_x; ?>" data-sizey="<?php echo $data->size_y; ?>"><i class="glyphicon glyphicon-trash remove" onclick="remove_widget(this)"></i></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!--Modal pour l'ajout d'un element -->

                <div class="modal fade" id="modal_widget" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Ajouter un élément</h4>
                            </div>
                            <form>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="url">Url du lien</label>
                                        <input type="text" name="url" class="form-control" id="url" placeholder="http://arlesienne/..." required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="file">Url de l'image</label>
                                        <input type="text" name="image" class="form-control" id="image" placeholder="http://image/..." required="">
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="target" type="checkbox"> Ouvrir dans un nouvel onglet?
                                        </label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary submit_widget">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Fin modal -->
            </div>
            <div role="tabpanel" class="tab-pane fade" id="color">

                <div class="row">
                    <?php echo form_open('utilisateur/personnaliser/'); ?>

                    <!-- Text input-->
                    <div class="form-group paddingTop">
                        <label class="col-md-3 control-label col-md-offset-1" for="menu">Couleur du menu</label>  
                        <div class="col-md-6">
                            <input type="text" name='menu' value='<?php echo $style->menu; ?>' class="colorpicker form-control input-md" />
                            <?php echo form_error('menu'); ?>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group paddingTop">
                        <label class="col-md-3 control-label col-md-offset-1" for="texte">Couleur du texte</label>  
                        <div class="col-md-6">
                            <input type="text" name='texte' value='<?php echo $style->texte; ?>' class="colorpicker form-control input-md" />
                            <?php echo form_error('texte'); ?>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group paddingTop">
                        <label class="col-md-3 control-label col-md-offset-1" for="panneau">Couleur du panneau lateral</label>  
                        <div class="col-md-6">
                            <input type="text" name='panneau' value='<?php echo $style->panneau; ?>' class="colorpicker form-control input-md" />
                            <?php echo form_error('panneau'); ?>
                        </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group paddingTop">
                        <label class="col-md-3 control-label col-md-offset-1" for="texte_panneau">Couleur du texte du panneau lateral</label>  
                        <div class="col-md-6">
                            <input type="text" name='texte_panneau' value='<?php echo $style->texte_panneau; ?>' class="colorpicker form-control input-md" />
                            <?php echo form_error('texte_panneau'); ?>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group paddingTop">
                        <div class="col-md-offset-2 col-md-8">
                            <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Annuler"/>
                            <input type="submit" class="btn btn-success pull-right marginLeft" value="Sauvegarder"/>
                            <input type="button" class="btn btn-danger reset pull-right" value="Reset origine"/>
                        </div>
                    </div>


                    <?php echo form_close(); ?>
                </div>

            </div>
        </div>

    </div>
</div> 

<script>
    $(document).ready(function () {

        var gridster = $("#gridster ul").gridster({
            widget_margins: [10, 10],
            widget_base_dimensions: [140, 140],
            resize: {
                enabled: true
            }
        }).data('gridster');

        $('.reset').on('click', function () {
            $('[name=menu]').val('#f8f8f8');
            $('[name=panneau]').val('#000000');
            $('[name=texte_panneau]').val('#adadad');
            $('[name=texte]').val('#000000');
        });
        $('[name=menu]').colorpicker().on('changeColor.colorpicker', function (event) {
            $('.navbar-default').css({
                'background-color': $(this).val()
            });
        });
        $('[name=panneau]').colorpicker().on('changeColor.colorpicker', function (event) {
            $('#sidebar-wrapper').css({
                'background-color': $(this).val()
            });
        });
        $('[name=texte_panneau]').colorpicker().on('changeColor.colorpicker', function (event) {
            $('.sidebar-nav li a').css({
                'color': $(this).val()
            });
        });
        $('[name=texte]').colorpicker().on('changeColor.colorpicker', function (event) {
            $('body').css({
                'color': $(this).val()
            });
            $('h1').css({
                'color': $(this).val()
            });
            $('h2').css({
                'color': $(this).val()
            });
            $('h3').css({
                'color': $(this).val()
            });
            $('h4').css({
                'color': $(this).val()
            });
            $('h5').css({
                'color': $(this).val()
            });
        });
    });
</script>
