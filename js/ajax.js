jQuery( document ).ready(function($) {
	
	
	
	
	// error balank
	$("#datetimepicker").click(function(e)
	{ 
		$('.err').html("");
		$('.errormsg').html(""); 
	});
	
	$(".point1").click(function(e)
	{ 
		$('.err').html("");
		$('.errormsg').html(""); 
	});
	
	$("#locationplan").click(function(e)
	{ 
		$('#err').html("");
	});
	
	$(".point2").click(function(e)
	{ 
		$('.err').html("");
		$('#errordrop').html(""); 
	});
	$(".point3").click(function(e)
	{ 
		$('.err4').html("");
	});
	
	
	$("#datetimepicker30").click(function(e)
	{ 
		$('.err4').html("");
	});
	
	$("#datetimepicker9").click(function(e){
		$("#recterrordrop").html("");
	});
	
	$("#datetimepicker8").click(function(e){
		$("#recterrordrop").html("");
	});
	
	$("#promocode").click(function(e)
	{ 
		jQuery('#promoerr').html('<div class="errormsg"></div>');
	});
	$("#rectpromocode").click(function(e)
	{ 
		jQuery('#rectpromoerr').html('<div class="errormsg"></div>');
	});
	
	$("#locationplan").click(function(e)
	{ 
		jQuery('#recterrorloc').html('');
	});
	
	$("#datetimepicker24").click(function(e)
	{ 
		$('.err').html(""); 
	});
	
	$("#datetimepicker22").click(function(e)
	{ 
		$('#errordrop').html(""); 
	});
	
	$("#datetimepicker23").click(function(e)
	{ 
		$('#listpt').html(""); 
	});
	$("#datetimepicker01").click(function(e)
	{ 
		$('#dt').html(""); 
	});
	$("#datetimepicker0").click(function(e)
	{ 
		$('#errordrop').html(""); 
	});
	$("#datetimepicker22").click(function(e)
	{ 
		$('#errordrop').html(""); 
	});
	
	
	var textwidth = $('.dateone').outerWidth();
	var actualwidth = textwidth -17;
	
	$(".common").on("click", function(){
		$('.xdsoft_datepicker').css({'width': actualwidth+'px'});
		$('.xdsoft_timepicker').css({'width': actualwidth+'px'}); 
		$('.xdsoft_time_box').css({'width': actualwidth+'px'});
	});
	
	
	/*-----------New-------------*/
	
	$('#locationplan').change(function() {
		document.getElementById("errorloc").innerHTML="";  
	});
	$('#listlocation').change(function() {
		document.getElementById("errorloc").innerHTML="";  
	});
	$('#rectlocation').change(function() {
		document.getElementById("recterrorloc").innerHTML="";  
	});
	
	/*-----------New-------------*/
	
	$('#chk').change(function() {
		if($(this).is(':checked')) {
	  	 $(".blockhide").css("display", "block");
	  } else {
	  	 $(".blockhide").css("display", "none");
	  }
	 
	});
	
	
	/*-----------New-------------*/
	
	$('#chk2').change(function() {
		if($(this).is(':checked')) {
	  	 $(".blockhide2").css("display", "block");
	  } else {
	  	 $(".blockhide2").css("display", "none");
	  }
	 
	});


	/*-----------New-------------*/
	
	$(document).on( "click", ".details", function() {
		$(this).parent('.Carinfo').find(".hidediv").css("display","block");
	});
	
	$(document).on( "click", "#close1", function() {
		$('.Carinfo').find(".hidediv").css("display","none");
	});

	
	
	/*-----------New-------------*/
	
	
	/*------------ nonces used ---------  */
	var fl = window.localStorage.getItem('locationid');
	var pickupdate = window.localStorage.getItem('pickupdate');
	var pickuptime = window.localStorage.getItem('pickuptime');
	var datetwo = window.localStorage.getItem('datetwo');
	var timetwo = window.localStorage.getItem('timetwo');
	
	var picloct = $('#plocationplan').val();
	if(picloct !=''){
		var pl = picloct;
		var formdateone = $('#pdateone').val();
		var ptimeone = $('#ptimeone').val();
		var formdatetwo = $('#pdatetwo').val();
		var ptimetwo = $('#ptimetwo').val();
		var dl = $('#pdrop').val();
	}else{
		var pl = fl;
		var formdateone = pickupdate;
		var ptimeone = pickuptime;
		var formdatetwo = datetwo;
		var ptimetwo = timetwo;
		var dl = $('#pdrop').val();
	}
	
	$.ajax({
		url:MS_Ajax.ajaxurl,
		type: 'GET',
		dataType: 'html',
		data:{'action':'NTRALocationChecking','security':MS_Ajax.nextNonce}, 
		success: function(res) {
			
			$('.followup').html(res);
			if(formdateone !=undefined){
				$("#locationplan option[value="+pl+"]").attr('selected', 'selected');
				$("#datetimepicker30").val(formdateone);
				$("#datetimepicker23").val(ptimeone);
				$("#datetimepicker22").val(formdatetwo);
				$("#datetimepicker24").val(ptimetwo);
				if(pl !=undefined){
					$(".mylocation option[value="+pl+"]").attr('selected', 'selected');	
					$("#datetimepicker1").val(pickupdate);
					$("#datetimepicker").val(pickuptime);
					$("#datetimepicker0").val(datetwo);
					$("#datetimepicker01").val(timetwo);
						
				}else{
					
				}
			}else{
				
			}
			
		},
		error:function(err){
			console.log(err);
			
		}
	});
	
	
	
	if(dl==''){
		dl=pl;
	}
	$.ajax({
		url:MS_Ajax.ajaxurl,
		type: 'GET',
		dataType: 'html',
		data:{'action':'NTRALocationdropoff','security':MS_Ajax.nextNonce}, 
		success: function(res) {
			$('.dropoff').html(res);
			$("#rectlocation2 option[value="+dl+"]").attr('selected', 'selected');
		},
		error:function(err){
			$("#rectlocation2 option[value="+pl+"]").attr('selected', 'selected');
			
		}
	});
	
	
	/*-----------New-------------*/
	
	/*------------ nonces used ---------  */
	var vihcletype = window.localStorage.getItem('vihcletype');
	$.ajax({
		url:MS_Ajax.ajaxurl,
		type: 'GET',
		dataType: 'html', // added data type
		data:{'action':'NTRAlistVichele','security':MS_Ajax.nextNonce}, 
		success: function(reslist) {
			$('#cviheletype').html(reslist);
			$("#cviheletype option[value="+vihcletype+"]").attr('selected', 'selected');
		},
		error:function(err){
			console.log(err);
		}
	});
	
	
	
	
	
	/*-----------New-------------*/
	//get listing
	var locationid='';
	$(document).on( "click", ".newbtn", function() {
		locationid = $('#locationplan').val();
		
	});
	
	var vihcletype = $('#pviheletype').val();
	if(vihcletype){
		window.localStorage.setItem('vihcletype',vihcletype);
	}else{
		vihcletype = 0;
	}
	
	locationid = $('#plocationplan').val();
	if(locationid){
		window.localStorage.setItem('locationid',locationid);
	}else{
		locationid = window.localStorage.getItem('locationid');
	}
	
	var pickupdate = $('#pdateone').val();
	if(pickupdate){
		window.localStorage.setItem('pickupdate',pickupdate);
	}else{
		pickupdate = window.localStorage.getItem('pickupdate');
	}
	
	var pickuptime = $('#ptimeone').val();
	if(pickuptime){
		window.localStorage.setItem('pickuptime',pickuptime);
	}else{
		pickuptime = window.localStorage.getItem('pickuptime');
	}
	
	var datetwo = $('#pdatetwo').val();
	if(datetwo){
		window.localStorage.setItem('datetwo',datetwo);
	}else{
		datetwo = window.localStorage.getItem('datetwo');
	}
	
	var timetwo= $('#ptimetwo').val();
	if(timetwo){
		window.localStorage.setItem('timetwo',timetwo);
	}else{
		timetwo = window.localStorage.getItem('timetwo');
	}
	
	var droplocation = $('#pdrop').val();
	var promocode = $('#ppromocode').val();
	
	
	if(pickuptime !=''){
		$('#loaderlsit').html('<img src="'+plugin_url+'/images/loader.gif" class="loader" />').fadeIn();
	
	/*------------ nonces used ---------  */
		$.ajax({
			url: MS_Ajax.ajaxurl,
			type: 'POST',
			data:{'victype':vihcletype,'pickupdate':pickupdate,'pickuptime':pickuptime,'datetwo':datetwo,'timetwo':timetwo,'picklocation':locationid,'droplocation':droplocation,'promocode':promocode,'action':'NTRAvicheleList','security':MS_Ajax.nextNonce},
			dataType: 'html', // added data type
			success: function(res) {
					$('#loaderlsit').hide();
					$('#mylist').html(res);
				
			},
			error:function(err){
				$('#loaderlsit').hide();
				$('#mylist').html('<div class="falsemsg">Sorry, API return error.</div>');
			}
		});
	}
	
	
	$('#locationplan').change(function(){
		 var loc = $('#locationplan option:selected').attr('rel');
		  localStorage.setItem('selectedLoc', loc);
			
	});	
	
	$('#rectlocation').change(function(){
		 var loc = $('#rectlocation option:selected').attr('rel');
		
		  localStorage.setItem('selectedLoc', loc);
			
	});	

 
	$(document).on( "click", ".anext", function() {
	   var getId = $(this).attr('getId');
	   

			$("#hidediv"+getId).toggle();
		 
	  })
	  
	


// add addon code start	
	  
	$(document).on( "click", ".bset", function() {
	   $(this).hide();
	   var id = $(this).attr('rel');
	   var val =  $('#statusmis'+id).val();
	   var vhid =  $('#getval'+id).val();
	   var desc =  $('#pid'+id).val();
	 
	   if(val == '0' || val==null || val=='undefined'){
		   
		   $(this).parents('.settingdiv').find('.fa-check-circle').css({"color":"green"});
		   $(".bsetsi"+id).css({"display": "inline-block"});
		   var htmlval ='<input type="checkbox" id="button" value="'+vhid+'-'+desc+'" name="chk'+id+'" checked /><label for="button" class="bsetsi'+id+' bseti" id="bseti"  rel="'+id+'"  >Remove</label>';
			$("#blnk"+id).html(htmlval);
		   
	   }
	   else{
		    $(this).parents('.settingdiv').find('.fa-check-circle').css({"color":"green"});
			$("#plusmisus"+id).css({"display": "inline-block"});
			var htmlval2 = '<input type="button" value="-" class="minus" rel="'+id+'"><input type="text" id="newqty'+id+' qtyval"  step="1" min="0" max="5" name="'+vhid+'-'+desc+'" value="1" title="Qty" class="input-text qty text" size="4" readonly><input type="button" value="+" class="plus">';
			$("#plusmisus"+id).html(htmlval2);
	   }
	});
	
	// add addon code end	
	
	//Remove addon code start
	
	
	$(document).on( "click", ".bseti", function() {
	   $(this).parents('.settingdiv').find('.fa-check-circle').css({"color":"#dcdcdc"});
	   var id = $(this).attr('rel');
	   
	   $("#blnk"+id).html("");
	   var id = $(this).attr('rel');
	   var val =  $('#statusmis'+id).val();
	   
	   var vhid =  $('#getval'+id).val();
	   var desc =  $('#pid'+id).val();
	   if(val =='' || val==0){
		   
		   $(this).parents('.settingdiv').find('.fa-check-circle').css({"color":"#f2f2f2"});
		   $(".bsets"+id).css({"display": "inline-block"});
		   
	   }
	   
	});
	
	
	
	////Remove addon code end
	
	
	$(document).on("click", ".minus", function() {
		var id = $(this).next('.qty').val();
		
		if(id == 0 || id ==undefined){
			$(this).parent('.quantity').hide();
			var id = $(this).attr('rel');
			$(this).parents('.settingdiv').find('.fa-check-circle').css({"color":"#f2f2f2"});
			$(".bsets"+id).show();
		}
	});
	
	$(document).on("click", ".plus", function() {
		var id = $('.qty').val();
	});
	
}); 





/* add plus  inus */
 
function wcqibreFreshQuantityIncrements() {
    jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
        var c = jQuery(b);
        c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
    })
}
String.prototype.getDecimals || (String.prototype.getDecimals = function() {
    var a = this,
        b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
    return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
}), jQuery(document).ready(function() {
    wcqibreFreshQuantityIncrements()
}), jQuery(document).on("updated_wc_div", function() {
    wcqibreFreshQuantityIncrements()
}), jQuery(document).on("click", ".plus, .minus", function() {
    var a = jQuery(this).closest(".quantity").find(".qty"),
        b = parseFloat(a.val()),
        c = parseFloat(a.attr("max")),
        d = parseFloat(a.attr("min")),
        e = a.attr("step");
		
		
    b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
});












//search validation


function NTRAformValidate() {
	
	
      var pickdate=document.f1.pivkupdate.value;
	  var dropoffdate=document.f1.dropoffdate.value;
	  var array = pickdate.split("-");
	  var d1 = parseInt(array[2]+array[1]+array[0]);
	
	  var array2 = dropoffdate.split("-");
	 var d2 = array2[2].trim()+array2[1].trim()+array2[0].trim();
	
	  
	  if( document.f1.picklocation.value == "0" ) {
		  document.getElementById("errorloc").innerHTML="Please select pickup location.";  
		  return false;
	  }
	 
	
	
	 var pickuptime = jQuery('#datetimepicker').val();
	 var timetwo= jQuery('.timetwo').val();
	 var picklocation = jQuery('#locationplan').val();
	 var droplocation = jQuery('#droplocationplan').val();
	 var promocode = jQuery('#promocode').val();
	 var viheletype = jQuery('#viheletype').val();
	 
	 if(d1==d2){
		 if(pickuptime > timetwo || pickuptime == timetwo){
			document.getElementById("dt").innerHTML="Dropoff time should be less than pickup time.";  
			return false; 
		 }
	 }
	 if(d1 > d2){
		document.getElementById("errordrop").innerHTML="dropoff date should be greater than Pickup date.";  
		return false; 
	 }
	 
	 jQuery('#loaderlsit').html('<img src="'+plugin_url+'/images/loader.gif" class="loader" />').fadeIn();
	 
	 /*------------ nonces used ---------  */
	 jQuery.ajax({
		url:MS_Ajax.ajaxurl,
		type: 'POST',
		data:{'picklocation':picklocation,'droplocation':droplocation,'stime':pickuptime ,'etime':timetwo,'pdate':pickdate,'ddate':dropoffdate,'action':'NTRAreservationGetHours','security':MS_Ajax.nextNonce},
		dataType: 'json', // added data type
		success: function(res) {
			if(res==null){
				jQuery('#errordrop').html('<div class="errormsg">Dropoff location closed. Check for another day.</div>');
				jQuery('#loaderlsit').hide();
				return false;
			}
			if(res.error == 'error1'){
				jQuery('#pt').html('<div class="errormsg">'+ res.msg+'</div>');
				jQuery('#loaderlsit').hide();
				return false;
			}
			if(res.error == 'error2'){
				jQuery('#dt').html('<div class="errormsg">'+ res.msg+'</div>');
				jQuery('#loaderlsit').hide();
				return false;
			}
			if(res.error == 'error3'){
				jQuery('#pickerr').html('<div class="errormsg">'+ res.msg+'</div>');
				jQuery('#loaderlsit').hide();
				return false;
			}
			if(res.error == 'error4'){
				jQuery('#pickerr').html('<div class="errormsg">'+ res.msg+'</div>');
				jQuery('#loaderlsit').hide();
				return false;
			}
			if(res.error == 'error5'){
				jQuery('#errordrop').html('<div class="errormsg">'+ res.msg+'</div>');
				jQuery('#loaderlsit').hide();
				return false;
			}
			if(res.error == 'error6'){
				jQuery('#pt').html('<div class="errormsg">'+ res.msg+'</div>');
				jQuery('#loaderlsit').hide();
				return false;
			}
			if(res.error == 'error10'){
				jQuery('#error10').html('<div class="errormsg">'+ res.msg+'</div>');
				jQuery('#loaderlsit').hide();
				return false;
			}
			if(res.error =='success'){
				if(promocode =='' || promocode ==null || promocode ==undefined){
					jQuery("#chk"). prop("checked", false);
					document.f1.submit();
					
				}else{
				
					var pickdate = jQuery('#datetimepicker1').val();
					var dropdate = jQuery('#datetimepicker0').val();
					
					/*------------ nonces used ---------  */
					jQuery.ajax({
						url: MS_Ajax.ajaxurl,
						type: 'POST',
						data:{'viheletype':viheletype,'promocode':promocode,'picklocation':picklocation,'action':'NTRAreservationPromo','security':MS_Ajax.nextNonce},
						dataType: 'json', 
						success: function(res) {
							if(res.error == 'error'){
								jQuery('#loaderlsit').hide();
								jQuery('#promoerr').html('<div class="errormsg">'+ res.msg+'</div>');
								return false;
							}else{
								document.f1.submit();
							}
						}
					});
					
				}
			}
		},
		error:function(err){
			jQuery('#loaderlsit').hide();
			jQuery('#mylist').html('<div class="falsemsg">Sorry, API return error.</div>');
		}
	});
	 
	 return false;
}






function NTRArectValidate() {
	
      var pickdate=jQuery('#datetimepicker6').val();
	  var dropoffdate=jQuery('#datetimepicker8').val();
	  
	  var array = pickdate.split("-");
	  var d1 = parseInt(array[2].trim()+array[1].trim()+array[0].trim());
	  
	  var array2 = dropoffdate.split("-");
	 var d2 = array2[2].trim()+array2[1].trim()+array2[0].trim();
	  
	  
	 if( jQuery('#locationplan').val() == "" || jQuery('#locationplan').val() == 0 ) {
		document.getElementById("recterrorloc").innerHTML="Please select pickup location.";  
		return false;
	 }
	 
	 var pickuptime = jQuery('#datetimepicker7').val();
	 var recttimetwo= jQuery('.recttimetwo').val();
	 var rectlocation = jQuery('#locationplan').val();
	 var rectdroplocation = jQuery('#rectdroplocation').val();
	 var promocode = jQuery('#rectpromocode').val();
	 var viheletype = jQuery('#viheletype').val();
	 
	 if(d1==d2){
		 if(pickuptime > recttimetwo || pickuptime == recttimetwo){
			document.getElementById("recterrordrop").innerHTML="dropoff time should be greater than pickup time.";  
			return false; 
		 }
	 }
	
	 if(d1 > d2){
		document.getElementById("recterrordrop").innerHTML="dropoff date should be greater than Pickup date.";  
		return false; 
	 }
	
	  jQuery('#loaderlsit').html('<img src="'+plugin_url+'/images/loader.gif" class="loader" />').fadeIn();
	 /*------------ nonces used ---------  */
	 jQuery.ajax({
		url: MS_Ajax.ajaxurl,
		type: 'POST',
		data:{'picklocation':rectlocation,'droplocation':rectdroplocation,'pdate':pickdate,'ddate':dropoffdate,'stime':pickuptime ,'etime':recttimetwo,'action':'NTRAreservationGetHours','security':MS_Ajax.nextNonce},
		dataType: 'json', // added data type
		success: function(res) {
			if(res == null){
				jQuery('#loaderlsit').hide();
				jQuery("#mylist").css("display", "block");
			    jQuery('#mylist').html('<div class="falsemsg">Pickup or dropoff location is closed. Please find for amother day.</div>');
				return false;
			}
			if(res.error == 'error1'){
				jQuery('#rectpt').html('<div class="errormsg">'+ res.msg+'</div>');
				return false;
			}
			if(res.error == 'error2'){
				jQuery('#rectdt').html('<div class="errormsg">'+ res.msg+'</div>');
				return false;
			}
			if(res.error == 'error3'){
				jQuery('#rectpt').html('<div class="errormsg">'+ res.msg+'</div>');
				return false;
			}
			if(res.error == 'error4'){
				jQuery('#rectdt').html('<div class="errormsg">'+ res.msg+'</div>');
				return false;
			}
			if(res.error == 'error5'){
				jQuery('#rectpt').html('<div class="errormsg">'+ res.msg+'</div>');
				return false;
			}
			if(res.error == 'error6'){
				jQuery('#rectdt').html('<div class="errormsg">'+ res.msg+'</div>');
				return false;
			}
			if(res.error =='success'){
				jQuery('#loaderlsit').html('<img src="'+plugin_url+'/images/loader.gif" class="loader" />').fadeIn();
				if(promocode =='' || promocode ==undefined){
					document.f2.submit();
				}else{
					var pickdate = jQuery('#datetimepicker6').val();
					var dropdate = jQuery('#datetimepicker8').val();
					
					/*------------ nonces used ---------  */
					jQuery.ajax({
						url: MS_Ajax.ajaxurl,
						type: 'POST',
						data:{'viheletype':viheletype,'promocode':promocode,'picklocation':rectlocation,'action':'NTRAreservationPromo','security':MS_Ajax.nextNonce},
						dataType: 'json', 
						success: function(res) {
							if(res.error == 'error'){
								jQuery('#loaderlsit').hide();
								jQuery('#rectpromoerr').html('<div class="errormsg">'+ res.msg+'</div>');
								return false;
							}else{
								document.f2.submit();
							}
						}
					});
					
				}
			}
		},
		error:function(err){
			jQuery('#loaderlsit').hide();
			jQuery('#mylist').html('<div class="falsemsg">Sorry, API return error.</div>');
		}
	});
	 
	 return false;
}



function NTRAlistSearchValidate() {
	
      var pickdate=jQuery('#datetimepicker30').val();
	  var dropoffdate=jQuery('#datetimepicker22').val();
	  
	  var array = pickdate.split("-");
	  var d1 = parseInt(array[2]+array[1]+array[0]);
	  var arr = dropoffdate.split("-");
	  var d2 = arr[2].trim()+arr[1].trim()+arr[0].trim();
	  if( jQuery('#locationplan').val() == "" || jQuery('#locationplan').val() == 0 ) {
		document.getElementById("errorloc").innerHTML="Please select pickup location.";  
		return false;
	  }
	  var pickuptime = jQuery('#datetimepicker23').val();
	  var recttimetwo= jQuery('#datetimepicker24').val();
	  var rectlocation = jQuery('#locationplan').val();
	  var droplocation = jQuery('#rectlocation2').val();
	  var vechiletype = jQuery('#cviheletype').val();
	  
	  window.localStorage.setItem('locationid',rectlocation);
	  window.localStorage.setItem('droplocation',droplocation);
	  window.localStorage.setItem('pickupdate',pickdate);
	  window.localStorage.setItem('pickuptime',pickuptime);
	  window.localStorage.setItem('datetwo',dropoffdate);
	  window.localStorage.setItem('timetwo',recttimetwo);
	 
	 
	 var promocode = '';
	 
	 if(d1==d2){
		 if(pickuptime > recttimetwo || pickuptime == recttimetwo){
			document.getElementById("listdt").innerHTML="Dropoff time should be greater than pickup time.";  
			return false; 
		 }
	 }
	 
	 
	 
	 if(d1 > d2){
		document.getElementById("errordrop").innerHTML="dropoff date should be greater than Pickup date.";  
		return false; 
	 }
	 jQuery('#loaderlsit').html('<img src="'+plugin_url+'/images/loader.gif" class="loader" />').fadeIn();
	 jQuery('#mylist').hide();
	 /*------------ nonces used ---------  */
	 jQuery.ajax({
		url: MS_Ajax.ajaxurl,
		type: 'POST',
		data:{'picklocation':rectlocation,'droplocation':droplocation,'pdate':pickdate,'ddate':dropoffdate,'stime':pickuptime ,'etime':recttimetwo,'vechiletype':vechiletype,'action':'NTRAreservationGetHours','security':MS_Ajax.nextNonce},
		dataType: 'json', // added data type
		success: function(res) {
			if(res==null){
				jQuery('#loaderlsit').hide();
				jQuery("#mylist").css("display", "block");
			    jQuery('#mylist').html('<div class="falsemsg">No records get in this location or change pick and drop days.</div>');
				return false;
			}
			if(res.error == 'error1'){
				jQuery('#listpt').html('<div class="errormsg">'+ res.msg+'</div>');
				jQuery('#loaderlsit').hide();
				return false;
			}
			if(res.error == 'error2'){
				jQuery('#listdt').html('<div class="errormsg">'+ res.msg+'</div>');
				jQuery('#loaderlsit').hide();
				return false;
			}
			if(res.error == 'error3'){
				jQuery('#pickerr').html('<div class="errormsg">'+ res.msg+'</div>');
				jQuery('#loaderlsit').hide();
				return false;
			}
			if(res.error == 'error4'){
				jQuery('#pickerr').html('<div class="errormsg">'+ res.msg+'</div>');
				jQuery('#loaderlsit').hide();
				jQuery('#loaderlsit').hide();
				return false;
			}
			if(res.error == 'error5'){
				jQuery('#errordrop').html('<div class="errormsg">'+ res.msg+'</div>');
				jQuery('#loaderlsit').hide();
				return false;
			}
			if(res.error == 'error6'){
				jQuery('#listpt').html('<div class="errormsg">'+ res.msg+'</div>');
				jQuery('#loaderlsit').hide();
				return false;
			}
			if(res.error =='success'){
				if(promocode ==''){
					NTRAgetListing();
				}else{
					var pickdate = jQuery('#datetimepicker23').val();
					var dropdate = jQuery('#datetimepicker22').val();
					
					/*------------ nonces used ---------  */
					jQuery.ajax({
						url:MS_Ajax.ajaxurl,
						type: 'POST',
						data:{'viheletype':vechiletype,'promocode':promocode,'picklocation':rectlocation,'action':'NTRAreservationPromo','security':MS_Ajax.nextNonce},
						dataType: 'json', 
						success: function(res) {
							if(res.error == 'error'){
								jQuery('#loaderlsit').hide();
								jQuery('#rectpromoerr').html('<div class="errormsg">'+ res.msg+'</div>');
								return false;
							}else{
								NTRAgetListing();
							}
						}
					});
					
				}
			}
		},
		error:function(err){
			jQuery('#loaderlsit').hide();
			jQuery('#mylist').html('<div class="falsemsg">Sorry, API return error.</div>');
		}
	});
	 
	 return false;
}



function  NTRAgetListing(){
	//get listing
	
	var pickupdate = jQuery('.dateone').val();
	var pickuptime = jQuery('.timeone').val();
	var datetwo = jQuery('.datetwo').val();
	var timetwo= jQuery('.timetwo').val();
	var picklocation = jQuery('#locationplan').val();
	var droplocation = jQuery('#rectlocation2').val();
	var vechiletype = jQuery('#cviheletype').val();
	jQuery('#loaderlsit').html('<img src="'+plugin_url+'/images/loader.gif" class="loader" />').fadeIn();
	jQuery('#mylist').hide();
	
	/*------------ nonces used ---------  */
	jQuery.ajax({
		url: MS_Ajax.ajaxurl,
		type: 'POST',
		data:{'pickupdate':pickupdate,'pickuptime':pickuptime,'datetwo':datetwo,'timetwo':timetwo,'picklocation':picklocation,'droplocation':droplocation,'vechiletype':vechiletype,'action':'NTRAvicheleList','security':MS_Ajax.nextNonce},
		dataType: 'html', // added data type
		success: function(res) {
				jQuery('#loaderlsit').hide();
				jQuery('#mylist').show();
				jQuery('#mylist').html(res);
			
		},
		error:function(err){
			jQuery('#loaderlsit').hide();
			jQuery('#mylist').html('<div class="falsemsg">Sorry, API return error.</div>');
		}
	});
}
