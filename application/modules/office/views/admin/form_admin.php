<?php

$form = array(
		'nama' => array(
        		'name' => 'nama', 
        		'id' => 'nama', 
        		'class' => 'form-control input-sm',
				'placeholder' => 'Ketik Nama ...',
        		'value' => set_value('nama', isset($form_value['nama']) ? $form_value['nama'] : '') 
        			
			), 
		'usernm' => array(
        		'name' => 'usernm', 
        		'id' => 'usernm', 
        		'class' => 'form-control input-sm',
				'placeholder' => 'Ketik Usernm ...',
        		'value' => set_value('usernm', isset($form_value['usernm']) ? $form_value['usernm'] : '') 
        			
			), 
		'passwd' => array(
        		'name' => 'passwd', 
        		'id' => 'passwd', 
        		'class' => 'form-control input-sm',
				'placeholder' => 'Ketik Passwd ...' 
        			
			), 
		'level' => array(
        		'name' => 'level', 
        		'id' => 'level', 
        		'class' => 'form-control input-sm',
				'placeholder' => 'Ketik Level ...',
        		'value' => set_value('level', isset($form_value['level']) ? $form_value['level'] : '') 
        			
			), 
		'stts_login' => array(
        		'name' => 'stts_login', 
        		'id' => 'stts_login', 
        		'class' => 'form-control input-sm',
				'placeholder' => 'Ketik Stts Login ...',
        		'value' => set_value('stts_login', isset($form_value['stts_login']) ? $form_value['stts_login'] : '') 
        			
			), 
	);
?>

<?php echo form_open($form_action, array('class' => 'form-horizontal')); ?>
	<div class="form-group">
		<label for="nama" class="col-sm-2 control-label">Nama :</label>
			<div class="col-sm-6">
			<?php echo form_input($form['nama']); ?>
			<?php echo form_error('nama'); ?>
		</div>
	</div>
	<div class="form-group">
		<label for="usernm" class="col-sm-2 control-label">Username :</label>
			<div class="col-sm-3">
			<?php echo form_input($form['usernm']); ?>
			<?php echo form_error('usernm'); ?>
		</div>
	</div>
	<div class="form-group">
		<label for="passwd" class="col-sm-2 control-label">Password :</label>
			<div class="col-sm-3">
			<?php echo form_password($form['passwd']); ?>
			<?php echo form_error('passwd'); ?>
		</div>
	</div>
	<div class="form-group">
		<label for="level" class="col-sm-2 control-label">Level :</label>
		<div class="col-sm-4">
			<div class="radio">
				<label>
					<?php echo form_radio('level', '1', set_radio('level', '1', isset($form_value['level']) && $form_value['level'] == '1' ? TRUE : FALSE)); ?>
					Administrator
				</label>
				
				<label>
					<?php echo form_radio('level', '2', set_radio('level', '2', isset($form_value['level']) && $form_value['level'] == '2' ? TRUE : FALSE)); ?>
					User
				</label>
			</div>
			
			<?php echo form_error('level'); ?>
		</div>
	</div>
	<div class="form-group">
		<label for="stts_login" class="col-sm-2 control-label">Boleh Login :</label>
		<div class="col-sm-4">
			<div class="radio">
				<label>
					<?php echo form_radio('stts_login', 'Y', set_radio('stts_login', 'Y', isset($form_value['stts_login']) && $form_value['stts_login'] == 'Y' ? TRUE : FALSE)); ?>
					Ya
				</label>
				
				<label>
					<?php echo form_radio('stts_login', 'N', set_radio('stts_login', 'N', isset($form_value['stts_login']) && $form_value['stts_login'] == 'N' ? TRUE : FALSE)); ?>
					Tidak
				</label>
			</div>
			
			<?php echo form_error('stts_login'); ?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<button type="submit" name="submit" value="submit" class="btn btn-primary btn-sm">Simpan</button>
			<button type="button" name="kembali" onclick="window.history.back();" class="btn btn-warning btn-sm">Kembali</button>
		</div>
	</div>

<?php echo form_close(); ?>