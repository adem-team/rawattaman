/**
 * ===============================
 * JS Modal item
 * Author	: ptr.nov2gmail.com
 * Update	: 21/01/2017
 * Version	: 2.1
 * ===============================
*/


/*
 *  PRODUK CREATE.
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};	
$(document).on('click','#button-pekerja-create', function(ehead){ 			  
	$('#modal-pekerja-create').modal('show')
	.find('#content-pekerjapekerja-create').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	.load(ehead.target.value);
});

