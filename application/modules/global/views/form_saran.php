<?php

$form = array(
		'isi_saran' => array(
        		'name' => 'isi_saran', 
        		'id' => 'isi_saran', 
        		'class' => 'form-control',
				'rows' => 12,
				'placeholder' => 'Ketik Saran Anda ...',
        		'value' => set_value('isi_saran', isset($form_value['isi_saran']) ? $form_value['isi_saran'] : '', false) 
        			
			)
	);
?>

<div class="container bg-primary">
<h3><?php echo anchor(base_url(), '<i class="fa fa-mail-reply"></i>', array('class' => 'btn btn-default')); ?> KIRIM SARAN ANDA</h3><hr style="margin-top: 0;">
<?php echo form_open($form_action); ?>

	<div class="form-group">
		<label for="isi_saran" class="control-label">Saran-saran :</label>
		<?php echo form_textarea($form['isi_saran']); ?>
		<?php echo form_error('isi_saran'); ?>
	</div>

	<button type="submit" name="submit" value="submit" class="btn btn-success btn-block"><h4><i class="fa fa-envelope"></i> KIRIM SARAN ANDA</h4></button>
<?php echo form_close(); ?>
</div>