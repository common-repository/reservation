<?php 
require_once('token.php');
add_action('wp_ajax_nopriv_NTRALocationChecking','NTRALocationChecking');
add_action('wp_ajax_NTRALocationChecking','NTRALocationChecking');

function NTRALocationChecking(){
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	check_ajax_referer( 'navotardevelopebypawanajaxnounce', 'security' );
	$auth =  "Bearer".' '.NTRAgetTokenFun();
	$url = "https://app.navotar.com/api/Location/GetAll";
	global $wp_version;
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
	$opt='';
	$body = wp_remote_retrieve_body( $response );

	$data = json_decode( $body );
		if(!empty($data)){
			
		  foreach($data as $loc){
			  
				$opt .="<option value='$loc->locationId' rel='$loc->locationName'> $loc->locationName </option>";  
			
			}
		  echo $opt;
		}
		
		exit();
}


add_action('wp_ajax_nopriv_NTRALocationdropoff','NTRALocationdropoff');
add_action('wp_ajax_NTRALocationdropoff','NTRALocationdropoff');

function NTRALocationdropoff(){
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	check_ajax_referer( 'navotardevelopebypawanajaxnounce', 'security' );
	$auth =  "Bearer".' '.NTRAgetTokenFun();
	$url = "https://app.navotar.com/api/Location/GetAll";
	global $wp_version;
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
	$opt='';
	$body = wp_remote_retrieve_body( $response );

	$data = json_decode( $body );
		if(!empty($data)){
			  $opt .='<option value="" >Select Location</option>';
		  foreach($data as $loc){
			  
			  
				$opt .="<option value='$loc->locationId' rel='$loc->locationName'> $loc->locationName </option>";  
			
		  }
		  echo $opt;
		}
		
		exit();
}
