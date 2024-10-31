<script type="text/javascript">
				bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
			</script>
<?php
	
	 function NTRAtermConditionEditor(){
		 if (current_user_can('manage_options')){
	?>
	<div class="wrap">
	<?php settings_errors(); ?>
	<p id="sucessmessage"></p>
	
		<div class="layTitle">Term & Condition Editor</div>
		 <button class="button" id="navupdate" style="float: right;margin-top: 20px;">Update navotar Terms & Condition</button>
		<form method="post" action="options.php">
			<?php settings_fields( 'terms-settings-group' ); ?>
			<?php do_settings_sections( 'terms-settings-group' ); ?>
			<?php wp_nonce_field( 'terms_setting_action', 'terms_setting' ); ?>
		    <h3>Term and Conditions</h3>   
			<div class="paddingclass">
				<textarea name="area2" style="width: 100%;height:300px;background:#ffffff;"><?php echo get_option('area2');  ?></textarea>
			</div>
			<p class="submit"><input type="submit" name="update_terms" id="submit" class="button button-primary" value="Update Changes"></p>
		</form>
	</div>
	<?php
		}
	}