jQuery(document).ready(function() {

	$("#contact-ajax").on("click", function(e) {
		e.preventDefault();	
		
		carga();
	
	
	
	});
	$(document).delegate("#send-contact", "click", function (t) {
		t.preventDefault();
		$('input.wpcf7-submit').trigger('click');
		
	});
	$(document).delegate("#cancel-contact", "click", function (t) {
		t.preventDefault();
		$("#modal-contact.modal-contact2").css('display','none');
		
	});
	$(document).delegate(".pesta", "click", function (t) {
		t.preventDefault();
			var r = $(this).attr("data-pesta");
			
			if(r=='pesta1'){
				$('#send-contact').css('display','');
				$('#pesta1').css('display','');
				$('#pesta2').css('display','none');
				$(".pesta2").removeClass("active");
				$(".pesta1").addClass("active");
			
			}else if(r=='pesta2'){
			
			$('#send-contact').css('display','none');
			$('#pesta2').css('display','');
			$('#pesta1').css('display','none');
			$(".pesta1").removeClass("active");
			$(".pesta2").addClass("active");
			
			
			}
			
		
	});
	
	
	

function carga(){	

				$('#pesta1').css('display','');
				$('#pesta2').css('display','none');
				$(".pesta2").removeClass("active");
				$(".pesta1").addClass("active");
				$('#send-contact').css('display','');
				$("#modal-contact.modal-contact2").css('display','');
	
		
	
	if ($('#pesta2').length == 0){
	
		

	
		$.ajax(thb_system.root_url + '/?contactajax=true', {
				error: function( xhr, ajaxOptions, thrownError ) {
					alert('error');
				},
				success: function(data) {
					$('#lod').css('display','none');
					$('#saicl-modal-content.conta').html(data);
					$('input.wpcf7-submit').css('display','none');
					
					_wpcf7.supportHtml5 = $.wpcf7SupportHtml5();
					$('div.wpcf7 > form').wpcf7InitForm();
					
				}
		});	
	
	}
}

});