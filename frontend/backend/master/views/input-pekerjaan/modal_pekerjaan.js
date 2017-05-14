/**
 * ===============================
 * JS Modal item
 * Author	: ptr.nov2gmail.com
 * Update	: 21/01/2017
 * Version	: 2.1
 * ===============================
*/


/*
 *  CLIENT CREATE.
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};	
$(document).on('click','#button-client-create', function(ehead){ 			  
	$('#modal-client-create').modal('show')
	.find('#content-client-create').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	.load(ehead.target.value);
});

/*
 *JADWAL CREATE.
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};	
$(document).on('click','#button-jadwal-create', function(ehead){ 			  
	$('#modal-jadwal-create').modal('show')
	.find('#content-jadwal-create').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	.load(ehead.target.value);
});

/*
 * RATING CREATE.
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};	
$(document).on('click','#button-rating-create', function(ehead){ 			  
	$('#modal-rating-create').modal('show')
	.find('#content-rating-create').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	.load(ehead.target.value);
});

