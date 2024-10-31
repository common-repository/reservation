<?php
	
	function NTRAgetTokenFun(){
		$body = "client_id=". esc_attr( get_option('clientIDs') )."&grant_type=client_credentials&client_secret=".esc_attr( get_option('apiConsumerSecret') );
		 
		$args = array(
			'body' => $body,
			'timeout' => '5',
			'redirection' => '5',
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => array(
				"Content-Type: application/x-www-form-urlencoded",
				"cache-control: no-cache"
			),
			'cookies' => array()
		);
		 
		$response = wp_remote_post( 'https://app.navotar.com/API/api/token', $args );
		
		if ($response) {
			$data =  json_decode($response['body']);
			return $data->access_token;
		}
	}
	



?>