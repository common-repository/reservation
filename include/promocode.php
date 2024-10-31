<?php 
include_once('token.php');
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
add_action('wp_ajax_nopriv_NTRAreservationPromo','NTRAreservationPromo');
add_action('wp_ajax_NTRAreservationPromo','NTRAreservationPromo');

function NTRAreservationPromo(){
    
	
  check_ajax_referer( 'navotardevelopebypawanajaxnounce', 'security' );
  if(isset($_REQUEST['viheletype']) ){
	$viheletype = sanitize_text_field($_POST['viheletype']);
  }
  if(isset($_REQUEST['promocode']) ){
	$promocode = sanitize_text_field($_POST['promocode']);
  }
  
  if(isset($_REQUEST['picklocation']) ){
	$picklocation = sanitize_text_field($_POST['picklocation']);
  }
  
  $fields = array('PromotionCode'=> $promocode,'VehicleTypeId'=>$viheletype,'LocationId'=>$picklocation);
  
  
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
	 
	$response = wp_remote_post( 'https://app.navotar.com/api/Promotion/Search', $args );

	if ($response) { 
	$arr = array();
	$res = json_decode( $response['body']);
	if(!empty($res)){
			$promodate = date('Y-m-d H:i:s');
		
			$startDate = date('Y-m-d H:i:s', strtotime($res->startDate));
			$endDate = date('Y-m-d H:i:s',  strtotime($res->endDate));
			
			if (strtotime($promodate) > strtotime($startDate) && strtotime($promodate) < strtotime($endDate)){
				
				if($promocode == $res->promotionCode && $picklocation == $res->locationId || $res->locationId ==0 ){
					$arr['status']="success";
					$arr['msg'] .= "Promotion code accepted";
					$arr['promovalue'] .= $res->discountValue;
					$arr['discountType'] .= $res->discountType;
					$_SESSION['promotionCode'] = $promocode;
					$_SESSION['promovalue'] = $res->discountValue;
					$_SESSION['discountType'] = $res->discountType;
					$_SESSION['minimumTotal'] = $res->minimumTotal;
					$_SESSION['promoid'] = $res->promotionID;
				}
				else{
					$arr['error']="error";
					$arr['msg'] .= "Promotion code not valid for this location";
				}
			}else{
				$arr['error']="error";
				$arr['msg'] = "This promocode is not valid. ";
			}
		
	}
	echo json_encode($arr);
}
die();
}



add_action('wp_ajax_nopriv_NTRApromo','NTRApromo');
add_action('wp_ajax_NTRApromo','NTRApromo');


function NTRApromo(){
  check_ajax_referer( 'navotardevelopebypawanajaxnounce', 'security' );
  if(isset($_REQUEST['viheletype']) ){
	$viheletype = sanitize_text_field($_POST['viheletype']);
  }
  if(isset($_REQUEST['promocode']) ){
	$promocode = sanitize_text_field($_POST['promocode']);
  }
  
  if(isset($_REQUEST['picklocation']) ){
	$picklocation = sanitize_text_field($_POST['picklocation']);
  }

  if(isset($_REQUEST['start_date']) ){
	$start_date = sanitize_text_field($_POST['start_date']);
  }
  if(isset($_REQUEST['end_date']) ){
	$end_date = sanitize_text_field($_POST['end_date']);
  }
  
  $fields = array('PromotionCode'=>$promocode ,'VehicleTypeId'=>$viheletype,'LocationId'=>$picklocation);
  
  
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
	 
	$response = wp_remote_post( 'https://app.navotar.com/api/Promotion/Search', $args );

	if ($response) { 
	
	$arr = array();
	$res = json_decode( $response['body']);

	if(!empty($res)){
			$promodate = date('Y-m-d H:i:s');
		
			$startDate = date('Y-m-d H:i:s', strtotime($res->startDate));
			$endDate = date('Y-m-d H:i:s',  strtotime($res->endDate));

			$pickedStartDate = strtotime($start_date);
			$pickedEndDate = strtotime($end_date);

			$pickedDiff = floor(($pickedEndDate - $pickedStartDate)/60/60/24);
			
			if (strtotime($promodate) > strtotime($startDate) && strtotime($promodate) < strtotime($endDate) && $pickedDiff >= $res->minimumDay){
				
				if($promocode == $res->promotionCode && $picklocation == $res->locationId || $res->locationId ==0 ){
					$arr['status']="success";
					$arr['msg'] .= "Promotion code accepted";
					$arr['promovalue'] .= $res->discountValue;
					$arr['discountType'] .= $res->discountType;
					$_SESSION['promotionCode'] = $promocode;
					$_SESSION['promovalue'] = $res->discountValue;
					$_SESSION['discountType'] = $res->discountType;
					$_SESSION['minimumTotal'] = $res->minimumTotal;
					$_SESSION['promoid'] = $res->promotionID;
				}
				else{
					$arr['error']="error";
					$arr['msg'] .= "Promotion code not valid for this location";
					$_SESSION['promotionCode'] = '';
					$_SESSION['promovalue'] = '';
					$_SESSION['discountType'] = '';
					$_SESSION['minimumTotal'] = '';
					$_SESSION['promoid'] = '';
				}
			}else{
				$arr['error']="error";
				$arr['msg'] = "This promocode is not valid. ";
				$_SESSION['promotionCode'] = '';
				$_SESSION['promovalue'] = '';
				$_SESSION['discountType'] ='';
				$_SESSION['minimumTotal'] = '';
				$_SESSION['promoid'] = '';
			}
		
	}
	echo json_encode($arr);
}
die();
}
