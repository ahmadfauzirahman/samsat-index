<div class="row">
	<div class="col-md-8">
		<form action="<?php echo site_url($link); ?>" method="post">
			<div class="col-sm-4">
				<input type="text" class="form-control input-sm" id="tgl1" name="tgl1" placeholder="<?php echo date('Y-m-d'); ?>" readonly>
			</div>

			<div class="col-sm-4">
				<input type="text" class="form-control input-sm" id="tgl2" name="tgl2" placeholder="<?php echo date('Y-m-d'); ?>" readonly>
			</div>
			<div class="col-sm-1">
				<button class="btn btn-primary btn-sm" type="submit" name="submit" value="go">Cari</button>
			</div>
		</form>
	</div>
	<div class="col-md-4">
		&nbsp;
	</div>
</div>
<br>

<!-- table data -->
<div class="table-responsive">
<table class="table table-striped table-hover table-light-dark table-bordered" id="myTable" style="margin-bottom:0;padding-bottom:0;">
	<thead>
	<tr>
		<th>#</th>
		<th>TANGGAL</th>
		<th>IP</th>
		<th>PUAS</th>
		<th>TIDAK PUAS</th>
		<th>ACTION</th>
	</tr>
	</thead>
	<tbody>
<?php 
	$totalispuas = 0;
	$totaltpuas = 0;
	$peserta = 0;
	if (!empty($penilaian_data)) : ?>


	<?php
	$no = 1;

	foreach ($penilaian_data as $row) {
		$totalispuas = $totalispuas + $row->puas;
		$totaltpuas = $totaltpuas + $row->tidak_puas;

		echo "<tr>
			<td>".$no."</td>
			<td>".$row->tgltime."</td>
			<td><center>".$row->ip_com."</center></td>
			<td><center>".number_format($row->puas)."</center></td>
			<td><center>".number_format($row->tidak_puas)."</center></td>
			<td><center><button type='button' data-toggle=\"modal\" href=\"#\" data-target=\".view\" data-id='".$row->id_penilaian."' class='btn btn-info btn-xs'><i class='glyphicon glyphicon-th-list'></i></button></center></td>
		</tr>";

		$no++;
		$peserta++;
	}

	?>
	<tr>
		<td colspan="3">Total Penilaian</td>
		<td><center><b><?php echo $totalispuas; ?></b></center></td>
		<td><center><b><?php echo $totaltpuas; ?></b></center></td>
		<td>&nbsp;</td>
	</tr>
<?php else : ?>
	<tr>
		<td colspan="7">Lakukan pencarian untuk melihat data ...</td>
	</tr>
<?php endif; ?>
	</tbody>
</table>
</div>
<br>

<div class="row">
	<div class="col-md-7">
		<canvas id="canvas"></canvas>	
	</div>
	<div class="col-sm-5">
		<b>Keterangan Grafik :</b><br>
		Predikat Nilai Index Kepuasan Pelayanan STNK <br>
		<b><?php echo (isset($tgl1)) ? tgl_indo($tgl1) : '_'; ?></b> s/d <b><?php echo (isset($tgl2)) ? tgl_indo($tgl2) : '_'; ?></b>  : <br>

		<h2><?php echo ($totalispuas >  $totaltpuas) ? '<label class="label label-success">"Sangat Puas!"</label>' : '<label class="label label-danger">"Sangat Tidak Puas!"</label>'; ?></h2>
		Jumlah yang memberikan nilai : <b><?php echo $peserta; ?> Orang</b><br>


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
				$nfaktor = $this->m_penilaian->cari_nilai_perfaktor_periode($row->id_faktor, $tgl1, $tgl2);
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
</div>
<br>
<div class="modal fade view" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4>Penilaian</h4>
			</div>
			<div class="modal-body">
				<div id="loading" class="text-center"><img src="<?php echo base_url(); ?>assets/img/loading10.gif"></div>

				<div id="data"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>

<script type="text/javascript">
	$(function()
	{
		$("#tgl1, #tgl2").datepicker({
			showOn:"button",
			buttonImage:"<?php echo base_url(); ?>assets/img/calendar.gif",
			buttonImageOnly : true,
			dateFormat : "yy-mm-dd",
			beforeShow: customRange,
			showAnim : "fold"
		});

		$('.view').on('show.bs.modal', function(event) {
			var button = $(event.relatedTarget); // Button that triggered the modal
			var recipient = button.data('id'); // Extract info from data-* attributes

			$.ajax({
				url: "<?php echo site_url('office/laporan/view/'); ?>"+recipient,
				beforeSend : function() {
					$("#loading").show();
					$("#data").html("");
				},
				success: function(data) {
					$("#loading").hide();
					$("#data").html(data);
				}
			});
		});

	});

	function customRange(input)
	{
		if (input.id == 'tgl2') {
			var minDate = new Date($("#tgl1").val());
			minDate.setDate(minDate.getDate() + 1)

			return {
				minDate: minDate
			}
		}
	}

	var config = {
	    type: 'pie',
	    data: {
	        labels: ["Puas", "Tidak Puas"],
	        datasets: [{
	            data: [<?php echo $totalispuas; ?>, 
	            		<?php echo $totaltpuas; ?>],

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