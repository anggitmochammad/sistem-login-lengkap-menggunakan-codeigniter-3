const flashdata = $('.flash-data').data('flashdata');
if (flashdata) {
	Swal.fire({
		title: 'Success',
		text: flashdata,
		icon: 'success'
	});
}

//tombol hapus menu
$('.delete-menu').on('click', function (e) {

	//mematikan default yaitu link a
	e.preventDefault();

	//mengambil attribute href
	const href = $(this).attr('href');

	Swal.fire({
		title: '<strong>Are you sure?</strong>',
		icon: 'warning',
		text: 'your data will be deleted?',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Delete Data',
		cancelButtonText: 'Cancel',
		reverseButtons: true

	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});


});
