<?php

$form = array(
		'tgltime' => array(
        		'name' => 'tgltime', 
        		'id' => 'tgltime', 
        		'class' => 'form-control input-sm',
				'placeholder' => 'Ketik Tgltime ...',
        		'value' => set_value('tgltime', isset($form_value['tgltime']) ? $form_value['tgltime'] : '') 
        			
			), 
		'isi_saran' => array(
        		'name' => 'isi_saran', 
        		'id' => 'isi_saran', 
        		'class' => 'form-control input-sm',
				'placeholder' => 'Ketik Isi Saran ...',
        		'value' => set_value('isi_saran', isset($form_value['isi_saran']) ? $form_value['isi_saran'] : '') 
        			
			), 
		'ip_com' => array(
        		'name' => 'ip_com', 
        		'id' => 'ip_com', 
        		'class' => 'form-control input-sm',
				'placeholder' => 'Ketik Ip Com ...',
        		'value' => set_value('ip_com', isset($form_value['ip_com']) ? $form_value['ip_com'] : '') 
        			
			), 
	);
?>

<?php echo form_open($form_action, array('class' => 'form-horizontal')); ?>
	<div class="form-group">
		<label for="tgltime" class="col-sm-2 control-label">Tgltime :</label>
			<div class="col-sm-6">
			<?php echo form_input($form['tgltime']); ?>
			<?php echo form_error('tgltime'); ?>
		</div>
	</div>
	<div class="form-group">
		<label for="isi_saran" class="col-sm-2 control-label">Isi Saran :</label>
			<div class="col-sm-6">
			<?php echo form_input($form['isi_saran']); ?>
			<?php echo form_error('isi_saran'); ?>
		</div>
	</div>
	<div class="form-group">
		<label for="ip_com" class="col-sm-2 control-label">Ip Com :</label>
			<div class="col-sm-6">
			<?php echo form_input($form['ip_com']); ?>
			<?php echo form_error('ip_com'); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<button type="submit" name="submit" value="submit" class="btn btn-primary btn-sm">Simpan</button>
			<button type="button" name="kembali" onclick="window.history.back();" class="btn btn-warning btn-sm">Kembali</button>
		</div>
	</div>

<?php echo form_close(); ?>