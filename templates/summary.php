<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
get_header();
if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

 ?>
<?php 
$days=0;
if(isset($_REQUEST['pick'])){
	$pick = sanitize_text_field($_REQUEST['pick']);
	$pp = date('Y-m-d H:i:s', $pick);
}
if(isset($_REQUEST['drop'])){
	$drop = sanitize_text_field($_REQUEST['drop']);
	$dp = date('Y-m-d H:i:s', $drop);
}



$date = new DateTime($pp);
$datedrop = new DateTime($dp);
$interval = $date->diff($datedrop);
$days = $interval->format('%a');

$hrs = $interval->format('%h');


if($hrs >3){
	
	 $days = $days + 1;
	 
}
	$pri = 1;
	$fixedval=0;
	$exprice = 0;
	$extrach = 0;
	$det = array();
    $inf = array();
	$arr = $_POST;
	
	foreach ($arr as $key => $value) {	
		if(stripos($key, '-') !== false){
			$val =  explode("-", $key);
			array_push($val, $value);
			array_push($inf, $val);
			
			
		}
		else{
			
			$exp =  explode("-", $value);
			array_push($inf, $exp);
		}
   
	}
	$tl=0;
	$t2 =0;
	
	foreach($inf as $val){
		if(!empty($val[2])){
			global $wp_session; 
			
			$vinformation = array( 
				'vehicleid'=>$val[0],
				'locationid'=>$val[1],
				'extra'=>$val[2],
				'extraid'=>$val[3],
				'ectraprice'=>str_replace('_', '.', $val[4]),
				'extraState'=>strtolower($val[5]),
				'qty' =>@$val[11],
				'misChargeCode' =>@$val[7],
				'unit' =>@$val[8],
				'taxNotAvailable' =>@$val[9],
				'isQuantity' =>@$val[10]
			);
			array_push($det,$vinformation);
		}
		
		$_SESSION['extra']=$det;
	}
	
	
?>

<div class="wrap">
<div class="navotar">
	<div class="maincontent">
		<div class="topbarnew">
		    <p>Home > Select Car > Options > <span class="redish">Confirm</span></p>
	    </div>
		<div id="mes"></div>	
		<div class="leftpart">
	
		<form method="POST"  onsubmit="return NTRAcheckSummaryForm(this);">
			
			<div class="detailcar" id="singledata">	
				<div id="loaderlsit" style="display:none; width:150px; margin:0px auto;"></div>
			</div> 
			<div class="formdiv">
			
				<div class="contactdiv">Contact Information</div>
				<div class="formset">
					<div class="textset">
						<label id="labeldiv">First Name <span style="color:red">*</span></label>
						<input id="inputdiv" class="fname" type="text" minlength="3" name="fname" placeholder="First Name"required />
					</div>
					<div class="textset">
						<label id="labeldiv">Last Name <span style="color:red">*</span></label>
						<input id="inputdiv" class="lname" type="text" minlength="3" name="lname" placeholder="Last Name"required />
					</div>
				</div>
				<div class="formset">
					<div class="textset">
						<label id="labeldiv">Phone <span style="color:red">*</span></label>
						<input id="inputdiv" class="phone" type="text" name="phone" pattern="\d*" minlength="10" maxlength="12" placeholder="Phone Number" required />
					</div>
					<div class="textset">
						<label id="labeldiv">Email<span style="color:red">*</span></label>
						<input id="inputdiv" class="email" type="email" name="email" placeholder="Email ID" required />
					</div>
				</div>
				
				<?php if( esc_attr( get_option('enablepayment') ) == 'On'){     ?>
				<div class="formset">
					<div class="textset">
						<label id="labeldiv">Name on Card <span style="color:red">*</span></label>
						<input id="inputdiv" class="phone nameoncard" type="text" minlength="3" name="nameoncard" placeholder="Name on Card" required />
					</div>
					<div class="textset">
						<label id="labeldiv">Card No <span style="color:red">*</span></label>
						<input id="inputdiv" class="email cardno" type="text" pattern="\d*" minlength="14" maxlength="16" name="cardno" placeholder="14-16 digit Card Number" required />
					</div>
				</div>
				<div class="formset">
					<div class="textset">
						<label id="labeldiv">CVV No<span style="color:red">*</span></label>
						<input id="inputdiv" class="phone cvv" type="text" pattern="\d*" minlength="3" maxlength="4" name="cvv" placeholder="CVV Number" required />
					</div>
					<div class="textset">
						<label id="labeldiv">Expiry <span style="color:red">*</span></label><br />
						<select name="year" class="select year" required >
							<option value="">Expiry Year</option>
							<?php
							for($i=2019;$i<=2030;$i++){
							?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php
							}
							?>
						</select>
						<select name="month" class="select month" required >
							<option value="">Expiry Month</option>
							<option value="01">01</option>
							<option value="02">02</option>
							<option value="03">03</option>
							<option value="04">04</option>
							<option value="05">05</option>
							<option value="06">06</option>
							<option value="07">07</option>
							<option value="08">08</option>
							<option value="09">09</option>
							<option value="10">10</option>
							<option value="11">11</option>
							<option value="12">12</option>
						</select>
					</div>
				</div>
				<?php  } ?>
			</div>
			
			
			<div class="formdiv">
				<div class="contactdiv">Address</div>
				<?php if( esc_attr( get_option('addresson') ) == 'On'){ ?>
				<div class="textsets">
					<label id="labeldiv">Address Line 1 <?php if( esc_attr( get_option('addressMand') ) == 'Yes'){ echo"<span style='color:red'>*</span>";} ?></label>
						<input id="inputdiv" class="add1" type="text" placeholder="Address Line 1"  name="add1" <?php if( esc_attr( get_option('addressMand') ) == 'Yes'){ echo"required";} ?> />
				</div>
				<div class="textsets">
					<label id="labeldiv">Address Line 2</label>
					<input id="inputdiv" class="add2" type="text" placeholder="Address Line 2" name="add2"/>
				</div>
				<?php  } ?>
				<div class="formset">
				
				<?php if( esc_attr( get_option('cityon') ) == 'On' || esc_attr( get_option('cityon') ) == '' ){ ?>
					<div class="textset">
						<label id="labeldiv">City <?php if( esc_attr( get_option('cityMand') ) == 'Yes'){ echo"<span style='color:red'>*</span>";} ?></label>
						<input id="inputdiv" class="city" type="text" placeholder="City" name="city" <?php if( esc_attr( get_option('cityMand') ) == 'Yes'){ echo"required";} ?> />
						
					</div>
					<?php  } ?>
					
					<?php if( esc_attr( get_option('zipon') ) == 'On'){   //pattern="\d*" ?>
					<div class="textset">
						<label id="labeldiv">Postal Code <?php if( esc_attr( get_option('zipMand') ) == 'Yes'){ echo"<span style='color:red'>*</span>";} ?></label>
						<input id="inputdiv" placeholder="Postal Code" class="postal" type="text"  minlength="3" maxlength="6" name="postal" <?php if( esc_attr( get_option('zipMand') ) == 'Yes'){ echo"required";} ?>/>
					</div>
					<?php  } ?>
				
					
				</div>
				<div class="formset">
					
					<?php if( esc_attr( get_option('countryon') ) == 'On'){ ?>
					<div class="textset">
						<label id="inputdiv" class="labeldiv">Country <?php if( esc_attr( get_option('countryMand') ) == 'Yes'){ echo"<span style='color:red'>*</span>";} ?></label>
						<select id="country"  class="country" name="country" <?php if( esc_attr( get_option('countryMand') ) == 'Yes'){ echo"required";} ?>>
						<option value="">Select Country</option>
						</select>
					</div>
					<?php  } ?>
					
					<?php if( esc_attr( get_option('stateon') ) == 'On'){ ?>
					<div class="textset">
						<label id="inputdiv" class="labeldiv">State / Province <?php if( esc_attr( get_option('stateMand') ) == 'Yes'){ echo"<span style='color:red'>*</span>";} ?></label>
						<select id="state" name="state" <?php if( esc_attr( get_option('stateMand') ) == 'Yes'){ echo"required";} ?>>
						<option value="">Select State</option>	
						</select>
					</div>
					<?php  } ?>
					
					
				</div>
				
				<div class="formset">
				    <?php if( esc_attr( get_option('Notes') ) == 'On'){ ?>
					<div class="textset">
						<label id="labeldiv">Reservation Note <?php if( esc_attr( get_option('NotesMand') ) == 'Yes'){ echo"<span style='color:red'>*</span>";} ?></label>
						<input id="inputdiv" class="note" placeholder="Reservation Note" type="text" name="note" <?php if( esc_attr( get_option('NotesMand') ) == 'Yes'){ echo"required";} ?>/>
					</div>
					<?php  } ?>
				</div>
				
				<div class="lastbtndiv"><input type="submit" id="btn1setting" id="submit" class="submit" value="Reserve Now" /></div>
				
			</div>
			
			</form>
		</div>
		<div class="rightpart" id="prices">
			<div class="rightsethead">Summary of Charges</div>
			<!--mischarges come from API start-->
			<div class="rightset">
				<div class="rightdiv"><b>Rental</b></div>
				<div class="rightdiv rite" id="rental"></div>
			</div>
			<!--mischarges come from API end-->
			<div class="rightset">
				<div class="rightdiv">Promo Code</div>
				<div class="rightdiv rite" id=""><input type="text" name="promocode" id="checkpromo" placeholder="Promo Code" value="<?php echo $_SESSION['promotionCode']; ?>"/></div>
				<div id="promoMsg"></div>
			</div>
			
			<div class="rightset">
				<div class="rightdiv"><b>Promocode Value</b> <span id="promo-perc"></span></div>
				<div class="rightdiv rite" id="promocode">$0.00</div>
			</div>
			
			<!--mischarges come from API start-->
			<div class="rightset extramis" id="extramis"></div>
			<!--mischarges come from API end-->
				
			
			<div class="rightset">
				<div class="rightdiv"><b>Total Misc Taxable</b></div>
				<div class="rightdiv rite" id="taxablemis"></div>
			</div>
			
			
			<div class="rightset">
				<div class="rightdiv"><b>Sub Total</b></div>
				<div class="rightdiv rite" id="subtotal"></div>
				<div class="rightdiv rite" style="visibility:hidden;" id="lastsubtotal">$0</div>
			</div>
			
			<div class="rightset">
				<div class="rightdiv" id="vat">Total Tax</div>
				<div class="rightdiv rite" id="totaltax"></div>
				<div class="rightdiv rite" style="visibility:hidden;" id="taxvalues"></div>
			</div>
			<div class="rightset misNontax" id="misNontax"></div>
			
			<div class="rightset">
				<div class="rightdiv"><b>Total Misc Non Taxable</b></div>
				<div class="rightdiv rite" id="nontaxablemis"></div>
			</div>
			
			<div class="rightsettotal">
				<div class="rightdiv"><b>Total</b></div>
				<div class="rightdiv rite" id="total">$0</div>
				<div class="rightdiv rite" style="visibility:hidden;" id="lasttotal">$0</div>
			</div>
			
			<div class="rightsethead rdetail">Rental Detail</div>
			
			<div class="rightset" id="rdetail">
				<div class="rightset">
					<div class="rightdiv" id="vat">Pick Location</div>
					<div class="rightdiv rite" id="loct"></div>
				</div>
				<div class="rightset">
					<div class="rightdiv" id="vat">Start Date</div>
					<div class="rightdiv rite" id="startdate"></div>
				</div>
				<div class="rightset">
					<div class="rightdiv" id="vat">End Date</div>
					<div class="rightdiv rite" id="enddate"></div>
				</div>
			</div>
			
			
		</div>
		
	</div>
</div>
<script>
$=jQuery.noConflict();
NTRAsummaryDataAnylize();
jQuery(document).ready(function($) { 
	setTimeout(
		NTRAinformationMove, 5000
	);

	var getloc = localStorage.getItem('selectedLoc');
	$('.headerloc').append(getloc);
	
	$('#checkpromo').click(function(){
		$('#promoMsg').html("");
	});
	
	// check promocode onload
	
	
	
	
	//check prmocode onload end
	
	$("#checkpromo").blur(function(){
		var promo = $('#checkpromo').val();
		if(promo !=''){
			var vtid = <?php if(!empty($inf[0][0])){ echo $inf[0][0]; }  ?>;
			var lid = <?php if(!empty($inf[0][1])){ echo $inf[0][1]; }  ?>;
			var start_date = jQuery('#startdate').text()
			var end_date = jQuery('#enddate').text()
			$.ajax({
				url:MS_Ajax.ajaxurl,
				type: 'POST',
				data:{'viheletype':vtid,'promocode':promo,'picklocation':lid,'action':'NTRApromo','security':MS_Ajax.nextNonce,start_date,end_date},
				dataType: 'json', 
				success: function(res) {
					if(res.error =='error'){
					 $('#promoMsg').html('<p style="color:red">'+res.msg+'</p>');
						jQuery('#promocode').html('0%');
						jQuery('#promo-perc').html('')
						var getsubtotal = $('#lastsubtotal').text().split('$');
						jQuery('#subtotal').html('$'+parseFloat(getsubtotal[1]).toFixed(2));
						var taxval = $('#taxvalues').text();
						var taxinfo = (parseFloat(getsubtotal[1] * taxval))/100;
						jQuery('#totaltax').html('$'+parseFloat(taxinfo).toFixed(2));
						
						var gettotal = $('#lasttotal').text();
						jQuery('#total').html(gettotal);
					}
					if(res.status =='success'){
					 $('#promoMsg').html('<p style="color:green">'+res.msg+'</p>');
					
					 if(res.discountType == 'Percentage' || res.discountType == 'percentage'){
						 var getrental = $('#rental').text().split('$');
						 var gettotal = $('#total').text().split('$');
						 var subtotal = $('#subtotal').text().split('$');
						 var taxval = $('#taxvalues').text();
						 var nontaxablemis = $('#nontaxablemis').text().split('$');
						 
						 var nowval = (parseFloat(getrental[1])* parseFloat(res.promovalue)) / 100;
						 jQuery('#promocode').html('$'+ parseFloat(nowval).toFixed(2));
						 jQuery('#promo-perc').html('('+res.promovalue+'%)')
						 
						 var sutot = parseFloat(subtotal[1]) - parseFloat(nowval);
						 var taxinfo = (parseFloat(sutot * taxval))/100;
						 
						 jQuery('#subtotal').html('$'+parseFloat(sutot).toFixed(2));
						 jQuery('#totaltax').html('$'+parseFloat(taxinfo).toFixed(2));
						 
						 var totalval = parseFloat(sutot)+ parseFloat(taxinfo)+parseFloat(nontaxablemis[1]);
						 jQuery('#total').html('$'+parseFloat(totalval).toFixed(2));
					 }
					 else if(res.discountType == 'Value' || res.discountType == 'value'){
						 var getrental = $('#rental').text().split('$');
						 var gettotal = $('#total').text().split('$');
						 var subtotal = $('#subtotal').text().split('$');
						 var taxval = $('#taxvalues').text();
						 var nontaxablemis = $('#nontaxablemis').text().split('$');
						 
						 var nowval = parseFloat(res.promovalue);
						 jQuery('#promocode').html('$'+ parseFloat(nowval).toFixed(2));
						//  jQuery('#promo-perc').html('($'+res.promovalue+')')
						 
						 var sutot = parseFloat(subtotal[1]) - parseFloat(nowval);
						 var taxinfo = (parseFloat(sutot * taxval))/100;
						 
						 jQuery('#subtotal').html('$'+parseFloat(sutot).toFixed(2));
						 jQuery('#totaltax').html('$'+parseFloat(taxinfo).toFixed(2));
						 
						 var totalval = parseFloat(sutot)+ parseFloat(taxinfo)+parseFloat(nontaxablemis[1]);
						 jQuery('#total').html('$'+parseFloat(totalval).toFixed(2));
					 }
					 else{
						 
					 }
					}
				}
			});
		}else{
			jQuery('#promocode').html('0%');
			jQuery('#promo-perc').html('')
			var getsubtotal = $('#lastsubtotal').text().split('$');
			jQuery('#subtotal').html('$'+parseFloat(getsubtotal[1]).toFixed(2));
			var taxval = $('#taxvalues').text();
			var taxinfo = (parseFloat(getsubtotal[1] * taxval))/100;
			jQuery('#totaltax').html('$'+parseFloat(taxinfo).toFixed(2));
			
			var gettotal = $('#lasttotal').text();
			jQuery('#total').html(gettotal);
		}
    });
	
	
	$.ajax({
		url:MS_Ajax.ajaxurl,
		type: 'GET',
		dataType: 'HTML',
		data:{'action':'NTRAGetCountry','security':MS_Ajax.nextNonce}, 
		success: function(res) {
			$('#country').html(res);
		},
		error:function(err){
			console.log(err);
			
		}
	});
	
	
	//get state
	
	$('#country').change(function() {
	  var code = $(this).val();
		$.ajax({
			url:MS_Ajax.ajaxurl,
			type: 'GET',
			dataType: 'HTML',
			data:{'c_code':code,'action':'NTRAGetState','security':MS_Ajax.nextNonce}, 
			success: function(res) {
				$('#state').html(res);
			},
			error:function(err){
				console.log(err);
				
			}
		});
	});
	
	
});

var promo = $('#checkpromo').val();
	function checkPromoOnStart(){
		if(promo !=''){
			var vtid = <?php if(!empty($inf[0][0])){ echo $inf[0][0]; }  ?>;
			var lid = <?php if(!empty($inf[0][1])){ echo $inf[0][1]; }  ?>;
			var start_date = jQuery('#startdate').text()
			var end_date = jQuery('#enddate').text()
			$.ajax({
				url:MS_Ajax.ajaxurl,
				type: 'POST',
				data:{'viheletype':vtid,'promocode':promo,'picklocation':lid,'action':'NTRApromo','security':MS_Ajax.nextNonce,start_date,end_date},
				dataType: 'json', 
				success: function(res) {
					if(res.error =='error'){
					 $('#promoMsg').html('<p style="color:red">'+res.msg+'</p>');
						jQuery('#promocode').html('0%');
						jQuery('#promo-perc').html('')
						var getsubtotal = $('#lastsubtotal').text().split('$');
						jQuery('#subtotal').html('$'+parseFloat(getsubtotal[1]).toFixed(2));
						var taxval = $('#taxvalues').text();
						var taxinfo = (parseFloat(getsubtotal[1] * taxval))/100;
						jQuery('#totaltax').html('$'+parseFloat(taxinfo).toFixed(2));
						
						var gettotal = $('#lasttotal').text();
						jQuery('#total').html(gettotal);
					}
					if(res.status =='success'){
					 $('#promoMsg').html('<p style="color:green">'+res.msg+'</p>');
					
					 if(res.discountType == 'Percentage' || res.discountType == 'percentage'){
						 var getrental = $('#rental').text().split('$');
						 var gettotal = $('#total').text().split('$');
						 var subtotal = $('#subtotal').text().split('$');
						 var taxval = $('#taxvalues').text();
						 var nontaxablemis = $('#nontaxablemis').text().split('$');
						 
						 var nowval = (parseFloat(getrental[1])* parseFloat(res.promovalue)) / 100;
						 jQuery('#promocode').html('$'+ parseFloat(nowval).toFixed(2));
						 jQuery('#promo-perc').html('('+res.promovalue+'%)')
						 
						 var sutot = parseFloat(subtotal[1]) - parseFloat(nowval);
						 var taxinfo = (parseFloat(sutot * taxval))/100;
						 
						 jQuery('#subtotal').html('$'+parseFloat(sutot).toFixed(2));
						 jQuery('#totaltax').html('$'+parseFloat(taxinfo).toFixed(2));
						 
						 var totalval = parseFloat(sutot)+ parseFloat(taxinfo)+parseFloat(nontaxablemis[1]);
						 jQuery('#total').html('$'+parseFloat(totalval).toFixed(2));
					 }
					 else if(res.discountType == 'Value' || res.discountType == 'value'){
						 var getrental = $('#rental').text().split('$');
						 var gettotal = $('#total').text().split('$');
						 var subtotal = $('#subtotal').text().split('$');
						 var taxval = $('#taxvalues').text();
						 var nontaxablemis = $('#nontaxablemis').text().split('$');
						 
						 var nowval = parseFloat(res.promovalue);
						 jQuery('#promocode').html('$'+ parseFloat(nowval).toFixed(2));
						//  jQuery('#promo-perc').html('($'+res.promovalue+')')
						 
						 var sutot = parseFloat(subtotal[1]) - parseFloat(nowval);
						 var taxinfo = (parseFloat(sutot * taxval))/100;
						 
						 jQuery('#subtotal').html('$'+parseFloat(sutot).toFixed(2));
						 jQuery('#totaltax').html('$'+parseFloat(taxinfo).toFixed(2));
						 
						 var totalval = parseFloat(sutot)+ parseFloat(taxinfo)+parseFloat(nontaxablemis[1]);
						 jQuery('#total').html('$'+parseFloat(totalval).toFixed(2));
					 }
					 else{
						 
					 }
					}
				}
			});
		}else{
			jQuery('#promocode').html('0%');
			jQuery('#promo-perc').html('')
			var getsubtotal = $('#lastsubtotal').text().split('$');
			jQuery('#subtotal').html('$'+parseFloat(getsubtotal[1]).toFixed(2));
			var taxval = $('#taxvalues').text();
			var taxinfo = (parseFloat(getsubtotal[1] * taxval))/100;
			jQuery('#totaltax').html('$'+parseFloat(taxinfo).toFixed(2));
			
			var gettotal = $('#lasttotal').text();
			jQuery('#total').html(gettotal);
		}
	}

async function NTRAsummaryDataAnylize(){

   var vtid = <?php if(!empty($inf[0][0])){ echo $inf[0][0]; }  ?>;
    var lid = <?php if(!empty($inf[0][1])){ echo $inf[0][1]; }  ?>;
	 var pick = <?php if(!empty($_REQUEST['pick'])){ echo esc_html($_REQUEST['pick']); }  ?>;
	  var drop = <?php if(!empty($_REQUEST['drop'])){ echo esc_html($_REQUEST['drop']); }  ?>;
	 
	await jQuery.ajax({
		url: MS_Ajax.ajaxurl,
		type: 'POST',
		data:{'vtid':vtid,'lid':lid,'pick':pick,'drop':drop,'action':'NTRAreservationSummary','security':MS_Ajax.nextNonce},
		dataType: 'JSON', // added data type
		success: function(res) {
			if(res.listing !="undefined"){
				jQuery('#singledata').html(res.listing);
			}
			if(res.rental !="undefined"){
				jQuery('#rental').html('$'+res.rental);
			}
			if(res.mis !="undefined"){
				jQuery('#extramis').html(res.mis);
			}
			
			if(res.misNontax !="undefined"){
				jQuery('#misNontax').html(res.misNontax);
			}
			if(res.subtotal !="undefined"){
				jQuery('#subtotal').html('$'+res.subtotal);
			}
			
			if(res.totalMiscTaxable !="undefined"){
				jQuery('#taxablemis').html('$'+res.totalMiscTaxable);
			} 
			if(res.totalMiscNonTaxable !="undefined"){
				jQuery('#nontaxablemis').html('$'+res.totalMiscNonTaxable);
			}
			if(res.totalTax !="undefined"){
				jQuery('#totaltax').html('$'+res.totalTax);
			}
			if(res.estimatedTotal !="undefined"){
				jQuery('#total').html('$'+res.estimatedTotal);
			}
			if(res.taxvalue !="undefined"){
				jQuery('#taxvalues').html(res.taxvalue);
			}
			
			if(res.estimatedTotal !="undefined"){
				jQuery('#lasttotal').html('$'+res.estimatedTotal);
				jQuery('#lastsubtotal').html('$'+res.subtotal);
			}
			jQuery('#startdate').html(res.startdate);
			jQuery('#enddate').html(res.enddate);
			
			
			
		},
		error:function(err){
			console.log(err);
		}
	});

	checkPromoOnStart()
}







  function NTRAcheckSummaryForm(form)
  {
	var fname = $('.fname').val();
	var lname = $('.lname').val();
	var email = $('.email').val();
	var phone = $('.phone').val();
	
	var nameoncard = $('.nameoncard').val();
	var cardno = $('.cardno').val();
	var cvv = $('.cvv').val();
	var expiryyear = $('.year').val();
	var expirymonth = $('.month').val();
	
	var add1 = $('.add1').val();
	var add2 = $('.add2').val();
	var state = $('#state').val();
	var city = $('.city').val();
	var country = $('#country').val();
	var zip = $('.postal').val();
	var note = $('.note').val();
	var country = $('.country').val();
	
	var fare = $("#fare").text();
	var subtotal = $("#subfare").text();
	var tax = $("#taxsome").text();
	var extratotal  = $("#extra").text();
	var total = $("#total").text();
	
	
	var days = <?php echo $days; ?>;
	jQuery('#loaderlsit').html('<img src="'+plugin_url+'/images/loader.gif" class="loader" />').fadeIn();
	jQuery.ajax({
		url: MS_Ajax.ajaxurl,
		type: 'POST',
		data:{'fname':fname,'lname':lname,'email':email,'phone':phone,'add1':add1,'add2':add2,'state':state,'city':city,'zip':zip,'note':note,'country':country,'nameoncard':nameoncard ,'cardno':cardno, 'cvv':cvv ,'expyear':expiryyear ,'expmonth':expirymonth ,'fare':fare,'subtotal':subtotal,'taxtotal':tax,'extratotal':extratotal,'total':total,'days':days,'action':'NTRAreservationReserve','security':MS_Ajax.nextNonce},
		dataType: 'JSON', 
		success: function(res) {
			
			if(res !='-1'){
				res = res.toString();
				var newStr = res.substring(0, res.length - 1);
				window.location.href = "<?php echo get_permalink( get_page_by_path( 'term-and-condition' ));?>?cid="+newStr;
				jQuery('#loaderlsit').hide();
			}else{
				jQuery('#mes').html('<div class="messages">This Customer is already registered with us.</div>');	
				
			}
			
		},
		error:function(err){
			jQuery('#loaderlsit').hide();
			jQuery('#mylist').html('<div class="falsemsg">Sorry, API return error.</div>');
		}
	});
    return false;
  }







function NTRAinformationMove(){
	var getloc = localStorage.getItem('selectedLoc');
	jQuery('#loct').append(getloc);
	
}


    

</script>





<div style="clear:both;"></div>
<?php get_footer(); ?>