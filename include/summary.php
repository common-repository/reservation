<?php
include_once('token.php');


add_action('http_api_curl', 'sar_custom_curl_timeout', 9999, 1);
function sar_custom_curl_timeout( $handle ){
	curl_setopt( $handle, CURLOPT_CONNECTTIMEOUT, 30 ); // 30 seconds. Too much for production, only for testing.
	curl_setopt( $handle, CURLOPT_TIMEOUT, 30 ); // 30 seconds. Too much for production, only for testing.
}
// Setting custom timeout for the HTTP request
add_filter( 'http_request_timeout', 'sar_custom_http_request_timeout', 9999 );
function sar_custom_http_request_timeout( $timeout_value ) {
	return 200; // 30 seconds. Too much for production, only for testing.
}
// Setting custom timeout in HTTP request args
add_filter('http_request_args', 'sar_custom_http_request_args', 9999, 1);
function sar_custom_http_request_args( $r ){
	$r['timeout'] = 200; // 30 seconds. Too much for production, only for testing.
	return $r;
}

add_action('wp_ajax_nopriv_NTRAreservationSummary','NTRAreservationSummary');
add_action('wp_ajax_NTRAreservationSummary','NTRAreservationSummary');

function NTRAreservationSummary(){
	check_ajax_referer( 'navotardevelopebypawanajaxnounce', 'security');
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}


if(isset($_SESSION['vtid'])){
	$vicid = sanitize_text_field($_SESSION['vtid']);
}
if(isset($_REQUEST['vehicleTypeId'])){
	$vehicleTypeId = sanitize_text_field($_REQUEST['vehicleTypeId']);
}

if(isset($_GET['vehicle'])){
	$vehicle = sanitize_text_field($_GET['vehicle']);
}

if(isset($_REQUEST['lid'])){
	$lid = sanitize_text_field($_REQUEST['lid']);
}

if(isset($_REQUEST['pick'])){
	$pick = sanitize_text_field($_REQUEST['pick']);
	$date1 = date('Y-m-d', $pick);
	$time = date('H:i', $pick);
}

if(isset($_REQUEST['drop'])){
	$drop = sanitize_text_field($_REQUEST['drop']);
	$date2 = date('Y-m-d', $drop);
	$time2 = date('H:i', $drop);
}


$stdate =  $date1."T".$time.':00.000Z';
$datedrop = $date2."T".$time2.':00.000Z';

$_SESSION['finalpickdate']=$date1;
$_SESSION['finalpicktime']=$time;
$_SESSION['finaldropdate']=$date2;
$_SESSION['finaldroptime']=$time2;

$fields = array(
	"VehicleCategoryId" => 0,
	"LocationId" => $lid,
	"VehicleTypeId" => $vehicleTypeId,
	"VehicleMakeID" => 0,
	"ModelId" => 0,
	"AgeDuration" => null,
	"IsOnline" => true,
	"NumberOfSeats" => 0,
	"RentalPeriod" => 0,
	"StartDate" => $stdate,
	"EndDate" => $datedrop,
	"VehicleId" =>$vicid,
	"ClientId" => esc_attr( get_option('clientCId'))
);
  
    $auth =  "Bearer".' '.NTRAgetTokenFun();
    $data = json_encode($fields);
	
	$args = array(
		'body' => $data,
		'timeout' => '10',
		'redirection' => '5',
		'httpversion' => '1.0',
		'blocking' => true,
		'headers' => array(
			"Authorization"=>$auth,
			"Content-Type" =>"application/json",
			"cache-control"=> "no-cache"
		),
		'cookies' => array()
	);
	 
	$response = wp_remote_post( 'https://app.navotar.com/api/ReservationConfiguration/GetVehicleAndRateDetails/', $args );
	
if ($response) { 
	
  $res = json_decode($response['body']);

  $taxinfo =array();
  $taxarray= array();
  $result = array();
  if(!empty($res)){
	  
	 foreach($res as $post){
		
		if($post->vehicleId == $vicid){
			
			if(!empty($post->tax)){
			  foreach($post->tax as $tax){
				$taxinfo =array(
					'id' => $tax->taxId,
					'value' => $tax->value,
					'name'=> $tax->name,
					'desc' => $tax->description,
					'isOption' =>$tax->isOption,
					'locationName' =>$tax->locationName,
					'locationTaxID' =>$tax->locationTaxID
				);
				array_push($taxarray,$taxinfo);  
			  }
			  $_SESSION['taxarr'] = $taxarray;
			}
			
			$restotal = str_replace(',', '',number_format($post->rateDetail->estimatedTotal, 2))- number_format($post->rateDetail->taxSum, 2);
			$result['listing']='<div class="divalign"><img id="imgset" src="'.  $post->vehicleTypeImage.'"/></div>
			<div class="divaligncenter">
				<div id="setcomp">'. $post->vehicleType.'</div>
				<div id="setcomp">'. $post->vehicleMakeName.'</div>
				<div id="icondiv">
					<div class="icons"><i class="fa fa-adjust"></i></div> <div id="icontxt">'. $post->doors.'</div> 
				</div>
				<div id="icondiv">				
					<div class="icons"><i class="fa fa-code-fork"></i></div> <div id="icontxt">'. $post->transmission.'</div>
				</div>	
				<div id="icondiv">
					<div class="icons"><i class="fa fa-user"></i></div > <div id="icontxt">'. $post->seats.' </div>
				</div>	
				<div id="icondiv">
					<div class="icons"><i class="fa fa-suitcase"></i></div > <div id="icontxt">'. $post->baggages.'</div>
				</div>
				
			</div>
			<div class="divalignright">
				<div id="txtday">$'.number_format($restotal, 2).'</div>
			
				
				<div><a href="'.get_permalink( get_page_by_path( 'listing' )).'" id="btnsetting">Change</a></div>
			</div>';
		
		
		//call second API
		$taxlist = array();
		$mislist = array();
		$listarray = array();
		$taxvalues = 0;
		if($post->tax){
			foreach($post->tax as $tax){
				$row = array(
					 "locationId"=>$lid,
					 "taxId"=>$tax->taxId,
					 "name"=>$tax->name,
					 "description"=>$tax->description,
					 "value"=>$tax->value,
					 'isOption' =>$tax->isOption,
					 'locationName' =>$tax->locationName,
					 'locationTaxID' =>$tax->locationTaxID
				);
				$taxlist[] = $row;
				$taxvalues = $taxvalues + $tax->value;
			}
		}
		
		
		if(!empty($_SESSION['extra']))
		{		
			foreach($_SESSION['extra'] as $vechle)
			{
				if($vechle['taxNotAvailable'] ==1){ $taxNot = true;}else{ $taxNot = false;}
				
				if(empty($vechle['qty'])){ $qt = 1;}else{ $qt = $vechle['qty']; }
				$rows = array(
					"vehicleTypeId" => sanitize_text_field($_SESSION['vehicleTypeId']),
					 "locationId" => $vechle['locationid'],
					 "miscChargeID" => $vechle['extraid'],
					 "name" => $vechle['extra'],
					 "description" => $vechle['extra'],
					 "calculationType" => ucfirst($vechle['extraState']),
					 "value" => $vechle['ectraprice'],
					 "misChargeCode" => $vechle['misChargeCode'],
					 "isOptional" => false,
					 "unit" => $qt,
					 "taxNotAvailable" => $taxNot,
					 "isQuantity" => ($vechle['isQuantity'] == 1)?true:false,
					 "readMore" => false,
					 "addMore" => false,
					 "isOptionClicked" => false,
					 "isOptionQuantityClicked" => false,
					 "isOptionChangedClicked" => true,
					 "quantityValue" =>$qt,
					 "isSelected" => true,
					 "quantity" => $qt
				);
				
				$mislist[] = $rows;
			}	
		}
		
		$list = array(
			 "rateID"=>sanitize_text_field($post->rateDetail->rateId),
			 "rateName"=>sanitize_text_field($post->rateDetail->rateName),
			 "rateValue"=>sanitize_text_field($post->rateDetail->rateValue),
			 "extraValue"=>sanitize_text_field($post->rateDetail->extraValue),
			 "howMany"=>sanitize_text_field($post->rateDetail->howMany),
			 "howManyExtra"=>sanitize_text_field($post->rateDetail->howManyExtra),
			 "kmAllowed"=>sanitize_text_field($post->rateDetail->kmAllowed),
			 "isVisible"=>sanitize_text_field($post->rateDetail->isVisible),
			 "rateTotal"=>sanitize_text_field(number_format($post->rateDetail->estimatedTotal, 2)),
			 "extraRateTotal"=>sanitize_text_field($post->rateDetail->extraRateTotal),
			 "extraKMValue"=>sanitize_text_field($post->rateDetail->extraKMValue),
			 "initalRate"=>sanitize_text_field($post->rateDetail->initalRate),
			 "incrementValue"=>sanitize_text_field($post->rateDetail->incrementValue),
			 "clientId"=>esc_attr( get_option('clientCId')),
			 "locationId"=>sanitize_text_field($lid),
			 "vehicleTypeId"=>sanitize_text_field($post->rateDetail->vehicleTypeId),
			 "kMorMileageCharge"=>sanitize_text_field($post->rateDetail->kMorMileageCharge),
			 "fuelCharge"=>sanitize_text_field($post->rateDetail->fuelCharge),
			 "hourlyRate"=>sanitize_text_field($post->rateDetail->hourlyRate),
			 "hourlyQty"=>sanitize_text_field($post->rateDetail->hourlyQty),
			 "halfDayRate"=>sanitize_text_field($post->rateDetail->halfDayRate),
			 "halfDayQty"=>sanitize_text_field($post->rateDetail->halfDayQty),
			 "dailyRate"=>sanitize_text_field($post->rateDetail->dailyRate),
			 "dailyQty"=>sanitize_text_field($post->rateDetail->dailyQty),
			 "weekendDayRate"=>sanitize_text_field($post->rateDetail->weekendDayRate),
			 "weekendDailyQty"=>sanitize_text_field($post->rateDetail->weekendDailyQty),
			 "weeklyRate"=>sanitize_text_field($post->rateDetail->weeklyRate),
			 "weeklyQty"=>sanitize_text_field($post->rateDetail->weeklyQty),
			 "monthlyRate"=>sanitize_text_field($post->rateDetail->monthlyRate),
			 "monthlyQty"=>sanitize_text_field($post->rateDetail->monthlyQty),
			 "totalDays"=>sanitize_text_field($post->rateDetail->totalDays),
			 "extraHourlyRate"=>sanitize_text_field($post->rateDetail->extraHourlyRate),
			 "extraHourlyQty"=>sanitize_text_field($post->rateDetail->extraHourlyQty),
			 "extraDailyRate"=>sanitize_text_field($post->rateDetail->extraDailyRate),
			 "extraDailyQty"=>sanitize_text_field($post->rateDetail->extraDailyQty),
			 "extraWeekEndDayRate"=>sanitize_text_field($post->rateDetail->extraWeekEndDayRate),
			 "extraWeekEndDayQty"=>sanitize_text_field($post->rateDetail->extraWeekEndDayQty),
			 "extraWeeklyRate"=>sanitize_text_field($post->rateDetail->extraWeeklyRate),
			 "extraWeeklyQty"=>sanitize_text_field($post->rateDetail->extraWeeklyQty),
			 "dailyKMorMileageAllowed"=>sanitize_text_field($post->rateDetail->dailyKMorMileageAllowed),
			 "weeklyKMorMileageAllowed"=>sanitize_text_field($post->rateDetail->weeklyKMorMileageAllowed),
			 "monthlyKMorMileageAllowed"=>sanitize_text_field($post->rateDetail->monthlyKMorMileageAllowed),
			 "totalKMorMileageAllowed"=>sanitize_text_field($post->rateDetail->totalKMorMileageAllowed),
			 "startDate"=>$stdate,
			 "endDate"=>$datedrop,
			 "isLowest"=>sanitize_text_field($post->rateDetail->isLowest),
			 "estimatedTotal"=>sanitize_text_field(number_format($post->rateDetail->estimatedTotal, 2)),
			 "miscChargeTotal"=>sanitize_text_field($post->rateDetail->miscChargeTotal),
			 "miscChargeNonTaxableTotal"=>sanitize_text_field($post->rateDetail->miscChargeNonTaxableTotal),
			 "taxSum"=>sanitize_text_field($post->rateDetail->taxSum),
			 "totalTaxPercentageValue"=>sanitize_text_field($post->rateDetail->totalTaxPercentageValue),
		
		);
		$listarray[] = $list;
		
	$array = array(
	   "taxList2"=>$taxlist,
	   "miscList2"=>$mislist,
	   "rateDetailsList"=>$listarray,
	   "totalDays"=>sanitize_text_field($post->rateDetail->totalDays)
	);
		
	$auth =  "Bearer".' '.NTRAgetTokenFun();
    $ardata = json_encode($array);

	$args = array(
		'body' => $ardata,
		'timeout' => '10',
		'redirection' => '5',
		'httpversion' => '1.0',
		'blocking' => true,
		'headers' => array(
			"Authorization"=>$auth,
			"Content-Type" =>"application/json",
			"cache-control"=> "no-cache"
		),
		'cookies' => array()
	);
	 
	$resp = wp_remote_post( 'https://app.navotar.com/api/ReservationConfiguration/CalculateRateSummary/', $args );	
		
	if ($resp) { 
		
	  $respo = json_decode($resp['body']);	
	}	
	$mischargestotal ='';
	
	if(!empty($respo->reservationSummary->miscDetails)){
		foreach($respo->reservationSummary->miscDetails as $resVch){
			if(!empty($resVch->name) && $resVch->isTaxable==1){
				$result['mis'] .='
				<div class="rightset">
					<div class="rightdiv"><b>'.$resVch->name .'</b></div>
					<div class="rightdiv rite" id="subfare">$'.$resVch->totalMisc .'</div>
				</div>';
				
				//$mischargestotal = $mischargestotal + $resVch->totalMisc;
			}else{
				$result['misNontax'] .='
				<div class="rightset">
					<div class="rightdiv"><b>'.$resVch->name .'</b></div>
					<div class="rightdiv rite" id="subfare">$'.$resVch->totalMisc .'</div>
				</div>';
				//$mischargestotal = $mischargestotal + $resVch->miscChargePerDay;
			}
		}
	}
	
	
	//convert dates
	$startdt = new DateTime($stdate);
	$startd = $startdt->format('Y-m-d');
	$startt = $startdt->format('H:i:s');
	
	$dropdt = new DateTime($datedrop);
	$dropd = $dropdt->format('Y-m-d');
	$dropt = $dropdt->format('H:i:s');
	
	
	$pretotal =0;
	$_SESSION['miscChargeTotal'] = $respo->reservationSummary->totacMiscTaxable;
	$_SESSION['totalMiscTaxable'] = $respo->reservationSummary->totacMiscTaxable;
	$_SESSION['totalMiscNonTaxable'] = $respo->reservationSummary->totacMiscNonTaxable;
	$_SESSION['rental'] = number_format((float)$respo->reservationSummary->estimatedTotal, 2, '.', ''); 
	$_SESSION['totalTax'] = $respo->reservationSummary->totalTax;
	$_SESSION['estimatedTotal'] = $pretotal + $respo->reservationSummary->totacMiscTaxable + $respo->reservationSummary->totalTax;
	
	
	$subtoyal = $respo->reservationSummary->totacMiscTaxable + number_format((float)$respo->rateTotal, 2, '.', '');
	$result['taxvalue'].=  number_format((float)$taxvalues, 2, '.', '');
	$result['miscChargeTotal'] .= $respo->reservationSummary->totacMiscTaxable; 
	$result['totalMiscTaxable'] .= $respo->reservationSummary->totacMiscTaxable;
	$result['totalMiscNonTaxable'] .= $respo->reservationSummary->totacMiscNonTaxable;
	$result['rental'] .= number_format((float)$respo->rateTotal, 2, '.', ''); //$_SESSION['vch_estimatedTotal'];
	$result['subtotal'].=  number_format((float)$subtoyal, 2, '.', '');
	
	$taxcal = ($subtoyal * $taxvalues )/100;
	$result['totalTax'] .= number_format((float)$taxcal, 2, '.', '');
	
	if(!empty($post->rateDetail->estimatedTotal)){
		$pretotal = $post->rateDetail->estimatedTotal;
	}
	
	$totalsum .= number_format((float)$respo->rateTotal, 2, '.', '') + $respo->reservationSummary->totacMiscTaxable + $taxcal+$respo->reservationSummary->totacMiscNonTaxable;
	$result['estimatedTotal']  = number_format((float)$totalsum, 2, '.', '');
	$result['startdate'] .= $startd .' '. $startt;
	$result['enddate'] .= $dropd .' '.$dropt;
	
	echo json_encode($result);
   }
   }
	}
}

exit();
}


