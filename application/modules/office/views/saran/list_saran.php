<div class="row">
	<div class="col-md-8">
		<div class="btn-group small" role="group" aria-label="...">
			<?php //echo anchor('office/saran/add', '<i class="glyphicon glyphicon-plus"></i> Tambah', array('class' => 'btn btn-warning btn-sm')); ?>

			<?php echo anchor('office/saran', '<i class="glyphicon glyphicon-refresh"></i> Refresh', array('class' => 'btn btn-info btn-sm')); ?>
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

<!-- table data -->
<div class="table-responsive">
<table class="table table-striped table-hover table-light-dark table-bordered" id="myTable" style="margin-bottom:0;padding-bottom:0;">
	<thead>
	<tr>
		<th>#</th>
		<th>TGLTIME</th>
		<th>ISI SARAN</th>
		<th>IP COM</th>
		<th>Action</th>
		
	</tr>
	</thead>
	<tbody>

	<?php if (!empty($saran_data)) : ?>
	<?php
	
	foreach ($saran_data as $row) {
		
		echo "<tr>
			<td>".++$start."</td>
			<td>".$row->tgltime."</td>
			<td>".$row->isi_saran."</td>
			<td>".$row->ip_com."</td>
			<td><center></center></td>
		</tr>";
	}
	//".anchor('office/saran/edit/'.$row->id_saran, '<i class="glyphicon glyphicon-pencil"></i>', array('class' => 'btn btn-info btn-xs'))."
	//".anchor('office/saran/hapus/'.$row->id_saran, '<i class="glyphicon glyphicon-trash"></i>', array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Anda yakin ingin menghapus data ini?')"))."
	?>

	<?php else : ?>
		<tr>
			<td colspan='5'>Data not found ...</td>
		</tr>

	<?php endif; ?>

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
			<?php echo (isset($pagination)) ? $pagination : ''; ?>
		</nav>

	</div>
</div>

<br>