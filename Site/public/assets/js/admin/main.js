	

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

(function () {
	'use strict'
  
	var forms = document.querySelectorAll('.needs-validation');
  
	Array.prototype.slice.call(forms)
	  .forEach(function (form) {
		form.addEventListener('submit', function (event) {
		  if (!form.checkValidity()) {
			event.preventDefault()
			event.stopPropagation()
		  };
  
		  form.classList.add('was-validated')
		}, false);
	  });
  })();

  