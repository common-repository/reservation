<?php

	 function NTRAlayoutSetting(){
		if ( current_user_can('manage_options') ){
	?>
	<div class="wrap">
		<?php settings_errors(); ?>
		<div class="layTitle">Layout</div>
		<form method="post" action="options.php">
		<?php settings_fields( 'layout-settings-group' ); ?>
		<?php do_settings_sections( 'layout-settings-group' ); ?>
		 <?php wp_nonce_field( 'layout_setting_action', 'layout_setting' ); ?>
		<div class="maindiv">
			<div class="left">
				<p class="paragraph">Select Form Layout</p>
				<div class="layoutdiv">
					<div class="inbox">
						<input type="radio" name="searchLayout" id="box_layout" value="box_layout" <?php if( esc_attr( get_option('searchLayout') ) == 'box_layout') { echo 'checked'; } ?> /> Box Layout   
						<span class="shortcode">Shortcode:  [navotarBoxSearch] </span>
						<span class="shortcode">For PHP File: do_shortcode("[navotarBoxSearch]");</span>
						<span class="pluginnotes"><b>Note:</b> If you are usinig box layout. you need to add its shortcode in your page or post.</span>
					</div>
					<div class="lbl"><img src="<?php echo plugins_url('reservation/images/1.png'); ?>" /></div>
				</div>
				
				<div class="layoutdiv">
					<div class="inbox">
						<input type="radio" name="searchLayout" id="box_layout" value="rec_layout" <?php if( esc_attr( get_option('searchLayout') ) == 'rec_layout') { echo 'checked'; } ?> /> Rectangle Layout 
						<span class="shortcode">Shortcode:  [navotarRectSearch] </span>
						<span class="shortcode">For PHP File: do_shortcode("[navotarRectSearch]");</span>
						<span class="pluginnotes"><b>Note:</b> If you are usinig rectangle layout. you need to add its shortcode in your page or post.</span>
					</div>
					<div class="lbl"><img src="<?php echo plugins_url('reservation/images/2.png'); ?>" class="recimg" /></div>
				</div>
				<div class="cblock_main">
					<div class="clear"></div>
					<div class="cblock">
					<span class="titleheading">Set Height and width of Box Layout form</span>
						<div class="cols">
						    <span class="pluginnotes buabal">( Min: 430px, Max:700px. Height is depend upon how many field you display in form. for default fields 430px height suggested. if you select Age, promocode or dropoff location, then you should increse form height according to view.)</span>
							<div class="lbl">Height </div>
							
							<div class="inbox">
								<input type="number" pattern="\d*" minlength="1" maxlength="4"  min="430" max="700" name="searchHeight" id="searchHeight" value="<?php echo esc_attr( get_option('searchHeight') ); ?>"  placeholder="500" />
							</div>
						</div>
						
						<div class="cols">
						<span class="pluginnotes buabal">( Min: 550px, Max:700px.  The width should be not less than 550px and not more than 700px. </span>
							<div class="lbl">Width <span class="pluginnotes">( Min: 550px, Max:700px )</span></div>
							<div class="inbox">
								<input type="number" name="searchWidth" pattern="\d*" minlength="1" maxlength="4"  min="550" max="700" id="searchWidth" value="<?php echo esc_attr( get_option('searchWidth') ); ?>" placeholder="550"  />
							</div>
						</div>
					</div>
					
					
					
					
					<div class="cblock_1">
					<span class="titleheading">Set Height and width of Rectangle Layout form</span>
						<div class="cols">
						 <span class="pluginnotes buabal">( Min: 360px, Max:600px. Height is depend upon how many field you display in form. for default fields 330px height suggested. if you select Age, promocode or dropoff location, then you should increse form height according to view.)</span>
							<div class="lbl">Height <span class="pluginnotes">( Min: 360px, Max:600px )</span></div>
							<div class="inbox">
								<input type="number" name="rectsearchHeight" pattern="\d*" minlength="1" maxlength="4" min="360" max="600" id="rectsearchHeight" value="<?php echo esc_attr( get_option('rectsearchHeight') ); ?>"  placeholder="500" />
							</div>
						</div>
						
						<div class="cols">
						<span class="pluginnotes buabal">( Min: 600px, Max:750px.  The width should be not less than 450px and not more than 700px. </span>
							<div class="lbl">Width <span class="pluginnotes">( Min: 600px, Max:750px )</span></div>
							<div class="inbox">
								<input type="text" pattern="\d*" minlength="1" maxlength="4" name="rectsearchWidth"  min="600" max="750" id="rectsearchWidth" value="<?php echo esc_attr( get_option('rectsearchWidth') ); ?>" placeholder="500"  />
							</div>
						</div>
					</div>
				</div>
				<div class="clear"></div>
				<p class="paragraph second">Select car listing layout</p>
				
				
				<div class="layoutdiv">
					<div class="inbox">
						<input type="radio" name="listingLayout" id="box_layout" value="list" <?php if( esc_attr( get_option('listingLayout') ) == 'list') { echo 'checked'; } ?> /> List View 
					</div>
					<div class="lbl"><img src="<?php echo plugins_url('reservation/images/6.png'); ?>" /></div>
				</div>
				
				<div class="layoutdiv">
					<div class="inbox">
						<input type="radio" name="listingLayout" id="box_layout" value="grid" <?php if( esc_attr( get_option('listingLayout') ) == 'grid') { echo 'checked'; } ?> /> Grid View 
					</div>
					<div class="lbl"><img src="<?php echo plugins_url('reservation/images/5.png'); ?>" class="recimg" /></div>
				</div>
				
				<div class="clear"></div>
				<?php submit_button(); ?>
				
			</div>
		</div>
		</form>
	</div>
	<?php
		}
	}

