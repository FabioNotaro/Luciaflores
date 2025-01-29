	

$(window).on('load', function (e) {
	$("#basic-datatables").DataTable({
		language: {
			url: '//cdn.datatables.net/plug-ins/2.2.1/i18n/pt-BR.json',
		},
	});
});

// $('.nav-secondary').on('click', 'li', function() {
// 	$('.nav-secondary li.active').removeClass('active');
// 	$(this).addClass('active');
// });
