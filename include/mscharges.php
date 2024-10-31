<?php
include_once('token.php');

add_action('wp_ajax_nopriv_NTRAmisCharges','NTRAmisCharges');
add_action('wp_ajax_NTRAmisCharges','NTRAmisCharges');

function NTRAmisCharges(){
	check_ajax_referer( 'navotardevelopebypawanajaxnounce', 'security' );
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if(isset($_REQUEST['vtid']) ){
		$vtid = sanitize_text_field(trim($_REQUEST['vtid']));
	}
  
	if(isset($_REQUEST['lid']) ){
		$lid = sanitize_text_field(trim($_REQUEST['lid']));
	}
  
    if(isset($_REQUEST['pick']) ){
	   $pick = sanitize_text_field(trim($_REQUEST['pick']));
    } 
  
    if(isset($_REQUEST['drop']) ){
	   $drop = sanitize_text_field(trim($_REQUEST['drop']));
    }
	
	if(isset($_POST['rateId']) ){
		$rateid = sanitize_text_field(trim($_POST['rateId']));
	} 
	
	if(isset($_POST['vehicleTypeId']) ){
		$vehicleTypeId = sanitize_text_field(trim($_POST['vehicleTypeId']));
	} 
  
  $_SESSION['locid'] = $lid;
  $_SESSION['vtid'] = $vtid;
  $_SESSION['rateId'] = $rateid;
  $_SESSION['vehicleTypeId'] = $vehicleTypeId;
  
  if(!empty($vtid) || !empty($lid))
  {
	$auth =  "Bearer".' '.NTRAgetTokenFun();
	$fields = array('VehicleTypeId'=> $vtid,'LocationId'=>$lid );
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
	 
	$response = wp_remote_post( 'https://app.navotar.com/api/MisCharges/MiscSearch/', $args );
	
		$i=1;
		$res = json_decode($response['body']);
		$taxNotAvailable=0;
		?>
		<div id="message" style="display:none;">These are mendetory Addon. You cannot remove it.</div>
		<?php
		if(!empty($res) && empty($response['message'])){ ?>
			<form action="<?php echo get_permalink( get_page_by_path( 'summary' ));  ?>" method="POST">
			
			<?php	
			  foreach($res as $po){
				if($po->calculationType != 'Range'){
				  if($po->taxNotAvailable ==true){ $taxNotAvailable =1;} else{$taxNotAvailable =0;}
				  if($po->isOptional ==false){
			?>
				<input type="hidden" name="vich" value="<?php echo $po->vehicleTypeId.'-'.$po->locationId;  ?>" id="getval<?php echo $i; ?>" />
				<input type="hidden" value="<?php echo $pick;  ?>" name="pick" id="pick<?php echo $i; ?>" />
				<input type="hidden" value="<?php echo $drop;  ?>" name="drop" id="drop<?php echo $i; ?>" />
				<input type="hidden"  value="<?php echo $po->name.'-'.$po->miscChargeID.'-'.$po->value.'-'.$po->calculationType.'-'.$po->isQuantity.'-'.$po->misChargeCode.'-'.$po->unit.'-'.$taxNotAvailable.'-'.$po->isQuantity;  ?>" id="pid<?php echo $i; ?>" />
				
				<input type="hidden" value="<?php echo ($po->isQuantity == false)?0:$po->isQuantity;  ?>" rel="<?php echo $isOptional; ?>" id="statusmis<?php echo $i; ?>" />
				<div class="settingdiv">
					<div class="datasetleft"><i class="fa fa-check-circle icons" style="color:green"></i><?php echo ucfirst($po->name); ?></div>
					<div class="datasettxt"><strong>$<?php echo $po->value; ?> </strong>/ <?php echo $po->calculationType;  ?></div>
					<?php if( esc_attr( get_option('chargeDesc') ) == 'On') { ?>
					<div class="dataset"><a class="anext"  getId="<?php echo $i; ?>" href="javascript:void(0);">Read More <i class="fa fa-chevron-down"></i></a></div>
					<?php } ?>
					<div class="datasets">
					
						<a href="javascript:void(0);" class="bsets<?php echo $i; ?> bset"  rel="<?php echo $i; ?>"  type="submit" style="display: none;" ><strong>Add</strong></a>
						
						
						<div id="blnkuu"><input type="checkbox" id="button" value="<?php echo $po->vehicleTypeId.'-'.$po->locationId.'-'.$po->name.'-'.$po->miscChargeID.'-'.$po->value.'-'.$po->calculationType.'-'.$po->isQuantity.'-'.$po->misChargeCode.'-'.$po->unit.'-'.$taxNotAvailable.'-'.$po->isQuantity;  ?>" name="chk<?php echo $i; ?>" checked="">
						<label  class="bsetsi<?php echo $i; ?>" id="bsetio" rel="<?php echo $i; ?>" title="Mandatory addon">Remove</label>
						</div>
					</div>
					<!--plus minus start-->
					<?php  if($po->isQuantity == true){ ?>
					<div class="quantity buttons_added" id="plusmisus<?php echo $i; ?>"></div>
					<?php } ?>
					
					<!--plus minus end-->
				</div>
				<?php if( esc_attr( get_option('chargeDesc') ) == 'On') { ?>
				<div class="settingdivhide" id="hidediv<?php echo $i; ?>" style="display:none;">
					<div class="datasetleft"></i> <?php echo $po->description;  ?></div>
				</div>
			<?php
				}
			  }
			  else{
				?>
				<input type="hidden" name="vich" value="<?php echo $po->vehicleTypeId.'-'.$po->locationId;  ?>" id="getval<?php echo $i; ?>" />
				<input type="hidden" value="<?php echo $pick;  ?>" name="pick" id="pick<?php echo $i; ?>" />
				<input type="hidden" value="<?php echo $drop;  ?>" name="drop" id="drop<?php echo $i; ?>" />
				<input type="hidden"  value="<?php echo $po->name.'-'.$po->miscChargeID.'-'.$po->value.'-'.$po->calculationType.'-'.$po->isQuantity.'-'.$po->misChargeCode.'-'.$po->unit.'-'.$taxNotAvailable.'-'.$po->isQuantity;  ?>" id="pid<?php echo $i; ?>" class="quantityVal" />
				
				<input type="hidden" value="<?php echo ($po->isQuantity == false)?0:$po->isQuantity;  ?>" rel="<?php echo $isOptional; ?>" id="statusmis<?php echo $i; ?>" />
				<div class="settingdiv">
					<div class="datasetleft"><i class="fa fa-check-circle icons"></i><?php echo ucfirst($po->name); ?></div>
					<div class="datasettxt"><strong>$<?php echo $po->value; ?> </strong>/ <?php echo $po->calculationType;  ?></div>
					<?php if( esc_attr( get_option('chargeDesc') ) == 'On') { ?>
					<div class="dataset"><a class="anext"  getId="<?php echo $i; ?>" href="javascript:void(0);">Read More <i class="fa fa-chevron-down"></i></a></div>
					<?php } ?>
					<div class="datasets">
						<a href="javascript:void(0);" class="bsets<?php echo $i; ?> bset" rel="<?php echo $i; ?>"  type="submit" ><strong>Add</strong></a>
						<div id="blnk<?php echo $i; ?>"></div>
					</div>
					<!--plus minus start-->
					<?php  if($po->isQuantity == true){ ?>
					<div class="quantity buttons_added" id="plusmisus<?php echo $i; ?>"></div>
					<?php } ?>
					
					<!--plus minus end-->
				</div>
				<?php if( esc_attr( get_option('chargeDesc') ) == 'On') { ?>
				<div class="settingdivhide" id="hidediv<?php echo $i; ?>" style="display:none;">
					<div class="datasetleft"></i> <?php echo $po->description;  ?></div>
				</div>
					
				<?php  
				}
			  }
			 }
				$i++;
			}
			?>
			<div class="lstdiv"><input type="submit" id="btns" name="bttn" value="Continue" /></div>
		</form>
		<?php
		}else{
		?>
		<form action="<?php echo get_permalink( get_page_by_path( 'summary' ));  ?>" method="POST">
			<p>No extra Addon found. please click on continue for booking. </p>
			<div class="lstdiv"><input type="submit" id="btns" name="bttn" value="Continue" /></div>
		</form>
		<?php
		}
  }
  die();
}
