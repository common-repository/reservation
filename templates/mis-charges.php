<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
get_header();?>
<?php 
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
$_SESSION['search_info'] = array();
 array_push($_SESSION['search_info'],sanitize_text_field($_REQUEST['vehicle'])); 

?>
<div class="wrap">
<div class="navotar">
	<div class="topbarnew">
		<p>Home > Select Car > <span class="redish">Options </span>> Confirm</p>
	</div>
    <div class="tbldiv" id="mscharges">
		<center>
			<div id="loaderlsit" style="display: none;position:absolute;z-index:1;margin:0px 35%;">
				<img src="<?php echo plugins_url('images/loader.gif', __FILE__); ?>" class="loader">
			</div>
		</center>
	</div>
    

</div>

<script>
function NTRAreservationMisCharges(){
	var vtid = <?php if(!empty($_REQUEST['vehicle'])){ echo esc_html($_REQUEST['vehicle']); }  ?>;
    var lid = <?php if(!empty($_REQUEST['loc'])){ echo esc_html($_REQUEST['loc']); }  ?>;
	var pick = <?php if(!empty($_REQUEST['pick'])){ echo esc_html($_REQUEST['pick']); }  ?>;
	var drop = <?php if(!empty($_REQUEST['drop'])){ echo esc_html($_REQUEST['drop']); }  ?>;
	var rateid = <?php if(!empty($_REQUEST['rateid'])){ echo esc_html($_REQUEST['rateid']); }  ?>;
	var vehicleTypeId = <?php if(!empty($_REQUEST['vehicleTypeId'])){ echo esc_html($_REQUEST['vehicleTypeId']); }  ?>;
	 jQuery('#loaderlsit').html('<img src="'+plugin_url +'/images/loader.gif" class="loader" />').fadeIn();
	jQuery.ajax({
		url: MS_Ajax.ajaxurl,
		type: 'POST',
		data:{'vtid':vtid,'lid':lid,'pick':pick,'drop':drop,'rateId':rateid,'vehicleTypeId':vehicleTypeId,'action':'NTRAmisCharges','security':MS_Ajax.nextNonce},
		dataType: 'html', // added data type
		success: function(res) {
			
			jQuery('#mscharges').html(res);
		},
		error:function(err){
			console.log(err);
		}
	});
}
NTRAreservationMisCharges();


jQuery(document).ready(function($) { 
	var getloc = localStorage.getItem('selectedLoc');
	$('.headerloc').append(getloc);
});


</script>


<div style="clear:both;"></div>
<?php get_footer(); ?>