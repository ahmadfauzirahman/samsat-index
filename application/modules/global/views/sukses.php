<div class="container">
	<center>
		<div id="time"></div>	
	</center>
</div>

<script type="text/javascript">
	var timer = 5;

	$(document).ready(function() {
		startCountdown();
	});

	function startCountdown() 
	{
		if ((timer - 1) >= 0) {
			timer = timer - 1;
			$("#time").html('Please wait <font style="font-size:125%;"> <b>' + timer + '</b></font> second..!');

			setTimeout(startCountdown, 1000);
		} else {
			window.location.assign('<?php echo base_url(); ?>');
		}
	}
</script>