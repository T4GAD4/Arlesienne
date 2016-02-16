
window.addEventListener("load", function()
{
	if($(".chosen-select").length > 0)
	{
		var templateEntreprise = '<div class="col-md-5 col-md-offset-4 liste">\
							<div data-entrepriseNom="{nom}" class="col-md-3 text-center">{nom}</div>\
							<div class="col-md-9 noPadding">\
								<input type="hidden" name="id" value="{id}">\
								<input type="hidden" name="nom_entreprise" value="{nom}">\
								<input data-id="{id}" name="poste" class="form-control poste-contact" required="" placeholder="Entrer le poste du contact dans cette entreprise"></input>\
							</div>\
							<div class="col-md-1 col-md-offset-1 noPadding text-center">\
							</div>\
						</div>';
						
		var templateChamps = '<div class="form-group paddingTop champ_perso">\
							<input class="controls col-md-2 control-label col-centred labelEditable" placeholder="Votre nom de champs..." style="opacity:0.85;text-align:right;"/>\
							<div class="controls col-md-6 col-centered">\
								<input class="inputEditable form-control input-md" type="text" value="" placeholder="Votre champ...">\
							</div><i class="glyphicon glyphicon-remove-circle red remove-champs" style="position:relative;top:-3px;left:10px;"></i></div>';
		
		var entreprises = [];
		
		if(typeof $postes == "string")
			$postes = JSON.parse($postes);
		else
			$postes = [];
		
		function update_listeEntrerpise(e)
		{
			var selected = $("#select-entreprise")[0].selectedOptions;
			var copy_template = "";
			var copy_entreprises = JSON.parse(JSON.stringify(entreprises));
			entreprises = [];
			
			$(".ent-list").empty();

			for(var i = 0; i < selected.length; i++)
			{
				copy_template = templateEntreprise;
				copy_template = copy_template.replace(/{nom}/ig, selected[i].textContent);
				copy_template = copy_template.replace(/{id}/ig, selected[i].value);
				
				$(".ent-list").prepend(copy_template);
				
				entreprise = {id:selected[i].value, nom:selected[i].textContent.trim()};

				entreprises.push(entreprise);
			}
			
			for(var i = 0; i < entreprises.length; i++)
			{
				for(var j = 0; j < copy_entreprises.length; j++)
				{
					if(entreprises[i].id == copy_entreprises[j].id)
					{
						entreprises[i].poste = copy_entreprises[j].poste;
						$(".poste-contact[data-id="+copy_entreprises[j].id+"]").val(entreprises[i].poste);
					}
				}
				
				for(var j = 0; j < $postes.length; j++)
				{
					if(entreprises[i].id == $postes[j].idEntreprise)
					{
						entreprises[i].poste = $postes[j].poste;
						$(".poste-contact[data-id="+$postes[j].idEntreprise+"]").val(entreprises[i].poste);
					}
				}
			
			}
			
			$(".poste-contact").on("input", function()
			{
				for(var i = 0; i < entreprises.length; i++)
				{
					if(entreprises[i].id == this.dataset["id"])
						entreprises[i].poste = this.value;
				}
			});
		}
		
		var champBlur = function()
		{
			if($(this).text()[$(this).text().length - 1] != ":")
				$(this).text($(this).text() + " :");
		}
	
		
		var champFocus = function()
		{
			$(this).text("");
		}
		
		var champInput = function()
		{
			$(".inputEditable").attr("placeholder", $(this).text());
		}
		
		$(".champs").on("click", function()
		{
			$("#champs_persos").append(templateChamps);
			
			$(".remove-champs").on("click", function()
			{
				$(this).parent().remove();
			});
		});
		
		$("#select-entreprise").on("change", update_listeEntrerpise);

		//Interception du formulaire de creation de contact
		$('#form_contact').on('click',function(e)
		{
			e.preventDefault();
			champs_persos = {};
                        var champs = champs_persos['champs_persos'] = {};
                        var liste = champs_persos['liste'] = {};
                        //on gére les champs personnalisés
			$.each($('.champ_perso'), function(index,value)
			{
			  var input = $(this).children('input').val();
			  var valeur = $(this).children('div').children('input').val();
			  
			  champs[input] = valeur;
			});
			
			//on gére les liste de diffusions
			var options = $("#select-diffusion")[0].selectedOptions;
			for(var i = 0; i < options.length; i++)
			{
				if(options[i].selected == true)
					liste[i] = options[i].textContent.trim();
			}
			var datas = JSON.stringify(champs_persos);
			$("#data").val(datas);
			$("#entreprises").val(JSON.stringify(entreprises));
			
			$('#formulaire').submit();

		});
        update_listeEntrerpise(null);               
	}
        
    var state = $('[name=autoentrepreneur]').bootstrapSwitch('state');

    if(state == false){
        $('#siret').addClass('hidden');
    }else{
        $('#siret').removeClass('hidden');
    }
        
    $("[name=autoentrepreneur]").on('switchChange.bootstrapSwitch', function (event, state) {
        if(state == false){
            $('#siret').addClass('hidden');
        }else{
            $('#siret').removeClass('hidden');
        }
    });
});