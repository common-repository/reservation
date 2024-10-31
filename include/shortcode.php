<?php

	function NTRAboxLayout(){
	  $layout='';
	  $layout .= '<div style="clear:both"> </div>
	  <div class="navotar"> 
		<div class="col-md-5">
		<div id="error10" class="err"></div>
			<form id="boxsearch" name="f1" method="POST" action="'.get_permalink( get_page_by_path( 'listing' )).'" onsubmit="return NTRAformValidate()">
				<div class="res_block">
					<div class="tblk">
						<div class="title_blk">
							<div class="title_icon"><i class="fa fa-calendar"></i> Make a Reservation</div>
							<p>Reserve Your Rental Car</p>
						</div>
						
						<div class="vtype">';
						if(get_option('vehType','On') == 'On'){
							$layout .= '<label class="vheading">Vehicle Type</label>
							<select name="vtype" id="cviheletype"';
							if(get_option('vehicleTypeMandatory')== 'Yes'){ 
								$layout .= 'required="required" ';
							}

							$layout .='>
								<option value="" >Select</option>
								
							</select>';
						}
						
					$layout .= '</div>
					<div id="error" class="err"></div>
					</div>
					
					<div class="res_fields">
						<div class="col-md-6 input_place">
							
							<label> Pick up Date</label>
							<div class="input-group">
								
								<input type="text" size="16" id="datetimepicker1" class="textfields dateone common" name="pivkupdate"  value="'.date("d-m-Y").'" readonly>
								<span class="input-group-addon" >
							       <span  value="'.date("d-m-Y").'" readonly class="fa fa-calendar point1"></span>
								</span>
								<div id="pickerr" class="err"></div>
							</div>	
						</div>
						
						<div class="col-md-6 input_place">
							<label> Time</label>
							<div class="input-group timepicker" >
								<input type="text" id="datetimepicker" class="textfields timeone common" name="pickuptime"  value="09:00" readonly>
								<span class="input-group-addon">
									<span  class="fa fa-clock-o time1"></span>
								</span>
								<div id="pt" class="err"></div>
							</div>
						</div>
					</div>
					
					<div class="res_fields2">
					<center><div id="loaderlsit" style="display: none;position:absolute;z-index:1;margin: -50px 18%;"><img src="'.plugins_url( '/images/loader.gif', __FILE__ ).'" class="loader"></div></center>
						<div class="col-md-6 input_place">
							<label> Drop off Date</label>
							<div class="input-group">
								<input type="text" size="16"  id="datetimepicker0" class="textfields datetwo common" name="dropoffdate"  value="'.date("d-m-Y", strtotime("+1 day")).'" readonly>
								<span class="input-group-addon">
									<span class="fa fa-calendar point2"></span>
								</span>
								<div id="errordrop" class="err"></div>
							</div>
						</div>
						
						<div class="col-md-6 input_place">
							<label> Time</label>
							<div class="input-group">
								<input type="text"  id="datetimepicker01" class="textfields timetwo common" name="dropofftime" value="12:00" readonly>
								<span class="input-group-addon">
									<span> <i class="fa fa-clock-o time2"></i></span>
								</span>
								<div id="dt" class="err"></div>
							</div>
						</div>
					</div>
					<div class="res_fields2">
						<div class="col-md-6 input_place">
							<label> Pickup Location</label>
							<select class="textfields followup mylocation" id="locationplan" name="picklocation" >
								<option value="">Select Location</option>
							</select>
							<div id="errorloc" class="err"></div>';
							if(esc_attr( get_option('dropoffon') =='On')){
							$layout .='<input class="checkbox"  type="checkbox" id="chk" /> <span class="dropof">Different Drop-off Location</span>';
							}
						$layout .='</div>
						<div class="col-md-6 input_place">
						<div class="blockhide">';
						if(esc_attr( get_option('dropoffon','On') =='On')){
							$layout .='<label> Dropoff Location</label>
							<select class="textfields dropoff pdrop" id="droplocationplan" name="dropoff_loc"';
							if(get_option('dropoffMandatory')== 'Yes'){ 
								$layout .= 'required="required" ';
							}

							$layout .='
							>
								<option value="">Select Location</option>
							</select>
							</div>
						</div>
						';
						}
						
					$layout .='</div>
					
					<div class="res_fields2">';
					if(get_option('age') =='On'){
						$layout .='<div class="input_age">
							<label> Age</label>
							<div class="input-group">
								<select class="textfields" id="age" name="age"';
								if(get_option('ageMandatory')== 'Yes'){ 
									$layout .= 'required="required" ';
								} 

								$layout .= '>
								<option value="">Select Age</option>';
								for($i=18;$i<70;$i++){
									$layout .='<option value="'.$i.'">'.$i.'</option>';
								}
								
							$layout .='</select>
							</div>
						</div>';
					}
					
					
					
					
					//condition 1
					if(esc_attr( get_option('age')) =='' && esc_attr( get_option('dropoffon')) ==''){
					$layout .='	<div class="input_age">';
						if(esc_attr( get_option('promo')) =='On'){
							$layout .='<label> Promo Code</label>
							<input type="text" class="textfields" name="promo" id="promocode"'; 
							if(get_option('promoMandatory')== 'Yes'){ 
								$layout .= 'required="required" ';
							} 
							$layout .='/> <div id="promoerr" class="err"></div>';
							
						}
					$layout .='	</div>
						<button class=" pull-right btn btn-blue" type="submit" ng-disabled="!sdata">
						<translate><span class="ng-scope">Search</span></translate> <i class="fa fa-search"></i> 
						</button></div>';
					}
					
					
					
					//condition 2
					if(esc_attr( get_option('age')) =='On' && esc_attr( get_option('dropoffon')) =='On'){
					$layout .='	<div class="input_age">';
						if(esc_attr( get_option('promo')) =='On'){
							$layout .='<label> Promo Code</label>
							<input type="text" class="textfields" name="promo" id="promocode"'; 
							if(get_option('promoMandatory')== 'Yes'){ 
								$layout .= 'required="required" ';
							} 
							$layout .='/> <div id="promoerr" class="err"></div>';
							
						}
					$layout .='	</div>
						<button class=" pull-right btn btn-blue" type="submit" ng-disabled="!sdata">
						<translate><span class="ng-scope">Search</span></translate> <i class="fa fa-search"></i> 
						</button>';
					}
					
					$layout .='	</div>
					
				
				';
				
				
				
				
				if(esc_attr( get_option('age')) =='On' && esc_attr( get_option('dropoffon')) ==''){
				$layout .='	</div><div class="res_fields2">
				<div class="half">';
						if(esc_attr( get_option('promo')) =='On'){
							$layout .='<label> Promo Code</label>
							<input type="text" class="textfields" name="promo" id="promocode"'; 
							if(get_option('promoMandatory')== 'Yes'){ 
								$layout .= 'required="required" ';
							} 
							$layout .='/> <div id="promoerr" class="err"></div>';
							
						}else{
							$layout .='&nbsp;';
						}
					$layout .='	</div>
					<div class="half">
						<button class=" pull-right btn btn-blue" type="submit" ng-disabled="!sdata">
						<translate><span class="ng-scope">Search</span></translate> <i class="fa fa-search"></i> 
						</button>
					</div>
				</div></div>';
				}
				
				
				//condition 4
				if(esc_attr( get_option('age')) =='' && esc_attr( get_option('dropoffon')) =='On'){
				$layout .='	<div class="res_fields2">
				<div class="half">';
						if(esc_attr( get_option('promo')) =='On'){
							$layout .='<label> Promo Code</label>
							<input type="text" class="textfields" name="promo" id="promocode"'; 
							if(get_option('promoMandatory')== 'Yes'){ 
								$layout .= 'required="required" ';
							} 
							$layout .='/> <div id="promoerr" class="err"></div>';
							
						}else{
							$layout .='&nbsp;';
						}
					$layout .='	</div>
					<div class="half">
						<button class=" pull-right btn btn-blue" type="submit" ng-disabled="!sdata">
						<translate><span class="ng-scope">Search</span></translate> <i class="fa fa-search"></i> 
						</button>
					</div>
				</div>';
				}
				
				$layout .='<div class="navo-footer">
					
				</div>
				</div><!--rsblock end-->
			</form>
		</div>
		</div>';
		return $layout;
	}
	add_shortcode( 'navotarBoxSearch', 'NTRAboxLayout');





	function NTRAretBox(){
		$layout = '';
		$layout .='<div class="navotar">
		<form id="boxsearch" name="f2" method="POST" action="'.get_permalink( get_page_by_path( 'listing' )).'" onsubmit="return NTRArectValidate();">
			<div id="boxdiv">
				<div id="carrent"> RENT A CAR</div>
				<div>
					<div id="location"><label>LOCATION</label></div>
					<div class="tfield">
					    
						<select class="t_text_fields followup getlast" id="locationplan" name="picklocation">
								<option value="">Select Location</option>
						</select>
						<div id="recterrorloc" class="err"></div>
					</div>
				</div>';
				if(esc_attr( get_option('dropoffon','On') =='On')){
				$layout .='<div id="dropdwnset">
					<input type="checkbox" id="chk2"/> Different Drop-off Location
				</div>
				<div class="blockhide2">
					<div id="location"><label>DROP-OFF LOCATION</label></div>
					<div class="tfield">
						<div id="errorloc" class="err"></div>
						<select class="t_text_fields dropoff pdrop" id="rectdroplocation" name="dropoff_loc">
								<option value="">Select Location</option>
						</select>
						
					</div>
				</div>';
				}
				$layout .='<center><div id="loaderlsit" style="display: none;position:absolute;z-index:1;margin: -50px 18%;"><img src="'.plugins_url( '/images/loader.gif', __FILE__ ).'" class="loader"></div></center>
				<div class="inputboxset">
					<div id="pt" class="err"></div><div id="dt" class="err"></div>
					<div id="rectpt" class="err"></div>
					<div id="rectdt" class="err" style="float:right;"></div>
					<div id="divset">
						<div id="labelset"><label>PICK_UP</label></div>
						<div><input id="datetimepicker6" class="setinput rectdateone" name="pivkupdate" type="text" placeholder="Date" value="'.date("d-m-Y").'"/></div>
					</div>
					<div id="divset">
						<div id="labelset"><label>&nbsp;</label></div>
						<div><input id="datetimepicker7" class="setinput recttimeone" name="pickuptime" type="text" value="09:00:00" placeholder="Time"/></div>
					</div>
					<div id="divset">
						<div id="labelset"><label>RETURN</label></div>
						<div><input id="datetimepicker8" class="setinput rectdatetwo" name="dropoffdate" type="text" placeholder="Date" value="'.date("d-m-Y", strtotime("+1 day")).'" /></div>

					</div>
                    
					
					<div id="divset">
						
						<div id="labelset"><label>&nbsp;</label></div>
						<div><input id="datetimepicker9" class="setinput recttimetwo" name="dropofftime" type="text" value="12:00:00" placeholder="Time"/></div>
					</div>';
					
					
					
					if(get_option('vehType','On') == 'On'){
						$layout .= '<div id="divset">
						<div id="labelset"><label>VEHCILE TYPE</label></div>
						<div><select name="vtype" class="setinputbig" id="cviheletype"';
						if(get_option('vehicleTypeMandatory')== 'Yes'){ 
							$layout .= 'required="required" ';
						}

						$layout .='>
							<option value="" >Select</option>
							
						</select></div></div>';
					}
					
					
					if(esc_attr( get_option('age')) =='On'){
					$layout .='<div id="divset">
						<div id="labelset"><label>AGE</label></div>
						<div>
							<select id="setinputbig" name="age">
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
								<option value="22">22</option>
								<option value="23">23</option>
								<option value="24">24</option>
								<option value="25">25</option>
								<option value="26">26</option>
							</select>
						</div>
					</div>';
					}
					
					
					
					
					if(esc_attr( get_option('promo')) =='On'){
					$layout .='<div id="divset">
						<div id="labelset"><label>&nbsp;</label></div>
						<div><input class="setinput" name="promo" id="rectpromocode" type="text" placeholder="Promotion Code "/></div>
					</div>';
					}
					
					
					
					
					
					$layout .='<div class="rightdivset">
					
					<div><button type="submit" class="btn btn-primary srcbtn" id="btn_ser">Search <i class="fa fa-search"></i> </button></div>
					</div>
					 <div id="rectpromoerr" class="err"></div>
			   <div id="recterrordrop" class="err"></div>';
				
			  $layout .=' <div class="navorect-footer">
					
				</div>
			</div>
				
			</from>
		</div>';
		return $layout;
	}
	add_shortcode( 'navotarRectSearch', 'NTRAretBox');




?>



