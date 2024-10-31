<?php
function NTRAmyCoolPluginSettingsPage() {
?>
<div class="wrap">
<?php settings_errors(); ?>
<div class="layTitle">Colour & Font Selection</div>

<form method="post" action="options.php">
    <?php settings_fields( 'my-cool-plugin-settings-group' ); ?>
    <?php do_settings_sections( 'my-cool-plugin-settings-group' ); ?>
	<?php wp_nonce_field( 'cool_pluign', 'my_cool_plugin' ); ?>
	<div class="maindiv">
		<div class="left" <?php if( esc_attr( get_option('searchLayout') ) == 'rec_layout') { echo "style=' opacity: 0.5;cursor: not-allowed;'"; } ?>>
		<h3>Box Layout</h3>
			<div class="blockdiv">
				<div class="lbl">Form Background</div>
				<div class="inbox">
					<input type="text" name="box_form_background" id="box_form_background" value="<?php echo esc_attr( get_option('box_form_background') ); ?>" data-default-color="#CECEE8" />
				</div>
			</div>
			
			<div class="blockdiv">
				<div class="lbl">Title Background</div>
				<div class="inbox">
					<input type="text" name="box_title_background" id="box_title_background" value="<?php echo esc_attr( get_option('box_title_background') ); ?>" data-default-color="#2D00C4" />
				</div>
			</div>
			
			<div class="blockdiv">
				<div class="lbl">Button Colour</div>
				<div class="inbox">
					<input type="text" name="box_button_background" id="box_button_background" value="<?php echo esc_attr( get_option('box_button_background') ); ?>" data-default-color="#3D19AA" />
				</div>
			</div>
			
			<div class="blockdiv">
				<div class="lbl">Font Colour</div>
				<div class="inbox">
					<input name="mv_cr_section_color" type="text" id="mv_cr_section_color" value="<?php echo esc_attr( get_option('mv_cr_section_color') ); ?>" data-default-color="#0D5632" >
				</div>
			</div>
			
			<div class="blockdiv">
				<div class="lbl">Heading Colour</div>
				<div class="inbox">
					<input name="form_heading_color" type="text" id="form_heading_color" value="<?php echo esc_attr( get_option('form_heading_color') ); ?>" data-default-color="#595959" >
				</div>
			</div>
			
			<div class="blockdiv">
				<div class="lbl">Heading Size</div>
				<div class="inbox">
					<input name="box_form_heading_size" pattern="\d*" minlength="1" maxlength="2" oninvalid="this.setCustomValidity('Please enter only number')"
    oninput="this.setCustomValidity('')" id="box-font-size" type="text" value="<?php echo esc_attr( get_option('box_form_heading_size') ); ?>" placeholder="18" size="20">
				</div>
			</div>
			
			<div class="blockdiv">
				<div class="lbl">Font Size</div>
				<div class="inbox">
					<input name="box_form_font_size" type="text" pattern="\d*" minlength="1" maxlength="2" oninvalid="this.setCustomValidity('Please enter only number')"
    oninput="this.setCustomValidity('')" id="box-font-size" value="<?php echo esc_attr( get_option('box_form_font_size') ); ?>" placeholder="14">
				</div>
			</div>
			
		</div>  <!--left div -->
		
		
		<div class="right"  <?php if( esc_attr( get_option('searchLayout') ) == 'box_layout') { echo "style=' opacity: 0.5;cursor: not-allowed;'"; } ?>> <!--right div -->
			<h3>Rectangle Layout</h3>
			<div class="blockdiv">
				<div class="lbl">Form Background</div>
				<div class="inbox">
					<input type="text" name="rec_form_background" id="rec_form_background" value="<?php echo esc_attr( get_option('rec_form_background') ); ?>" data-default-color="#5A938B" />
				</div>
			</div>
			
			<div class="blockdiv">
				<div class="lbl">Title Background</div>
				<div class="inbox">
					<input type="text" name="rec_title_background" id="rec_title_background" value="<?php echo esc_attr( get_option('rec_title_background') ); ?>" data-default-color="#DDDDDD" />
				</div>
			</div>
			
			<div class="blockdiv">
				<div class="lbl">Button Colour</div>
				<div class="inbox">
					<input type="text" name="rec_button_background" id="rec_button_background" value="<?php echo esc_attr( get_option('rec_button_background') ); ?>" data-default-color="#F21000" />
				</div>
			</div>
			
			<div class="blockdiv">
				<div class="lbl">Font Colour</div>
				<div class="inbox">
					<input name="rec_section_color" type="text" id="rec_section_color" value="<?php echo esc_attr( get_option('rec_section_color') ); ?>" data-default-color="#EDDD04" >
				</div>
			</div>
			
			<div class="blockdiv">
				<div class="lbl">Heading Colour</div>
				<div class="inbox">
					<input name="rec_form_heading_color" type="text" id="rec_form_heading_color" value="<?php echo esc_attr( get_option('rec_form_heading_color') ); ?>" data-default-color="#427ED1" >
				</div>
			</div>
			
			<div class="blockdiv">
				<div class="lbl">Heading Size</div>
				<div class="inbox">
					<input name="rec_form_heading_size" pattern="\d*" minlength="1" maxlength="2" oninvalid="this.setCustomValidity('Please enter only number')"
    oninput="this.setCustomValidity('')" id="box-font-size" type="text" value="<?php echo esc_attr( get_option('rec_form_heading_size') ); ?>" placeholder="18" size="20">
				</div>
			</div>
			
			<div class="blockdiv">
				<div class="lbl">Font Size</div>
				<div class="inbox">
					<input name="rec_form_font_size" pattern="\d*" minlength="1" maxlength="2" oninvalid="this.setCustomValidity('Please enter only number')"
    oninput="this.setCustomValidity('')" type="text" id="box-font-size" value="<?php echo esc_attr( get_option('rec_form_font_size') ); ?>" placeholder="14">
				</div>
			</div>
			
		</div>  <!--right div -->
	</div><!--main div -->	
	
	<div class="clear"></div>
	<div class="globalblock">
		<div class="heading">Vehicle Listing</div>
		
		<div class="gleft">
			<div class="lbl">Background Colour</div>
			<div class="inbox">
				<input name="list_background_color" type="text" id="list_background_color" value="<?php echo esc_attr( get_option('list_background_color') ); ?>" data-default-color="#293FE5" >
			</div>
		</div>
		
		<div class="gleft">
			<div class="lbl">Header Colour</div>
			<div class="inbox">
				<input name="list_header_color" type="text" id="list_header_color" value="<?php echo esc_attr( get_option('list_header_color') ); ?>" data-default-color="#EAEAEA" >
			</div>
		</div>
		
		<div class="gleft">
			<div class="lbl">Heading Colour</div>
			<div class="inbox">
				<input name="list_heading_color" type="text" id="list_heading_color" value="<?php echo esc_attr( get_option('list_heading_color') ); ?>" data-default-color="#474747" >
			</div>
		</div>
		
		<div class="gleft">
			<div class="lbl">Sub Title Colour</div>
			<div class="inbox">
				<input name="list_subheading_color" type="text" id="list_subheading_color" value="<?php echo esc_attr( get_option('list_subheading_color') ); ?>" data-default-color="#4F4F4F" >
			</div>
		</div>
		
		<div class="gleft">
			<div class="lbl">Font Colour</div>
			<div class="inbox">
				<input name="list_font_color" type="text" id="list_font_color" value="<?php echo esc_attr( get_option('list_font_color') ); ?>" data-default-color="#5B5B5B" >
			</div>
		</div>
		
		<div class="gleft">
			<div class="lbl">Heading Size</div>
			<div class="inbox">
				<input name="list_heading_size" type="text"  pattern="\d*" minlength="1" maxlength="2" oninvalid="this.setCustomValidity('Please enter only number')"
    oninput="this.setCustomValidity('')" id="box-font-size" value="<?php echo esc_attr( get_option('list_heading_size') ); ?>" placeholder="14">
			</div>
		</div>
		
		<div class="gleft">
			<div class="lbl">Normal Font Size</div>
			<div class="inbox">
				<input name="list_normal_size" type="text"  pattern="\d*" minlength="1" maxlength="2" oninvalid="this.setCustomValidity('Please enter only number')"
    oninput="this.setCustomValidity('')"  id="box-font-size" value="<?php echo esc_attr( get_option('list_normal_size') ); ?>" placeholder="14">
			</div>
		</div>
		
		<div class="gleft">
			<div class="lbl">Sub Title Font Size</div>
			<div class="inbox">
				<input name="list_sub_title_size" type="text"  pattern="\d*" minlength="1" oninvalid="this.setCustomValidity('Please enter only number')"
    oninput="this.setCustomValidity('')" maxlength="2" id="box-font-size" value="<?php echo esc_attr( get_option('list_sub_title_size') ); ?>" placeholder="14">
			</div>
		</div>
		
		
		<div class="gleft">
			<div class="lbl">Button Background</div>
			<div class="inbox">
				<input name="list_btn_color" type="text" id="list_btn_color" value="<?php echo esc_attr( get_option('list_btn_color') ); ?>" data-default-color="#4447ED" >
			</div>
		</div>
		
		
		
	</div>
	<div class="clear"></div>
	<?php submit_button(); ?>

</form>
</div>
<?php } 