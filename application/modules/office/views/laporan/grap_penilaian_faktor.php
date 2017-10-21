<div class="row">
	<div class="col-md-6">
		<?php if (!empty($data_faktor)) : ?>
		<!-- table data -->
		<div class="table-responsive">
		<table class="table table-striped table-hover table-light-dark table-bordered" id="myTable" style="margin-bottom:0;padding-bottom:0;">
			<thead>
			<tr>
				<th>#</th>
				<th>ISI FAKTOR</th>
				<th>PUAS</th>
				<th>TIDAK PUAS</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$no = 1;

			$noar = array();
			$puar = array();
			$toar = array();
			foreach ($data_faktor as $row) {
				$data = strip_tags($row->isi_faktor);
				$isi = word_limiter($data, 5);

				$puas = 0;
				$tidak_puas  = 0;
				$nfaktor = $this->m_penilaian->cari_nilai_perfaktor($row->id_faktor);
				if($nfaktor) {
					foreach ($nfaktor as $row) {
						if ($row->nilai == '1') {
							$puas += 1;
						} else {
							$tidak_puas += 1;
						}
					}
				}
				$totalpuas = $puas * 50;
				$totaltidakpuas = $tidak_puas * 50;
				
				echo "<tr>
					<td>".$no."</td>
					<td>".$isi."</td>
					<td><center>".number_format($puas) ." Orang</center></td>
					<td><center>".number_format($tidak_puas)." Orang</center></td>
				</tr>";

				$noar[] = '"'.$no.'"';
				$puar[] = $puas;
				$toar[] = $tidak_puas;

				$no++;
			}

			$labno = implode(", ", $noar);
			$datapuas = implode(", ", $puar);
			$datatidakpuas = implode(", ", $toar);

			?>
			</tbody>
		</table>
		</div>

		<?php endif; ?>
	</div>

	<div class="col-md-6">
		<canvas id="canvas"></canvas>

		<canvas id="canvas2"></canvas>	
	</div>

</div>
<br>

<script type="text/javascript">
	var config = {
	    type: 'bar',
    	data : {
    		labels : [<?php echo $labno; ?>],	

    		datasets: [
	    		{
	    			label: 'Puas (per-Orang)',
	    			borderWidth: 1,
	    			backgroundColor:'rgba(75, 192, 192, 0.2)',
	    			data : [<?php echo $datapuas; ?>],
	    		}
	    	]
    	} ,

	    	
	    

	};

	var config2 = {
	    type: 'bar',
    	data : {
    		labels : [<?php echo $labno; ?>],	
    		datasets: [
	    		{
	    			label: 'Tidak Puas (per-Orang)',
	    			borderWidth: 1,
	    			backgroundColor:"#FF6384",
	    			data : [<?php echo $datatidakpuas; ?>],
	    		}
	    	]
    	} ,

	    	
	    

	};
	window.onload = function() {
	    var ctx = document.getElementById("canvas").getContext("2d");
	    window.myLine = new Chart(ctx, config);

	    var ctx2 = document.getElementById("canvas2").getContext("2d");
	    window.myLine = new Chart(ctx2, config2);
	};
</script>