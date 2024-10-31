<?php
include_once('token.php');

add_action('wp_ajax_nopriv_NTRAcreateReservtion','NTRAcreateReservtion');
add_action('wp_ajax_NTRAcreateReservtion','NTRAcreateReservtion');

function NTRAcreateReservtion(){
	check_ajax_referer( 'navotardevelopebypawanajaxnounce', 'security' );
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	
	if(isset($_REQUEST['cid'])){
		$cid = sanitize_text_field($_REQUEST['cid']);
	}
	
	$fare = explode("$",sanitize_text_field($_SESSION['user_detail']['fare']));
	$subtotal = explode("$",sanitize_text_field($_SESSION['user_detail']['subtotal']));
	$taxtotal = explode("$",sanitize_text_field($_SESSION['user_detail']['taxtotal']));
	$extratotal = explode("$",sanitize_text_field($_SESSION['user_detail']['extratotal']));
	$total = explode("$",sanitize_text_field($_SESSION['user_detail']['total']));
	$origdate = $_SESSION['finalpickdate'];
	$picktime = $_SESSION['finalpicktime'];
	$drop =  $_SESSION['finaldropdate'];
	$droptime = $_SESSION['finaldroptime'];
	$droplocation = sanitize_text_field($_SESSION['dropoff']);
	$promotionCode =   sanitize_text_field($_SESSION['promotionCode']);
	$discountValue  = sanitize_text_field($_SESSION['promovalue']);
	$promoid = sanitize_text_field($_SESSION['promoid']);
	if(empty($droplocation)){
		$droplocation = sanitize_text_field($_SESSION['locid']);
	}
	
	
	$misarray = array();
	$taxinfoarray = array();
	$ratedetail = array();
	$promoinfo = array();
	$promoext = array(
		"promotionCode"=>$promotionCode,
		"promotionDiscount"=>$discountValue,
		"promotionID"=> $promoid,
		"promotionCountNumber"=> null,
		"promotionIssue"=> null,
		"promotionListId"=> 0,
		"orderNo"=> 0
	);
	$promoinfo[] = $promoext;
	
	
	
	
	// start
	
	$fields = array(
		"VehicleCategoryId" => 0,
		"LocationId" => sanitize_text_field($_SESSION['locid']),
		"VehicleTypeId" => 0,
		"VehicleMakeID" => 0,
		"ModelId" => 0,
		"AgeDuration" => null,
		"IsOnline" => true,
		"NumberOfSeats" => 0,
		"RentalPeriod" => 0,
		"StartDate" => $origdate." ".date("g:i A", strtotime($picktime)),
		"EndDate" => $drop." ".date("g:i A", strtotime($droptime)),
		"VehicleId" =>0,
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
	   foreach($res as $post){
		if($post->vehicleId == sanitize_text_field($_SESSION['vtid'])){
			
			
			
			
			
			//end
			
			$rdetail = array(
				 "rateID" => sanitize_text_field($_SESSION['rateId']),
				 "rateName" => $post->rateDetail->rateName,
				 "rateValue" => $post->rateDetail->rateValue,
				 "extraValue" =>$post->rateDetail->extraValue,
				 "howMany" => $post->rateDetail->howMany,
				 "howManyExtra" => $post->rateDetail->howManyExtra,
				 "kmAllowed" => $post->rateDetail->kmAllowed,
				 "isVisible" => $post->rateDetail->isVisible,
				 "rateTotal" =>  $post->rateDetail->rateTotal,
				 "extraRateTotal" => $post->rateDetail->extraRateTotal,
				 "extraKMValue" =>$post->rateDetail->extraKMValue,
				 "initalRate" => $post->rateDetail->initalRate,
				 "incrementValue" => $post->rateDetail->incrementValue,
				 "clientId" => esc_attr(get_option('clientCId')),
				 "locationId" => sanitize_text_field($_SESSION['locid']),
				 "vehicleTypeId" =>$post->rateDetail->vehicleTypeId,
				 "kMorMileageCharge" => $post->rateDetail->kMorMileageCharge,
				 "fuelCharge" => $post->rateDetail->fuelCharge,
				 "hourlyRate" => $post->rateDetail->hourlyRate,
				 "hourlyQty" => $post->rateDetail->hourlyQty,
				 "halfDayRate" => $post->rateDetail->halfDayRate,
				 "halfDayQty" =>$post->rateDetail->halfDayQty,
				 "dailyRate" => $post->rateDetail->dailyRate,
				 "dailyQty" =>$post->rateDetail->dailyQty,
				 "weekendDayRate" => $post->rateDetail->weekendDayRate,
				 "weekendDailyQty" => $post->rateDetail->weekendDailyQty,
				 "weeklyRate" => $post->rateDetail->weeklyRate,
				 "packageName"=>'Test',
				 "basePrice"=>sanitize_text_field($_SESSION['rental']),
				 "weeklyQty" => $post->rateDetail->weeklyQty,
				 "monthlyRate" =>$post->rateDetail->monthlyRate,
				 "monthlyQty" => $post->rateDetail->monthlyQty,
				 "totalDays" => $post->rateDetail->totalDays,
				 "extraHourlyRate" =>$post->rateDetail->extraHourlyRate,
				 "extraHourlyQty" => $post->rateDetail->extraHourlyQty,
				 "extraDailyRate" => $post->rateDetail->extraDailyRate,
				 "extraDailyQty" => $post->rateDetail->extraDailyQty,
				 "extraWeekEndDayRate" => $post->rateDetail->extraWeekEndDayRate,
				 "extraWeekEndDayQty" => $post->rateDetail->extraWeekEndDayQty,
				 "extraWeeklyRate" =>$post->rateDetail->extraWeeklyRate,
				 "extraWeeklyQty" => $post->rateDetail->extraWeeklyQty,
				 "dailyKMorMileageAllowed" => $post->rateDetail->dailyKMorMileageAllowed,
				 "weeklyKMorMileageAllowed" => $post->rateDetail->weeklyKMorMileageAllowed,
				 "monthlyKMorMileageAllowed" => $post->rateDetail->monthlyKMorMileageAllowed,
				 "totalKMorMileageAllowed" => $post->rateDetail->totalKMorMileageAllowed,
				 "startDate" => $origdate.' '.$picktime.':00.000',
				 "endDate" =>   $drop.' '.$droptime.':00.000',
				 "startDateStr" => $origdate.' '.$picktime.':00.000',
				 "endDateStr"=> $drop.' '.$droptime.':00.000',
				 "isLowest" => sanitize_text_field($post->rateDetail->isLowest),
				 "estimatedTotal" => $total[1],
				 "miscChargeTotal" => sanitize_text_field($_SESSION['totalMiscTaxable']),
				 "miscChargeNonTaxableTotal" => sanitize_text_field($_SESSION['totalMiscNonTaxable']),
				 "taxSum" =>sanitize_text_field($_SESSION['totalTax'])
			);
			$ratedetail[] = $rdetail;
			
			if(!empty($_SESSION['extra']))
			{		
				foreach($_SESSION['extra'] as $vechle)
				{	if( empty($vechle['qty'])){ $qt = 1;}else{ $qt =  $vechle['qty']; }
				if($vechle['taxNotAvailable'] ==1){ $taxNot = true;}else{ $taxNot = false;}
				$isQuantity = ($vechle['isQuantity'] == 1)?true:false;	
					$row = array(
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
					 "isQuantity" => $isQuantity,
					 "readMore" => false,
					 "addMore" => false,
					 "isOptionClicked" => false,
					 "isOptionQuantityClicked" => false,
					 "isOptionChangedClicked" => true,
					 "quantityValue" =>$qt,
					 "isSelected" => true,
					 "quantity" => $qt
					);
					
					$misarray[] = $row;
				}	
			}
			
			
			if(!empty($_SESSION['taxarr']))
			{
				foreach($_SESSION['taxarr'] as $tax)
				{
					$taxpoint = array(
						"locationId"=>sanitize_text_field($_SESSION['locid']),
						"taxId"=>$tax['id'],
						"name"=>$tax['name'],
						"description"=>$tax['desc'],
						"value"=>$tax['value'],
						"locationName"=>$tax['locationName'],
						"locationTaxID"=>$tax['locationTaxID'],
						"isOption"=>$tax['isOption'],
						"isSelected"=>true
					);
					$taxinfoarray[] = $taxpoint;
				}
			}
				

			$fields = array(
				"customerId"=>$cid,
				"rateName" => "base",
				"vehicleId"=> "",//sanitize_text_field($_SESSION['vtid']),
				"basePrice"=> sanitize_text_field($_SESSION['rental']),
				"rateId"=>sanitize_text_field($_SESSION['rateId']),
				"startDateStr"=>  $origdate.' '.$picktime.'.000',
				"endDateStr"=>   $drop.' '.$droptime.'.000',
				"totalDays"=>    sanitize_text_field($_SESSION['user_detail']['days']),
				"rateTotal"=>  $total[1],
				"estimatedTotal"=>   sanitize_text_field($_SESSION['estimatedTotal']),
				"totalMischarge"=> sanitize_text_field($_SESSION['miscChargeTotal']),
				"totalMischargeWithOutTax"=>  sanitize_text_field($_SESSION['totalMiscNonTaxable']),
				"total"=>  sanitize_text_field($_SESSION['estimatedTotal']),
				"promotionDiscount"=> $discountValue,
				"startLocationName"=> sanitize_text_field($_SESSION['locid']),
				"endLocationName"=> null,
				"reservationType"=> "Online",
				"taxList2"=>$taxinfoarray,
				"miscList2"=>$misarray,
				"rateDetailsList" => $ratedetail,
				"firstName"=>sanitize_text_field($_SESSION['user_detail']['firstName']),
				"lastName"=>sanitize_text_field($_SESSION['user_detail']['lastName']),
				"phone"=>sanitize_text_field($_SESSION['user_detail']['Phone']),
				"customerMail"=>sanitize_text_field($_SESSION['user_detail']['email']),
				"promotionList" =>$promoinfo,
				"vehicleTypeID" => sanitize_text_field($_SESSION['vehicleTypeId']),
				"startDate" => $origdate.' '. $picktime.':00.000',
				"endDate" => $drop.' '.$droptime.':00.000',
				"isOnline" => true,
				"startLocationId" =>sanitize_text_field($_SESSION['locid']),
				"endLocationId" => $droplocation, 
				"hourlyRate" => sanitize_text_field($post->rateDetail->hourlyRate),
				"dailyRate" => sanitize_text_field($post->rateDetail->dailyRate),
				"weeklyRate" => sanitize_text_field($post->rateDetail->weeklyRate),
				"monthlyRate" =>sanitize_text_field($post->rateDetail->monthlyRate),
				"note" => sanitize_text_field($_SESSION['user_detail']['note']),
				"totalDays" => sanitize_text_field($_SESSION['user_detail']['days']),
				"totalDiscount" => $discountValue
			);
			

				$auth =  "Bearer".' '.NTRAgetTokenFun();
				$data = json_encode($fields);
				$args = array(
					'body' => $data,
					'timeout' => '5',
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
				 
				$response = wp_remote_post( 'https://app.navotar.com/api/Reservation/Create', $args );

				if (!empty($response['body'])) {
				  echo $response['body'];
				}else{
					echo -1;
				}
			}//
	    }//
	}//
	die();
}