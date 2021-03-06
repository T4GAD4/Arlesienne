$(document).ready(function () {

    $('#exporter').on('click', function (e) {
        var data = {};
        data.table = "";
        $('.table-export').each(function () {
            data.table += $(this).html().replace(' class="table-striped table-hover table"', '');
        });
        var texte = '<html xmlns:x="urn:schemas-microsoft-com:office:excel">\n\
<head>\n\
    <!--[if gte mso 9]>\n\
    <xml>\n\
        <x:ExcelWorkbook>\n\
            <x:ExcelWorksheets>\n\
                <x:ExcelWorksheet>\n\
                    <x:Name>Sheet 1</x:Name>\n\
                    <x:WorksheetOptions>\n\
                        <x:Print>\n\
                            <x:ValidPrinterInfo/>\n\
                        </x:Print>\n\
                    </x:WorksheetOptions>\n\
                </x:ExcelWorksheet>\n\
            </x:ExcelWorksheets>\n\
        </x:ExcelWorkbook>\n\
    </xml>\n\
    <![endif]-->\n\
</head>\n\
<body>';
        texte += data.table + '</body></html>';

        window.open('data:application/vnd.ms-excel,' + texte);
        e.preventDefault();
    });

    $('#creerContact').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('#societeliste').change(charge_compte);

    //Bootstrap switch
    $("[name=bootstrapswitch-devise]").on('switchChange.bootstrapSwitch', function (event, state) {
        if (state == false) {
            $('#devise').val("false");
        } else {
            $('#devise').val("true");
        }
    });
    $("[name=bootstrapswitch-rg]").on('switchChange.bootstrapSwitch', function (event, state) {
        if (state == false) {
            $('#rg').val("false");
        } else {
            $('#rg').val("true");
        }
    });

    //Function pour l'ajout de champs
    $('.addchamps').click(function () {
        $valeur = $('.champ').length + 1;
        $('#boxchamps').append('<div id="champs' + $valeur + '" class="control-group champ"><label class="control-label col-sm-2 col-centered">Programme ' + $valeur + '</label><div class="controls col-xs-12 col-sm-8 col-md-6 col-centered"><input type="text" class="col-sm-10 col-md-10 col-xs-10 form-control" name="champs' + $valeur + '"/></div></div>');
        $('#number_champs')[0].value = parseInt($valeur);
        $('.removechamps').removeClass('hidden');
    });

    //Function pour l'ajout de champs
    $('.removechamps').click(function () {
        $valeur = $('.champ').length;
        $('#champs' + $valeur).remove();
        if ($valeur == 1) {
            $('.removechamps').addClass('hidden');
        }
        $valeur--;
        $('#number_champs')[0].value = parseInt($valeur);
    });

    //Fonction changement eye open/close
    $('.eye').on('click', function () {
        if ($(this).attr('class').indexOf("open") != -1) {
            $(this).removeClass('glyphicon-eye-open');
            $(this).addClass('glyphicon-eye-close');
        } else {
            $(this).removeClass('glyphicon-eye-close');
            $(this).addClass('glyphicon-eye-open');
        }
    });

    //Chosen
    $(".chosen-select").chosen({'width': "100%"});

    //Fonction de mise en etat lu pour message clique
    $('.non_lus').on('click', function () {
        var object = {"id": $(this).data('id')};
        $.post("/AJAX/message/set_lu", object)
                .success(function (data) {
                });
    });

    //Fonction de suppression des favoris utilisateurs
    $('.glyphicon-remove').on('click', function () {
        var object = {"remove": $(this).data('value')};
        $.post("/AJAX/utilisateur/remove_favoris", object)
                .success(function (data) {
                });
    });

    var users = [];
    var utilisateurs = "";
    //Recherche des utilisateurs pour envoie des message
    $.post("/AJAX/utilisateur/getAll")
            .success(function (data) {
                data = JSON.parse(data);
                utilisateurs = data.result;
                $.each(data.result, function ($key, $value) {
                    users.push(data.result[$key].prenom + ' ' + data.result[$key].nom);
                    utilisateurs[$key].np = data.result[$key].prenom + ' ' + data.result[$key].nom
                });
            });

    //Fonction d'envoi de message
    $('.message_send').on('click', function (e) {
        e.preventDefault();
        var message = $('[name=message]').val();
        $.each(utilisateurs, function (key, value) {
            if ($('[name=destinataire]').val() == utilisateurs[key].np) {
                id = utilisateurs[key].id
            }
        });
        var object = {"destinataire": id, "message": message};
        $.post("/AJAX/utilisateur/send_message", object)
                .success(function () {
                    $('#modal_message').removeClass('in');
                });
    });

    $('.typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    },
    {
        name: 'user',
        source: substringMatcher(users)
    });

    //appel à la fonction qui va lancer la recherche
    $('#search').keyup(function () {
        search();
    });

    //Fonction pour lancer le complexify dans le formulaire de creation de nouveau utilisateur
    $('#complexify').complexify({}, function (valid, complexity) {
        var progressBar = $('#complexity-bar');

        progressBar.toggleClass('progress-bar-success', valid);
        progressBar.toggleClass('progress-bar-danger', !valid);
        progressBar.css({'width': complexity + '%'});

        $('#complexity').text(Math.round(complexity) + '%');
    });

    //Datetime-picker
    $(function () {
        $('#datetimepicker').datetimepicker({
            viewMode: 'years',
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker1').datetimepicker({
            viewMode: 'years',
            format: 'YYYY-MM-DD'
        });
        $('#datetimepicker3').datetimepicker({
            viewMode: 'years',
            format: 'YYYY-MM-DD'
        });

    });

    //Switcher
    $("[name='switcher']").bootstrapSwitch();
    $("[name='actif_sw']").bootstrapSwitch();
    $("[name='autoentrepreneur']").bootstrapSwitch();

    $("[name='actif_sw']").on('switchChange.bootstrapSwitch', function (event, state) {
        if (state == false) {
            $("[name='actif']").val("false");
        }
        else {
            $("[name='actif']").val("true");
        }
    });

    $("[name='switcher']").on('switchChange.bootstrapSwitch', function (event, state) {
        if (state == false) {
            $("[name='type']").val("courant");
        }
        else {
            $("[name='type']").val("promoteur");
        }
    });

    //Colorpicker
    $(function () {
        $('.colorpicker').colorpicker();
    });
    sidebar();
    //Fermeture du sidebar pour la version mobile
    $(window).resize(function () {
        sidebar();
    });
});


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

function search() {
    var research = $('#search').val().toLowerCase();
    research = sans_accents(research);
    $('.searchable').each(function () {
        $description = $(this).attr('data-search');
        $description = $description.toLowerCase();
        $description = sans_accents($description);
        var $tab = research.split(' ');
        resultat = true;
        for (var $k = 0; $k < $tab.length; $k++)
        {
            if ($tab[$k] != "") {
                if ($description.indexOf($tab[$k]) == -1) {
                    var resultat = false;
                }
            }
        }
        if (research == "") {
            $(this).css({
                'display': 'block'
            });
        } else {
            if (resultat == true) {
                $(this).css({
                    'display': 'block'
                });
            } else {
                $(this).css({
                    'display': 'none'
                });
            }
        }

    });

}



//Sauvegarde des favoris
function favoris($url) {
    var object = {"url": $url};
    $.post("/AJAX/utilisateur/favoris", object)
            .success(function (data) {
                //data = JSON.parse(data);
                if (data.result === false) {
                    //utilisateur non connecté!
                    //On afiche la pop-up
                    //$('.modal_connexion').modal('show');
                }
            });
}

//Sauvegarde des favoris
function sidebar() {
    $width = window.innerWidth;
    if ($width <= 766) {
        $('#wrapper').removeClass("toggled");
    } else {
        $('#wrapper').addClass("toggled");
    }
}

//Sauvegarde de la page d'accueil
function save_gridster() {
    var gridster = $(".gridster ul").gridster().data('gridster');
    var serialisation = gridster.serialize();
    $.each(serialisation, function ($key, $value) {
        serialisation[$key].url = $(".gridster li")[$key].dataset['url'];
        serialisation[$key].image = $(".gridster li")[$key].dataset['image'];
        serialisation[$key].target = $(".gridster li")[$key].dataset['target'];
    });
    var object = {"interface": JSON.stringify(serialisation)};
    $.post("/AJAX/utilisateur/save_interface", object)
            .success(function (data) {
                alert('Sauvegardé! :)');
                document.location.href = "/";
            });
}
//Ajouter un element sur le bureau

$('.submit_widget').on('click', function (e) {
    e.preventDefault();
    if ($('[name=target]')[0].checked) {
        $value = "_blank";
    } else {
        $value = "_self";
    }
    ajouter_widget($('[name=url]').val(), $('[name=image]').val(), $value);
});

function ajouter_widget($url, $image, $target) {
    var gridster = $(".gridster ul").gridster().data('gridster');
    gridster.add_widget('<li data-url="' + $url + '" data-image="' + $image + '" data-target="' + $target + '" style="background:url(\'' + $image + '\') 100% 100% no-repeat;background-size:contain;background-position: center center;"><i class="glyphicon glyphicon-trash remove" onclick="remove_widget(this)"></i></li>', 1, 1);
    $('#modal_widget').removeClass('in');
}

function removeelement(el) {
    var parent = el.parentNode.parentNode;
    parent.remove();
}

function remove_widget(element) {
    var parent = element.parentNode;
    var gridster = $(".gridster ul").gridster().data('gridster');
    gridster.remove_widget(parent);
}
;

//Typeahead
var substringMatcher = function (strs) {
    return function findMatches(q, cb) {
        var matches, substringRegex;

        // an object that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` object
        $.each(strs, function (i, str) {
            if (substrRegex.test(str)) {
                matches.push(str);
            }
        });

        cb(matches);
    };
};

function explorer($url) {
    console.log($url);
    var data = [];
    data.url = $url;
    $.post("/AJAX/explorer/ouvrir", data);
}


function reloadTTC() {
    var tva = parseInt($('input[name=tva]')[0].value);
    var montant = parseInt($('input[name=montant]')[0].value);
    var ttc = (montant * (1 + (tva / 100)));
    $('#ttc_total').html(ttc);
}

function charge_compte() {
    var idSociete = $('#societeliste').val();
    $.post("/AJAX/projet/getCompte", {id: idSociete}).success(function (data) {
        $('select[name=compte]').empty();
        var comptes = JSON.parse(data).result;
        $.each(comptes, function (key, value) {
            $('select[name=compte]').append('<option value="' + comptes[key].id + '">' + comptes[key].banque + ' | ' + comptes[key].numero + '</option>')
        });
    });
}

//Permet de valider le changement d'état du projet
function validate(url) {
    var result = prompt('Voulez vous vraiment changer ce projet d\'état? (écrire oui ou non)');
    if (result == "oui") {
        document.location.href = url;
    }
}

    