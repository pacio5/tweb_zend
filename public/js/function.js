$(document).ready(function() {
	// Intercetto lo scroll di pagina
	$(window).scroll(function() {
		if ($(this).scrollTop() > 600) {
			// Se l'evento scroll si verifica e supera i 400px, mostro l'icona
			$("#back_to_top").show(1000);
		}
		// Se si verifica il ritorno sopra i 400px, nascondo l'icona
		if ($("body").scrollTop() < 400) {
			$("#back_to_top").hide(1000);
		}
	});

	// Al click sull'icona, torno ad inizio pagina con movenza fluida
	$("#back_to_top").click(function() {
		$("html,body").animate({
			scrollTop : 0
		}, 1500, function() {
		});
	});
});