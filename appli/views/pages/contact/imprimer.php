<style>
    body{
        background : none;
        position:relative;
    }
    h3{
        padding-top:40px;
        padding-bottom:15px;
        color:black !important;
    }
    h4{
        margin-top:20px;
    }
    h4,hr.left{
        text-align:left;
    }
    
    hr.left{
        width:45%;
        margin-left:0;
    }
    .img-preview{
        width:auto;
        max-height:500px;
        margin:0 auto;
        text-align:center;
    }
    .uploader{
        clear:both;
    }
    .description{
        font-size:10px;
        text-align:justify;
    }
    #main{
        padding-bottom: 50px;
        padding-left:50px;
        padding-right:50px;
    }
    .img_preview{
        text-align:center;
    }
    .fa-camera{
        font-size:50px;
        text-align:center;
    }
    #footer{
        color: #ccc;
    }
    td{
        color:black !important;
    }
    .fa-camera:hover{
        color:darkcyan;
        cursor:pointer;
    }
</style>
<div class='hidden-print'>
    <p class="btn btn-warning" onclick="window.close();">Fermer l'aperçu impression</p>
    <p class="btn btn-success" onclick="window.print();">Imprimer!</p>
</div>
<div id="wrap">
    <div id="header" class="row noPadding">
        <div class="col-md-12" style="text-align:center">
            <img src="<?= img_url('logos/logo_srh.jpg') ?>" width="200px;" height="auto" style="position:absolute;text-align:left;left:0;"/>
            <h3>FICHE DE RENSEIGNEMENTS</h3>
        </div>
        <hr width="30%">
    </div>
    <div id="main">
        <h4>Renseignements généraux :</h4>
        <hr class="left">
        <table>
            <tr>
                <td width="45%">
                    <p><b>Nom : </b><?= $contact->nom; ?></p>
                    <p><b>Prénom : </b><?= $contact->prenom; ?></p>
                    <p><b>Adresse : </b><?= $contact->adresse; ?></p>
                    <p><b>Code postal : </b><?= $contact->cp; ?></p>
                    <p><b>Ville : </b><?= $contact->ville; ?></p>
                    <p><b>Téléphone fixe : </b><?= $contact->fixe; ?></p>
                    <p><b>Téléphone portable : </b><?= $contact->portable; ?></p>
                    <p><b>Email : </b><?= $contact->email; ?></p>
                </td>
                <td width="45%">
                    <?php $champs = json_decode($contact->data)->champs_persos; ?>
                    <?php foreach($champs as $key => $value){ ?>
                        <p><b><?= $key; ?> : </b><?= $value; ?></p>
                    <?php } ?>
                    <?php if( sizeof($contact->entreprises)==1){  ?>
                        <b>Société :</b>
                    <?php }elseif(sizeof($contact->entreprises)>1){ ?>
                        <b>Sociétés :</b>
                    <?php } ?>
                    <?php foreach($contact->entreprises as $entreprise){?>
                        <p><b><?= $entreprise[0]->nom; ?> </b>en tant que <?= $entreprise[0]->poste; ?></p>
                    <?php } ?>
                </td>
            </tr>
        </table>
        
        <h4>Recherche :</h4>
        <hr class="left">
        <h4 class="center"><input type="checkbox" <?php if($fiche->achat == 1){echo "checked"; } ?>/> Achat&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="marginLeft" type="checkbox" <?php if($fiche->location == 1){echo "checked"; } ?>/> Location</h4>
        <p><b>Secteur(s) :</b> <?php foreach((json_decode($fiche->secteur)) as $secteur){echo $secteur.' ';} ?></p>
        <h4 class="center"><input type="checkbox" <?php if($fiche->maison == 1){echo "checked"; } ?>/> Maison&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" <?php if($fiche->appartement == 1){echo "checked"; } ?>/> Appartement&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" <?php if($fiche->loft == 1){echo "checked"; } ?>/> Loft&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" <?php if($fiche->commerce == 1){echo "checked"; } ?>/> Commerce&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" <?php if($fiche->bureau == 1){echo "checked"; } ?>/> Bureau&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h4>
        <h4 class="center"><input type="checkbox" <?php if($fiche->t2 == 1){echo "checked"; } ?>/> T2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" <?php if($fiche->t3 == 1){echo "checked"; } ?>/> T3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" <?php if($fiche->t4 == 1){echo "checked"; } ?>/> T4&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" <?php if($fiche->t5 == 1){echo "checked"; } ?>/> T5</h4>
        <h4 class="center"><input type="checkbox" <?php if($fiche->amenagee == 1){echo "checked"; } ?>/> Surface aménagée&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" <?php if($fiche->brute == 1){echo "checked"; } ?>/> Surface brute</h4>
        <h4 class="center"><input type="checkbox" <?php if($fiche->jardin == 1){echo "checked"; } ?>/> Jardin&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" <?php if($fiche->parking == 1){echo "checked"; } ?>/> Parking&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" <?php if($fiche->garage == 1){echo "checked"; } ?>/> Garage</h4>
        <p><b>Superficie :</b> <?= format_number($fiche->superficie); ?> m²</p>
        <h4 class="center"><input type="checkbox" <?php if($fiche->investissement_locatif == 1){echo "checked"; } ?>/> Investissement locatif&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" <?php if($fiche->residence_principale == 1){echo "checked"; } ?>/> Résidence principale&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" <?php if($fiche->residence_secondaire == 1){echo "checked"; } ?>/> Résidence secondaire</h4>
        <p><b>Budget :</b> <?= format_number($fiche->budget); ?> €</p>
        
        
        <h4>Observations :</h4>
        <hr class="left">
        <p><?= $fiche->observation; ?></p>
    </div>
    <center>
        <div id="footer">
            <div class="col-md-12" style="text-align:center;">
                <p><b>Saint Roch Habitat</b> - 6, rue Lamartine 59000 Lille <br/>commercial@saint-roch-habitat.fr<br/>www.saint-roch-habitat.fr<br/>03 20 29 01 81</p>
            </div>
        </div>
    </center>
</div>

<script>
    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var base64 = e.target.result;
                $('.img-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('.img_preview').on('click', function () {
        $("#imgInp").click();
    });

    $("#imgInp").change(function () {
        readURL(this);
    });
</script>