<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/* Template Name: Listing */ 
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}


?>
<?php get_header(); ?>

<input type="hidden" id="pviheletype" value="<?php if(!empty($_POST['vtype'])){ echo esc_html($_POST['vtype']) ;}  ?>" />
<input type="hidden" id="pdateone" value="<?php if(!empty($_POST['pivkupdate'])){ echo esc_html($_POST['pivkupdate']) ;}  ?>" />
<input type="hidden" id="ptimeone" value="<?php if(!empty($_POST['pickuptime'])){ echo esc_html($_POST['pickuptime']) ;}  ?>" />
<input type="hidden" id="pdatetwo" value="<?php if(!empty($_POST['dropoffdate'])){ echo esc_html($_POST['dropoffdate']) ;}  ?>" />
<input type="hidden" id="ptimetwo" value="<?php if(!empty($_POST['dropofftime'])){ echo esc_html($_POST['dropofftime']) ;}  ?>" />
<input type="hidden" id="plocationplan" value="<?php if(!empty($_POST['picklocation'])){ echo esc_html($_POST['picklocation']) ;}  ?>" />
<input type="hidden" id="pdrop" value="<?php if(!empty($_POST['dropoff_loc'])){ echo esc_html($_POST['dropoff_loc']) ;}  ?>" />
<input type="hidden" id="ppromocode" value="<?php if(!empty($_POST['promo'])){ echo esc_html($_POST['promo']) ;}  ?>" />
<?php $_SESSION['dropoff'] = $_POST['dropoff_loc']; ?>
<?php $_SESSION['pickuplocation']=$_POST['picklocation']; ?>
<div class="wrap">
<div id="listing_page">
    <div class="navotar">
		<div class="topbarnew">
		    <p>Home > <span class="redish">Select Car </span>> Options > Confirm</p>
		</div>
		
		<div class="newsearch">
			<form id="boxsearch" name="f3" method="POST" onsubmit="return NTRAlistSearchValidate();">
				<div class="blockfield">
					<label>Pickup Location</label>
					<select class="t_text_fields followup newselect" id="locationplan" name="pickuplocation">
						<option value="">Select Location</option>
					</select>
					<div id="errorloc" class="err"></div>
				</div>
				<div class="blockfield">
					<label>Dropoff Location</label>
					<select class="t_text_fields dropoff newselect" id="rectlocation2" name="dropoff_loc">
						<option value="">Select Location</option>
					</select>
				</div>
				<div class="blockfield">
					<label>Pickup Date</label>
					<input type="text" name="pivkupdate" id="datetimepicker30" class="newselect dateone" 
					value="<?php 
					echo date("d-m-Y");
					
					?>" readonly />
					<span class="input-group-addon">
					    <span class="fa fa-calendar point3"></span>
					</span>
					<div id="pickerr" class="err4"></div>
				</div>
				<div class="blockfield">
					<label>Pickup Time</label>
					<input type="text" name="pickuptime" id="datetimepicker23" class=" newselect timeone" 
					value="<?php
					
						echo"09:00";
					
					?>
					" readonly />
					<span class="input-group-addon">
						<span class="fa fa-clock-o time3"></span>
					</span>
					<div id="listpt" class="err pt"></div>
				</div>
				<div class="blockfield">
					<label>Dropoff Date</label>
					<input type="text" name="dropoffdate" id="datetimepicker22" class="newselect datetwo common" 
					value="<?php echo date("d-m-Y", strtotime("+0 day")); ?> " readonly />
					<span class="input-group-addon">
					    <span class="fa fa-calendar point4"></span>
					</span>
					<div id="errordrop" class="err"></div>
				</div>
				<div class="blockfield">
					<label>Dropoff Time</label>
					<input type="text" name="dropofftime" id="datetimepicker24" class="newselect timetwo" 
					value="<?php
					
						echo"12:00";
					
					?>" readonly />
					<span class="input-group-addon">
						<span class="fa fa-clock-o time4"></span>
					</span>
					<div id="listdt" class="err"></div>
				</div>
				<div class="blockfield">
					<label>Vehicle Type</label>
					<select name="victype" id="cviheletype" class="primevechile";
					 style="height:42px">
						<option value="" >Select</option>
						
					</select></div>
				
				
				<div class="blockfieldbtn">
					
					<button class=" pull-right btn btn-blue newbtn" type="submit">
						<span class="ng-scope">SEARCH</span> 
					</button>
				</div>
			</form>
		</div>
		<!-- beadcrum-->
		<div class="navigate">
			 <div class="right1">
				<span><strong>CHOOSE A VEHICLE CLASS</strong></span>
			  </div>
			<?php if(!empty(esc_attr( get_option('priceHightoLow'))) || !empty(esc_attr( get_option('priceLowtoHigh'))) || !empty(esc_attr( get_option('AtoZ')))) {  ?>
			 <div class="main1">
				<select  name="sort" id="sort">
					<option value="">Sort by</option>
					<?php if(!empty(esc_attr( get_option('priceHightoLow')))){?>
					<option value="asc">High to Low Price</option>
					<?php } ?>
					<?php if(!empty(esc_attr( get_option('priceLowtoHigh')))){?>
					<option value="desc">Low to High Price</option>
					<?php } ?>
					<?php if(!empty(esc_attr( get_option('AtoZ')))){?>
					<option value="asc">A-Z</option>
					<?php } ?>
				</select>
			 </div>
			 
			<?php } ?>
		</div>
		
		
		<div class="mainblock">
			

			<!--listing start-->
			
			<?php if(esc_attr( get_option('listingLayout')=='list')  || esc_attr( get_option('listingLayout')=='')){ ?>
			<div class="main">
			<!-- list view start-->
				<center><div id="loaderlsit"></div></center>
				<div id="mylist"></div>
			<!--list view end-->
			</div>
			<?php  }   ?>
				<!--grid view start-->
			<?php if(esc_attr( get_option('listingLayout')=='grid')){ ?>
			<div class="grid_main">
				<section id="gridview">
				<!--view 1-->
				<center><div id="loaderlsit" style="width:150px;height:auto;"></div></center>
				<div id="mylist"></div>	
				</section>
				<!--grid view end-->
			</div>
			<?php  }  ?>
			<!--listing end-->
		</div>
	</div>
	</div>
<script>
$=jQuery.noConflict();
$(function($) {
	jQuery(document).on("change", "#sort", function($){
		var sort = jQuery('#sort').val();
		
	
		if(sort =='asc'){
			
		<?php	if(esc_attr( get_option('listingLayout')=='list')  || esc_attr( get_option('listingLayout')=='')){ ?>
			var myArray = jQuery("#mylist section");
		<?php  }else{ ?>
			var myArray = jQuery("#mylist .Carinfo");
		<?php  } ?>
			
			// sort based on timestamp attribute
			myArray.sort(function (a, b) {
				
				// convert to integers from strings
				a = parseInt(jQuery(a).attr("rel"), 10);
				b = parseInt(jQuery(b).attr("rel"), 10);
				if(a < b) {
					return 1;
				} else if(a < b) {
					return -1;
				} else {
					return 0;
				}
			});
			jQuery("#mylist").append(myArray);
		}else{
			
			<?php	if(esc_attr( get_option('listingLayout')=='list')  || esc_attr( get_option('listingLayout')=='')){ ?>
				var myArray = jQuery("#mylist section");
			<?php  }else{ ?>
				var myArray = jQuery("#mylist .Carinfo");
			<?php  } ?>
			console.log(myArray);
			// sort based on timestamp attribute
			myArray.sort(function (a, b) {
				
				// convert to integers from strings
				a = parseInt(jQuery(a).attr("rel"), 10);
				b = parseInt(jQuery(b).attr("rel"), 10);
				if(a > b) {
					return 1;
				} else if(a > b) {
					return -1;
				} else {
					return 0;
				}
			});
			jQuery("#mylist").append(myArray);
			
		}
	});
});


jQuery(document).ready(function($) { 
	var getloc = localStorage.getItem('selectedLoc');
	$('.headerloc').append(getloc);
});


var getvalues = <?php echo $_SESSION['search_info'];  ?>
</script>



<div style="clear:both;"></div>
<?php get_footer();  ?>