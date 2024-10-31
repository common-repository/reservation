<?php

	 function NTRAgeneralSetting(){
		 if ( current_user_can('manage_options') ){
	?>
	<div class="wrap">
	<?php settings_errors(); ?>
		<div class="layTitle">General Setting</div>
			<form method="post" action="options.php">
			 <?php settings_fields( 'general-settings-group' ); ?>
			 <?php do_settings_sections( 'general-settings-group' ); ?>
			 <?php wp_nonce_field( 'name_of_my_action', 'name_of_nonce_field' ); ?>
				
					<div class="maindiv">
						<div class="form-group wid">
							<div class="leftblk">
								<label>Subscribed to the payment gateway with Navotar?  </label>
							</div>
							<div class="rightblk">
								<input type="checkbox" name="enablepayment" value="On" <?php if( esc_attr( get_option('enablepayment') ) == 'On') { echo 'checked'; } ?>  />
							</div>
						</div>
					</div>
					
				
				<?php submit_button(); ?>
				
			</form>
	</div>
	<div class="clear"></div>
	<?php
		}
	}

