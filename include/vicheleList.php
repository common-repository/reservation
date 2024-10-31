<?php
include_once('token.php');

add_action('wp_ajax_nopriv_NTRAvicheleList','NTRAvicheleList');
add_action('wp_ajax_NTRAvicheleList','NTRAvicheleList');
function NTRAvicheleList(){
	
	
check_ajax_referer( 'navotardevelopebypawanajaxnounce', 'security' );
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

	$_SESSION['search_info'] = array( 
		'vehtype'=>sanitize_text_field($_POST['victype']),
		'pickdate'=>sanitize_text_field($_POST['pickupdate']),
		'picktime' => sanitize_text_field($_POST['pickuptime']),
		'dropoffdate'=>sanitize_text_field($_POST['datetwo']),
		'dropofftime'=>sanitize_text_field($_POST['timetwo']),
		'location'=>sanitize_text_field($_POST['picklocation']),
		'droplocation'=>sanitize_text_field($_POST['droplocation'])
	);

	$victype ='';
	$picklocation='';
	$date1='';
	$date2='';
	$timetwo='';
	$pickuptime='';
	if(isset($_REQUEST['vechiletype'])){
		$victype = sanitize_text_field($_REQUEST['vechiletype']);
	}else{
		$victype = 0;	
	}
	
	
	//pickup location
	if(isset($_REQUEST['picklocation'])){
		$picklocation = sanitize_text_field($_REQUEST['picklocation']);
	}
	if(empty($picklocation)){
		$picklocation = $_SESSION['pickuplocation'];
	}
	
	//pickup date
	if(isset($_REQUEST['pickupdate'])){
		$pickupdate = sanitize_text_field($_REQUEST['pickupdate']);
		$date1 = date("Y-m-d", strtotime($pickupdate));
	}
	
	//pick time
	if(isset($_REQUEST['pickuptime'])){
		$pickuptime = sanitize_text_field($_REQUEST['pickuptime']);
	}
	
	// drop date
	if(isset($_REQUEST['datetwo'])){
		$datetwo = sanitize_text_field($_REQUEST['datetwo']);
		$date2 = date("Y-m-d", strtotime($datetwo));
	}
	
	//drop time
	if(isset($_REQUEST['timetwo'])){
		$timetwo = sanitize_text_field($_REQUEST['timetwo']);
	}
	
	//promocode
	if(isset($_REQUEST['promocode'])){
		$promocode = sanitize_text_field($_REQUEST['promocode']);
	}
	
	$fd = $date1.''.$pickuptime;
	$sd = $date2.''.$timetwo;
	
	$date = new DateTime($fd);
	$datedrop = new DateTime($sd);

    $StartDate = $date1." ".date("g:i A", strtotime($pickuptime));   //date(DATE_ISO8601, strtotime($fd));
	$EndDate =  $date2." ".date("g:i A", strtotime($timetwo));  //date(DATE_ISO8601, strtotime($sd));
	$_SESSION['StartDate'] = $StartDate;
	$_SESSION['EndDate'] = $EndDate;
	
	$fields = array(
	"VehicleCategoryId" => 0,
	"LocationId" =>$picklocation,
	"VehicleTypeId" => $victype,
	"VehicleMakeID" => 0,
	"ModelId" => 0,
	"AgeDuration" => null,
	"IsOnline" => true,
	"NumberOfSeats" => 0,
	"RentalPeriod" => 0,			
	"StartDate" => $StartDate,   //"2018-12-13T04:00:00.000Z",
	"EndDate" => $EndDate,    //"2019-01-13T04:00:00.000Z",
	"VehicleId" => 0,
	"ClientId" => esc_attr( get_option('clientCId'))
  );
  
	$auth =  "Bearer".' '.NTRAgetTokenFun();
    $data = json_encode($fields);
	$args = array(
		'body' => $data,
		'headers' => array(
			"Authorization"=>$auth,
			"Content-Type" =>"application/json",
			"cache-control"=> "no-cache"
		),
		'cookies' => array()
	);
	 
	$response = wp_remote_post( 'https://app.navotar.com/api/ReservationConfiguration/GetVehicleAndRateDetails', $args );

if ($response) { 
	$sort = 'asc';
    $i=1;
  if (!array_key_exists("body",$response)){ ?>
	<div class="falsemsg">Sorry, There is no listing found regarding your search.</div>  
	<?php
	 wp_die(); 
  }
  
  $res = json_decode($response['body']);

  if(!empty($res)){
	
	foreach($res as $po){
		
	 $sumtotal = str_replace(',', '',number_format($po->rateDetail->estimatedTotal, 2))- number_format($po->rateDetail->taxSum, 2);	
	 if(esc_attr( get_option('listingLayout')=='list')  || esc_attr( get_option('listingLayout')=='')){ 
	 
	?>
		<section id="Listingrow" rel="<?php echo $sumtotal; ?>">
					<div id="carleft">
						<div class="image"> 
							<img src="<?php echo  $po->vehicleTypeImage;  ?>"/>
						</div>
						<div class="desc">
							<div id="divleft"><b><?php echo  $po->vehicleType;  ?></b></div>
							<div class="iconspec">
								<ul>
								  <?php if( esc_attr( get_option('transmission') ) == 'On') { ?>
								  <li><i class="fa fa-code-fork"></i> <?php echo  $po->transmission;  ?></li>
								  <?php } ?>
								  <?php if( esc_attr( get_option('seats') ) == 'On') {?>
								  <li><i class="fa fa-user"></i> <?php echo  $po->seats;  ?> Seats</li>
								  <?php } ?>
								  <?php if( esc_attr( get_option('baggage') ) == 'On'){ ?>
								  <li><i class="fa fa-suitcase"></i> <?php echo  $po->baggages;  ?> Baggages</li>
								   <?php } ?>
								   <?php if( esc_attr( get_option('doors') ) == 'On'){ ?>
								   <?php if($po->doors !=''){ ?>
								  <li><i class="fa fa-adjust"></i> <?php echo  $po->doors;  ?> Doors</li>
								   <?php }} ?>
								   <?php if( esc_attr( get_option('sample') ) == 'On'){ ?>
								    <?php if($po->sample !=''){ ?>
										
										<li><i class="fa fa-cab"></i> <?php echo  $po->sample;  ?> Sample</li>
									<?php }} ?>
								</ul>
							</div>
							<?php if( esc_attr( get_option('tax') ) == 'On' || esc_attr( get_option('feature') ) == 'On'){ ?>
							<div id="divleftnext">
								<a class="toggle icontext" href="#carpricedetail<?php echo $i; ?>">&#11167; FEATURES & PRICE DETAILS</a>
							</div>
							<?php } ?>
						</div>
					</div>
					
						<div id="carright">
							<div class="getitnow">
								<!--<div class="gtext">Get it now</div>
								<div class="pric">$<?php //echo  number_format($po->rateDetail->monthlyRate, 2);  ?></div>-->
							</div>
							<div class="getitnowright">
								<div class="samex">
								<?php 
									echo '$'. number_format($sumtotal,2);
									
									?>
								</div>
								
								<?php $params = array('vehicle'=>$po->vehicleId,'loc'=>$po->locationId,'pick'=>strtotime($fd),'drop'=>strtotime($sd),'rateid' =>$po->rateDetail->rateId,'vehicleTypeId'=>$po->vehicleTypeId); ?>
								
							</div>
							<div class="selectbtn">
							<a href="<?php echo add_query_arg($params,get_permalink( get_page_by_path( 'mis-charges' ))); ?>" class="btndsg">SELECT</a>	
							</div>
						</div>
						
						
						<div class="maindpl" id="carpricedetail<?php echo $i; ?>">
							<?php if( esc_attr( get_option('feature') ) == 'On') { ?>
							<div class="feature">
								<div><b>Vehicle Features</b></div>
								<div><?php echo  $po->transmission;  ?></div>
							</div>
							<?php } ?>
							
							
							<!--rate list -->
							
							<div class="spec">
								 <div class="pricedetail"><b>Price Details</b></div>
								 
								 <!--month rate--> 
								 <?php if($po->rateDetail->monthlyQty >0) {?>
								 <?php $mont = number_format($po->rateDetail->monthlyRate, 2); ?>
									 <div id="tbltype"><?php echo $po->rateDetail->monthlyQty; ?> Month</div>
									 <div id="tbltype" class="centwe">
									 <?php echo $po->rateDetail->monthlyQty .' X '. number_format($po->rateDetail->monthlyRate, 2).' = '; ?> CAD $ <?php $monthtotal =  number_format($po->rateDetail->monthlyQty, 2) * str_replace(',', '',$mont ); 
									 echo number_format($monthtotal, 2); ?>
									 </div>
								 <?php } ?>
								 <!--Week rate-->
								 <?php if($po->rateDetail->weeklyQty >0) {?>
									 <div id="tbltype"><?php echo $po->rateDetail->weeklyQty; ?> Week</div>
									 <div id="tbltype" class="centwe">
									 <?php echo $po->rateDetail->weeklyQty .' X '. number_format($po->rateDetail->weeklyRate, 2).' = '; ?> CAD $<?php $weeklytotal = number_format($po->rateDetail->weeklyQty, 2) * number_format($po->rateDetail->weeklyRate, 2); 
									 echo number_format($weeklytotal, 2); ?>
									 </div>
								 <?php } ?>
								 <!--Days rate-->
								 <?php if($po->rateDetail->dailyQty >0) {?>
									 <div id="tbltype"><?php echo $po->rateDetail->dailyQty; ?> Days</div>
									 <div id="tbltype" class="centwe">
									 <?php echo $po->rateDetail->dailyQty .' X '. number_format($po->rateDetail->dailyRate, 2).' = '; ?> CAD $<?php $daystotal =  number_format($po->rateDetail->dailyQty, 2) * number_format($po->rateDetail->dailyRate, 2); 
									  echo number_format($daystotal, 2); ?>
									 </div>
								 <?php } ?>
								 
								 <!--Hour rate-->
								
								<?php if($po->rateDetail->hourlyQty >0) {?>
									 <div id="tbltype"><?php echo $po->rateDetail->hourlyQty; ?> Hours</div>
									 <div id="tbltype" class="centwe">
									 <?php echo $po->rateDetail->hourlyQty .' X '. number_format($po->rateDetail->hourlyRate, 2).' = '; ?> CAD $<?php $hourlytotal = number_format($po->rateDetail->hourlyQty, 2) *  number_format($po->rateDetail->hourlyRate, 2); 
									  echo number_format($hourlytotal, 2); ?>
									 </div>
								 <?php } ?>
								 
								 <!--Half Day rate-->
							     
								 <?php if($po->rateDetail->halfDayQty >0) {?>
									 <div id="tbltype"><?php echo $po->rateDetail->halfDayQty; ?> Half Day</div>
									 <div id="tbltype" class="centwe">
									 <?php echo $po->rateDetail->halfDayQty .' X '. number_format($po->rateDetail->halfDayRate, 2).' = '; ?> CAD $<?php $halfdaytotal =  number_format($po->rateDetail->halfDayQty, 2) * number_format($po->rateDetail->halfDayRate, 2); 
									  echo number_format($halfdaytotal, 2); ?>
									 </div>
								 <?php } ?>
								 
								 
								 
								 <!--Tax rate-->
								 
								 
								
								 
								 <div id="tbltype">ESTIMATED TOTAL</div>
								 <div id="tbltype" class="centwe">
									CAD $<?php echo number_format($po->rateDetail->rateTotal,2);?>
								 </div>
							</div>
							<div id="tbltype1"></div>
							
						</div>
				</section>
			
		<?php	
				$i++; 
			}else{
				?>
				<div class="Carinfo" rel="<?php echo $sumtotal; ?>">
					<div class="carname">
						<div id="nissan"><span>Vehicle Type </span> :<?php echo  $po->vehicleType;  ?></div>
						<div id="automatic"><span>Transmission</span> : <?php echo  $po->transmission;  ?></div>
					</div>
					<div class="details">Details</div>
					<div class="image"><img src="<?php echo  $po->vehicleTypeImage;  ?>"/></div>
					<div class="paylater">
						<div class="mybtnc">
							<div class="perday">
							  <div><button id="btn1" type="submit">$<?php echo number_format($po->rateDetail->dailyRate,2); ?></button></div>
							   <div class="txt">Perday</div>
							</div>
							<div class="total">
								<div class="txt">Total</div>
								<div><button id="btn1_1" type="submit">$<?php echo number_format($sumtotal,2); ?></button></div>
							</div>
						</div>
						<?php $params = array('vehicle'=>$po->vehicleId,'loc'=>$po->locationId,'pick'=>strtotime($fd),'drop'=>strtotime($sd),'rateid' =>$po->rateDetail->rateId,'vehicleTypeId'=>$po->vehicleTypeId); ?>
						<div id="btndiv"><a href="<?php echo add_query_arg($params,get_permalink( get_page_by_path( 'mis-charges' ))); ?>" class="btn2">BOOK NOW</a></div>
					</div>
					
					
					<div class="hidediv" id="divhide1" style="display:none;">
						<div class="close" id="close1">(<i class="fa fa-times" aria-hidden="true">)</i></div>
						<div class="paylater1">
							<div class="bags">Vehicle Type</div>
							<div class="bags">Seats</div>
							<div class="bags">Bags</div>
							<div class="bags">Doors</div>
						</div>
						<div class="paylater2">
							<div class="bag vehicleType_1"><?php echo  $po->vehicleType;  ?></div>
							<div class="bag seats_1"><i class="fa fa-users"></i> <?php echo  $po->seats;  ?></div>
							<div class="bag baggages_1"><i class="fa fa-shopping-bag"></i> <?php echo  $po->baggages;  ?> </div>
							<div class="bag doors_1"><i class="fa fa-users"></i> <?php echo  $po->doors;  ?></div>
						</div>
					</div>
				</div>
				
				
			<?php
			
			}
		}
	}else{
		?>
		<div class="falsemsg">Sorry, There is no listing found regarding your search.</div>
		<?php
	}
  wp_die(); 
}

}