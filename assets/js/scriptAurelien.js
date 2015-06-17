$(document).ready(function () {
    
    //Chosen
    $(".chosen-select").chosen();
    
    //Fonction de mise en etat lu pour message clique
    $('.non_lus').on('click',function(){
        var object = {"id":$(this).data('id')};
          $.post("/AJAX/message/set_lu",object)
        .success(function (data) {
        });
    });

    //Fonction de suppression des favoris utilisateurs
    $('.glyphicon-remove').on('click',function(){
        var object = {"remove": $(this).data('value')};
          $.post("/AJAX/utilisateur/remove_favoris",object)
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
            $.each(data.result, function($key,$value){
                users.push(data.result[$key].prenom+' '+data.result[$key].nom);
                utilisateurs[$key].np = data.result[$key].prenom+' '+data.result[$key].nom
            });
        });
        
    //Fonction d'envoi de message
    $('.message_send').on('click',function(e){
        e.preventDefault();
        var message = $('[name=message]').val();
        $.each(utilisateurs,function(key,value){
            if($('[name=destinataire]').val() == utilisateurs[key].np){
                id = utilisateurs[key].id
            }
        });
        var object = {"destinataire": id, "message": message};
          $.post("/AJAX/utilisateur/send_message", object)
                  .success(function(){
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


    //On va vérifier si l'utilisateur est connecté ou non et va afficher la pop-up de connexion
      $.post("/AJAX/connexion/test_connexion")
            .success(function (data) {
                data = JSON.parse(data);
                if (data.result === false) {
                    //utilisateur non connecté!
                    //On afiche la pop-up
                    $('.modal_connexion').modal('show');
                }
            });

    //On va envoyer le formulaire pour se connecter
    $('.submit_connexion').on('click', function () {
        var password = $('.modal_connexion').find('input[type=password]').val();
        var pseudo = $('.modal_connexion').find('input[type=text]').val();
        var object = {"password": password, "pseudo": pseudo};
          $.post("/AJAX/connexion/connex", object)
                .success(function (data) {
                    data = JSON.parse(data);
                    switch (data.result) {
                        case "identifiant" :
                            $('.modal_error').html("Identifiant invalide!");
                            break;
                        case "ok" :
                            $('.modal_error').html("");
                            $('.modal_connexion').modal('hide');
                            if (confirm('Vous êtes connectés! Voulez vous recharger la page?')) {
                                window.location.reload();
                            }
                            ;
                            break;
                        case "mot de passe" :
                            $('.modal_error').html("Mot de passe invalide!");
                            break;
                        default :
                            $('.modal_error').html("");
                            break;
                    }
                });
    });

    //Datetime-picker
    $(function () {
        $('#datetimepicker10').datetimepicker({
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
    console.log(serialisation);
    var object = {"interface": JSON.stringify(serialisation)};
      $.post("/AJAX/utilisateur/save_interface", object)
    .success(function (data) {
        console.log(data);
    });
}
//Ajouter un element sur le bureau

$('.submit_widget').on('click',function(e){
        e.preventDefault();
        if($('[name=target]')[0].checked){
            $value = "_blank";
        }else{
            $value = "_self";
        }
        ajouter_widget($('[name=url]').val(),$('[name=image]').val(),$value);
    });
    
function ajouter_widget($url,$image,$target) {
    var gridster = $(".gridster ul").gridster().data('gridster');
    gridster.add_widget('<li data-url="'+$url+'" data-image="'+$image+'" data-target="'+$target+'" style="background:url(\''+$image+'\') 100% 100% no-repeat;background-size:contain;background-position: center center;"><i class="glyphicon glyphicon-trash remove" onclick="remove_widget(this)"></i></li>', 1, 1);
    $('#modal_widget').removeClass('in');
}

function removeelement(el){
    var parent = el.parentNode.parentNode;
    parent.remove();
    }

function remove_widget(element){
    var parent = element.parentNode;
    var gridster = $(".gridster ul").gridster().data('gridster');
    gridster.remove_widget(parent);
};

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
    
    

    