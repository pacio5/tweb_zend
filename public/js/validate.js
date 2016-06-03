$(document).ready(function($){
	// Elemento aggiuntivo per contenere messaggi d'errore
	$("<div>")
	.attr("class","alert alert-danger")
	.prependTo("#titolo")
	.hide();
	
	// Regole di validazione form aggiunta edificio
	$("#building_add").validate({
		rules:{
			name:{
				required:true,
				minlength:1,
				maxlength:30
			},
			
			address:{
				required:true,
				minlength:1,
				maxlength:50
			},
			
			floor_number:{
				required: true,
				number:true
			},
			
			desc_short:{
				required:true
			}
		},
		
		// Messaggi d'errore
		messages:{
			
			name:{
				required: "Devi inserire un nome",
				minlength: "Il nome deve essere minimo 1 carattere",
				maxlength: "Il nome deve essere massimo 30 caratteri"
			},
		
			address:{
				required: "Devi inserire un indirizzo",
				minlength: "L'indirizzo deve essere minimo 1 carattere",
				maxlength: "L'indirizzo deve essere massimo 50 caratteri"
			},
		
			floor_number:{
				required: "Inserisci il numero del piano",
				number: "Inserisci un numero"
			},
			
			desc_short:{
				required: "Devi inserire una descrizione"
			}
		
		},
		
		// Azioni da fare in caso di errore
		highlight: function(element){
			$(element).addClass("alert alert-danger");
		},
		//e quando l'errore viene risolto
		unhighlight: function(element){
			$(element).removeClass("alert alert-danger");
		},
		
		// Eseguita in caso di errore, mostra il box informazione con gli errori
		invalidHandler: function(e, validator) {
			var errors = validator.numberOfInvalids();
			var message = '';
			if (errors) {
				if(errors == 1)
					message = 'Un campo è incompleto: per favore riempilo.';
				else
					message = 'Per favore, correggi i ' + errors + ' campi contrassegnati in rosso.';
				$("div.alert").html(message);
				$("div.alert").show();
			} else {
				$("div.alert").hide();
			}
		}
	});	
	
	
	// Validazione Faq
	$("#addfaq").validate({
		rules:{
			question:{
				required:true,
				maxlength:200
			},
			
			answer:{
				required:true,
				maxlength:2500
			}
		},
		
		// Messaggi d'errore
		
		messages:{
			question:{
				required:"Devi inserire una domanda",
				maxlength:"Devi inserire una domanda di massimo 200 caratteri"
			},
		
			answer:{
				required:"Devi inserire una risposta",
				maxlength:"Devi inserire una risposta di massimo 2500 caratteri"
			}
		},
		
		// Azioni da fare in caso di errore
		highlight: function(element){
			$(element).addClass("alert alert-danger");
		},
		//e quando l'errore viene risolto
		unhighlight: function(element){
			$(element).removeClass("alert alert-danger");
		},
		
		// Eseguita in caso di errore, mostra il box informazione con gli errori
		invalidHandler: function(e, validator) {
			var errors = validator.numberOfInvalids();
			var message = '';
			if (errors) {
				if(errors == 1)
					message = 'Un campo è incompleto: per favore riempilo.';
				else
					message = 'Per favore, correggi i ' + errors + ' campi contrassegnati in rosso.';
				$("div.alert").html(message);
				$("div.alert").show();
			} else {
				$("div.alert").hide();
			}
		}
	});
	
	
	// Validazione Staff
	$("#addstaff").validate({
		rules:{
			user:{
				required:true,
				maxlength:30
			},
			
			name:{
				required:true,
				maxlength:30
			},
			
			surname:{
				required:true,
				maxlength:30
			},
			
			password:{
				required:true,
				minlength:3,
				maxlength:25
			}
		},
		
		// Messaggi d'errore
		
		messages:{
			user:{
				required:"Devi inserire un username",
				maxlength:"Devi inserire un username di massimo 30 caratteri"
			},
		
			name:{
				required:"Devi inserire un nome",
				maxlength:"Devi inserire un nome di massimo 30 caratteri"
			},
			
			surname:{
				required:"Devi inserire un cognome",
				maxlength:"Devi inserire un nome di massimo 30 caratteri"
			},
			
			password:{
				required:"Devi inserire una password",
				minlength:"Devi inserire una password di almeno 3 caratteri",
				maxlength:"Devi inserire una password di massimo 25 caratteri"
			},
		},
		
		// Azioni da fare in caso di errore
		highlight: function(element){
			$(element).addClass("alert alert-danger");
		},
		//e quando l'errore viene risolto
		unhighlight: function(element){
			$(element).removeClass("alert alert-danger");
		},
		
		// Eseguita in caso di errore, mostra il box informazione con gli errori
		invalidHandler: function(e, validator) {
			var errors = validator.numberOfInvalids();
			var message = '';
			if (errors) {
				if(errors == 1)
					message = 'Un campo è incompleto: per favore riempilo.';
				else
					message = 'Per favore, correggi i ' + errors + ' campi contrassegnati in rosso.';
				$("div.alert").html(message);
				$("div.alert").show();
			} else {
				$("div.alert").hide();
			}
		}
	});
	
	// Validazione User
	$("#adduser").validate({
		rules:{
			user:{
				required:true,
				maxlength:30
			},
			
			name:{
				required:true,
				maxlength:30
			},
			
			surname:{
				required:true,
				maxlength:30
			},
			
			password:{
				required:true,
				minlength:3,
				maxlength:25
			}
		},
		
		// Messaggi d'errore
		
		messages:{
			user:{
				required:"Devi inserire un username",
				maxlength:"Devi inserire un username di massimo 30 caratteri"
			},
		
			name:{
				required:"Devi inserire un nome",
				maxlength:"Devi inserire un nome di massimo 30 caratteri"
			},
			
			surname:{
				required:"Devi inserire un cognome",
				maxlength:"Devi inserire un nome di massimo 30 caratteri"
			},
			
			password:{
				required:"Devi inserire una password",
				minlength:"Devi inserire una password di almeno 3 caratteri",
				maxlength:"Devi inserire una password di massimo 25 caratteri"
			},
		},
		
		// Azioni da fare in caso di errore
		highlight: function(element){
			$(element).addClass("alert alert-danger");
		},
		//e quando l'errore viene risolto
		unhighlight: function(element){
			$(element).removeClass("alert alert-danger");
		},
		
		// Eseguita in caso di errore, mostra il box informazione con gli errori
		invalidHandler: function(e, validator) {
			var errors = validator.numberOfInvalids();
			var message = '';
			if (errors) {
				if(errors == 1)
					message = 'Un campo è incompleto: per favore riempilo.';
				else
					message = 'Per favore, correggi i ' + errors + ' campi contrassegnati in rosso.';
				$("div.alert").html(message);
				$("div.alert").show();
			} else {
				$("div.alert").hide();
			}
		}
	});
	
	
});