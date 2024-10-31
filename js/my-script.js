

jQuery(document).ready(function($) { 
		//box layout
		$('#box_button_background').wpColorPicker();
		$('#box_form_background').wpColorPicker();
		$('#box_title_background').wpColorPicker();
		$('#mv_cr_section_color').wpColorPicker();
		$('#form_heading_color').wpColorPicker();
		$('#form_link_color').wpColorPicker();
		
		//retunglue layout$('#box_button_background').wpColorPicker();
		$('#rec_button_background').wpColorPicker();
		$('#rec_form_background').wpColorPicker();
		$('#rec_title_background').wpColorPicker();
		$('#rec_section_color').wpColorPicker();
		$('#rec_form_heading_color').wpColorPicker();
		
		//listing layout
		$('#list_background_color').wpColorPicker();
		$('#list_header_color').wpColorPicker();
		$('#list_heading_color').wpColorPicker();
		$('#list_subheading_color').wpColorPicker();
		$('#list_font_color').wpColorPicker();
		$('#list_footer_color').wpColorPicker();
		$('#list_btn_color').wpColorPicker();
		
		
		
		
		$("#loginform").submit(function(event) {
			
			event.preventDefault();
			$('#result').html('<img src="'+plugin_url+'/images/loader.gif" class="loader" />').fadeIn();
			var input_data = $('#loginform').serialize()+ '&action=NTRAreservationLogin'+'&security='+ MS_Ajax.nextNonce;
			/*-------------nonces used ----------*/
			$.ajax({
				type: "POST",
				url:MS_Ajax.ajaxurl,
				data: input_data,
				success: function(msg){
					$('.loader').remove();
					$('<div>').html(msg).appendTo('#result').hide().fadeIn('slow');
					setTimeout(function(){ window.location.href = "admin.php?page=layout-settings"; }, 1000); 
				}
			});
			return false;

		});
		
		
		
	/*---------------nonces used----------*/	
		
	$('#navupdate').click( function(){
		$.ajax({
			url:MS_Ajax.ajaxurl,
			type: 'GET',
			dataType: 'html', // added data type
			data:{'action':'NTRAreservationTerms','security':MS_Ajax.nextNonce}, 
			success: function(res) {
				$('#sucessmessage').html(res);
			},
			error:function(err){
				console.log(err);
			}
		});
	});
	
}); 
	
	