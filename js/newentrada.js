jQuery(document).ready( function(){



if (!jQuery('input#post-format-image').is(':checked')){

	jQuery("#wpcf-group-image").hide();

}

jQuery("#wp-content-media-buttons").hide();
jQuery("#postimagediv").hide();



jQuery(document).delegate('input#post-format-image', 'click', function (event) {

jQuery("#wpcf-group-image").show();

});

jQuery(document).delegate('input#post-format-0', 'click', function (event) {

	
jQuery("#wpcf-group-image").hide();

});



});