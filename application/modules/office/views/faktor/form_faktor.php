<?php

$form = array(
		'isi_faktor' => array(
        		'name' => 'isi_faktor', 
        		'id' => 'isi_faktor', 
        		'class' => 'form-control input-sm',
				'rows' => 4,
				'placeholder' => 'Ketik Isi Faktor ...',
        		'value' => set_value('isi_faktor', isset($form_value['isi_faktor']) ? $form_value['isi_faktor'] : '', false) 
        			
			), 
		'keterangan' => array(
        		'name' => 'keterangan', 
        		'id' => 'keterangan', 
        		'class' => 'form-control input-sm',
				'placeholder' => 'Keterangan',
        		'value' => set_value('keterangan', isset($form_value['keterangan']) ? $form_value['keterangan'] : '', false) 
        			
			), 

		'urutan' => array(
        		'name' => 'urutan', 
        		'id' => 'urutan', 
        		'class' => 'form-control input-sm',
				'placeholder' => '0',
        		'value' => set_value('urutan', isset($form_value['urutan']) ? $form_value['urutan'] : '') 
        			
			), 
	);
?>

<?php echo form_open($form_action, array('class' => 'form-horizontal')); ?>
	<div class="form-group">
		<label for="isi_faktor" class="col-sm-2 control-label">Isi Faktor :</label>
			<div class="col-sm-6">
			<?php echo form_textarea($form['isi_faktor']); ?>
			<?php echo form_error('isi_faktor'); ?>
		</div>
	</div>
	<div class="form-group">
		<label for="keterangan" class="col-sm-2 control-label">Keterangan Faktor :</label>
			<div class="col-sm-6">
			<?php echo form_textarea($form['keterangan']); ?>
			<?php echo form_error('keterangan'); ?>
		</div>
	</div>
	<div class="form-group">
		<label for="status" class="col-sm-2 control-label">Status :</label>
		<div class="col-sm-4">
			<div class="radio">
				<label>
					<?php echo form_radio('status', 'Y', set_radio('status', 'Y', isset($form_value['status']) && $form_value['status'] == 'Y' ? TRUE : FALSE)); ?>
					Y
				</label>
				
				<label>
					<?php echo form_radio('status', 'N', set_radio('status', 'N', isset($form_value['status']) && $form_value['status'] == 'N' ? TRUE : FALSE)); ?>
					N
				</label>
			</div>
			
			<?php echo form_error('status'); ?>
		</div>
		
	</div>
	<div class="form-group">
		<label for="urutan" class="col-sm-2 control-label">Urutan :</label>
		<div class="col-sm-1">
			<?php echo form_input($form['urutan']); ?>
		</div>
		<?php echo form_error('urutan'); ?>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<button type="submit" name="submit" value="submit" class="btn btn-primary btn-sm">Simpan</button>
			<button type="button" name="kembali" onclick="window.history.back();" class="btn btn-warning btn-sm">Kembali</button>
		</div>
	</div>

<?php echo form_close(); ?>