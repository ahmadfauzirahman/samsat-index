<div class="row">
	<div class="col-md-8">
		<div class="btn-group small" role="group" aria-label="...">
			<?php echo anchor('office/admin/add', '<i class="glyphicon glyphicon-plus"></i> Tambah', array('class' => 'btn btn-warning btn-sm')); ?>

			<?php echo anchor('office/admin', '<i class="glyphicon glyphicon-refresh"></i> Refresh', array('class' => 'btn btn-info btn-sm')); ?>
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
		<th>NAMA</th>
		<th>USERNM</th>
		<th>PASSWD</th>
		<th>LEVEL</th>
		<th>STTS LOGIN</th>
		<th>Action</th>
		
	</tr>
	</thead>
	<tbody>

	<?php if (!empty($admin_data)) : ?>
	<?php
	
	foreach ($admin_data as $row) {
		
		echo "<tr>
			<td>".++$start."</td>
			<td>".$row->nama."</td>
			<td>".$row->usernm."</td>
			<td>".$row->passwd."</td>
			<td>".$row->level."</td>
			<td>".$row->stts_login."</td>
			<td><center>".anchor('office/admin/edit/'.$row->id_admin, '<i class="glyphicon glyphicon-pencil"></i>', array('class' => 'btn btn-info btn-xs'))." ".anchor('office/admin/hapus/'.$row->id_admin, '<i class="glyphicon glyphicon-trash"></i>', array('class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Anda yakin ingin menghapus data ini?')"))."</center></td>
		</tr>";
	}

	?>

	<?php else : ?>
		<tr>
			<td colspan='7'>Data not found ...</td>
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