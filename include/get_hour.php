<?php
include_once('token.php');

add_action('wp_ajax_nopriv_NTRAreservationGetHours','NTRAreservationGetHours');
add_action('wp_ajax_NTRAreservationGetHours','NTRAreservationGetHours');
function NTRAreservationGetHours(){
check_ajax_referer( 'navotardevelopebypawanajaxnounce', 'security' );


if(isset($_REQUEST['picklocation'])){
	 $location = sanitize_text_field($_REQUEST['picklocation']);
}
if(isset($_REQUEST['pdate'])){
	 $pdate = sanitize_text_field($_REQUEST['pdate']);
}
if(isset($_REQUEST['ddate'])){
	 $ddate = sanitize_text_field($_REQUEST['ddate']);
}

if(isset($_REQUEST['stime'])){
	 $ptime = sanitize_text_field($_REQUEST['stime']);
}

if(isset($_REQUEST['etime'])){
	 $dtime = sanitize_text_field($_REQUEST['etime']);
}
$auth =  "Bearer".' '.NTRAgetTokenFun();
$url = "https://app.navotar.com/api/ReservationConfiguration/GetStoreHoursForLocation?locationId=".$location;
global $wp_version;
$st = false;
$args = array(
			'timeout'     => 5,
    'redirection' => 5,
    'httpversion' => '1.0',
    'user-agent'  => 'WordPress/' . $wp_version . '; ' . home_url(),
    'blocking'    => true,
    'cookies'     => array(),
    'body'        => null,
    'compress'    => false,
    'decompress'  => false,
    'sslverify'   => false,
    'stream'      => false,
    'filename'    => null,
			'headers'     => array(
				"Authorization"=>$auth,
				"Content-Type"=> "application/json",
				"cache-control"=>"no-cache"
			)
		); 
$response = wp_remote_get( $url, $args ); 
if( is_wp_error( $response ) ) {
	echo'error in API';
	return false; // Bail early
}
$body = wp_remote_retrieve_body( $response );
$data = json_decode( $body );
if(!empty($data)){
	$ftime = date('H:i', strtotime($ptime));
	$stime = date('H:i', strtotime($dtime));
	
	//check day of pickupdate
	
	if($pdate == $ddate){
		
		foreach($data as $rec){
			$weekDay = date('N', strtotime($pdate));
			$navotarday = $weekDay + 1;
			if($weekDay ==7){
				$navotarday =1;
			}
			
			if($rec->day == $navotarday && $rec->isHoliday == false){
				
				//start time
				$endTime = date('Hi', strtotime($rec->endTime));
				$startdate = date('Hi', strtotime($rec->startTime));
				
				if(strtotime($ftime)< strtotime($startdate)){
					$arr['error']="error1";
					$arr['msg'] .= "pick-up location is closed.Time should be greater than ".date('H:i', strtotime($rec->startTime));
					echo json_encode($arr);
					exit;
				}
				elseif(strtotime($stime)> strtotime($endTime)){
					
					$arr['error']="error2";
					$arr['msg'] .= "DropOff location is closed. Time should be less than ".date('H:i', strtotime($rec->endTime));
					echo json_encode($arr);
					exit;
				}else{
					
					$dDay = date('N', strtotime($ddate));
					$nadday = $dDay + 1;
					if($dDay == 7){
						$nadday =1;
					}
					foreach($data as $rec){
						if($rec->day == $nadday && $rec->isHoliday == false){
							//end time
							$endTime = date('Hi', strtotime($rec->endTimeStr));
							if(strtotime($stime) > strtotime($endTime)){
								$arr['error']="error2";
								$arr['msg'] .= "DropOff location is closed. Time should be less than ".date('H:i', strtotime($rec->endTimeStr));
							}else{
								$arr['error']="success";
								
							}
						}
					}
				}
				
			}elseif($rec->day == $navotarday && $rec->isHoliday == true){
				$arr['error']="error3";
				$arr['msg'] .= "Reservation is closed today due to holiday.";
				exit;
			}
		}
	}
	//($pdate != $ddate)
	if($pdate != $ddate){
		
		if($st ==false){
			
			$weekDay = date('N', strtotime($pdate));
			$navotarday = $weekDay + 1;
			if($weekDay ==7){
				$navotarday =1;
			}
			
			foreach($data as $rec){
				if($rec->day == $navotarday && $rec->isHoliday == false){
					
				$startdate = date('H:i', strtotime($rec->startTimeStr));
					if(strtotime($ftime)< strtotime($startdate) ){
						$arr['error']="error6";
						$arr['msg'] .= "Pick-up location is closed. Enter greater than ".date('H:i', strtotime($rec->startTimeStr));
						
					}else{
						
						$st = true;
					}
				}elseif($rec->day == $navotarday && $rec->isHoliday == true){
					
					$arr['error']="error4";
					$arr['msg'] .= "Reservation is closed today due to holiday.";
					echo json_encode($arr);
					exit;
				}
				
			}
			
		}
		
		
		
		if($st == true){
			$dDay = date('N', strtotime($ddate));
			$nadday = $dDay + 1;
			if($dDay == 7){
				$nadday =1;
			}
			foreach($data as $rec){
				if($rec->day == $nadday && $rec->isHoliday == false){
					//end time
					$endTime = date('Hi', strtotime($rec->endTimeStr));
					if(strtotime($stime) > strtotime($endTime)){
						$arr['error']="error2";
						$arr['msg'] .= "DropOff location is closed. Time should be less then ".date('H:i', strtotime($rec->endTimeStr));
					}else{
						$arr['error']="success";
						
					}
				}
			}
		}
		
	}
	
	echo json_encode($arr);
}


die();
}