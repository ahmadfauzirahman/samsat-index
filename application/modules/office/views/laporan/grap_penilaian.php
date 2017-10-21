<?php 
	$puas = 0;
	$tidak_puas = 0;
	$jml = 0;

	$total = 0;

	if (!empty($data_penilaian)) {
		foreach ($data_penilaian as $row) {
			$puas += $row->puas;
			$tidak_puas += $row->tidak_puas;
			$total += $row->puas + $row->tidak_puas;
			$jml += 1;
		}


	}

	$persen_puas = ($puas * 100)/$total;
	$persen_tidak_puas = ($tidak_puas * 100)/$total;
?>
<div class="row">
	<div class="col-md-6">
		<canvas id="canvas"></canvas>	
	</div>
	<div class="col-md-3">
		<h4>Total Penilaian Puas</h4>
		<hr style="margin-top: 0;" class="line11">

		<center>
		<h1>
			<label class="label label-success"><?php echo $puas; ?></label>
		</h1>

		</center>
		<p>Persentase : <?php echo number_format($persen_puas, 2); ?> %</p> 
		<p>Total Yang Memberi Penilaian : <?php echo $jml; ?> Orang</p>
		<p>Total Penilaian : <?php echo number_format($total); ?> (100 %)</p>
	
	</div>
	<div class="col-md-3">
		<h4>Total Penilaian Tidak Puas</h4>
		<hr style="margin-top: 0;" class="line11">

		<center>
		<h1>
			<label class="label label-danger"><?php echo $tidak_puas; ?></label>
		</h1>
		</center>
		<p>Persentase : <?php echo number_format($persen_tidak_puas, 2); ?> %</p>
	</div>

</div>
<br>

<script type="text/javascript">
	var config = {
	    type: 'pie',
	    data: {
	        labels: ["Puas", "Tidak Puas"],
	        datasets: [{
	            data: [<?php echo number_format($persen_puas,2); ?>, 
	            		<?php echo number_format($persen_tidak_puas,2); ?>],

	            backgroundColor: [
	                "#FF6384",
	                "#FFCE56"
	            ],
	            hoverBackgroundColor: [
	                "#FF6384",
	                "#FFCE56"
	            ]
	        }]
	    },

	}
	window.onload = function() {
	    var ctx = document.getElementById("canvas").getContext("2d");
	    window.myLine = new Chart(ctx, config);
	};
</script>