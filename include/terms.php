<?php
include_once('token.php');
add_action('wp_ajax_nopriv_NTRAreservationTerms','NTRAreservationTerms');
add_action('wp_ajax_NTRAreservationTerms','NTRAreservationTerms');
function NTRAreservationTerms(){
  check_ajax_referer( 'navotardevelopebypawanajaxnounce', 'security' );
  
  $client_id = get_option('clientCId');
  $auth =  "Bearer".' '.NTRAgetTokenFun();
	$args = array(
		'timeout' => '5',
		'redirection' => '5',
		'httpversion' => '1.0',
		'blocking' => true,
		'headers' => array(
			"Authorization"=>$auth,
			"Content-Type" =>"application/x-www-form-urlencoded",
			"cache-control"=> "no-cache"
		),
		'cookies' => array()
	);
	 
	$response = wp_remote_post( 'https://app.navotar.com/api/ReservationConfiguration/GetAllTermsAndConditionsByType?clientId=$client_id&typeId=3"', $args );

if ($response) { 
 {
  $trm = json_decode($response['body']);
  
  
   if(!empty(get_option('area2'))){
        
		 echo '<div id="setting-error" class="updated settings-error notice is-dismissible"><p><strong> Terms and policy are already saved</strong> </p>
			<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
			</div>';
    }
   else {
      add_option('area2', $trm[0]->description);
	  echo '<div id="setting-error" class="updated settings-error notice is-dismissible"><p><strong> Terms and policy are Inserted successfully</strong> </p>
	<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
	</div>';
	header("refresh: 1");
    }
  
}

}
die();
}