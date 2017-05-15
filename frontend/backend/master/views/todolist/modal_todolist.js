/**
 * ===============================
 * JS Modal item
 * Author	: ptr.nov2gmail.com
 * Update	: 21/01/2017
 * Version	: 2.1
 * ===============================
*/


/*
 *  TODOLIST  CREATE.
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};	
$(document).on('click','#button-todolist-create', function(ehead){ 			  
	$('#modal-todolist-create').modal('show')
	.find('#content-todolist-create').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	.load(ehead.target.value);
});

/*
 *  TODOLIST  VIEW.
*/
$.fn.modal.Constructor.prototype.enforceFocus = function(){};	
$(document).on('click','#button-todolist-update', function(ehead){ 			  
	$('#modal-todolist-update').modal('show')
	.find('#content-todolist-update').html('<i class=\"fa fa-2x fa-spinner fa-spin\"></i>')
	.load(ehead.target.value);
});

