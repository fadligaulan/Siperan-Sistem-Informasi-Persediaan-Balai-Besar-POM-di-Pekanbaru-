const flashData = $('.flash-data').data('flashdata');

if(flashData) {
	Swal({
		title: 'Data Order',
		text: 'Berhasil'+ flashData,
		type: 'success'
	});
}