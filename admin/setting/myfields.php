<?php
namespace reservation;
class NTRA_MyFieldsOfNavotar{
	
	function __construct(){
		
	}
	
	function NTRAfieldSetting(){
		if ( current_user_can('manage_options') ){
	?>
		<div class="wrap">
			<?php settings_errors(); ?>
			<div class="layTitle">Fields Selection</div>
			<form method="post" action="options.php">
				<?php settings_fields( 'field-settings-group' ); ?>
				<?php do_settings_sections( 'field-settings-group' ); ?>
				<?php wp_nonce_field( 'field_setting_action', 'field_setting' ); ?>
				<div class="maindiv">
					<div class="left">
						<table class="timecard mrgi">
							<caption>Step1: Search Form Fields Setting</caption>
							<thead>
								<tr>
									<th id="thDay">FieldName</th>
									<th id="thRegular">Default Value</th>
									<th id="thOvertime">On / Off</th>
									<th id="thTotal">Mandatory</th>
								</tr>
							</thead>
							<tbody>
							
							
							
							<tr class="odd"> 
								<td>Dropoff Location</td><td>Optional</td>
								<td> <input type="checkbox" name="dropoffon" value="On" <?php if( esc_attr( get_option('dropoffon') ) == 'On') { echo 'checked'; } ?>  /></td>
								<td><input type="checkbox" name="dropoffMandatory" value="Yes" <?php if( esc_attr( get_option('dropoffMandatory') ) == 'Yes') { echo 'checked'; } ?> /></td> 
							</tr>
							<tr class="even"> 
								<td>Vehicle Type</td><td>Optional</td>
								<td> <input type="checkbox" name="vehType" value="On" <?php if( esc_attr( get_option('vehType') ) == 'On') { echo 'checked'; } ?>  /></td>
								<td><input type="checkbox" name="vehicleTypeMandatory" value="Yes" <?php if( esc_attr( get_option('vehicleTypeMandatory') ) == 'Yes') { echo 'checked'; } ?> /></td> 
							</tr>
							<tr class="odd"> 
								<td>Age</td><td>Optional</td>
								<td><input type="checkbox" name="age" value="On" <?php if( esc_attr( get_option('age') ) == 'On') { echo 'checked'; } ?>  /></td>
								<td><input type="checkbox" name="ageMandatory" value="Yes" <?php if( esc_attr( get_option('ageMandatory') ) == 'Yes') { echo 'checked'; } ?> /></td> 
							</tr>
							<tr class="even"> 
								<td>Promo Code</td><td>Optional</td>
								<td><input type="checkbox" name="promo" value="On" <?php if( esc_attr( get_option('promo') ) == 'On') { echo 'checked'; } ?> /></label></td>
								<td> <input type="checkbox" name="promoMandatory" value="Yes" <?php if( esc_attr( get_option('promoMandatory') ) == 'Yes') { echo 'checked'; } ?> /></td> 
							</tr>
						<tbody>
						</table>
						
						
						
						
						<!--  car listing data-->
						
						<table class="timecard">
							<caption>Step 2: Car Listing Fields Setting</caption>
							<thead>
								<tr>
									<th id="thDay">FieldName</th>
									<th id="thRegular">Default Value</th>
									<th id="thOvertime">On / Off</th>
									<th id="thTotal">Mandatory</th>
								</tr>
							</thead>
							<tbody>
							<tr class="odd"> 
								<td>Sample</td><td>Optional</td>
								<td><input type="checkbox" name="sample" value="On" <?php if( esc_attr( get_option('sample') ) == 'On') { echo 'checked'; } ?>/></td>
								<td><input type="checkbox" name="sampleMand" value="Yes" <?php if( esc_attr( get_option('dropoffMandatory') ) == 'Yes') { echo 'checked'; } ?>  disabled  /></td> 
							</tr>
							<tr class="even"> 
								<td>Seats</td><td>Optional</td>
								<td><input type="checkbox" name="seats" value="On" <?php if( esc_attr( get_option('seats') ) == 'On') { echo 'checked'; } ?>/></td>
								<td><input type="checkbox" name="seatsMand" value="Yes" <?php if( esc_attr( get_option('dropoffMandatory') ) == 'Yes') { echo 'checked'; } ?> disabled /></td> 
							</tr>
							<tr class="odd"> 
								<td>Doors</td><td>Optional</td>
								<td><input type="checkbox" name="doors" value="On" <?php if( esc_attr( get_option('doors') ) == 'On') { echo 'checked'; } ?> /></td>
								<td><input type="checkbox" name="doorsMand" value="Yes" <?php if( esc_attr( get_option('doorsMand') ) == 'Yes') { echo 'checked'; } ?>  disabled /></td> 
							</tr>
							<tr class="even"> 
								<td>Baggage </td><td>Optional</td>
								<td><input type="checkbox" name="baggage" value="On" <?php if( esc_attr( get_option('baggage') ) == 'On') { echo 'checked'; } ?> /></td>
								<td><input type="checkbox" name="baggageMand" value="Yes" <?php if( esc_attr( get_option('baggageMand') ) == 'Yes') { echo 'checked'; } ?>  disabled /></td> 
							</tr> 
							<tr class="odd"> 
								<td>Vehicle Feature </td><td>Optional</td>
								<td><input type="checkbox" name="feature" value="On" <?php if( esc_attr( get_option('feature') ) == 'On') { echo 'checked'; } ?> /></td>
								<td><input type="checkbox" name="featureMand" value="Yes" <?php if( esc_attr( get_option('featureMand') ) == 'Yes') { echo 'checked'; } ?>  disabled /></td> 
							</tr>
							
							<tr class="even"> 
								<td>Transmission Type </td><td>Optional</td>
								<td><input type="checkbox" name="transmission" value="On" <?php if( esc_attr( get_option('transmission') ) == 'On') { echo 'checked'; } ?> /></td>
								<td><input type="checkbox" name="transmissionMand" value="Yes" <?php if( esc_attr( get_option('transmissionMand') ) == 'Yes') { echo 'checked'; } ?>  disabled /></td> 
							</tr>
							
							
							<tr class="odd"> 
								<td>Tax & Fee Details  </td><td>Optional</td>
								<td><input type="checkbox" name="tax" value="On" <?php if( esc_attr( get_option('tax') ) == 'On') { echo 'checked'; } ?> /></td>
								<td><input type="checkbox" name="taxMand" value="Yes" <?php if( esc_attr( get_option('taxMand') ) == 'Yes') { echo 'checked'; } ?>  disabled /></td> 
							</tr>
							
							
							<tr class="even"> 
								<td>Total </td><td>Optional</td>
								<td><input type="checkbox" name="total" value="On" <?php if( esc_attr( get_option('total') ) == 'On') { echo 'checked'; } ?> /></td>
								<td><input type="checkbox" name="totalMand" value="Yes" <?php if( esc_attr( get_option('totalMand') ) == 'Yes') { echo 'checked'; } ?>  disabled /></td> 
							</tr>
						<tbody>
						</table>
					</div>
					
					<div class="clear"></div>
					<div class="tblbolck">
						<!--  car listing data-->
						
						<table class="timecard mrgi">
							<caption>Step 2: Filter Fields Setting</caption>
							<thead>
								<tr>
									<th id="thDay">FieldName</th>
									<th id="thRegular">Default Value</th>
									<th id="thOvertime">On / Off</th>
									<th id="thTotal">Mandatory</th>
								</tr>
							</thead>
							<tbody>
							<tr class="odd"> 
								<td>Filter By Price High to Low</td><td>Optional</td>
								<td><input type="checkbox" name="priceHightoLow" value="On" <?php if( esc_attr( get_option('priceHightoLow') ) == 'On') { echo 'checked'; } ?> /></td>
								<td><input type="checkbox" name="vehicletypeMand" value="Yes" <?php if( esc_attr( get_option('vehicletypeMand') ) == 'Yes') { echo 'checked'; } ?>  disabled /></td> 
							</tr>
							<tr class="even"> 
								<td>Filter By Price Low to High</td><td>Optional</td>
								<td><input type="checkbox" name="priceLowtoHigh" value="On" <?php if( esc_attr( get_option('priceLowtoHigh') ) == 'On') { echo 'checked'; } ?> /></td>
								<td><input type="checkbox" name="passengerCapacityMand" value="Yes" <?php if( esc_attr( get_option('passengerCapacityMand') ) == 'Yes') { echo 'checked'; } ?>  disabled /></td> 
							</tr>
							<tr class="odd"> 
								<td>Filter By A-Z </td><td>Optional</td>
								<td><input type="checkbox" name="AtoZ" value="On" <?php if( esc_attr( get_option('AtoZ') ) == 'On') { echo 'checked'; } ?> /></td>
								<td><input type="checkbox" name="baggageOptionalMand" value="Yes" <?php if( esc_attr( get_option('baggageOptionalMand') ) == 'Yes') { echo 'checked'; } ?>  disabled /></td> 
							</tr>
						<tbody>
						</table>
					
					
						<!-- add extra-->
						<table class="timecard">
							<caption>Step 3: Extra Addon Fields Setting</caption>
							<thead>
								<tr>
									<th id="thDay">FieldName</th>
									<th id="thRegular">Default Value</th>
									<th id="thOvertime">On / Off</th>
									<th id="thTotal">Mandatory</th>
								</tr>
							</thead>
							<tbody>
							<tr class="even"> 
								<td>Mis.Charge Description</td><td>Optional</td>
								<td><input type="checkbox" name="chargeDesc" value="On" <?php if( esc_attr( get_option('chargeDesc') ) == 'On') { echo 'checked'; } ?> /></td>
								<td><input type="checkbox" name="chargeDescMand" value="Yes" <?php if( esc_attr( get_option('chargeDescMand') ) == 'Yes') { echo 'checked'; } ?>  disabled/></td> 
							</tr>
							
						<tbody>
						</table>
					</div>
					
					
					<!--listing other -->
					
					
					
					
					<div class="clear"></div>
					<div class="tblbolck">
						<!--  car listing data-->
						
						<table class="timecard mrgi">
							<caption>Step 4: Checkout Fields Setting</caption>
							<thead>
								<tr>
									<th id="thDay">FieldName</th>
									<th id="thRegular">Default Value</th>
									<th id="thOvertime">On / Off</th>
									<th id="thTotal">Mandatory</th>
								</tr>
							</thead>
							<tbody>
							<!--<tr class="odd"> 
								<td>Date of Birth</td><td>Optional</td>
								<td><input type="checkbox" name="dobon" value="On" <?php //if( esc_attr( get_option('dobon') ) == 'On') { echo 'checked'; } ?>  disabled  /></td>
								<td><input type="checkbox" name="dobMand" value="Yes" <?php// if( esc_attr( get_option('dobMand') ) == 'Yes') { echo 'checked'; } ?>  disabled /></td> 
							</tr>-->
							<tr class="even"> 
								<td>Address</td><td>Optional</td>
								<td><input type="checkbox" name="addresson" value="On" <?php if( esc_attr( get_option('addresson') ) == 'On') { echo 'checked'; } ?> /></td>
								<td><input type="checkbox" name="addressMand" value="Yes" <?php if( esc_attr( get_option('addressMand') ) == 'Yes') { echo 'checked'; } ?> /></td> 
							</tr>
							<tr class="odd"> 
								<td>City </td><td>Optional</td>
								<td><input type="checkbox" name="cityon" value="On" <?php if( esc_attr( get_option('cityon')== 'On','On' ) ) { echo 'checked'; }else{echo 'checked';} ?> /></td>
								<td><input type="checkbox" name="cityMand" value="Yes" <?php if( esc_attr( get_option('cityMand')== 'Yes','No' ) ) { echo 'checked'; } ?> /></td> 
							</tr>
							<tr class="even"> 
								<td>State </td><td>Optional</td>
								<td><input type="checkbox" name="stateon" value="On" <?php if( esc_attr( get_option('stateon') ) == 'On') { echo 'checked'; } ?> /></td>
								<td><input type="checkbox" name="stateMand" value="Yes" <?php if( esc_attr( get_option('stateMand') ) == 'Yes') { echo 'checked'; } ?> /></td> 
							</tr>
							<tr class="odd"> 
								<td>Postal Code </td><td>Optional</td>
								<td><input type="checkbox" name="zipon" value="On" <?php if( esc_attr( get_option('zipon') ) == 'On') { echo 'checked'; } ?> /></td>
								<td><input type="checkbox" name="zipMand" value="Yes" <?php if( esc_attr( get_option('zipMand') ) == 'Yes') { echo 'checked'; } ?> /></td> 
							</tr>
						<tr class="even"> 
								<td>Country </td><td>Optional</td>
								<td><input type="checkbox" name="countryon" value="On" <?php if( esc_attr( get_option('countryon') ) == 'On') { echo 'checked'; } ?>   /></td>
								<td><input type="checkbox" name="countryMand" value="Yes" <?php if( esc_attr( get_option('countryMand') ) == 'Yes') { echo 'checked'; } ?>   /></td> 
							</tr>
						<!--	
							<tr class="odd"> 
								<td>Company Name </td><td>Optional</td>
								<td><input type="checkbox" name="companyName" value="On" <?php// if( esc_attr( get_option('companyName') ) == 'On') { echo 'checked'; } ?>  disabled /></td>
								<td><input type="checkbox" name="companyMand" value="Yes" <?php //if( esc_attr( get_option('companyMand') ) == 'Yes') { echo 'checked'; } ?>  disabled  /></td> 
							</tr>
							<tr class="even"> 
								<td>Emergency Contact Number </td><td>Optional</td>
								<td><input type="checkbox" name="emergency" value="On" <?php //if( esc_attr( get_option('emergency') ) == 'On') { echo 'checked'; } ?> disabled  /></td>
								<td><input type="checkbox" name="emergencyMand" value="Yes" <?php //if( esc_attr( get_option('emergencyMand') ) == 'Yes') { echo 'checked'; } ?>  disabled /></td> 
							</tr>
							<tr class="odd"> 
								<td>License Number </td><td>Optional</td>
								<td><input type="checkbox" name="license" value="On" <?php //if( esc_attr( get_option('license') ) == 'On') { echo 'checked'; } ?>  disabled /></td>
								<td><input type="checkbox" name="licenseMand" value="Yes" <?php //if( esc_attr( get_option('licenseMand') ) == 'Yes') { echo 'checked'; } ?>  disabled /></td> 
							</tr>
							<tr class="even"> 
								<td>License Issue Date </td><td>Optional</td>
								<td><input type="checkbox" name="licenseIssue" value="On" <?php// if( esc_attr( get_option('licenseIssue') ) == 'On') { echo 'checked'; } ?>  disabled /></td>
								<td><input type="checkbox" name="licenseIssueMand" value="Yes" <?php //if( esc_attr( get_option('licenseIssueMand') ) == 'Yes') { echo 'checked'; } ?>  disabled /></td> 
							</tr>
							<tr class="odd"> 
								<td>License Expiry Date </td><td>Optional</td>
								<td><input type="checkbox" name="licenseExpiry" value="On" <?php //if( esc_attr( get_option('licenseExpiry') ) == 'On') { echo 'checked'; } ?>  disabled /></td>
								<td><input type="checkbox" name="licenseExpiryMand" value="Yes" <?php //if( esc_attr( get_option('licenseExpiryMand') ) == 'Yes') { echo 'checked'; } ?>  disabled /></td> 
							</tr>
							<tr class="even"> 
								<td>Passport Number </td><td>Optional</td>
								<td><input type="checkbox" name="passportNumber" value="On" <?php //if( esc_attr( get_option('passportNumber') ) == 'On') { echo 'checked'; } ?>  disabled /></td>
								<td><input type="checkbox" name="passportNumberMand" value="Yes" <?php //if( esc_attr( get_option('passportNumberMand') ) == 'Yes') { echo 'checked'; } ?>  disabled /></td> 
							</tr>
							<tr class="odd"> 
								<td>Passport Issue Date </td><td>Optional</td>
								<td><input type="checkbox" name="passportIssue" value="On" <?php //if( esc_attr( get_option('passportIssue') ) == 'On') { echo 'checked'; } ?>  disabled /></td>
								<td><input type="checkbox" name="passportIssueMand" value="Yes" <?php //if( esc_attr( get_option('passportIssueMand') ) == 'Yes') { echo 'checked'; } ?>  disabled /></td> 
							</tr>
							
							<tr class="even"> 
								<td>Passport Expiry Date</td><td>Optional</td>
								<td><input type="checkbox" name="passportExpiry" value="On" <?php //if( esc_attr( get_option('passportExpiry') ) == 'On') { echo 'checked'; } ?>  disabled /></td>
								<td><input type="checkbox" name="passportExpiryMand" value="Yes" <?php// if( esc_attr( get_option('passportExpiryMand') ) == 'Yes') { echo 'checked'; } ?>  disabled /></td> 
							</tr>
							<tr class="odd"> 
								<td>Driving Experience </td><td>Optional</td>
								<td><input type="checkbox" name="drivingExp" value="On" <?php //if( esc_attr( get_option('drivingExp') ) == 'On') { echo 'checked'; } ?>  disabled /></td>
								<td><input type="checkbox" name="drivingExpMand" value="Yes" <?php //if( esc_attr( get_option('drivingExpMand') ) == 'Yes') { echo 'checked'; } ?>  disabled /></td> 
							</tr>  -->
							<tr class="even"> 
								<td>Reservation Note </td><td>Optional</td>
								<td><input type="checkbox" name="Notes" value="On" <?php if( esc_attr( get_option('Notes') ) == 'On') { echo 'checked'; } ?> /></td>
								<td><input type="checkbox" name="NotesMand" value="Yes" <?php if( esc_attr( get_option('NotesMand') ) == 'Yes') { echo 'checked'; } ?> /></td> 
							</tr>
							
								
						<tbody>
						</table>
					
					
					</div>
					
					<div class="clear"></div>
					<?php submit_button(); ?>
				</div>
			</form>
		</div>
	
	<?php
		}
	}
}

$field = new NTRA_MyFieldsOfNavotar();


