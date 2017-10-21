<table class="table table-striped table-hover table-light-dark table-bordered" style="margin-bottom:0;padding-bottom:0;">
	<thead>
	<tr>
		<th>#</th>
		<th>Faktor</th>
		<th>Penilaian</th>
	</tr>
	</thead>
	<body>
	<?php
	if(!empty($data_nilaifaktor)) {
		$no = 1;
		foreach ($data_nilaifaktor as $row) {
			if ($row->nilai == '1') {
				$hsl = '<label class="label label-primary"><i class="fa fa-thumbs-o-up"></i></label>';
			} else {
				$hsl = '<label class="label label-danger"><i class="fa fa-thumbs-o-down"></i></label>';
			}
			echo"<tr>
				<td>".$no++."</td>
				<td>".$row->isi_faktor."</td>
				<td><center>".$hsl."</center></td>
			</tr>";
		}
	} else {
		echo"<tr>
			<td colspan='3'><i>Not found...</i></td>
		</tr>";
	}
	?>
	</body>
</table>