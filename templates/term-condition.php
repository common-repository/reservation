<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 get_header(); 

 ?>

<?php

if(isset($_REQUEST['cid'])){
	$cid = sanitize_text_field($_REQUEST['cid']);
}
$parms = array('id'=>$cid);
?>
<div class="wrap">
<div class="navotar">
	<div class="termssection1">
		<div class="divalignfirst">
			<i class="fa fa-user"></i> Terms And Conditions
		</div>
	</div>
	<div id="mes"></div>
	 <div class="condition">
	 
	   <?php if(esc_attr(get_option('area2')) !=''){echo get_option('area2');} ?>
     </div>
	 
	 <div class="detailcar" id="singledata">	
		<div id="loaderlsit" style="display:none; width:150px; margin:0px auto;"></div>
	</div> 
	 <input type="submit" class="btn btn-info continuous" name="cont" value="Continue" id="continues" />
</div>

<div style="clear:both;"></div>
<?php get_footer(); ?>

<script>
function isNumeric(value) {
    return /^-{0,1}\d+$/.test(value);
}
jQuery(document).ready(function($) {
	$(document).on( "click", "#continues", function() {
		$('#loaderlsit').html('<img src="'+plugin_url+'/images/loader.gif" class="loader" />').fadeIn();
		$.ajax({
			url: MS_Ajax.ajaxurl,
			type: 'POST',
			data:{
				'action':'NTRAcreateReservtion',
				'security':MS_Ajax.nextNonce,
				'cid':<?php echo $cid; ?>
				},
			dataType: 'html', 
			success: function(res) {
				
				if(res){
					window.location.href = "<?php echo get_permalink( get_page_by_path( 'thankyou' ));?>?id="+res;
					$('#loaderlsit').hide();
				}
				else{
					var msg = '0';
					window.location.href = "<?php echo get_permalink( get_page_by_path( 'thankyou' ));?>?id="+msg;
					$('#loaderlsit').hide();
				}
			},
			error:function(err){
				
				
			}
		});
	});
});


</script>