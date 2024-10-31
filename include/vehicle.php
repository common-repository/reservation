<?php
include_once('token.php');
add_action('wp_ajax_nopriv_NTRAlistVichele','NTRAlistVichele');
add_action('wp_ajax_NTRAlistVichele','NTRAlistVichele');

function NTRAlistVichele(){
check_ajax_referer( 'navotardevelopebypawanajaxnounce', 'security' );
global $wp_session;

	$today = date('Y-m-d');
    $client_id = get_option('clientCId');
	$fields = array(
		"LocationId"=>0,
		"VehicleTypeId"=>0,
		"StartDate"=>$today,
		"EndDate"=>$today,
		"VehicleId"=>null,
		"VehicleMakeID"=>0,
		"ModelId"=>0,
		"AgeDuration"=>null,
		"IsOnline"=>true,
		"NumberOfSeats"=>0,
		"RentalPeriod"=>0,
		"VehicleCategoryId"=>0
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
	 
	$response = wp_remote_post( 'https://app.navotar.com/api/ReservationConfiguration/GetVehicleListForReservation', $args );

if ($response) { 
$opt='';
  $sort = 'asc';
  $existing = array();
  $res = json_decode($response['body']);
  if(!empty($res)){
  $opt .="<option value='0'>Select Vehicle</option>";
  foreach($res as $veh){
	   if (!in_array($veh->vehicleTypeId, $existing)) { 
            $existing[] = $veh->vehicleTypeId;
			if(!empty($_SESSION['vehicleTypeId']) == $veh->vehicleTypeId){
				$opt .="<option value=".$veh->vehicleTypeId ." selected>". $veh->vehicleType ."</option>";
			}else{
				$opt .="<option value=".$veh->vehicleTypeId .">". $veh->vehicleType ."</option>";
			}
	   }
  }
  echo $opt;
	wp_die(); 
  }
}

}