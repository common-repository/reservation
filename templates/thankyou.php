<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 get_header();  ?>
<?php
  if (!isset($_SESSION))
  {
    @session_destroy();
  }
  
   if(isset($_REQUEST['id'])){
	$id = str_replace('\"', '', sanitize_text_field($_REQUEST['id']));
	}
?>
<div class="jumbotron">
  <h1 class="display-3">Thank You!</h1>
  <p class="lead">
	<strong>Thankyou for Booking</strong> 
	Your reservation is made. One of our representatives will call to confirm the booking.
	<?php 
	if($id ==0){
		echo'you are already register with us.';
	}else{?>
	Your reservation number is <?php echo @$id; ?> 
	<?php } ?>
  </p>
 
  
</div>

<?php  get_footer(); ?>