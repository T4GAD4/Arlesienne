<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="gridster" id="gridster-accueil">
                <ul>
                    <?php 
                    $interface = json_decode($user->interface);
                    foreach($interface as $data){
                    ?>
                    <li onclick="window.open('<?php echo $data->url; ?>','<?php echo $data->target; ?>');" style="background:url('<?php echo $data->image; ?>') 100% 100% no-repeat;background-size:contain;background-position: center center;" data-row="<?php echo $data->row; ?>" data-col="<?php echo $data->col; ?>" data-sizex="<?php echo $data->size_x; ?>" data-sizey="<?php echo $data->size_y; ?>"></li>
                    <?php   
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <div class='notifications bottom-left'></div>
</div>
<script>
$(document).ready(function(){
   //Gridster
    var gridster = $("#gridster-accueil ul").gridster({
        widget_margins: [10, 10],
        widget_base_dimensions: [140, 140],
        resize: {
            enabled: false
        }
    }).data('gridster').disable();
    
    
    //Affichage de la notification des messages non lus!
    function messages(){
        var nb_messages = <?php echo $nb_messages ?>;
        if(nb_messages != 0){
            $('.bottom-left').notify({
                message:{text :"Vous avez "+nb_messages+" message(s) non lu(s)! "}
            }).show();
        }
    }
    
    setTimeout(messages, 1000); 

});
</script>