jQuery(document).ready(function ($) {
	var $form  = $('.et-divi-toolbox-form');
	 if ($.fn.hurkanSwitch) {
	 
	 $('.checkbox').hurkanSwitch({
		'onTitle':'On',
		'offTitle':'Off',
		'responsive':true

	});
	 
	 $('.on-off').hurkanSwitch({
		'onTitle':'ON',
		'offTitle':'OFF',
		'responsive':true

	});
	
	}
	
	// Show & Hide Toolbox Options
	$('.hide, .dmpro-cust-link').not('.dmpro-visible').hide();
	$('.trigger .hurkanSwitch-switch-item-status-on.active').closest('.trigger').next('.hide').show();
	$('.hurkanSwitch-switch-item-status-on.active').closest('.box-content').next('.dmpro-cust-link').show();
	
	$('.trigger .minibox, .ico-trigger .minibox').click(function(){
	  if($('.hurkanSwitch-switch-item-status-on', this).hasClass('active')) {
		  $(this).parent('.trigger').next('.hide').show();
		  $(this).next('.dmpro-cust-link').show();
		}
	  else{
	    $(this).parent('.trigger').next('.hide').hide();
		  $(this).next('.dmpro-cust-link').hide();
	  }
	 });
	 
	$('.tool-section').next('.toolbox').addClass('first');
	$('.tool-section:not(.first)').prev().addClass('last');
	
	$('#epanel-save').click(function(){
		$('#dmpro_export_submit_hidden_input').remove();
		$('#dmpro_import_submit_hidden_input').remove();
	});
	$('#dmpro_settings_form input').on('keypress', function(event) {
		if(event.keyCode == 13){
			event.preventDefault()
		}
   });
   var dmpro_custom_preloader_image = $('#dmpro_custom_preloader_image');
   var dmpro_custom_preloader_image_val = $('#dmpro_custom_preloader_image').prop('checked');
   var dmpro_preloaders_list = $('#dmpro_preloaders_list');
   if(dmpro_custom_preloader_image_val){
		dmpro_preloaders_list.hide();
   }
   dmpro_custom_preloader_image.on('change', function(){
		if($(this).prop('checked')){
			dmpro_preloaders_list.hide();
		}
		else{
			dmpro_preloaders_list.show();			
		}
   });

   var dmpro_ajax_saving = $('#dmpro-epanel-ajax-saving');
	var dmpro_ajax_loader = $('#dmpro-epanel-ajax-saving').find('img');
	$('#dmpro-clear-cache').click(function(){
		dmpro_ajax_saving.css('display','block');
		dmpro_ajax_loader.css('display','block');
		$.ajax( {
			url: toolbox_values.dmpro_rest_api_root + 'dmpro/v1/clear-cache',
			method: 'GET',
			beforeSend: function ( xhr ) {
				xhr.setRequestHeader( 'X-WP-Nonce', toolbox_values.dmpro_rest_api_nonce );
			}
		} ).done( function ( response ) {
			dmpro_ajax_loader.css('display','none');
			dmpro_ajax_saving.addClass('success-animation');
			setTimeout(function(){
				dmpro_ajax_saving.removeClass('success-animation').css('display','none')
			}, 1200);
			
		} );
	})

});

jQuery(document).ready(function(){	
	jQuery('.dmpro-loader .status').delay(300).fadeOut('slow');
	jQuery('.dmpro-loader').delay(300).fadeOut('slow');
	jQuery('#dmpro .page-container').css('min-height','0');
})