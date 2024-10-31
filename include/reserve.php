<?php
include_once('token.php');
add_action('wp_ajax_nopriv_NTRAreservationReserve','NTRAreservationReserve');
add_action('wp_ajax_NTRAreservationReserve','NTRAreservationReserve');

function NTRAreservationReserve(){
	check_ajax_referer( 'navotardevelopebypawanajaxnounce', 'security' );
	
	$fname = $lname = $phone = $email = $state = $city = $add1 = $add2 = $zip = $note = $nameoncard = $cardno = $cvv = $fare =$expiryyear = $expirymonth = $subtotal = $taxtotal = $extratotal = $total = $days ='';
	if(isset($_REQUEST['fname'])){ $fname = sanitize_text_field($_REQUEST['fname']); }
	if(isset($_REQUEST['lname'])){ $lname = sanitize_text_field($_REQUEST['lname']);}
	if(isset($_REQUEST['phone'])){ $phone = sanitize_text_field($_REQUEST['phone']);}
	if(isset($_REQUEST['email'])){ $email = sanitize_email(is_email($_REQUEST['email']));}
	if(isset($_REQUEST['state'])){ $state = sanitize_text_field($_REQUEST['state']);}
	if(isset($_REQUEST['country'])){ $country = sanitize_text_field($_REQUEST['country']);}
	if(isset($_REQUEST['city'])) { $city  = sanitize_text_field($_REQUEST['city']);}
	if(isset($_REQUEST['add1'])) { $add1  = sanitize_text_field($_REQUEST['add1']);}
	if(isset($_REQUEST['add2'])) { $add2  = sanitize_text_field($_REQUEST['add2']);}
	if(isset($_REQUEST['zip'])) {  $zip   = sanitize_text_field($_REQUEST['zip']);}
	if(isset($_REQUEST['note'])) { $note  = sanitize_text_field($_REQUEST['note']);}


	// card detail
	if(isset($_REQUEST['nameoncard'])) { $nameoncard  = sanitize_text_field($_REQUEST['nameoncard']);}
	if(isset($_REQUEST['cardno'])) { $cardno  = sanitize_text_field($_REQUEST['cardno']);}
	if(isset($_REQUEST['cvv'])) { $cvv  = sanitize_text_field($_REQUEST['cvv']);}
	if(isset($_REQUEST['expiryyear'])) {  $expiryyear   = sanitize_text_field($_REQUEST['year']);}
	if(isset($_REQUEST['expirymonth'])) {  $expirymonth   = sanitize_text_field($_REQUEST['month']);}

	//extra
	if(isset($_REQUEST['fare'])) { $fare  = sanitize_text_field($_REQUEST['fare']);}
	if(isset($_REQUEST['subtotal'])) { $subtotal  = sanitize_text_field($_REQUEST['subtotal']);}
	if(isset($_REQUEST['taxtotal'])) { $taxtotal  = sanitize_text_field($_REQUEST['taxtotal']);}
	if(isset($_REQUEST['extratotal'])) {  $extratotal   = sanitize_text_field($_REQUEST['extratotal']);}
	if(isset($_REQUEST['total'])) {  $total   = sanitize_text_field($_REQUEST['total']);}
	if(isset($_REQUEST['days'])) {  $days   = sanitize_text_field($_REQUEST['days']);}
	
	//global $wp_session;
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$_SESSION['user_detail'] = array(
	   "firstName" 	=>$fname,
	   "lastName"  	=>$lname,
	   "Phone"    	=>$phone,
	   "email"		=>$email,
	   
	   "nameoncard" =>$nameoncard,
	   "cardno"  	=>$cardno,
	   "cvv"    	=>$cvv,
	   "expiryyear"	=>$expiryyear,
	   "expirymonth"=>$expirymonth,
	   "stateId"	=>$state,
	   "city"		=>$city,
	   "address1"	=>$add1,
	   "address2"	=>$add2,
	   "zipCode"	=>$zip,
	   'countryId'  =>$country,
	   
	   'fare'   =>$fare,
	   'subtotal'   =>$subtotal,
	   'taxtotal'   =>$taxtotal,
	   'extratotal' => $extratotal,
	   'total'      => $total,
	   'days'       => $days,
	   'note'       => $note
	   
	);
	//print_r($wp_session['user_detail']);die;

	$fields = array(
	   "firstName" 	=>$fname,
	   "lastName"  	=>$lname,
	   "hPhone"    	=>$phone,
	   "email"		=>$email,
	   "countryId"	=>$country,
	   "stateId"	=>$state,
	   "city"		=>$city,
	   "address1"	=>$add1,
	   "address2"	=>$add2,
	   "zipCode"	=>$zip,
	   "reservationNote"=>$note,
	   "active"			=>true,
	   "createdDate"	=>gmdate("Y-m-d\TH:i:s\Z"),
	   "creditCardType"	=>"visa",
	   "ccNumber"		=>$cardno,
	   "expiryYear"		=>$expiryyear,
	   "expiryMonth"	=>$expirymonth
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
		 
		$response = wp_remote_post( 'https://app.navotar.com/api/Customer/AddCustomerForReservation', $args );

		if ($response) { 
		  echo $response['body'];
		}
		
}