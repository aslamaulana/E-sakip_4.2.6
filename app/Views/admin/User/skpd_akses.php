<?= $this->extend('_layout/template'); ?>

<?= $this->section('content'); ?>
<div class="card-body">
	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th>Nama SKPD</th>
				<?php foreach ($permission as $row) : ?>
					<th style="text-align: center; width: 70px;"><?= $row['name']; ?></th>
				<?php endforeach; ?>
				<th></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>Nama SKPD</th>
				<?php foreach ($permission as $row) : ?>
					<th style="text-align: center;"><?= $row['name']; ?></th>
				<?php endforeach; ?>
				<th></th>
			</tr>
		</tfoot>
		<tbody>
			<?php foreach ($skpd as $row) : ?>
				<tr>
					<td><?= $row['name']; ?></td>
					<?php foreach ($permission as $ros) : ?>
						<!-- <form id="www" method="post"> -->
						<td style="text-align: center;">
							<?php $permis = $db->table('auth_groups_permissions')->getWhere(['group_id' => $row['id'], 'permission_id' => $ros['id']])->getRow(); ?>
							<div class="form-check">
								<input id="id_akses" type="text" name="id_akses" value="<?= isset($permis->id_g_p) ? $permis->id_g_p : ''; ?>">
								<input id="skpd" type="text" name="skpd" value="<?= $row['id']; ?>">
								<input id="akses" onkeyup="save();" class="form-check-input" type="checkbox" name="akses" value="<?= $ros['id']; ?>" <?= isset($permis->id_g_p) ? ($permis->permission_id == $ros['id'] ? 'checked' : '') : ''; ?>>
							</div>
							<!-- <button id="xx" type="submit" class="btn btn-primary">Simpan</button> -->
						</td>
						<!-- </form> -->
					<?php endforeach; ?>
					<!-- <td>
								<input type="submit" class="btn btn-primary" form="www" value="Simpan">
							</td> -->
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<script>
	function save() {
		var id_aksesNumberValue = document.getElementById('#id_akses').value;
		var skpdNumberValue = document.getElementById('#skpd').value;
		var aksesNumberValue = document.getElementById('#akses').value;
		$.ajax({
			url: "<?= base_url('admin/user/modul/akses_update'); ?>",
			method: "POST",
			// data: "id_akses=" + id_akses + "&skpd=" + skpd + "&akses=" + akses,
			data: {
				id_akses: id_aksesNumberValue,
				skpd: skpdNumberValue,
				akses: aksesNumberValue
			},
			async: true,
			dataType: 'json',

			success: function(data) {
				print: gggggggggggggg;
			},
			error: function(data) {

			}

		});
		return false;
	};
</script>
<?= $this->endSection(); ?>