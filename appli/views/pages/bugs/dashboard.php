<style>
    .modal-backdrop{
        z-index : 0;
    }
    .activer{
        border-radius:5px;
        border : solid 1px whitesmoke;
        cursor:pointer;
        background: rgba(255,255,255,0.3)
    }

    .panel-collapse{
        background-color:white;
        border-radius:5px;
    }
    .panel-body{
        border-top:solid 1px #ddd !important;
    }
    #tri div p{
        padding : 10px
    }
    .trieur{
        text-align:center;
        color:white;
    }
    .trieur:hover{
        border-radius:5px;
        border : solid 1px whitesmoke;
        cursor:pointer;
    }
    .fin_test{
        margin-right:20px;
    }
    .glyphicon-refresh{
        -webkit-animation-name: spin;
        -webkit-animation-duration: 4000ms;
        -webkit-animation-iteration-count: infinite;
        -webkit-animation-timing-function: linear;
        -moz-animation-name: spin;
        -moz-animation-duration: 4000ms;
        -moz-animation-iteration-count: infinite;
        -moz-animation-timing-function: linear;
        -ms-animation-name: spin;
        -ms-animation-duration: 4000ms;
        -ms-animation-iteration-count: infinite;
        -ms-animation-timing-function: linear;
    }
    @-moz-keyframes spin {
        from { -moz-transform: rotate(0deg); }
        to { -moz-transform: rotate(360deg); }
    }
    @-webkit-keyframes spin {
        from { -webkit-transform: rotate(0deg); }
        to { -webkit-transform: rotate(360deg); }
    }
    @keyframes spin {
        from {transform:rotate(0deg);}
        to {transform:rotate(360deg);}
    }
    .fa-info{
        color:blue;
        font-size:20px;
        margin-bottom:5px;
        text-align:center;
    }
    .fa-bug{
        color:darkorange;
        font-size:20px;
        margin-bottom:5px;
        text-align:center;
    }
    .glyphicon-fire{
        color:red;
        font-size:20px;
        margin-bottom:5px;
        text-align:center;
    }
    .glyphicon-thumbs-up{
        color:green;
        font-size:20px;
        margin-bottom:5px;
        text-align:center;
    }
    .fa-lightbulb-o{
        color:yellow;
        font-size:20px;
        margin-bottom:5px;
        text-align:center;
    }

    .fa:not(.fa-minus-circle), .glyphicon:not(.glyphicon-alert){
        text-shadow: 0px 0px 10px rgba(255, 255, 255, 0.8);
    }
</style>        

<div class="container">
    <div class="row">
        <h1>
            BUGS
            <a href="<?php echo base_url() . 'bugs/dashboard/add'; ?>" class="btn btn-default pull-right" role="button">Ajouter un bug</a>
        </h1>
        <hr/>
    </div>
    <div class="row" style="font-size:18px;text-align:center;" id="tri">
        <?php
        foreach ($urgences as $urgence) {
            if ($urgence->urgence == "information") {
                $class = "fa fa-info";
            } elseif ($urgence->urgence == "bug") {
                $class = "fa fa-bug";
            } elseif ($urgence->urgence == "urgent") {
                $class = "glyphicon glyphicon-fire";
            } elseif ($urgence->urgence == "resolu") {
                $class = "glyphicon glyphicon-thumbs-up";
            } elseif ($urgence->urgence == "idee") {
                $class = "fa fa-lightbulb-o";
            }
            ?>
            <div class="col-md-3 col-centered">
                <p class="trieur" data-tri = '<?= $urgence->urgence; ?>'><span class="<?= $class; ?>"></span><br/> <?= $urgence->urgence; ?> <br/><span class="badge"><?= $urgence->nombre; ?></span></p>
            </div>
        <?php } ?>
    </div>
    <br/><br/>
    <?php foreach ($categories as $categorie) { ?>
        <a href="#<?= $categorie->categorie; ?>" aria-controls="<?= $categorie->categorie; ?>" role="tab" data-toggle="tab" class="btn btn-default"><?= $categorie->categorie; ?>&nbsp;&nbsp;&nbsp;<span class="badge"><?= $categorie->nombre; ?></span></a>
    <?php } ?>
    <br/><br/>
    <div class="tab-content"> 
        <?php $x = " active in"; foreach ($categories as $categorie) { ?>
            <div role="tabpanel" class="tab-pane fade <?= $x; ?>" id="<?= $categorie->categorie; ?>">
                <div class="row">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
                        <?php $i = 0; 
                        foreach ($categorie->bugs as $bug) {                            
                            ?>
                            <div class="panel panel-default <?php echo $bug->urgence; ?>">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?= $categorie->categorie; ?><?php echo $i; ?>" aria-expanded="false" aria-controls="collapseOne">
                                            <p style="margin: 0;"><b><?php echo $bug->titre; ?></b></p>
                                        </a>
                                    </h4>
                                </div>
                                <div id="<?= $categorie->categorie; ?><?php echo $i; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
        <?php if ($bug->message != "") { ?>
                                            <div class="row">
                                                <div class="col-md-12"><h4>Commentaire: </h4><br/><span style="text-indent:2em;"><?php echo $bug->message ?></span></div>
                                            </div>
        <?php } else { ?>
                                            <div class="row">
                                                <div class="col-md-12"><h4>Aucun commentaire de la part du testeur</h4></div>
                                            </div>
                                        <?php } ?>
    
                                    <div class="row">
                                        <div class="col-md-12"><h6><?= $bug->utilisateur; ?></h6></div>
                                    </div>
                                    <?php if ($bug->infos_resolution != "") {
                                    $resolution = json_decode($bug->infos_resolution);
                                    ?>
                                        <br/><br/>
                                        <blockquote>
                                            <div class="row">
                                                <i>
                                                    <div class="col-md-12"><h6>Résolu le <?= conv_date($resolution->date); ?>, par <?= $resolution->developpeur; ?></h6></div>
                                                    <br/>
                                                    <div class="col-md-12">
                                                        <h5>Description de la solution : </h5>
                                                        <h4><code><?= $resolution->message; ?></code></h4>
                                                    </div>
                                                </i>
                                            </div>
                                        </blockquote>
                                    <?php } ?>
                                    <div class="row">
    <?php if ($bug->infos_resolution == "") { ?>
                                        <div class="pull-right" style='padding-right:20px;'>
                                            <a href="<?php echo base_url() . 'bugs/dashboard/resolu/' . $bug->id; ?>" class="btn btn-default pull-right" role="button" ><span class="glyphicon glyphicon-alert" style="color:green;"></span>&nbsp;&nbsp;&nbsp;Probléme résolu</a>
                                        </div>
    <?php } ?>
                                        <div class="pull-right" style='padding-right:20px;'>
                                            <a href="<?php echo base_url() . 'bugs/dashboard/delete/' . $bug->id; ?>" class="btn btn-default pull-right" role="button" ><span class="fa fa-minus-circle" style="color:red;"></span>&nbsp;&nbsp;&nbsp;Supprimer le bug</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        <?php $i++; } ?>
                    </div>
                </div>
            </div>
        <?php $x="";} ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.collapse').collapse("hide");

        $('.fin_test').on('click', function (e) {
            e.preventDefault();
            $('input[name=etat]').val($(this).data('etat'));
            $('input[name=idTest]').val($(this).data('id'));
            $('#myModal').modal('show');
        });

        $('.trieur').on('click', function () {
            var str = $(this).attr("class");
            if (str.indexOf('activer') != -1) {
                $.each($('.trieur'), function () {
                    $(this).removeClass('activer');
                });
                $.each($('.panel-default'), function () {
                    $(this).removeClass('hidden');
                });
                return false;
            }
            var tri = $(this).data('tri');
            $.each($('.trieur'), function () {
                $(this).removeClass('activer');
            });
            $.each($('.panel-default'), function () {
                $(this).addClass('hidden');
            });
            $.each($('.' + tri), function () {
                $(this).removeClass('hidden');
            });
            $(this).addClass('activer');

        });
    });

    function tester($idTest) {
        var testeur = "";
        do {
            testeur = prompt(' entrez votre prenom et nom');
        } while (testeur == "");
        if (testeur != "") {
            testeur = sans_accents(testeur);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>tests/tester/" + $idTest + "/" + urlencode(testeur),
                dataType: "text",
                cache: false,
                success:
                        function (data) {
                            document.location.reload();
                        }
            });
            return false;
        }
    }

    function urlencode(str) {
        return escape(str.replace(/%/g, '%25').replace(/\+/g, '%2B')).replace(/%25/g, '%');
    }

    //Fonctions pour la recherche!
    function sans_accents(str) {
        var accent = [
            /[\300-\306]/g, /[\340-\346]/g, // A, a
            /[\310-\313]/g, /[\350-\353]/g, // E, e
            /[\314-\317]/g, /[\354-\357]/g, // I, i
            /[\322-\330]/g, /[\362-\370]/g, // O, o
            /[\331-\334]/g, /[\371-\374]/g, // U, u
            /[\321]/g, /[\361]/g, // N, n
            /[\307]/g, /[\347]/g, // C, c
        ];
        var noaccent = ['A', 'a', 'E', 'e', 'I', 'i', 'O', 'o', 'U', 'u', 'N', 'n', 'C', 'c'];

        for (var i = 0; i < accent.length; i++) {
            str = str.replace(accent[i], noaccent[i]);
        }
        return str;
    }
</script>