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
<!-- <div class="card-body">
	<h4><?php // $_GET['nm']; 
		?></h4>
</div> -->
<div class="card-body">
	<table class="table table-bordered">
		<tr>
			<td style="width:200px;">Nama OPD :</td>
			<td><?= $nama_opd['description']; ?></td>
		</tr>
	</table><br>

	<table class="table table-bordered" id="example2" width="100%" cellspacing="0">
		<thead>
			<tr>
				<th style="width:160px;">Username</th>
				<th>Nama Pengguna</th>
				<th style="width:175px;">Nip</th>
				<th>Bidang</th>
				<th style="width:60px;">Golongan</th>
				<th style="width:60px;">Eselon</th>
				<th style="width:60px;">Aktif</th>
				<th style="width: 80px; text-align:center;">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($users as $row) : ?>
				<tr style="background-color: antiquewhite;">
					<td><?= $row['username']; ?></td>
					<td>[KEPALA OPD]
						<a href="<?= base_url('/admin/user/users/users_add/' . $opd_id . '/kepala_bidang'); ?>" title="Tambah kepala bidang">
							<?= $row['full_name']; ?>
						</a>
					</td>
					<td>
						<div style="width:175px;"> <?= $row['nip']; ?></div>
					</td>
					<td></td>
					<td><?= $row['golongan']; ?></td>
					<td><?= $row['eselon']; ?></td>
					<td><?= $row['active'] == '1' ? '<font color="gren">Aktif</font>' : '<font color="red">Tidak</font>'; ?></td>
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
				<?php $kepala_bidang = $db->table('users')->getWhere(['opd_id' => buka($opd_id), 'jabatan' => 'kepala_bidang'])->getResultArray();
				foreach ($kepala_bidang as $rol) : ?>
					<tr>
						<td> <?= $rol['username']; ?> </td>
						<td>
							<div style="padding-left:20px;"> [KEPALA BIDANG]
								<a href="<?= base_url('/admin/user/users/users_add/' . $opd_id . '/pungsional/' . $rol['id']); ?>" title="Tambah User">
									<?= $rol['full_name']; ?>
								</a>
							</div>
						</td>
						<td><?= $rol['nip']; ?></td>
						<td><?= isset($rol['nama_singkat_bidang']) ? '(' . $rol['nama_singkat_bidang'] . ') ' . $rol['nama_panjang_bidang'] : ''; ?></td>
						<td><?= $rol['golongan']; ?></td>
						<td><?= $rol['eselon']; ?></td>
						<td><?= $rol['active'] == '1' ? '<font color="gren">Aktif</font>' : '<font color="red">Tidak</font>'; ?></td>
						<td style="text-align:center;">
							<a class="btn btn-info btn-circle btn-xs" href="<?= base_url('/admin/user/users/users_edit/' . $opd_id . '/' . kunci($rol['id']) . '/kepala_bidang'); ?>">
								<i class="nav-icon fas fa-pen-alt"></i>
							</a>
							<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url('/admin/user/users/hapus/' . $rol['id'] . '/kepala_bidang/?nsb=' . $rol['nama_singkat_bidang'] . '&npb=' . $rol['nama_panjang_bidang']); ?>'}" href="#">
								<i class="nav-icon fas fa-trash-alt"></i>
							</a>
							<a class="btn btn-warning btn-circle btn-xs" title="Reser Password" onclick="if(confirm('Reset Password Untuk Akun (<?= $rol['full_name']; ?>) ?? Menjadi Password Default ( perencanaan )')){location.href='<?= base_url('/admin/user/users/password_reset/' . $rol['id']); ?>'}" href="#">
								<i class="nav-icon fas fa-key"></i>
							</a>
						</td>
					</tr>
					<?php $pungsional = $db->table('users')->getWhere(['opd_id' => buka($opd_id), 'jabatan' => 'pungsional', 'nama_singkat_bidang' => $rol['nama_singkat_bidang']])->getResultArray();
					foreach ($pungsional as $ros) : ?>
						<tr>
							<td><?= $ros['username']; ?></td>
							<td>
								<div style="padding-left:40px;"> <?= $ros['full_name']; ?></div>
							</td>
							<td><?= $ros['nip']; ?></td>
							<td><?= isset($ros['nama_singkat_bidang']) ? '(' . $ros['nama_singkat_bidang'] . ') ' . $ros['nama_panjang_bidang'] : ''; ?></td>
							<td><?= $ros['golongan']; ?></td>
							<td><?= $ros['eselon']; ?></td>
							<td><?= $ros['active'] == '1' ? '<font color="gren">Aktif</font>' : '<font color="red">Tidak</font>'; ?></td>
							<td style="text-align:center;">
								<a class="btn btn-info btn-circle btn-xs" href="<?= base_url('/admin/user/users/users_edit/' . $opd_id . '/' . kunci($ros['id']) . '/pungsional'); ?>">
									<i class="nav-icon fas fa-pen-alt"></i>
								</a>
								<a class="btn btn-danger btn-circle btn-xs" onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){location.href='<?= base_url('/admin/user/users/hapus/' . $ros['id']); ?>'}" href="#">
									<i class="nav-icon fas fa-trash-alt"></i>
								</a>
								<a class="btn btn-warning btn-circle btn-xs" title="Reser Password" onclick="if(confirm('Reset Password Untuk Akun (<?= $ros['full_name']; ?>) ?? Menjadi Password Default ( perencanaan )')){location.href='<?= base_url('/admin/user/users/password_reset/' . $ros['id']); ?>'}" href="#">
									<i class="nav-icon fas fa-key"></i>
								</a>
							</td>
						</tr>
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
			"responsive": true,
			"autoWidth": false,
		});
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": false,
			"info": true,
			"autoWidth": false,
			"responsive": true,
		});
	});
</script>
<?= $this->endSection(); ?>