<?= $this->extend('_layout/template'); ?>

<?= $this->section('stylesheet'); ?>
<link rel="stylesheet" href="<?= base_url('/toping/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('tombol'); ?>
<div style="width:90px;position: absolute;right: 0px;">
	<a href="<?= base_url('/admin/user/users/users_add/' . $opd_id); ?>">
		<li class="btn btn-block btn-warning btn-sm" active><i class="nav-icon fa fa-plus"></i> Add</li>
	</a>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="card-body">
	<table class="table table-bordered">
		<tr>
			<td style="width:200px;">Nama OPD :</td>
			<td><?= $nama_opd['description']; ?></td>
		</tr>
	</table><br>
	<table class="table table-bordered  display nowrap" id="example1" cellspacing="0">
		<thead>
			<tr>
				<th style="width:160px;">Username</th>
				<th>Nama Pengguna</th>
				<th style="width:175px;">Nip</th>
				<th>Bidang</th>
				<th style="width:150px;">Sub Bagian / Klompok Subtansi</th>
				<th style="width:100px;">Jabatan</th>
				<th style="width:60px;">Golongan</th>
				<th style="width:60px;" class="text-center">Aktif</th>
				<th style="width:80px;" class="text-center">Aksi</th>
			</tr>
		</thead>
		<!-- <tfoot>
			<tr>
				<th>SKPD</th>
				<th>Nama Pengguna</th>
				<th>Username</th>
				<th>Aktif</th>
				<th class="text-center">Aksi</th>
			</tr>
		</tfoot> -->
		<tbody>
			<?php foreach ($users as $row) : ?>
				<tr style="background-color: antiquewhite;">
					<td><?= $row['username']; ?></td>
					<td>
						<?= $row['full_name']; ?>
					</td>
					<td>
						<div style="width:175px;"> <?= $row['nip']; ?></div>
					</td>
					<td></td>
					<td><?= $row['sub_bidang']; ?></td>
					<td><?= $row['jabatan']; ?></td>
					<td class="text-center"><?= $row['golongan']; ?></td>
					<td class="text-center"><?= $row['active'] == '1' ? '<font color="gren">Aktif</font>' : '<font color="red">Tidak</font>'; ?></td>
					<td style="text-align:center;">
						<a class="btn btn-info btn-circle btn-xs" href="<?= base_url('/admin/user/users/users_edit/' . $opd_id . '/' . kunci($row['id'])); ?>">
							<i class="nav-icon fas fa-pen-alt"></i>
						</a>
						<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url('/admin/user/users/hapus/' . $row['id']); ?>'}" href="#">
							<i class="nav-icon fas fa-trash-alt"></i>
						</a>
						<a class="btn btn-warning btn-circle btn-xs" title="Reser Password" onclick="if(confirm('Reset Password Untuk Akun (<?= $row['full_name']; ?>) ?? Menjadi Password Default ( perencanaan )')){location.href='<?= base_url('/admin/user/users/password_reset/' . $row['id']); ?>'}" href="#">
							<i class="nav-icon fas fa-key"></i>
						</a>
					</td>
				</tr>
				<?php $level_2 = $db->table('users')->getWhere(['opd_id' => buka($opd_id), 'level' => '2'])->getResultArray();
				foreach ($level_2 as $rol) : ?>
					<tr style="background: azure;">
						<td> <?= $rol['username']; ?> </td>
						<td>
							<div style="padding-left:20px;">
								<?= $rol['full_name']; ?>
							</div>
						</td>
						<td><?= $rol['nip']; ?></td>
						<td><?= isset($rol['nama_singkat_bidang']) ? '(' . $rol['nama_singkat_bidang'] . ') ' . $rol['nama_panjang_bidang'] : ''; ?></td>
						<td><?= $rol['sub_bidang']; ?></td>
						<td><?= $rol['jabatan']; ?></td>
						<td class="text-center"><?= $rol['golongan']; ?></td>
						<td class="text-center"><?= $rol['active'] == '1' ? '<font color="gren">Aktif</font>' : '<font color="red">Tidak</font>'; ?></td>
						<td class="text-center">
							<a class="btn btn-warning btn-circle btn-xs" title="Reser Password" onclick="if(confirm('Reset Password Untuk Akun (<?= $rol['full_name']; ?>) ?? Menjadi Password Default ( perencanaan )')){location.href='<?= base_url('/admin/user/users/password_reset/' . $rol['id']); ?>'}" href="#">
								<i class="nav-icon fas fa-key"></i>
							</a>
						</td>
					</tr>
					<?php $level_3 = $db->table('users')->getWhere(['opd_id' => buka($opd_id), 'level' => '3', 'nama_singkat_bidang' => $rol['nama_singkat_bidang']])->getResultArray();
					foreach ($level_3 as $ros) : ?>
						<tr>
							<td><?= $ros['username']; ?></td>
							<td>
								<div style="padding-left:40px;">
									<?= $ros['full_name']; ?>
								</div>
							</td>
							<td><?= $ros['nip']; ?></td>
							<td><?= isset($ros['nama_singkat_bidang']) ? '(' . $ros['nama_singkat_bidang'] . ') ' . $ros['nama_panjang_bidang'] : ''; ?></td>
							<td><?= $ros['sub_bidang']; ?></td>
							<td><?= $ros['jabatan']; ?></td>
							<td class="text-center"><?= $ros['golongan']; ?></td>
							<td class="text-center"><?= $ros['active'] == '1' ? '<font color="gren">Aktif</font>' : '<font color="red">Tidak</font>'; ?></td>
							<td class="text-center">
								<a class="btn btn-warning btn-circle btn-xs" title="Reser Password" onclick="if(confirm('Reset Password Untuk Akun (<?= $ros['full_name']; ?>) ?? Menjadi Password Default ( perencanaan )')){location.href='<?= base_url('/admin/user/users/password_reset/' . $rol['id']); ?>'}" href="#">
									<i class="nav-icon fas fa-key"></i>
								</a>
							</td>
						</tr>
						<?php $level_4 = $db->table('users')->getWhere(['opd_id' => buka($opd_id), 'level' => '4', 'nama_singkat_bidang' => $rol['nama_singkat_bidang']])->getResultArray();
						foreach ($level_4 as $rop) : ?>
							<tr>
								<td><?= $rop['username']; ?></td>
								<td>
									<div style="padding-left:60px;"> <?= $rop['full_name']; ?></div>
								</td>
								<td><?= $rop['nip']; ?></td>
								<td><?= isset($rop['nama_singkat_bidang']) ? '(' . $rop['nama_singkat_bidang'] . ') ' . $rop['nama_panjang_bidang'] : ''; ?></td>
								<td><?= $rop['sub_bidang']; ?></td>
								<td><?= $rop['jabatan']; ?></td>
								<td class="text-center"><?= $rop['golongan']; ?></td>
								<td class="text-center"><?= $rop['active'] == '1' ? '<font color="gren">Aktif</font>' : '<font color="red">Tidak</font>'; ?></td>
								<td class="text-center">
									<a class="btn btn-warning btn-circle btn-xs" title="Reser Password" onclick="if(confirm('Reset Password Untuk Akun (<?= $rop['full_name']; ?>) ?? Menjadi Password Default ( perencanaan )')){location.href='<?= base_url('/admin/user/users/password_reset/' . $rol['id']); ?>'}" href="#">
										<i class="nav-icon fas fa-key"></i>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php endforeach; ?>
				<?php endforeach; ?>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<?= $this->endSection(); ?>

<?= $this->section('Javascript'); ?>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('/toping/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('/toping/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script>
	$(function() {
		bsCustomFileInput.init();
	});
	$(function() {
		$("#example1").DataTable({
			"scrollX": true,
			"scrollY": '65vh',
			"scrollCollapse": true,
			"paging": true,
			"responsive": false,
			"autoWidth": false,
			"ordering": false,
			"lengthMenu": [
				[20, 40, 60, 100, -1],
				[20, 40, 60, 100, 'All']
			],
		});
	});
</script>
<?= $this->endSection(); ?>