<div class="container">
	<?php if(!empty($data_faktor)) : ?>
		<?php echo form_open($form_action); ?>
		<?php $no = 1;
			$i = 0;
		foreach($data_faktor as $row) { ?>
			<input type="hidden" name="rowNum[]" value="<?php echo $no; ?>">
			<input type="hidden" name="kode_<?php echo $no; ?>" value="<?php echo $row->id_faktor; ?>">
			<div class="row bg-primary">
				<div class="col-md-1">
					<h3><?php echo $no; ?></h3>
				</div>
				<div class="col-md-7">
					<h3><?php echo $row->isi_faktor; ?></h3>
					<?php echo !empty($row->keterangan) ? nl2br($row->keterangan) : ''; ?>
				</div>
				<div class="col-md-2">
					<div class="radio radio-success">
						<input type="radio" id="<?php echo ++$i; ?>" name="puas_<?php echo $no; ?>" value='1' required>
						<label for="<?php echo $i; ?>">Puas</label>

					</div>
				</div>
				<div class="col-md-2">
					<div class="radio radio-danger">
						<input type="radio" id="<?php echo ++$i; ?>" name="puas_<?php echo $no; ?>" value='0' required>
						<label for="<?php echo $i; ?>">Tidak Puas</label>

					</div>
				</div>
			</div>
			<hr>
		<?php 
			$no++;
		} ?>
		
	<?php else : ?>
		<p>Tidak ada data...</p>
	<?php endif; ?>
	
	<button type="submit" name="submit" value="Submit" class="btn btn-success btn-block"><h3>Kirim Penilaian</h3></button>
	<?php echo form_close(); ?>
	
	<div style="height:80px;"></div>
</div>