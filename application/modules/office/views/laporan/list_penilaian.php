<div class="row">
	<div class="col-md-8">
		<div class="btn-group small" role="group" aria-label="...">
			<?php echo anchor('office/laporan', '<i class="glyphicon glyphicon-refresh"></i> Refresh', array('class' => 'btn btn-info btn-sm')); ?>
		</div>
	</div>
	<div class="col-md-4">
		<form action="<?php echo site_url($link); ?>" method="get">
			<div class="input-group">
				<input type="text" class="form-control input-sm" name="keyword" value="<?php echo (!empty($_GET['keyword'])) ? $_GET['keyword'] : ''; ?>" placeholder="Search for...">
				<span class="input-group-btn">
					<button class="btn btn-primary btn-sm" type="submit" name="submit" value="go">Go!</button>
				</span>
			</div>
		</form>
	</div>
</div>
<br>

<?php if (!empty($penilaian_data)) : ?>
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
		<th>TOTAL</th>
		<th>ACTION</th>
	</tr>
	</thead>
	<tbody>
	<?php
	foreach ($penilaian_data as $row) {
		$total = $row->puas + $row->tidak_puas;
		echo "<tr>
			<td>".++$start."</td>
			<td>".$row->tgltime."</td>
			<td><center>".$row->ip_com."</center></td>
			<td><center>".number_format($row->puas)."</center></td>
			<td><center>".number_format($row->tidak_puas)."</center></td>
			<td><center>".number_format($total)."</center></td>
			<td><center><button type='button' data-toggle=\"modal\" href=\"#\" data-target=\".view\" data-id='".$row->id_penilaian."' class='btn btn-info btn-xs'><i class='glyphicon glyphicon-th-list'></i></button></center></td>
		</tr>";
	}

	?>
	</tbody>
</table>
</div>

<div class="row" style="margin-top:0;padding-top:0;">
	<div class="col-md-6">
		<p>Total : <label class="label label-danger">
		<?php echo (!empty($total_semua)) ? number_format($total_semua) : '0'; ?></label></p>
	</div>
	<div class="col-md-6">
		<nav class="text-right">
			<?php echo $pagination; ?>
		</nav>

	</div>
</div>

<?php endif; ?>

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

<br>

<script type="text/javascript">
	$(function(){
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
</script>