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
$(document).on('click','#button-produk-create', function(ehead){ 			  
	$('#modal-produk-create').modal('show')
	.find('#content-produk-create').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	.load(ehead.target.value);
});
/*
 *  UPDATE CREATE.
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};	
$(document).on('click','#button-prodak-update', function(ehead){ 			  
	$('#modal-produk-update').modal('show')
	.find('#content-produk-update').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	.load(ehead.target.value);
});

