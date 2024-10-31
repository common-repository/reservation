jQuery(document).ready(function ($) {
	
		$('#datetimepicker1').datetimepicker();
		$('#datetimepicker0').datetimepicker();
		$('#datetimepicker').datetimepicker();
		$('#datetimepicker01').datetimepicker();
		
		
		$('#datetimepicker30').datetimepicker();
		$('#datetimepicker22').datetimepicker();
		$('#datetimepicker23').datetimepicker();
		$('#datetimepicker24').datetimepicker();
		
		
		$('.point1').on('click', function () {
			$('#datetimepicker1').datetimepicker('show');
		});
		$('.point2').on('click', function () {
			$('#datetimepicker0').datetimepicker('show');
		});
		$('.time1').on('click', function () {
			$('#datetimepicker').datetimepicker('show');
		});
		$('.time2').on('click', function () {
			$('#datetimepicker01').datetimepicker('show');
		});
		
		
		$('.point3').on('click', function () {
			$('#datetimepicker30').datetimepicker('show');
		});
		$('.point4').on('click', function () {
			$('#datetimepicker22').datetimepicker('show');
		});
		$('.time3').on('click', function () {
			$('#datetimepicker23').datetimepicker('show');
		});
		$('.time4').on('click', function () {
			$('#datetimepicker24').datetimepicker('show');
		});
		
		
			//DatePicker Example
			$('#datetimepicker').datetimepicker({
				timepicker:true,
				datepicker:false,
				format:'H:i'
			});
			
			//TimePicke Example
			$('#datetimepicker1').datetimepicker({
				datepicker:true,
				timepicker:false,
				defaultDate:new Date(),	
				defaultSelect: true,
				minDate:'-1970/01/01', //today is minimum date
				format:'d-m-Y'
				
				
			});
			$('#datetimepicker01').datetimepicker({
				timepicker:true,
				datepicker:false,
				format:'H:i'
			});
			
			//TimePicke Example
			$('#datetimepicker0').datetimepicker({
				datepicker:true,
				timepicker:false,
				defaultDate:new Date(),
				defaultSelect: true,
				minDate:'+1970/01/02', //tomarrow is minimum date
				format:'d-m-Y'
			});
			
			//rect search
			
			//DatePicker Example
			$('#datetimepicker7').datetimepicker({
				timepicker:true,
				datepicker:false,
				format:'H:i'
			});
			
			//TimePicke Example
			$('#datetimepicker6').datetimepicker({
				datepicker:true,
				timepicker:false,
				defaultDate: '-1970/01/01',	
				defaultSelect: true,
				minDate:'-1970/01/01', //today is minimum date
				format:'d-m-Y'
			});
			$('#datetimepicker9').datetimepicker({
				timepicker:true,
				datepicker:false,
				format:'H:i'
			});
			
			//TimePicke Example
			$('#datetimepicker8').datetimepicker({
				datepicker:true,
				timepicker:false,
				minDate:'-1970/01/01', //yesterday is minimum date
				format:'d-m-Y'
			});
			
			
			//list page serarch
			
			//TimePicke Example
			$('#datetimepicker21').datetimepicker({
				datepicker:true,
				timepicker:false,
				minDate:'-1970/01/01', //yesterday is minimum date
				format:'d-m-Y'
			});
			
			$('#datetimepicker22').datetimepicker({
				timepicker:false,
				defaultSelect:true,
				defaultDate:'+1970/01/02',
				minDate:'+1970/01/01', //tomarrow is minimum date
				format:'d-m-Y'
			});
			
			$('#datetimepicker23').datetimepicker({
				timepicker:true,
				datepicker:false,
				format:'H:i'
			});
			
			$('#datetimepicker24').datetimepicker({
				timepicker:true,
				datepicker:false,
				format:'H:i'
			});
			
			$('#datetimepicker30').datetimepicker({
				datepicker:true,
				timepicker:false,	
				defaultSelect: true,
				
				minDate:'-1970/01/01', //today is minimum date
				format:'d-m-Y'
			});
			
			// hide and showHelp
		
		var show = function (elem) {
			elem.style.display = 'block';
		};

		var hide = function (elem) {
			elem.style.display = 'none';
		};

		var toggle = function (elem) {

			// If the element is visible, hide it
			if (window.getComputedStyle(elem).display === 'block') {
				hide(elem);
				return;
			}

			// Otherwise, show it
			show(elem);

		};

		// Listen for click events
		document.addEventListener('click', function (event) {

			// Make sure clicked element is our toggle
			if (!event.target.classList.contains('toggle')) return;

			// Prevent default link behavior
			event.preventDefault();

			// Get the content
			var content = document.querySelector(event.target.hash);
			if (!content) return;

			// Toggle the content
			toggle(content);

		}, false);
			
});