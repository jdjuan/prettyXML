$(function(){
	$('.btn-file :file').on('fileselect', function(event, numFiles, label) {
		swal(label + " is ready to be uploaded!", "Press upload to continue", "success");
	});
	$(document).on('change', '.btn-file :file', function() {
		var input = $(this);
		var numFiles = input.get(0).files ? input.get(0).files.length : 1;
		var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [numFiles, label]);
	});
});
