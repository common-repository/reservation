<?php 
add_action('wp_ajax_nopriv_NTRAreservationLogin','NTRAreservationLogin');
add_action('wp_ajax_NTRAreservationLogin','NTRAreservationLogin');

function NTRAreservationLogin(){
	
	check_ajax_referer( 'navotardevelopebypawanajaxnounce', 'security');
	if ( current_user_can('manage_options') ){
		if(isset($_REQUEST['ClientId'])){
		$clientid = sanitize_text_field($_POST['ClientId']);
		}
		
		if(isset($_REQUEST['ApiClientId'])){
		$apiclientid = sanitize_text_field($_POST['ApiClientId']);
		}
		if(isset($_REQUEST['secret'])){
		$secret = sanitize_text_field($_POST['secret']);
		}
		//check records
		

		if(!empty( esc_attr( get_option('clientIDs'))) && !empty( esc_attr( get_option('apiConsumerSecret')))){
			NTRAforUpdate($clientid,$apiclientid,$secret);
			wp_die(); 
		}else{

			NTRAcheckUser($clientid,$apiclientid,$secret);
			wp_die(); 
		}
	}
}

function NTRAcheckUser($clientid,$apiclientid,$secret){
	
		
	if(empty($clientid) || empty($apiclientid) || empty($secret)){
		echo "<div class='unsuccess'>Please fill all the fields</div>";
	}else{
		
		global $wpdb;
		$table_name = $wpdb->prefix ."options";    // Enter without prefix
		
		$rows = array(
			array(
				'option_name' => 'clientIDs',
				'option_value' => trim($apiclientid),
				'autoload' => 'yes'    
			),
			array(
				'option_name' => 'apiConsumerSecret',
				'option_value' => trim($secret),
				'autoload' => 'yes'    
			),
			
			array(
				'option_name' => 'clientCId',
				'option_value' => trim($clientid),
				'autoload' => 'yes'    
			)
		);

		foreach( $rows as $row )
		{
			$result = $wpdb->insert( $table_name, $row);  
		}
		
		if( $result){
			echo "<div class='success'>Login Success. Your plugin is activated.</div>";
			
		}else{
			
			echo "<div class='unsuccess'>Login Fail. Please Verify ID</div>";
			
		}
	}
	die();
}


function NTRAforUpdate($clientid,$apiclientid,$secret){
		
	if(empty($clientid) || empty($apiclientid) || empty($secret)){
		
		
	}else{
				
		global $wpdb;
		$table_name  = $wpdb->prefix."options";
		$sql = "UPDATE $table_name SET `option_value` = '".$clientid."' WHERE `option_name` = 'clientCId'";
		$sql2 = "UPDATE $table_name SET `option_value` = '".$apiclientid."' WHERE `option_name` = 'clientIDs'";
		$sql3 = "UPDATE $table_name SET `option_value` = '".$secret."' WHERE `option_name` = 'apiConsumerSecret'";
		$result = $wpdb->query($sql);
		$result2 = $wpdb->query($sql2);
		$result3 = $wpdb->query($sql3);
		if($result){
			echo "<div class='success'>Login Success. Plugin is already activated and new key is updated.</div>";
		}else{
			echo "<div class='unsuccess'>Login Success. Plugin is already activated.</div>";
			
		}
	}
die();
}



function app_output_buffer() {
	ob_start();
} 
add_action('init', 'app_output_buffer');