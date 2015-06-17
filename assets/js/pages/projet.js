    $(function() {
        charge_compte();
        });

        $('#societe').change(charge_compte);

        function charge_compte(){
            var idSociete = $('#societe').val();
            $.post("/AJAX/projet/getCompte", { id: idSociete } ).success(function(e,val){
                console.log(e,val);
            });
        }