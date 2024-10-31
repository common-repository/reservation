<?php

/*if(!empty(get_option('apiConsumerSecret')) && !empty(get_option('clientIDs'))){
 	wp_safe_redirect ('?page=layout-settings');
	
}*/
if ( current_user_can('manage_options') ){
?>
<div class="login-page">
<center><h3>Navotar Login</H3></center>
<p class="loginheading">To activate plugin or change IDs, please login here. </p>

  <div class="form">
  <div id="result"></div>
  

    <form id="loginform" class="login-form" method="POST" action="login.php">
		<?php settings_fields( 'login-group' ); ?>
		<?php do_settings_sections( 'login-group' ); ?>
		<?php wp_nonce_field( 'name_of_my_action', 'name_of_nonce_field' ); ?>
      <input type="text" placeholder="Client ID" name="ClientId" required />
	  <input type="text" placeholder="API Client ID" name="ApiClientId" required />
      <input type="text" name="secret" placeholder="Secret Key" required />
	  <input type="hidden" name="ConsumerType" value="Admin,Basic" />
      <?php if(!empty( esc_attr(get_option('clientIDs')))){ ?>
		<input id="button" type="submit" value="Update" name="submit" class="btn btn-primary" />  
	  <?php }else{?>
	  <input id="button" type="submit" value="Login" name="submit" class="btn btn-primary" />
	  <?php } ?>
      <p class="message">Not registered? <a href="https://navotar.com/" target="_blank">Create an account</a></p>
    </form>
  </div>
</div>
<?php
}
?>

