<div class="container">
    <div class="row">
        <input type="button" class="btn btn-warning pull-left" onclick="history.go(-1)" value="Retour"/>
        <a href="<?php echo base_url().'mail/envoyer/'; ?>" class="btn btn-info pull-right"><i class="fa fa-paper-plane"></i>&nbsp;Envoyer un email</a> 
    </div>
    <div class='row bgWhite'>
        <div class='col-md-12'>
            <h4 class='hrblack center'><?= $email->sujet; ?></h4>
            <p>Expediteur : <?= $email->expediteur; ?></p>
            <br/>
            <p>Destinataire : <?= $email->destinataire; ?></p>
            <p>Copie : <?= $email->copie; ?></p>
            <p>Copie caché : <?= $email->copie_cachee; ?></p>
            <br/>
            <p>Sujet : <?= $email->sujet; ?></p>
            <br/>
            <p>Message : <br/><pre><?= $email->message; ?></pre></p>
            <br/>
            <p>Piéces jointes : <br/>
            <?php foreach(explode(";",$email->fichiers) as $piece){
                if($piece == "/home/srh/arlesienne/emails/"){
                    echo "Aucune piéce jointe avec cet email!";
                }else{ 
                    $piece = str_replace('/home/srh/arlesienne/','',$piece);
                    $extension = pathinfo($piece, PATHINFO_EXTENSION);
                    $extension = strtolower($extension);
                    if(in_array($extension, array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff'))) {
                       echo '<div class="col-md-2"><a data-toggle="tooltip" data-original-title="'.str_replace('emails/','',$piece).'" href="'.base_url(str_replace('arlesiennev3/','',$piece)).'" target="_blank"><img src="'.base_url($piece).'" width="100%"/></a></div>';
                    }else if($extension == "pdf"){
                        echo '<div class="col-md-2"><a data-toggle="tooltip" data-original-title="'.str_replace('emails/','',$piece).'" href="'.base_url(str_replace('arlesiennev3/','',$piece)).'" target="_blank"><i class="fa fa-file-pdf-o" style="font-size:50px;padding:50px;"></i></a></div>';
                    }else{
                        echo '<div class="col-md-2"><a data-toggle="tooltip" data-original-title="'.str_replace('emails/','',$piece).'" href="'.base_url(str_replace('arlesiennev3/','',$piece)).'"><i class="fa fa-file" style="font-size:50px;padding:50px;"></i></a></div>';
                    }            
                }                
                }
            ?>
            </p>
        </div>
    </div>

</div>