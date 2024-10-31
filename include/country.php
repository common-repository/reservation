<?php
include_once('token.php');
add_action('wp_ajax_nopriv_NTRAGetCountry','NTRAGetCountry');
add_action('wp_ajax_NTRAGetCountry','NTRAGetCountry');

function NTRAGetCountry(){
//e255c76e707eccc1ad33dd10091705c7
    check_ajax_referer( 'navotardevelopebypawanajaxnounce', 'security' );
	//$url = "http://battuta.medunes.net/api/country/all/?key=5dbce5572804581afbece8b0883ecd92";
	$url = "https://app.navotar.com/api/Common/Countries/";
	global $wp_version;
	$auth =  "Bearer".' '.NTRAgetTokenFun();
	$args = array(
			'body' => null,
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
		
	$response = wp_remote_get( $url, $args ); 
	if( is_wp_error( $response ) ) {
		echo'error in API';
		return false; // Bail early
	}
	
	$data = json_decode($response['body']);
	if(!empty($data)){
		
		$opt .='<option value="">Select Country</option>';
	  foreach($data as $cou){
		  if($cou->disabled ==false){
			$opt .="<option value='$cou->value' rel='$cou->value'> $cou->text </option>";  
		  }
	  }
	  echo $opt;
	}
	
	exit();

}




//get state


add_action('wp_ajax_nopriv_NTRAGetState','NTRAGetState');
add_action('wp_ajax_NTRAGetState','NTRAGetState');

function NTRAGetState(){
	if(isset($_REQUEST['c_code'])){
		$c_code = $_REQUEST['c_code'];
	}
    check_ajax_referer( 'navotardevelopebypawanajaxnounce', 'security' );
	//$url = "http://battuta.medunes.net/api/region/".$c_code."/all/?key=5dbce5572804581afbece8b0883ecd92";
	$url = "https://app.navotar.com/api/Common/States?countryid=$c_code";
	global $wp_version;
	$auth =  "Bearer".' '.NTRAgetTokenFun();
	$args = array(
			'body' => null,
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
	$response = wp_remote_get( $url, $args ); 
	if( is_wp_error( $response ) ) {
		echo'error in API';
		return false; // Bail early
	}
	
	$data = json_decode($response['body']);
	if(!empty($data)){
		
		$opt .='<option value="">Select State</option>';
	  foreach($data as $cou){
		  if($cou->disabled == false){
			$opt .="<option value='$cou->value' rel='$cou->value'> $cou->text </option>";  
		  }
	  }
	  echo $opt;
	}
	
	exit();

}

?>