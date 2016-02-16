<style>
    body{
        background : none;
        position:relative;
    }
    h4{
        text-align:center;
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
            <h3>Lot n° <?= $lot->numero_lot; ?></h3>
            <hr width="50%">
            <p><?= $projet->nom . ' - ' . $projet->adresse . ' ' . $projet->cp . ' ' . strtoupper($projet->ville); ?></p>
        </div>
    </div>
    <div id="main">
        <div class="row noPadding">
            <div class="img_preview">
                <i class="fa fa-camera" data-toggle="tooltip" title="" data-original-title="Ajouter / Changer la photo"></i><br/>
                <img src="" class="img-preview"/>
            </div>
            <input type='file' class="hidden hidden-print" id="imgInp"/>
        </div>
        <table><tr>
            <?php if (sizeof($pieces) > 0) { ?>
        <td width="30%">
            <div class="row noPadding">
                <div class="col-md-12">
                    <h4>Surfaces</h4>
                    <hr width="50%">
                    <?php foreach ($pieces as $piece) { ?>
                    <p style="text-align:center;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="16px" height="16px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
<path class="path" d="M14 7.001H2.999C1.342 7 0 8.3 0 10v11c0 1.7 1.3 3 3 3H14c1.656 0 3-1.342 3-3V10 C17 8.3 15.7 7 14 7.001z M14.998 21c0 0.551-0.447 1-0.998 1.002H2.999C2.448 22 2 21.6 2 21V10 c0.001-0.551 0.449-0.999 1-0.999H14c0.551 0 1 0.4 1 0.999V21z"></path>
<path class="path" d="M14.266 0.293c-0.395-0.391-1.034-0.391-1.429 0c-0.395 0.39-0.395 1 0 1.415L13.132 2H3.869l0.295-0.292 c0.395-0.391 0.395-1.025 0-1.415c-0.394-0.391-1.034-0.391-1.428 0L0 3l2.736 2.707c0.394 0.4 1 0.4 1.4 0 c0.395-0.391 0.395-1.023 0-1.414L3.869 4.001h9.263l-0.295 0.292c-0.395 0.392-0.395 1 0 1.414s1.034 0.4 1.4 0L17 3 L14.266 0.293z"></path>
<path class="path" d="M18.293 9.734c-0.391 0.395-0.391 1 0 1.429s1.023 0.4 1.4 0L20 10.868v9.263l-0.292-0.295 c-0.392-0.395-1.024-0.395-1.415 0s-0.391 1 0 1.428L21 24l2.707-2.736c0.391-0.394 0.391-1.033 0-1.428s-1.023-0.395-1.414 0 l-0.292 0.295v-9.263l0.292 0.295c0.392 0.4 1 0.4 1.4 0s0.391-1.034 0-1.429L21 7L18.293 9.734z"></path>
</svg>&nbsp;&nbsp;<?= strtoupper($piece->piece); ?> : <?= $piece->taille . " m²"; ?></p>
                    <?php } ?>
                </div>
            </div>
        </td>
        <?php } ?>
        <?php if ($lot->description != "") { ?>
        <td width="70%">
            <div class="row noPadding">
                <div class="col-md-12">
                    <br/>
                    <h4>Description du lot</h4>
                    <hr width="50%">
                    <p class="description"><?= $lot->description; ?></p>
                </div>
            </div>
        </td>
        <?php } ?>
        </tr></table>
        <div class="row noPadding">
            <div class="col-md-12" style='text-align:center;'>
                <h4>CONTACT</h4>
                <hr width='50%'>
                <span style="text-align:center;font-weight:900;" contenteditable="true" data-toggle="tooltip" title="" data-original-title="Cliquez pour changer le nom du responsable commercial">Simon WAY</span>
                <span style="text-align:center;">commercial@saint-roch-habitat.fr</span>
                <span style="text-align:center;">09 72 37 99 60</span>
            </div>
        </div>
    </div>
    <center>
        <div id="footer">
            <div class="col-md-12" style="text-align:center;">
                <p><b>Saint Roch Habitat</b> - 6, rue Lamartine 59000 Lille <br/>www.saint-roch-habitat.fr</p>
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