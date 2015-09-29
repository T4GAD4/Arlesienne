$(function () {
    if ($('#page')[0].innerHTML == "Creer") {
        charge_compte();
    }
});

$('#societe').change(charge_compte);

function charge_compte() {
    var idSociete = $('#societe').val();
    $.post("/AJAX/projet/getCompte", {id: idSociete}).success(function (data) {
        $('select[name=compte]').empty();
        var comptes = JSON.parse(data).result;
        $.each(comptes, function (key, value) {
            $('select[name=compte]').append('<option value="' + comptes[key].id + '">' + comptes[key].banque + ' | ' + comptes[key].numero + '</option>')
        });
    });
}